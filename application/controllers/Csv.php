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
    
    public function scan_dir(){
        $accList = $this->Adv_Model->get_account_list();

        $findata = [];
        foreach ($accList as $al) {
            
            if ($al['custom_colnum'] != 0) {
                $custom_report = 'files/' . $al['prefix'] . '/';
                $custom_files1 = array_diff(scandir($custom_report,1), array('..', '.', '.DS_Store'));
                
                foreach ($custom_files1 as $fl0) {
                    $ct[] = $fl0;
                }
                
                if (isset($ct)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'custom_report',
                        'files' => $ct
                    );
                    unset($ct);    
                }
                
            }else{
                
                $camp_report = 'files/' . $al['prefix'] . '/campaign_report/';
                $version_report = 'files/' . $al['prefix'] . '/campaign_version/';
                $unique_report = 'files/' . $al['prefix'] . '/campaign_unique/';
                $video_report = 'files/' . $al['prefix'] . '/campaign_video/';

                $camp_files1 = array_diff(scandir($camp_report,1), array('..', '.', '.DS_Store'));
                $version_files1 = array_diff(scandir($version_report,1), array('..', '.', '.DS_Store'));
                $unique_files1 = array_diff(scandir($unique_report,1), array('..', '.', '.DS_Store'));
                $video_files1 = array_diff(scandir($video_report,1), array('..', '.', '.DS_Store'));


                foreach ($camp_files1 as $fl0) {
                    $cr[] = $fl0;
                }

                foreach ($version_files1 as $fl0) {
                    $cv[] = $fl0;
                }

                foreach ($unique_files1 as $fl0) {
                    $cu[] = $fl0;
                }

                foreach ($video_files1 as $fl0) {
                    $cd[] = $fl0;
                }

                if (isset($cr)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_report',
                        'files' => $cr
                    );
                    unset($cr);    
                }

                if (isset($cv)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_version',
                        'files' => $cv
                    );
                    unset($cv);    
                }

                if (isset($cu)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_unique',
                        'files' => $cu
                    );
                    unset($cu);    
                }

                if (isset($cd)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_video',
                        'files' => $cd
                    );
                    unset($cd);    
                }
            }
            
        }

        foreach ($findata as $listqu) {
            foreach ($listqu['files'] as $rq) {
   
                if ($listqu['type'] == 'campaign_report') {
                    $result = $this->fetch_campaign_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_version') {
                    $result = $this->fetch_version_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_unique') {
                    $result = $this->fetch_unique_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_video') {
                    $result = $this->fetch_video_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'custom_report') {
                    $result = $this->fetch_custom_report($listqu['prefix']);
                }
                
            }
            
        }
        
        $response['status'] = TRUE;
        echo json_encode($response);
    }
    
    public function scan_dir_OLD_BACKUP(){
        
        $accList = $this->Adv_Model->get_account_list();

        $findata = [];
        foreach ($accList as $al) {
            
            $camp_report = 'files/' . $al['prefix'] . '/campaign_report/';
            $version_report = 'files/' . $al['prefix'] . '/campaign_version/';
            $unique_report = 'files/' . $al['prefix'] . '/campaign_unique/';
            $video_report = 'files/' . $al['prefix'] . '/campaign_video/';
            
            $camp_files1 = array_diff(scandir($camp_report,1), array('..', '.', '.DS_Store'));
            $version_files1 = array_diff(scandir($version_report,1), array('..', '.', '.DS_Store'));
            $unique_files1 = array_diff(scandir($unique_report,1), array('..', '.', '.DS_Store'));
            $video_files1 = array_diff(scandir($video_report,1), array('..', '.', '.DS_Store'));
            
            
            foreach ($camp_files1 as $fl0) {
                $cr[] = $fl0;
            }
            
            foreach ($version_files1 as $fl0) {
                $cv[] = $fl0;
            }
            
            foreach ($unique_files1 as $fl0) {
                $cu[] = $fl0;
            }
            
            foreach ($video_files1 as $fl0) {
                $cd[] = $fl0;
            }
            
            if (isset($cr)) {
                $findata[] = array (
                    'prefix' => $al['prefix'],
                    'type' => 'campaign_report',
                    'files' => $cr
                );
                unset($cr);    
            }
            
            if (isset($cv)) {
                $findata[] = array (
                    'prefix' => $al['prefix'],
                    'type' => 'campaign_version',
                    'files' => $cv
                );
                unset($cv);    
            }
            
            if (isset($cu)) {
                $findata[] = array (
                    'prefix' => $al['prefix'],
                    'type' => 'campaign_unique',
                    'files' => $cu
                );
                unset($cu);    
            }
            
            if (isset($cd)) {
                $findata[] = array (
                    'prefix' => $al['prefix'],
                    'type' => 'campaign_video',
                    'files' => $cd
                );
                unset($cd);    
            }
            
            
        }

        foreach ($findata as $listqu) {
            foreach ($listqu['files'] as $rq) {
   
                if ($listqu['type'] == 'campaign_report') {
                    $result = $this->fetch_campaign_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_version') {
                    $result = $this->fetch_version_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_unique') {
                    $result = $this->fetch_unique_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_video') {
                    $result = $this->fetch_video_report($listqu['prefix']);
                }
                
            }
            
        }
    }
    
    public function force_scan(){
        
        $accList = $this->Adv_Model->get_account_list();

        $findata = [];
        foreach ($accList as $al) {
            
            if ($al['custom_colnum'] != 0) {
                $custom_report = 'files/' . $al['prefix'] . '/';
                $custom_files1 = array_diff(scandir($custom_report,1), array('..', '.', '.DS_Store'));
                
                foreach ($custom_files1 as $fl0) {
                    $ct[] = $fl0;
                }
                
                if (isset($ct)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'custom_report',
                        'files' => $ct
                    );
                    unset($ct);    
                }
                
            }else{
                
            
                $camp_report = 'files/' . $al['prefix'] . '/campaign_report/';
                $version_report = 'files/' . $al['prefix'] . '/campaign_version/';
                $unique_report = 'files/' . $al['prefix'] . '/campaign_unique/';
                $video_report = 'files/' . $al['prefix'] . '/campaign_video/';

                $camp_files1 = array_diff(scandir($camp_report,1), array('..', '.', '.DS_Store'));
                $version_files1 = array_diff(scandir($version_report,1), array('..', '.', '.DS_Store'));
                $unique_files1 = array_diff(scandir($unique_report,1), array('..', '.', '.DS_Store'));
                $video_files1 = array_diff(scandir($video_report,1), array('..', '.', '.DS_Store'));


                foreach ($camp_files1 as $fl0) {
                    $cr[] = $fl0;
                }

                foreach ($version_files1 as $fl0) {
                    $cv[] = $fl0;
                }

                foreach ($unique_files1 as $fl0) {
                    $cu[] = $fl0;
                }

                foreach ($video_files1 as $fl0) {
                    $cd[] = $fl0;
                }

                if (isset($cr)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_report',
                        'files' => $cr
                    );
                    unset($cr);    
                }

                if (isset($cv)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_version',
                        'files' => $cv
                    );
                    unset($cv);    
                }

                if (isset($cu)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_unique',
                        'files' => $cu
                    );
                    unset($cu);    
                }

                if (isset($cd)) {
                    $findata[] = array (
                        'prefix' => $al['prefix'],
                        'type' => 'campaign_video',
                        'files' => $cd
                    );
                    unset($cd);    
                }
            }
            
        }

        foreach ($findata as $listqu) {
            foreach ($listqu['files'] as $rq) {
   
                if ($listqu['type'] == 'campaign_report') {
                    $result = $this->fetch_campaign_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_version') {
                    $result = $this->fetch_version_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_unique') {
                    $result = $this->fetch_unique_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'campaign_video') {
                    $result = $this->fetch_video_report($listqu['prefix']);
                }elseif ($listqu['type'] == 'custom_report') {
                    $result = $this->fetch_custom_report($listqu['prefix']);
                }
                
            }
            
        }
        
        $response['status'] = TRUE;
        echo json_encode($response);
        
    }
    
    public function add_cron(){
        $insert = $this->Adv_Model->crond_add();
    }
    
    public function fetch_custom_report($prefix=''){
        
        $tblacc = $prefix;
        $dir    = 'files/' . $prefix . '/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        $conversion_col = $this->Adv_Model->get_conversion_cols($prefix);
        
        $result = $this->process_custom_report($dir . $files1[0],$tblacc, $conversion_col['conversion_col']);
        
        //echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
    }
    
    public function fetch_campaign_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_report';
        $dir    = 'files/' . $prefix . '/campaign_report/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        $conversion_col = $this->Adv_Model->get_conversion_cols($prefix);
        
        $result = $this->process_campaign_report($dir . $files1[0],$tblacc, $conversion_col['conversion_col']);
        
        //echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
    }
    
    public function fetch_version_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_version';
        $dir    = 'files/' . $prefix . '/campaign_version/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        $conversion_col = $this->Adv_Model->get_conversion_cols($prefix);
        
        $result = $this->process_version_report($dir . $files1[0],$tblacc, $conversion_col['conversion_col']);
        //echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
    }
    
    public function fetch_video_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_video';
        $dir    = 'files/' . $prefix . '/campaign_video/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        
        
        $result = $this->process_video_report($dir . $files1[0], $tblacc);
        
        //echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
        
    }
    
    public function fetch_unique_report($prefix=''){
        
        $tblacc = $prefix . '_campaign_unique';
        $dir    = 'files/' . $prefix . '/campaign_unique/';
        
        $files1 = array_diff(scandir($dir,1), array('..', '.'));
        
        $result = $this->process_unique_report($dir . $files1[0], $tblacc);
        
        //echo json_encode($result, JSON_PRETTY_PRINT);
        return $result;
        
    }
    
    
        
    public function process_custom_report($filepath, $accname, $conv_col='0')
	{
		
            $file = $filepath;
            $i = 0;
            $handle = fopen($file, "r");
            
            while (($row = fgetcsv($handle))) {
                $i++;
                if ($i == 1) {
                    $totalCol = sizeOf($row);
                }
                if ($i == 1) continue;
                
              $data = [];
              $findata = $data;
              for ($conv = 0; $conv <= ($totalCol-1); $conv++){
                        $dt = [
                            'custom_col_' . ($conv+1) => $row[$conv],
                        ];
                        
                        $findata = array_merge($findata, $dt);
                        unset($dt);
              }  
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
            }
            
            fclose($handle);
            unlink($file);
            return $insert;
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
                    for ($j = 35; $j <= ($totalCol-1); $j++) {
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
                    'customField1' => $row[19],
                    'customField2' => $row[20],
                    'customField3' => $row[21],
                    'customField4' => $row[22],
                    'customField5' => $row[23],
                    'impression' => $row[24],
                    'clicks' => $row[25],
                    'totalConvertion' => $row[26],
                    'postClickConversion' => $row[27],
                    'postImpresionConversion' => $row[28],
                    'conversionRevenue' => $row[29],
                    'totalMediaCost' => numnegative($row[30]),
                    'ecpc' => $row[31],
                    'ecpa' => $row[32],
                    'ecpm' => $row[33],
                    'totalProfit' => numnegative($row[34]),
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
                            'conversion_value_' . ($conv+1) => numnegative($row[35 + $conv]),
                            
                        ];
                        
                        $findata = array_merge($findata, $dt);
                        unset($dt);
              }
                
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
            }
            
            fclose($handle);
            unlink($file);
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
                    for ($j = 31; $j <= ($totalCol-1); $j++) {
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
                
                if ($row[31] <> 'Undefined') {
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
                    'customField1' => $row[20],
                    'customField2' => $row[21],
                    'customField3' => $row[22],
                    'customField4' => $row[23],
                    'customField5' => $row[24],
                    'impression' => $row[25],
                    'clicks' => $row[26],
                    'totalConversion' => $row[27],
                    'conversionRevenue' => $row[28],
                    'postClickConversion' => $row[29],
                    'postImpresionConversion' => $row[30],
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
                            'conversion_value_' . ($conv+1) => numnegative($row[31 + $conv]),
                            
                        ];
                        
                        $findata = array_merge($findata, $dt);
                        unset($dt);
              }
                
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
                
                
            }

            fclose($handle);
            unlink($file);
            return $insert;
	}
   
    public function process_video_report($filepath, $accname)
	{
		
            $file = $filepath;

            $i = 0;            
            $handle = fopen($file, "r");
                
            while (($row = fgetcsv($handle))) {
                $i++;
                if ($i == 1) {
                    $totalCol = sizeOf($row);
                    for ($j = 42; $j <= ($totalCol-1); $j++) {
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
                    'customField1' => $row[19],
                    'customField2' => $row[20],
                    'customField3' => $row[21],
                    'customField4' => $row[22],
                    'customField5' => $row[23],
                    'impression' => $row[24],
                    'clicks' => $row[25],
                    'totalConversion' => $row[26],
                    'postClickConversion' => $row[27],
                    'postImpresionConversion' => $row[28],
                    'conversionRevenue' => $row[29],
                    'totalMediaCost' => $row[30],
                    'ecpc' => $row[31],
                    'ecpa' => $row[32],
                    'ecpm' => $row[33],
                    'totalProfit' => $row[34],
                    'adAverageDuration' => $row[35],
                    'videoStart	' => $row[36],
                    'videoPlayed25' => $row[37],
                    'videoPlayed50' => $row[38],
                    'videoPlayed75' => $row[39],
                    'videoPlayedFull' => $row[40],
                    'videoAverageDuration' => $row[41],
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
                        'conversion_value_' . ($conv+1) => numnegative($row[42 + $conv]),
                        
                    ];
                    
                    $findata = array_merge($findata, $dt);
                    unset($dt);
              }
                
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
                
            }

            fclose($handle);
            unlink($file);
            return $insert;
	}
    
    public function process_unique_report($filepath, $accname)
        {
		
            $file = $filepath;

            $i = 0;
            $handle = fopen($file, "r");
                
            while (($row = fgetcsv($handle))) {
                $i++;
                if ($i == 1) {
                    $totalCol = sizeOf($row);
                    for ($j = 43; $j <= ($totalCol-1); $j++) {
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
                    'customField1' => $row[19],
                    'customField2' => $row[20],
                    'customField3' => $row[21],
                    'customField4' => $row[22],
                    'customField5' => $row[23],
                    'impression' => $row[24],
                    'clicks' => $row[25],
                    'totalConversion' => $row[26],
                    'postClickConversion' => $row[27],
                    'postImpresionConversion' => $row[28],
                    'conversionRevenue' => $row[29],
                    'totalMediaCost' => $row[30],
                    'uniqueImpression' => $row[31],
                    'uniqueClicks' => $row[32],
                    'averageFrequensy' => $row[33],
                    'uniqueVideoStartd' => $row[34],
                    'uniqueInteraction' => $row[35],
                    'adAverageDuration' => $row[36],
                    'videoStart' => $row[37],
                    'videoPlayed25' => $row[38],
                    'videoPlayed50' => $row[39],
                    'videoPlayed75' => $row[40],
                    'videoPlayedFull' => $row[41],
                    'videoAverageDuration' => $row[42],
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
                            'conversion_value_' . ($conv+1) => numnegative($row[43 + $conv]),
                            
                        ];
                        
                        $findata = array_merge($findata, $dt);
                        unset($dt);
              }
                
              $insert = $this->Adv_Model->insertCSV($accname, $findata);
            }
            
            fclose($handle);
            unlink($file);
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