Number.prototype.padZero= function(len){
    var s = String(this), c= '0';
    len= len || 2;
    while(s.length < len) s= c + s;
    return s;
};

(function ($) {
    /** @param{{ date: Date }} e*/
    $('.datepicker').on('changeDate', function (e) {
        var date = [e.date.getFullYear(), (e.date.getMonth() + 1).padZero(), e.date.getDate().padZero()].join('-');
        debugger;
        var url = UrlManager.createUrl('planner/date-time-api', {action: 'get-busy'});
        $.post(url, function (data) {
            $(this).find('.time-table').myTimePicker({data: ['0-2', '4-6']});
        });

    });

    $('.date-time-picker').on('timeSelected', function (_, time) {
        this.find('.dtp-input').val(time);
    });

    $.fn.myTimePicker = function(options) {
        var timeDefault = ['0-2', '2-4', '4-6', '6-8', '8-10', '10-12', '12-14', '14-16', '16-18', '18-20', '20-22', '22-24'];
        timeDefault = timeDefault.map(function (time) {
                return {time, busy: options.data.includes(time)};
            });
        var times = [];
        while (timeDefault.length > 0){
            times.push(timeDefault.splice(0, 2));
        }

        var columne = function(td){
            var time = td.time;
            var tdClass = (td.busy) ? 'busy' : '';
            return '<td class="' + tdClass + '" data-time="' + time + '" id="td-' + time + '">' + time + '</td>';
        };
        var row = function(tr){
            return '<tr>' + tr.map(function(td){ return columne(td); }).join('') + '</tr>'
        };
        var table = '<table  class="time-table">' + times.map(function (tr) { return row(tr); }).join('') + '</table>';
        this.append(table);

        var self = this;
        this.show();
        this.find('td').on('click', function () {
            self.trigger('timeSelected', $(this).data('time'));
            self.parents('.date-time-picker').trigger('timeSelected', $(this).data('time'));
        });
    };
})(jQuery);