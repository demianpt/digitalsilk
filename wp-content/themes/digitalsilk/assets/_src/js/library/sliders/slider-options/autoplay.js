/**
 * AutoPlay Slider Options
 */

const isAutoPlayOn = (elem, options) => {
    if(!elem) return options;

    let isAutoplay = elem.getAttribute('data-slider-autoplay');
    let isAutoplayDelay = elem.getAttribute('data-slider-autoplay-delay');

    if(isAutoplay === 'true'){
        options.autoplay = {}
        options.autoplay.disableOnInteraction = false;
        options.autoplay.delay = isAutoplayDelay ? parseInt(isAutoplayDelay) : 3000;
    }

    return options;
}



export {
    isAutoPlayOn
}