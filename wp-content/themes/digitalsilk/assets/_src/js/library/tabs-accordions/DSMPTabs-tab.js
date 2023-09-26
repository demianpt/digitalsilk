import DSMPTabsClass from './DSMPTabsClass';
import { u_extendObject } from '../../utils/u_object_extend';

class DSMPTabsTab extends DSMPTabsClass {

    constructor(options) {
        super();
        this.defaults = {
            wrapper: '.js-tabs-wrapper',
            selectors: {
                nav: '.js-tabs-nav-item',
                panel: '.js-tabs-panel',
            },
            classes: {
                active: 'is-active',
            },
            data: 'data-tab',
        };

        this.config = u_extendObject(this.defaults, options);

        this.selector = `${this.config.wrapper} ${this.config.selectors.nav}`;

        this.items = document.querySelectorAll(this.selector);

        this.init();
    }

    init() {
        super.bindFunctions();
        super.bindTabNavEvent();
    }

}

export default DSMPTabsTab;
