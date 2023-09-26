// Woocommerce
import { updateCart } from "./woocommerce/cart";
import { ajax } from "./woocommerce/ajax";

import { sidebarToggle } from "./woocommerce/sidebar-toggle";
import { categoryToggle } from "./woocommerce/category-toggle";

import { singleProductGallery } from "./woocommerce/single-product/gallery";
import { singleProductQuantity } from "./woocommerce/single-product/product-quantity";
import { stickyShippingBar } from "./woocommerce/sticky-shipping";

import { myAccSidebarToggle } from "./woocommerce/my-account/sidebar-toggle";

document.addEventListener("DOMContentLoaded", () => {
  ajax();

  // Cart page
  updateCart();

  // Porduct listing page
  sidebarToggle();
  // categoryToggle();

  // Single product page
  singleProductGallery();
  singleProductQuantity();
  stickyShippingBar();

  // My account pages
  myAccSidebarToggle();
});
