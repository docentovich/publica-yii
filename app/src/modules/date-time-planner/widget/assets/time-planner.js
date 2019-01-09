/**
 * Example:
 *
 * I)
 *    $this->registerJs(
 *    <<<MJS
 *    $('#mid').on('timeSelected', function(_, time, date){
 *         var a = $(this).data('date');
 *         var b = $(this).data('time');
 *     })
 *    $('#mid').on('dateSelected', function(_, date){
 *       var a = $(this).data('date');
 *     })
 *    MJS
 *    , \yii\web\View::POS_END
 *    );
 *
 * II)
 *     $this->registerJs(
 *     <<<MJS
 *     $('#planner-form').on('ajax:success', function(_, time){
 *        $('#mid').trigger('dateSelected');
 *      })
 *     MJS
 *     , \yii\web\View::POS_END
 *     );
 */

Number.prototype.padZero = function (len) {
    var s = String(this), c = '0';
    len = len || 2;
    while (s.length < len) s = c + s;
    return s;
};

function getYmd(date) {
    return [date.getFullYear(), (date.getMonth() + 1).padZero(), date.getDate().padZero()].join('-')
}

(function ($) {
    /**
     * @param date Date
     */
    $('.date-time-picker').on('dateSelected', function (_, date) {
        date = date || this.date || new Date();
        // save date on DOM
        this.date = date;
        $(this).data('date', date);

        var dateString = getYmd(date);
        var user_id = $(this).data('user_id');
        var url = UrlManager.createUrl('planner/date-time-api/get-busy', {user_id});
        var self = this;
        var $timepicker = $(self).children('.timepicker');

        $.post(url, {date: dateString})
            .done(function (data) {
                $timepicker.show();
                $timepicker.find('.time-table').myTimePicker({
                    data,
                    onTimeSelected: function (time) {
                        selectTime(time, self);
                        $(self).trigger('timeSelected', [time, date]);
                    }
                });
            });
    });

    var selectTime = function(time, wrapper){
        var $wrapper = $(wrapper);
        var inputHtml = $wrapper.data('time-input-html');
        var $inputsWrapper = $wrapper.find('.time-inputs-wrapper');
        $inputsWrapper.html('');
        var selectedDateTime = [];

        // Create inputs from selected td
        $wrapper.find('.time-table td.active').each(function () {
            var val = $(this).data('time');
            selectedDateTime.push(val);

            // add active time input
            if ($inputsWrapper) {
                var $inputHtml = $(inputHtml);
                $inputsWrapper.append($inputHtml);
                $inputHtml.val(val);
            }
        });

        // Save selected time to date-time and DOM params
        $wrapper.data('time', selectedDateTime);
        wrapper.dateTime = selectedDateTime;
    };

    /** @param e {{ date: Date }} */
    $('.datepicker').on('changeDate', function (e) {
        $(this).siblings('.date-input-wrapper').find('.dtp-date-input').val(getYmd(e.date));
        $(this).parents('.date-time-picker').trigger('dateSelected', e.date);
    });

    $.fn.myTimePicker = function (options) {
        var timeDefault = timeDefaultServer || ['0-2', '2-4', '4-6', '6-8', '8-10', '10-12', '12-14', '14-16', '16-18', '18-20', '20-22', '22-24'];
        timeDefault = timeDefault.map(function (time) {
            return {time, busy: options.data.includes(time)};
        });
        var times = [];
        while (timeDefault.length > 0) {
            times.push(timeDefault.splice(0, 2));
        }

        var columne = function (td) {
            var time = td.time;
            var tdClass = (td.busy) ? 'busy' : '';
            return '<td class="' + tdClass + '" data-time="' + time + '" id="td-' + time + '">' + time + '</td>';
        };
        var row = function (tr) {
            return '<tr>' + tr.map(function (td) {
                return columne(td);
            }).join('') + '</tr>'
        };
        var table = '<table  class="time-table">' + times.map(function (tr) {
            return row(tr);
        }).join('') + '</table>';
        this.html('');
        this.append(table);

        this.find('td:not(.busy)').on('click', function () {
            $(this).toggleClass('active');
            if (options.onTimeSelected) {
                options.onTimeSelected($(this).data('time'));
            }
        });
    };
})(jQuery);