Date.prototype.yyyymmdd = function() {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    return [this.getFullYear(),
        (mm>9 ? '' : '0') + mm,
        (dd>9 ? '' : '0') + dd
    ].join('-');
};

(function ($) {
    // toggle calendarF
    $('#calendar-href').on('click', function (event) {
        event.stopPropagation();
        $('#sidebar-menu').removeClass('is-active');
        $('#sidebar-calendar').addClass('is-active');
    });

    $('#calendar-back').on('click', function (event) {
        event.stopPropagation();
        $('#sidebar-calendar').removeClass('is-active');
        $('#sidebar-menu').addClass('is-active');
    });
})(jQuery);

(function ($) {
    // front data-picker
    $('.div-datepicker').datepicker({
        language: lang,
        container: '.div-datepicker'
    });

    $('.div-datepicker').on('changeDate', function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location = "/date/" + e.date.yyyymmdd();
        return false;
    });
})(jQuery);


(function ($) {
    // like
    $('.like-action').on('click', function (event) {

        var imageId = $(this).data('imageId');
        var self = this;
        $.ajax({
            method: "POST",
            url: "/like",
            data: {image_id: imageId}
        }).done(function(data) {
            if(data.action === 'unLike'){
                $(self).removeClass('my-like');
            }else{
                $(self).addClass('my-like');
            }
            $(self).data('likes',
                parseInt( $(self).data('likes') ) + ((data.action === 'like') ? 1 : -1)
            );
            var likeActions = $(document).find('.like-action[data-image-id="' + imageId + '"]');
            likeActions.each(function () {
                $counter = $(this).find('.likes-counter');
                $($counter).html($(self).data('likes'));
            });
        });
    })
})(jQuery);
