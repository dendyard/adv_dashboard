

<style>

    .close {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #fff !important;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: 1 !important;
}
    
</style>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                               <center>
                                <h4 class="title_card">Site Name Mapping List</h4>
                                <p class="subtitle_card" id='filter_status'>
                                   Caution : Any changes on this setting will affect next data calculations. Click child badge to edit.
                                </p>
                               </center>
                            </div>
                            <button data-toggle="modal" data-target="#newgroup" data-idgroup="Kompas.com" style='width: 150px;margin-left: 10px;margin-bottom: 20px;'  type="button"  class="btn-props">Add New Group</button> 
                            <div class="content table-responsive table-full-width">
                                <table id='camp_list' class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>Domain Name Group</th>
                                    	<th style="width:30%">Site Name Child</th>
                                        <th>Created By</th>
                                    	<th>Last Update</th>
                                        <th>Action Domain Group</th>
                                        
                                    </thead>
                                    <tbody>
                                     
                                    <?php 
                                        $this->load->model('Map_Model');
                                        $numb = 1;
                                        foreach ($groupList as $listdata) {
                                            ?>
                                        
                                     <tr>
                                         <td><?=$numb?></td>
                                         <td><?=$listdata['groupname']?></td>
                                         <td>
                                             
                                    <?php 
                                                  
                                          $childdata = array (
                                                'cd' => $this->Map_Model->getChild($listdata['idmap']), 
                                            );        
                                          
                                            foreach ($childdata['cd'] as $chdata) {
                                                
                                            
                                    ?>
                                        <a data-toggle="modal" data-target="#manageChild" data-editchild3="<?=$chdata['childname']?>" 
                                                      data-idgroup3="<?=$chdata['idchild']?>" href="#">
                                          <span class="badge badge-pill badge-warning"><?=$chdata['childname']?></span>
                                        </a>
                                             
                                             <?php } ?>
                                             <a data-toggle="modal" data-target="#childgroup" data-idgroupName="<?=$listdata['groupname']?>" 
                                                      data-idgroup="<?=$listdata['idmap']?>"  href="#">
                                             <img style="width:20px;" src="<?=base_url();?>/assets/images/plus.svg">
                                             </a>   
                                             
                                          </td>
                                         <td><?=$listdata['createby']?></td>
                                         <td><?=$listdata['lastupdate']?></td>
                                         <td>  
                                             <button data-target="#editGroup" data-toggle="modal" data-idgroupNameEdit="<?=$listdata['groupname']?>" data-idgroup2="<?=$listdata['idmap']?>" style="width:80px;" type="button"  class="btn btn-props btn-fill ">Edit</button>
                                             <button style="width:80px;" type="button" class="btn btn-warning btn-fill" onclick="deleteGroup('<?=$listdata['idmap']?>','<?=$listdata['groupname']?>')">Delete</button>
                                             </td>
                                     </tr>
                                    <?php 
                                                $numb++;
                                             }
                                    ?>
                                    
                                    </tbody>
                                    
                                </table>

                            </div>
                        </div>
                    </div>


                    


                </div>
            </div>
        </div>

        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style='background-image: url(<?php echo base_url(); ?>assets/images/header-modal.jpg);
    background-repeat: no-repeat;
    background-size: cover;;color:#fff;height:80px;'>
          <button type="button" class="close make-right" style='color:#fff;' data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form onsubmit="return editGroup()">
      <div class="modal-body">
        

            <div class="card">
            <article class="card-body">
                   
                    <div class="row">
                        <div class="col-centered">
                            <h4 id='my-edit-group-name' class="text-centered">Something Went Wrong</h4>
                        </div>
                        <div class="col-centered">
                            <div class="form-group">
                                <input type='text' required="" name='mydomains2' style="width:80%" id='mydomains2'>
                            </div>
                            <input type="hidden" id="parentGroupIds2" value="">
                            
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-centered">
                            <img src="<?=base_url();?>/assets/images/loading.gif" style="width:50px; display:none" id='padd5'> 
                            <button type="submit" id='groupsubmits2'  class="btn-props">Update Group</button>
                            
                            
                        </div>
                    </div>            
                    
                    <div class="row">
                        <div class="col-centered text-center">
                            <br>
                            <small>
                               Please note, any changes on this feature will affected on your next data calculations
                            </small>    
                        </div>
                    </div>
                    

            </article>
            </div> <!-- card.// -->
      </div>
        </form>
      
    </div>
  </div>
</div>


<div class="modal fade" id="newgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style='background-image: url(<?php echo base_url(); ?>assets/images/header-modal.jpg);
    background-repeat: no-repeat;
    background-size: cover;;color:#fff;height:80px;'>
          <button type="button" class="close make-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form onsubmit="return addNewGroup()">
      <div class="modal-body">
        

            <div class="card">
            <article class="card-body">
                   
                    <div class="row">
                        <div class="col-centered">
                            <h4 id='my-group' class="text-centered">Please enter Domain group Name</h4>
                        </div>
                        <div class="col-centered">
                            <div class="form-group">
                                <input type='text' required="" name='mydomain' style="width:80%" id='mydomain'>
                            </div>
                            <input type="hidden" id="parentGroupId" value="">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-centered">
                            <img src="<?=base_url();?>/assets/images/loading.gif" style="width:50px; display:none" id='padd2'> 
                            <button type="submit" id='groupsubmit'  class="btn-props">Submit New Group</button>
                        </div>
                    </div>            
                    
                    <div class="row">
                        <div class="col-centered text-center">
                            <br>
                            <small>
                               Please note, any changes on this feature will affected on your next data calculations
                            </small>    
                        </div>
                    </div>
                    

            </article>
            </div> <!-- card.// -->
      </div>
        </form>
      
    </div>
  </div>
</div>

<div class="modal fade" id="childgroup" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style='background-image: url(<?php echo base_url(); ?>assets/images/header-modal.jpg);
    background-repeat: no-repeat;
    background-size: cover;;color:#fff;height:80px;'>
          <button type="button" class="close make-right light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <form onsubmit="return addNewChild()">
      <div class="modal-body">
            <div class="card">
            <article class="card-body">
                   
                    <div class="row">
                        <div class="col-centered">
                            Add Child Group for
                            <h4 id='my-challange' class="text-centered">Something Wrong!</h4>
                        </div>
                        <div class="col-centered">
                            <div class="form-group">
                                <input type='text' required=""  name='newchild' style="width:80%" id='newchild'>
                            </div>
                            <input type="hidden" id="parentGroupId" value="">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-centered">
                            <img src="<?=base_url();?>/assets/images/loading.gif" style="width:50px; display:none" id='padd'> 
                            <button type="submit" class="btn-props" id='childSubmit'>Submit New Child</button>
                        </div>
                    </div>            
                    
                    <div class="row">
                        <div class="col-centered text-center">
                            <br>
                            <small>
                               Please note, any changes on this feature will affected on your next data calculations
                            </small>    
                        </div>
                    </div>
                    

            </article>
            </div> <!-- card.// -->
      </div>
        </form>
    </div>
  </div>
</div>


<div class="modal fade" id="manageChild" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        
      <div class="modal-header" style='background-image: url(<?php echo base_url(); ?>assets/images/header-modal.jpg);
    background-repeat: no-repeat;
    background-size: cover;;color:#fff;height:80px;'>
          <button type="button" class="close make-right light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <form onsubmit="return addManageChild()">
      <div class="modal-body">
            <div class="card">
            <article class="card-body">
                   
                    <div class="row">
                        <div class="col-centered">
                            
                            <h4 id='my-challange' class="text-centered">Edit/Delete Child Group for</h4>
                            
                            
                        </div>
                        <div class="col-centered">
                            <div class="form-group">
                                <input type='text' required=""  name='newchild' style="width:80%" id='editchild'>
                            </div>
                            <input type="hidden" id="parentGroupIds4" value="">
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-centered">
                            <img src="<?=base_url();?>/assets/images/loading.gif" style="width:50px; display:none" id='padd3'> 
                            <button type="submit" class="btn-props" id='childSubmite'>Update Child</button>
                            
                        </div>
                    </div>            
                    
                    <div class="row">
                        <div class="col-centered text-center">
                            <br>
                            <small>
                               Please note, any changes on this feature will affected on your next data calculations
                            </small>    
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-centered text-center">
                            
                            <br>
                            <button onclick="deleteGroupBtnChild();" type="button" class="btn btn-warning btn-fill" id='childEdit'>Delete Child</button>
                            <br><br>
                        </div>
                    </div>
                    

            </article>
                
            </div> <!-- card.// -->
      </div>
        </form>
    </div>
  </div>
</div>



<script>
$(document).ready(function () {

    $('#childgroup').on('show.bs.modal', function(e) {
        var point = $(e.relatedTarget).data('idgroupname');
        var idMap = $(e.relatedTarget).data('idgroup');
        $('#my-challange').html(point);
        $('#parentGroupId').val(idMap);
    });
    
    $('#editGroup').on('show.bs.modal', function(e) {
        var headerT = "Edit Group Name : "  + $(e.relatedTarget).data('idgroupnameedit');
        $('#my-edit-group-name').html(headerT);
        $('#mydomains2').val($(e.relatedTarget).data('idgroupnameedit'));
        $('#parentGroupIds2').val($(e.relatedTarget).data('idgroup2'));
        
    });
    
    $('#manageChild').on('show.bs.modal', function(e) {
        
        $('#editchild').val($(e.relatedTarget).data('editchild3'));
        $('#parentGroupIds4').val($(e.relatedTarget).data('idgroup3'));
        
    });
    
});
    

function deleteGroup(id, gname){
    var id = id;
    var r = confirm("Are you sure want to delete this domain group - " + gname + "?");
    if (r == true) {
        
        $.ajax({
            type: 'POST',
            url: base_url + 'mapping/mapUpsert/mapDelete',
            dataType: 'json',
            data: {id: id}
        }).done(function (result) {
			if(result.status){
				window.location.href = base_url + '/mapping';
			}
			else{
				window.location.href = base_url + '/mapping';
			}
			});
    } else {
        $.notify("Warning: You cancel delete", "warn");
    }
}
    
function deleteGroupBtnChild(){
    
    
    var id = $('#parentGroupIds4').val();
    console.log(id);
    
    var r = confirm("Are you sure want to delete this child group - " + $('#editchild').val() + "?");
    if (r == true) {
        $('#load_post_ring').modal('show');
        $.ajax({
            type: 'POST',
            url: base_url + 'mapping/mapUpsert/childDelete',
            dataType: 'json',
            data: {id: id}
        }).done(function (result) {
			if(result.status){
				window.location.href = base_url + '/mapping';
			}
			else{
				window.location.href = base_url + '/mapping';
			}
			});
    } else {
        $.notify("Warning: You cancel delete", "warn");
    }
}
    
function addNewChild(){
		$('#childSubmit').css('display', 'none');
		$('#padd').css('display', 'initial');
		
		
        var mydomain = $("#newchild").val();
        var idMap = $("#parentGroupId").val();
		var success = true;
        
        if(mydomain == ""){
            toastr["warning"]("Please fill out Child Name.", "Notification");
            success = false;
        }

        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'mapping/mapUpsert/childAdd',
				dataType: 'json',
				data: {
                       groupName: mydomain,
                       idMap : idMap,
                      }
			}).done(function (result) {
			if(result.status){
				//window.setTimeout(function(){
				    window.location.href = base_url + '/mapping';
				//}, 3000);
                
			}
			else{
				$('#childSubmit').css('display', 'initial');
                $('#padd').css('display', 'none');
				$.notify("Warning:" + result.msg, "warn");
			}
			});
		}

		return false;
}

function addManageChild(){
		$('#childSubmite').css('display', 'none');
		$('#padd3').css('display', 'initial');
		
		
        var childname = $("#editchild").val();
        var idchild = $("#parentGroupIds4").val();
    
        var success = true;
        
        if(childname == ""){
            toastr["warning"]("Please fill out Child Name.", "Notification");
            success = false;
        }

        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'mapping/mapUpsert/childEdit',
				dataType: 'json',
				data: {
                       childName: childname,
                       idChild : idchild,
                      }
			}).done(function (result) {
			if(result.status){
				window.location.href = base_url + '/mapping';                
			}
			else{
				$('#childSubmite').css('display', 'initial');
                $('#padd3').css('display', 'none');
                
				$.notify("Warning:" + result.msg, "warn");
			}
			});
		}

		return false;
}

    
function editGroup(){
		$('#groupsubmits2').css('display', 'none');
		$('#padd5').css('display', 'initial');
		
		
                            
        var mydomain = $("#mydomains2").val();
        
		var success = true;
        
        if(mydomain == ""){
            toastr["warning"]("Please fill out Group Name.", "Notification");
            success = false;
        }

        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'mapping/mapUpsert/mapEdit',
				dataType: 'json',
				data: {
                       groupName: mydomain,
                       idgroup : $("#parentGroupIds2").val(),
                      }
			}).done(function (result) {
			if(result.status){
				//window.setTimeout(function(){
				    window.location.href = base_url + '/mapping';
				//}, 3000);
                
			}
			else{
				$('#groupsubmits2').css('display', 'initial');
		        $('#padd5').css('display', 'none');
				$.notify("Warning:" + result.msg, "warn");
			}
			});
		}

		return false;
	}
    
function addNewGroup(){
		$('#groupsubmit').css('display', 'none');
		$('#padd2').css('display', 'initial');
		
		
        var mydomain = $("#mydomain").val();

		var success = true;
        
        if(mydomain == ""){
            toastr["warning"]("Please fill out Group Name.", "Notification");
            success = false;
        }

        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'mapping/mapUpsert/mapAdd',
				dataType: 'json',
				data: {
                       groupName: mydomain
                      }
			}).done(function (result) {
			if(result.status){
				//window.setTimeout(function(){
				    window.location.href = base_url + '/mapping';
				//}, 3000);
                
			}
			else{
				$('#groupsubmit').css('display', 'initial');
                $('#padd2').css('display', 'none');
				$.notify("Warning:" + result.msg, "warn");
			}
			});
		}

		return false;
	}
    

</script>
