jQuery(document).ready(function ($) {

    const gallerySwiper = new Swiper('#gallery-block .swiper', {
        slidesPerView: 'auto',
        navigation: {
            prevEl: '#gallery-block .swiper-btn-prev',
            nextEl: '#gallery-block .swiper-btn-next',
        },
        pagination: {
            el: '#gallery-block .swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: {
                spaceBetween: 15,
                slidesPerView: 3,
            },
            1221:{
                spaceBetween: 30,
                slidesPerView: 'auto',
            }
        }
    })

});