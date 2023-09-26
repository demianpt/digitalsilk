import { u_throttled } from "./utils";

/**
 * standalone function that checks whether device is touch or not
 * call it within anything,
 * @returns {boolean}
 */
const u_isTouchDevice = () => {
    return (
        !!(typeof window !== 'undefined' &&
            ('ontouchstart' in window ||
                (window.DocumentTouch &&
                    typeof document !== 'undefined' &&
                    document instanceof window.DocumentTouch))) ||
        !!(typeof navigator !== 'undefined' &&
            (navigator.maxTouchPoints || navigator.msMaxTouchPoints))
    );
}

/**
 * function that calls isTouchDevice function,
 */
const isTouchHtmlUtil = () => {
    let touch = u_isTouchDevice();
    let html = document.getElementsByTagName( 'html' )[0];

    // if true, add touch-device to html, otherwise no-touch-device
    if (touch) {
        html.classList.remove('no-touch-device');
        html.classList.add('touch-device');
    }
    else {
        html.classList.remove('touch-device');
        html.classList.add('no-touch-device');
    }
}

/**
 * exported function addTouchToHtmlUtil
 * imported into index.js and called when DOMReady,
 * contains 'resize' event listener to check for
 * device orientation, or changes
 * is throttled, to prevent continuously triggering
 * (min 300ms so chrome dev tool can catch it)
 */
const u_addTouchToHtml = () => {
    isTouchHtmlUtil();

    // throttle the function
    const throttleIsTouch = u_throttled(() => {
        isTouchHtmlUtil();
    }, 300);

    // bind resize event
    window.addEventListener('resize', () => {
        throttleIsTouch();
    });
}

export {
    u_isTouchDevice,
    u_addTouchToHtml
};

