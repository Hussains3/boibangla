
function showAddEditRoleModel() {
    $("#role").val("");
    hideErrorMessages();
    $("#addEditRoleModal").modal('show');
}

$("form#addEditRoleForm").on("submit",function (e) {
    e.preventDefault();
    console.log('something');

    if (validateRoleForm()){
        $("#addEditRoleBtn").attr('disabled',true);
        $.ajax({
            type: 'POST',
            url:BASE_URL+'roles/store',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditRoleForm").each(function () {
                        this.reset();
                    });
                    $("#addEditRoleModal").modal('hide');
                }
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            },
            complete: function () {
                enableSubmitButton('addEditRoleBtn');
                roleList.draw();
            }
        });
   }
});

function validateRoleForm() {
    var isValidated = true;
    var role = $("#role").val();
    hideErrorMessages();
    if (role == ""){
        $("#roleError").html("Please enter role name");
        isValidated = false;
    }

    return isValidated;
}


