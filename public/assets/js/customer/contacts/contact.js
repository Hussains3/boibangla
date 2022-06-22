let contactValidator = $("#contactUsForm").validate({
    rules: {
        name:{
            required: true,
        },
        phone:{
            required: true,
        },
        email:{
            required: true,
        },
        subject:{
            required: true,
        },
        message:{
            required: true,
        },
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'send-enquiry',
            data : $("#contactUsForm").serialize(),
            beforeSend:function(){
                $('.input-error').text("");
                $("#loader").show();
                console.log('thanks for contucting us');
            },
            success: function (response) {
                $('#popupNotification').toggleClass("d-none").html('We have received your message, will contact you soon.').delay(3000).fadeOut(function(){
                    $(this).toggleClass('d-none');
                });
                $("#contactUsForm")[0].reset();
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
                console.log(errorData);
                printValidationErrorMsg(errorData,contactValidator);
            },
        });
    }
});


