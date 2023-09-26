/**
 * DSBLS SLIDER type
 */
import DSMPSliderDSBLS from "../../library/sliders/slider-dsbls";

// config selectors only here
const dsblsSel = '.js-slider-dsbls';
const dsblsSelMob = '.js-slider-dsbls-m';

// find those selectors
const dsblsSliderList = document.querySelectorAll(dsblsSel);
const dsblsSliderMobileList = document.querySelectorAll(dsblsSelMob);


const dsblsSlider = () => {
    // loop through sliders and add ID's to it, we assume each dsbls slider has its own mobile slider as it
    // component, so no need to loop, search parent and query child element

    let dsbls = [];
    dsblsSliderList.forEach( (slider, i) => {
        let sliderID = 'js-slider-dsbls-' + i;
        let sliderMobileID = 'js-slider-dsbls-m-' + i;

        slider.setAttribute('id', sliderID);
        dsblsSliderMobileList[i].setAttribute('id', sliderMobileID);

        dsbls[i] = new DSMPSliderDSBLS(sliderID);
    })
}


export {
    dsblsSlider
}