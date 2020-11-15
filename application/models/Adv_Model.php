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
    
    
    public function get_account_list(){
        $sql0 = "SELECT * FROM master_account ORDER by id";

        $query0 = $this->db->query($sql0);
        return $query0->result_array();
    }
    
    public function get_record_table($tblName) {
        $sql0 = "SELECT count(accountName) as t_record FROM " . $tblName;

        $query0 = $this->db->query($sql0);
        return $query0->row_array();
    }
    
    public function get_conversion_cols($prefix) {
        $sql = "SELECT conversion_col FROM master_account WHERE prefix='" . $prefix . "' LIMIT 1";
        $query = $this->db->query($sql);
        
        return $query->row_array();
    }
   
    public function addAccount($data,$prefix, $conv){
    
        $query = $this->db->insert('master_account', $data); 
        
        if ($query) {
            $addtbl = $this->createAccountTable($prefix, $conv);
            return $addtbl;
        }
    }
    
    public function createAccountTable($prefix, $conv){
        
        $cv_col = '';
        for ($i = 1; $i <= ($conv * 4); $i++ ) {
            $cv_col .= '`conversion_name_' . $i . '` varchar(350) DEFAULT NULL, `conversion_value_' . $i . '` double DEFAULT NULL,';
        }
        
        
        $campaign = 'CREATE TABLE `' . $prefix . '_campaign_report` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `day` varchar(50) DEFAULT NULL,
  `accountId` int(11) DEFAULT NULL,
  `accountName` varchar(100) DEFAULT NULL,
  `advertiserId` int(11) DEFAULT NULL,
  `advertiserName` varchar(100) DEFAULT NULL,
  `campaignId` varchar(50) DEFAULT NULL,
  `campaignName` varchar(250) DEFAULT NULL,
  `campaignStartDate` varchar(100) DEFAULT NULL,
  `campaignEndDate` varchar(100) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  `siteName` varchar(250) DEFAULT NULL,
  `adId` varchar(50) DEFAULT NULL,
  `adName` varchar(250) DEFAULT NULL,
  `placementId` varchar(50) DEFAULT NULL,
  `placementName` varchar(250) DEFAULT NULL,
  `adFormatName` varchar(150) DEFAULT NULL,
  `placementDimension` varchar(250) DEFAULT NULL,
  `sectionName` varchar(150) DEFAULT NULL,
  `costPerUnit` bigint(20) DEFAULT NULL,
  `impression` bigint(20) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `totalConvertion` bigint(20) DEFAULT NULL,
  `postClickConversion` bigint(20) DEFAULT NULL,
  `postImpresionConversion` bigint(20) DEFAULT NULL,
  `conversionRevenue` bigint(20) DEFAULT NULL,
  `totalMediaCost` double DEFAULT NULL,
  `ecpc` double DEFAULT NULL,
  `ecpa` double DEFAULT NULL,
  `ecpm` double DEFAULT NULL,
  `totalProfit` double DEFAULT NULL,
  `placementNameSplit_1` varchar(150) DEFAULT NULL,
  `placementNameSplit_2` varchar(150) DEFAULT NULL,
  `placementNameSplit_3` varchar(150) DEFAULT NULL,
  `placementNameSplit_4` varchar(150) DEFAULT NULL,
  `placementNameSplit_5` varchar(120) DEFAULT NULL,
  `placementNameSplit_6` varchar(150) DEFAULT NULL,
  `placementNameSplit_7` varchar(150) DEFAULT NULL,
  `placementNameSplit_8` varchar(150) DEFAULT NULL,
  `placementNameSplit_9` varchar(150) DEFAULT NULL, ' . $cv_col . '
  `in_date` datetime DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
               
        
        
$version_tbl = 'CREATE TABLE `' . $prefix . '_campaign_version` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `day` date DEFAULT NULL,
  `accountId` int(11) DEFAULT NULL,
  `accountName` varchar(100) DEFAULT NULL,
  `advertiserId` int(11) DEFAULT NULL,
  `advertiserName` varchar(100) DEFAULT NULL,
  `campaignId` varchar(50) DEFAULT NULL,
  `campaignName` varchar(250) DEFAULT NULL,
  `campaignStartDate` varchar(100) DEFAULT NULL,
  `campaignEndDate` varchar(100) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  `siteName` varchar(250) DEFAULT NULL,
  `adId` varchar(50) DEFAULT NULL,
  `adName` varchar(250) DEFAULT NULL,
  `placementId` varchar(50) DEFAULT NULL,
  `placementName` text,
  `adFormatName` varchar(150) DEFAULT NULL,
  `placementDimension` varchar(250) DEFAULT NULL,
  `versionName` varchar(250) DEFAULT NULL,
  `targetAudienceName` varchar(100) DEFAULT NULL,
  `sectionName` varchar(200) NOT NULL,
  `impression` bigint(20) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `totalConversion` bigint(20) DEFAULT NULL,
  `conversionRevenue` bigint(20) DEFAULT NULL,
  `postClickConversion` bigint(20) DEFAULT NULL,
  `postImpresionConversion` bigint(20) DEFAULT NULL,
  `versNameSplit_1` varchar(150) DEFAULT NULL,
  `versNameSplit_2` varchar(150) DEFAULT NULL,
  `versNameSplit_3` varchar(150) DEFAULT NULL,
  `versNameSplit_4` varchar(150) DEFAULT NULL,
  `versNameSplit_5` varchar(120) DEFAULT NULL,
  `versNameSplit_6` varchar(150) DEFAULT NULL,
  `versNameSplit_7` varchar(120) DEFAULT NULL,
  `versNameSplit_8` varchar(120) DEFAULT NULL,
  `versNameSplit_9` varchar(150) DEFAULT NULL,' . $cv_col . '
  `in_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
        
$unique_tbl = 'CREATE TABLE `' . $prefix . '_campaign_unique` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accountId` int(11) DEFAULT NULL,
  `accountName` varchar(100) DEFAULT NULL,
  `advertiserId` int(11) DEFAULT NULL,
  `advertiserName` varchar(100) DEFAULT NULL,
  `campaignId` varchar(50) DEFAULT NULL,
  `campaignName` varchar(250) DEFAULT NULL,
  `campaignStartDate` varchar(100) DEFAULT NULL,
  `campaignEndDate` varchar(100) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  `siteName` varchar(250) DEFAULT NULL,
  `adId` varchar(50) DEFAULT NULL,
  `adName` varchar(250) DEFAULT NULL,
  `placementId` varchar(50) DEFAULT NULL,
  `placementName` varchar(250) DEFAULT NULL,
  `adFormatName` varchar(150) DEFAULT NULL,
  `placementDimension` varchar(250) DEFAULT NULL,
  `sectionName` varchar(150) DEFAULT NULL,
  `costPerUnit` bigint(20) DEFAULT NULL,
  `impression` bigint(20) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `totalConversion` bigint(20) DEFAULT NULL,
  `postClickConversion` bigint(20) DEFAULT NULL,
  `postImpresionConversion` bigint(20) DEFAULT NULL,
  `conversionRevenue` bigint(20) DEFAULT NULL,
  `totalMediaCost` double DEFAULT NULL,
  `uniqueImpression` double DEFAULT NULL,
  `uniqueClicks` double DEFAULT NULL,
  `averageFrequensy` double DEFAULT NULL,
  `uniqueVideoStartd` double DEFAULT NULL,
  `uniqueInteraction` double DEFAULT NULL,
  `adAverageDuration` double DEFAULT NULL,
  `videoStart` double DEFAULT NULL,
  `videoPlayed25` double DEFAULT NULL,
  `videoPlayed50` double DEFAULT NULL,
  `videoPlayed75` double DEFAULT NULL,
  `videoPlayedFull` double DEFAULT NULL,
  `videoAverageDuration` double DEFAULT NULL,
  `placementNameSplit_1` varchar(150) DEFAULT NULL,
  `placementNameSplit_2` varchar(150) DEFAULT NULL,
  `placementNameSplit_3` varchar(150) DEFAULT NULL,
  `placementNameSplit_4` varchar(150) DEFAULT NULL,
  `placementNameSplit_5` varchar(120) DEFAULT NULL,
  `placementNameSplit_6` varchar(150) DEFAULT NULL,
  `placementNameSplit_7` varchar(120) DEFAULT NULL,
  `placementNameSplit_8` varchar(120) DEFAULT NULL,
  `placementNameSplit_9` varchar(150) DEFAULT NULL,
  `in_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
      
$video_tbl = 'CREATE TABLE `' . $prefix . '_campaign_video` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `day` varchar(50) DEFAULT NULL,
  `accountId` int(11) DEFAULT NULL,
  `accountName` varchar(100) DEFAULT NULL,
  `advertiserId` int(11) DEFAULT NULL,
  `advertiserName` varchar(100) DEFAULT NULL,
  `campaignId` varchar(50) DEFAULT NULL,
  `campaignName` varchar(250) DEFAULT NULL,
  `campaignStartDate` varchar(100) DEFAULT NULL,
  `campaignEndDate` varchar(100) DEFAULT NULL,
  `siteId` int(11) DEFAULT NULL,
  `siteName` varchar(250) DEFAULT NULL,
  `adId` varchar(50) DEFAULT NULL,
  `adName` varchar(250) DEFAULT NULL,
  `placementId` varchar(50) DEFAULT NULL,
  `placementName` varchar(250) DEFAULT NULL,
  `adFormatName` varchar(150) DEFAULT NULL,
  `placementDimension` varchar(250) DEFAULT NULL,
  `sectionName` varchar(150) DEFAULT NULL,
  `costPerUnit` bigint(20) DEFAULT NULL,
  `impression` bigint(20) DEFAULT NULL,
  `clicks` bigint(20) DEFAULT NULL,
  `totalConversion` bigint(20) DEFAULT NULL,
  `postClickConversion` bigint(20) DEFAULT NULL,
  `postImpresionConversion` bigint(20) DEFAULT NULL,
  `conversionRevenue` bigint(20) DEFAULT NULL,
  `totalMediaCost` double DEFAULT NULL,
  `ecpc` double DEFAULT NULL,
  `ecpa` double DEFAULT NULL,
  `ecpm` double DEFAULT NULL,
  `totalProfit` double DEFAULT NULL,
  `adAverageDuration` double DEFAULT NULL,
  `videoStart` double DEFAULT NULL,
  `videoPlayed25` double DEFAULT NULL,
  `videoPlayed50` double DEFAULT NULL,
  `videoPlayed75` double DEFAULT NULL,
  `videoPlayedFull` double DEFAULT NULL,
  `videoAverageDuration` double DEFAULT NULL,
  `placementNameSplit_1` varchar(150) DEFAULT NULL,
  `placementNameSplit_2` varchar(150) DEFAULT NULL,
  `placementNameSplit_3` varchar(150) DEFAULT NULL,
  `placementNameSplit_4` varchar(150) DEFAULT NULL,
  `placementNameSplit_5` varchar(120) DEFAULT NULL,
  `placementNameSplit_6` varchar(150) DEFAULT NULL,
  `placementNameSplit_7` varchar(120) DEFAULT NULL,
  `placementNameSplit_8` varchar(120) DEFAULT NULL,
  `placementNameSplit_9` varchar(150) DEFAULT NULL,
  `in_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
        
        $query0 = $this->db->query($campaign);
        
        if ($query0) {
            $query1 = $this->db->query($version_tbl);    
            if ($query1) {
                $query2 = $this->db->query($unique_tbl);
                if ($query2) {
                    $query3 = $this->db->query($video_tbl);
                    return $query3;
                }
            }
        }
        exit();
        
    }
    
    public function get_user_info($id) {
        $sql0 = "SELECT * FROM user where userid=" . $id;
        
        $query0 = $this->db->query($sql0);
        $result = $query0->row_array();
        return $result;
    }
    
    public function get_acc_info($id) {
        $sql0 = "SELECT * FROM master_account where prefix='" . $id . "'";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->row_array();
        return $result;
    }
    
    
    public function crond_add() {
        $sql0 = "INSERT INTO master_user (`username`) VALUES ('fromCron_Dashboard')";
        
        $query0 = $this->db->query($sql0);
    }
    
    public function delDataTable($prefix, $tbl_name, $sDate, $eDate) {
        $sql0 = "DELETE FROM " . $tbl_name . " WHERE in_date >='" . $sDate . " 00:00:00' AND in_date <='" . $eDate . " 23:59:59'";
        
        $query0 = $this->db->query($sql0);
        return $query0;
    }
    
    public function dropDataTable($prefix) {
        $sql1 = "DROP TABLE " . $prefix . "_campaign_report";
        $sql2 = "DROP TABLE " . $prefix . "_campaign_unique";
        $sql3 = "DROP TABLE " . $prefix . "_campaign_version";
        $sql4 = "DROP TABLE " . $prefix . "_campaign_video";
        
        $sql5 = "DELETE from master_account WHERE prefix='" . $prefix . "'";
        
        $query1 = $this->db->query($sql1);
        $query2 = $this->db->query($sql2);
        $query3 = $this->db->query($sql3);
        $query4 = $this->db->query($sql4);
        $query5 = $this->db->query($sql5);
        
        
        return $query5;
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