
var categoryList = null;
$('#categoryStatus').on('change', function () {
    categoryList.draw();
});
$('#navigationStatus').on('change', function () {
    categoryList.draw();
});

$('#categorySearch').on('keyup', function () {
    categoryList.draw();
});

$(document).ready(function () {
    let urlPath = 'categories/list';
    categoryList =  $('#category-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.categoryStatus = (($('#categoryStatus').val()?$('#categoryStatus').val():1));
                d.navigationStatus = $('#navigationStatus').val();
                d.categorySearch = $('#categorySearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            {
                data: null,
                render: function (data) {
                    var icon = '<i class="'+data.icon_class+'" style="font-size: 20px;"></i>';
                    return icon;
                }
            },
            { "data": "category_name" },
            { "data": "category_slug" },
            { "data": "discount" },
            {
                data: null,
                render: function (data) {
                    if (data.navigation == '1'){
                        return 'YES';
                    }else{
                        return 'NO';
                    }
                }
            },
            {
                data: null,
                render: function (data) {
                    var edit_button = '<button type="button" onclick="editCategory('+data.id+',\''+data.category_name+'\',\''+data.description+'\',\''+data.categoryImage+'\',\''+data.icon_class+'\',\''+data.navigation+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> </button>'+
                        '<button type="button" onclick="deleteCategory('+data.id+',\''+data.categoryImage+'\');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> </button>';
                    return edit_button;
                }
            }
        ],
        'columnDefs': [ {
            'targets': "no-sort",
            'orderable': false
        }],
    });
});


function editCategory(categoryId,categoryName,categoryDescription,categoryImage,icon_class,navigation) {
    // console.log("editcategory");
    $("#editId").val(categoryId);
    $("#category").val(categoryName);
    $("#description").val(categoryDescription);
    $("#categoryIcon").selectpicker('val',icon_class);
    $("#preCategoryImage").val(categoryImage);
    $("#navigation").val(navigation);
    hideErrorMessages();
    $("#addEditCategoryModal").modal('show');
}

function deleteCategory(categoryId,categoryImg) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this category!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'categories/delete',
                data: {
                    categoryId: categoryId,
                    categoryImg: categoryImg
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        categoryList.draw();
                    }
                }
            });
        }
    });
}
