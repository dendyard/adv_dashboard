<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model
{
    public function user_login($email,$password = null){

        $this->db->select('userid, email, password, status as role');
        $this->db->where('email', $email);
        
		$res = $this->db->get("master_user")->row();
		return $res;
    }
    
    public function getDetailUser($id){
        $this->db->where('id', $id);
		$res = $this->db->get("usersView")->row();
		return $res;
    }
    
    
}