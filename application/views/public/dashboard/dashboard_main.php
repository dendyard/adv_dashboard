
<div class="content">
            <div class="container-fluid">
                
                <div class="row"> 
                    <div class="col-md-12 center-block" >
                        
                            <div class="header" style="margin-bottom:30px;">
                               <div class="header">
                               <center>
                                <h4 class="title_card">Database Account</h4>
                               </center>
                                   <button onclick='window.location.href="<?php echo base_url(); ?>adv/addnew"' style="width:155px;" type="submit" class="btn btn-info btn-fill">Add New Account</button>
                                </div>
                            </div>
                           
                        <?php 
                        /*
                        $dir    = 'files/djarum_id/campaign_report/';
                        $files1 = array_diff(scandir($dir,1), array('..', '.'));
                        
                        echo '<pre>';
                        print_r($files1[0]);
                        echo '</pre>';
                        */
                        //unlink('files/djarum_id/campaign_report/Djarum_Version_Report_20201102035217923.csv');
                            foreach ($d_collection as $al){
                        ?>
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                            
                                        <p class="tittle_box"><?php echo $al['account_list'][0];?></p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <small>Table prefix : <?=$al['prefix'][0]?></small><br>
                                        <table class="table table-bordered mt-8">
                                          <tbody>
                                            
                                            <tr>
                                              <td>Campaign Report</td>
                                              <td><?php echo number_format($al['tbl_rec']['camp_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr>
                                              <td>Campaign Version</td>
                                              <td><?php echo number_format($al['tbl_rec']['version_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr>
                                              <td>Campaign Unique</td>
                                              <td><?php echo number_format($al['tbl_rec']['unique_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr>
                                              <td>Campaign Video</td>
                                              <td><?php echo number_format($al['tbl_rec']['video_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                              
                                          </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        
                        <?php } ?>
                        
                        </div>
                    
                        
                    
                    
                    </div>
                
                
            </div>
        </div>

        </div>
    </div>
    </div>
</div>


<script>
$(document).ready(function() {
    
    $('#dashboard').DataTable();

} );

</script>
