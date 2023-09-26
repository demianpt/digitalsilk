/**
 * Advanced slider type
 */

import { isAutoPlayOn } from '../../library/sliders/slider-options/autoplay';
import { isLazyLoadOn } from '../../library/sliders/slider-options/lazy';
import { isBreakpointsOn } from '../../library/sliders/slider-options/breakpoints';
import { isNavigationOn } from '../../library/sliders/slider-options/navigation';

import { isLoopOn } from '../../library/sliders/slider-options/loop';
import { isEffectOn } from '../../library/sliders/slider-options/effects';
import SwiperWithCircularTabs from '../../library/sliders/swiper-with-circular-tabs';

// config selectors only here
const advancedName = 'js-circular-adv';
const advSliderSel = '.js-circular-adv';
const advSliderTabs = '.l-slider-nav';

// find those selectors
const advSliderList = document.querySelectorAll(advSliderSel);

const circularSliders = () => {
    // loop through sliders and add ID's to it

    let advSliderOptions = [];
    let advSliders = [];
    let sliderTabOptions = [];
    let advSliderNav = [];
    let sliderNav;
    let advSliderThumbs = [];
    let sliderThumbOptions = [];

    advSliderList.forEach( (slider, i) => {
        advSliderOptions[i] = {
            pagination: {
                el: '.m-slider__pagination',
                clickable: true
            },
        };
        sliderTabOptions[i] = {
            item: '.js-nav__item',
        };

        sliderThumbOptions[i] = {
            spaceBetween: 10,
            slidesPerView: 'auto',
            freeMode: true,
            threshold: 10,
            watchSlidesProgress: true,
            wrapperClass: 'c-slider-nav',
        };
        
        const sliderID = `${advancedName}-${i}`;
        slider.setAttribute('id', sliderID);

        const sliderParent = slider.closest('.m-slider');

        if (sliderParent) {
            sliderNav = sliderParent.querySelector(advSliderTabs);
        }

        if (sliderNav) {
            const sliderTabID = `js-slider-circular-nav-${i}`;
            sliderNav.setAttribute('id', sliderTabID);
            sliderTabOptions[i].element = `#${sliderTabID}`;
        }

        const isCenterSlides = sliderNav.getAttribute('data-slider-circular-arrange');

        if (isCenterSlides === 'center') {
            const cSliderNav = sliderNav.querySelector('.c-slider-nav');
            if (cSliderNav) {
                const initialIndex = parseInt(cSliderNav.getAttribute('data-initial-index'), 10);
                advSliderOptions[i].initialSlide = initialIndex;
            }
        }

        advSliderOptions[i] = isLoopOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isAutoPlayOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isLazyLoadOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isBreakpointsOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isEffectOn(slider, advSliderOptions[i]);

        // .m-slider parent is hardcoded in isNavigationOn options
        advSliderOptions[i] = isNavigationOn(slider, advSliderOptions[i], advancedName, i);
        
        advSliders[i] = new Swiper(slider, advSliderOptions[i]);

        if (sliderNav) {
            console.log('aaa');
            if (advSliders[i].initialized) {
                advSliderNav[i] = new SwiperWithCircularTabs(advSliders[i], sliderTabOptions[i]);
            }
        }
    });
};

export {
    circularSliders,
};
