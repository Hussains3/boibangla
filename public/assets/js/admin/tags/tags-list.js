
var tagsList = null;

$('#tagFilter').on('keyup', function () {
    tagsList.draw();
});


$(document).ready(function () {
    let urlPath = 'tags/list';
    tagsList =  $('#tags-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.tag_filter = $('#tagFilter').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "tag" },
            {
                data: null,
                render: function (data) {
                    var actionButtons = '<button type="button" onclick="editTag('+data.id+',\''+data.tag+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i></button>'+
                        '<button type="button" onclick="deleteTag('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></button>';
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


function editTag(tagId,tagName) {
    $("#editId").val(tagId);
    $("#tag_name").val(tagName);
    hideErrorMessages();
    $("#addEditTagsModal").modal('show');
}

function deleteTag(tagId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this tag!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'tags/delete',
                data: {
                    tagId: tagId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        tagsList.draw();
                    }
                }
            });
        }
    });
}
