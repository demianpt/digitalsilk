import DSMPAccordions from "../../library/tabs-accordions/DSMPAccordions";

const accordionID = 'js-acc';
const accordionSelector = '.js-acc-wrapper';
const accordionItems = document.querySelectorAll(accordionSelector);

const createAccordions = () => {
    let accordions = [];
    let accordionOptions = [];

    accordionItems.forEach( (acc, i) => {
        let accID = `${accordionID}-${i}`;
        let callID = `#${accID}`;
        acc.setAttribute('id', accID);

        accordions[i] = new DSMPAccordions(callID);
    });
}

export {
    createAccordions
}