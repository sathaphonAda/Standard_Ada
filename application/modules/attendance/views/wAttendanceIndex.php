<script type="text/template" id="template_view">
     <tr>
        <td class="text-center">{{nNo}}</td>
        <td>
            {{tAttUserName}}
            <input type="hidden" id="ohdAttId_{{nUsrId}}" value="{{tAttId}}">
            <input type="hidden" id="ohdAttScdDateIn_{{nUsrId}}" value="{{tAttScdDateIn}}">
            <input type="hidden" id="ohdAttScdDateOut_{{nUsrId}}" value="{{tAttScdDateOut}}">
            <input type="hidden" id="ohdAttStatus_{{nUsrId}}" value="{{tAttStatus}}">
        </td>
        <td>{{tAttUserPos}}</td>
        <td id="otdAttStatusText_{{nUsrId}}">{{tAttStatusText}}</td>
        <td>
            <input type="text" class="form-control form-control-sm" name="oetAttDateIn[{{nUsrId}}]" id="oetAttDateIn_{{nUsrId}}" value="{{tAttDateIn}}" onblur="JSxATDRegEx(this.value,this.id);JSxATDTimeIn({{nUsrId}},{{tAttScdDateType}},this.value)">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="oetAttDateOut[{{nUsrId}}]" id="oetAttDateOut_{{nUsrId}}" value="{{tAttDateOut}}" onblur="JSxATDTimeOut({{nUsrId}},{{tAttScdDateType}},this.value)">
        </td>
        <td class="center">
            <button type="button" class="btn btn-sm btn-info" name="obtAtdSave" id="obtAtdSave" onclick="JSxATDDataSave({{nUsrId}})">บันทึก</button>
        </td>
    </tr>
</script>

<div class="container mt-4">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body mt-2 pt-1">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="xWDatepicker" data-date="<?php echo $dAttDate?>"></div>
                        <input type="hidden" id="ohdAttDate" value="<?php echo $dAttDate?>">
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="oetUserName">ชื่อ - นามสกุล</label>
                            <input type="text" id="oetUserName" name="oetUserName" class="form-control form-control-sm" value="">
                        </div>
                        <div class="form-group">
                            <label for="ocmTeamId">ทีม</label>
                            <select name="ocmTeamId" id="ocmTeamId" class="form-control form-control-sm">
                                <option value="">กรุณาเลือก</option>
                                <?php 
                                    if(is_array($aDataTeam) && count($aDataTeam) > 0){
                                        foreach($aDataTeam as $k => $v){
                                            echo '<option value="'.$v['FNTemId'].'">'.$v['FTTemName'].'</option>';
                                        }    
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ocmPostionId">ตำแหน่ง</label>
                            <select name="ocmPostionId" id="ocmPostionId" class="form-control form-control-sm">
                                <option value="">กรุณาเลือก</option>
                                <?php 
                                    if(is_array($aDataPosition) && count($aDataPosition) > 0){
                                        foreach($aDataPosition as $k => $v){
                                            echo '<option value="'.$v['FNPosId'].'">'.$v['FTPosName'].'</option>';
                                        }    
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4 text-center">
                        <button type="button" class="btn btn-sm btn-info" name="obtGetData" id="obtGetData" >ค้นหา</button>                     
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered" id="otbAttList">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>ตำแหน่ง</th>
                                    <th>สถานะ</th>
                                    <th>เวลาเข้า</th>
                                    <th>เวลาออก</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal xWModalConfirmAtd"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แจ้งเตือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการบันทึกข้อมูลใช่หรือไม่</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="obtConfirmAtd">ตกลง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/attendance/assets/attendance/jAttendance.js'); ?>"></script>