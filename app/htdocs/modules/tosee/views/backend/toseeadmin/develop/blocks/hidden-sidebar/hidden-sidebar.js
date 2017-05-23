$(".hidden-sidebar__close").on("click" , function(event){
    event.stopPropagation();
    

    $(".hidden-sidebar").removeClass('hidden-sidebar--active');
    $("body, html").removeClass("no-scroll");
    $(".header__control").removeClass("header__control--active");

});