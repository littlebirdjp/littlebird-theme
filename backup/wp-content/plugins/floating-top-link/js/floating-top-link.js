jQuery(function($){
    var topBtn = $('#js-FloatingTopLink');
    topBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    topBtn.on('click', function(){
	    $('html,body').animate({ scrollTop: 0 },'fast','swing');
	    return false;
    });
});
