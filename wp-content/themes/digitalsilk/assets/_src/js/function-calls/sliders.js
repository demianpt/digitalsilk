import { dsblsSlider } from './sliders/slider-dsbls';
import { simpleSliders } from './sliders/slider-simple';
import { advancedSliders } from './sliders/slider-advanced';
import { circularSliders } from './sliders/slider-circular';

const callSliders = () => {
    dsblsSlider();
    simpleSliders();
    advancedSliders();
    circularSliders();
};

export {
    callSliders,
};
