/**
 * Navigation Slider Options
 */

const isNavigationOn = (elem, options, basename, currentID) => {
    let nextEl = '.swiper-button-next';
    let prevEl = '.swiper-button-prev';
    let nextID, prevID, sliderNext, sliderPrev;
    if(!elem) return options;

    let isNavigation = elem.getAttribute('data-slider-navigation');

    if(isNavigation) {
        options.navigation = {};

        if(basename && (typeof currentID !== "undefined")) {
            nextID = `${basename}-next-${currentID}`;
            prevID = `${basename}-prev-${currentID}`;
        }

        let sliderParent = elem.closest('.m-slider');
        if(sliderParent) {
            sliderNext = sliderParent.querySelector(nextEl);
            sliderPrev = sliderParent.querySelector(prevEl);
        }
        if(sliderNext && nextID) {
            sliderNext.setAttribute('id', nextID);
            options.navigation.nextEl = `#${nextID}`;
        }
        if(sliderPrev && prevID) {
            sliderPrev.setAttribute('id', prevID);
            options.navigation.prevEl = `#${prevID}`;
        }
    }
    else {
        options.navigation = false;
    }

    return options;
}



export {
    isNavigationOn
}