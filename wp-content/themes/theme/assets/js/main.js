jQuery(document).ready(function ($) {
    console.log('test');

    $('input[type=tel]').inputmask({"mask": "+7 999 999-99-99"}); //specifying options

    window.formPhoneValidator = function (input) {
        let tempInput = input.toString().replaceAll('_', '');
        tempInput = tempInput.replaceAll(' ', '');
        tempInput = tempInput.replaceAll('-', '');

        return tempInput.length === 12;
    }

    const maxFileSizeInMB = 1;
    const maxFileSizeInKB = 1024 * 1024 * maxFileSizeInMB;
    $(".form__file input[type=file]").on("change", function () {
        let file = this.files[0];
        if (file.size > maxFileSizeInKB) {
            alert("Вы загрузили файл слишком большого размера!");
            $(this).val("");
            return 0;
        }
        if (file) {
            $(this).closest(".form__file").find(".file__title").html(file.name);
        } else {
            $(this)
                .closest(".form__file")
                .find(".file__title")
                .html("Прикрепить тех.задание");
        }
    });

    $('.input').hover(
        function () {
            $(this).addClass('active');
            $(this).find('input').focus();
        },
        function () {
            if ($(this).find('input').val() === '') {
                $(this).removeClass('active');
            }
        }
    );

    $('.input input').blur(function () {
        if ($(this).val() === '') {
            $(this).parent().removeClass('active');
        }
    });

    (function (func) {
        $.fn.addClass = function () { // replace the existing function on $.fn
            func.apply(this, arguments); // invoke the original function
            this.trigger('classChanged'); // trigger the custom event
            return this; // retain jQuery chainability
        }
    })($.fn.addClass); // pass the original function as an argument

    (function (func) {
        $.fn.removeClass = function () {
            func.apply(this, arguments);
            this.trigger('classChanged');
            return this;
        }
    })($.fn.removeClass);

    $('.input').each(function () {
        let parent = $(this);
        let input = $(this).find('input');
        input.on('classChanged', function () {
            parent.toggleClass('error');
        })
    })

    /*FILTER*/
    const filterWidget = $('.filters-widget');
    const closeFilter = filterWidget.find('#close-filter');
    const openFilter = filterWidget.find('#open-filter');
    openFilter.click(() => {
        filterWidget.toggleClass('opened');
    })
    closeFilter.click(() => {
        filterWidget.removeClass('opened');
    })

    /*SIMPLE SCROLL*/
    Array.prototype.forEach.call(
        document.querySelectorAll('.simple-scroll-block'),
        (el) => new SimpleBar(el)
    );

    let productReadmoreBtns = $('.single-product .readmore-btn');

    let productTabs = $('.single-product .single-product__bottom-info .tab');
    let productTabContents = $('.single-product .single-product__tab-content');
    productTabs.first().addClass('active');
    productTabContents.first().addClass('active');

    productReadmoreBtns.click(function () {
        let readmoreDataTab = $(this).data('tab');

        productTabs.each(function () {
            let dataTab = $(this).data('product-tab');
            if (dataTab === readmoreDataTab) {
                $(this).addClass('active').siblings().removeClass('active');
            }
        })

        productTabContents.each(function () {
            let dataTabContent = $(this).data('product-tab');
            $(this).removeClass('active');

            if (dataTabContent === readmoreDataTab) {
                $(this).addClass('active');

                $('html, body').animate({
                    scrollTop: $(this).offset().top - 250
                }, 1000);
            }
        })
    })

    productTabs.click(function () {
        let dataTab = $(this).data('product-tab');
        $(this).addClass('active').siblings().removeClass('active');

        productTabContents.each(function () {
            let dataTabContent = $(this).data('product-tab');
            $(this).removeClass('active');

            if (dataTabContent === dataTab) {
                $(this).addClass('active');
            }
        })
    })

    // $(document).scroll(function() {
    //     if ($(this).scrollTop() >= 50) {
    //     $('#header').addClass('painted');
    //     // console.log('scroll')
    //     }else{
    //     $('#header').removeClass('painted');
    //     }
    // });
    //

    // $("li.nav-menu-element a").click(function() { // ID откуда кливаем
    // 	let hash = $(this).attr('href');
    // 	if(hash.length > 1) {
    // 		$(this).parent().addClass('active');
    // 		$(this).parent().siblings().removeClass('active');
    // 		$('html, body').animate({
    //             scrollTop: $(hash).offset().top - 120 // класс объекта к которому приезжаем
    //         }, 1000); // Скорость прокрутки
    // 	}
    // });


    /*============ FUNCTIONS ===========*/

    // function getCallbackForm(modal, props) {
    //     let id = props['data-modal'].value;
    //     if($(modal).find('.form__holder').html() == '') {
    //         $.ajax({
    //             url: `/wp-admin/admin-ajax.php?action=get_modal_form&modal=${id}`,
    //             method: 'GET',
    //             success: function (data){
    //                 $(modal).find('.form__holder').html(data);
    //                 let form = $(modal).find('form').get(0);

    //                 ThemeModal.reinitForms(form);
    //                 ThemeModal.getInstance().openModal(id);
    //             },
    //             error: function (data) {
    //                 ThemeModal.getInstance().openModal('error');
    //             }
    //         });
    //     }else{
    //         ThemeModal.getInstance().openModal(id);
    //     }
    // }

    let mobileMenu = new MobileMenu(); // Вызов объекта класса мобильного меню
    mobileMenu.init(); // Инициализация мобильного меню
    let themeModal = new ThemeModal({}); // Вызов объекта класса модалок

    // themeModal.modalsView['callback'] = {
    // 	callback: getCallbackForm
    // };
    themeModal.init(); // Инициализация модалок

});
