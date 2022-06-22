/**
 * show and hide checkbox on checkbox change
 */
$('#change_password').click(function () {
    if ($(this).is(':checked')) {
        $("#password-input").show('fast');
        $("#password").val("");
    } else {
        $("#password-input").hide('fast');
    }
});

$("form#adminProfileUpdateForm").on("submit",function (e) {
    e.preventDefault();
    if (validateProfile()){
        $.ajax({
            type: 'POST',
            url:BASE_URL+'admin/profile/update',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success'){
                    Swal.fire('Success!', response.message, 'success');
                    $("#admin-name").text($("#name").val());
                    $("#admin-profile-img").attr('src',BASE_URL+'storage/uploads/profile/admin/'+response.profile_pic);
                    $("#preProfilePic").val(response.profile_pic);
                    $("#password-input").hide('fast');
                    $("#change_password"). prop("checked", false);
                    $("#updateProfileBtn").attr('disabled',false);
                }
            },
            error:function(errorResponse){
                printErrorMessage(errorResponse);
            },
        });
    }
});

function validateProfile() {
    hideErrorMessages();
    var isValidated = true;
    var name = $("#name").val();
    var contact = $("#contact").val();
    var email = $("#email").val();
    var password = $("#password").val();
    if (!name){
        isValidated = false;
        createErrorMessages('Please enter first number','nameError');
    }
    if (!contact){
        isValidated = false;
        createErrorMessages('Please enter contact','contactError');
    }
    if (!validatePhoneNumber(contact) && contact !=""){
        isValidated = false;
        createErrorMessages('Please enter valid contact','contactError');
    }
    if (!email){
        isValidated = false;
        createErrorMessages('Please enter email address','emailError');
    }
    if (!validateEmail(email) && email !=""){
        isValidated = false;
        createErrorMessages('Please enter valid email address','emailError');
    }
    if ($("#change_password").is(':checked') && password == '') {
        isValidated = false;
        createErrorMessages('Please enter password','passwordError');
    }
    return isValidated;
}
