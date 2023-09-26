
const u_hasClass = (el, cls) => {
    if (el.className.match('(?:^|\\s)' + cls + '(?!\\S)')) {
        return true;
    }
}

const u_addClass = (el, cls) => {
    if (!el.className.match('(?:^|\\s)' + cls + '(?!\\S)')) {
        el.className += ' ' + cls;
    }
}

const u_delClass = (el, cls) => {
    el.className = el.className.replace(new RegExp('(?:^|\\s)' + cls + '(?!\\S)'), '');
}

export {
    u_hasClass,
    u_addClass,
    u_delClass
}