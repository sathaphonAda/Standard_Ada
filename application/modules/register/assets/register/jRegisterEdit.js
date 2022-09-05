$('#osmRegister').click(function(e){
    e.preventDefault();
    $('#obtConfirmRegister').attr('disabled',false);
    var tRequire = "";
   
    $('#ofmRegister input,select').each(function(){
        if ($(this).hasClass("xCNInputRequire") ){
            $(this).removeClass("xCNInputRequire")
        }
    });

    $('.xCNAlertRequire').remove()
    if($('#ocmTitleName').val() == ""){
        $('#ocmTitleName').addClass("xCNInputRequire");
        $('#ocmTitleName').after('<p class="xCNAlertRequire">กรุณาเลือกคำนำหน้า</p>');
        tRequire = "Y";
    }
    if($('#oetFristName').val() == ""){
        $('#oetFristName').addClass("xCNInputRequire");
        $('#oetFristName').after('<p class="xCNAlertRequire">กรุณากรอกชื่อ</p>');
        tRequire = "Y";
    }
    if($('#oetLastName').val() == ""){
        $('#oetLastName').addClass("xCNInputRequire");
        $('#oetLastName').after('<p class="xCNAlertRequire">กรุณากรอกนามสกุล</p>');
        tRequire = "Y";
    } 
    if($('#oemEmail').val() == ""){
        $('#oemEmail').addClass("xCNInputRequire");
        $('#oemEmail').after('<p class="xCNAlertRequire">กรุณากรอกอีเมล</p>');
        tRequire = "Y";
    }
    if($('#ocmTeamId').val() == ""){
        $('#ocmTeamId').addClass("xCNInputRequire");
        $('#ocmTeamId').after('<p class="xCNAlertRequire">กรุณาเลือกทีม</p>');
        tRequire = "Y";
    }
    if($('#ocmPostionId').val() == ""){
        $('#ocmPostionId').addClass("xCNInputRequire");
        $('#ocmPostionId').after('<p class="xCNAlertRequire">กรุณาเลือกตำแหน่ง</p>');
        tRequire = "Y";
    }
    if(tRequire === "Y"){
        return false
    }
    $('.xWModalRegister').modal('show')
});

$('.xWModalRegister #obtConfirmRegister').click(function(){
    $('#obtConfirmRegister').attr('disabled',true);

    $.ajaxSetup({ async: true });
    $.ajax({
        type: "POST",
        url: baseURL+'regUSREventEdit',
        dataType: 'json',
        data: {  
                'nUserId'     : $('#ohdUserId').val(),
                'tTitleName'  : $('#ocmTitleName').val(),
                'tFristName'  : $('#oetFristName').val(),
                'tLastName'   : $('#oetLastName').val(),
                'tEmail'      : $('#oemEmail').val(),
                'nTeamId'     : $('#ocmTeamId').val(),
                'nPosId'      : $('#ocmPostionId').val(),
              },
        success: function(oResponse) {
            if(oResponse.nStatus == 200){
                window.location.href = baseURL+"regUSRPageList";
            }else{

            }
        }
    });
});