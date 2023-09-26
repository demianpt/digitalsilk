/**
 * Toggle mobile nav
 * @param {string} el - selector for adding an active class
 */

export function mobileNav(el) {

    if (document.querySelector(el)) {

        const btn = document.querySelector(el);
        const body = document.querySelector('body');

        btn.addEventListener('click', event => {
            event.preventDefault();
            if (btn.getAttribute('aria-expanded') === 'false') {
                btn.classList.add('is-active');
                body.classList.add('nav-active');
                btn.setAttribute('aria-expanded', 'true')
            } else {
                btn.classList.remove('is-active');
                body.classList.remove('nav-active');
                btn.setAttribute('aria-expanded', 'false')
            }
        })

    }
}
