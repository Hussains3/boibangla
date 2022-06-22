
function showAddEditPublicationModel() {
    $("#editId").val("");
    $("form#addEditPublicationForm")[0].reset();
    hideErrorMessages();
    $("#addEditPublicationModal").modal('show');
}

$(document).ready(function () {
    $("#publicationName").on('keyup',function () {
        $("#publicationSlug").val(slugify($("#publicationName").val()));
    });
});

var requestMethod,requestApi;
$("form#addEditPublicationForm").on("submit",function (e) {
    e.preventDefault();
    var editId = $("#editId").val();
    if (validatePublicationForm()){
        $("#addEditPublicationBtn").attr('disabled',true);
        if (editId){
            requestMethod = 'POST';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'publications/'+requestApi,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditPublicationForm").each(function () {
                        this.reset();
                    });
                    $("#addEditPublicationModal").modal('hide');
                }
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            },
            complete: function () {
                enableSubmitButton('addEditPublicationBtn');
               publicationList.draw();
            }
        });
    }
});

function validatePublicationForm() {
    var isValidated = true;
    var publicationName = $("#publicationName").val();
    var description = $("#description").val();
    var discount = $("#discount").val();
    var publicationSlug = $("#publicationSlug").val();
    hideErrorMessages();
    if (publicationName == ""){
        $("#publicationNameError").html("Please enter publication name");
        isValidated = false;
    } if (publicationSlug == ""){
        $("#publicationSlugError").html("Please enter publication slug");
        isValidated = false;
    }if (description == ""){
        $("#descriptionError").html("Please enter description name");
        isValidated = false;
    }if (discount == ""){
        $("#discountError").html("Please enter discount parcent");
        isValidated = false;
    }
    return isValidated;
}


