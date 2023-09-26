/**
 * TODO: Review this....I don't think we need this code
 */

export function categoryToggle() {
  // add a new toggle element after the parent category anchor
  $("<div class='cat-toggle'></div>").insertAfter(
    ".woocommerce-sidebar-widgets ul > .cat-item.cat-parent > a"
  );
  $("<div class='cat-toggle'></div>").insertAfter(
    ".woocommerce-sidebar-widgets ul > .menu-item.menu-item-has-children > a"
  );
  // when the new toggle element is clicked, add/remove the class that controls visibility of children
  $(".woocommerce-sidebar-widgets ul .cat-toggle").click(function () {
    $(this).toggleClass("cat-popped");
    $(this).parent().toggleClass("active");
  });
  // if the parent category is the current category or a parent of an active child, then show the children categories too
  $(
    ".woocommerce-sidebar-widgets .widget_product_categories .product-categories > .cat-item.cat-parent"
  ).each(function () {
    if ($(this).is(".current-cat, .current-cat-parent")) {
      $(this).children(".cat-toggle").toggleClass("cat-popped");
    }
  });

  $(window).on("load", () => {
    if ($(".woocommerce-sidebar-widgets li").hasClass("current-menu-item")) {
      $(".woocommerce-sidebar-widgets .current-menu-ancestor").each((index, ancestor) => {
        $(ancestor).addClass("active");
        $(ancestor)
          .find(".current-menu-item")
          .closest(".current-menu-parent")
          .children(".cat-toggle")
          .addClass("cat-popped");
      });
    }
  });
}
