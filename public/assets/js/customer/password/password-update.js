
var requestMethod,requestApi;
$("form#passwordUpdateForm").on("submit",function (e) {
    e.preventDefault();
    if (validatePasswordUpdateForm()){
        $("#loader").show();
        $("#updatePasswordBtn").attr('disabled',true);

        requestMethod = 'PATCH';
        requestApi = 'password/update';
        $.ajax({
            type: requestMethod,
            url:BASE_URL+requestApi,
            data:$("#passwordUpdateForm").serialize(),
            success: function (response) {
                if (response.status == "verified"){
                    $("#createPasswordFields").removeClass('d-none');
                    $("#currentPasswordStatus").val("verified");
                }else if (response.status == 'wrong'){
                    createErrorMessages('Current password does not match','current_passwordError');
                }else if (response.status == 'success'){
                    toastr.success(response.message);
                    $("#createPasswordFields").addClass('d-none');
                    $("#currentPasswordStatus").val("");
                    $("#current_password").val("");
                    $("#new_password").val("");
                }
            },
            error:function(errorReponse){
                printErrorMessage(errorReponse);
            },
            complete: function () {
                $("#loader").hide();
                $("#updatePasswordBtn").attr('disabled',false);
                scrollToTop();
            }
        });
    }
});

function validatePasswordUpdateForm() {
    hideErrorMessages();
    var isValidated = true;
    var current_password = $("#current_password").val();
    var new_password = $("#new_password").val();
    var confirm_password = $("#confirm_password").val();
    var flag = $("#currentPasswordStatus").val();

    if (!current_password){
        isValidated = false;
        createErrorMessages('Please enter current password','current_passwordError');
    }
    if (!new_password && flag == 'verified'){
        isValidated = false;
        createErrorMessages('Please enter new password','new_passwordError');
    }
    if (!confirm_password &&  flag == 'verified'){
        isValidated = false;
        createErrorMessages('Please enter confirm password','confirm_passwordError');
    }

    if (new_password != confirm_password && flag == 'verified'){
        isValidated = false;
        createErrorMessages('Confirm password did not match','confirm_passwordError');
    }

    scrollToTop();
    return isValidated;
}
