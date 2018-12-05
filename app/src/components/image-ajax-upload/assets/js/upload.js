$(".image-ajax-upload img").on("click", function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening

    $(this).closest('.image-ajax-upload').find("input[type=\"file\"]").trigger("click");
});

$(".image-ajax-upload input[type=\"file\"]").on("change", function (event) {
    event.preventDefault(); // Totally stop stuff happening
    event.stopPropagation(); // Stop stuff happening
    if(this.block === true)
    {
        this.block = false;
        return;
    }
    // this.fileStorage = this.fileStorage || [];
    this.fileStorage = this.fileStorage || new ClipboardEvent('').clipboardData || // Firefox bug?
        new DataTransfer();                              // specs compliant


    if (this.files && this.files[0]) {
        var self = this;
        var newFile = this.files[0];
        var $imageAjaxUpload = $(this).closest('.image-ajax-upload');
        var multiply = !!parseInt( $imageAjaxUpload.attr('multiply') );
        var reader = new FileReader();
        if(multiply) {
            this.fileStorage.items.add(this.files[0]);
        }

        reader.onload = function (e) {
            if(!multiply){
                $imageAjaxUpload.children('div.images').children('img').attr('src', e.target.result);
            }
            else{
                var img = '<img src="' + e.target.result + '"/>';
                $imageAjaxUpload.children('div.images').prepend(img);
                self.block = !(self.files.length === self.fileStorage.files.length);
                self.files = self.fileStorage.files;
            }
        };

        reader.readAsDataURL(this.files[0]);
    }
});