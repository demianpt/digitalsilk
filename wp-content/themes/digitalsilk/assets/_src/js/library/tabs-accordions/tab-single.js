import { scrollToUtil } from "../animations/scroll-to";
import { easeInOutQuart } from "../animations/easings-es6";
import { u_throttled } from "../../utils/utils";
import { u_slideDown, u_slideUp } from "../../utils/u_slide-up-down";
import { u_isElementIsInView } from "../../utils/u_el-in-viewport-detect";

/**
 * TODO:
 * DO NOT USE THIS, STILL IN DEVELOPMENT
 */

class DSMPTab {
    constructor(aos) {
        this.scroll = {};
        this.selector = '.js-tabs-nav .c-tabs-nav__link';
        this.mobileSelector = '.js-tabs-panel .l-tabs__label';

        this.items = document.querySelectorAll(this.selector);
        this.itemsMobile = document.querySelectorAll(this.mobileSelector);

        this.aos = aos;

        this.init();
    }

    init() {
        let self = this;
        self.bindChangeTab = this.changeTab.bind(this);
        self.bindChangeSlide = this.changeSlide.bind(this);
        self.bindScrollAccordion = this.scrollAccordion.bind(this);
        self.bindResizeAccordion = this.resizeAccordion.bind(this);



        [...self.items].forEach((tab) => {
            tab.addEventListener('click', self.bindChangeTab);
        });

        [...self.itemsMobile].forEach((label) => {
            label.addEventListener('click', self.bindChangeSlide);
        })

        window.addEventListener('resize', () => {
            throtleResizeAccordion();
        })

        const throtleResizeAccordion = u_throttled(() => {
            self.bindResizeAccordion();
        }, 250);

        const throtleAccordionScroll = u_throttled(() => {
            self.bindScrollAccordion();
        }, 150);

        self.bindResizeAccordion();
    }


    changeTab(ev) {
        let self = this;
        ev.preventDefault();
        let currentItemClicked = ev.currentTarget;
        let tabItem = currentItemClicked.getAttribute('aria-controls');

        let currentItem = currentItemClicked.closest('.c-tabs-nav__item');

        let currentList = currentItemClicked.closest('.js-tabs-nav');

        let items = currentList.querySelectorAll('.c-tabs-nav__link');

        if(!currentItemClicked.classList.contains('is-active'))
        {
            items.forEach((item, i) => {
                item.classList.remove('is-active');
                item.setAttribute('aria-selected', 'false')
            });
            currentItemClicked.classList.add('is-active');
            currentItemClicked.setAttribute('aria-selected', 'true')
        }

        let tabsPanel = document.querySelectorAll('.js-tabs-panel .l-tabs__panel');

        tabsPanel.forEach((tabs, i) => {
            tabs.classList.remove('is-active', 'is-current');
            tabs.setAttribute('aria-hidden', 'true')
        });
        tabsPanel.forEach((tabbed, i) => {
            let currentTab = tabbed.getAttribute('id');
            if(currentTab === tabItem) {
                tabbed.classList.add('is-active', 'is-current');
                tabbed.setAttribute('aria-hidden', 'false');
            }
        });
    }

    changeSlide(ev) {
        let self = this;
        ev.preventDefault();

        let currentItemClicked = ev.currentTarget;

        let currentItem = currentItemClicked.closest('.l-tabs__panel');
        let currentContent = currentItem.querySelector('.l-tabs__content');

        let elems = document.querySelectorAll('.js-tabs-panel .l-tabs__panel');
        elems.forEach((label, i) => {
            if(label === currentItem) {
                if(!currentItem.classList.contains('is-current')) {
                    currentItem.classList.add('is-current');
                }
            }
            else {
                label.classList.remove('is-current');
            }
        })

        if(currentItem.classList.contains('is-active'))
        {
            let scrollCurrentContent = currentContent.offsetTop;
            let currentScrollPos = window.pageYOffset || document.documentElement.scrollTop;

            let scrollTo = currentContent.offsetTop - 99;

            if(currentScrollPos > scrollCurrentContent - 50) {
                scrollToUtil ({
                    to: scrollTo,
                    duration: 200,
                    easing: easeInOutQuart
                });
                // window.scrollTo( {
                //     top: scrollTo
                // })
            }

            u_slideUp(currentContent);
            currentItem.classList.remove('is-active');
            currentItem.classList.remove('is-current');
        }
        else {
            u_slideDown(currentContent, {
                display: 'flex'
            });
            currentItem.classList.add('is-active');


        }
    }

    scrollAccordion() {
        let self = this;
        let currentWidth = window.innerWidth;

        let isCurrent = [];
        let elems = document.querySelectorAll('.js-tabs-panel .l-tabs__content');
        elems.forEach((label, i) => {
            let elemItem =  label.closest('.l-tabs__panel');
            if(elemItem.classList.contains('is-active')){
                if(u_isElementIsInView(label)) {
                    isCurrent.push(i);
                }
            }
        })

        let currentLength = isCurrent.length;

        if(currentLength > 0) {
            elems.forEach((item, j) => {
                let elemItem = item.closest('.l-tabs__panel');

                if(isCurrent[0] === j) {
                    if(!elemItem.classList.contains('is-current')) {
                        elemItem.classList.add('is-current');
                    }
                }
                else {
                    elemItem.classList.remove('is-current');
                }
            })
        }
    }

    resizeAccordion() {
        let self = this;
        let currentWidth = window.innerWidth;


        if(currentWidth > 1024) {

            let elems = document.querySelectorAll('.js-tabs-panel .l-tabs__content');
            let current = 0;
            elems.forEach((label, i) => {
                let elemItem =  label.closest('.l-tabs__panel');
                if(elemItem.classList.contains('is-current')){
                    current = i;
                }
                elemItem.classList.remove('is-active');
                label.style.display = '';
            })
            if(elems.length > 0) {
                elems[current].closest('.l-tabs__panel').classList.add('is-active');
            }

            let tabsElem = document.querySelectorAll('.js-tabs-nav .c-tabs-nav__link');
            tabsElem.forEach((tab, j) => {
                tab.classList.remove('is-active');
            })
            if(tabsElem.length > 0) {
                tabsElem[current].classList.add('is-active');
            }


            window.removeEventListener('scroll',self.bindScrollAccordion);
        }
        else {
            window.addEventListener('scroll', self.bindScrollAccordion);
        }
    }
}

export default DSMPTab;