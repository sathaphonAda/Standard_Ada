<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Register_controller extends MX_Controller {

    public function __construct() {
        parent::__construct (); 
        
    }
	public function index() {

        $tSqlTeam = "SELECT * FROM TATMTeam";
        $oQueryTeam = $this->db->query($tSqlTeam);

        $tSqlPosition = "SELECT * FROM TATMPosition";
        $oPosition = $this->db->query($tSqlPosition);

        $aData = array();
        $aData['tBody']             = "wRegister"; 
        $aData['aDataTeam']         = $oQueryTeam->result_array();
        $aData['aDataPosition']     = $oPosition->result_array(); 
       
        $this->load->view('common/wTemplate',$aData);
    }
    public function FSxCREGPageList() {
        $aData = array();
        $aData['tBody']             = "wRegisterIndex"; 
        $this->load->view('common/wTemplate',$aData);
    }
    public function FSaCREGEventAdd() { 

        $oResponsedata = new stdClass;
        try{
            $aData = array();
            $aData['tTitleName']    = $this->input->post('ocmTitleName');
            $aData['tFristName']    = $this->input->post('oetFristName');
            $aData['tLastName']     = $this->input->post('oetLastName');
            $aData['tEmail']        = $this->input->post('oemEmail');
            $aData['nTeamId']       = $this->input->post('ocmTeamId');
            $aData['nPostionId']    = $this->input->post('ocmPostionId');
                   
            $oData = json_encode($aData);
    
            $tCurl = curl_init();
            curl_setopt($tCurl, CURLOPT_URL, "http://localhost/Standard_Ada/api/register");
            curl_setopt($tCurl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($tCurl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($tCurl, CURLOPT_ENCODING, '');
            curl_setopt($tCurl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($tCurl, CURLOPT_TIMEOUT, 0);
            curl_setopt($tCurl, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($tCurl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($tCurl, CURLOPT_POSTFIELDS, $oData);
            curl_setopt($tCurl, CURLOPT_HTTPHEADER,  array( 'Content-Type: application/json'));
    
            $oResponseCurl = curl_exec($tCurl);

            curl_close($tCurl);
            $aResponseCurl = json_decode($oResponseCurl,true);
          
            if($aResponseCurl['nStatus'] == 200){
                $oResponsedata->nStatus = 200;
                $oResponsedata->tDescription = "seccess";
            }else{
                $oResponsedata->nStatus = 404;
                $oResponsedata->tDescription = "fail";
            }
         
        }catch(Exception $ex){
            $oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
        }
        echo json_encode($oResponsedata);

    }
    public function FSxCREGEventAdd($nId) {

        $tCurl = curl_init();
        curl_setopt($tCurl, CURLOPT_URL, "http://localhost/Standard_Ada/api/register_list?FNUsrId=".$nId);
        curl_setopt($tCurl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($tCurl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($tCurl, CURLOPT_ENCODING, '');
        curl_setopt($tCurl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($tCurl, CURLOPT_TIMEOUT, 0);
        curl_setopt($tCurl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($tCurl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($tCurl, CURLOPT_HTTPHEADER,  array( 'Content-Type: application/json'));

        $oResponseCurl = curl_exec($tCurl);

        curl_close($tCurl);
        $aResponseCurl = json_decode($oResponseCurl,true);

        $aData = array();
       

        $tSqlTeam = "SELECT * FROM TATMTeam";
        $oQueryTeam = $this->db->query($tSqlTeam);

        $tSqlPosition = "SELECT * FROM TATMPosition";
        $oPosition = $this->db->query($tSqlPosition);
        $aData['aData']             = array(); 
        if($aResponseCurl['nStatus'] === 200){
            $aData['aData']         = $aResponseCurl['oItems'][0];
            $aData['aDataTeam']     = $oQueryTeam->result_array();
            $aData['aDataPosition'] = $oPosition->result_array(); 
           
        }else{
            redirect('register/Register_controller/list');
        }

        $aData['tBody']             = "wRegisterEdit"; 
        $this->load->view('common/wTemplate',$aData);
    }
    public function FSaCREGEventList() { 

        $oResponsedata = new stdClass;
        try{
           
            $tCurl = curl_init();
            curl_setopt($tCurl, CURLOPT_URL, "http://localhost/Standard_Ada/api/register_list");
            curl_setopt($tCurl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($tCurl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($tCurl, CURLOPT_ENCODING, '');
            curl_setopt($tCurl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($tCurl, CURLOPT_TIMEOUT, 0);
            curl_setopt($tCurl, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($tCurl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($tCurl, CURLOPT_HTTPHEADER,  array( 'Content-Type: application/json'));
    
            $oResponseCurl = curl_exec($tCurl);

            curl_close($tCurl);
            $aResponseCurl = json_decode($oResponseCurl,true);
          
            if($aResponseCurl['nStatus'] == 200){
                $oResponsedata->nStatus = 200;
                $oResponsedata->oItems = $aResponseCurl['oItems'];
                $oResponsedata->tDescription = "seccess";
            }else{
                $oResponsedata->nStatus = 404;
                $oResponsedata->tDescription = "fail";
            }
         
        }catch(Exception $ex){
            $oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
        }
        echo json_encode($oResponsedata);

    }
    public function FSaCREGEventEdit(){
        $oResponsedata = new stdClass;
        try{
            $aData = array();
            $aData['tTitleName']    = $this->input->post('tTitleName');
            $aData['tFristName']    = $this->input->post('tFristName');
            $aData['tLastName']     = $this->input->post('tLastName');
            $aData['tEmail']        = $this->input->post('tEmail');
            $aData['nTeamId']       = $this->input->post('nTeamId');
            $aData['nPostionId']    = $this->input->post('nPosId');
                   
            $oData = json_encode($aData);
    
            $tCurl = curl_init();
            curl_setopt($tCurl, CURLOPT_URL, "http://localhost/Standard_Ada/api/register_update/".$this->input->post('nUserId'));
            curl_setopt($tCurl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($tCurl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($tCurl, CURLOPT_ENCODING, '');
            curl_setopt($tCurl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($tCurl, CURLOPT_TIMEOUT, 0);
            curl_setopt($tCurl, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($tCurl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($tCurl, CURLOPT_POSTFIELDS, $oData);
            curl_setopt($tCurl, CURLOPT_HTTPHEADER,  array( 'Content-Type: application/json'));
    
            $oResponseCurl = curl_exec($tCurl);

            curl_close($tCurl);
            $aResponseCurl = json_decode($oResponseCurl,true);
          
            if($aResponseCurl['nStatus'] == 200){
                $oResponsedata->nStatus = 200;
                $oResponsedata->tDescription = "seccess";
            }else{
                $oResponsedata->nStatus = 404;
                $oResponsedata->tDescription = "fail";
            }
         
        }catch(Exception $ex){
            $oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
        }
        echo json_encode($oResponsedata);
    }
    public function FSaCREGEventDelete(){
        $oResponsedata = new stdClass;
        try{
         
            $tCurl = curl_init();
            curl_setopt($tCurl, CURLOPT_URL, "http://localhost/Standard_Ada/api/register_delete/".$this->input->post('nUserId'));
            curl_setopt($tCurl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($tCurl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($tCurl, CURLOPT_ENCODING, '');
            curl_setopt($tCurl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($tCurl, CURLOPT_TIMEOUT, 0);
            curl_setopt($tCurl, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($tCurl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($tCurl, CURLOPT_HTTPHEADER,  array( 'Content-Type: application/json'));
    
            $oResponseCurl = curl_exec($tCurl);

            curl_close($tCurl);
            $aResponseCurl = json_decode($oResponseCurl,true);
          
            if($aResponseCurl['nStatus'] == 200){
                $oResponsedata->nStatus = 200;
                $oResponsedata->tDescription = "seccess";
            }else{
                $oResponsedata->nStatus = 404;
                $oResponsedata->tDescription = "fail";
            }
         
        }catch(Exception $ex){
            $oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
        }
        echo json_encode($oResponsedata);
    }
}

