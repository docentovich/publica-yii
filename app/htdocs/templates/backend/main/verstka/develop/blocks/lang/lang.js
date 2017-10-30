$("#lang-dd").on("click", function(event){
    event.stopPropagation();
    $("#lang-dd-ul").slideToggle();
    i++;
});