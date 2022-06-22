function showAddEditBannerModel() {
    $("#id").val("");
    $("#addOtherImagesModal").modal('show');
}

let otherImageUploadForm = $("#addEditOtherImagesForm").validate({
    rules: {
        image:{
            required: function (element) {
                if ($("#pre_image").val()){
                    return false;
                }else{
                    return true;
                }
            },
        },
        link:{
            required: true,
        }
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'media/others/save',
            data : new FormData($("#addEditOtherImagesForm")[0]),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $('.input-error').remove();
                $("#loader").show();
            },
            success: function (response) {
                if (response.success){
                    $("#addOtherImagesModal").modal('hide');
                    Swal.fire('Success!', response.message, 'success');
                }else{
                    Swal.fire('Oops!', response.message, 'error');
                }
                otherImagesList.draw();

            },
            complete: function () {
                $("#loader").hide();
                $("#addEditOtherImagesForm")[0].reset();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,otherImageUploadForm);
            },
        });
    }
});


var otherImagesList = null;

$(document).ready(function () {
    let urlPath = 'media/others/list';
    otherImagesList =  $('#other-image-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {}
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                "data": null,
                render: function (data) {
                    let fileUrl = BASE_URL+'storage/uploads/media/'+data.file;
                    return `<a href="`+fileUrl+`" target="_blank"><img src="`+fileUrl+`" width="100"/></a>`;
                }
            },
            {
                data: null,
                render: function (data) {
                    var actionButtons;
                    actionButtons = '<button type="button" onclick="editImage('+data.id+');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i></button>';
                    return actionButtons;
                }
            }
        ],
        'columnDefs': [ {
            'targets': "no-sort",
            'orderable': false
        }],

    });
});


function editImage(id) {
    $.ajax({
        method: 'GET',
        url: BASE_URL +'media/others/info',
        data: {
            id: id,
        },
        success: function (response) {
            let media = response.data;
            $("#id").val(media.id);
            $("#link").val(media.data.link);
            $("#pre_image").val(media.file);
            $("#addOtherImagesModal").modal('show');
        }
    });
}
