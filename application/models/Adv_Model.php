<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adv_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    
    public function get_list($startdate, $enddate, $campaign_id=''){
        $sql0 = "SELECT * FROM campaign_report WHERE `day`>='" . $startdate . "' AND `day`<='" . $enddate . "' " . ($campaign_id != "" ? " AND campaign_id='" . $campaign_id . "'" : "") . " LIMIT 100 ";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    
    public function get_site_name(){
        $sql0 = "SELECT DISTINCT campaignName, campaignId FROM campaign_report order by campaignName";

        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    public function get_t_mediacost($startdate, $enddate, $campaign_id=''){
        $sql0 = "SELECT SUM(totalMediaCost) AS t_mediacost
       FROM campaign_report WHERE `day` >='" . $startdate . "' AND `day` <='" . $enddate . "' " . ($campaign_id != "" ? " AND campaign_id='" . $campaign_id . "'" : "");

        $query0 = $this->db->query($sql0);
        return $query0->row_array();
    }
   
    public function get_t_conversion($startdate, $enddate, $campaign_id=''){
        $sql0 = "SELECT SUM(totalConvertion) AS t_conversion
       FROM campaign_report WHERE `day` >='" . $startdate . "' AND `day` <='" . $enddate . "' " . ($campaign_id != "" ? " AND campaign_id='" . $campaign_id . "'" : "");

        $query0 = $this->db->query($sql0);
        return $query0->row_array();
    }
   
    
    public function get_ad_imp($startdate, $enddate, $campaign_id=''){
        $sql0 = "SELECT SUM(impression) AS t_rev
       FROM campaign_report WHERE `day` >='" . $startdate . "' AND `day` <='" . $enddate . "' " . ($campaign_id != "" ? " AND campaign_id='" . $campaign_id . "'" : "");

        $query0 = $this->db->query($sql0);
        return $query0->row_array();
    }
    
    public function getChild($mapid) {
        $sql0 = "SELECT * FROM mapchild WHERE idmap=" . $mapid . " order by idchild";

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
    
    public function editChild($data, $uid){
    
        $this->db->where('idchild', $uid);
        $this->db->update('mapchild', $data);
        if ($this->db->affected_rows() == '1'){
            return TRUE;
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
    
    
    public function getMinMaxDateForRawData(){
        $sql = "SELECT MIN(`day`) AS date1,
                MAX(`day`) AS date2 
                FROM campaign_report";

        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }
    
    public function insertCSV($tbl = 'campaign_report', $data){
        $this->db->insert($tbl, $data);
        return true;
    }
}