/*
 * @title Main App
 * @description Application entry point
 */

// Header
import { stickyHeader } from './header/sticky-header';
import { searchOverlay } from './header/search-overlay';
import { mobileNav } from './header/mobile-nav';
import { toggleSubmenu } from './header/toggle-submenu';

// function calls
import { callSliders } from './function-calls/sliders';
import { callAccordions } from './function-calls/accordions';
import { callTabAccordionsMobile } from './function-calls/tabs-to-accordion-mobile';

// utils
import { u_addTouchToHtml } from './utils/u_is-touch-device';

// libraries
import TabAccordion from './library/tabs-accordions/tab-accordion';

import DSMPTab from './library/tabs-accordions/tab-single';
import DSMPTabsTab from './library/tabs-accordions/DSMPTabs-tab';
import DSMPTabsDropdown from "./library/tabs-accordions/DSMPTabs-dropdown";
import DSMPTabsTabDropdown from "./library/tabs-accordions/DSMPTabs-tabdropdown";

import DSMPMediaControls from './library/media-controls/media-control';

import { callAccordionsLight } from './function-calls/accordions-light';

import PureCounter from './library/counters/purecounter';
import gridderInit from './library/collapsers/gridder-init';
import blogFilter from './blog/blog-filter';

// import ProgressCircleCounter from "./library/counters/progress-counter";
// import { scrollEffect } from './utils/scroll-effect';

document.addEventListener('DOMContentLoaded', () => {

    // check whether it is touch device or not
    u_addTouchToHtml();

    // Header
    stickyHeader('.site-header', 'is-sticky');
    searchOverlay();

    if (window.matchMedia("(max-width: 1024px)").matches) {
        mobileNav('.js-mobileNav');
        toggleSubmenu();
    }

    // scrollEffect();

    new PureCounter({
        selector: '.c-counter__number',
    });

    new TabAccordion();

    gridderInit();

    new DSMPMediaControls();

    callSliders();
    callAccordions();
    callAccordionsLight();

    new DSMPTab();
    new DSMPTabsTab();
    new DSMPTabsDropdown();
    new DSMPTabsTabDropdown();

    if (document.querySelector('.js-ajax-block')) {
        blogFilter();
    }

    callTabAccordionsMobile();

/*    new ProgressCircleCounter({
        percentage: 80,
    });*/

});

// Vendors libs

AOS.init({
    disable: 'mobile',
    offset: 300,
    once: true,
    duration: 800,
});

window.addEventListener('load', AOS.refresh);


// ds_generate_image depends on this lib
const myLazyLoad = new LazyLoad({
  elements_selector: '.lazy',
});

