$(".image-ajax-upload img").on("click", function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening

    $(this).closest('.image-ajax-upload').find("input[type=\"file\"].trigger").trigger("click");
});

$(".image-ajax-upload input[type=\"file\"].trigger").on("change", function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening

    var self = this;
    var $imageAjaxUpload = $(this).closest('.image-ajax-upload');
    var multiply = !!parseInt($imageAjaxUpload.attr('multiply'));
    var id = $imageAjaxUpload.attr('id');
    if (!multiply) {
        this.fileStorage = null;
    }
    this.fileStorage = this.fileStorage
        || new ClipboardEvent('').clipboardData // Firefox bug?
        || new DataTransfer();                  // specs compliant
    var uploaderInput = $(this).siblings('input[type="file"].uploader').get(0);

    $(this.files).each(function () {
        var reader = new FileReader();
        self.fileStorage.items.add(this);

        reader.onload = function (e) {
            if (!multiply) {
                $imageAjaxUpload.children('div.images').children('img').attr('src', e.target.result);
                uploaderInput.files = self.fileStorage.files;
            }
            else {
                $imageAjaxUpload.children('div.images').prepend('<img src="' + e.target.result + '"/>');
                uploaderInput.files = self.fileStorage.files;
            }
        };

        reader.readAsDataURL(this);
    });
});