import {u_extendObject} from '../../utils/u_object_extend';
import DSMPTabsClass from './DSMPTabsClass';

class DSMPTabsTabDropdown extends DSMPTabsClass {

    constructor(options) {
        super();
        this.defaults = {
            wrapper: '.js-tabsTabDrop-wrapper',
            selectors: {
                nav: '.js-tabs-nav-item',
                dropdown: '.js-tabs-dropdown',
                panel: '.js-tabs-panel',
            },
            classes: {
                active: 'is-active',
            },
            data: 'data-tab',
        };

        this.config = u_extendObject(this.defaults, options);

        this.selectorTabs = `${this.config.wrapper} ${this.config.selectors.nav}`;
        this.selectorDropdown = `${this.config.wrapper} ${this.config.selectors.dropdown}`;

        this.items = document.querySelectorAll(this.selectorTabs);
        this.itemsDropdown = document.querySelectorAll(this.selectorDropdown);

        this.initTabsDropdown();
    }

    initTabsDropdown() {
        this.bindFunctions();
        this.bindTabNavEv();
        this.bindTabsDropdownEvent();
    }

    bindFunctions() {
        this.tabDropdownChange = this.tabDropdownChange.bind(this);
        this.tabNavClick = this.tabNavClick.bind(this);
    }

    bindTabsDropdownEvent() {
        const self = this;
        const dropdowns = self.itemsDropdown;

        dropdowns.forEach((dropdown) => {
            dropdown.addEventListener('change', self.tabDropdownChange);
        });
    }

    bindTabNavEv() {
        const self = this;
        const elem = self.items;

        elem.forEach((tab) => {
            tab.addEventListener('click', self.tabNavClick, { passive: true });
        });
    }

    tabNavClick(ev) {
        const self = this;
        const currentTab = ev.currentTarget;
        const currentTabID = super.getNavTabID(currentTab);
        const currentSelector = currentTab.closest(self.config.wrapper);
        const currentDropdown = currentSelector.querySelector(self.config.selectors.dropdown);

        let newIndex;
        for (let i = 0; i < currentDropdown.options.length; i += 1) {
            if (currentDropdown.options[i].value === currentTabID) {
                newIndex = i;
            }
        }

        self.updateTabNav(currentTab);
        self.updateDropdown(currentDropdown, newIndex);
        super.tabPanelChange(currentTabID);
    }

    tabDropdownChange(ev) {
        const self = this;
        const currDropdown = ev.currentTarget;
        const currentIndex = currDropdown.options.selectedIndex;

        const currentTabID = currDropdown.value;
        const currentNavItem = document.querySelector(`[${self.config.data}='${currentTabID}']`);

        self.updateDropdown(currDropdown, currentIndex);
        self.updateTabNav(currentNavItem);
        super.tabPanelChange(currentTabID);
    }

    updateDropdown(currentDrop, newDropIndex) {
        const self = this;
        const currDropdown = currentDrop;
        const currentIndex = newDropIndex;

        for (let i = 0; i < currDropdown.options.length; i += 1) {
            currDropdown.options[i].removeAttribute('selected');
        }
        currDropdown.options[currentIndex].setAttribute('selected', 'selected');
        currDropdown.options.selectedIndex = currentIndex;
    }

    updateTabNav(currTab) {
        const self = this;
        const currentTab = currTab;
        self.activeNav = currTab;
        const currentSelector = currentTab.closest(self.config.wrapper);
        const elem = currentSelector.querySelectorAll(self.config.selectors.nav);

        super.clearActiveClass(elem, 'nav');
        super.setActiveClass(currentTab, 'nav');
    }

    unbindTabsDropEvents() {
        const self = this;
        const dropdowns = self.itemsDropdown;
        const elem = self.items;

        elem.forEach((tab) => {
            tab.removeEventListener('click', self.tabNavClick);
        });

        dropdowns.forEach((dropdown) => {
            dropdown.removeEventListener('change', self.tabDropdownChange);
        });
    }

}

export default DSMPTabsTabDropdown;
