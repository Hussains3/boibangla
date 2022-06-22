
function showAddEditBannerModel() {
    $("#editId").val("");
    resetModalForm();
    $("#addEditBannerModal").modal('show');
}

let bannerUploadForm = $("#addEditBannerForm").validate({
    rules: {
        media:{
            required: function (element) {
                if ($("#pre_file").val()){
                    return false;
                }else{
                    return true;
                }
            },
        },
        title:{
            required: true,
        },
        sub_title:{
            required: true,
        },
        button_label:{
            required: true,
        },
        button_link:{
            required: true,
        }
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'media/banner/save',
            data : prepareEmployeeFormData(),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $('.input-error').remove();
                $("#loader").show();
            },
            success: function (response) {
                $("#addEditBannerModal").modal('hide');
                resetModalForm();
                Swal.fire('Success!', response.message, 'success');
                bannerList.draw();
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,bannerUploadForm);
            },
        });
    }
});
/*
**
* This function prepares the form data
* with file attributes
* @returns {FormData}
*/
function prepareEmployeeFormData() {
    var form = $("#addEditBannerForm");
    var params = form.serializeArray();
    var formData = new FormData();
    formData.append('media', $("#media")[0].files[0]);
    $(params).each(function (index, element) {
        formData.append(element.name, element.value);
    });
    return formData;
}


function resetModalForm() {
    $(".input-error").text("");
    $("#addEditBannerForm")[0].reset();
}
