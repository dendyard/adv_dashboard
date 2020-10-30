var where = window.location.host;
if(where == 'localhost:8899' || where == 'localhost' || where == '192.168.64.2'){
    var base_url = window.location.protocol + "//" + window.location.host + "/dashboard_xaxis/";
}
else{
    var base_url = window.location.protocol + "//" + window.location.host + "/";
}

function progress_stop(){
        document.getElementById('progress_anim').style.display = 'none';
}


// --------------------- ADVERTISER -----------------------//
function advertiser_list(){     
    var loopstring = '';
    
    $.ajax({
    type: 'GET',
    url: base_url + 'advertiser_controller/get',
    dataType: 'json ',
    }).done(function (response) {
        
        if (response.data.length >= 1){
            for (var i=0;i < response.data.length; i++){
                loopstring += '<tr> \
                         <td>' + response.data[i].id + '</td> \
                         <td>' + response.data[i].name + '</td> \
                         <td>' + response.data[i].agencyName + '</td> \
                         <td>' + response.data[i].dv360AdvertiserId + '</td> \
                         <td>' + response.data[i].ttdAdvertiserId + '</td> \
                         <td>Enable</td> \
                         <td> \
                         <button style="width:70px;" type="button" \
                          class="btn btn-warning btn-fill pull-right " onclick="advertiser_delete(' + response.data[i].id + ')")>Delete</button>&nbsp;&nbsp; \
                        <button style="width:70px; margin-right:10px;" type="button"  onclick=window.location.href="' + base_url + 'advertiser/edit/' + response.data[i].id + '" class="btn btn-info btn-fill pull-right">Edit</button> \
                        </td></tr>';
            }
        }else{
            //Data empty
            console.log('Empty');
            loopstring = '<tr><td colspan="7" align="center">Oopps! No Data Found..</td></tr>';
        }
        
        document.getElementById('tadv_list').innerHTML = loopstring;
        document.getElementById('progress_anim').style.display = 'none';
        
    });   
}

function advertiser_add(){   
    var loopstring = '';
        
    var agencyAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/agency_controller/get/',
    dataType: 'json',
    });
    
    $.when(agencyAjax_call).done(function(agency_res) {
        
        if (agency_res.data.length >= 1){
            var agency_dropdown = $("#agency_list");
            
            for (var i=0;i < agency_res.data.length; i++){
                loopstring += '<option value="' + agency_res.data[i].id + '" title="' + agency_res.data[i].name + '">' + agency_res.data[i].name + '</option>';
            }
            document.getElementById('agency_list').innerHTML = loopstring;
            
        }else{
            //Data empty
            loopstring = '<option title="Empty">--Empty--</option>';
            document.getElementById('agency_list').innerHTML = loopstring;
        }
        
        document.getElementById('progress_anim').style.display = 'none';
    });
}

function advertiser_edit(id){     
    var loopstring = '';
        
    var agencyAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/agency_controller/get/',
    dataType: 'json',
    });
    
    var advertiserAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/advertiser_controller/find/' + id,
    dataType: 'json',
    });
    

    $.when(advertiserAjax_call, agencyAjax_call).done(function(advertiser_res, agency_res) {
        
        a_name.setAttribute('value',advertiser_res[0].data.name);
        dv360id.setAttribute('value',advertiser_res[0].data.dv360AdvertiserId);
        ttdid.setAttribute('value',advertiser_res[0].data.ttdAdvertiserId);
        
        if (agency_res[0].data.length >= 1){
            var agency_dropdown = $("#agency_list");
            
            for (var i=0;i < agency_res[0].data.length; i++){

                if (advertiser_res[0].data.agencyId == agency_res[0].data[i].id) {
                    loopstring += '<option selected value="' + agency_res[0].data[i].id + '" title="' + agency_res[0].data[i].name + '">' + agency_res[0].data[i].name + '</option>';
                }else{
                    loopstring += '<option value="' + agency_res[0].data[i].id + '" title="' + agency_res[0].data[i].name + '">' + agency_res[0].data[i].name + '</option>';
                }
                
            }
            document.getElementById('agency_list').innerHTML = loopstring;
            
        }else{
            //Data empty
            loopstring = '<option title="Empty">--Empty--</option>';
            document.getElementById('agency_list').innerHTML = loopstring;
        }
        
        document.getElementById('progress_anim').style.display = 'none';
    });
    
}


function advertiser_update(id=''){
   document.getElementById('progress_anim').style.display = 'block';
   var filelogo = '', ajaxEndpoint;

   if (id == ''){
       ajaxEndpoint = base_url + 'advertiser_controller/upsert/';
   }else {
        ajaxEndpoint = base_url + 'advertiser_controller/upsert/' + id;
   }
    
   filelogo = adv_logo_64.value;
   console.log ('Agency List Pick : ' + document.getElementById("agency_list").value)    
   $.ajax({
    type: 'POST',
    url: ajaxEndpoint,
    dataType: 'json',
    data: {
            name: a_name.value,
            dv360AdvertiserId: dv360id.value,
            ttdAdvertiserId: ttdid.value,
            agencyId: document.getElementById("agency_list").value,
            logo: filelogo
          }
    }).done(function (response) {
       window.location.href = base_url + "advertiser";
    });
}

function advertiser_delete(id){
        
    var r = confirm("Are you sure want to delete this record?");
    if (r == true) {
        document.getElementById('progress_anim').style.display = 'block';
        $.ajax({
            type: 'GET',
            url: base_url+'/advertiser_controller/hardDelete/'+ id,
            dataType: 'json',
        }).done(function (response) {
            console.log(response.success);
          if(response.success){
              console.log(response.status);
              window.location.href = base_url + "advertiser_controller";
          }
        });
    }
}
// --------------------- END OF ADVERTISER -----------------------//


//---------------------- AGENCY MASTER -------------------------//
function agency_list(){     
    var loopstring = '';
    
    $.ajax({
    type: 'GET',
    url: base_url+'agency_controller/get',
    dataType: 'json',
    }).done(function (response) {
        
        if (response.data.length >= 1){
            for (var i=0;i < response.data.length; i++){
                loopstring += '<tr> \
                         <td>' + response.data[i].id + '</td> \
                         <td>' + response.data[i].name + '</td> \
                         <td>' + response.data[i].logo + '</td> \
                         <td>' + response.data[i].favIcon + '</td> \
                         <td>' + response.data[i].status + '</td> \
                         <td> \
                         <button style="width:70px;" type="button" \
                          class="btn btn-warning btn-fill pull-right " onclick="agency_delete(' + response.data[i].id + ')")>Delete</button>&nbsp;&nbsp; \
                        <button style="width:70px; margin-right:10px;" type="button"  onclick=window.location.href="' + base_url + 'agency/edit/' + response.data[i].id + '" class="btn btn-info btn-fill pull-right">Edit</button> \
                        </td></tr>';
            }
        }else{
            //Data empty
            console.log('Empty');
            loopstring = '<tr><td colspan="6" align="center">Oopps! No Data Found..</td></tr>';
        }
        
        document.getElementById('age_list').innerHTML = loopstring;
        document.getElementById('progress_anim').style.display = 'none';
        
    });   
}

function agency_add(){   
    var loopstring = '';
        
    document.getElementById('progress_anim').style.display = 'none';
}

function agency_edit(id){     
    var loopstring = '';
        
    var agencyAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/agency_controller/find/' + id,
    dataType: 'json',
    });
    
   
    $.when(agencyAjax_call).done(function(agency_res) {
        
        age_name.setAttribute('value',agency_res.data.name);
        fav_logo_64.setAttribute('value',agency_res.data.logo);
        adv_logo_64.setAttribute('value',agency_res.data.favicon);
        
        document.getElementById('progress_anim').style.display = 'none';
    });
    
}

function agency_update(id=''){
   document.getElementById('progress_anim').style.display = 'block';
   var filelogo = '', ajaxEndpoint;
   
   if (id == ''){
       ajaxEndpoint =base_url+'agency_controller/upsert/';
       console.log("ADD");
   }else {
       ajaxEndpoint =base_url+'agency_controller/upsert/' + id;
   }
    
    
   $.ajax({
    type: 'POST',
    url: ajaxEndpoint,
    dataType: 'json',
    data: {
            name: age_name.value,
            logo: adv_logo_64.value,
            favIcon: fav_logo_64.value,
            status: document.getElementById("agency_status").value
          }
    }).done(function (response) {
       window.location.href = base_url + "agency";
    });
}


function agency_delete(id){
        
    var r = confirm("Are you sure want to delete this record?");
    if (r == true) {
        document.getElementById('progress_anim').style.display = 'block';
        $.ajax({
            type: 'GET',
            url: base_url+'/agency_controller/hardDelete/'+ id,
            dataType: 'json',
        }).done(function (response) {
            console.log(response.success);
          if(response.success){
              console.log(response.status);
              window.location.href = base_url + "agency_controller";
          }
        });
    }
}
//--------------------- END OF AGENCY MASTER -------------------//

//---------------------- USER MASTER -------------------------//
function user_list(){     
    var loopstring = '';
   
    
    $.ajax({
    type: 'GET',
    url: base_url + 'users_controller/get',
    dataType: 'json',
    }).done(function (response) {
        
        if (response.data.length >= 1){
            for (var i=0;i < response.data.length; i++){
                loopstring += '<tr> \
                         <td>' + response.data[i].id + '</td> \
                         <td>' + response.data[i].firstName + ' ' + response.data[i].lastName + '</td> \
                         <td>' + response.data[i].email + '</td> \
                         <td>' + response.data[i].role + '</td> \
                         <td>' + response.data[i].agencyName + '</td> \
                         <td>' + response.data[i].advertiserName + '</td> \
                         <td>' + response.data[i].status + '</td> \
                         <td> \
                         <button style="width:70px;" type="button" \
                          class="btn btn-warning btn-fill pull-right " onclick="user_delete(' + response.data[i].id + ')")>Delete</button>&nbsp;&nbsp; \
                        <button style="width:70px; margin-right:10px;" type="button"  onclick=window.location.href="' + base_url + 'user/edit/' + response.data[i].id + '" class="btn btn-info btn-fill pull-right">Edit</button> \
                        </td></tr>';
            }
        }else{
            //Data empty
            console.log('Empty');
            loopstring = '<tr><td colspan="6" align="center">Oopps! No Data Found..</td></tr>';
        }
        
        document.getElementById('user_list').innerHTML = loopstring;
        document.getElementById('progress_anim').style.display = 'none';
        
    });   
}

function user_add(){   
    var loopstring = '';
    var loopstring2 = '';
        
    var agencyAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/agency_controller/get/',
    dataType: 'json',
    });
    
    var advertiserAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/advertiser_controller/get/',
    dataType: 'json',
    });
    
    console.log(base_url + 'agency_controller/get/');
    $.when(advertiserAjax_call, agencyAjax_call).done(function(advertiser_res, agency_res) {
        
        if (agency_res[0].data.length >= 1){
            
            for (var i=0;i < agency_res[0].data.length; i++){
                loopstring += '<option value="' + agency_res[0].data[i].id + '" title="' + agency_res[0].data[i].name + '">' + agency_res[0].data[i].name + '</option>';
            }
            document.getElementById('agency_list').innerHTML = loopstring;
            
        }else{
            //Data empty
            loopstring = '<option title="Empty">--Empty--</option>';
            document.getElementById('agency_list').innerHTML = loopstring;
        }
        
        //Load Advertiser Data
        if (advertiser_res[0].data.length >= 1){
            for (var i=0;i < advertiser_res[0].data.length; i++){
                loopstring2 += '<option value="' + advertiser_res[0].data[i].id + '" title="' + advertiser_res[0].data[i].name + '">' + advertiser_res[0].data[i].name + '</option>';
            }
            document.getElementById('advertiser_list').innerHTML = loopstring2;
            
        }else{
            //Data empty
            loopstring2 = '<option title="Empty">--Empty--</option>';
            document.getElementById('advertiser_list').innerHTML = loopstring2;
        }
        
        document.getElementById('progress_anim').style.display = 'none';
    });
    
}

function user_edit(id){     
    var loopstring = '';
    var loopstring2 = '';
    
    var userAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/users_controller/find/' + id,
    dataType: 'json',
    });
    
    var agencyAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/agency_controller/get/',
    dataType: 'json',
    });
    
    var advertiserAjax_call = $.ajax({
    type: 'GET',
    url: base_url+'/advertiser_controller/get/',
    dataType: 'json',
    });
    
    console.log(base_url+'/users_controller/find/' + id)
    $.when(advertiserAjax_call, agencyAjax_call, userAjax_call).done(function(advertiser_res, agency_res, user_res) {
        //console.log(user_res[0].data)

        fname.setAttribute('value', user_res[0].data.firstName);
        lname.setAttribute('value', user_res[0].data.lastName);
        email.setAttribute('value', user_res[0].data.email);
        password.setAttribute('value', user_res[0].data.password);
         
        $('#role option[value=' + user_res[0].data.role + ']').attr('selected','true');
        if (agency_res[0].data.length >= 1){
            for (var i=0;i < agency_res[0].data.length; i++){
                if (user_res[0].data.agencyId == agency_res[0].data[i].id) {
                    loopstring += '<option selected value="' + agency_res[0].data[i].id + '" title="' + agency_res[0].data[i].name + '">' + agency_res[0].data[i].name + '</option>';
                }else{
                    loopstring += '<option value="' + agency_res[0].data[i].id + '" title="' + agency_res[0].data[i].name + '">' + agency_res[0].data[i].name + '</option>';
                }
            }
            document.getElementById('agency_list').innerHTML = loopstring;
            
        }else{
            loopstring = '<option title="Empty">--Empty--</option>';
            document.getElementById('agency_list').innerHTML = loopstring;
        }
        
        //Load Advertiser Data
        if (advertiser_res[0].data.length >= 1){
            
            for (var i=0;i < advertiser_res[0].data.length; i++){
                if (user_res[0].data.advertiserId == advertiser_res[0].data[i].id) {
                    loopstring2 += '<option selected value="' + advertiser_res[0].data[i].id + '" title="' + advertiser_res[0].data[i].name + '">' + advertiser_res[0].data[i].name + '</option>';
                }else{
                    loopstring2 += '<option value="' + advertiser_res[0].data[i].id + '" title="' + advertiser_res[0].data[i].name + '">' + advertiser_res[0].data[i].name + '</option>';
                }
            }
            document.getElementById('advertiser_list').innerHTML = loopstring2;
            
        }else{
            loopstring2 = '<option title="Empty">--Empty--</option>';
            document.getElementById('advertiser_list').innerHTML = loopstring2;
        }
        
        document.getElementById('progress_anim').style.display = 'none';
    });
    
}

function user_update(id=''){
   document.getElementById('progress_anim').style.display = 'block';
   var filelogo = '', ajaxEndpoint;
   
   if (id == ''){
       ajaxEndpoint =base_url+'users_controller/upsert/';
       console.log("ADD");
   }else {
       ajaxEndpoint =base_url+'users_controller/upsert/' + id;
   }
    
   console.log('First name : ' + fname.value);
   console.log('L name : ' + lname.value);
   console.log('email : ' + email.value);
    
   console.log('Pass name : ' + password.value);
   console.log('Adv ID name : ' + document.getElementById("advertiser_list").value);
   console.log('agencyId : ' + document.getElementById("agency_list").value);
   console.log('role : ' + document.getElementById("role").value);
               
   $.ajax({
    type: 'POST',
    url: ajaxEndpoint,
    dataType: 'json',
    data: {
            firstName: fname.value,
            lastName: lname.value,
            email: email.value,
            password: password.value,
            advertiserId: document.getElementById("advertiser_list").value,
            agencyId: document.getElementById("agency_list").value,
            role: document.getElementById("role").value,
          }
    }).done(function (response) {
       window.location.href = base_url + "user";
    });
}


function user_delete(id){
        
    var r = confirm("Are you sure want to delete this record?");
    if (r == true) {
        document.getElementById('progress_anim').style.display = 'block';
        $.ajax({
            type: 'GET',
            url: base_url+'/users_controller/hardDelete/'+ id,
            dataType: 'json',
        }).done(function (response) {
            console.log(response.success);
          if(response.success){
              console.log(response.status);
              window.location.href = base_url + "users_controller";
          }
        });
    }
}
//--------------------- END OF USER -------------------//




//---------------------- USER DASHBOARD -------------------------//

function dashboard_list(){  
  document.getElementById('progress_anim').style.display = 'none';
}

//--------------------- END OF USER -------------------//