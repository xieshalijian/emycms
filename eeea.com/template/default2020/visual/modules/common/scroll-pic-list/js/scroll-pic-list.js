var mySwiper = new Swiper ('.scroll-pic-list-swiper', {
    loop: true,
    slidesPerView : 3,
    slidesPerGroup : 3,
    lazy: true,
    spaceBetween : 10,
    autoHeight: true,
    grabCursor: true,
    breakpointsInverse: true,
    breakpoints: {
        320: {slidesPerView: 1,slidesPerGroup : 1,},
        480: {slidesPerView: 2,slidesPerGroup : 2,},
        768: {slidesPerView: 3,slidesPerGroup : 3,},
        992: {slidesPerView: 4,slidesPerGroup : 4,},
        1200: {slidesPerView: 5,slidesPerGroup : 5,},
    },
    navigation: {nextEl: '.swiper-button-next',prevEl: '.swiper-button-prev',},
    pagination: {el: '.swiper-pagination',clickable: true,},
});