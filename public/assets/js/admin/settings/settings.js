let settingsValidator = $("#settingsUpdateForm").validate({
    rules: {
        delivery_charge:{
            required: false,
        },
        offer_text:{
            required: true,
        },
        cash_on_delivery:{
            required: true,
        },
        meta_description:{
            required: true,
        },
        meta_keywords:{
            required: true,
        },
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'settings/update',
            data : new FormData($("#settingsUpdateForm")[0]),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $('.input-error').text("");
                $("#loader").show();
            },
            success: function (response) {
                Swal.fire('Success!', response.message, 'success');
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,settingsValidator);
            },
        });
    }
});
