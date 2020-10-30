<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapping extends CI_Controller {

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
        $this->load->model('Map_Model');
	 	if(!$logged){
	 		redirect("/login");
	 	}
	}
	
	public function index()
	{
        $data = array(
            'groupList' => $this->Map_Model->get_list()
		);
        
        $this->load->view('public/template/header');
        $this->load->view('public/mapping/main2', $data);
        $this->load->view('public/template/footer');
        
    }
    
    
    public function edit($id)
	{
        $data = array(
            'userid' => $id,
            'datauser' => $this->Users_Model->get_user_info($id)
		);
        
        $this->load->view('public/template/header');
        $this->load->view('public/user/edit', $data);
        $this->load->view('public/template/footer');
        
    }
   
    public function addnew()
	{
        
        $this->load->view('public/template/header');
        $this->load->view('public/user/addnew');
        $this->load->view('public/template/footer');
        
    }
    
    public function mapUpsert($type = ''){
        
        
        
        
        if ($type == 'childAdd') {
            //Add Child Map
            $groupName = $this->input->post('groupName');
            $idMap     = $this->input->post('idMap');
                           
            $dataInsert = array(
                'idmap'         => $idMap,
                'childname'     => $groupName,
                'createby'     => $this->session->userdata('userId'),
                'lastupdate'    => date("Y-m-d H:i:s"),
            );
            
            if($this->Map_Model->addChildMap($dataInsert)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }
            
        }elseif ($type == 'childEdit'){
            //Edit Child Map

            $childName = $this->input->post('childName');
            $idChild = $this->input->post('idChild');
            $sitefrom = $this->input->post('sitefrom');
                           
            $dataInsert = array( 
                'site_mapped_by'  => $childName,
                'created_date'    => date("Y-m-d H:i:s"),
            );
            if($this->Map_Model->editChild($dataInsert, $idChild, $sitefrom, $childName)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }
        }elseif ($type == 'childDelete'){
            //Delete Child Map

            $idChild = $this->input->post('id');
                           
        
            if($this->Map_Model->deleteChild($idChild)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }
        
        }elseif ($type == 'mapAdd') {
            //Add Parent Map
            $groupName = $this->input->post('groupName');
       
                           
            $dataInsert = array(
                'groupname'     => $groupName,
                'createby'      => $this->session->userdata('userId'),
                'lastupdate'    => date("Y-m-d H:i:s"),
            );
            if($this->Map_Model->addMap($dataInsert)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }
            
        }elseif ($type == 'mapEdit') {
            //Edit Parent Map
            $groupName = $this->input->post('groupName');
            $idgroup = $this->input->post('idgroup');
                           
            $dataInsert = array(
                'groupname'     => $groupName,
                'createby'      => $this->session->userdata('userId'),
                'lastupdate'    => date("Y-m-d H:i:s"),
            );
            if($this->Map_Model->editMap($dataInsert, $idgroup)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }
        }elseif ($type == "mapDelete"){
            //Delete Parent Map
            $idMap = $this->input->post('id');
                           
            if($this->Map_Model->deleteMap($idMap)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }
        }
        
        
    
            
        echo json_encode($response);
        
    }
   
        
}