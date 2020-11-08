<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->model('Users_Model');
	 	if(!$logged){
	 		redirect("/login");
	 	}
	}
	
	public function index()
	{
        
        $data = array (
            'userList' => $this->Users_Model->get_list()
        );
         
        $this->load->view('public/template/header');
        $this->load->view('public/user/user_list',$data);
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
    
    public function deleteuserprofile(){
        $uid = $this->input->post('usid');
                           
        if($this->Users_Model->deleteChild($uid)){
            $response['status'] = TRUE;
        }else{
            $response['status'] = FALSE;
            $response['msg'] = 'something when wrong';
        }
        echo json_encode($response);
    }
    
    public function userUpsert($uid = ''){
        
        $password        = $this->input->post('password');
        $firstName       = $this->input->post('firstName');
        $lastName        = $this->input->post('lastName');
        $email           = $this->input->post('email');
        
        if ($uid == '') {
            $dataInsert = array(
                'firstname'     => $firstName,
                'lastname'      => $lastName,
                'email'         => $email,
                'password'      => md5($password),
                'status'        => 1,
                'createby'      => $this->session->userdata('userId'),
                'createdate'    => date("Y-m-d H:i:s"),
            );
            if($this->Users_Model->addUser($dataInsert)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'smoething when wrong';
            }    
        }else{

            $oldpass  = $this->input->post('oldpass');      
            $dataInsert = array(
                'firstname'     => $firstName,
                'lastname'      => $lastName,
                'email'         => $email,
                'password'      => (($oldpass != $password) ? md5($password): $password),
                'status'        =>  1,
                'createby'      => $this->session->userdata('userId'),
                'createdate'    => date("Y-m-d H:i:s"),
            );
            
            
            $userid = $this->input->post('userid');
            if($this->Users_Model->editUser($dataInsert, $userid)){
                $response['status'] = TRUE;
            }else{
                $response['status'] = FALSE;
                $response['msg'] = 'something when wrong';
            }   
        }
        
        echo json_encode($response);
        
    }
   
        
}