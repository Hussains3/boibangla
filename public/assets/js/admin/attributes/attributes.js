
function showAddEditAttributeModel() {
    $("#editId").val("");
    $("#attributeName").val("");
    hideErrorMessages();
    $("#addEditAttributeModal").modal('show');
}


/*function getSubCategory(category,subCatValue) {
    var subCategory = '<option value="">Select</option>';
    $.ajax({
        type: 'POST',
        url:BASE_URL+'admin/common/get-sub-category',
        data: {category:category},
        success: function (response) {
            if (response.status == "success"){
                $.each(response.data,function (key,value) {
                    subCategory += '<option value="'+value.id+'">'+value.subcategory+'</option>';
                });
                $("#subCategory").html(subCategory);
                $("#subCategory").val(subCatValue);
            }
        },
        error:function(errroResponse){
            printErrorMessage(errroResponse);
        },
        complete: function () {
            enableSubmitButton('addEditAttributeBtn');
            attributeList.draw();
        }
    });
}*/

var requestMethod,requestApi;
$("form#addEditAttributeForm").on("submit",function (e) {
    e.preventDefault();
     if (validateAttributeForm()){
         var editId = $("#editId").val();
        $("#addEditAttributeBtn").attr('disabled',true);
        if (editId){
            requestMethod = 'PATCH';
            requestApi = 'update';
        }else{
            requestMethod = 'POST';
            requestApi = 'create';
        }
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'admin/attributes/'+requestApi,
            data: $("#addEditAttributeForm").serialize(),
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditAttributeForm").each(function () {
                        this.reset();
                    });
                    $("#addEditAttributeModal").modal('hide');
                }
            },
            error:function(errroResponse){
                printErrorMessage(errroResponse);
            },
            complete: function () {
                enableSubmitButton('addEditAttributeBtn');
                attributeList.draw();
            }
        });
    }
});

function validateAttributeForm() {
    hideErrorMessages();
    var isValidate = true;
    var attributeName = $("#attributeName").val();

    if (!attributeName){
        $("#attributeNameError").html("Please enter filter name");
        isValidate = false;
    }
    return isValidate;
}


