

$("form#newsLetterForm").on("submit",function (e) {
    e.preventDefault();
    if ($("#newsletter_email").val() == ''){
        createErrorMessages('Please enter email','emailError');
        return;
    }else if (!validateEmail($("#newsletter_email").val())){
        createErrorMessages('Please enter valid email','emailError');
        return;
    }
    $("#emailError").text("");
        $.ajax({
            type: 'POST',
            url:BASE_URL+'subscribe-newsletter',
            data:$("#newsLetterForm").serialize(),
            beforeSend:function(){
                $("#subscribeBtn").attr('disabled',true);
                $("#newsletter-spinner").show();
            },
            success: function (response) {
                if (response.status == 'success'){
                    toastr.success(response.message);
                    $("#newsletter_email").val("");
                    $("#emailError").text("");
                }
            },
            error:function(errorReponse){
                printErrorMessage(errorReponse);
            },
            complete: function () {
                $("#subscribeBtn").attr('disabled',false);
                $("#newsletter-spinner").hide();
            }
        });
});


/**
 * This function changes the newsletter setting
 * that, customer want to recieve email newsltter or not
 * @param argument
 */
function changeNewsletterSetting(argument) {
    let setting;
    if($(argument).is(':checked')){
        setting = 1;
    }else{
        setting = 2;
    }
    $.ajax({
        type: 'POST',
        url:BASE_URL+'customer/newsletter/change-setting',
        data:{
            setting:setting
        },
        beforeSend:function(){
            $("#newsletter-spinner").show();
        },
        success: function (response) {
            if (response.status == 'success'){
                toastr.success(response.message);
            }
        },
        error:function(errorResponse){
            toastr.warning(errorResponse);
        },
        complete: function () {
            $("#subscribeBtn").attr('disabled',false);
            $("#newsletter-spinner").hide();
        }
    });

}
