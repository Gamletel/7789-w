jQuery(document).ready(function ($) {

    const worksSwiper = new Swiper('#works-block .swiper', {
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 15,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
        navigation: {
            prevEl: '#works-block .swiper-btn-prev',
            nextEl: '#works-block .swiper-btn-next',
        },
        pagination: {
            el: '#works-block .swiper-pagination',
            clickable: true,
        }
    })

});