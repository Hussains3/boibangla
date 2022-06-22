let newsletterComposeValidator = $("#composeNewsletterForm").validate({
    rules: {
        title:{
            required: true,
        },
        newsletter_image:{
            required: true,
        },
        link:{
            required: true,
        },
        description:{
            required: true,
        },
        scheduled_at: {
            required: true,
        }
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'newsletters/compose/compose-newsletter',
            data : new FormData($("#composeNewsletterForm")[0]),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $('.input-error').text("");
                $("#loader").show();
            },
            success: function (response) {
                if (response.success){
                    Swal.fire('Success!', response.message, 'success').then(function(){
                       window.location.reload();
                    });
                }
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,newsletterComposeValidator);
            },
        });
    }
});
