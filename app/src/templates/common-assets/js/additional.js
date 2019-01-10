if(jQuery.fn.imagesLoaded === undefined){
    jQuery.fn.imagesLoaded = function (cb) {
        cb();
    }
}
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
                $this.trigger('ajax:success', data);
            },
            error: function (error) {
                var fn = $this.attr('onerror');
                if(!!fn) {
                    fn =  fn.replace(/(?:\r\n|\r|\n)/g, '');
                    var func = new Function('error', "(" + fn + ")(error)");
                    func.call(self, error);
                }
                $this.trigger('ajax:error', data);
            }
        });
        return false;
    });


    /** trigger click **/
    $(document).ready(function () {
        $('.share-button').on('click', function (e) {
            $(this).toggleClass('need-share-button-opened');
            e.stopPropagation();
            e.preventDefault();

        });
    });

})(jQuery);