const complectSlider = document.querySelector("#complects-list");
const complectsSliderWripper = document.querySelector("#complects-list .slider_wraper");
const complectSlides = document.querySelectorAll("#complects-list .complect-card");


complectSlider.classList.add("complect-swiper-container");
complectsSliderWripper.classList.add("swiper-wrapper");

complectSlides.forEach((slide) => {
    slide.classList.add("swiper-slide");
});

const complectsSwiper = new Swiper('.complect-swiper-container', {
    effect: 'slide',
    direction: 'horizontal',
    updateOnWindowResize: true,
    preventClicksPropagation: true,
    // loop: true,
    initialSlide: 0,
    spaceBetween: 32,
    slidesOffsetBefore: 16,
    slidesOffsetAfter: 16,
    slidesPerView: 'auto',

    keyboard: {
      enabled: true,
      onlyInViewport: false,
      },
  });
  

const popularSlider = document.querySelector("#popular-goods-list");
const popularSliderWripper = document.querySelector("#popular-goods-list .slider_wraper");
const popularSlides = document.querySelectorAll("#popular-goods-list .popular-card");


popularSlider.classList.add("complect-swiper-container");
popularSliderWripper.classList.add("swiper-wrapper");

popularSlides.forEach((slide) => {
    slide.classList.add("swiper-slide");
});

const popularsSwiper = new Swiper('.popular-goods-list', {
    effect: 'slide',
    direction: 'horizontal',
    updateOnWindowResize: true,
    preventClicksPropagation: true,
    loop: true,
    initialSlide: 0,
    spaceBetween: 32,
    slidesOffsetBefore: 16,
    slidesOffsetAfter: 16,
    slidesPerView: 'auto',
  });