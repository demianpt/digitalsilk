import { u_throttled } from '../utils/utils';

/**
 * Add class on scroll for sticky header
 * @param {string} el - selector for adding an active class
 * @param {string} elClass - active class
 */

export function stickyHeader(el, elClass) {

    const $$header = document.querySelector(el);
    const elHeight = 10;
    const offset = parseInt(elHeight / 5);


    const onScroll = () => {
        if (window.pageYOffset > (elHeight + offset)) {
            $$header.classList.add(elClass);
        } else if (window.pageYOffset < (elHeight - offset)) {
            $$header.classList.remove(elClass);
        }
    };

    const throttleScroll = u_throttled(() => {
        onScroll();
    }, 30);

    window.addEventListener('scroll', () => {
        throttleScroll();
    });

    if (window.pageYOffset > (elHeight + offset)) {
        $$header.classList.add(elClass);
    }

}
