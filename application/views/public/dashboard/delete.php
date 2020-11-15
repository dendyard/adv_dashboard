
                    <!-- Creative Size -->
                    <div class="row"> 
                    
                        <div class="col-md-3 center-block" ></div>
                        <div class="col-md-6 center-block" >
                            <div class="card" style="height:100%;">
                                <div class="header" style="margin-bottom:30px;">
                                    <center>
                                    <h4 class="title_card">Delete Data of <?=$accountInfo['accountname']?></h4>
                                    </center>
                                    <p style="font-size: 12px;
    line-height: 1.5;
    text-align: center;
    font-weight: 100;
    color: blueviolet;">Caution : This process will delete selected table in Database, make sure you understand this feature functionality. If there any error during the process please contact The Web Developer</p>
</div>

                                
<input id="customstart" type="hidden" value="">
<input id="customend" type="hidden" value="">
<input id="prefix" type="hidden" value="<?=$accountInfo['prefix']?>">
<input id="a_name" type="hidden" value="<?=$accountInfo['accountname']?>">
                                
            <div class="row user-form">
            <div class="col-md-6">
                <select name="tblname" data-live-search="true" data-width="110%" id="tblname" class="selectpicker" title="Select Table"> 
                    <option selected value="camp_report">Campaign Report</option>
                    <option value="camp_report">Version Report</option>
                    <option value="camp_report">Unique Report</option>
                    <option value="camp_report">Video Report</option>
                </select>    
            </div>                    
            </div>
            <div class="row user-form">
                <div class="col-md-12">

                    <div class="form-group">

                        <div class="filter-elements">
                        <p class="filter-text-new">Start Date</p>
                        <div class="input-group date date-filter" style="margin-top: 1px;" data-date-format="yyyy.mm.dd">
                           <input id="datetimepicker1"  type="text" class="form-control datetimepicker" placeholder="Choose Date">
                            <div class="input-group-addon" id="input_btn_calendar" >
                              <span class="pe-7s-date"  style="font-size: 20px;"></span>
                            </div>
                        </div>
                        </div>
                        <div class="filter-elements">
                            <p class="filter-text-new">End Date</p>
                            <div class="input-group date date-filter" style="margin-top: 1px;" data-date-format="yyyy.mm.dd">
                                <input id="datetimepicker2" type="text" class="form-control datetimepicker" placeholder="Choose Date">
                                <div class="input-group-addon" >
                                  <span class="pe-7s-date" style="font-size: 20px;"></span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>                    
                </div>
                                
                                <div class="row user-form">

                                    <div class="col-md-6">
                                        <button style='width:130px;' onclick='deletedata();' class="btn btn-info btn-fill pull-right">Delete Data</button>
                                        
                                        <button style='width:90px;  margin-right:10px;' type="button" onclick='window.location.href="<?php echo base_url('/'); ?>"'   class="btn btn-warning btn-fill pull-right">Cancel</button>&nbsp;&nbsp;
                                                
                                    </div>
                                </div>
                                
                            </div>
                                
                       </div>
                       <div class="col-md-3 center-block" ></div>
                    
                </div>

<div class="row"> 
                    
                        <div class="col-md-3 center-block" ></div>
                        <div class="col-md-6 center-block" >
                            <div class="card" style="height:100%;">
                                <div class="header" style="margin-bottom:30px;">
                                    <center>
                                    <h4 class="title_card">Delete This Account</center>
                                    <p style="font-size: 12px;
    line-height: 1.5;
    text-align: center;
    font-weight: 100;
    color: blueviolet;">Caution : This process will delete whole data of <?=$accountInfo['accountname']?>, make sure you understand this feature functionality. If there any error during the process please contact The Web Developer</p>
</div>

                                
            <div class="row user-form">
                           
            </div>
            <div class="row user-form">
                <div class="col-md-12">

                    <div class="form-group">

                        
                        <p class="filter-text-new">Type Prefix selected account name</p>
                        <input type="text" id='dropacc' name="dropacc" class="form-control">
                        
                        
                    </div>
                    
                    
                </div>                    
                </div>
                                
                                <div class="row user-form">

                                    <div class="col-md-12">
                                        
                                        <button style='width:130px;' onclick='dropdata();' class="btn btn-info btn-fill pull-right">Drop Table</button>        
                                    </div>
                                </div>
                                
                            </div>
                                
                       </div>
                       <div class="col-md-3 center-block" ></div>
                    
                </div>


            </div>
        </div>
    </div>
    </div>
</div>
<div id="load_post_ring" class="modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color: transparent; border: none; box-shadow: none; -webkit-box-shadow: none;">
			<div class="modal-body" style="background: none !important;">
				<div style="height:200px">
					<img src="https://samherbert.net/svg-loaders/svg-loaders/tail-spin.svg" class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom" id="searching_spinner_center" style="position: relative;display: block;left: 40%;top: 50%;/* font-size: 9em; */color: #ffffff;width: 100px;"></span>
				</div>
			</div>
			<div class="modal-footer" style="border-top: none; text-align: center; color: #fff; margin-top: -38px;">
				<h3>Please Wait ...</h3>
				<!-- <small>Jangan melakukan apapun sampai proses selesai.</small> -->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    progress_stop();

    
    function date_diff_indays (date1, date2) {
        dt1 = new Date(date1);
        dt2 = new Date(date2);
        return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()) ) /(1000 * 60 * 60 * 24));
    }
    
    
    function dropdata(){
        var validate = true;
        if (dropacc.value == '' || dropacc.value != prefix.value) {
            toastr["warning"]("You must Enter correct Prefix account to confirm this process", "Notification");
            validate = false;
        }else{
            var r = confirm("Are you sure want to drop account : \n" + a_name.value + " ?");
            if (r == true) {
                $.ajax({
				type: 'POST',
				url: base_url + 'adv/accDropProg',
				dataType: 'json',
				data: {
                       prefixs:prefix.value,
                      }
                }).done(function (result) {
                    if(result.status){

                        window.location.href = base_url + '/';

                    }
                    else{
                        $('#load_post_ring').modal('hide');
                        toastr["warning"](result.msg, "Notification");

                    }
                });
            } 
            
            $('#load_post_ring').modal('hide'); 
            
        }
    }
    
    function deletedata(){
        var slct = '';
        var tbl = '';
        
        var validate = true;
        var d1,d2;
        
        
        switch(tblname.selectedIndex){
            case 1:
                slct = 'Campaign Report';
                tbl = 'campaign_report';
                break;
            case 2:
                slct = 'Version Report';
                tbl = 'campaign_version';
                break;
            case 3:
                slct = 'Unique Report';
                tbl = 'campaign_unique';
                break;
            case 4:
                slct = 'Video Report';
                tbl = 'campaign_video';
                break;
                
        }
        
        
        if ($("input#customstart").val() == '') {
            toastr["warning"]("Please select Start Date.", "Notification");
            validate = false;
        }else{
            if ($("input#customend").val() == '') {
                toastr["warning"]("Please select End Date.", "Notification");
                validate = false;
            }else{
               d1 = $("input#customstart").val();
               d2 = $("input#customend").val();
                
               if (date_diff_indays($("input#customstart").val(), $("input#customend").val()) < 0) {
                   toastr["warning"]("Date range not valid!", "Notification");
                   validate = false;
               }
            }
        }
        
        
        if (validate) {
            var r = confirm("Are you sure want to delete data : \n" + slct + " \n Period : " + d1 + " to " + d2 + " ?");
            
            if (r == true) {
                $.ajax({
				type: 'POST',
				url: base_url + 'adv/accDelProg',
				dataType: 'json',
				data: {
                       prefixs:prefix.value,
                       tabName:tbl,
                       startDate:d1,
                       endDate:d2,
                      }
                }).done(function (result) {
                    if(result.status){

                        window.location.href = base_url + '/';

                    }
                    else{
                        $('#load_post_ring').modal('hide');
                        toastr["warning"](result.msg, "Notification");

                    }
                });
            } 
            
            $('#load_post_ring').modal('hide');    
        }
        
    }
    
    
</script>