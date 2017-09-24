
$("#city-dd").on("click", function(event){
  event.stopPropagation();
  $("#city-dd-ul").slideToggle();
});