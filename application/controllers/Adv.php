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
                'lastupdate_cr' => $this->Adv_Model->get_last_update($al['prefix'] . '_campaign_report'),
                'lastupdate_cv' => $this->Adv_Model->get_last_update($al['prefix'] . '_campaign_version'),
                'lastupdate_cu' => $this->Adv_Model->get_last_update($al['prefix'] . '_campaign_unique'),
                'lastupdate_cd' => $this->Adv_Model->get_last_update($al['prefix'] . '_campaign_video'),

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
    
    public function detail(){
        if ($this->session->userdata('email') == ""){
			redirect('/login', 'refresh');
		}
        
        $this->load->view('public/template/header');
        $this->load->view('public/dashboard/dashboard_detail');
        $this->load->view('public/template/footer');
        
    }
    
    public function manage($idaccount){
        
        if ($this->session->userdata('email') == ""){
			redirect('/login', 'refresh');
		}
        
        $data = array (
            'accountInfo' => $this->Adv_Model->get_acc_info($idaccount),
        );
        
        $this->load->view('public/template/header');
        $this->load->view('public/dashboard/delete', $data);
        $this->load->view('public/template/footer');
    }
    
    public function addnew()
	{
        if ($this->session->userdata('email') == ""){
			redirect('/login', 'refresh');
		}
        
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
                
                if (mkdir("files/" . $prefix, 0777, true)){
                    chmod("files/" . $prefix, 0777);   
                    
                    if (mkdir("files/" . $prefix . "/campaign_report", 0777, true)) {
                        chmod("files/" . $prefix . "/campaign_report", 0777);    
                    }
                    if (mkdir("files/" . $prefix . "/campaign_version", 0777, true)) {
                        chmod("files/" . $prefix . "/campaign_version", 0777);
                    }
                    if (mkdir("files/" . $prefix . "/campaign_unique", 0777, true)) {
                        chmod("files/" . $prefix . "/campaign_unique", 0777);
                    }
                    if (mkdir("files/" . $prefix . "/campaign_video", 0777, true)) {
                        chmod("files/" . $prefix . "/campaign_video", 0777);
                    }
                }
                
                $response['status'] = TRUE;
                        
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }   
        echo json_encode($response);
    }
    
    
    
    public function accDelProg(){
        
        
        $prefix = $this->input->post('prefixs');
        $tbl_name = $this->input->post('prefixs') . '_' . $this->input->post('tabName');
        $sDate = $this->input->post('startDate');
        $eDate = $this->input->post('endDate');
        
        
        if($this->Adv_Model->delDataTable($prefix, $tbl_name, $sDate, $eDate)){
            $response['status'] = TRUE;
            
        }else{
            $response['status'] = FALSE;
            $response['msg'] = 'smoething when wrong';
        }   
        echo json_encode($response);
    }
    
    public function delTree($prefix){
        $dir_path = 'files/' . $prefix;
        $files = array_diff(scandir($dir_path), array('.','..'));
        foreach ($files as $file) {
          (is_dir("$dir_path/$file")) ? $this->delTree("$prefix/$file") : unlink("$dir_path/$file");
        }
        return rmdir($dir_path);
    }
    
    public function deletefileserver(){
        $fn = $this->input->post('p_filename');
        $prefix = $this->input->post('p_prefix');
        $type = $this->input->post('p_type');
        
        
        
        switch($type){
            case 'cr':
                $fullpath = 'files/' . $prefix . '/campaign_report/' . $fn;
                break;
            case 'vr':
                $fullpath =  'files/' . $prefix . '/campaign_version/' . $fn;
                break;
            case 'ur':
                $fullpath =  'files/' . $prefix . '/campaign_unique/' . $fn;
                break;
            case 'dr':
                $fullpath =  'files/' . $prefix . '/campaign_video/' . $fn;
                break;
        }
        
        if (unlink($fullpath)) {
            $response['status'] = TRUE;
        }else{
            $response['msg'] = 'something when wrong';
        }
        echo json_encode($response);
    }
    
    public function accDropProg(){
        
        
        $prefix = $this->input->post('prefixs');
        
        if($this->Adv_Model->dropDataTable($prefix)){
            
            $this->delTree($prefix);    
            $response['status'] = TRUE;
            
        }else{
            $response['status'] = FALSE;
            $response['msg'] = 'something when wrong';
        }   
        echo json_encode($response);
    }
        
}