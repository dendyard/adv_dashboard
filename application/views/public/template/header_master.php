<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
      
    <meta name="description" content="">
    <meta name="author" content="Big Mobile Indonesia, Mindshare ID, Xaxis ID">

    <title>Welcome to Mindshare Dashboard</title>
    
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() . 'assets/agency/favicon/' . $this->session->userdata('favlogo') ?> ">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() . 'assets/agency/favicon/' . $this->session->userdata('favlogo') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/agency/favicon/' . $this->session->userdata('favlogo') ?>">
      
    <meta name="msapplication-TileColor" content="#86009e">
    <meta name="msapplication-TileImage" content="<?php echo base_url() . 'assets/agency/favicon/' . $this->session->userdata('favlogo') ?>">
    <meta name="theme-color" content="#86009e">

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
    
    <link href="<?php echo base_url() ?>/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!-- datatable -->

    <link href="<?php echo base_url() ?>/assets/css/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>/assets/css/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
      
    <!-- Dashboard Custom CSS -->
    <link href="<?php echo base_url() ?>/assets/css/xaxis.css" rel="stylesheet">  
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">  

    <link href="<?php echo base_url() ?>/assets/css/toastr.min.css" rel="stylesheet" type="text/css" />
    
    <script src="<?php echo base_url() ?>/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.min.js" type="text/javascript"></script> 
      
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    
    
    <script src="<?php echo base_url() ?>/assets/js/chartist.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url() ?>/assets/js/xaxis_data.js"></script>  
    
      
  </head>
    <body>
        <!-- Sidebar Menu -->
    <div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo base_url() ?>/assets/images/sidebar-5.jpg">
    <img src="<?php echo base_url() ?>/assets/images/mslogo.png" id='poweredby'>    
    	<div class="sidebar-wrapper">
            <div class="logo logo-client-sidebar logo-adv">
                <a href="#" class="simple-text">
                    <img src="<?php 
    if ($this->session->userdata('role') != '1') {
        if ($this->session->userdata('role') == '2') {
            echo base_url() . 'assets/agency/logo/' . $this->session->userdata('agenLogo'); 
        }else{
            echo base_url() . 'assets/advertiser/logo/' . $this->session->userdata('userLogo'); 
        }
    }else{
        echo base_url() . 'assets/images/adv-logo-ms.png';
    }
     ?>">
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
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <?php 
                    if (($this->uri->segment(1)) == 'campaign'){
                        echo '<li class="active">';
                    }else{
                        echo '<li>';
                    }
                 ?>
                    <a href="<?php echo base_url('campaign'); ?>">
                        <i class="pe-7s-note2"></i>
                        <p>Campaign</p>
                    </a>
                </li>
                <?php 
                    if (($this->uri->segment(1)) == 'insight'){
                        echo '<li class="active">';
                    }else{
                        echo '<li>';
                    }
                 ?>
                    <a href="<?php echo base_url('insight'); ?>">
                        <i class="pe-7s-plugin"></i>
                        <p>Audience Insight</p>
                    </a>
                </li>
                <?php 
                if ($this->session->userdata('role') == "1" ||
                    $this->session->userdata('role') == "2"){
                            if (($this->uri->segment(1)) == 'upload' ||
                                ($this->uri->segment(1)) == 'AddBrandName'){
                                echo '<li class="active">';
                            }else{
                                echo '<li>';
                            }
                         ?>
                            <a href="<?php echo base_url('upload'); ?>">
                                <i class="pe-7s-cloud-upload"></i>
                                <p>Upload Data</p>
                            </a>
                        </li>
                <?php } ?>
                        <?php 
                            if (($this->uri->segment(1)) == 'users_controller'){
                                echo '<li class="active">';
                            }else{
                                echo '<li>';
                            }
                         ?>
                            <a href="<?php echo base_url('users_controller'); ?>">
                                <i class="pe-7s-user"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                        
                      <?php 
                        if ($this->session->userdata('role') == "1" ||
                            $this->session->userdata('role') == "2"){
                            if (($this->uri->segment(1)) == 'advertiser_controller'){
                                echo '<li class="active">';
                            }else{
                                echo '<li>';
                            }
                         ?>
                            <a href="<?php echo base_url('advertiser_controller'); ?>">
                                <i class="pe-7s-id"></i>
                                <p>Advertiser</p>
                            </a>
                        </li>
                     <?php } ?>
            
                         
                       <?php 
                        if ($this->session->userdata('role') == "1" ||
                            $this->session->userdata('role') == "2"){
                            if (($this->uri->segment(1)) == 'agency_controller'){
                                echo '<li class="active">';
                            }else{
                                echo '<li>';
                            }
                         ?>
                            <a href="<?php echo base_url('agency_controller'); ?>">
                                <i class="pe-7s-coffee"></i>
                                <p>Agency</p>
                            </a>
                        </li>
                      <?php } ?>
                        
                      
                        
                
                        <?php 
                            if (($this->uri->segment(1)) == 'glossary'){
                                echo '<li class="active">';
                            }else{
                                echo '<li>';
                            }
                         ?>
                            <a href="<?php echo base_url('glossary'); ?>">
                                <i class="pe-7s-notebook"></i>
                                <p>Glossary of Term</p>
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
                            <img style="width: 123px;" src="<?php echo base_url() ?>/assets/images/logo-advertiser.jpg">
                        </a>
                    
                </div>
                    <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                         
						
                         <p class="filter-text-caption">Filter</p>
                         
                        </li>
                        
                        
                    </ul>

                    
                </div>
            </div>
        </nav>
       
            <div class="container-fluid">
                <div class="row" id='progress_anim'>
                    
                    <div class="svg-container" >
                        <svg id="loader" width="100%" height="100%" viewBox="0 0 200 200" preserveAspectRatio="xMidYMid meet">
                            <path id="jump" fill="none" stroke="#57d0ed" stroke-width="10" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M47.5,94.3c0-23.5,19.9-42.5,44.5-42.5s44.5,19,44.5,42.5" />
                            <g stroke="#57d0ed" stroke-width="1">
                                <ellipse id="circleL" fill="none" stroke-miterlimit="10" cx="47.2" cy="95.6" rx="10.7" ry="2.7" />
                                <ellipse id="circleR" fill="none" stroke-miterlimit="10" cx="136.2" cy="95.6" rx="10.7" ry="2.7" />
                            </g>
                        </svg>
                    </div>
                    <div id="bg-wth-full"></div>
                </div>
                <!-- Filter Section -->
<div class="row">
    
<?php
    if ($this->uri->segment(1) != "insight") {
        
        ?>
        <div style="display:block;"  class="filter-mobile-none">Filter not available</div>                
    <?php 
    }else{
    ?>
        
    <div <?php if($this->uri->segment(1) != "insight_hide"){echo 'style=display:none;';}else{} ?> class="filter-mobile">

    <div class="filter-elements" style="margin-right:10px;">
        <p class="filter-text-new2" >Select Period</p>

        <div class="checkbox checkbox_select_filter">
            <select name="period" id="period" class="selectpicker" data-live-search="true" title="Select Period">    
                <option <?= ($fil_period == "2019 - Q2" ?  'selected':'') ?> value="2019 - Q2">2019 - Q2</option>
                
            </select>
        </div>
    </div>
        
    <div class="filter-elements">
        <p class="filter-text-new2" >Select Brand</p>

        <div class="checkbox checkbox_select_filter">
            <select name="brand" id="brand" class="selectpicker" data-live-search="true" title="Select Brand">    
                <option value="WYETH GOLD" <?= ($fil_brand == "WYETH GOLD" ?  'selected':'') ?> >WYETH GOLD</option>
                <option  value="WYETH ORIGINAL" <?= ($fil_brand == "WYETH ORIGINAL" ?  'selected':'') ?>>WYETH ORIGINAL</option>
                <option  value="WYETH WNPC" <?= ($fil_brand == "WYETH WNPC" ?  'selected':'') ?>>WYETH WNPC</option>
            </select>


        </div>
    </div>
        
        
    <div class="pull-right filter-pull-right">
     
     
    <div class="filter-elements-right">
    <button id="summitFilterInsight" type="button" class="btn btn-info filter-button">Filter</button>
    </div>
        </div>
    </div>
    
    
        <?php
    }
    
    ?>
</div>
<div class="content " style="margin-top: 111px;" >
            