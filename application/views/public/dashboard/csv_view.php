
                



<div class="content">
            <div class="container-fluid">
                
              
                
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="content table-responsive table-full-width">
                <table style="padding-left:10px; padding-right:10px;" id='dashboard' class="table table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Date</th>
                        <th style="width:300px;">Campaign Name</th>
                        <th>Advertiser Name</th>
                        <th>Site Name</th>
                        <th>Placement Id</th>
                        <th>Placement Name</th>
                        <th style='text-align:right'>Ad Id</th>
                        <th>Ad Name</th>
                        <th>Placement Dimension</th>
                        <th>Section Name</th>
                        <th>Campaign Id</th>
                        <th style='text-align:right'>Campaign Start</th>
                        <th style='text-align:right'>Campaign End</th>
                        <th>Ad Format</th>
                        <th>Site Id</th>
                        <th style='text-align:right'>Impression</th>
                        <th style='text-align:right'>Clicks</th>
                        <th style='text-align:right'>Total Conversions</th>
                        <th style='text-align:right'>Total Media Cost</th>
                        <th style='text-align:right'>Post Click Conversions</th>
                        <th style='text-align:right'>Post Imp Conversions</th>
                        <th style='text-align:right'>ECPC</th>
                        <th style='text-align:right'>ECPM</th>
                        <th style='text-align:right'>ECPA</th>
                        <th style='text-align:right'>Total Profit</th>
                        <th style='text-align:right'>Total Interaction</th>
                        <th style='text-align:right'>In Date</th>

                    </thead>
                    <tbody>
                     <?php
                      $numb = 1;
                      foreach ($dashboard as $list) {
                        ?>

                        <tr>
                         <td><?=$numb?></td>
                         <td style="width:10%;"><?=$list['day'];?></td>
                         <td style="width:300px;"><?=$list['campaignName'];?></td>
                         <td style="width:300px;"><?=$list['advertiserName'];?></td>
                         <td style="width:10%;"><?=$list['siteName'];?></td>
                         <td style="width:10%;"><?=$list['placementId'];?></td>
                         <td style="width:10%;"><?=$list['placementName'];?></td>
                         <td style="width:10%;"><?=$list['adId'];?></td>
                         <td style="width:10%;"><?=$list['adName'];?></td>
                         <td style="width:10%;"><?=$list['placementDimension'];?></td>
                         <td style="width:10%;"><?=$list['sectionName'];?></td>
                         <td style="width:10%;"><?=$list['campaignId'];?></td>
                         <td style="width:10%;"><?=$list['campaignStartDate'];?></td>
                         <td style="width:10%;"><?=$list['campaignEndDate'];?></td>
                         <td style="width:10%;"><?=$list['adFormatName'];?></td>
                         <td style="width:10%;"><?=$list['siteId'];?></td>
                         <td style="width:10%;"><?=number_format($list['impression']);?></td>
                         <td style="width:10%;"><?=number_format($list['clicks']);?></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>
                         <td style="width:10%;"></td>


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


<script>
$(document).ready(function() {
    
    $('#dashboard').DataTable();

} );

</script>
