$('.contents-section-wrapper').on('click', function(){
    let index = $('.contents-section-wrapper').index(this);

    $('.contents-title-wrapper').removeClass('active-button-list');
    $('.contents-section-wrapper').removeClass('active-button-list');
    $(this).addClass('active-button-list');
    $('.play-information-flem').removeClass('is-active');
    $('.play-information-flem-is').eq(index).addClass('is-active');

    $('.play-category-number').removeClass('is-active');
    $('.play-category-number-is').removeClass('is-active');
    $('.play-category-number-is').eq(index).addClass('is-active');
    $(this).removeClass('back-color')
    $(this).mouseleave(function(){ /* mouseleave発火するタイミングがmouseoutと違う */
        $(this).addClass('back-color')
    })
});

$('.contents-title-wrapper').on('click', function(){

    $('.contents-title-wrapper').addClass('active-button-list');
    $('.contents-section-wrapper').removeClass('active-button-list');
    $('.play-information-flem').addClass('is-active');
    $('.play-information-flem-is').removeClass('is-active');
    $('.play-category-number-is').removeClass('is-active');
    $('.play-category-number').addClass('is-active');
    $(this).removeClass('back-color')
    $(this).mouseleave(function(){ /* mouseleave発火するタイミングがmouseoutと違う */
        $(this).addClass('back-color')
    })
});