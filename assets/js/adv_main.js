var where = window.location.host;
if(where == 'localhost:8899' || where == 'localhost' || where == '192.168.64.2'){
    var base_url = window.location.protocol + "//" + window.location.host + "/adv_dashboard/";
}
else{
    var base_url = window.location.protocol + "//" + window.location.host + "/";
}


var edate = $('#e_date').text();
var sdate = $('#s_date').text();
var selectedSite = '';

$('select#sitename_filter2').on('change', function(e){
		selectedSite = $(this).find("option:selected").val();
		//console.log(selectedText);
        
});

$('#summitFilter').on('click',function(){

    var sxfdate = $('#datetimepicker1').val();
    var exfdate = $('#datetimepicker2').val();
    
    var sfdate = sxfdate.split('-');
    var efdate = exfdate.split('-');
    
  
//  console.log('dt : ' + $('#datetimepicker1').val());
//  var po = sitename_filter.options[sitename_filter.selectedIndex].value; 
//  console.log('site names : ' + sitename_filter.options[sitename_filter.selectedIndex].value);
    
    var start   = formatzeronumber(sfdate[1]) + '/' + formatzeronumber(sfdate[0]) + '/' + sfdate[2]
    var end 	= formatzeronumber(efdate[1]) + '/' + formatzeronumber(efdate[0]) + '/' + efdate[2]
    var sitename 	= ((selectedSite == '' || selectedSite == 'All Campaign') ? '' : '&campaign_id='+ selectedSite);
    
    
    
    console.log('sfDate : ' + formatzeronumber(efdate[0]));
    
    location.href= base_url + '/?start='+start+'&end='+end + sitename;

});

function formatzeronumber(mynum){
    var newnum;
    if (mynum >= 10) {
        newnum = mynum;
    }else{
        newnum = mynum.replace('0','');
    }
    
    return newnum;
}
    

	