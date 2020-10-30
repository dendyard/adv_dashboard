<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    
    public function get_list(){
        $sql0 = "SELECT * FROM user_props order by userid";
        
//        print $sql0;
//           exit();
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    
	public function addUser($data){
    
        $query = $this->db->insert('user_props', $data); 
        return $query;
    
    }
    
    public function editUser($data, $uid){
        //print $data;
        //exit();
        $this->db->where('userid', $uid);
        $this->db->update('user_props', $data);
        if ($this->db->affected_rows() == '1'){
            return TRUE;
        }
        else{
            return FALSE;
        }
    
    }
    
    public function deleteChild($uid) {
        $sql0   = "DELETE FROM user_props WHERE userid=" . $uid;
        $query0 = $this->db->query($sql0);
        if ($this->db->affected_rows() == '0'){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    
    public function get_user_info($id) {
        $sql0 = "SELECT * FROM user_props where userid=" . $id;
        
        $query0 = $this->db->query($sql0);
        $result = $query0->row_array();
        return $result;
    }
}