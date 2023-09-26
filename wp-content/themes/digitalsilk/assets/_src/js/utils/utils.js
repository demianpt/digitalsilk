
const u_debounced = (func, delay, immediate) => {
    let timerId;
    return (...args) => {
        const boundFunc = func.bind(this, ...args);
        clearTimeout(timerId);
        if (immediate && !timerId) {
            boundFunc();
        }
        const calleeFunc = immediate ? () => { timerId = null } : boundFunc;
        timerId = setTimeout(calleeFunc, delay);
    }
}

const u_throttled = (func, delay, immediate) => {
    let timerId;
    return (...args) => {
        const boundFunc = func.bind(this, ...args);
        if (timerId) {
            return;
        }
        if (immediate && !timerId) {
            boundFunc();
        }
        timerId = setTimeout(() => {
            if(!immediate) {
                boundFunc();
            }
            timerId = null;
        }, delay);
    }
}

export {
    u_debounced,
    u_throttled
};