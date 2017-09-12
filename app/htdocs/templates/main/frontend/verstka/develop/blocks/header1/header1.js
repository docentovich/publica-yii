$(".sidebar-rel").on('click', function(){
    var target = $(this).attr("rel");
    $("#"+target).toggleClass("active");
    $('html').toggleClass("no-y-scroll");
});