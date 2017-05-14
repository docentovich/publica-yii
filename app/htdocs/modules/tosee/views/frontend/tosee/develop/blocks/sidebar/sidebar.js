var sidebar = new bem('sidebar');

$(sidebar.e('close')).on('click', function(){
    sidebar_single = sidebar.single(this);
    sidebar_single.JQb().toggleClass('active');
    $('html').toggleClass('no-y-scroll');
});