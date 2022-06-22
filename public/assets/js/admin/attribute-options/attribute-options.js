
function showAddEditAttributeOptionModel() {
    $("#editId").val("");
    $("#attributeName").val("");
    $("#attributeOption").val("");
    $("#addEditAttributeOptionModal").modal('show');
    hideErrorMessages();
}
var requestMethod,requestApi;
$("form#addEditAttributeOptionForm").on("submit",function (e) {
    e.preventDefault();
    if (validateAttributeOptionForm()){
        var editId = $("#editId").val();
        if (editId){
            requestMethod = 'PATCH';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $("#addEditAttributeOptionBtn").attr('disabled',true);
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'admin/attribute-options/'+requestApi,
            data: $("#addEditAttributeOptionForm").serialize(),
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditAttributeOptionForm").each(function () {
                        this.reset();
                    });
                    $("#addEditAttributeOptionModal").modal('hide');
                }
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            },
            complete: function () {
                enableSubmitButton('addEditAttributeOptionBtn');
               attributeOptionsList.draw();
            }
        });
    }
});

function validateAttributeOptionForm() {
    var isValidated = true;
    var attributeName = $("#attributeName").val();
    var attributeOption = $("#attributeOption").val();
    if (attributeName == ""){
        $("#attributeNameError").html("Please select attribute name");
        isValidated = false;
    } if (attributeOption == ""){
        $("#attributeOptionError").html("Please enter attribute options");
        isValidated = false;
    }
    return isValidated;
}

