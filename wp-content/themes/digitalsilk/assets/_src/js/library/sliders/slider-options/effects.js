const isEffectOn = (elem, options) => {
    if (!elem) return options;

    const isEffect = elem.getAttribute('data-slider-effect-transition');

    options.effect = {};
    switch (isEffect) {

        case 'fade':
            options.effect = 'fade';
            options.fadeEffect = {};
            options.fadeEffect.crossFade = true;
            break;
        case 'cube':
            options.effect = 'cube';
            break;
        case 'coverflow':
            options.effect = 'coverflow';
            break;
        case 'cards':
            options.effect = 'cards';
            break;
        case 'flip':
            options.effect = 'flip';
            break;
    }

    return options;
};

export {
    isEffectOn,
};
