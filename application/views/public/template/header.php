<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
      
    <meta name="description" content="">
    <meta name="author" content="ADV Services">

    <title>ADV Dashboard Report CMS</title>
    
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>favicon.ico">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>favicon.ico">
      
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>/assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
     <!-- Animation library for notifications   -->
    <link href="<?php echo base_url() ?>/assets/css/animate.min.css" rel="stylesheet"/>
    
      
    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url() ?>/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    
      
    <!--     Fonts and icons     -->
    <link href="<?php echo base_url() ?>/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!-- datatable -->

    <link href="<?php echo base_url() ?>/assets/css/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>/assets/css/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
      
    <!-- Dashboard Custom CSS -->
    <link href="<?php echo base_url() ?>/assets/css/adv.css?ver=3.2" rel="stylesheet">  
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">  

    <link href="<?php echo base_url() ?>/assets/css/toastr.min.css" rel="stylesheet" type="text/css" />
    
    <script src="<?php echo base_url() ?>/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.min.js" type="text/javascript"></script> 
      
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/bootstrap-select.min.css">

    
  </head>
    <body>
        
    <!-- Sidebar Menu -->    
    <div class="wrapper">
    <div class="sidebar" data-image="<?php echo base_url() ?>/assets/images/sidebar-5.jpg">
    
    <p class='copyr' >Copyright © 2020 ADV (Malaysia) Sdn. Bhd. All rights reserved.</p>
    	<div class="sidebar-wrapper">
            <div class="logo logo-client-sidebar logo-adv">
                <a href="#" class="simple-text">
                    <img src="<?php echo base_url() ?>/assets/images/adv_logo_white.png">
                </a>
            </div>

            <ul class="nav">
                <!-- <?php print_r($this->session->userdata); ?> -->
                
                <?php 
                    if (($this->uri->segment(1)) == ''){
                        echo '<li class="active">';
                    }else{
                        echo '<li>';
                    }
                 ?>
                    <a href="<?php echo base_url(); ?>">
                        <i class="pe-7s-graph"></i>
                        <p>Database Setting</p>
                    </a>
                </li>
                
                
                
                    <?php 
                        if (($this->uri->segment(1)) == 'user'){
                            echo '<li class="active">';
                        }else{
                            echo '<li>';
                        }
                        ?>
                        <a href="<?php echo base_url('user'); ?>">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                        <li>
                            <a href="<?php echo base_url() ?>login/logout">
                                <i class="pe-7s-unlock"></i>
                                <p>Log Out</p>
                            </a>
                        </li>
        
            </ul>
    	</div>
    </div>
        <div class="main-panel" >

        <?php if($this->uri->segment(2) == "detail") { ?>
        <nav  class="navbar navbar-default navbar-filter shadow-lg">
            
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo base_url() ?>" class="navbar-brand">
                            
                        </a>
                    <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                         
						
                         <p class="filter-text-caption">Filter</p>
                         
                        </li>
                        
                        
                    </ul>

                    
                </div>
                </div>
                    
            </div>
        </nav>

            
            <div class="container-fluid">
                <div class="row" id='progress_anim'>
                   <img src="<?php echo base_url() ?>/assets/images/progress.gif" style='position: absolute;
                        z-index: 10000;
                        left: 0;
                        right: 0;
                        margin: auto;
                        top: 0;
                        bottom: 0;
                        width: 11%;'>
                    <div id="bg-wth-full"></div>
                </div>
                


   
<!-- Filter Section -->
                

<div class="row">
    <div <?php if($this->uri->segment(1) == "mapping" || $this->uri->segment(1) == "user" || $this->uri->segment(2) == "detail" || $this->uri->segment(2) == "video" || $this->uri->segment(2) == "display" || $this->uri->segment(2) == "trueview" ){echo 'style=display:block;';}else{echo 'style=display:none;';} ?> class="filter-mobile-none">Filter not available</div>
    
    
    <div class="filter-mobile">

    
    
    <div class="filter-elements brandsFilter">
    <p class="filter-text-new2 " >Select Table Report</p>
    <div class="checkbox checkbox_select_filter">
    <select name="sitename_filter2" data-live-search="true" data-width="110%" id="sitename_filter2" class="selectpicker" title="Select Campaign"> 
        <option selected value="camp_report">Campaign Report</option>
        <option value="camp_report">Version Report</option>
        <option value="camp_report">Unique Report</option>
        <option value="camp_report">Video Report</option>
    </select>
    </div>
    </div>
        
    <div class="pull-right filter-pull-right">
    <div class="filter-elements">
    <p class="filter-text-new">Start Date</p>
    <div class="input-group date date-filter" style="margin-top: 1px;" data-date-format="yyyy.mm.dd">
       <input id="datetimepicker1"  type="text" class="form-control datetimepicker" placeholder="Choose Date">
        <div class="input-group-addon" id="input_btn_calendar" >
          <span class="pe-7s-date"  style="font-size: 20px;"></span>
        </div>
    </div>
        </div>
    <div class="filter-elements">
    <p class="filter-text-new">End Date</p>
    <div class="input-group date date-filter" style="margin-top: 1px;" data-date-format="yyyy.mm.dd">
        <input id="datetimepicker2" type="text" class="form-control datetimepicker" placeholder="Choose Date">
        <div class="input-group-addon" >
          <span class="pe-7s-date" style="font-size: 20px;"></span>
        </div>
    </div>
        </div>
 
<input id="customstart" type="hidden" value="2020-01-01">
<input id="customend" type="hidden" value="2020-01-01">

    <div class="filter-elements-right">
    <button id="summitFilter" type="button" class="btn btn-info filter-button">Filter</button>
    </div>
        </div>
    </div>
    
    
</div>
<?php } ?>

    
<!-- End of Filter Section -->
<div class="content">
            