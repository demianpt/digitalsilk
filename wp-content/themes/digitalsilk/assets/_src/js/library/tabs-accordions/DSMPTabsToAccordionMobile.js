import DSMPAccordions from "./DSMPAccordions";
import DSMPTabsTab from "./DSMPTabs-tab";
import {u_throttled} from "../../utils/utils";



class DSMPTabToAccordionMobile {
    constructor(selector) {
        this.tabaccID = '#js-tab-acc';
        this.tabaccSelector = '.js-tabs-to-acc-wrapper';
        this.tabaccItems = document.querySelectorAll(this.tabaccSelector);

        this.tabOptions = {
            wrapper:        '.js-tabs-wrapper',
            selectors: {
                nav:        '.js-tabs-nav-item',
                panel:      '.js-tabs-panel',
            }
        }
        this.accordionOptions = {
            selectors: {
                item:       '.js-tabs-panel',
                trigger:    '.js-tabs-label',
                content:    '.js-ta-content'
            },
            opt : {
                close:          true,
                expand:         true,
            },
            classes: {
                display:      'flex',
            },
            animation: {
                content:    true
            },
        }
        this.isMobile = false;
        this.isDesktop = false;

        this.accordionInstance;
        this.tabInstance;

        if(typeof selector !== "undefined") {
            this.tabaccID = selector;
        }

        this.init();
    }

    init() {
        let self = this;
        let currentWidth = window.innerWidth;
        currentWidth < 1025 ? this.isMobile = true : this.isDesktop = true;

        if(self.isMobile) self.buildAccordion();
        if(self.isDesktop) self.buildTab();

        window.addEventListener('resize', () => {
            self.throttleScroll();
        });


        this.throttleScroll = u_throttled(() => {
            self.buildTabAccordion();
        }, 150);


        self.buildTabAccordion();
    }

    buildTabAccordion() {
        let self = this;
        let newWidth = window.innerWidth;

        if(newWidth < 1025) {
            if(!self.isMobile) {
                if(typeof self.tabInstance !== "undefined") {
                    self.tabInstance.unbindTabNavEvent();
                    self.tabInstance = undefined;
                }
                self.buildAccordion();
                self.isDesktop = false;
                self.isMobile = true;
            }
        }
        else {
            if(!self.isDesktop) {
                if(typeof self.accordionInstance !== "undefined") {
                    self.accordionInstance.accordionUnbindEvents();
                    self.accordionInstance = undefined;
                }

                self.buildTab();
                self.isMobile = false;
                self.isDesktop = true;
            }
        }
    }

    buildAccordion() {
        this.accordionInstance = new DSMPAccordions(this.tabaccID, this.accordionOptions);
    }

    buildTab() {
        this.tabOptions.wrapper = this.tabaccID;
        this.tabInstance = new DSMPTabsTab(this.tabOptions);
        this.tabInstance.setFirstActive();
    }

}
export default DSMPTabToAccordionMobile;