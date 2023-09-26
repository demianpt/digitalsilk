class DSMPTabsClass {

    constructor() {
        this.eventsListeners = {};
        this.currentIndex = 0;
        this.activeNav = null;
        this.activePanel = null;
    }

    bindFunctions() {
        this.tabNavClick = this.tabNavClick.bind(this);
    }

    bindTabNavEvent() {
        const self = this;
        const elem = self.items;

        elem.forEach((tab) => {
            tab.addEventListener('click', self.tabNavClick, { passive: true });
        });
    }

    unbindTabNavEvent() {
        const self = this;
        const elem = self.items;

        elem.forEach((tab) => {
            tab.removeEventListener('click', self.tabNavClick);
        });
    }

    tabNavClick(ev) {
        const self = this;
        const currentTab = ev.currentTarget;
        self.activeNav = ev.currentTarget;
        const currentSelector = currentTab.closest(self.config.wrapper);
        const elem = currentSelector.querySelectorAll(self.config.selectors.nav);
        const currentTabID = self.getNavTabID(currentTab);

        self.clearActiveClass(elem, 'nav');
        self.setActiveClass(currentTab, 'nav');
        self.tabPanelChange(currentTabID);
    }

    tabPanelChange(index) {
        const self = this;

        if (typeof index === 'undefined') {
            return;
        }
        const currentPanelID = `${self.config.data}-${index}`;
        const currentPanel = document.querySelector(`#${currentPanelID}`);
        self.activePanel = currentPanel;
        const currentPanelHolder = currentPanel.closest(self.config.wrapper);
        const elem = currentPanelHolder.querySelectorAll(self.config.selectors.panel);

        if (typeof currentPanel === 'undefined') {
            return;
        }

        self.currentIndex = index;

        self.clearActiveClass(elem, 'panel');
        self.setActiveClass(currentPanel, 'panel');
        self.emit('tabsChange');
    }

    getNavTabID(index) {
        const self = this;
        const dataID = index.getAttribute(self.config.data);
        return dataID;
    }

    clearActiveClass(elem, section) {
        const self = this;
        elem.forEach((tab) => {
            tab.classList.remove(self.config.classes.active);

            if (section === 'panel') {
                tab.setAttribute('aria-hidden', true);
            }
            if (section === 'nav') {
                tab.setAttribute('aria-selected', false);
            }
        });
    }

    setActiveClass(elem, section) {
        const self = this;
        elem.classList.add(self.config.classes.active);
        if (section === 'panel') {
            elem.setAttribute('aria-hidden', false);
        }
        if (section === 'nav') {
            elem.setAttribute('aria-selected', true);
        }
    }

    setFirstActive(i = 0) {
        const self = this;
        const elems = self.items;
        const currentTab = elems[i];
        const currentSelector = currentTab.closest(self.config.wrapper);
        const elem = currentSelector.querySelectorAll(self.config.selectors.nav);
        const currentTabID = self.getNavTabID(currentTab);

        self.clearActiveClass(elem, 'nav');
        self.setActiveClass(currentTab, 'nav');
        self.tabPanelChange(currentTabID);
    }

    on(events, callback) {
        const self = this;
        if (typeof callback !== 'function') return;

        events.split(' ').forEach((event, i) => {
            if (!self.eventsListeners[event]) self.eventsListeners[event] = [];
            self.eventsListeners[event].push(callback);
        });
    }

    off(events, handler) {
        const self = this;
        if (!self.eventsListeners) return;
        events.split(' ').forEach((event) => {
            if (typeof handler === 'undefined') {
                self.eventsListeners[event] = [];
            } else if (self.eventsListeners[event]) {
                self.eventsListeners[event].forEach((eventHandler, index) => {
                    if (eventHandler === handler) {
                        self.eventsListeners[event].splice(index, 1);
                    }
                });
            }
        });
    }

    emit(...args) {
        const self = this;

        if (!self.eventsListeners) return self;
        let events;
        let data;
        let context;

        if (typeof args[0] === 'string' || Array.isArray(args[0])) {
            events = args[0];
            data = args.slice(1, args.length);
            context = self;
        } else {
            events = args[0].events;
            data = args[0].data;
            context = args[0].context || self;
        }

        //console.log(events, data, context);
        data.unshift(context);
        const eventsArray = Array.isArray(events) ? events : events.split(' ');

        eventsArray.forEach((event) => {
            if (self.eventsListeners && self.eventsListeners[event]) {
                self.eventsListeners[event].forEach((eventHandler) => {
                    eventHandler.apply(context, data);
                });
            }
        });
    }

}

export default DSMPTabsClass;