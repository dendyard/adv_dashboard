<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csv extends CI_Controller {

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
        $this->load->model('Adv_Model');
	}
	
	public function index()
	{
        redirect('/');
    }
    
    public function add_cron(){
        $insert = $this->Adv_Model->crond_add();
    }
    
    public function fetch_campaign_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_report';
        $dir    = 'files/' . $prefix . '/campaign_report/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        $conversion_col = $this->Adv_Model->get_conversion_cols($prefix);
        
        $result = $this->process_campaign_report($dir . $files1[0],$tblacc, $conversion_col['conversion_col']);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function fetch_version_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_version';
        $dir    = 'files/' . $prefix . '/campaign_version/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        $conversion_col = $this->Adv_Model->get_conversion_cols($prefix);
        
        $result = $this->process_version_report($dir . $files1[0],$tblacc, $conversion_col['conversion_col']);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function fetch_video_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_video';
        $dir    = 'files/' . $prefix . '/campaign_video/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        
        
        $result = $this->process_video_report($dir . $files1[0], $tblacc);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function fetch_unique_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_unique';
        $dir    = 'files/' . $prefix . '/campaign_unique/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        
        $result = $this->process_unique_report($dir . $files1[0], $tblacc);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function process_campaign_report($filepath, $accname, $conv_col='0')
	{
		
            $file = $filepath;
            $i = 0;
            $handle = fopen($file, "r");
            
            while (($row = fgetcsv($handle))) {
                $i++;
                if ($i == 1) {
                    $totalCol = sizeOf($row);
                    for ($j = 30; $j <= ($totalCol-1); $j++) {
                        $metricName[] = $row[$j];
                    }
                }
                if ($i == 1) continue;
                
                $splited[0] = 'Undefined';
                $splited[1] = 'Undefined';
                $splited[2] = 'Undefined';
                $splited[3] = 'Undefined';
                $splited[4] = 'Undefined';
                $splited[5] = 'Undefined';
                $splited[6] = 'Undefined';
                $splited[7] = 'Undefined';
                $splited[8] = 'Undefined';
                
                if ($row[14] <> 'Undefined') {
                    $tmpsplited = explode('_', $row[14]);
                    for ($g = 0; $g <= (sizeOf($tmpsplited)-1); $g++) {
                        $splited[$g] = $tmpsplited[$g];
                    }
                }
                
                $old_date = $row[0];
                $old_date_timestamp = strtotime($old_date);
                $new_date = date('Y-m-d', $old_date_timestamp); 
                
                $camp_start = strtotime($row[7]);
                $camp_end = strtotime($row[8]);
                $new_cstart = date('Y-m-d', $camp_start); 
                $new_estart = date('Y-m-d', $camp_end); 
                
                $data = [
                    'day' => $new_date,
                    'accountId' => $row[1],
                    'accountName' => $row[2],
                    'advertiserId' => $row[3],
                    'advertiserName' => $row[4],
                    'campaignId' => $row[5],
                    'campaignName' => $row[6],
                    'campaignStartDate' => $new_cstart,
                    'campaignEndDate' => $new_estart,
                    'siteId' => $row[9],
                    'siteName' => $row[10],
                    'adId' => $row[11],
                    'adName' => $row[12],
                    'placementId' => $row[13],
                    'placementName' => $row[14],
                    'adFormatName' => $row[15],
                    'placementDimension' => $row[16],
                    'sectionName' => $row[17],
                    'costPerUnit' => $row[18],
                    'impression' => $row[19],
                    'clicks' => $row[20],
                    'totalConvertion' => $row[21],
                    'postClickConversion' => $row[22],
                    'postImpresionConversion' => $row[23],
                    'conversionRevenue' => $row[24],
                    'totalMediaCost' => numnegative($row[25]),
                    'ecpc' => $row[26],
                    'ecpa' => $row[27],
                    'ecpm' => $row[28],
                    'totalProfit' => numnegative($row[29]),
                    'placementNameSplit_1' => $splited[0],
                    'placementNameSplit_2' => $splited[1],
                    'placementNameSplit_3' => $splited[2],
                    'placementNameSplit_4' => $splited[3],
                    'placementNameSplit_5' => $splited[4],
                    'placementNameSplit_6' => $splited[5],
                    'placementNameSplit_7' => $splited[6],
                    'placementNameSplit_8' => $splited[7],
                    'placementNameSplit_9' => $splited[8],
                ];
              
              $findata = $data;
              for ($conv = 0; $conv <= (sizeOf($metricName)-1); $conv++){
                        $dt = [
                            'conversion_name_' . ($conv+1) => $metricName[$conv],
                            'conversion_value_' . ($conv+1) => numnegative($row[30 + $conv]),
                            
                        ];
                        
                        $findata = array_merge($findata, $dt);
                        unset($dt);
              }
                
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
            }
            
            fclose($handle);
            unlink($handle);
            return $insert;
	}
    
    public function process_version_report($filepath, $accname, $conv_col='0')
	{
		
            $file = $filepath;


            $i = 0;
            $handle = fopen($file, "r");
            
                
            while (($row = fgetcsv($handle))) {
                $i++;
                if ($i == 1) {
                    $totalCol = sizeOf($row);
                    for ($j = 26; $j <= ($totalCol-1); $j++) {
                        $metricName[] = $row[$j];
                    }
                }
                
                if ($i == 1) continue;
                
                $splited[0] = 'Undefined';
                $splited[1] = 'Undefined';
                $splited[2] = 'Undefined';
                $splited[3] = 'Undefined';
                $splited[4] = 'Undefined';
                $splited[5] = 'Undefined';
                $splited[6] = 'Undefined';
                $splited[7] = 'Undefined';
                $splited[8] = 'Undefined';
                
                if ($row[17] <> 'Undefined') {
                    $tmpsplited = explode('_', $row[17]);                    
                    for ($g = 0; $g <= (sizeOf($tmpsplited)-1); $g++) {
                        $splited[$g] = $tmpsplited[$g];
                    }
                }
 
                $old_date = $row[0];
                $old_date_timestamp = strtotime($old_date);
                $new_date = date('Y-m-d', $old_date_timestamp); 
                
                $camp_start = strtotime($row[7]);
                $camp_end = strtotime($row[8]);
                $new_cstart = date('Y-m-d', $camp_start); 
                $new_estart = date('Y-m-d', $camp_end); 
                
                $data = [
                    'day' => $new_date,
                    'accountId' => $row[1],
                    'accountName' => $row[2],
                    'advertiserId' => $row[3],
                    'advertiserName' => $row[4],
                    'campaignId' => $row[5],
                    'campaignName' => $row[6],
                    'campaignStartDate' => $new_cstart,
                    'campaignEndDate' => $new_estart,
                    'siteId' => $row[9],
                    'siteName' => $row[10],
                    'adId' => $row[11],
                    'adName' => $row[12],
                    'placementId' => $row[13],
                    'placementName' => $row[14],
                    'adFormatName' => $row[15],
                    'placementDimension' => $row[16],
                    'versionName' => $row[17],
                    'targetAudienceName' => $row[18],
                    'sectionName' => $row[19],
                    'impression' => $row[20],
                    'clicks' => $row[21],
                    'totalConversion' => $row[22],
                    'conversionRevenue' => $row[23],
                    'postClickConversion' => $row[24],
                    'postImpresionConversion' => $row[25],
                    'versNameSplit_1' => $splited[0],
                    'versNameSplit_2' => $splited[1],
                    'versNameSplit_3' => $splited[2],
                    'versNameSplit_4' => $splited[3],
                    'versNameSplit_5' => $splited[4],
                    'versNameSplit_6' => $splited[5],
                    'versNameSplit_7' => $splited[6],
                    'versNameSplit_8' => $splited[7],
                    'versNameSplit_9' => $splited[8],
                ];
                
              $findata = $data;
              for ($conv = 0; $conv <= (sizeOf($metricName)-1); $conv++){
                        $dt = [
                            'conversion_name_' . ($conv+1) => $metricName[$conv],
                            'conversion_value_' . ($conv+1) => numnegative($row[26 + $conv]),
                            
                        ];
                        
                        $findata = array_merge($findata, $dt);
                        unset($dt);
              }
                
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
                
                
            }

            fclose($handle);
            return $insert;
	}
   
    public function process_video_report($filepath, $accname)
	{
		
            $file = $filepath;

            $i = 0;
            $handle = fopen($file, "r");
                
            while (($row = fgetcsv($handle))) {
                $i++;

                if ($i == 1) continue;
                
                $splited[0] = 'Undefined';
                $splited[1] = 'Undefined';
                $splited[2] = 'Undefined';
                $splited[3] = 'Undefined';
                $splited[4] = 'Undefined';
                $splited[5] = 'Undefined';
                $splited[6] = 'Undefined';
                $splited[7] = 'Undefined';
                $splited[8] = 'Undefined';
                
                if ($row[14] <> 'Undefined') {
                    $tmpsplited = explode('_', $row[14]);                    
                    for ($g = 0; $g <= (sizeOf($tmpsplited)-1); $g++) {
                        $splited[$g] = $tmpsplited[$g];
                    }
                }
 
                $old_date = $row[0];
                $old_date_timestamp = strtotime($old_date);
                $new_date = date('Y-m-d', $old_date_timestamp); 
                
                $camp_start = strtotime($row[7]);
                $camp_end = strtotime($row[8]);
                $new_cstart = date('Y-m-d', $camp_start); 
                $new_estart = date('Y-m-d', $camp_end); 
                
                $data = [
                    'day' => $new_date,
                    'accountId' => $row[1],
                    'accountName' => $row[2],
                    'advertiserId' => $row[3],
                    'advertiserName' => $row[4],
                    'campaignId' => $row[5],
                    'campaignName' => $row[6],
                    'campaignStartDate' => $new_cstart,
                    'campaignEndDate' => $new_estart,
                    'siteId' => $row[9],
                    'siteName' => $row[10],
                    'adId' => $row[11],
                    'adName' => $row[12],
                    'placementId' => $row[13],
                    'placementName' => $row[14],
                    'adFormatName' => $row[15],
                    'placementDimension' => $row[16],
                    'sectionName' => $row[17],
                    'costPerUnit' => $row[18],
                    'impression' => $row[19],
                    'clicks' => $row[20],
                    'totalConversion' => $row[21],
                    'postClickConversion' => $row[22],
                    'postImpresionConversion' => $row[23],
                    'conversionRevenue' => $row[24],
                    'totalMediaCost' => $row[25],
                    'ecpc' => $row[26],
                    'ecpa' => $row[27],
                    'ecpm' => $row[28],
                    'totalProfit' => $row[29],
                    'adAverageDuration' => $row[30],
                    'videoStart	' => $row[31],
                    'videoPlayed25' => $row[32],
                    'videoPlayed50' => $row[33],
                    'videoPlayed75' => $row[34],
                    'videoPlayedFull' => $row[35],
                    'videoAverageDuration' => $row[36],
                    'placementNameSplit_1' => $splited[0],
                    'placementNameSplit_2' => $splited[1],
                    'placementNameSplit_3' => $splited[2],
                    'placementNameSplit_4' => $splited[3],
                    'placementNameSplit_5' => $splited[4],
                    'placementNameSplit_6' => $splited[5],
                    'placementNameSplit_7' => $splited[6],
                    'placementNameSplit_8' => $splited[7],
                    'placementNameSplit_9' => $splited[8],
                ];
                
              $insert = $this->Adv_Model->insertCSV($accname, $data);
                
            }

            fclose($handle);
            return $insert;
	}
    
    public function process_unique_report($filepath, $accname)
        {
		
            $file = $filepath;

            $i = 0;
            $handle = fopen($file, "r");
                
            while (($row = fgetcsv($handle))) {
                $i++;

                
                if ($i == 1) continue;
                
                $splited[0] = 'Undefined';
                $splited[1] = 'Undefined';
                $splited[2] = 'Undefined';
                $splited[3] = 'Undefined';
                $splited[4] = 'Undefined';
                $splited[5] = 'Undefined';
                $splited[6] = 'Undefined';
                $splited[7] = 'Undefined';
                $splited[8] = 'Undefined';
                
                if ($row[13] <> 'Undefined') {
                    $tmpsplited = explode('_', $row[13]);                    
                    for ($g = 0; $g <= (sizeOf($tmpsplited)-1); $g++) {
                        $splited[$g] = $tmpsplited[$g];
                    }
                }
 
                $old_date = $row[0];
                $old_date_timestamp = strtotime($old_date);
                $new_date = date('Y-m-d', $old_date_timestamp); 
                
                $camp_start = strtotime($row[6]);
                $camp_end = strtotime($row[7]);
                $new_cstart = date('Y-m-d', $camp_start); 
                $new_estart = date('Y-m-d', $camp_end);
                
                $data = [
                    'accountId' => $new_date,
                    'accountName' => $row[1],
                    'advertiserId' => $row[2],
                    'advertiserName' => $row[3],
                    'campaignId' => $row[4],
                    'campaignName' => $row[5],
                    'campaignStartDate' => $new_cstart,
                    'campaignEndDate' => $new_estart,
                    'siteId' => $row[8],
                    'siteName' => $row[9],
                    'adId' => $row[10],
                    'adName' => $row[11],
                    'placementId' => $row[12],
                    'placementName' => $row[13],
                    'adFormatName' => $row[14],
                    'placementDimension' => $row[15],
                    'sectionName' => $row[16],
                    'costPerUnit' => $row[17],
                    'impression' => $row[18],
                    'clicks' => $row[19],
                    'totalConversion' => $row[20],
                    'postClickConversion' => $row[21],
                    'postImpresionConversion' => $row[22],
                    'conversionRevenue' => $row[23],
                    'totalMediaCost' => $row[24],
                    'uniqueImpression' => $row[25],
                    'uniqueClicks' => $row[26],
                    'averageFrequensy' => $row[27],
                    'uniqueVideoStartd' => $row[28],
                    'uniqueInteraction' => $row[29],
                    'adAverageDuration' => $row[30],
                    'videoStart' => $row[31],
                    'videoPlayed25' => $row[32],
                    'videoPlayed50' => $row[33],
                    'videoPlayed75' => $row[34],
                    'videoPlayedFull' => $row[35],
                    'videoAverageDuration' => $row[36],
                    'placementNameSplit_1' => $splited[0],
                    'placementNameSplit_2' => $splited[1],
                    'placementNameSplit_3' => $splited[2],
                    'placementNameSplit_4' => $splited[3],
                    'placementNameSplit_5' => $splited[4],
                    'placementNameSplit_6' => $splited[5],
                    'placementNameSplit_7' => $splited[6],
                    'placementNameSplit_8' => $splited[7],
                    'placementNameSplit_9' => $splited[8],
                ];
                
              $insert = $this->Adv_Model->insertCSV($accname, $data);
                
            }

            fclose($handle);
            return $insert;
    }
    
    public function delete_ftp_file($ftpfile) {
        //DELETE FILE
            $ftpfile = "/adv/files/campaign_report/Djarum_campaign_report_20201028073323492.csv";
                
            $ftp_server="3.128.254.22";
            // set up basic connection
            $conn_id = ftp_connect($ftp_server);
        
            $ftp_user_name="advftp";
            $ftp_user_pass="@dV!f795erV!5";
        
            // login with username and password
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
            
            echo 'Login result : ' . $login_result;
            // try to delete $file
            if (ftp_delete($conn_id, $filepath)) {
            echo "$file deleted successful\n";
            } else {
            echo "could not delete $file\n";
            }

            // close the connection
            ftp_close($conn_id);
        
            //END OF DELETE
    }
        
}