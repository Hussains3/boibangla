let popupValidator = $("#popupForm").validate({
    rules: {
        title:{
            required: true,
        },
        link:{
            required: true,
        },
        popup_image:{
            required: function(element){
                if ($("#pre_popup_image").val() == ''){
                    return true;
                }else{
                    return false;
                }
            },
        },
        description:{
            required: true,
        },
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'admin/popup/update',
            data : new FormData($("#popupForm")[0]),
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
                printValidationErrorMsg(errorData,popupValidator);
            },
        });
    }
});
