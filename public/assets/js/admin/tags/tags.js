
function showAddEditTagsModel() {
    $("#editId").val("");
    $("#tag_name").val("");
    hideErrorMessages();
    $("#addEditTagsModal").modal('show');
}


var requestMethod,requestApi;
$("form#addEditTagsForm").on("submit",function (e) {
    e.preventDefault();
    if (validateAttributeForm()){
        var editId = $("#editId").val();
        if (editId){
            requestMethod = 'PATCH';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'tags/'+requestApi,
            data: $("#addEditTagsForm").serialize(),
            beforeSend:function(){
                $("#addEditAttributeBtn").attr('disabled',true);
            },
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditTagsForm")[0].reset();
                    $("#addEditTagsModal").modal('hide');
                }
            },
            error:function(errroResponse){
                printErrorMessage(errroResponse);
            },
            complete: function () {
                enableSubmitButton('addEditAttributeBtn');
                tagsList.draw();
            }
        });
    }
});

function validateAttributeForm() {
    hideErrorMessages();
    var isValidate = true;
    var tag_name = $("#tag_name").val();

    if (!tag_name){
        $("#tag_nameError").html("Please enter tag name");
        isValidate = false;
    }
    return isValidate;
}

