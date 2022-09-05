<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Attendance_controller extends MX_Controller {

    public function __construct() {
        parent::__construct (); 
        $this->load->helper('testpro_helper');
       
    }
    public function index(){
        $tSqlTeam = "SELECT * FROM TATMTeam";
        $oQueryTeam = $this->db->query($tSqlTeam);

        $tSqlPosition = "SELECT * FROM TATMPosition";
        $oPosition = $this->db->query($tSqlPosition);

        $aData = array();
        $aData['tBody']             = "wAttendanceIndex";
        $aData['dAttDate']          = date('d/m/Y');
        $aData['aDataTeam']         = $oQueryTeam->result_array();
        $aData['aDataPosition']     = $oPosition->result_array(); 
        $this->load->view('common/wTemplate',$aData);
    }
    public function FSaCATDDataList(){
        
        $aCon = array();
        $tCon = "";
        $aCon[] = tDateToDB($this->input->post('dAttDate'));

        $tUserName  = $this->input->post('tUserName');
        $nTeamId    = $this->input->post('nTeamId');
        $nPostionId = $this->input->post('nPostionId');
        if($tUserName!=""){
            $tCon   .= " and concat(b.FTUsrTitleName,'',b.FTUsrFristName,' ',b.FTUsrLastName) like ?";
            $aCon[] = "%".$tUserName."%";
        }
        if($nTeamId!=""){
            $tCon   .= " and b.FNTemId = ?";
            $aCon[] = $nTeamId;
        }
        if($nPostionId!=""){
            $tCon   .= " and b.FNPosId = ?";
            $aCon[] = $nPostionId;
        }

        $tSql = "select 
                    a.FDScdDateType,
                    a.FDScdDate,
                    a.FDScdDateIn,
                    a.FDScdDatelunchIn,
                    a.FDScdDatelunchOut,
                    a.FDScdDateOut,
                    b.FNUsrId,
                    concat(b.FTUsrTitleName,'',b.FTUsrFristName,' ',b.FTUsrLastName) as FTUsrName,
                    b.FNPosId,
                    c.FTPosName
                from TATTSchedule a
                left join TATTUser b on a.FNUsrId = b.FNUsrId
                left join TATMPosition c on b.FNPosId = c.FNPosId
                where 1=1 and a.FDScdDate = ?";
        $oQuery = $this->db->query($tSql.$tCon,$aCon);
        $oResult = $oQuery->result_array();

        $aAttStatus     = array('0' => 'รอคัดกรอง','1' => 'ปกติ','2' => 'สาย','7' => 'วันหยุด');
        $aResultList    = array();
        if(count($oResult) > 0){

            foreach($oResult as $nKey => $oVal){

                $aConAtt = array();
                $aConAtt[] = $oVal['FNUsrId'];
                $aConAtt[] = $oVal['FDScdDate'];
                $tSqlAtt = "select * from TATTAttendance where FNUsrId = ? and FDAttDate = ?";
                $oQueryAtt = $this->db->query($tSqlAtt,$aConAtt);
                $oResultAtt = $oQueryAtt->row_array();
                $oNumRowsAtt = $oQueryAtt->num_rows();

                $aItems = array();
                $aItems['tAttId']           = "";
                $aItems['nUsrId']           = $oVal['FNUsrId'];
                $aItems['tAttUserName']     =  $oVal['FTUsrName'];
                $aItems['tAttUserPos']      =  $oVal['FTPosName'];
                $aItems['tAttStatus']       = 0;
                $aItems['tAttStatusText']   = $aAttStatus[0];
                $aItems['tAttScdDateType']  = $oVal['FDScdDateType'];
                $aItems['tAttScdDateIn']    = date('Y-m-d H:i',strtotime($oVal['FDScdDateIn']));
                $aItems['tAttScdDateOut']   = date('Y-m-d H:i',strtotime($oVal['FDScdDateOut']));
                $aItems['tAttDateIn']       =  "";
                $aItems['tAttDateOut']      =  "";

                if($oNumRowsAtt > 0){
                    $aItems['tAttId']           = $oResultAtt['FNAttId'];
                    $aItems['tAttStatus']       = $oResultAtt['FDAttStatus'];
                    $aItems['tAttStatusText']   = $aAttStatus[$oResultAtt['FDAttStatus']];
                    $aItems['tAttDateIn']       = date('H:i',strtotime($oResultAtt['FDAttDateIn']));
                    $aItems['tAttDateOut']      = date('H:i',strtotime($oResultAtt['FDAttDateOut']));
                }

                $aResultList['oItems'][] = $aItems;
            }
            $aResultList['nStatus'] = 200;
            $aResultList['tDescription']= "seccess";
        }else{
            $aResultList['nStatus']= 400;
            $aResultList['tDescription']= "no";
        }
        
        echo json_encode($aResultList);
        exit;
    }
    public function FSaCATDEventSave(){
     
        $nUsrId = $this->input->post('nUsrId');
        $nAttId = $this->input->post('nAttId');
        $dAttDate = tDateToDB($this->input->post('dAttDate'));
        $nAttStatus = $this->input->post('nAttStatus');
        $dAttDateIn = $this->input->post('dAttDateIn');
        $dAttDateOut = $this->input->post('dAttDateOut');

        $aData = array();
        $aData['FNUsrId']       = $nUsrId;
        $aData['FDAttDate']     = $dAttDate;
        $aData['FDAttDateIn']   = date('Y-m-d H:i',strtotime($dAttDate." ".$dAttDateIn));
        $aData['FDAttDateOut']  = date('Y-m-d H:i',strtotime($dAttDate." ".$dAttDateOut));
        $aData['FDAttStatus']   =  $nAttStatus;
        
        if($nAttId != ""){
            $this->db->where("FNAttId =",$nAttId);
            $this->db->update("TATTAttendance",$aData);
        }else{
            $this->db->insert("TATTAttendance",$aData);
        }

        echo json_encode(array('nStatus'=>200));
        exit;
    }

}
?>