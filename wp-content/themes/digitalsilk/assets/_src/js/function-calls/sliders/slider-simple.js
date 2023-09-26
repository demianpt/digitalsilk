/**
 * Simple slider type
 */
import { isAutoPlayOn } from '../../library/sliders/slider-options/autoplay';
import { isLazyLoadOn } from '../../library/sliders/slider-options/lazy';
import { isBreakpointsOn } from '../../library/sliders/slider-options/breakpoints';
import { isNavigationOn } from '../../library/sliders/slider-options/navigation';

// config selectors only here
const simpleName = 'js-slider-simple';
const simpleSliderSel = '.js-slider-simple';

// find those selectors
const simpleSliderList = document.querySelectorAll(simpleSliderSel);

const simpleSliders = () => {
    // loop through sliders and add ID's to it

    const simpleSliderOptions = [];
    const simpleSliders = [];
    simpleSliderList.forEach((slider, i) => {
        simpleSliderOptions[i] = {
            pagination: {
                el: '.m-slider__pagination',
                clickable: true,
            },
        };
        const sliderID = `${simpleName}-${i}`;
        slider.setAttribute('id', sliderID);

        simpleSliderOptions[i] = isAutoPlayOn(slider, simpleSliderOptions[i]);
        simpleSliderOptions[i] = isLazyLoadOn(slider, simpleSliderOptions[i]);
        simpleSliderOptions[i] = isBreakpointsOn(slider, simpleSliderOptions[i]);

        // .m-slider parent is hardcoded in isNavigationOn options
        simpleSliderOptions[i] = isNavigationOn(slider, simpleSliderOptions[i], simpleName, i);

        simpleSliders[i] = new Swiper(slider, simpleSliderOptions[i]);
    });
};

export {
    simpleSliders,
};
