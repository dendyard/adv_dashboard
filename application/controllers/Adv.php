<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adv extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$logged = $this->session->userdata('userLogged');
	 	if(!$logged){
	 		redirect("/login");
		 }
        $this->load->model('Adv_Model');
	}
	
	public function index()
	{
    
		if ($this->session->userdata('email') == ""){
			redirect('/login', 'refresh');
		}
			
            $setDate = $this->Adv_Model->getMinMaxDateForRawData();
        
            $inputStartDate = $this->input->get('start');
			$inputEndDate 	= $this->input->get('end');
        
        
            $campaign_id 	 = $this->input->get('campaign_id');
        
        
            $startdate 	= (($inputStartDate == "") ? $setDate['date1'] : $inputStartDate);
			$enddate 	= (($inputEndDate == "") ? $setDate['date2'] : $inputEndDate);
            
            $startdate = '9/8/2020 12:00:00 am';
            $enddate = '9/9/2020 12:00:00 am';
        
//            echo $startdate;
//            echo $enddate;
//            exit();
            $data = array (
                'dashboard' => $this->Adv_Model->get_list($startdate, $enddate, $campaign_id),
                'media_cost' => $this->Adv_Model->get_t_mediacost($startdate, $enddate, $campaign_id),
                'conversion'    => $this->Adv_Model->get_t_conversion($startdate, $enddate, $campaign_id),
                'ad_imp'    => $this->Adv_Model->get_ad_imp($startdate, $enddate, $campaign_id),
                
            );
        
            
            $filter = array (
                'filter' => $this->Adv_Model->get_site_name(),
                'start'  => $startdate,
                'end'    => $enddate,
                'siteselect' => $campaign_id
            );
                
			$this->load->view('public/template/header',$filter);
        	$this->load->view('public/dashboard/dashboard_main',$data);
        	$this->load->view('public/template/footer');
    }
    
    public function getChartPerformance(){
        header('Access-Control-Allow-Origin: *');
          
        $arr = array(
				'dspAdvertiserIdList' 	=>  $this->input->get('dspList'),
				'start'					=> 	$this->input->get('start'),
				'end'					=> 	$this->input->get('end'),
                'brand'                 =>  $this->input->get('brand'),
                'typeData'              =>  $this->input->get('typeData')
       );
        
        $result = $this->Advertisersummary->performanceChart($arr);
        
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function getSelectedBrand(){
        //$this->load->view('public/template/footer');
        header('Access-Control-Allow-Origin: *');
        $result = $this->Advertisersummary->getBrandName($this->input->get('adv'));
        
        echo json_encode($result, JSON_PRETTY_PRINT);
        
    }
   
        
}