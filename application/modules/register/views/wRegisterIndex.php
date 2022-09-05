<div class="container mt-4">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body mt-2 pt-1">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered" id="otbUserList">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>คำนำหน้า</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>อีเมล์</th>
                                    <th>ทีม</th>
                                    <th>ตำแหน่ง</th>
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
<div class="modal xWModalDelete2"  tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แจ้งเตือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>คุณต้องการลบข้อมูลใช่หรือไม่</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="obtConfirmDelete">ตกลง</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/register/assets/register/jRegister.js'); ?>"></script>

