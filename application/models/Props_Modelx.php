<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Props_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    
    public function get_list($startdate, $enddate, $sitename=''){
        $sql0 = "SELECT * FROM ad_performance_group WHERE date>='" . $startdate . "' AND date<='" . $enddate . "'" . (($sitename=='') ? "" : " AND site_name='" . $sitename . "'");

        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    public function get_site_name(){
        $sql0 = "SELECT DISTINCT site_mapped_by FROM site_mapping order by site_mapped_by";

        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    public function get_t_revenue($startdate, $enddate, $sitename=''){
        $sql0 = "SELECT SUM(revenue_idr) AS t_rev
       FROM ad_performance_group WHERE date>='" . $startdate . "' AND date<='" . $enddate . "'" . (($sitename=='') ? "" : " AND site_name='" . $sitename . "'");

        $query0 = $this->db->query($sql0);
        return $query0->row_array();
    }
    
    public function get_ad_req($startdate, $enddate, $sitename=''){
        $sql0 = "SELECT SUM(requests) AS t_rev
       FROM ad_performance_group WHERE date>='" . $startdate . "' AND date<='" . $enddate . "'" . (($sitename=='') ? "" : " AND site_name='" . $sitename . "'");

        $query0 = $this->db->query($sql0);
        return $query0->row_array();
    }
    
    public function get_ad_imp($startdate, $enddate, $sitename=''){
        $sql0 = "SELECT SUM(impressions) AS t_rev
       FROM ad_performance_group WHERE date>='" . $startdate . "' AND date<='" . $enddate . "'" . (($sitename=='') ? "" : " AND site_name='" . $sitename . "'");

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
        $sql = "SELECT MIN(date) AS date1,
                MAX(date) AS date2 
                FROM ad_preformance_temp";

        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $result;
    }
}