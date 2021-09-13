var mySwiper = new Swiper ('.scroll-columns-list-swiper', {
    loop: true,
    slidesPerView : 1,
    slidesPerGroup : 1,
    spaceBetween : 10,
    grabCursor: true,
    autoHeight: true,
    navigation: {nextEl: '.scroll-columns-list-swiper-button-next',prevEl: '.scroll-columns-list-swiper-button-prev',},
    pagination: {el: '.scroll-columns-list-swiper-pagination',clickable: true,},
});