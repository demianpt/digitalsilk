/**
 * TODO: Refactor this
 */

export function ajax() {
  jQuery(document).ready(($) => {
    const dsAjaxQueue = [];
    let dsUpdateSyncTimeout = null;
    let dsUpdateTimeout = null;

    const dsEnqueueAjax = function (ajaxOpts) {
      dsAjaxQueue.push(ajaxOpts);
      dsRunQueuedAjax();
    };

    // execute AJAX queued list
    var dsRunQueuedAjax = function () {
      if (dsAjaxQueue.length) {
        const ajaxOpts = dsAjaxQueue[0];

        ajaxOpts.complete = function () {
          dsAjaxQueue.shift(); // remove this ajax from queue
          dsRunQueuedAjax();
        };

        const xhr = $.ajax(ajaxOpts);
      }
    };

    const CartPopupActions = function () {
      // TODO change trigger
      $(document.body).on("click", ".ds-btn-inc", function (e) {
        e.preventDefault();
        return dsQtyButtonClick($(this), 1);
      });

      $(document.body).on("click", ".ds-btn-sub", function (e) {
        e.preventDefault();
        return dsQtyButtonClick($(this), -1);
      });

      $(document.body).on("click", "a.remove-item", function (e) {
        e.preventDefault();

        return dsRemoveFromCart($(this));
      });
    };

    var dsQtyButtonClick = function (element, factor) {
      const inputQty = element.parent().find(".qty");
      const newQty = parseInt(inputQty.val()) + factor;

      // check disabled
      if (element.hasClass("disabled")) {
        return false;
      }

      // respect the minimum value
      const minAttr = inputQty.attr("min");
      if (typeof minAttr !== typeof undefined && minAttr !== false && newQty < parseInt(minAttr)) {
        return false;
      }

      // respect the max stock limit
      const maxAttr = inputQty.attr("max");
      if (typeof maxAttr !== typeof undefined && maxAttr !== false && newQty > parseInt(maxAttr)) {
        return false;
      }

      // when using Select, check if new quantity exists in options list
      if (inputQty.is("select") && inputQty.find(`option[value="${newQty}"]`).length === 0) {
        return false;
      }

      inputQty.val(newQty);
      inputQty.change();

      return false;
    };

    const dsHandleAddToCartClick = function () {
      $(document).on("click", ".add_to_cart_button", (evt) => {
        dsBlockProductsUI(null);
      });
    };

    const dsQtyOnCheckout = function () {
      $("form.checkout").on("change", ".qty", () => {
        // run refresh callback timeout
        dsClearTimedoutQtyChange();
        dsUpdateTimeout = setTimeout(() => {
          const data = {
            action: "ds_update_checkout",
            security: wc_checkout_params.update_order_review_nonce,
            post_data: $("form.checkout").serialize(),
          };

          jQuery.post(ds.ajax_url, data, (response) => {
            $("body").trigger("update_checkout");
          });
        }, 500);
      });
    };

    var dsClearTimedoutQtyChange = function () {
      // clear previous timeout, if exists
      if (dsUpdateTimeout !== null) {
        clearTimeout(dsUpdateTimeout);
      }
    };

    // onload function calls
    CartPopupActions();
    dsHandleAddToCartClick();

    /** MiniCart Actions
     *
     */
    const dsMiniCartAjaxQuantityChange = function (cartItemKey, inputId, newQuantity) {
      dsEnqueueAjax({
        data: {
          action: "ds_alter_quantity",
          quantity: newQuantity,
          cart_item_key: cartItemKey,
        },
        type: "post",
        dataType: "json",
        url: ds.ajax_url,
        beforeSend() {
          dsBlockProductsUI($(".cart-popup"));
        },
        success(resp) {
          // tell do WC reload widget contents
          $(document.body).trigger("updated_wc_div");

          // trigger for 3rd plugins event listeners
          $(document.body).trigger("ds_minicart_updated", [resp.product_id]);

          // trigger update cart
          $(document.body).trigger("wc_update_cart");

          // find the <li> for the respective product on shop/category page
          const productId = resp.product_id;
          let liProduct = $(`.post-${productId}`);

          // make it works with shortcodes, eg.: [add_to_cart id="XX"]
          if (!liProduct.length) {
            liProduct = $(`[data-product_id="${productId}"]`).parent();
          }

          // update the quantity input to keep in sync with minicart
          if (liProduct.length) {
            liProduct.find(".qty").val(newQuantity);
          }

          // update shop product quantity if exists, for the cases where qty changed to zero in minicart
          if (newQuantity == 0) {
            dsReplicateMiniCartQtyWithShop();
          }

          dsUnblockProductsUI();
        },
      });
    };
    var dsRemoveFromCart = function (link) {
      dsEnqueueAjax({
        data: {
          action: "ds_delete_item_checkout",
          data_remove_link: link.data("remove"),
        },
        type: "post",
        url: ds.ajax_url,
        beforeSend() {
          dsBlockProductsUI($(".cart-popup"));
        },
        success(response) {
          $(document.body).trigger("updated_wc_div");
          $(document.body).trigger("wc_update_cart");

          dsUnblockProductsUI();
        },
      });
    };
    var dsReplicateMiniCartQtyWithShop = function () {
      $(".widget_shopping_cart")
        .find(".qty")
        .each(function () {
          const input = $(this);
          const qty = $(this).val();
          const name = $(this).attr("id");

          $(".qty").each(function () {
            if ($(this).attr("id") == name) {
              $(this).val(qty);
            }
          });
        });

      $(".products")
        .find(".qty")
        .each(function () {
          const input = $(this);
          const qty = $(this).val();
          const name = $(this).attr("id");

          if (!$(".widget_shopping_cart").find(`#${name}`).length) {
            $(this).val(0);
          }
        });
    };

    const dsListenMiniCartQtyChange = function () {
      $(document.body).on("change", "div.cart-popup .qty", function () {
        return dsChangeCartItemQuantity($(this));
      });
    };

    // synchronization from minicart quantity input to shop/single product page
    var dsChangeCartItemQuantity = function (qtyElement) {
      const matches = qtyElement.attr("name").match(/cart\[(\w+)\]/);
      const cartItemKey = matches[1];
      const inputId = qtyElement.attr("id");

      // run code with timeout
      dsProClearUpdateSyncTimeout();
      dsUpdateSyncTimeout = setTimeout(() => {
        dsMiniCartAjaxQuantityChange(cartItemKey, inputId, qtyElement.val());
      }, 500);
    };

    var dsProClearUpdateSyncTimeout = function () {
      // clear previous timeout, if exists
      if (dsUpdateSyncTimeout !== null) {
        clearTimeout(dsUpdateSyncTimeout);
      }
    };

    const dsBlockUI = function (element) {
      element.block({
        message: null,
        overlayCSS: {
          background: "#fff",
          opacity: 0.6,
        },
      });
    };

    const dsUnblockUI = function (element) {
      element.unblock();
    };

    var dsBlockProductsUI = function (element) {
      if (element != null) {
        dsBlockUI(element);
      } else if ($(".product").length && !ds.isShop) {
        dsBlockUI($(".product"));
      } else {
        dsBlockUI($(".products"));
      }
    };

    var dsUnblockProductsUI = function () {
      dsUnblockUI($(".products"));
      dsUnblockUI($(".product"));
      dsUnblockUI($(".widget_shopping_cart"));
      dsUnblockUI($(".cart-popup"));
    };

    const dsHandleCommonCartEvents = function () {
      $(document).on("added_to_cart", () => {
        console.log("added to cart");
        dsUnblockProductsUI();
        $(".cart-popup").addClass("active");
        $("html, body").addClass("cart-popup-open");
        const notify = $(".site-header__account-cart .cart-notify");
        notify.addClass("active");
        setTimeout(() => notify.removeClass("active"), 3000);
      });
    };

    // init calls
    dsListenMiniCartQtyChange();
    dsHandleCommonCartEvents();
  });
}
