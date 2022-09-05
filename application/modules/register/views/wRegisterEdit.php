
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
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-12 text-center p-4">
                                <p class="xWProjectName">Standard_Ada Register From API</p>
                                <p>
                                    <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url('register/Languageswitcher_controller/switchLang/TH');?>'">TH</a>&nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url('register/Languageswitcher_controller/switchLang/EN');?>'">EN</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0"> 
                        <div class="p-0">
                            <form class="form-horizontal" name="ofmRegister" id="ofmRegister" method="post">
                                <div class="form-group">
                                    <label for="ocmTitleName"><?php echo language('register/register','titlename');?> </label>
                                    <select name="ocmTitleName" id="ocmTitleName" class="form-control">
                                        <option value="">กรุณาเลือก</option>
                                        <option value="นาย" <?php echo ('นาย' == $aData['FTUsrTitleName'])?'selected':''; ?>>นาย</option>
                                        <option value="นางสาว" <?php echo ('นางสาว' == $aData['FTUsrTitleName'])?'selected':''; ?>>นางสาว</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="oetFristName"><?php echo language('register/register','fristname');?></label>
                                    <input type="text" class="form-control" name="oetFristName" id="oetFristName" value="<?php echo $aData['FTUsrFristName']?>">
                                </div>
                                <div class="form-group">
                                    <label for="oetLastName"><?php echo language('register/register','lastname');?></label>
                                    <input type="text" class="form-control" name="oetLastName" id="oetLastName" value="<?php echo $aData['FTUsrLastName']?>">
                                </div>
                                <div class="form-group">
                                    <label for="oemEmail"><?php echo language('register/register','email');?></label>
                                    <input type="email" class="form-control" name="oemEmail" id="oemEmail" value="<?php echo $aData['FTUsrEmail'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="ocmTeamId"><?php echo language('register/register','teamcode'); ?></label>
                                    <select name="ocmTeamId" id="ocmTeamId" class="form-control">
                                        <option value="">กรุณาเลือก</option>
                                        <?php 
                                            if(is_array($aDataTeam) && count($aDataTeam) > 0){
                                                foreach($aDataTeam as $k => $v){
                                                    $tSelected = ($v['FNTemId'] == $aData['FNTemId'])?'selected':'';
                                                    echo '<option value="'.$v['FNTemId'].'" '.$tSelected.'>'.$v['FTTemName'].'</option>';
                                                }    
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ocmPostionId"><?php echo language('register/register','positon'); ?></label>
                                    <select name="ocmPostionId" id="ocmPostionId" class="form-control">
                                        <option value="">กรุณาเลือก</option>
                                        <?php 
                                            if(is_array($aDataPosition) && count($aDataPosition) > 0){
                                                foreach($aDataPosition as $k => $v){
                                                    $tSelected = ($v['FNPosId'] == $aData['FNPosId'])?'selected':'';
                                                    echo '<option value="'.$v['FNPosId'].'" '.$tSelected.'>'.$v['FTPosName'].'</option>';
                                                }    
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="ohdUserId" id="ohdUserId" value="<?php echo $aData['FNUsrId'];?>">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit" name="osmRegister" id="osmRegister"><?php echo language('register/register','btnsubmit');?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal xWModalRegister"  tabindex="-1" role="dialog">
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
                <button type="button" class="btn btn-primary" id="obtConfirmRegister">ตกลง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('application/modules/register/assets/register/jRegisterEdit.js'); ?>"></script>


