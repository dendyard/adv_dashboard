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
        
        $accList = $this->Adv_Model->get_account_list();

        foreach ($accList as $al){

            $tb = array(
                'camp_report' => $this->Adv_Model->get_record_table($al['prefix'] . '_campaign_report'),
                'version_report' => $this->Adv_Model->get_record_table($al['prefix'] . '_campaign_version'),
                'unique_report' => $this->Adv_Model->get_record_table($al['prefix'] . '_campaign_unique'),
                'video_report' => $this->Adv_Model->get_record_table($al['prefix'] . '_campaign_video'),
            );
            
            $acn = array ($al['accountname']);
            $pf = array ($al['prefix']);
            
            $tb_info = array (
                     'account_list' => $acn,
                     'prefix' => $pf,
                     'tbl_rec' => $tb,
                );
            $collection_tbl_info[] = $tb_info;
        }
        
        $data = array (
            'account_list' => $accList,
            'd_collection' => $collection_tbl_info
        );


        $this->load->view('public/template/header');
        $this->load->view('public/dashboard/dashboard_main',$data);
        $this->load->view('public/template/footer');
    }
    
    public function addnew()
	{
        
        $this->load->view('public/template/header');
        $this->load->view('public/dashboard/addnew');
        $this->load->view('public/template/footer');
        
    }
    
    public function accAddProg(){
        
        
        $prefix = strtolower($this->input->post('prefix'));
        $conv = $this->input->post('conv');
        $accname = $this->input->post('accountName');
        
        
        $dataInsert = array(
                'accountname'    => $accname,
                'prefix'         => $prefix,
                'conversion_col' => $conv,
                'in_by'          => $this->session->userdata('userId')
            );
            if($this->Adv_Model->addAccount($dataInsert, $prefix, $conv)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'smoething when wrong';
            }   
        echo json_encode($response);
    }
        
}