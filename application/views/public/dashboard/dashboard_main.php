
<div class="content">
            <div class="container-fluid">
                
                <div class="row"> 
                    <div class="col-md-12 center-block" >
                        
                            <div class="header" style="margin-bottom:30px;">
                               <div class="header">
                               <center>
                                <h4 class="title_card">Master Report Account</h4>
                               </center>
                                   <button onclick='window.location.href="<?php echo base_url(); ?>adv/addnew"' style="width:155px;" type="submit" class="btn btn-info btn-fill">Add New Account</button>
                                   <button onclick='window.location.href="<?php echo base_url(); ?>adv/addnewcustom"' style="width:185px;" type="submit" class="btn btn-info btn-fill">Add New Custom Report</button>
                                   
                                </div>
                            </div>
                           
                        <?php 
                        
                            foreach ($d_collection as $al){
                        ?>
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <?php 
                                    if ($al['iscustom'] == 0) {
                                    ?>
                                        <div class="header_purple">
                                    <?php 
                                    }else {
                                        
                                        ?>
                                        <div class="header_biru">
                                    <?php
                                    } ?>
                                        <p class="tittle_box pull-left"><?php echo $al['account_list'][0];?></p>
                                        <p class="open-data pull-right"><a class="open-data" href="adv/manage/<?=$al['prefix'][0]?>">Manage</a></p>
                                    </div>
                                    <div class="card-body">
                                        
                                        <small>Table prefix : <?=$al['prefix'][0]?></small><br>
                                        <?php 
                                        
                                            if ($al['iscustom'] == 0) {
                                        ?>
                                        <table class="table table-bordered mt-8">
                                          <tbody>

                                            <tr style="background-color: #fff;">
                                              <td>Campaign Report<br>
                                              <small class='lastupdate'>Last update : <?=($al['tbl_rec']['lastupdate_cr']['lastupdate'] == ''? '-':$al['tbl_rec']['lastupdate_cr']['lastupdate']);?></small>
                                              </td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['camp_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr style="background-color: #fff;">
                                              <td>Version Report
                                              <br>
                                              <small class='lastupdate'>Last update : <?=($al['tbl_rec']['lastupdate_cv']['lastupdate'] == ''? '-':$al['tbl_rec']['lastupdate_cv']['lastupdate']);?></small>
                                              </td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['version_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr style="background-color: #fff;">
                                              <td>Unique Report
                                              <br>
                                              <small class='lastupdate'>Last update : <?=($al['tbl_rec']['lastupdate_cu']['lastupdate'] == ''? '-':$al['tbl_rec']['lastupdate_cu']['lastupdate']);?></small>
                                              </td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['unique_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                            <tr style="background-color: #fff;">
                                              <td>Video Report
                                              <br>
                                              <small class='lastupdate'>Last update : <?=($al['tbl_rec']['lastupdate_cd']['lastupdate'] == ''? '-':$al['tbl_rec']['lastupdate_cd']['lastupdate']);?></small>
                                              </td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['video_report']['t_record']);?> &nbsp;records</td>
                                            </tr>
                                              
                                          </tbody>
                                        </table>
                                        <?php }else{
                                        //Custom Table        
                                        ?>
                                        <table class="table table-bordered mt-8">
                                          <tbody>

                                            <tr style="background-color: #fff;">
                                              <td>Custom Report<br>
                                              <small class='lastupdate'>Last update : <?=($al['tbl_rec']['lastupdate_custom_report']['lastupdate'] == ''? '-':$al['tbl_rec']['lastupdate_custom_report']['lastupdate']);?></small>
                                              </td>
                                              <td class="text-rg"><?php echo number_format($al['tbl_rec']['custom_report']['t_record']);?> &nbsp;records</td>
                                              </tr></tbody></table>
                                        
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        
                        <?php } ?>
                        
                        
                        <div class="col-md-12 center-block" style="margin-top:30px;">
                                <div class="card">
                                    
                                    <div class="header_purple">
                                        <p id='forcebtn' class="open-data pull-right"><a class="open-data" onclick="maytheforce()">Force Process</a></p>  
                                        
                                        <p class="tittle_box pull-left">
                                            On Queue Report    
                                        </p>
                                          
                                        
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                        $forcebtn = true;
                                        foreach ($d_collection as $als){
                                            if ($als['iscustom'] == 0) {
                                                $camp_report = 'files/' . $als['prefix'][0] . '/campaign_report/';
                                                $version_report = 'files/' . $als['prefix'][0] . '/campaign_version/';
                                                $unique_report = 'files/' . $als['prefix'][0] . '/campaign_unique/';
                                                $video_report = 'files/' . $als['prefix'][0] . '/campaign_video/';

                                                $camp_files1 = array_diff(scandir($camp_report,1), array('..', '.', '.DS_Store'));
                                                $version_files1 = array_diff(scandir($version_report,1), array('..', '.', '.DS_Store'));
                                                $unique_files1 = array_diff(scandir($unique_report,1), array('..', '.', '.DS_Store'));
                                                $video_files1 = array_diff(scandir($video_report,1), array('..', '.', '.DS_Store'));


                                                if (sizeOf($camp_files1) == 0 &&
                                                    sizeOf($version_files1) == 0 &&
                                                    sizeOf($unique_files1) == 0 &&
                                                    sizeOf($video_files1) == 0
                                                   ) {

                                                }else{
                                                    $forcebtn = false;

                                                    echo $als['account_list'][0];
                                                    foreach ($camp_files1 as $fl0) {
                                                        if ($fl0 == '.DS_Store') continue;
                                                        echo '<div class="pre-list1">';
                                                        print_r('Campaign Report : ' .  $fl0);
                                                        echo '<button class="del-badge pull-right" onclick="delfileserver(`' . $fl0 .'`,`' . $als['prefix'][0] . '`,`cr`);" >Delete</button>';  
                                                        echo '</div>';
                                                    }

                                                    foreach ($version_files1 as $fl0) {
                                                        if ($fl0 == '.DS_Store') continue;
                                                        echo '<div class="pre-list2">';
                                                        print_r('Version Report : ' .  $fl0);
                                                        echo '<button class="del-badge pull-right" onclick="delfileserver(`' . $fl0 .'`,`' . $als['prefix'][0] . '`,`vr`);" >Delete</button>';  
                                                        echo '</div>';
                                                    }

                                                    foreach ($unique_files1 as $fl0) {
                                                        if ($fl0 == '.DS_Store') continue;
                                                        echo '<div class="pre-list3">';
                                                        print_r('Unique Report : ' .  $fl0);
                                                        echo '<button class="del-badge pull-right" onclick="delfileserver(`' . $fl0 .'`,`' . $als['prefix'][0] . '`,`ur`);" >Delete</button>';  
                                                        echo '</div>';
                                                    }

                                                    foreach ($video_files1 as $fl0) {
                                                        if ($fl0 == '.DS_Store') continue;
                                                        echo '<div class="pre-list4">';
                                                        print_r('Video Report : ' .  $fl0);
                                                        echo '<button class="del-badge pull-right" onclick="delfileserver(`' . $fl0 .'`,`' . $als['prefix'][0] . '`,`dr`);" >Delete</button>';  
                                                        echo '</div>';
                                                    }

                                                echo '<br><br>';

                                                }
                                            }else{
                                                
                                             // START Custom
                                            $camp_report = 'files/' . $als['prefix'][0];
                                            
                                            
                                            $camp_files1 = array_diff(scandir($camp_report,1), array('..', '.', '.DS_Store'));
                                            

                                            if (sizeOf($camp_files1) == 0) {
                                            }else{
                                                $forcebtn = false;
                                                
                                                echo $als['account_list'][0];
                                                foreach ($camp_files1 as $fl0) {
                                                    if ($fl0 == '.DS_Store') continue;
                                                    echo '<div class="pre-list1">';
                                                    print_r('Custom Report : ' .  $fl0);
                                                    echo '<button class="del-badge pull-right" onclick="delfileserver(`' . $fl0 .'`,`' . $als['prefix'][0] . '`,`ct`);" >Delete</button>';  
                                                    echo '</div>';
                                                }
                                            
                                            
                                            echo '<br><br>';
                                                
                                            }
                                             // End of custom 
                                            }
                                        }
                                        
                                        if ($forcebtn) {
                                            echo "<style> #forcebtn { display:none; }</style>";
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
$(document).ready(function() {
    
    $('#dashboard').DataTable();
    

} );
    
function maytheforce(){
    
    var r = confirm("Are you sure want to Process all Queue Files ?");
    
    if (r == true) {
        
        $('#load_post_ring').modal('show');
        
        $.ajax({
				type: 'POST',
				url: base_url + 'csv/force_scan',
				dataType: 'json',
				data: {
                      }
			}).done(function (result) {
			if(result.status){
				window.location.href = base_url + '/';
			}
			else{
				$('#load_post_ring').modal('hide');
				$.notify("Warning:" + result.msg, "warn");
			}
			});
        //$('#load_post_ring').modal('hide');
    }
    
}

function delfileserver(filename, prefix, typet){
    
    
    var r = confirm("Are you sure want to delete : " + filename + " file ?");
    
    if (r == true) {
        console.log(filename);
        console.log(prefix);
        console.log(typet);
        
        $('#load_post_ring').modal('show');
        
        $.ajax({
				type: 'POST',
				url: base_url + 'adv/deletefileserver',
				dataType: 'json',
				data: {p_filename: filename, 
                       p_prefix: prefix, 
                       p_type: typet,
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
        
        
        $('#load_post_ring').modal('hide');
    }
    
}

</script>
