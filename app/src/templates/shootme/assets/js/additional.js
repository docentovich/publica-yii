Date.prototype.yyyymmdd = function () {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    return [this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd
    ].join('-');
};

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
