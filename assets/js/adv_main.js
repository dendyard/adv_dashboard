var where = window.location.host;
if(where == 'localhost:8899' || where == 'localhost' || where == '192.168.64.2'){
    var base_url = window.location.protocol + "//" + window.location.host + "/adv_dashboard/";
}
else{
    var base_url = window.location.protocol + "//" + window.location.host + "/";
}

/*
var edate = $('#e_date').text();
var sdate = $('#s_date').text();
*/
$('#datetimepicker1').datetimepicker({
		format: 'YYYY-MM-DD',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
		}
    }).on('dp.change', function(e) {
		var xxx = e.date.format('YYYY-MM-DD');
		$("input#customstart").val(xxx);
	});

	$('#datetimepicker2').datetimepicker({
		format: 'YYYY-MM-DD',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    }).on('dp.change', function(e) {
		var xxx = e.date.format('YYYY-MM-DD');
		$("input#customend").val(xxx);
	});

var start = $('#datetimepicker1').val();
var end 	= $('#datetimepicker2').val();
	