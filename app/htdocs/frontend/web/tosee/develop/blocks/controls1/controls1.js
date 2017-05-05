var control1 = new bem('controls1');

$(control1.e('conrol1')).on('click', function(){
    var target = $(this).attr("rel");
    $("#"+target).toggleClass("active");
    $('html').toggleClass("no-y-scroll");
});