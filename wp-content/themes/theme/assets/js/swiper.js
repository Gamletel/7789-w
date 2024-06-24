jQuery(function($){
	
	// =============== КАРТОЧКА ТОВАРА =============

    const singleProductGallerySwiper = new Swiper('.single-product .single-product__gallery .main-swiper', {
        direction: 'horizontal',
        loop: true,
        slidesPerView: 1,
        navigation: {
            prevEl: '.single-product .single-product__gallery .swiper-btn-mini-prev',
            nextEl: '.single-product .single-product__gallery .swiper-btn-mini-next',
        },
        autoplay: {
            delay: 3000,
        },
        thumbs: {
            swiper: {
                el: '.single-product .single-product__gallery .thumbs-swiper',
                slidesPerView: 5,
                direction: 'horizontal',
                spaceBetween: 15,
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 3,
                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 4,
                    },
                    // when window width is >= 640px
                    640: {
                        slidesPerView: 5,
                    }
                }
            }
        }
    });

	// const swiperProject = new Swiper('#main.single-project .slider__holder', {
	//   direction: 'horizontal',
	//   loop: true,
	//   slidesPerView: 2,
	//   spaceBetween: 20,
	//   navigation: {
	//     nextEl: '.swiper-button-next',
	//     prevEl: '.swiper-button-prev',
	//   },
	//   autoplay: {
	//    delay: 2000,
	//   },
	//   breakpoints: {
	// 	    // when window width is >= 320px
	// 	    320: {
	// 	      slidesPerView: 1,
	// 	    },
	// 	    // when window width is >= 480px
	// 	    480: {
	// 	      slidesPerView: 2,
	// 	    },
	// 	  }
	// });
});




