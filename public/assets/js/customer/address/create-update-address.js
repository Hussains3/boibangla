
var requestMethod,requestApi;
$("form#addressCreateUpdateForm").on("submit",function (e) {
    e.preventDefault();
    console.log('something');

    if (validateAddressForm()){
        $("#loader").show('fast');
        $("#saveAddressBtn").attr('disabled',true);
        var editId = $("#edit_id").val();
        if (editId){
            requestMethod = 'PATCH';
            requestApi = 'addresses/update';
        }else{
            requestMethod = 'POST';
            requestApi = 'addresses/create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+requestApi,
            data:$("#addressCreateUpdateForm").serialize(),
            success: function (response) {
                console.log(response);
                if (response.status == "success"){
                    $("form#addressCreateUpdateForm")[0].reset();
                    toastr.success(response.message);
                    setTimeout(function () {
                        location.replace(document.referrer);
                    },2000)

                }
            },
            error:function(errorReponse){
                printErrorMessage(errorReponse);
            },
            complete: function () {
                $("#loader").hide('fast');
                $("#saveAddressBtn").attr('disabled',false);
                scrollToTop();
            }
        });
    }else {
        console.log("Some error");
    }
});

function validateAddressForm() {
    hideErrorMessages();
    var isValidated = true;
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email_address = $("#email_address").val();
    var address_contact = $("#address_contact").val();
    // var country = $("#country").val();
    var street_address = $("#street_address").val();
    var state = $("#state").val();
    var city_town = $("#city_town").val();
    var postal_zip_code = $("#postal_zip_code").val();
    var address_type = $("#address_type").val();
    if (!first_name){
        isValidated = false;
        createErrorMessages('Please enter first number','first_nameError');
    }
    if (!last_name){
        isValidated = false;
        createErrorMessages('Please enter last number','last_nameError');
    }
    if (!email_address){
        isValidated = false;
        createErrorMessages('Please enter email address','email_addressError');
    }
    if (!validateEmail(email_address)){
        isValidated = false;
        createErrorMessages('Please enter valid email address','email_addressError');
    }
    if (!address_contact){
        isValidated = false;
        createErrorMessages('Please enter contact','address_contactError');
    }
    /*if (!country){
        isValidated = false;
        createErrorMessages('Please select your country','countryError');
    }*/
    if (!street_address){
        isValidated = false;
        createErrorMessages('Please enter street address','street_addressError');
    }
    if (!state){
        isValidated = false;
        createErrorMessages('Please enter state','stateError');
    }
    if (!city_town){
        isValidated = false;
        createErrorMessages('Please enter city/town','city_townError');
    }
    if (!postal_zip_code){
        isValidated = false;
        createErrorMessages('Please enter postal code','postal_zip_codeError');
    }if (!address_type){
        isValidated = false;
        createErrorMessages('Please enter select address type','address_typeError');
    }
    scrollToTop();
    return isValidated;
}

function removeAddress(addressId) {
    requestMethod = 'DELETE';
    requestApi = 'addresses/delete';

    Swal.fire({
        title: "Delete Address?",
        text: "Are you sure to delete this address!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF324D',
        cancelButtonColor: '#1D2224',
        confirmButtonText: "Yes Delete it",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: requestMethod,
                url: BASE_URL +requestApi,
                data: {
                    addressId: addressId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                    }else{
                        console.log(response);
                    }
                    window.location.reload();
                }
            });
        }
    });
}
