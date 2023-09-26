import DSMPTabsClass from './DSMPTabsClass';
import { u_extendObject } from '../../utils/u_object_extend';

class DSMPTabsDropdown extends DSMPTabsClass {

    constructor(options) {
        super();
        this.defaults = {
            wrapper: '.js-tabsDrop-wrapper',
            selectors: {
                dropdown: '.js-tabs-dropdown',
                panel: '.js-tabs-panel',
            },
            classes: {
                active: 'is-active',
            },
            data: 'data-tab',
        };

        this.config = u_extendObject(this.defaults, options);

        this.selectorDropdown = `${this.config.wrapper} ${this.config.selectors.dropdown}`;

        this.itemsDropdown = document.querySelectorAll(this.selectorDropdown);

        this.init();
    }

    init() {
        this.bindFunctions();
        this.bindTabsDropdownEvent();
    }

    bindFunctions() {
        this.tabDropdownChange = this.tabDropdownChange.bind(this);
    }

    bindTabsDropdownEvent() {
        const self = this;
        const dropdowns = self.itemsDropdown;

        dropdowns.forEach((dropdown) => {
            dropdown.addEventListener('change', self.tabDropdownChange);
        });
    }

    tabDropdownChange(ev) {
        const currDropdown = ev.currentTarget;
        const currentTabID = currDropdown.value;
        const currentIndex = currDropdown.options.selectedIndex;

        for (let i = 0; i < currDropdown.options.length; i += 1) {
            currDropdown.options[i].removeAttribute('selected');
        }
        currDropdown.options[currentIndex].setAttribute('selected', 'selected');

        super.tabPanelChange(currentTabID);
    }

    unbindTabsDropdownEvent() {
        const self = this;
        const dropdowns = self.itemsDropdown;

        dropdowns.forEach((dropdown) => {
            dropdown.removeEventListener('change', self.tabDropdownChange);
        });
    }

}

export default DSMPTabsDropdown;
