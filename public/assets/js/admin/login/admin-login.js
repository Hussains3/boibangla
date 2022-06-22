$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/* login code */
$("form#loginForm").on("submit",function (e) {
    e.preventDefault();
    var username = $("#mobileNumber").val();
    var password = $("#password").val();
    if (username == ""){
        $(".login-failed").show();
        $(".login-failed").html("Please enter username");
        $("#username").focus();
    } else  if (password == ""){
        $(".login-failed").show();
        $(".login-failed").html("Please enter password");
        $("#password").focus();
    }else {
        $("#loader").show('fast');
        $.ajax({
            type: 'POST',
            url:BASE_URL+'admin/validateAdminLogin',
            data: {
                username:username,
                password:password,
            },
            success: function (response) {
                console.log(response);
                if (response.status == "success"){
                    window.location.href = BASE_URL+'admin/dashboard';
                }else{
                    $(".login-failed").show();
                    $(".login-failed").html("Invalid username or password");
                }
            },
            complete: function () {
               $("#loader").hide('fast');
            }
        });


    }
});
