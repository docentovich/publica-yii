$('.image-ajax-upload img').on('click', function (event) {
    $(this).siblings('input[type=\'file\']').trigger('click');
});

if(bindArr && bindArr.forEach !== undefined){
    bindArr.forEach(function (item) {
        $(`#uploader-${item.id}`).bind('onUploadFinished', item.onUploadFinished);
        $(`#uploader-${item.id}`).bind('onUploadStart', item.onUploadStart);
    })
}

$('.image-ajax-upload input[type=\'file\']').on('change', function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening

    var $imageAjaxUpload = $($(this).parents('.image-ajax-upload')[0]);
    var formData = new FormData;
    multiplyiUpload = !!$imageAjaxUpload.attr('multiply');
    var files = Array.from(this.files);
    var self = this;

    files
        .filter(function (item) {
            return item.type.match('image.*');
        })
        .forEach(function (item) {
            formData.append($(self).attr('name') + (multiplyiUpload ? '[]' : ''), item);
        });

    $(self).trigger('onUploadStart');

    $.ajax({
        type: 'POST',
        url: $imageAjaxUpload.attr('action-url'),
        data: formData,
        method: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (!multiplyiUpload) {
                data = data[0];
            }
            if (!data || (data.url === undefined || data.relative_path === undefined))
                return false;

            if (!multiplyiUpload) {
                $imageAjaxUpload.children('img').on('load', function(){
                    $(self).trigger('onUploadFinished');
                });
                $imageAjaxUpload.children('img').attr('src', data.url);
                $imageAjaxUpload.children('input[type="hidden"]').val(data.relative_path);
            } else {
                var modelFiledName = $imageAjaxUpload.attr('mode-filed-name');
                for (var item in data) {
                    $imageAjaxUpload.append(
                        `<img src="{item.src}"/>`
                    );

                    $imageAjaxUpload.append(
                        `<input type="hidden" name="{modelFiledName}" value="{item.src}" accept="image/*" style="display: none">`
                    );
                }
            }
        },
        complete: function () {
        }
    });
});
