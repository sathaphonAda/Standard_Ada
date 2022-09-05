<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Holiday_controller extends MX_Controller {

    public function __construct() {
        parent::__construct (); 
        $this->load->helper('testpro_helper');
    }

	public function index() {
        $aData = array();
        $aData['bHeader']   = true;
        $aData['tBody']     = 'attendance/holiday/wIndex';
        $this->load->view('common/wTemplate',$aData);
    }
    public function FCxCHLDPageAdd() {
        $aData = array();
        $aData['bHeader']   = true;
        $aData['tBody']     = 'attendance/holiday/wPageAdd';
        $this->load->view('common/wTemplate',$aData);
    }
    public function FCxCHLDDataList() {

        $tSql   = "SELECT FCHidId, FDHidDate ,FTHidNameth ,FTHidNameen FROM TATMHoliday ";
        $oQuery = $this->db->query($tSql);
        $oList  = $oQuery->result_array();
        $nRows  = $oQuery->num_rows();
        
        if($nRows > 0){
            $aResult = array(
                'total'   => 9,
                'totalNotFiltered'   => 9,
                'rows'    => $oList,
                
             );
        }else{
            $aResult = array(
                'nAllRow'       => 0,
                'nCurrentPage' => 1,
                'nAllPage'      => 1,
                'rMsg'   => 'faill',
             );
        }
        echo json_encode($aResult);
    }
    public function FCxCHLDEditData($nId) {

        $aCondition = array();
        $aCondition[] = $nId;

        $tSql = "SELECT FCHidId, FDHidDate ,FTHidNameth ,FTHidNameen FROM TATMHoliday WHERE FCHidId = ?";
        $oDataResponse = $this->db->query($tSql,$aCondition)->row_array();

        if(empty($oDataResponse)){
            show_404();
        }

        $aData = array();
        $aData['bHeader']   = true;
        $aData['tBody']     = 'attendance/holiday/wPageEdit';
        $aData['oData']     = $oDataResponse;
        $this->load->view('common/wTemplate',$aData);
    }
    public function FCxCHLDEventAddData() {

        $aDatahiday = array();
        $aDatahiday['FDHidDate']    = $this->input->post('odpHolidayDate');
        $aDatahiday['FTHidNameth']  = $this->input->post('oetHolidayNameTh');
        $aDatahiday['FTHidNameen']  = $this->input->post('oetHolidayNameEn');

        $this->db->insert('TATMHoliday',$aDatahiday);
        
        redirect('attHLDPageList');
    }
    public function FCxCHLDEventEditData () {

        $aDatahiday = array();
        $aDatahiday['FDHidDate']    = $this->input->post('odpHolidayDate');
        $aDatahiday['FTHidNameth']  = $this->input->post('oetHolidayNameTh');
        $aDatahiday['FTHidNameen']  = $this->input->post('oetHolidayNameEn');
        $this->db->where('FCHidId = ',$this->input->post('ohdHolidayId'));
        $this->db->update('TATMHoliday',$aDatahiday);

        redirect('attHLDPageList');
    }
    public function FCxCHLDEventDeleteData(){

        $oResponsedata = new stdClass;
        try{

            $this->db->where('FCHidId = ',$this->input->post('nHolidayId'));
            $this->db->delete('TATMHoliday');

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

