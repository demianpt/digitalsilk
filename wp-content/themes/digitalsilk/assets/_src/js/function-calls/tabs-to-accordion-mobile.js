import DSMPTabToAccordionMobile from "../library/tabs-accordions/DSMPTabsToAccordionMobile";

const tabaccID = 'js-tab-acc';
const tabaccSelector = '.js-tabs-to-acc-wrapper';
const tabaccItems = document.querySelectorAll(tabaccSelector);

const callTabAccordionsMobile = () => {

    tabaccItems.forEach( (acc, i) => {
        let taID = `${tabaccID}-${i}`;
        let callID = `#${taID}`;
        acc.setAttribute('id', taID);

        new DSMPTabToAccordionMobile(callID);
    });
}


export {
    callTabAccordionsMobile
}