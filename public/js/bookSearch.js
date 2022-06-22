$(document).ready(function () {
    $('#bookSearch').keyup(function (e) {
        if ($('#bookSearch').val()) {




            $.ajax({
                type: 'POST',
                url: BASE_URL+'bookSearch',
                data : $("#bookSearch").val(),
                beforeSend:function(){
                    console.log($("#bookSearch").val()+' sending by ajax');
                    $("#divLoader").css('display', 'block');
                },
                success: function (response) {
                    if (response.status == 'alreadyexists'){
                        createErrorMessages('Mobile number already exists','mobile_numberError');
                    }
                    else if (response.status == 'mobileverified'){
                        $("#mobile_field").hide('fast');
                        $("#flag").val('mobileverified');
                        $("#screen2").removeClass('d-none');
                        $("#password").val("");
                    }
                    if (response.status == "accountcreated") {
                        $(".account-created-success").show('fast');
                        $(".account-created-success").html(response.message);
                        //alert(response.link);
                        setTimeout(function () {
                            window.location.href = BASE_URL+'customer/dashboard';
                        },2000)
                    }
                },
                complete: function () {
                    $("#divLoader").css('display', 'none');

                },
                error: function (errorData) {
                    console.log('Ops!');
                },
            });

        }

    });
});




