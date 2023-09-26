/**
 * Search Overlay
 */
import { u_hideElem, u_showElem } from "../utils/u_show-hide-display";

export function searchOverlay() {

    const target = document.querySelector('[data-js="search-target"]');

    // When Search Overlay exists
    if (target) {
        const input = target.querySelector('.search-submit')

        let showOverlay = function() {
            u_showElem(target);
            input.focus();
            // document.body.classList.add('overflow-hidden');
        };

        let closeOverlay = function() {
            u_hideElem(target);
            // document.body.classList.remove('overflow-hidden');
        };

        document.addEventListener('click', function(e) {

            // Trigger submit when opened
            if (e.target.matches('[data-js="search-trigger"]') && target.classList.contains('is-shown')) {
                input.click();
            }

            // Open an overlay
            if (e.target.matches('[data-js="search-trigger"]')) {
                e.preventDefault();
                showOverlay();
            }

            // Close an overlay
            if (e.target.matches('[data-js="search-close"]')) {
                e.preventDefault();
                closeOverlay();
            }
        }, false);

        document.addEventListener('keydown', function(e) {
            // Check if the search overlay is opened
            if (document.body.classList.contains('overflow-hidden')) {
                // Close an overlay on Escape key click
                if (e.key === 'Escape' || e.keyCode === 27) {
                    closeOverlay();
                }
            }
        });
    }
}
