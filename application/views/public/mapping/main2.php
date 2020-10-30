<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                               <center>
                                <h4 class="title_card">Site Name Mapping</h4>
                                
                               </center>
                            </div>
                            <button data-toggle="modal" data-target="#newgroup" data-idgroup="Kompas.com" style='width: 150px;margin-left: 10px;margin-bottom: 20px;'  type="button"  class="btn-props">Add New Group</button> 
                            <div class="content table-responsive table-full-width">
                                <table id='camp_list' class="table table-hover table-striped">
                                    <thead>
                                        <th style="width:50px">No</th>
                                    	<th style="width:30%">Network Partner Name</th>
                                    	<th style="width:20%">Site Name</th>
                                        <th style="width:50%">Site Mapping</th>
                                        
                                    </thead>
                                    <tbody>
                                     
                                    <?php 
                                        
                                        $numb = 1;
                                        foreach ($groupList as $listdata) {
                                            ?>
                                        
                                     <tr>
                                         <td style="width:50px"><?=$numb?></td>
                                         <td style="width:20%"><?=$listdata['site_mapped_by']?></td>
                                         <td style="width:20%"><?=$listdata['site_from']?></td>
                                         <td style="width:50%">
                                             
                                             <a data-toggle="modal" data-target="#manageChild" data-editchild3="<?=$listdata['site_mapped_by']?>" 
                                                      data-idgroup3="<?=$listdata['id']?>" data-idsitename="<?=$listdata['site_from']?>" href="#">
                                            <?=$listdata['site_mapped_by']?>
                                             </a>
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
                            
                            <h4 id='my-challange' class="text-centered">Edit Site Name Map</h4>
                            
                            
                        </div>
                        <div class="col-centered">
                            <div class="form-group">
                                <input type='text' required=""  name='newchild' style="width:80%;text-align:center;" id='editchild'>
                            </div>
                            <input type="hidden" id="parentGroupIds4" value="">
                            <input type="hidden" id="sitefrom" value="">
                            
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-centered">
                            <img src="<?=base_url();?>/assets/images/loading.gif" style="width:50px; display:none" id='padd3'> 
                            <button type="submit" class="btn-props" id='childSubmite'>Update </button>
                            
                        </div>
                    </div>            
                    
                <div class="row">
                        <div class="col-centered text-center">
                            <br>
                            <small>
                               Please note, any changes on this feature will affected on your next data calculations
                            </small>   
                            <br>
                            <br>
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
$(document).ready(function() {
    
    $('#camp_list').DataTable();
    $('#manageChild').on('show.bs.modal', function(e) {
        
        $('#editchild').val($(e.relatedTarget).data('editchild3'));
        $('#parentGroupIds4').val($(e.relatedTarget).data('idgroup3'));
        $('#sitefrom').val($(e.relatedTarget).data('idsitename'));
        
    });
} );
    
function addManageChild(){
		$('#childSubmite').css('display', 'none');
		$('#padd3').css('display', 'initial');
		
		
        var childname = $("#editchild").val();
        var idchild = $("#parentGroupIds4").val();
        var sitefrom = $("#sitefrom").val();
    
        var success = true;
        
        if(childname == ""){
            toastr["warning"]("Please fill out Site Name.", "Notification");
            success = false;
        }

        if(success){
        
			$.ajax({
				type: 'POST',
				url: base_url + 'mapping/mapUpsert/childEdit',
				dataType: 'json',
				data: {
                       sitefrom : sitefrom,
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
    

</script>