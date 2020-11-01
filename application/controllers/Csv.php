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
//		$logged = $this->session->userdata('userLogged');
//	 	if(!$logged){
//	 		redirect("/login");
//		 }
        $this->load->model('Adv_Model');
	}
	
	public function index()
	{
    
//		if ($this->session->userdata('email') == ""){
//			redirect('/login', 'refresh');
//		}
//			
//            
//        $campaign_id 	 = $this->input->get('campaign_id');
//
//        $startdate = '9/8/2020 12:00:00 am';
//        $enddate = '9/9/2020 12:00:00 am';
//
//        $data = array (
//            'dashboard' => $this->Adv_Model->get_list($startdate, $enddate, $campaign_id),
//            'media_cost' => $this->Adv_Model->get_t_mediacost($startdate, $enddate, $campaign_id),
//            'conversion'    => $this->Adv_Model->get_t_conversion($startdate, $enddate, $campaign_id),
//            'ad_imp'    => $this->Adv_Model->get_ad_imp($startdate, $enddate, $campaign_id),
//
//        );
//
//        $filter = array (
//            'filter' => $this->Adv_Model->get_site_name(),
//            'start'  => $startdate,
//            'end'    => $enddate,
//            'siteselect' => $campaign_id
//        );
//
//        $this->load->view('public/template/header',$filter);
//        $this->load->view('public/dashboard/csv_view',$data);
//        $this->load->view('public/template/footer');
    }
    
    public function fetch_campaign_report(){
        $result = $this->process_campaign_report('http://3.128.254.22/files/Djarum_campaign_report_20201028073323492.csv');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function fetch_version_report(){
        $result = $this->process_version_report('http://localhost:8899/adv_dashboard/assets/csv/Djarum_Version_Report_20201028073411508.csv');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function fetch_video_report(){
        $result = $this->process_video_report('http://localhost:8899/adv_dashboard/assets/csv/UnileverPH_Dove_Video_Report_20201028093849818.csv');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function fetch_unique_report(){
        $result = $this->process_unique_report('http://localhost:8899/adv_dashboard/assets/csv/TemasekSG_unique_report.csv');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function process_campaign_report($filepath)
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
                
                unset($data_conversion);
                unset($dt);
                
                for ($conv = 0; $conv <= (sizeOf($metricName)-1); $conv++){
                        $dt = [
                            $metricName[$conv] => $row[30+$conv]
                        ];
                        $data_conversion[] = $dt;         
                }

                $data = [
                    'day' => $row[0],
                    'accountId' => $row[1],
                    'accountName' => $row[2],
                    'advertiserId' => $row[3],
                    'advertiserName' => $row[4],
                    'campaignId' => $row[5],
                    'campaignName' => $row[6],
                    'campaignStartDate' => $row[7],
                    'campaignEndDate' => $row[8],
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
                    'date' => $splited[0],
                    'site' => $splited[1],
                    'siteSection' => $splited[2],
                    'dimension' => $splited[3],
                    'device' => $splited[4],
                    'adFormat' => $splited[5],
                    'phase' => $splited[6],
                    'targeting' => $splited[7],
                    'audience' => $splited[8],
                    'conversion' => json_encode($data_conversion),
                ];
                
              //echo strstr( $row[29], '(');
              //echo numnegative($row[29]);
              $insert = $this->Adv_Model->insertCSV('campaign_report', $data);
                
            }

            fclose($handle);
            return $insert;
	}
    
    public function process_version_report($filepath)
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
                
                if ($row[17] <> 'Undefined') {
                    $tmpsplited = explode('_', $row[17]);                    
                    for ($g = 0; $g <= (sizeOf($tmpsplited)-1); $g++) {
                        $splited[$g] = $tmpsplited[$g];
                    }
                }
 
                unset($data_conversion);
                unset($dt);
                
                for ($conv = 0; $conv <= (sizeOf($metricName)-1); $conv++){
                        $dt = [
                            $metricName[$conv] => $row[26+$conv]
                        ];
                        $data_conversion[] = $dt;         
                }
     
                $data = [
                    'day' => $row[0],
                    'accountId' => $row[1],
                    'accountName' => $row[2],
                    'advertiserId' => $row[3],
                    'advertiserName' => $row[4],
                    'campaignId' => $row[5],
                    'campaignName' => $row[6],
                    'campaignStartDate' => $row[7],
                    'campaignEndDate' => $row[8],
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
                    'date' => $splited[0],
                    'bannerType' => $splited[1],
                    'size' => $splited[2],
                    'phase' => $splited[3],
                    'audience' => $splited[4],
                    'ab_test1' => $splited[5],
                    'ab_test2' => $splited[6],
                    'conversion' => json_encode($data_conversion),
                ];
                
              $insert = $this->Adv_Model->insertCSV('campaign_version', $data);
                
            }

            fclose($handle);
            return $insert;
	}
   
    public function process_video_report($filepath)
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
 
                $data = [
                    'day' => $row[0],
                    'accountId' => $row[1],
                    'accountName' => $row[2],
                    'advertiserId' => $row[3],
                    'advertiserName' => $row[4],
                    'campaignId' => $row[5],
                    'campaignName' => $row[6],
                    'campaignStartDate' => $row[7],
                    'campaignEndDate' => $row[8],
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
                    'date' => $splited[0],
                    'site' => $splited[1],
                    'siteSection' => $splited[2],
                    'dimension' => $splited[3],
                    'device' => $splited[4],
                    'adFormat' => $splited[5],
                    'phase' => $splited[6],
                    'targeting' => $splited[7],
                    'audience' => $splited[8],
                ];
                
              $insert = $this->Adv_Model->insertCSV('campaign_video', $data);
                
            }

            fclose($handle);
            return $insert;
	}
    
    public function process_unique_report($filepath)
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
 
                $data = [
                    'accountId' => $row[0],
                    'accountName' => $row[1],
                    'advertiserId' => $row[2],
                    'advertiserName' => $row[3],
                    'campaignId' => $row[4],
                    'campaignName' => $row[5],
                    'campaignStartDate' => $row[6],
                    'campaignEndDate' => $row[7],
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
                    'date' => $splited[0],
                    'site' => $splited[1],
                    'siteSection' => $splited[2],
                    'dimension' => $splited[3],
                    'device' => $splited[4],
                    'adFormat' => $splited[5],
                    'phase' => $splited[6],
                    'targeting' => $splited[7],
                    'audience' => $splited[8],
                ];
                
              $insert = $this->Adv_Model->insertCSV('campaign_unique', $data);
                
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