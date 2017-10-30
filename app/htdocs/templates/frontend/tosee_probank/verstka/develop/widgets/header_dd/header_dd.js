$('.header-dd__globe').on("click", function(){
    $('.header-dd-outer').toggleClass('header-dd-outer_dropped');
});


$("#city-dd").on("click", function(event){
  event.stopPropagation();

  $("#city-dd-ul").slideToggle();
});

//
// (function($) {
//   $.fn.hasScrollBar = function() {
//     return ( ( this.get(0).scrollHeight > this.height() ) && !is_mobile_device() );
//   }
// })(jQuery);
//
// function is_mobile_device() {
//
//   // return 'ontouchstart' in window        // works on most browsers
//   //     || navigator.maxTouchPoints;       // works on IE10/11 and Surface
//   if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
//     return true;
//   }
//
//   return false;
// };
//
// if( $("body").hasScrollBar() )
//   $("html").addClass("hasScroll");