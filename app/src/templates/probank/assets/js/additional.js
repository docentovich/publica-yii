Date.prototype.yyyymmdd = function () {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    return [this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd
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
        window.location = '/date/' + e.date.yyyymmdd();
        return false;
    });
})(jQuery);


(function ($) {
    // like
    $('.like-action').on('click', function (event) {

        var imageId = $(this).data('imageId');
        $.ajax({
            method: 'POST',
            url: '/like',
            data: {image_id: imageId}
        }).done(function (data) {
            $('.like-action[data-image-id="' + imageId + '"]').each(function(){
                $(this).data('likes', parseInt($(this).data('likes')) + ((data.action === 'like') ? 1 : -1));
                if (data.action === 'unLike') {
                    $(this).removeClass('my-like');
                } else {
                    $(this).addClass('my-like');
                }
            });
            var likeActions = $(document).find('.like-action[data-image-id="' + imageId + '"]');
            likeActions.each(function () {
                $counter = $(this).find('.likes-counter');
                $($counter).html($(this).data('likes'));
            });
        });
    })
})(jQuery);


(function ($) {
    // ajax form submit
    $('.form-ajax').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var data = $(this).serialize();
        var $this = $(this);
        var self = this;

        $.ajax({
            url: $this.attr('action'),
            type: 'POST',
            data: data,
            success: function (data) {
                var fn = $this.attr('onsuccess');
                if(!!fn) {
                    fn =  fn.replace(/(?:\r\n|\r|\n)/g, '');
                    var func = new Function('data', "(" + fn + ")(data)");
                    func.call(self, data);
                }
            },
            error: function (error) {
                var fn = $this.attr('onerror');
                if(!!fn) {
                    fn =  fn.replace(/(?:\r\n|\r|\n)/g, '');
                    var func = new Function('error', "(" + fn + ")(error)");
                    func.call(self, error);
                }
            }
        });
        return false;
    });
})(jQuery);