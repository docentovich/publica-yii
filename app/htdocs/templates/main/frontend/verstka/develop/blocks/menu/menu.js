var open_modal;
$('.menu__a_calendar').on('click', function(){

  var id = $(this).attr("rel");
  var animation = $(this).attr("animation");
  // $("#"+id).toggleClass("menu__calendar_active");
  open_modal = id;
  $("#"+id).removeAttr('class');
  setTimeout(function() {
    $("#"+id).addClass(animation), 1
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
  monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',   'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'], // set month names
  beforeShow: function( input ) {
    afterShow();
  },
  onChangeMonthYear: function (){
    afterShow();
  },
  onSelect: function(dateText, inst) {
    window.location = "/" + dateText;
  }
});

var dateParts = queryDate.match(/(\d+)/g);
var realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);  

$('#calendar').datepicker('setDate', realDate);

function afterShow(){
  setTimeout(function() {
    var headerPane = $( "#calendar .ui-datepicker " );
        // .datepicker( "widget" )
        // .find( ".ui-datepicker-header" );
        $( "<a class='menu__calendar-close'>X</a>", {
          click: function() {

          }
        }).appendTo( headerPane );

        $('.menu__calendar-close').click(function(e){
          e.stopPropagation();
          var a = $('#' + open_modal);
          a.addClass('out');
          $('body').removeClass('modal-active');
        });
      }, 1 );
}