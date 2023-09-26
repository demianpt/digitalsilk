/**
 * Cart page: Update cart
 */

const cartFormEl = document.querySelector(".woocommerce-cart-form");

export function updateCart() {
  if (cartFormEl) {
    _updateCartInit();
  }
}

function _updateCartInit() {
  $(document.body).on("click", ".item_qty.plus", function (e) {
    e.preventDefault();
    _updateInputQuantity($(this), 1);
  });

  $(document.body).on("click", ".item_qty.minus", function (e) {
    e.preventDefault();
    _updateInputQuantity($(this), -1);
  });
}

/**
 * Update product quantity and trigger cart update
 *
 * @param {string} el
 * @param {number} value
 */
function _updateInputQuantity(el, value) {
  const input = el.parent().find("input.qty");
  const quantity = parseInt(input.val());

  // Check max value
  if (value > 0) {
    const maxAttr = input.attr("max");
    if (typeof maxAttr !== typeof undefined && maxAttr !== false && quantity >= parseInt(maxAttr)) {
      return false;
    }
  }

  // Check min value
  if (value < 0) {
    const minAttr = input.attr("min");
    if (typeof minAttr !== typeof undefined && minAttr !== false && quantity <= parseInt(minAttr)) {
      return false;
    }
  }

  // Update value
  input.val(quantity + value);

  // Trigger cart update
  const updateCartBtn = $("[name='update_cart']");
  updateCartBtn.removeAttr("disabled");

  // TODO: If you want to trigger cart update when you change product quantity, uncomment the line below
  updateCartBtn.trigger("click");
}
