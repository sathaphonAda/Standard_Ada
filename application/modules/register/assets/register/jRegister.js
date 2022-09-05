$( document ).ready(function() {
    JSxREGUserList()
});
function JSxREGUserList(){
    $.ajaxSetup({ async: true });
    $.ajax({
        type: "GET",
        url: 'http://localhost/Standard_Ada/regUSREventList',
        dataType: 'json',
        data: {},
        success: function(oResponse) {
            var tHTML = "";
            if(oResponse.nStatus ==200){
                var oItemsList = oResponse.oItems;
                var rows = 0; 
                for (let i = 0; i < oItemsList.length; i++) {
                  
                    var FNUsrId = oItemsList[i].FNUsrId;
                    var FTUsrTitleName = oItemsList[i].FTUsrTitleName;
                    var FTUsrFristName = oItemsList[i].FTUsrFristName;
                    var FTUsrLastName = oItemsList[i].FTUsrLastName;
                    var FTUsrEmail = oItemsList[i].FTUsrEmail;
                    var FTTemName = oItemsList[i].FTTemName;
                    var FTPosName = oItemsList[i].FTPosName;

                    FNUsrId = typeof(FNUsrId) != 'undefined' && FNUsrId != null?FNUsrId:''
                    FTUsrTitleName = typeof(FTUsrTitleName) != 'undefined' && FTUsrTitleName != null?FTUsrTitleName:''
                    FTUsrFristName = typeof(FTUsrFristName) != 'undefined' && FTUsrFristName != null?FTUsrFristName:''
                    FTUsrLastName = typeof(FTUsrLastName) != 'undefined' && FTUsrLastName != null?FTUsrLastName:''
                    FTUsrEmail = typeof(FTUsrEmail) != 'undefined' && FTUsrEmail != null?FTUsrEmail:''
                    FTTemName = typeof(FTTemName) != 'undefined' && FTTemName != null?FTTemName:''
                    FTPosName = typeof(FTPosName) != 'undefined' && FTPosName != null?FTPosName:''

                    tHTML += "<tr>"+
                                "<td class=\"text-center\">"+(++rows)+"</td>"+
                                "<td>"+FTUsrTitleName+"</td>"+
                                "<td>"+FTUsrFristName+' '+FTUsrLastName+"</td>"+
                                "<td>"+FTUsrEmail+"</td>"+
                                "<td>"+FTTemName+"</td>"+
                                "<td>"+FTPosName+"</td>"+
                                "<td><a href=\"http://localhost/Standard_Ada/regUSRPageEdit/"+FNUsrId+"\">แก้ไข&nbsp;&nbsp;</a>"+
                                "<a href=\"javascript:void(0)\" onclick=\"JSxREGUserEventDelete("+FNUsrId+")\">ลบ</a></td>"+
                            "</tr>";
                }
            }
            $("#otbUserList>tbody").append(tHTML);
        }
    });
}
function JSxREGUserEventDelete(nId){
    $('.xWModalDelete2 #obtConfirmDelete').attr('user-id',nId)
    $('.xWModalDelete2').modal('show')
}
$('.xWModalDelete2 #obtConfirmDelete').click(function(){
    var nUserId = $(this).attr('user-id')
    $.ajaxSetup({ async: true });
    $.ajax({
        type: "POST",
        url: baseURL+'regUSREventDelete',
        dataType: 'json',
        data: { 'nUserId' :nUserId },
        success: function(oResponse) {
            if(oResponse.nStatus == 200){
                $('.xWModalDelete2').modal('hide')
                location.reload();
            }
        }
    });
});