import { u_extendObject } from '../../utils/u_object_extend';
import { u_parseBool } from '../../utils/u_types';
import { u_throttled } from '../../utils/utils';

class SwiperWithCircularTabs {

    constructor(swiper, options) {
        this.defaults = {
            element: '.l-nav',
            item: '.c-nav__item',
            circle: '.c-slider-nav',
            classes: {
                active: 'is-active',
                right: 'is-right',
                left: 'is-left',
                top: 'is-top',
                bottom: 'is-bottom',
            },
            direction: false, // false: clockwise, true: anticlockwise
            position: 2, // position of start item, top: 1, right: 2, bottom: 3, left: 4
            arrange: 0, // arrange 0 = full circle, any other number means angle
            itemAlign: 'center', // center, inside, outside
            itemAngle: 0,
            rotateActive: false,
            data: {
                arrange: 'data-slider-circular-arrange',
                position: 'data-slider-circular-position',
                itemAngle: 'data-slider-circular-angle',
                itemAlign: 'data-slider-circular-item-align', // parsed from backend
                direction: 'data-slider-circular-item-direction',
                rotateActive: 'data-slider-circular-rotate-to-active',
            },
        };

        // if swiper is not initialized, end the script
        if (!swiper.initialized) {
            console.log('swiper not initialized');
            return;
        }

        this.swiper = swiper;

        this.config = u_extendObject(this.defaults, options);

        this.selector = `${this.config.element} ${this.config.item}`;
        this.container = document.querySelector(this.config.element);
        this.circle = this.container.querySelector(this.config.circle);
        this.items = document.querySelectorAll(this.selector);

        this.shift = 0;
        this.multiplier = this.items.length;
        this.numberOfItems = this.items.length;
        this.arrangeShift = 0;
        this.full = 360;
        this.arrangeIndex = 0;
        // reference to click function
        this.tabClicked = this.tabClick.bind(this);
        this.parseOptions();
        this.init();
    }

    init() {
        const self = this;
        self.getContainerRadius();
        self.getItemDimensions();
        // add event that catches slide changes
        self.swiperSlideChange();
        // bind events that catches tabs changes
        self.bindTabs();

        self.updateItemsPositions();

        window.addEventListener('resize', () => {
            self.throttleResize();
        });

        self.throttleResize = u_throttled(() => {
            self.getContainerRadius();
            self.getItemDimensions();
        }, 150);
    }

    bindTabs() {
        const self = this;
        const elem = self.items;

        elem.forEach((tab) => {
            tab.addEventListener('click', self.tabClicked, { passive: true });
        });
    }

    unbindTabs() {
        const self = this;
        const elem = self.items;

        elem.forEach((tab) => {
            tab.removeEventListener('click', self.tabClicked);
        });
    }

    tabClick(ev) {
        const self = this;
        const currentTab = ev.currentTarget;
        const elem = self.items;
        
        let clickedTab;
        elem.forEach((tab, i) => {
            if (currentTab === tab) {
                clickedTab = i;
            }
            tab.classList.remove(self.config.classes.active);
        });

        currentTab.classList.add(self.config.classes.active);
        self.swiper.slideTo(clickedTab);
        if (self.config.rotateActive) {
            self.updateItemsPositions(clickedTab);
        }
    }

    tabChange(index) {
        const self = this;
        const elem = self.items;
        elem.forEach((tab) => {
            tab.classList.remove(self.config.classes.active);
        });

        elem.forEach((tab, i) => {
            if (index === i) {
                tab.classList.add(self.config.classes.active);
            }
        });
    }

    swiperSlideChange() {
        const self = this;

        self.swiper.on('slideChange', () => {
            const currentSlide = self.swiper.activeIndex;
            self.tabChange(currentSlide);
            self.updateItemsPositions(currentSlide);
        });
    }
    
    updateItemsPositions(index) {
        const self = this;
        const elems = self.items;
        let ind;

        if (index == null) {
            ind = self.arrangeIndex;
        } else {
            ind = index;
        }
        
        let angle;
        let rotateShift = 0;

        if (self.config.rotateActive) {
            rotateShift = (ind - self.arrangeIndex) * self.config.itemAngle;
        }

        const { arrangeShift, multiplier, full } = self;

        elems.forEach((circle, i) => {
            if (self.config.direction) {
                angle = full * (i / multiplier) + self.shift - arrangeShift - rotateShift;
            } else {
                angle = -full * (i / multiplier) + self.shift + arrangeShift + rotateShift;
            }

            const itemSideX = Math.cos(angle * (Math.PI / 180)) >= 0 ? 'is-right' : 'is-left';
            const itemSideY = Math.sin(angle * (Math.PI / 180)) <= 0 ? 'is-top' : 'is-bottom';

            circle.classList.add(itemSideX, itemSideY);

            circle.style.setProperty('--az', `${angle}deg`);
        });
    }

    parseOptions() {
        const self = this;

        const arrange = self.container.getAttribute(self.config.data.arrange);
        self.config.position = parseInt(self.container.getAttribute(self.config.data.position), 10);
        // eslint-disable-next-line max-len
        self.config.itemAngle = parseInt(self.container.getAttribute(self.config.data.itemAngle), 10) || self.config.itemAngle;
        const itemAlign = self.container.getAttribute(self.config.data.itemAlign);
        self.config.itemAlign = itemAlign || self.config.itemAlign;
        // eslint-disable-next-line max-len
        self.config.direction = u_parseBool(self.container.getAttribute(self.config.data.direction)) || self.config.direction;
        // eslint-disable-next-line max-len
        self.config.rotateActive = u_parseBool(self.container.getAttribute(self.config.data.rotateActive));

        switch (self.config.position) {

            case 1:
                self.shift = -90;
                break;
            case 3:
                self.shift = 90;
                break;
            case 4:
                self.shift = 180;
                break;
            default:
                self.shift = 0;
                
        }

        let isSemiCircle = false;

        if (self.config.itemAngle
            && (self.config.itemAngle * self.numberOfItems <= self.full)
            && (self.config.itemAngle > 15)) {
            self.full = self.config.itemAngle;
            self.multiplier = 1;
            isSemiCircle = true;
        } else {
            self.config.itemAngle = (self.full / self.numberOfItems);
        }

        if (arrange === 'center' && isSemiCircle) {
            self.arrangeIndex = Math.floor((self.numberOfItems - 1) / 2);
            self.arrangeShift = self.arrangeIndex * self.config.itemAngle;
        }
    }
    
    getContainerRadius() {
        const self = this;
        const radius = self.circle.offsetWidth / 2;
        self.circle.style.setProperty('--r', `${radius.toFixed()}px`);
    }

    getItemDimensions() {
        const self = this;
        const elems = self.items;

        elems.forEach((circle) => {
            const height = circle.offsetHeight;
            const width = circle.offsetWidth;

            circle.style.setProperty('--itemH', `${height}px`);
            circle.style.setProperty('--itemW', `${width}px`);
        });
    }
    
}

export default SwiperWithCircularTabs;
