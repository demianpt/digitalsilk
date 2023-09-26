// Blog
import { toggleDarkMode } from './blog/darkmode';
import tableOfContents from './blog/toc-highlight';
import tocSticky from './blog/toc-sticky';

document.addEventListener('DOMContentLoaded', () => {

    toggleDarkMode('.js-dark-mode');

    if (document.querySelector('.ez-toc-toggle')) {
        tocSticky();
        tableOfContents();
    }

});