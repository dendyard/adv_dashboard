var where = window.location.host;
if(where == 'localhost:8899' || where == 'localhost' || where == '192.168.64.2'){
    var base_url = window.location.protocol + "//" + window.location.host + "/adv_dashboard/";
}
else{
    var base_url = window.location.protocol + "//" + window.location.host + "/";
}




	