<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class User_controller extends MX_Controller {

    public function __construct() {
        parent::__construct (); 
    }

    public function register() {

        $oResponsedata = new stdClass;
        try{
            if($this->input->server('REQUEST_METHOD') == 'POST') {
                
                $oJson = json_decode(file_get_contents('php://input'));
                $aData = array(
                                'FTUsrTitleName'    =>  $oJson->tTitleName,
                                'FTUsrFristName'    =>  $oJson->tFristName,
                                'FTUsrLastName'     =>  $oJson->tLastName,
                                'FTUsrEmail'        =>  $oJson->tEmail,
                                'FNTemId'           =>  $oJson->nTeamId,
                                'FNPosId'           =>  $oJson->nPostionId,
                            );
                $this->db->insert("TATTUser",$aData);

                $oResponsedata->nStatus = 200;
				$oResponsedata->tMessage = "seccess";
                
            }else{
                $oResponsedata->nStatus = 405;
				$oResponsedata->tDescription = 'Method Not Allowed';
            }
        }catch(Exception $ex){
			$oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
		}
        echo json_encode($oResponsedata);
    }
    public function register_update($nId){

        $oResponsedata = new stdClass;
        try{
            if($this->input->server('REQUEST_METHOD') == 'PUT') {
                $oJson = json_decode(file_get_contents('php://input'));

                $aData = array(
                                'FTUsrTitleName'    =>  $oJson->tTitleName,
                                'FTUsrFristName'    =>  $oJson->tFristName,
                                'FTUsrLastName'     =>  $oJson->tLastName,
                                'FTUsrEmail'        =>  $oJson->tEmail,
                                'FNTemId'           =>  $oJson->nTeamId,
                                'FNPosId'           =>  $oJson->nPostionId,
                            );
                $this->db->where("FNUsrId = ",$nId);
                $this->db->update("TATTUser",$aData);

                $oResponsedata->nStatus = 200;
				$oResponsedata->tMessage = "seccess";
            }else{
                $oResponsedata->nStatus = 405;
				$oResponsedata->tDescription = 'Method Not Allowed';
            }
        }catch(Exception $ex){
			$oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
		}
        echo json_encode($oResponsedata);

    }
    public function register_delete($nId){

        $oResponsedata = new stdClass;
        try{
            if($this->input->server('REQUEST_METHOD') == 'DELETE') {
                $oJson = json_decode(file_get_contents('php://input'));

                $this->db->where("FNUsrId = ",$nId);
                $this->db->delete("TATTUser");

                $oResponsedata->nStatus = 200;
				$oResponsedata->tDescription = "seccess";
            }else{
                $oResponsedata->nStatus = 405;
				$oResponsedata->tDescription = 'Method Not Allowed';
            }
        }catch(Exception $ex){
			$oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
		}
        echo json_encode($oResponsedata);
    }
    public function register_list(){
        $oResponsedata = new stdClass;
        try{
            if($this->input->server('REQUEST_METHOD') == 'GET') {
                $oJson = json_decode(file_get_contents('php://input'));
                $nId = $this->input->get('FNUsrId');
                $tCondition = "";
                $aCondition = array();
                if($nId != ""){
                    $tCondition = " AND a.FNUsrId = ?";
                    $aCondition[] = $nId;
                }
                $tSql = "SELECT 
                            a.FNUsrId,
                            a.FTUsrCode,
                            a.FTUsrTitleName,
                            a.FTUsrFristName,
                            a.FTUsrLastName,
                            a.FTUsrEmail,
                            a.FNTemId,
                            a.FNPosId,
                            b.FTTemName,
                            c.FTPosName
                        FROM TATTUser a
                        LEFT JOIN TATMTeam b on a.FNTemId = b.FNTemId
                        LEFT JOIN TATMPosition c on a.FNPosId = c.FNPosId
                        WHERE 1=1";
                $oQuery = $this->db->query($tSql.$tCondition,$aCondition);
                $oResult = $oQuery->result_array();
                if(!empty($oResult)){
                    $oResponsedata->nStatus = 200;
                    $oResponsedata->oItems = $oResult;
                    $oResponsedata->tMessage = "seccess";
                }else{
                    $oResponsedata->nStatus = 400;
                    $oResponsedata->tMessage = "no data";
                }
             
            }else{
                $oResponsedata->nStatus = 405;
				$oResponsedata->tDescription = 'Method Not Allowed';
            }
        }catch(Exception $ex){
			$oResponsedata->nStatus = 500;
			$oResponsedata->tDescription = $ex->getMessage();
		}
        echo json_encode($oResponsedata);

    }
}

