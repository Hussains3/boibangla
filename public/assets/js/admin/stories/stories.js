function showAddEditStoryModel() {
    $("#id").val("");
    $("#addEditStoryModal").modal("show");
}
var storyList = null;
$(document).ready(function () {
    let urlPath = 'admin/stories/list';
    storyList =  $('#stories-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {}
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "title" },
            { "data": "link" },
            {
                data: null,
                render: function (data) {
                   return '<img src="'+BASE_URL+'storage/uploads/media/'+data.image+'" width="50"/>';
                }
            },
            {
                data: null,
                render: function (data) {
                    var actionButtons = '<button type="button" onclick="editStory('+data.id+');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i></button>'+
                        '<button type="button" onclick="deleteStory('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></button>';
                    return actionButtons;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [2],
            'orderable': false
        }],

    });
});

let storyFormValidator = $("#addEditStoryForm").validate({
    rules: {
        title:{
            required: true,
        },
        link:{
            required: true,
        },
        image:{
            required: function(element){
                return !$("#id").val();
            },
        },
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'admin/stories/save',
            data : new FormData($("#addEditStoryForm")[0]),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function(){
                $('.input-error').text("");
                $("#loader").show();
            },
            success: function (response) {
                Swal.fire('Success!', response.message, 'success');
                $("#addEditStoryForm")[0].reset();
                $("#addEditStoryModal").modal("hide");
                storyList.draw();
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,storyFormValidator);
            },
        });
    }
});

function editStory(id) {
    $.ajax({
        method: 'GET',
        url: BASE_URL +'admin/stories/info',
        data: {
            id: id,
        },
        success: function (response) {
            if (response.success) {
                let story = response.data;
                $("#addEditStoryModal").modal("show");
                $("#id").val(story.id);
                $("#title").val(story.title);
                $("#link").val(story.link);
                $("#pre_image").val(story.image);
            }
        }
    });
}
function deleteStory(id) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this story!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'admin/stories/delete',
                data: {
                    id: id,
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Success!', response.message, 'success');
                        storyList.draw();
                    }
                }
            });
        }
    });
}
