/**
 * Handling custom CSS property for scrolling effects
 **/

export function u_scrollEffect() {

    if (document.querySelector('.pr-scroll')) {
        window.addEventListener('scroll', function (evt) {
            if (window.scrollY < 600) {
                document.querySelector('.pr-scroll').style.setProperty('--scrolly', window.scrollY);
            }
        }, {capture: false, passive: true});
    }
}

