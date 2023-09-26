/**
 * https://github.com/janrembold/es6-slide-up-down
 *
 * usage with easings
 *
 */

import { u_extend } from "./u_object_extend";
import { u_isInteger } from "./u_types";

const defaults = {
    duration: 250,
    easing: (currentTime, startValue, diffValue, dureation) => {
        return -diffValue * (currentTime /= dureation) * (currentTime - 2) + startValue;
    },
    display: 'block'
};
const directions = {
    OPEN: 1,
    CLOSE: 2
};
export const u_slideUp = (element, args = {}) => {
    if (u_isInteger(args)) {
        args = { duration: args };
    }
    const options = u_extend(defaults, args);
    let displayType = options.display;
    options.direction = directions.CLOSE;
    options.to = 0;
    options.startingHeight = element.scrollHeight;
    options.distanceHeight = -options.startingHeight;
    setElementAnimationStyles(element, displayType);
    window.requestAnimationFrame((timestamp) => animate(element, options, timestamp));
};
export const u_slideDown = (element, args = {}) => {
    if (u_isInteger(args)) {
        args = { duration: args };
    }
    element.style.height = '0px';
    const options = u_extend(defaults, args);
    let displayType = options.display;
    setElementAnimationStyles(element, displayType);
    options.direction = directions.OPEN;
    options.to = element.scrollHeight;
    options.startingHeight = 0;
    options.distanceHeight = options.to;
    window.requestAnimationFrame((timestamp) => animate(element, options, timestamp));
};
const animate = (element, options, now) => {
    if (!options.startTime) {
        options.startTime = now;
    }
    const currentTime = now - options.startTime;
    let animationContinue = currentTime < options.duration;
    let newHeight = options.easing(currentTime, options.startingHeight, options.distanceHeight, options.duration);
    if (animationContinue) {
        element.style.height = `${newHeight.toFixed(2)}px`;
        window.requestAnimationFrame((timestamp) => animate(element, options, timestamp));
    }
    else {
        if (options.direction === directions.CLOSE) {
            element.style.display = 'none';
        }
        if (options.direction === directions.OPEN) {
            element.style.display = options.display === 'flex' ? 'flex' : 'block';
        }
        removeElementAnimationStyles(element);
    }
};
const setElementAnimationStyles = (element, displayType = 'block') => {
    element.style.display = displayType === 'flex' ? 'flex' : 'block';
    element.style.overflow = 'hidden';
    element.style.marginTop = '0';
    element.style.marginBottom = '0';
    element.style.paddingTop = '0';
    element.style.paddingBottom = '0';
};
const removeElementAnimationStyles = (element) => {
    element.style.height = null;
    element.style.overflow = null;
    element.style.marginTop = null;
    element.style.marginBottom = null;
    element.style.paddingTop = null;
    element.style.paddingBottom = null;
};

export const u_slideToggle = (element, args = {}) => {
    if (window.getComputedStyle(element).display === 'none') {
        return u_slideDown(element, args);
    } else {
        return u_slideUp(element, args);
    }
}