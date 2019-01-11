(function ($) {

$(document).ready(function () {
    $('#finish-order-toggle').on('click', function () {
        $('#finish-order').addClass('active');
    });
    $('#finish-order-control-no').on('click', function () {
        $('#finish-order').removeClass('active');
    });
});
})(jQuery);