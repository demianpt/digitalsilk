/**
 * Shop page sidebar, toggle on click
 */

const showFilterBtn = document.getElementById("show-filter");
const hideFilterBtn = document.getElementById("close-filter");
const hideFilterMobileBtn = document.getElementById("close-filter-mobile");
const mobileSidebarOverlayEl = document.getElementById("close-filter-mobile-overlay");

const sidebarWrapper = document.querySelector(".woocommerce-archive-content");
const sidebar = document.querySelector(".woocommerce-sidebar");

export function sidebarToggle() {
  // Show sidebar on button click
  if (showFilterBtn) {
    showFilterBtn.addEventListener("click", (ev) => {
      _onShowSidebarClick();
    });
  }

  // Hide sidebar on button click
  if (hideFilterBtn) {
    hideFilterBtn.addEventListener("click", (ev) => {
      _onHideSidebarClick();
    });
  }

  // Hide mobile sidebar on button click
  if (hideFilterMobileBtn) {
    hideFilterMobileBtn.addEventListener("click", (ev) => {
      _onHideMobileSidebarClick();
    });
  }

  // Hide mobile sidebar on overlay click
  if (mobileSidebarOverlayEl) {
    mobileSidebarOverlayEl.addEventListener("click", (ev) => {
      _onHideMobileSidebarClick();
    });
  }
}

/**
 * Show sidebar, replace visible filter button
 */
function _onShowSidebarClick() {
  sidebarWrapper.classList.add("-has-sidebar");
  sidebar.classList.add("is-visible", "is-visible-on-mobile");

  showFilterBtn.classList.remove("is-active");
  hideFilterBtn.classList.add("is-active");
}

/**
 * Hide sidebar, replace visible filter button
 */
function _onHideSidebarClick() {
  sidebarWrapper.classList.remove("-has-sidebar");
  sidebar.classList.remove("is-visible");

  hideFilterBtn.classList.remove("is-active");
  showFilterBtn.classList.add("is-active");
}

/**
 * Hide mobile sidebar
 */
function _onHideMobileSidebarClick() {
  sidebar.classList.remove("is-visible-on-mobile");
}
