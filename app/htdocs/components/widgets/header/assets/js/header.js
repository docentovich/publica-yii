$('.header-dd__globe').on("click", function(){
    $('.header-dd-outer').toggleClass('header-dd-outer_dropped');
});

$("#city-dd").on("click", function(event){
  event.stopPropagation();
  $("#city-dd-ul").slideToggle();
});