import {u_slideDown, u_slideUp} from "../utils/u_slide-up-down";

const toggleSubmenu = () => {

    let selector = document.querySelector('.nav-main .nav-main__links');
    let items;
    if (selector) {
        items = selector.querySelectorAll('.nav-main .menu-item.menu-item-has-children');
    }

    if (items) {

        items.forEach((btn, i) => {

            const submenu = btn.querySelector('.sub-menu');
            if (btn.classList.contains('current-menu-parent')) {
                btn.classList.add('is-toggled');
                btn.setAttribute('aria-expanded', 'true');
            } else {
                btn.setAttribute('aria-expanded', 'false');
                u_slideUp(submenu);
            }

            btn.addEventListener('click', (ev) => {
                if (ev.target.tagName.toLowerCase() === 'a') {
                    return;
                }

                if (btn.classList.contains('is-toggled')) {
                    u_slideUp(submenu);
                    btn.classList.remove('is-toggled');
                    btn.setAttribute('aria-expanded', 'false');
                } else {
                    items.forEach((item, j) => {
                        const submenu = item.querySelector('.sub-menu');
                        if (item.classList.contains('is-toggled')) {
                            u_slideUp(submenu);
                            item.classList.remove('is-toggled');
                            item.setAttribute('aria-expanded', 'false');
                        }
                    });
                    btn.classList.add('is-toggled');
                    btn.setAttribute('aria-expanded', 'true');
                    u_slideDown(submenu);
                }
            });
        });
    }
}

export {
    toggleSubmenu
}
