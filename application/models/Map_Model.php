<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    
    public function get_list(){
        $sql0 = "SELECT * FROM site_mapping order by id";
        
//        print $sql0;
//           exit();
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    public function getChild($mapid) {
        $sql0 = "SELECT * FROM mapchild WHERE idmap=" . $mapid . " order by idchild";
        
//        print $sql0;
//           exit();
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    
	public function addMap($data){
    
        $query = $this->db->insert('mapping', $data); 
        return $query;
    
    }
    
    public function addChildMap($data){
    
        $query = $this->db->insert('mapchild', $data); 
        return $query;
    
    }
    
    public function editMap($data, $uid){
    
        $this->db->where('idmap', $uid);
        $this->db->update('mapping', $data);
        if ($this->db->affected_rows() == '1'){
            return TRUE;
        }
        else{
            return FALSE;
        }
    
    }
    
    public function editChild($data, $uid, $sitefrom, $childName){
    
        $this->db->where('id', $uid);
        $this->db->update('site_mapping', $data);
        if ($this->db->affected_rows() == '1'){
           
            $sql0   = "UPDATE inventory_report SET site_mapping='" . $childName . "' WHERE ad_exchange_site_name='" . $sitefrom . "'";
            $query0 = $this->db->query($sql0);
            if ($this->db->affected_rows() >= '1'){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{
            return FALSE;
        }
    
    }
    
    public function deleteChild($uid) {
        $sql0   = "DELETE FROM mapchild WHERE idchild=" . $uid;
        $query0 = $this->db->query($sql0);
        if ($this->db->affected_rows() == '0'){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function deleteMap($uid) {
        $sql0   = "DELETE FROM mapping WHERE idmap=" . $uid;
        $query0 = $this->db->query($sql0);
        if ($this->db->affected_rows() == '0'){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    public function get_user_info($id) {
        $sql0 = "SELECT * FROM user where userid=" . $id;
        
        $query0 = $this->db->query($sql0);
        $result = $query0->row_array();
        return $result;
    }
}