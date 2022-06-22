
$(document).ready(function () {
    getMyOrders();
});
function getMyOrders() {

    $.ajax({
        type: 'GET',
        url:BASE_URL+'customer/orders/my-orders',
        data:{},
        success: function (response) {
            if (response.status == 'success'){

            }else{
                console.log(response);
            }
        },
        error:function(errorReponse){
            printErrorMessage(errorReponse);
        },
    });
}
