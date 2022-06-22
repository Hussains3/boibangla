
function showAddEditSubCategoryModel() {
    $("#editId").val("");
    $("#subCategory").val("");
    $("#slug").val("");
    $("#category").val("");
    $("#description").val("");
    hideErrorMessages();
    $("#addEditSubCategoryModal").modal('show');
}
var requestMethod,requestApi;
$("form#addEditSubCategoryForm").on("submit",function (e) {
    e.preventDefault();
    if (validateSubCategoryForm()){
        var editId = $("#editId").val();
        if (editId){
            requestMethod = 'PATCH';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $("#addEditSubCategoryBtn").attr('disabled',true);
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'sub-categories/'+requestApi,
            data: $("#addEditSubCategoryForm").serialize(),
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditSubCategoryForm").each(function () {
                        this.reset();
                    });
                    $("#addEditSubCategoryModal").modal('hide');
                }
            },
            error:function(errroResponse){
                printErrorMessage(errroResponse);
            },
            complete: function () {
                $("#addEditSubCategoryBtn").attr('disabled',false);
                subCategoryList.draw();
            }
        });
    }
});


function validateSubCategoryForm() {
    hideErrorMessages();
    var category = $("#category").val();
    var subCategory = $("#subCategory").val();
    var slug = $("#slug").val();
    var description = $("#description").val();

    var isValidated = true;
    if (subCategory == ""){
        $("#subCategoryError").html("Please enter sub category name");
        isValidated = false;
    }
    if (slug == ""){
        $("#slugError").html("Please enter slug");
        isValidated = false;
    }
     if (category == ""){
        $("#categoryError").html("Please select category");
        isValidated = false;
    }
    if (description == ""){
        $("#descriptionError").html("Please enter some description");
        isValidated = false;
    }
     return isValidated;
}
