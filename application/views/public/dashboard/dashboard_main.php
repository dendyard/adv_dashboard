
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

                                            <tr style="background-color: #faf0ca;">
                                              <td>Campaign Report</td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['camp_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr style="background-color: #f4d35e;">
                                              <td>Version Report</td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['version_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr style="background-color: #fcec52;">
                                              <td>Unique Report</td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['unique_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr style="background-color: #ee964b;">
                                              <td>Video Report</td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['video_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                              
                                          </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        
                        <?php } ?>
                        
                        
                        <div class="col-md-12 center-block" style="margin-top:30px;">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">
                                            On Queue Report    
                                        </p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                        
                                        foreach ($d_collection as $als){
                                           echo $als['account_list'][0];
                                            
                                            $camp_report = 'files/' . $als['prefix'][0] . '/campaign_report/';
                                            $version_report = 'files/' . $als['prefix'][0] . '/campaign_version/';
                                            $unique_report = 'files/' . $als['prefix'][0] . '/campaign_unique/';
                                            $video_report = 'files/' . $als['prefix'][0] . '/campaign_video/';
                                            
                                            $camp_files1 = array_diff(scandir($camp_report,1), array('..', '.'));
                                            $version_files1 = array_diff(scandir($version_report,1), array('..', '.'));
                                            $unique_files1 = array_diff(scandir($unique_report,1), array('..', '.'));
                                            $video_files1 = array_diff(scandir($video_report,1), array('..', '.'));
                                            


                                            foreach ($camp_files1 as $fl0) {
                                                if ($fl0 == '.DS_Store') continue;
                                                echo '<div class="pre-list1">';
                                                print_r('Campaign Report : ' .  $fl0);
                                                echo '</div>';
                                            }
                                            
                                            foreach ($version_files1 as $fl0) {
                                                if ($fl0 == '.DS_Store') continue;
                                                echo '<div class="pre-list2">';
                                                print_r('Version Report : ' .  $fl0);
                                                echo '</div>';
                                            }
                                            
                                            foreach ($unique_files1 as $fl0) {
                                                if ($fl0 == '.DS_Store') continue;
                                                echo '<div class="pre-list3">';
                                                print_r('Unique Report : ' .  $fl0);
                                                echo '</div>';
                                            }
                                            
                                            foreach ($video_files1 as $fl0) {
                                                if ($fl0 == '.DS_Store') continue;
                                                echo '<div class="pre-list4">';
                                                print_r('Video Report : ' .  $fl0);
                                                echo '</div>';
                                            }
                                            
                                            echo '<br><br>';
                                            
                                        }
                                            
                                       
                                        
                                        
                                        
                                        ?>
                                        
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
</div>


<script>
$(document).ready(function() {
    
    $('#dashboard').DataTable();

} );

</script>
