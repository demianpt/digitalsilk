/**
 * Visibility functions
 */

const u_showDisplay = (elem) => {
    elem.style.display = "block";
}

const u_hideDisplay = (elem) => {
    elem.style.display = "none";
}

const u_showElem = (elem, hidden = 'is-hidden', visible = 'is-shown') => {
    elem.classList.remove(hidden);
    elem.classList.add(visible);
}

const u_hideElem = (elem, hidden = 'is-hidden', visible = 'is-shown') => {
    elem.classList.add(hidden);
    elem.classList.remove(visible);
}

const u_toggleElem = (elem, hidden = 'is-hidden') => {
    elem.classList.toggle(hidden);
}

export {
    u_showElem,
    u_hideElem,
    u_toggleElem,
    u_showDisplay,
    u_hideDisplay
}