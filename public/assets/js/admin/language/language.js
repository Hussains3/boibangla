
function showAddEditLanguageModel() {
    $("#name").val("");
    $("#code").val("");
    hideErrorMessages();
    $("#addEditLanguageModal").modal('show');
}

var requestMethod,requestApi;
$("form#addEditLanguageForm").on("submit",function (e) {
    e.preventDefault();
    var editId = $("#editId").val();
    if (validateLanguageForm()){
        $("#addEditLanguageBtn").attr('disabled',true);
        if (editId){
            requestMethod = 'POST';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'languages/'+requestApi,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditLanguageForm").each(function () {
                        this.reset();
                    });
                    $("#addEditLanguageModal").modal('hide');
                }
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            },
            complete: function () {
                enableSubmitButton('addEditLanguageBtn');
                languageList.draw();
            }
        });
   }
});

function validateLanguageForm() {
    var isValidated = true;
    var name = $("#name").val();
    var code = $("#code").val();
    hideErrorMessages();
    if (name == ""){
        $("#nameError").html("Please enter language name");
        isValidated = false;
    }if (code == ""){
        $("#codeError").html("Please enter language code");
        isValidated = false;
    }

    return isValidated;
}


