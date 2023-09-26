/**
 * My account pages sidebar, toggle on click
 */

const showSidebarBtn = document.getElementById("show-my-acc-sidebar");
const hideSidebarBtn = document.getElementById("hide-my-acc-sidebar");

const sidebarEl = document.querySelector(".woocommerce-navigation-wrapper");

export function myAccSidebarToggle() {
  if (showSidebarBtn) {
    showSidebarBtn.addEventListener("click", (ev) => {
      _onShowSidebarClick();
    });
  }

  if (hideSidebarBtn) {
    hideSidebarBtn.addEventListener("click", (ev) => {
      _onHideSidebarClick();
    });
  }
}

/**
 * Show sidebar, replace visible filter button
 */
function _onShowSidebarClick() {
  sidebarEl.classList.add("is-visible");

  showSidebarBtn.classList.remove("is-active");
  hideSidebarBtn.classList.add("is-active");
}

/**
 * Hide sidebar, replace visible filter button
 */
function _onHideSidebarClick() {
  sidebarEl.classList.remove("is-visible");

  hideSidebarBtn.classList.remove("is-active");
  showSidebarBtn.classList.add("is-active");
}
