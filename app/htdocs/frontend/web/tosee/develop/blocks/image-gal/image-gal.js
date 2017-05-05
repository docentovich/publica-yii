// var modalca = '<div class="fancybox-container" role="dialog" tabindex="-1">' +

// '<div class="fancybox-bg"></div>' +
// '<div class="fancybox-controls">' +
// '<div class="fancybox-infobar">' +
// '<button data-fancybox-previous class="fancybox-button fancybox-button--left" title="Previous"></button>' +
// '<div class="fancybox-infobar__body">' +
// '<span class="js-fancybox-index"></span>&nbsp;/&nbsp;<span class="js-fancybox-count"></span>' +
// '</div>' +
// '<button data-fancybox-next class="fancybox-button fancybox-button--right" title="Next"></button>' +
// '</div>' +
// '<div class="fancybox-buttons">' +
// '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="Close (Esc)"></button>' +
// '</div>' +
// '</div>' +


// '<div class="fancybox-slider-wrap">' +

// '<div class="fancybox-slider"></div>' +
// '</div>' +
// '<div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div>' +
// '</div>';

// $('.image-gal__a').fancybox(
// {
//     beforeShow: function () {
//         if (this.title) {
//                 // New line
//                 this.title += '<br />';
                
//                 // Add tweet button
//                 this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="' + this.href + '">Tweet</a> ';
                
//                 // Add FaceBook like button
//                 this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=fals&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="fals"></iframe>';
//             }
//         },
//         afterShow: function () {
//         // Render tweet button
//         twttr.widgets.load();
//     },
//     helpers: {
//         title: {
//             type: 'inside'
//         }
//     }
// });

 // $('.image-gal__a').modal();
$fbg = $('.image-gal__a').fancybox({
    closeBtn   : false,
    infobar : false,
    buttons : true,
    touch : false,
    tpl: {
        next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span>NEXT</span></a>',
        prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span>PREVIOUS</span></a>'
    },
     type: "inline",

    beforeMove: function (instance, slide) {
        // Hide scrollbar for fancybox bug fix
        instance.slides[instance.prevIndex].$slide.css("overflow", "hidden");
        slide.$slide.css("overflow", "hidden");
    },

    afterMove: function (instance, slide) {
        // Restore scrollbar for fancybox bug fix
        instance.slides[instance.prevIndex].$slide.css("overflow", "");
        slide.$slide.css("overflow", "");
    }
});

$(".modal__to-right").on("click", function(){
    $.fancybox.getInstance().next();
});
$(".modal__to-left").on("click", function(){
    $.fancybox.getInstance().previous();
});