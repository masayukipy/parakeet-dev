    $('.nav-button').on('click', function(){
        let index = $('.nav-button').index(this);

        $('.nav-button').removeClass('active-button');
        $(this).addClass('active-button');
        $('.subject-contents').removeClass('is-contents-active');
        $('.subject-contents').eq(index).addClass('is-contents-active');
    });