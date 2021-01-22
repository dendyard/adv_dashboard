
                    <!-- Creative Size -->
                    <form onsubmit="return addNewUser()">
                        <div class="col-md-3 center-block" ></div>
                        <div class="col-md-6 center-block" >
                            <div class="card" style="height:100%;">
                                <div class="header" style="margin-bottom:30px;">
                                    <center>
                                    <h4 class="title_card">Add New Custom Report</h4>
                                    </center>
                                    <p style="font-size: 12px;
    line-height: 1.5;
    text-align: center;
    font-weight: 100;
    color: blueviolet;">Caution : This process will add a table in Database, make sure you understand this feature &amp; functionality. If there any error during the process please contact The Web Developer</p>
                                </div>
                                
                                
                                <div class="row user-form">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Custom Report Name</label>
                                            <input type="text" id='accountname' name="accountname" class="form-control" placeholder="eg : ADV Custom Report" required="" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Table Prefix</label>
                                            <input type="text" id='prefix' name="prefix" class="form-control" placeholder="eg : adv_custom_report_1" required="" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Column Number</label>
                                            <input type="text" id='colnum' name="colnum" class="form-control" value="1" placeholder="" required="" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12" style="display:none;">
                                        <div class="form-group">
                                            <label>Conversion Column</label>
                                            <input type="text" id='conve' name="conve" class="form-control" value='0' >
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row user-form">
                                    <div class="col-md-6">
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <button style='width:180px;' type="submit"  class="btn btn-info btn-fill pull-right">Save Custom Report</button>
                                        
                                        <button style='width:90px;  margin-right:10px;' type="button" onclick='window.location.href="<?php echo base_url('/'); ?>"'   class="btn btn-warning btn-fill pull-right">Cancel</button>&nbsp;&nbsp;
                                                
                                    </div>
                                </div>
                                
                            </div>
                                
                       </div>
                       <div class="col-md-3 center-block" ></div>
                    </form>
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

    function addNewUser(){
		$('#load_post_ring').modal('show');
		var accname = $("#accountname").val();
        var prefix = $("#prefix").val();
        var conv_form = $("#conve").val();
        var colnum = $("#colnum").val();
        
		var success = true;
        
        if(accname == ""){
            toastr["warning"]("Please fill out Custom Report Name.", "Notification");
            success = false;
        }

        if(prefix == ""){
            toastr["warning"]("Please fill out Table Prefix name", "Notification");
            success = false;
        }

        if(colnum == ""){
            toastr["warning"]("Please fill out Column Number", "Notification");
            success = false;
        }

        if(conv_form == ""){
            toastr["warning"]("Please fill out Conversion column", "Notification");
            success = false;
        }

        
        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'adv/accAddProgCustom',
				dataType: 'json',
				data: {accountName: accname,
                       prefix:prefix,
                       conv:conv_form,
                       colnum:colnum,
                      }
			}).done(function (result) {
			if(result.status){
				//window.setTimeout(function(){
				    window.location.href = base_url + '/';
				//}, 3000);
			}
			else{
				$('#load_post_ring').modal('hide');
				$.notify("Warning:" + result.msg, "warn");
			}
			});
		}

		return false;
	}
    
    
</script>