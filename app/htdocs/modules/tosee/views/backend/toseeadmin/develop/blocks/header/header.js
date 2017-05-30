$(".header__control").on("click" , function(event){
    event.stopPropagation();

    window.scrollTo(0, 0);

    $(this).toggleClass("header__control--active");
    $(".header__control").not(this).removeClass("header__control--active");

    $("#sidebar").removeClass('sidebar--active');
    
    var id = $(this).attr("rel");
    if(id != "" && id != undefined){

        $(".hidden-sidebar").not("#" + id).removeClass('hidden-sidebar--active');
        $("#" + id).toggleClass('hidden-sidebar--active');
        $("body, html").toggleClass("no-scroll");

    }else{

        $(".hidden-sidebar").removeClass('hidden-sidebar--active');
        $("body, html").removeClass("no-scroll");

    }
});