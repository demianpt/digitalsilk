/**
 * Break Points Options
 */

const isBreakpointsOn = (elem, options) => {
    if(!elem) return options;

    let noColumns = parseInt(elem.getAttribute('data-slider-columns'));

    if(noColumns){
        options.slidesPerView = noColumns;
        options.breakpoints = {
            320: {
                slidesPerView: noColumns > 3 ? 1 : 1,
                spaceBetween: 20,
            },

            576: {
                slidesPerView: noColumns > 3 ? 2 : 1,
                spaceBetween: 20,
            },

            1024: {
                slidesPerView: noColumns,
                spaceBetween: 30,
            },
        }
    }

    return options;
}



export {
    isBreakpointsOn
}