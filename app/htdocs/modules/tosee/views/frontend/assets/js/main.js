(function ($) {
    $.extend($.datepicker, {

        // Reference the orignal function so we can override it and call it later
        _inlineDatepicker2: $.datepicker._inlineDatepicker,

        // Override the _inlineDatepicker method
        _inlineDatepicker: function (target, inst) {

            // Call the original
            this._inlineDatepicker2(target, inst);

            var beforeShow = $.datepicker._get(inst, 'beforeShow');

            if (beforeShow) {
                beforeShow.apply(target, [target, inst]);
            }
        }
    });
}(jQuery));

(function ($) {
    /* ---------набор функций--------------- */

    /* биндим контекст */
    function bind(func, context) { // первое перменная - функция, второе контекст
        return function () { // возвращаем анаонимную функцию, при ее вызове выоветься func.apply с уже имеющимя контекстом из переменной context
            return func.apply(context, arguments); //arguments любое кол во аргументов. такой вызов свяжет функцию с ранее переданным аргументом
        };
    }

    /* ---------набор функций---------н */

    /* БЭМ обьектный стиль  */
    function bem(block, obj) {


        this.b = function (name) {
            return "." + this._b(name);
        }

        this.e = function (name) {
            return "." + this._e(name);
        }

        this.m = function (name, el) {
            return "." + this._m(name, el);
        }

        this.bm = function (name) {
            return "." + this._bm(name);
        }


        this._b = function (name) {
            if (name != undefined)
                this.block = name;
            return this.block;
        }

        this._e = function (name) {

            if (name == undefined)
                name = this.element;

            this.element = name;
            return this.block + "__" + name;
        }

        this._m = function (name, el) {
            if (el == undefined || el == "" || el == null) el = this.element;
            return this.block + "__" + el + "_" + name;
        }

        this._bm = function (name) {
            return this.block + "_" + name;
        }

        /* переключение модификатора юлока*/
        this.toggleBm = function (name) {
            this.$block.toggleClass(this._bm(name));
            return this;
        }

        /* переключение модификатора юлока*/
        this.addBm = function (name) {
            this.$block.addClass(this._bm(name));
            return this;
        }

        /* переключение модификатора юлока*/
        this.removeBm = function (name) {
            this.$block.removeClass(this._bm(name));
            return this;
        }

        /* переключение модификатора элемента*/
        this.toggleM = function (element, name) {
            this.$block.find(this.e(element)).toggleClass(this._m(name));
            return this;
        }

        /* получаем новй экземпляр бэм с одним родителем */
        this.single = function (obj) {

            var $obj;

            if ($(obj).is(this.b())) {
                $obj = $(obj);//если получили блок то его использем
            } else {
                $obj = $(obj).parents(this.b()); //если получили элмент то находим блок
            }
            return new bem(this.block, $obj);
        }

        /* возвращем текующую коллекю локов */
        this.JQb = function () {
            return this.$block;
        }

        /* получаем элемент*/
        this.JQe = function (name) {
            var sel = this.b() + "__" + name;
            return this.$block.find(sel);
        }

        /* бэм микс */
        this.mix = function (element, block) {
            if (block == undefined || block == null) block = element;
            var sel = this.b() + "__" + element;
            var $element = this.$block.find(sel);
            var $obj = $element.find("." + block);
            return new bem(block, $obj);
        }

        /* биндим класс на дом боьекты
         bindBem(){
         var self = this;
         this.$block.each(function(){
         this['bem'] = self.single(this);
         });
         }
         */

        //construct
        this.block = block;
        if (obj == null || obj == undefined) {
            this.$block = $(this.b()); //все блоки
        }
        else
            this.$block = obj; //единственный обьект в клооекции
        //-construct

    };
    /* БЭМ обьектный стиль */


    $(document).ready(function () {
        $("body").removeClass("pageload");
        $("body").removeClass("no-js");


        var control1 = new bem('controls1');


        $(control1.e('conrol1')).on('click', function () {

            var target = $(this).attr("rel");

            $("#" + target).toggleClass("active");

            $('html').toggleClass("no-y-scroll");

        });


        // var modalca = '<div class="fancybox-container" role="dialog" tabindex="-1">' +


        // '<div class="fancybox-bg"></div>' +

        // '<div class="fancybox-controls">' +

        // '<div class="fancybox-infobar">' +

        // '<button data-fancybox-previous class="fancybox-button fancybox-button--left" title="Previous"></button>' +

        // '<div class="fancybox-infobar__body">' +

        // '<span class="js-fancybox-index"></span>&nbsp;/&nbsp;<span class="js-fancybox-count"></span>' +

        // '</div>' +

        // '<button data-fancybox-next class="fancybox-button fancybox-button--right" title="Next"></button>' +

        // '</div>' +

        // '<div class="fancybox-buttons">' +

        // '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="Close (Esc)"></button>' +

        // '</div>' +

        // '</div>' +


        // '<div class="fancybox-slider-wrap">' +


        // '<div class="fancybox-slider"></div>' +

        // '</div>' +

        // '<div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div>' +

        // '</div>';


        // $('.image-gal__a').fancybox(

        // {

        //     beforeShow: function () {

        //         if (this.title) {

        //                 // New line

        //                 this.title += '<br />';


        //                 // Add tweet button

        //                 this.title += '<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-url="' + this.href + '">Tweet</a> ';


        //                 // Add FaceBook like button

        //                 this.title += '<iframe src="//www.facebook.com/plugins/like.php?href=' + this.href + '&amp;layout=button_count&amp;show_faces=fals&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:23px;" allowTransparency="fals"></iframe>';

        //             }

        //         },

        //         afterShow: function () {

        //         // Render tweet button

        //         twttr.widgets.load();

        //     },

        //     helpers: {

        //         title: {

        //             type: 'inside'

        //         }

        //     }

        // });


        // $('.image-gal__a').modal();

        $fbg = $('.image-gal__a').fancybox({

            closeBtn: false,

            infobar: false,

            buttons: true,

            touch: false,

            tpl: {

                next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span>NEXT</span></a>',

                prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span>PREVIOUS</span></a>'

            },

            type: "inline",
            beforeMove: function (instance, slide) {
                //if()
                // Hide scrollbar for fancybox bug fix
                $a = instance.slides[instance.prevIndex];
                if($a == undefined) return;
                $a.$slide.css("overflow", "hidden");
                slide.$slide.css("overflow", "hidden");
            },


            afterMove: function (instance, slide) {
                // Restore scrollbar for fancybox bug fix
                $a = instance.slides[instance.prevIndex];
                if($a == undefined) return;
                $a.$slide.css("overflow", "hidden");
                slide.$slide.css("overflow", "");
            }

        });


        $(".modal__to-right").on("click", function () {

            $.fancybox.getInstance().next();

        });

        $(".modal__to-left").on("click", function () {

            $.fancybox.getInstance().previous();

        });


        var open_modal;

        $('.menu__a_calendar').on('click', function () {


            var id = $(this).attr("rel");

            var animation = $(this).attr("animation");

            // $("#"+id).toggleClass("menu__calendar_active");

            open_modal = id;

            $("#" + id).removeAttr('class');

            setTimeout(function () {

                    $("#" + id).addClass(animation), 1

                }
            );


        });


        $('#calendar').datepicker({

            inline: true,

            firstDay: 1,

            showOtherMonths: true,

            nextText: '',

            prevText: '',

            dateFormat: 'yy-mm-dd',

            dayNamesMin: ['Суб', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Вс'],

            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'], // set month names

            beforeShow: function (input) {

                afterShow();

            },

            onChangeMonthYear: function () {

                afterShow();

            },

            onSelect: function (dateText, inst) {

                window.location = "/" + dateText;

            }

        });


        var dateParts = queryDate.match(/(\d+)/g);

        var realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);


        $('#calendar').datepicker('setDate', realDate);


        function afterShow() {

            setTimeout(function () {

                var headerPane = $("#calendar .ui-datepicker ");

                // .datepicker( "widget" )

                // .find( ".ui-datepicker-header" );

                $("<a class='menu__calendar-close'>X</a>", {

                    click: function () {


                    }

                }).appendTo(headerPane);


                $('.menu__calendar-close').click(function (e) {

                    e.stopPropagation();

                    var a = $('#' + open_modal);

                    a.addClass('out');

                    $('body').removeClass('modal-active');

                });

            }, 1);

        }


        $(".pagination-item_disabled").on("click", function (e) {

            e.stopPropagation();

            e.preventDefault();

        });

        var sidebar = new bem('sidebar');


        $(sidebar.e('close')).on('click', function () {

            sidebar_single = sidebar.single(this);

            sidebar_single.JQb().toggleClass('active');

            $('html').toggleClass('no-y-scroll');

        });


    });
})(jQuery)
