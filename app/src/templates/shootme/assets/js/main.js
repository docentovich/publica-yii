(function ($) {
$(document).ready(function () {
    var closeAllOverlay = function () {
        $('.shootme-filter-overlay').removeClass('is-active');
        var isAllSelected = $('.shootme-inputs').toArray().every(function (input) {
            return !!$(input).val();
        });
        if (isAllSelected) {
            $(document).trigger('complete:select-filter');
        }
    };

    $('.shootme-filter-control, .back-button').on('click', function () {
        $('#' + $(this).data('rel')).toggleClass('is-active');
    });

    $('.back-button').on('click', function () {
        closeAllOverlay();
    });

    $('#date-time-picker').on('timeSelected', function (_, time, date) {
        /** @var Date date */
        $('#time-input').val(time);
        $('#date-input').val(date.yyyymmdd());
        $('#when-control span').html(date.yyyymmdd() + ' ' + time);
        closeAllOverlay();
    });

    $('#cities li').on('click', function () {
        $('#where-input').val($(this).data('city-name'));
        $('#where-control span').html($(this).data('city-label'));
        closeAllOverlay();
    });
});
})(jQuery);