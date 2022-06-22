function showAddWalletModal() {
    hideErrorMessages();
    $("#addWalletModal").modal('show');
}

var requestMethod,requestApi;
$("form#addMoneyWalletForm").on("submit",function (e) {
    e.preventDefault();
    if (validateWalletForm()){
        $("#addMoneyInWalletBtnLoader").removeClass('d-none');
        $("#addMoneyInWalletBtn").attr('disabled',true);
        requestMethod = 'POST';
        requestApi = 'customer/transactions/add-money';
        $.ajax({
            type: requestMethod,
            url:BASE_URL+requestApi,
            data:$("#addMoneyWalletForm").serialize(),
            success: function (response) {
                if (response.status == 'success'){
                    toastr.success(response.message);
                    $("#addMoneyWalletForm")[0].reset();
                    $("#addWalletModal").modal('hide');
                    getTopWalletRequests();
                }
                if (response.status == 'error'){
                    toastr.warning(response.message);
                }
            },
            error:function(errorResponse){
                printErrorMessage(errorResponse);
            },
            complete: function () {
                $("#addMoneyInWalletBtnLoader").addClass('d-none');
                $("#addMoneyInWalletBtn").attr('disabled',false);
            }
        });
    }
});

function validateWalletForm() {
    hideErrorMessages();
    var isValidated = true;
    var payment_method = $("#payment_method").val();
    var mobile_no = $("#mobile_no").val();
    var txn_id = $("#txn_id").val();
    var wallet_amount = $("#wallet_amount").val();
    if (!wallet_amount){
        isValidated = false;
        createErrorMessages('Please enter some amount','wallet_amountError');
    }
    if (!payment_method){
        isValidated = false;
        createErrorMessages('Please select payment method','payment_methodError');
    }
    if (!txn_id){
        isValidated = false;
        createErrorMessages('Please enter transaction id','txn_idError');
    }
    if (!mobile_no){
        isValidated = false;
        createErrorMessages('Please enter mobile no.','mobile_noError');
    }
    return isValidated;
}
