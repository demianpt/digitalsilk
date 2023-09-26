import DSMPAccordionsLight from "../library/tabs-accordions/DSMPAccordionsLight";

const callAccordionsLight = (selector = '.js-a-light', options) => {
    let accordions = document.querySelectorAll(selector);
    let accNewName = selector.slice(1);

    accordions.forEach((acc, i) => {
        let newID = `${accNewName}-${i}`;
        let callID = `#${newID}`;
        acc.setAttribute('id', newID);

        new DSMPAccordionsLight(callID, options);
    });
};

export {
    callAccordionsLight,
};
