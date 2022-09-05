<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Schedule_controller extends MX_Controller {

    public function __construct() {
        parent::__construct (); 
       
    }
    public function index(){

        $qQuery = $this->db->query("select FNUsrId,concat(FTUsrTitleName,FTUsrFristName,' ',FTUsrLastName) as FTUsrName from TATTUser");
        $qResult =  $qQuery->result_array(); 

        $aData = array();
        $aData['oUser']     = $qResult; 
        $aData['tBody']     = "wScheduleIndex"; 
        $this->load->view('common/wTemplate',$aData);
    }

    public function FSaCSCDEventAdd(){
        $oResponsedata = new stdClass;
        try{
            $aCon = array();
            $aCon[] = $this->input->post('dStartDate');
            $aCon[] = $this->input->post('dEndtDate');
            $aCon[] = $this->input->post('nUsrId');

            $this->db->query("{CALL GetTimeSchedule(?,?,?)}",$aCon);

            $oResponsedata->nStatus = 200;
            $oResponsedata->tDescription = "seccess";
            
        }catch(Exception $e) {
            $oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $e->getMessage();
        }

        echo json_encode($oResponsedata);
        exit;
    }

}
?>