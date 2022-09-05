
<style>
    .xCNAlertRequire{
        color: red !important;
    }
    .xCNInputRequire{
        border-color: red;
    }
    .xWProjectName{
        color: black;
        font-weight: bold;
        font-size: 18px;
    }
</style>
<div class="container mt-4">
    <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body mt-2 pt-1">
                    <form class="form-horizontal" name="ofmSchedule" id="ofmSchedule" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="odpStartDate">วันที่เริ่มต้น</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="odpStartDate" id="odpStartDate" value="" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="odpEndDate">วันที่สิ้นสุด</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" name="odpEndDate" id="odpEndDate" value="" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered" id="otbUserList">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">ชื่อ - นามสกุล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($oUser)){
                                            $i =0 ;
                                            foreach($oUser as $nKey => $tVal){
                                                echo '<tr>
                                                        <td class="text-center">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="orbUseId'.$tVal['FNUsrId'].'" name="orbUseId" value="'.$tVal['FNUsrId'].'">
                                                            </div>
                                                        </td>
                                                        <td>'.$tVal['FTUsrName'].'</td>
                                                    </tr>';          
                                            }  
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="button" name="obtSchedule" id="obtSchedule" class="btn btn-primary">นำไปใช้</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal xWModalSchedule"  tabindex="-1" role="dialog">
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
                <button type="button" class="btn btn-primary" id="obtConfirmSchedule">ตกลง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกลเิก</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#obtSchedule').click(function(){
        var tRequire = "";
        $('#ofmSchedule input,select').each(function(){
            if ($(this).hasClass("xCNInputRequire") ){
                $(this).removeClass("xCNInputRequire")
            }
        });
        $('.xCNAlertRequire').remove()
        var dStartDate = new Date ($('#odpStartDate').val());
        var dEndDate = new Date ($('#odpEndDate').val());
        if($('#odpStartDate').val() == ""){
            $('label[for="odpStartDate"] + .input-group').after('<p class="xCNAlertRequire">กรุณาเลือกวันที่เริ่มต้น</p>');
            tRequire = "Y"
        }
        if($('#odpEndDate').val()  == ""){
            $('label[for="odpEndDate"] + .input-group').after('<p class="xCNAlertRequire">กรุณาเลือกวันที่สิ้นสุด</p>');
            tRequire = "Y"
        }
        if(tRequire === "Y"){
            return false
        }
        if(dStartDate > dEndDate){
            $('label[for="odpEndDate"] + .input-group').after('<p class="xCNAlertRequire">วันที่สิ้นสุดต้องมากว่าวันที่เริ่มต้น</p>');
            return false
        }
        if($('input:radio[name=orbUseId]:checked').length == 0 ){
            $('#otbUserList').after('<p class="xCNAlertRequire">กรุณาเลือกรายชื่อย่างน้อย 1 รายการ</p>');
            return false
        }
      
        $('.xWModalSchedule').modal('show');
    });

    $('.xWModalSchedule #obtConfirmSchedule').click(function(){
        $.ajaxSetup({ async: true });
        $.ajax({
            type: "POST",
            url: '<?php echo base_url('attSCDEventAdd'); ?>',
            dataType: 'json',
            data: {
                    'nUsrId'        : $('input:radio[name=orbUseId]:checked').val(),
                    'dStartDate'    : $('#odpStartDate').val(),
                    'dEndtDate'     : $('#odpEndDate').val(),
                  },
            success: function(oResponse) {
                if(oResponse.nStatus == 200){
                    $('.xWModalSchedule').modal('hide');
                }
            }
        });
    });
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "th-th",
            autoclose: true,
            todayHighlight: true
        });
        $("#obtSchedule").click(function(){
            
        });          
    });
</script>