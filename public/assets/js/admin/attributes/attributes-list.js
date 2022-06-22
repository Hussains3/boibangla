
var attributeList = null;

$('#attributeFilter').on('keyup', function () {
    attributeList.draw();
});


$(document).ready(function () {
    let urlPath = 'admin/attributes/list';
    attributeList =  $('#attribute-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.attributeFilter = $('#attributeFilter').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "attribute_name" },
            {
                data: null,
                render: function (data) {
                    var actionButtons = '<button type="button" onclick="editAttribute('+data.id+',\''+data.attribute_name+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> Edit </button>'+
                        '<button type="button" onclick="deleteAttribute('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> Delete </button>';
                    return actionButtons;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [0],
            'orderable': false
        }],

    });
});


function editAttribute(attributeId,attributeName,category,subcategory) {
    $("#editId").val(attributeId);
    $("#attributeName").val(attributeName);
    hideErrorMessages();
    $("#addEditAttributeModal").modal('show');
}

function deleteAttribute(attributeId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this attribute!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'admin/attributes/delete',
                data: {
                    attributeId: attributeId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        attributeList.draw();
                    }
                }
            });
        }
    });
}
