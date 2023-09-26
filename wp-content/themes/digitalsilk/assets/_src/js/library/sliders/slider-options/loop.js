/**
 * Loop Slider Options
 */

const isLoopOn = (elem, options) => {
    if(!elem) return options;

    let isLoop = elem.getAttribute('data-slider-loop');

    if(isLoop === 'true'){
        options.loop = true;
    }

    return options;
}


export {
    isLoopOn
}