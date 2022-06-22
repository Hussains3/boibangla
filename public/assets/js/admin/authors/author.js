

function showAddEditAuthorModel() {
    $("#editId").val("");
    $("#author").val("");
    $("#discount").val("");
    $("#authorIcon").val("");
    $("#description").val("");
    hideErrorMessages();
    $("#addEditAuthorModal").modal('show');
}
var requestMethod,requestApi;
$("form#addEditAuthorForm").on("submit",function (e) {
    e.preventDefault();
    var editId = $("#editId").val();
    if (validateAuthorForm()){
        $("#addEditAuthorBtn").attr('disabled',true);
        if (editId){
            requestMethod = 'POST';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'authors/'+requestApi,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditAuthorForm").each(function () {
                        this.reset();
                    });
                    $("#addEditAuthorModal").modal('hide');
                }
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            },
            complete: function () {
                enableSubmitButton('addEditAuthorBtn');
                authorList.draw();
            }
        });
   }
});

function validateAuthorForm() {
    var isValidated = true;
    var author = $("#author").val();
    var authorIcon = $("#authorIcon").val();
    var description = $("#description").val();
    var discount = $("#discount").val();
    var navigation = $("#navigation").val();
    hideErrorMessages();
    if (author == ""){
        $("#authorError").html("Please enter author name");
        isValidated = false;
    }if (authorIcon == ""){
        $("#authorIconError").html("Please enter author icon");
        isValidated = false;
    }if (description == ""){
        $("#descriptionError").html("Please enter description name");
        isValidated = false;
    }if (discount == ""){
        $("#discountError").html("Please enter discount parcent");
        isValidated = false;
    }if (navigation == ""){
        $("#navigationError").html("Please enter description name");
        isValidated = false;
    }

    return isValidated;
}


