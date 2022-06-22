
var attributeOptionsList = null;

$('#attributeOptionNameSearch').on('keyup', function () {
    attributeOptionsList.draw();
});
$('#attributesSelect').on('change', function () {
    attributeOptionsList.draw();
});

$(document).ready(function () {
    let urlPath = 'admin/attribute-options/list';
    attributeOptionsList =  $('#attribute-option-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.attributeOptionNameSearch = $('#attributeOptionNameSearch').val();
                d.attributesSelect = $('#attributesSelect').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "attribute_name" },
            { "data": "option_name" },
            {
                data: null,
                render: function (data) {
                    var edit_button = '<button type="button" onclick="editAttributeOption('+data.id+');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> Edit </button>'+
                        '<button type="button" onclick="deleteAttributeOption('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> Delete </button>';
                    return edit_button;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [3],
            'orderable': false
        }],

    });
});


function editAttributeOption(attributeOptionId) {
    $.ajax({
        method: 'GET',
        url: BASE_URL +'admin/attribute-options/info',
        data: {
            attributeOptionId: attributeOptionId,
        },
        success: function (response) {
            if (response.status == "success") {
                $("#editId").val(response.data.id);
                $("#attributeName").val(response.data.attribute_id);
                $("#attributeOption").val(response.data.option_name);
                $("#addEditAttributeOptionModal").modal('show');
            }
        },
        error:function (errorResponse) {
            Swal.fire('Success!', 'Some Error', 'success');
        }
    });
    hideErrorMessages();
}

function deleteAttributeOption(attributeOptionId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this attribute option!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'admin/attribute-options/delete',
                data: {
                    attributeOptionId: attributeOptionId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        attributeOptionsList.draw();
                    }
                }
            });
        }
    });
}
