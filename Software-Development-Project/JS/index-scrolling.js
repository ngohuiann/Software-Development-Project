var navTop = $('#subjectbar').offset().top;

$(window).scroll(function(){
    if ($(this).scrollTop() >= navTop) {
        $('#subjectbar').css('position', 'fixed');
        $('#navi').css('position', 'relative');
        $('#subjectbar').css('top', '0');
    } else {
        $('#subjectbar').css('position', 'absolute');
        $('#subjectbar').css('top', navTop);
        $('#navi').css('position', 'fixed');
    }
});