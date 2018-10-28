$(".image-ajax-upload img").on("click", function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening

    $($(this).parents('.image-ajax-upload')[0]).find("input[type=\"file\"]").trigger("click");
});

$(".image-ajax-upload input[type=\"file\"]").on("change", function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening
    if (this.files && this.files[0]) {
        var $imageAjaxUpload = $($(this).parents('.image-ajax-upload')[0]);
        var reader = new FileReader();

        reader.onload = function (e) {
            $imageAjaxUpload.children('img').attr('src', e.target.result);
        };

        reader.readAsDataURL(this.files[0]);
    }
});