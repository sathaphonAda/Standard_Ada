<div class="container mt-4">
    <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body mt-2 pt-1">
                    <div class="p-0">
                        <form class="form-horizontal" name="ofmMasterHoliday" id="ofmMasterHoliday" action="<?php echo base_url('attHLDEventAdd'); ?>" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="oetHolidayDate">วันที่</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm xCNDatepicker" name="odpHolidayDate" id="odpHolidayDate" value="" required>
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="oetHolidayNameTh">ชื่อวันหยุด TH</label>
                                        <input type="text" class="form-control form-control-sm" name="oetHolidayNameTh" id="oetHolidayNameTh" value="" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="oetHolidayNameEn">ชื่อวันหยุด EN</label>
                                        <input type="text" class="form-control form-control-sm" name="oetHolidayNameEn" id="oetHolidayNameEn" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" name="osmMasteholiday" id="osmMasteholiday" class="btn btn-primary">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>