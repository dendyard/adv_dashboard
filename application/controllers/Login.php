<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	}

	public function index()
	{
		if ($this->session->userdata('email') != ""){
			redirect('/adv', 'refresh');
		}
        
        $this->load->view('public/login/header');
        $this->load->view('public/login/main');
        $this->load->view('public/login/footer');
    }
    
    public function user_login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if(isset($this->session->userdata['logged_in'])){
			$data['message'] = "you already logged in";
		}elseif($username == "" && $password == ""){
			$data['status'] = false;
			$data['type'] = "error";
			$data['msg'] = "Can't find username in our databasesssssss";
		}else {			
			// $result = $this->auth->user_login($username,$password);
			$result = $this->auth->user_login($username);
			
			if (!empty($result)) {
				if(md5($password) == $result->password){
				//if($password == $result->password){
                    $session_data = array(
                        'userLogged' => TRUE,
                        'userId' => $result->userid,
                        'email'	=> $username,
                        'role' => $result->role,
                    );
                    $this->session->set_userdata($session_data);
                    $data['status'] = true;
                    $data['message'] = 'session crated';

				}
				else{
					$data['status'] = false;
					$data["type"] = "error";
					$data['msg'] = "Username and password combination doesn't match";
				}

			} else {
				$data['status'] = false;
				$data["type"] = "error";
				$data['msg'] = "Can't find username in our database";
			}
		}
		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/login', 'refresh');
	}
   
}