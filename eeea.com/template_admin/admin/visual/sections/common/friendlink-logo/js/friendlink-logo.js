var mySwiper = new Swiper ('.friendlink-logo-swiper', {
    loop: true,
    slidesPerView : 10,
    slidesPerGroup : 1,
    spaceBetween : 10,
    lazy: true,
    grabCursor: true,
    autoHeight: true,
    breakpointsInverse: true,
    breakpoints: {
        320: {slidesPerView: 1,slidesPerGroup : 1,},
        480: {slidesPerView: 2,slidesPerGroup : 2,},
        768: {slidesPerView: 4,slidesPerGroup : 4,},
        992: {slidesPerView: 6,slidesPerGroup : 10,},
        1200: {slidesPerView: 10,slidesPerGroup : 10,},
    },
    pagination: {el: '.friendlink-logo-swiper-pagination',clickable: true,},
});