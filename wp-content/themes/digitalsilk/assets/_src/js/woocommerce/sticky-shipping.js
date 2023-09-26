import { u_throttled } from "../utils/utils";

/**
 * Sticky shipping bar
 */

const shippingBarEl = document.getElementById("shipping-bar");

export function stickyShippingBar() {
  if (
    shippingBarEl &&
    shippingBarEl.classList.contains("sticky") &&
    !shippingBarEl.classList.contains("expandable")
  ) {
    _stickyShippingBarInit(10);
  }
}

/**
 * Add/remove class  on scroll
 */
function _stickyShippingBarInit(offset) {
  const onScroll = () => {
    if (window.pageYOffset > offset) {
      shippingBarEl.classList.add("expandable");
    } else {
      shippingBarEl.classList.remove("expandable");
    }
  };

  const throttleScroll = u_throttled(() => {
    onScroll();
  }, 30);

  window.addEventListener("scroll", () => {
    throttleScroll();
  });
}
