<style type="text/css">

    table.dataTable > thead > tr > th, table.dataTable > tbody > tr > th, table.dataTable > tfoot > tr > th, table.dataTable > thead > tr > td, table.dataTable > tbody > tr > td, table.dataTable > tfoot > tr > td {
    padding: 8px !important;
    outline: 0;
    white-space: nowrap !important;
    text-overflow: ellipsis !important;
}

</style>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                               <center>
                                <h4 class="title_card" style="margin-top: 0px">User List</h4>
                               </center>
                            </div>
                            <button onclick='window.location.href="<?php echo base_url(); ?>user/addnew"'style='width: 130px;margin-left: 10px;margin-bottom: 20px;' type="button" class="btn-props">Add New User</button>
                            <div class="content table-responsive table-full-width">

                                <table class="table table-hover table-striped" id="userTable">
                                    <thead>
                                        <tr>
                                            <th width="20%">Full Name</th>
                                            <th width="15%">Email</th>
                                            <th width="15%">Status</th>
                                            
                                            <th>Action </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                      foreach ($userList as $list) {
                                         ?>
                                         <tr>
                                             <td><?=$list['firstname']?>&nbsp;<?=$list['lastname']?></td>
                                             <td><?=$list['email']?></td>
                                             <td><?php (($list['status'] == 1) ? 'Enable' : 'Disable') ?></td>
                                            
                                             
                                             <td> <button style="width:80px;" type="button" onclick="window.location.href='<?=base_url('user/edit/' .$list['userid'])?>'" class="btn btn-props btn-fill ">Edit</button> 
                                             <button style="width:80px;" type="button" onclick="deleteuser(<?=$list['userid']?>, '<?=$list['firstname']?>')"  class="btn btn-warning btn-fill ">Delete</button> 
                                             
                                             </td>
                                         </tr>
                                         <?php
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

<script type="text/javascript">
//    $(document).ready(function() {
//
//        $('#userTable').DataTable({
//            "bProcessing": false,
//            "bServerSide": false,
//            "ajax": '<?php echo base_url() ?>/users_controller/get'
//        });
//
//    } );
//
//    progress_stop();
    
    function deleteuser(id, uname){
        console.log('hello');
        var uid = id;
        var r = confirm("Are you sure want to delete  user - " + uname + "?");
        if (r == true) {
            console.log('hello 2');
            $.ajax({
                type: 'POST',
                url: base_url + 'user/deleteuserprofile',
                dataType: 'json',
                data: {usid: uid}
            }).done(function (result) {
                
                window.location.href = base_url + '/user';
                
                });
        } else {
            console.log('hello 3');
            $.notify("Warning: You cancel delete", "warn");
        }
    }
    
    
</script>