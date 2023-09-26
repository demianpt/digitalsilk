/**
 * TODO:
 * DO NOT USE THIS, STILL IN DEVELOPMENT
 */


class TabAccordion {
    constructor() {
        this.config = {
            selector: '.js-tabs-panel',
            navigation: '.js-tabs-nav',
            tabs: {
                container: '.l-tabs__panel'
            },
            accordion : {
                label: '.l-tabs__label',
                content: '.l-tabs__content'
            },
            nav: {
                item: '.c-tabs-nav__link'
            }
        }

        this.selector = `${this.config.navigation} ${this.config.nav.item}`;
       // console.log(this.selector);

        this.items = document.querySelectorAll(this.selector);

        //console.log(this.items);

        this.keys = {
            end: 35,
            home: 36,
            left: 37,
            up: 38,
            right: 39,
            down: 40,
            delete: 46,
            enter: 13,
            space: 32
        }
        this.keysDirection = {
            37: -1,
            38: -1,
            39: 1,
            40: 1
        }

        //console.log('tab-accordion');
        this.init();
    }

    init() {

    }

}

export default TabAccordion;