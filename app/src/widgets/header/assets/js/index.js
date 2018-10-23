(function ($) {
    /** controls on click */
    $('.toggle-drop-down-action-panel').on('click', function () {
        toggleDropDown($(this).attr('rel'));
        hideAllOverlay();
        toggleBodyIsOpenOverlay();
    });

    /** search on change */
    $('#search-input').on('keyup', function () {
        if (this.value !== '') {
            $('#search-placeholder').hide();
        } else {
            $('#search-placeholder').show();
        }
        showOverlay($(this).attr('rel'));
    });

    /** overlay toggler on click */
    $('.toggle-overlay').on('click', function () {
        toggleOverlay($(this).attr('rel'));
    });

    function toggleDropDown(rel) {
        hideOtherDropDown(rel);
        $('#drop-down-' + rel).toggleClass('is-open');
    }

    function hideOtherDropDown(rel) {
        $('.action-panel:not(#drop-down-' + rel + ')').removeClass('is-open');
    }

    function toggleOverlay(rel) {
        hideOtherDropDown(rel);
        hideOtherOverlay(rel);
        $('#' + rel + '-overlay').toggleClass('is-open');
        toggleBodyIsOpenOverlay();
    }

    function toggleBodyIsOpenOverlay() {
        if ($('.overlay').hasClass('is-open')) {
            $('body').addClass('is-open-overlay');
        } else {
            $('body').removeClass('is-open-overlay');
        }
    }

    function showOverlay(rel) {
        hideOtherDropDown(rel);
        $('#' + rel + '-overlay').addClass('is-open');
        toggleBodyIsOpenOverlay();
    }

    function hideAllOverlay() {
        $('.overlay').removeClass('is-open');
    }

    function hideOtherOverlay(rel) {
        $('.overlay:not(#' + rel + '-overlay)').removeClass('is-open');
    }
})(jQuery);