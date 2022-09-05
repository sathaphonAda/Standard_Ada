<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
    <link rel="stylesheet" href="<?php echo base_url('application\modules\attendance\assets\vendor\bootstrap-datepicker\bootstrap-datepicker-master\dist\css\bootstrap-datepicker.css'); ?>" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css"  rel="stylesheet" />

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">User Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("register/Register_controller/index"); ?>">RegisterFormAPI</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Master
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Holiday</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    if ($tBody == true) {
        $this->load->view($tBody);
    }
    ?>
    <div class="modal xWModalDelete"  tabindex="-1" role="dialog">
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
                    <button type="button" class="btn btn-danger">ตกลง</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกลเิก</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="<?php echo base_url(); ?>application\modules\attendance\assets\vendor\bootstrap-datepicker\bootstrap-datepicker-master\dist\js\bootstrap-datepicker.js"></script>

    <script>
          $(document).ready(function() {
                $('.xCNDatepicker').datepicker({
                    format: "yyyy-mm-dd",
                    language: "th-th",
                    autoclose: true,
                    todayHighlight: true
                });
            });
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                language: "th-th",
                autoclose: true,
                todayHighlight: true
            });
        });
        $("#ofmSearchMasterHoliday").submit(function(event) {
            event.preventDefault();
        });
        new gridjs.Grid({
            columns: [
                        {name: "วันที่", width: '20%'}, 
                        {name: "ชื่อวันหยุด TH", width: '25%'}, 
                        {name: "ชื่อวันหยุด EN", width: '25%'}, 
                        {name: "จัดการ", width: '15%'}, 
                    ] ,
            pagination: {
                limit: 10,
                server: {
                    url: (prev, page, limit,oetHolidayDate) => `${prev}?limit=${limit}&offset=${page * limit}`
                }
            },
            server: {
                url: '<?php echo base_url('attendance/Holiday_controller/FCxCHLDDataListview'); ?>',
                then: data => data.rows.map(holidays =>[
                    holidays.FDHidDate,
                    holidays.FTHidNameth, 
                    holidays.FTHidNameen ,
                    gridjs.html(`<a href="<?php echo base_url('masHLDPageEdit/'); ?>${holidays.FCHidId}" class="btn btn-sm btn-warning">แก้ไข</a> &nbsp;&nbsp;<a href="javascript:void(0);" class="btn btn-sm btn-danger">ลบ</a>`)
                ]),
            }
        }).render(document.getElementById("wrapper"));
      

        function deleteData(id) {
            $('.xWModalDelete .modal-footer .btn-danger').attr('ohdHolidayId',id)
            $('.xWModalDelete').modal('show');
        }

        $('.xWModalDelete .modal-footer .btn-danger').click(function(){
          
            $.ajaxSetup({ async: true });
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('masHLDEventDelete'); ?>',
                dataType: 'json',
                data: {  'ohdHolidayId': $(this).attr('ohdHolidayId') },
                success: function(response) {
                    if(response.msg ==='success'){
                        $('.xWModalDelete').modal('hide');
                        location.reload();
                    }
                }
            });
        });
    </script>
  
</body>

</html>