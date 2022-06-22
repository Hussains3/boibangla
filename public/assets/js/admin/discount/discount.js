
$(document).ready(function () {
    $("#categories").select2({
        placeholder: {
            text: "Select"
        }
    });
});
function showAddEditDiscountModal() {
    $("#editId").val("");
    $("#description").val("");
    $("#startDate").val("");
    $("#validityDate").val("");
    hideErrorMessages();
    $("#addEditDiscountModal").modal('show');
}
var requestMethod,requestApi;
$("form#addEditDiscountForm").on("submit",function (e) {
    e.preventDefault();
    var editId = $("#editId").val();
    if (editId){
        requestMethod = 'PATCH';
        requestApi = 'update';
    }else{
        requestMethod = 'POST';
        requestApi = 'create';
    }
    if (validateDiscountForm()){
        $("#addEditDiscountBtn").attr('disabled',true);
        $.ajax({
            type: requestMethod,
            url:BASE_URL+'discounts/'+requestApi,
            data: $("#addEditDiscountForm").serialize(),
            success: function (response) {
                if (response.status == "success"){
                    Swal.fire('Success!', response.message, 'success');
                    $("form#addEditDiscountForm").each(function () {
                        this.reset();
                    });
                    $("#addEditDiscountModal").modal('hide');
                }
            },
            error:function(errroResponse){
                printErrorMessage(errroResponse);
            },
            complete: function () {
                $("#addEditDiscountBtn").attr('disabled',false);
                discountList.draw();
            }
        });
    }
});

function validateDiscountForm() {
    hideErrorMessages();
    var isValidate = true;
    var couponName = $("#couponName").val();
    var discount = $("#discount").val();
    var description = $("#description").val();
    var startDate = $("#startDate").val();
    var validityDate = $("#validityDate").val();

    if (!couponName){
        $("#couponNameError").html("<i class='fa fa-info-circle'></i> Please enter coupon name");
        isValidate = false;
    }
    if (!discount){
        $("#discountError").html("<i class='fa fa-info-circle'></i> Please enter coupon discount");
        isValidate = false;
    }
     if (!description){
        $("#descriptionError").html("<i class='fa fa-info-circle'></i> Please enter some description");
        isValidate = false;
    }
      if (!startDate){
        $("#startDateError").html("<i class='fa fa-info-circle'></i> Please select start date");
        isValidate = false;
    } if (!validityDate){
        $("#validityDateError").html("<i class='fa fa-info-circle'></i> Please validity date");
        isValidate = false;
    }
    return isValidate;
}


