/**
 * Lazy Load Slider Options
 *
 * TODO: missing option for data option, create preloader div via js, and change image src to data-src, right now all this done manually
 */

const isLazyLoadOn = (elem, options) => {
    if(!elem) return options;

    //let isLazyLoad = elem.getAttribute('data-slider-lazy');

    options.preloadImages = false;
    options.lazy = {};
    options.lazy.loadPrevNext = true;
    options.loadOnTransitionStart = true;

    return options;
}

export {
    isLazyLoadOn
}