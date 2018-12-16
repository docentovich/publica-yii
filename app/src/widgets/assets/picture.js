(function ($) {
    $(document).on('afterShow.fb', function (event, instance, slide) {
        $(slide.$slide[0]).find('[data-src]').each(function () {
            var src = $(this).data('src');
            var attr = $(this).data('attr');
            $(this).attr(attr, src);
            var self = this;
            $(this).on('load', function () {
                $(self).removeAttr('data-src');
                $(self).removeClass('loading');
            });

        });

    });
})(jQuery);