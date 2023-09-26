/**
 * Gallery (slider/carousel) on single product page
 */

const productGalleryEl = document.querySelector(".woocommerce-product-gallery");
const productThumbnailsEl = document.querySelector(".woocommerce-product-gallery__nav");

// NOTE:
// Make sure to update CSS variable --wc-gallery-thumb-items into product-gallery.scss file
// to match JS varibales for number of thumbnail items
const numberOfThumbnailImages = 6;
const numberOfTabletThumbnailImages = 4;
const numberOfMobileThumbnailImages = 3;

export function singleProductGallery() {
  if (productThumbnailsEl) {
    _productGalleryInit();
  }
  _openImgInFancybox(".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image");
}

function _productGalleryInit() {
  // Get number of product images
  const numberOfImages = _getNumberOfProductImages(".woocommerce-product-gallery__nav");

  // Initialize main img slider
  const mainSlider = _mainProductImgSliderInit(".woocommerce-product-gallery__wrapper");

  // Initialize thumbnail images slider
  const thumbnailSliderDirection = productGalleryEl.getAttribute("data-direction");
  const thumbnailSlider = _productThumbnailImagesSliderInit(
    ".woocommerce-product-gallery__nav",
    numberOfImages,
    thumbnailSliderDirection
  );

  // If number of product images is bigger than default visible thumbnails, connect main slider and thumbnail slider controls
  if (_isSliderNavigationVisible(numberOfImages)) {
    mainSlider.controller.control = thumbnailSlider;
    thumbnailSlider.controller.control = mainSlider;

    // And remove navigation binding (bottom arrows will work only for thumbnail slider, not for main)
    mainSlider.navigation.destroy();
  } else {
    // If not, use thumbnail slider and pagination for main slider
    mainSlider.thumbs.swiper = thumbnailSlider;
    mainSlider.thumbs.init();
  }

  // Open fancybox on img click
  // _openImgInFancybox(".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image");
}

/**
 * Initialize slider for main product image
 *
 * @param {string} className
 * @param {'horizontal' | 'vertical'} direction
 * @returns {Swiper}
 */
function _mainProductImgSliderInit(className, direction) {
  const sliderDirection = direction ?? "horizontal";

  return new Swiper(className, {
    direction: sliderDirection,
    slidesPerView: 1,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      // when window width is >= 320px
      320: {
        loopedSlides: numberOfMobileThumbnailImages,
      },
      // when window width is >= 768px
      768: {
        loopedSlides: numberOfTabletThumbnailImages,
      },
      // when window width is >= 1112px
      1112: {
        loopedSlides: numberOfThumbnailImages,
      },
    },
  });
}

/**
 * Initialize slider for product thumbnail images
 *
 * @param {string} className
 * @param {number} items
 * @param {'horizontal' | 'vertical'} direction
 * @returns {Swiper}
 */
function _productThumbnailImagesSliderInit(className, items, direction) {
  const sliderDirection = direction ?? "horizontal";

  // Default slider options
  const options = {
    direction: sliderDirection,
    slidesPerView: items,
    // centeredSlides: true,
    spaceBetween: 10,
  };

  // Update options if number of product images is less then default visible thumbnails
  // Show navigation arrows for thumbnail slider
  if (_isSliderNavigationVisible(items)) {
    options.slideToClickedSlide = true;
    options.loop = true;
    options.navigation = {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    };
    options.breakpoints = {
      // when window width is >= 320px
      320: {
        slidesPerView: numberOfMobileThumbnailImages,
        loopedSlides: numberOfMobileThumbnailImages,
      },
      // when window width is >= 768px
      768: {
        slidesPerView: numberOfTabletThumbnailImages,
        loopedSlides: numberOfTabletThumbnailImages,
      },
      // when window width is >= 1112px
      1112: {
        slidesPerView: numberOfThumbnailImages,
        loopedSlides: numberOfThumbnailImages,
      },
    };
  }

  return new Swiper(className, options);
}

/**
 * Return number of product images based on data attribute
 *
 * @param {string} className
 * @returns number
 */
function _getNumberOfProductImages(className) {
  const swiperThumbnailEl = $(className);
  const swiperThumbnailNumberOfItems = parseInt(swiperThumbnailEl.data("items"));

  return swiperThumbnailNumberOfItems;
}

/**
 * Open image in fancybox on click
 *
 * @param {string} className
 */
function _openImgInFancybox(className) {
  if (productGalleryEl) {
    $().fancybox({
      selector: `${className} a:visible`,
      backFocus: false,
      mobile: {
        clickContent: "close",
        clickSlide: "close",
      },
    });
  }
}

/**
 * Retun true if number of thumbnails is bigger than default visible thumbnails
 *
 * @param {number} numberOfImages
 * @returns boolean
 */
function _isSliderNavigationVisible(numberOfImages) {
  return numberOfImages > numberOfThumbnailImages;
}
