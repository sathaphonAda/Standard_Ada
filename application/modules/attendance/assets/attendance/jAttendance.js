$( document ).ready(function() {
    $('.xWDatepicker').datepicker( );
    $('.xWDatepicker').on('changeDate', function() {
        $('#ohdAttDate').val(
            $('.xWDatepicker').datepicker('getFormattedDate')
        );
        JSxATDDataList();
    });
    JSxATDDataList();
});

$('#obtGetData').click(function(){
    JSxATDDataList();
});

function JSxATDRegEx(val,id) {
    var pattern = new RegExp("^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$");
    if (val.search(pattern)===0) {
        return true;
    }else {
        $('#'+id).val('');
        return false; 
    }
}
function JSxATDDataList(){
    var tTableItem = $("#template_view").html();
    var resultItem ="";
    $("#otbAttList > tbody").empty().append(resultItem);
    $.ajaxSetup({async: true});
    $.ajax({
        type: "POST",
        url: baseURL +"attATDEventList",
        dataType: 'json',
        data: { 
                'dAttDate'      : $('#ohdAttDate').val(),
                'tUserName'     : $('#oetUserName').val(),
                'nTeamId'       : $('#ocmTeamId').val(),
                'nPostionId'    : $('#ocmPostionId').val(),
              },
        success: function (oResponse) {
            var oItemsList = oResponse.oItems;
            if(oResponse.nStatus == 200){
                var j =0;
                for (var i = 0; i < oItemsList.length; i++) {
                    var mapObj = {
                                '{{nNo}}' : ++j,
                                '{{tAttId}}' : oItemsList[i].tAttId,
                                '{{nUsrId}}' : oItemsList[i].nUsrId,
                                '{{tAttUserName}}' : oItemsList[i].tAttUserName,
                                '{{tAttUserPos}}' : oItemsList[i].tAttUserPos,
                                '{{tAttScdDateType}}' : oItemsList[i].tAttScdDateType,
                                '{{tAttStatus}}' : oItemsList[i].tAttStatus,
                                '{{tAttStatusText}}' : oItemsList[i].tAttStatusText,
                                '{{tAttScdDateIn}}' : oItemsList[i].tAttScdDateIn,
                                '{{tAttScdDateOut}}' : oItemsList[i].tAttScdDateOut,
                                '{{tAttDateIn}}' : oItemsList[i].tAttDateIn,
                                '{{tAttDateOut}}' : oItemsList[i].tAttDateOut,
                            };
                    resultItem = tTableItem.replace(/{{nNo}}|{{tAttId}}|{{nUsrId}}|{{tAttUserName}}|{{tAttScdDateType}}|{{tAttUserPos}}|{{tAttUserPos}}|{{tAttStatus}}|{{tAttStatusText}}|{{tAttScdDateIn}}|{{tAttScdDateOut}}|{{tAttDateIn}}|{{tAttDateOut}}/gi, function(matched){ return mapObj[matched]; });
                    $("#otbAttList > tbody").append(resultItem);
                }
            }
        }
    });
}
function JSxATDTimeIn(nUserId,nScdDateType,tAttTime){
    var dScdDateIn = $('#ohdAttScdDateIn_'+nUserId).val();
    var tAttDateIn = $('#oetAttDateIn_'+nUserId).val();
    var tAttDate = $('#ohdAttDate').val();
    if(tAttTime != ''){
        if(nScdDateType == 0){ // วันทำงาน
        var dNewScdDateIn = new Date(dScdDateIn);
        var dNewDateIn  = new Date(tAttDate+" "+tAttTime);
            if(dNewDateIn <= dNewScdDateIn){
                $('#ohdAttStatus_'+nUserId).val(1);
                $('#otdAttStatusText_'+nUserId).html('ปกติ');
            }else{
                
                $('#ohdAttStatus_'+nUserId).val(2);
                $('#otdAttStatusText_'+nUserId).html('สาย');
            }
        }else{
            $('#ohdAttStatus_'+nUserId).val(1);
            $('#otdAttStatusText_'+nUserId).html('ปกติ');
        }
    }
}
function JSxATDTimeOut(nUserId,nScdDateType,tAttTime){
      
}
function JSxATDDataSave(id){
    $('.xWModalConfirmAtd #obtConfirmAtd').attr('user-id',id);
    $('.xWModalConfirmAtd').modal('show');
}
$('.xWModalConfirmAtd #obtConfirmAtd').click(function(){
    var id = $(this).attr('user-id');
    $.ajaxSetup({ async: true });
    $.ajax({
        type: "POST",
        url: baseURL+'attATDEventSve',
        dataType: 'json',
        data: {
                'nUsrId'        : id,
                'nAttId'        : $('#ohdAttId_'+id).val(),
                'dAttDate'      : $('#ohdAttDate').val(),
                'nAttStatus'    : $('#ohdAttStatus_'+id).val(),
                'dAttDateIn'    : $('#oetAttDateIn_'+id).val(),
                'dAttDateOut'   : $('#oetAttDateOut_'+id).val(),
              },
        success: function(oResponse) {
            if(oResponse.nStatus == 200){
                $('.xWModalConfirmAtd').modal('hide');
                JSxATDDataList();
            }
        }
    });
});