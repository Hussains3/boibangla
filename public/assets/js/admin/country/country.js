
function showAddEditCountryModel() {
    $("#editId").val("");
    $("#country").val("");
    $("#code").val("");
    hideErrorMessages();
    $("#addEditCountryModal").modal('show');
}
var requestMethod,requestApi;
$("form#addEditCountryForm").on("submit",function (e) {
    e.preventDefault();
    var editId = $("#editId").val();
    if (validateCountryForm()){
        $("#addEditCountryBtn").attr('disabled',true);
        if (editId){
            requestMethod = 'POST';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'countries/'+requestApi,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditCountryForm").each(function () {
                        this.reset();
                    });
                    $("#addEditCountryModal").modal('hide');
                }
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            },
            complete: function () {
                enableSubmitButton('addEditCountryBtn');
                countryList.draw();
            }
        });
   }
});

function validateCountryForm() {
    var isValidated = true;
    var country = $("#country").val();
    var countryCode = $("#code").val();
    hideErrorMessages();
    if (country == ""){
        $("#countryError").html("Please enter country name");
        isValidated = false;
    }if (countryCode == ""){
        $("#countryCodeError").html("Please enter country icon");
        isValidated = false;
    }

    return isValidated;
}


