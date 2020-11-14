
<div class="content" style='margin-top:108px;'>
            <div class="container-fluid">
                
                <div class="row"> 
                    <div class="col-md-12 center-block" >
                        <div class="card" style="height:680px;">
                            <div class="header" style="margin-bottom:30px;">
                                <center>
                                    <?php 
                                    //if ($print_adv != '') {
                                        
                                    ?>
                                <a id='print-btn' style="position:absolute;right:28px;" onclick='printToPDF()' target='_blank'  class="btn btn-info btn-fill pull-right">Delete Data<span class="pe-7s-trash icon-print"></span></a>
                                <?php //} ?>
                                </center>
                                <center>                                    
                                <h4 class="title_card">Campaign Report Data</h4>
                                <p class="subtitle_card">
                                Advertiser Name : <span id="advName">Djarum Id</span>
                                </p>
                                <p class="subtitle_card" id='filter_status'>
                                Period : <span id="s_date">2020-12-12</span> to <span id="e_date">2020-12-12</span>
                                </p>
                                </center>
                            </div>
                            
                            <!-- SPENDING -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">Spending</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <p>0</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- IMPRESSION -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">Impressions</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        
                                        <p>0</p>
                                            
                                    </div>
                                </div>
                            </div>
                            
                            <!-- VIEWABILITY -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">Viewability %</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <p>0</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- CLICKS -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">Clicks</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <p>0</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Display CTR -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">CTR %</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                    <p>0</p>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- VIEW -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">Views</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <p>0</p>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            <!-- Video VTR -->
                            <div class="col-md-4 center-block">
                                
                            </div>
                            
                            <!-- Video VTR -->
                            <div class="col-md-4 center-block">
                                <div class="card">
                                    <div class="header_purple">
                                        <center>
                                        <p class="tittle_box">Video VTR %</p>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <p>0</p>
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
</div>


<script>
$(document).ready(function() {
    
    $('#dashboard').DataTable();

} );

</script>
