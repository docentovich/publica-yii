var b = '.sidebar__';

$(b + 'close').on('click', function(){
    $(".sidebar").removeClass('active');
    $('html').removeClass('no-y-scroll');
});  