/**
 * Advanced slider type
 */

import SwiperWithTabs from "../../library/sliders/swiper-with-tabs";
import { isAutoPlayOn } from "../../library/sliders/slider-options/autoplay";
import { isLazyLoadOn } from "../../library/sliders/slider-options/lazy";
import { isBreakpointsOn } from "../../library/sliders/slider-options/breakpoints";
import {isNavigationOn} from "../../library/sliders/slider-options/navigation";
import {u_parseBool} from "../../utils/u_types";
import {isLoopOn} from "../../library/sliders/slider-options/loop";


// config selectors only here
const advancedName = 'js-slider-advanced';
const advSliderSel = '.js-slider-advanced';
const advSliderTabs = '.l-slider-nav';

// find those selectors
const advSliderList = document.querySelectorAll(advSliderSel);

const advancedSliders = () => {
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
            active: 'is-active',
            trigger: 'click'
        }

        sliderThumbOptions[i] = {
            spaceBetween: 10,
            slidesPerView: 'auto',
            freeMode: true,
            threshold: 10,
            watchSlidesProgress: true,
            wrapperClass: 'c-slider-nav'
        }

        let isThumbs = u_parseBool(slider.getAttribute('data-slider-thumbs'));

        let sliderID = `${advancedName}-${i}`;
        slider.setAttribute('id', sliderID);

        let sliderParent = slider.closest('.m-slider');

        if(sliderParent) {
            sliderNav = sliderParent.querySelector(advSliderTabs);
        }

        let sliderThumbsSelector;
        if(sliderNav) {
            if(isThumbs) {
                let sliderThumbsID = 'js-slider-advanced-thumbs-' + i;
                sliderNav.setAttribute('id', sliderThumbsID);
                sliderThumbsSelector = '#' + sliderThumbsID;
            }
            else {
                let sliderTabID = 'js-slider-advanced-nav-' + i;
                sliderNav.setAttribute('id', sliderTabID);
                sliderTabOptions[i].element = '#' + sliderTabID;
            }
        }

        advSliderOptions[i] = isLoopOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isAutoPlayOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isLazyLoadOn(slider, advSliderOptions[i]);
        advSliderOptions[i] = isBreakpointsOn(slider, advSliderOptions[i]);

        // .m-slider parent is hardcoded in isNavigationOn options
        advSliderOptions[i] = isNavigationOn(slider, advSliderOptions[i], advancedName, i);

        if(isThumbs) {
            advSliderThumbs[i] = new Swiper(sliderThumbsSelector, sliderThumbOptions[i]);

            advSliderOptions[i].thumbs = {};
            advSliderOptions[i].thumbs.swiper = advSliderThumbs[i];

            advSliderOptions[i].noSwipingSelector = '.l-slider-nav, .m-slider__pagination';

        }

        advSliders[i] = new Swiper(slider, advSliderOptions[i]);

        if(sliderNav) {
            if(advSliders[i].initialized) {
                advSliderNav[i] = new SwiperWithTabs(advSliders[i], sliderTabOptions[i]);
            }
        }

    })
}

export {
    advancedSliders
}
