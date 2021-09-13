var mySwiper = new Swiper ('.swiper4', {
    loop: true,
    slidesPerView : 3,
    slidesPerGroup : 3,
    spaceBetween : 30,
    lazy: true,
    autoHeight: true,
    grabCursor: true,
    breakpointsInverse: true,
    breakpoints: {
        320: {slidesPerView: 1,slidesPerGroup : 1,},
        480: {slidesPerView: 2,slidesPerGroup : 2,},
        768: {slidesPerView: 2,slidesPerGroup : 2,},
        992: {slidesPerView: 3,slidesPerGroup : 3,},
        1200: {slidesPerView: 3,slidesPerGroup : 3,},
    },
    navigation: {nextEl: '.swiper4-button-next',prevEl: '.swiper4-button-prev',},
    pagination: {el: '.swiper4-pagination',clickable: true,},
});