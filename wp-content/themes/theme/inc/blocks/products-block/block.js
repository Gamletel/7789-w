jQuery(document).ready(function($){

    const productsSwiper = new Swiper('#products-block .swiper', {
        breakpoints:{
            320:{
                spaceBetween: 15,
                slidesPerView: 1,
            },
            498:{
                spaceBetween: 15,
                slidesPerView: 2,
            },
            769:{
                spaceBetween: 30,
                slidesPerView: 3,
            },
            1221:{
                spaceBetween: 30,
                slidesPerView: 4,
            },
        },
        navigation:{
            prevEl: '#products-block .swiper-btn-prev',
            nextEl: '#products-block .swiper-btn-next',
        },
        pagination:{
            el: '#products-block .swiper-pagination',
            clickable: true,
        }
    })

});