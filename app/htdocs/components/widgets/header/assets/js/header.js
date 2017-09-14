$('.header-dd__globe').on("click", function(){
  $('.header-dd').toggleClass('header-dd_dropped');
});

$("#city-dd").on("click", function(event){
  event.stopPropagation();
  $("#city-dd-ul").slideToggle();
});