const u_extendObject = (destination, source) => {
    for (let property in source) {
        if (source[property] && source[property].constructor &&
            source[property].constructor === Object) {
            destination[property] = destination[property] || {};
            u_extendObject(destination[property], source[property]);
        } else {
            destination[property] = source[property];
        }
    }
    return destination;
};

const u_extend = (defaults, options) => {
    const extendedOptions = {};
    for (let key in defaults) {
        extendedOptions[key] = options[key] || defaults[key];
    }
    return extendedOptions;
};

const u_mergeDeep = (target, source) => {
    const isObject = (obj) => obj && typeof obj === 'object';

    if (!isObject(target) || !isObject(source)) {
        return source;
    }

    Object.keys(source).forEach(key => {
        const targetValue = target[key];
        const sourceValue = source[key];

        if (Array.isArray(targetValue) && Array.isArray(sourceValue)) {
            target[key] = targetValue.concat(sourceValue);
        } else if (isObject(targetValue) && isObject(sourceValue)) {
            target[key] = u_mergeDeep(Object.assign({}, targetValue), sourceValue);
        } else {
            target[key] = sourceValue;
        }
    });

    return target;
}

export {
    u_extend,
    u_extendObject,
    u_mergeDeep
};