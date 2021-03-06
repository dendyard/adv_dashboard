
                    <!-- Creative Size -->
                    <form onsubmit="return addNewUser()">
                        <div class="col-md-3 center-block" ></div>
                        <div class="col-md-6 center-block" >
                            <div class="card" style="height:100%;">
                                <div class="header" style="margin-bottom:30px;">
                                    <center>
                                    <h4 class="title_card">Add New User</h4>
                                    </center>
                                </div>
                                
                                
                                <div class="row user-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" id='firstName' name="firstName" class="form-control" placeholder="First Name" required="" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" id='lastName' name="lastName" class="form-control" placeholder="Last Name" required="" >
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row user-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" id='email' name="email" class="form-control" placeholder="Email Address" required="" >
                                        </div>
                                    </div>
<?php if($this->session->userdata('role') == '0'){ ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User Role</label>
                                            <div class="checkbox checkbox_select">
                                            
                                            <select name="role" id="role" class="selectpicker" data-title="Select User Role" required="">       
                                                    <option title="Super Admin"  value="0">Super Admin</option>
                                                    <option title="User" selected="true" value="1">User</option>
                                               

                                                </select> 
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>    
                                </div>
                                <div class="row user-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User Password</label>
                                            <input id='password'  type="password" name="password" class="form-control" placeholder="Password" required="" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input id='confirmPassword'  type="password" name="confirmPassword" class="form-control" placeholder="Password" required="" >
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                <div class="row user-form">
                                    <div class="col-md-6">
                                       
                                    </div>
                                    <div class="col-md-6">
                                        <button style='width:130px;' type="submit"  class="btn btn-info btn-fill pull-right">Save User</button>
                                        
                                        <button style='width:90px;  margin-right:10px;' type="button" onclick='window.location.href="<?php echo base_url('user'); ?>"'   class="btn btn-warning btn-fill pull-right">Cancel</button>&nbsp;&nbsp;
                                                
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
		var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();

		var success = true;
        
        if(firstName == ""){
            toastr["warning"]("Please fill out first name.", "Notification");
            success = false;
        }

        if(lastName == ""){
            toastr["warning"]("Please fill out last name.", "Notification");
            success = false;
        }
        if(email == ""){
            toastr["warning"]("Please fill out email.", "Notification");
            success = false;
        }

        if(password == ""){
            toastr["warning"]("Please fill out password.", "Notification");
            success = false;
        }

        if(confirmPassword == ""){
            toastr["warning"]("Please fill out confirm password.", "Notification");
            success = false;
        }

        if(password !== confirmPassword){
            toastr["warning"]("Password doesn't match. Please re-confirm the password.", "Notification");
            success = false;
            $('#load_post_ring').modal('hide');
        }

        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'user/userUpsert',
				dataType: 'json',
				data: {password: password, 
                       firstName: firstName, 
                       lastName: lastName, 
                       email: email
                      }
			}).done(function (result) {
			if(result.status){
               window.location.href = base_url + '/user';
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