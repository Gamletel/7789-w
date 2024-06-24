jQuery(document).ready(function($){

    const steps = $('#steps-block .step');
    steps.click(function () {
        $(this).toggleClass('opened');
        $(this).find('.step__image').slideToggle();
        $(this).find('.step__text').slideToggle();
    })

});