// eslint-disable-next-line camelcase
import { u_elementFromTop } from '../utils/u_el-in-viewport-detect';

export default function tocSticky() {

    window.addEventListener('scroll', () => {
        u_elementFromTop(document.querySelectorAll('#ez-toc-container + *'), '#ez-toc-container', 'is-float', 10, 'pixels'); // as top of element hits top of viewport
    }, false);

    window.addEventListener('resize', () => {
        u_elementFromTop(document.querySelectorAll('#ez-toc-container + *'), '#ez-toc-container', 'is-float', 10, 'pixels'); // as top of element hits top of viewport
    }, false);

    function tocToggleClasses() {
        const tocCollapser = document.querySelector('.ez-toc-toggle');
        const tocContainer = document.querySelector('.ez-toc-title-toggle');

        const target = document.querySelector('.ez-toc-list');

        if (window.getComputedStyle(target).display === 'block') {
            tocCollapser.classList.add('active');
        }

        tocCollapser.addEventListener('click', (event) => {

            function mesure() {
                if (window.getComputedStyle(target).display === 'none') {
                    tocCollapser.classList.remove('active');
                    tocContainer.classList.remove('is-shown');
                    tocContainer.classList.add('is-hide');
                } else {
                    tocCollapser.classList.add('active');
                    tocContainer.classList.add('is-shown');
                    tocContainer.classList.remove('is-hide');
                }
            }

            setTimeout(mesure, 300);
        });

        if ($('#ez-toc-container').hasClass('is-shown')) {
            $('.ez-toc-toggle').addClass('active');
        }
    }

    tocToggleClasses();
}
