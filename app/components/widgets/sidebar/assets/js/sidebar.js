var sidebar = '.sidebar-swipe';

$(sidebar + '__close').on('click', function () {
    $(this).parents(sidebar).toggleClass('active');
    $('html').toggleClass('no-y-scroll');

});


$(".sidebar-open").on("click", function(){
    var target = $(this).attr("rel");
    $("#" + target).toggleClass("active");
    $('html').toggleClass("no-y-scroll");
});