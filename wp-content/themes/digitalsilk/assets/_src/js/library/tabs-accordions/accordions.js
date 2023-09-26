import { u_slideDown, u_slideUp } from "../../utils/u_slide-up-down";
import { u_fadeIn, u_fadeOut } from "../../utils/u_fade-in-out";

/**
 * TODO:
 * DO NOT USE THIS, STILL IN DEVELOPMENT
 */


class DSMPAccordions {
    constructor() {
        this.config = {
            selector: '.js-dsmp-accordion',
            accordion : {
                item                : '.c-accordion__item',
                trigger             : '.c-accordion__button',
                content             : '.c-accordion__content',
                gallery: {
                    container       : '.js-accordion-gallery',
                    items           : '.c-accordion__media'
                },
            },
            active:                 'is-active'
        }

        this.selector = `${ this.config.selector } ${ this.config.accordion.trigger }`;
        this.items = document.querySelectorAll(this.selector);

        this.init();
    }

    init() {
        let self = this;

        self.bindChangeAccordion = this.changeAccordion.bind(this);

        [...self.items].forEach((tab) => {
            tab.addEventListener('click', self.bindChangeAccordion);
        })

    }

    changeAccordion(ev) {
        let self = this;
        let currentItemClicked = ev.currentTarget;
        let currentSelector = currentItemClicked.closest(self.config.selector);


        let items = currentSelector.querySelectorAll(self.config.accordion.item);
        let currentItem = currentItemClicked.closest(self.config.accordion.item);
        let currentContent = currentItem.querySelector(self.config.accordion.content);

        let isGalleryData = currentSelector.getAttribute('data-accordion-gallery');
        let isGallery = (isGalleryData === 'true') ? true : false;

        let galleryItems, currentGallery;
        if(isGallery) {
            currentGallery = currentSelector.querySelector(self.config.accordion.gallery.container);
            galleryItems = currentGallery.querySelectorAll(self.config.accordion.gallery.items);
        }


        if(!currentItem.classList.contains(self.config.active))
        {
            let counter;
            items.forEach((item, i) => {
                if(currentItem === item) {
                    counter = i;
                }
                if(item.classList.contains(self.config.active)) {
                    let itemContent = item.querySelector(self.config.accordion.content);
                    u_slideUp(itemContent);
                }
                let button = item.querySelector(self.config.accordion.trigger);
                if(button) {
                    button.setAttribute('aria-expanded', false)
                }

                item.classList.remove(self.config.active);

            });

            u_slideDown(currentContent);
            currentItem.classList.add(self.config.active);
            currentItemClicked.setAttribute('aria-expanded', true)


            let counterGallery = null;
            if(isGallery) {
                let galleryID;
                let notEmptyGalleries = false;
                galleryItems.forEach((gallery, k) => {
                    galleryID = parseInt(gallery.getAttribute('data-accordion-media'));
                    if(counter === galleryID) {
                        counterGallery = k;
                        console.log('jeste');
                    }
                    else {
                        console.log(k, 'nije');
                    }

                    if(gallery.classList.contains(self.config.active)) {
                        notEmptyGalleries = true;
                        u_fadeOut(gallery, {
                            complete: () => {
                                gallery.classList.remove(self.config.active);
                                let changeItem = galleryItems[counterGallery];
                                if(changeItem) {
                                    changeItem.classList.add(self.config.active);
                                    u_fadeIn(changeItem)
                                }
                            }
                        })
                    }
                });

                if(!notEmptyGalleries) {
                    let changeItem = galleryItems[counterGallery];
                    changeItem.classList.add(self.config.active);
                    u_fadeIn(changeItem);
                }
            }
        }
    }

}

export default DSMPAccordions;