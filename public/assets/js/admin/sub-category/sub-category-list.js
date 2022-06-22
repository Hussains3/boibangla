
var subCategoryList = null;
$('#subCategorySearch').on('keyup', function () {
    subCategoryList.draw();
});
$('#categorySelect').on('change', function () {
    subCategoryList.draw();
});

$(document).ready(function () {
    let urlPath = 'sub-categories/list';
    subCategoryList =  $('#sub-category-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.subCategorySearch = $('#subCategorySearch').val();
                d.categorySelect = $('#categorySelect').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            { "data": "subcategory" },
            { "data": "slug" },
            { "data": "category_name" },
            {
                data: null,
                render: function (data) {
                    console.log(data);
                    var edit_button = '<button type="button" onclick="editSubCategory('+data.id+',\''+data.subcategory+'\',\''+data.description+'\','+data.category_id+');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i></button>'+
                        '<button type="button" onclick="deleteSubCategory('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></button>';
                    return edit_button;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [5],
            'orderable': false
        }],

    });
});


function editSubCategory(subCategoryId,subCategoryName,description,categoryId) {
    $("#editId").val(subCategoryId);
    $("#subCategory").val(subCategoryName);
    $("#description").val(description);
    $("#category").val(categoryId);
    hideErrorMessages();
    $("#addEditSubCategoryModal").modal('show');
}

function deleteSubCategory(subCategoryId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this sub category!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'sub-categories/delete',
                data: {
                    subCategoryId: subCategoryId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        subCategoryList.draw();
                    }
                }
            });
        }
    });
}
