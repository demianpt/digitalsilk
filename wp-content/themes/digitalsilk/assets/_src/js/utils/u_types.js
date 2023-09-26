const u_isInteger = (value) => {
    if (Number.isInteger) {
        return Number.isInteger(value);
    }
    else {
        return typeof value === 'number' && isFinite(value) && Math.floor(value) === value;
    }
};

const u_isObject = (o) => {
    return (
        typeof o === 'object' &&
        o !== null &&
        o.constructor &&
        Object.prototype.toString.call(o).slice(8, -1) === 'Object'
    );
}

const u_parseBool = (str) =>  {
    // console.log(typeof str);
    // strict: JSON.parse(str)

    if(str == null)
        return false;

    if (typeof str === 'boolean')
    {
        return (str === true);
    }

    if(typeof str === 'string')
    {
        if(str == "")
            return false;

        str = str.replace(/^\s+|\s+$/g, '');
        if(str.toLowerCase() == 'true' || str.toLowerCase() == 'yes')
            return true;

        str = str.replace(/,/g, '.');
        str = str.replace(/^\s*\-\s*/g, '-');
    }

    // var isNum = string.match(/^[0-9]+$/) != null;
    // var isNum = /^\d+$/.test(str);
    if(!isNaN(str))
        return (parseFloat(str) != 0);

    return false;
}

export {
    u_isInteger,
    u_isObject,
    u_parseBool
}