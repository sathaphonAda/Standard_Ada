<div class="container mt-4">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="text-right">
            <a href="<?php echo base_url('attHLDPageAdd');?>" class="btn btn-primary">เพิ่มข้อมูล</a>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body mt-2 pt-1">
                    <div class="row">
                        <div class="col-12">
                            <div id="wrapper"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal xWModalDeleteHiliday"  tabindex="-1" role="dialog">
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

<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
<script>
    new gridjs.Grid({
        columns: [
                    {name: "วันที่", width: '20%'}, 
                    {name: "ชื่อวันหยุด TH", width: '25%'}, 
                    {name: "ชื่อวันหยุด EN", width: '25%'}, 
                    {name: "จัดการ", width: '15%'}, 
                ] ,
        search: {
            server: {
            url: (prev, keyword) => `${prev}?search=${keyword}`
            }
        },
        pagination: {
            limit: 10,
            server: {
                url: (prev, page, limit) => `${prev}?limit=${limit}&offset=${page * limit}`
            }
        },
        server: {
            url: baseURL+'attHLDEventList',
            then: data => data.rows.map(holidays =>[
                holidays.FDHidDate,
                holidays.FTHidNameth, 
                holidays.FTHidNameen ,
                gridjs.html(`<a href="<?php echo base_url('attHLDPageEdit/'); ?>${holidays.FCHidId}" class="btn btn-sm btn-warning">แก้ไข</a> &nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="JSxATFHolidayEventDelete(${holidays.FCHidId})">ลบ</a>`)
            ]),
        }
    }).render(document.getElementById("wrapper"));


    function JSxATFHolidayEventDelete(nId){
        $('.xWModalDeleteHiliday #obtConfirmDelete').attr('nHoliday-id',nId);
        $('.xWModalDeleteHiliday').modal('show')
    }
    $('.xWModalDeleteHiliday #obtConfirmDelete').click(function(){
        var nHolidayId = $(this).attr('nHoliday-id');
        $.ajaxSetup({ async: true });
        $.ajax({
            type: "POST",
            url: baseURL+'attHLDEventDelete',
            dataType: 'json',
            data: { 'nHolidayId' :nHolidayId },
            success: function(oResponse) {
                if(oResponse.nStatus == 200){
                    $('.xWModalDeleteHiliday').modal('hide')
                    location.reload();
                }
            }
        });
    })
</script>
