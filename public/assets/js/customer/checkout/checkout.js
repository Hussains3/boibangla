

$("form#checkoutForm").on("submit",function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url:BASE_URL+'checkout/place-order',
        data:$("#checkoutForm").serialize(),
        beforeSend:function(){
            $("#placeOrderBtn").attr('disabled',true);
            // $("#placeOrderBtn").html('Placing Order');
            if (!$('input[name="address_option"]').val()) {
                // xhr.abort();
                $("#placeOrderBtn").attr('disabled',false);
                return false;
            }
            $("#loader").show();
        },
        success: function (response) {
            if (response.status == 'success'){
                toastr.success(response.message);
               setTimeout(function () {
                   window.location.href = BASE_URL+'checkout/order-completed';
               },2000);
            }else{
                toastr.warning(response.message);
                alert(response.message);

                setTimeout(function () {
                    window.location.href = BASE_URL+'dashboard/corder';
                },200000);
                console.log(response.message);

            }
        },
        error:function(errorReponse){
            printErrorMessage(errorReponse);

        },
        complete: function () {
            $("#loader").hide();
            $("#placeOrderBtn").attr('disabled',false);
        }
    });

});

// init order buttons
$(document).ready(function () {
    $('#placeOrderSpay').css('display', 'none');
    // $('#placeOrderBtn').css('display', 'none');


});
// change button on click cod method
$('#cod').click(function (){
    // var paymentBtnType = $('[name="payment_option"]').val();
    $('#placeOrderSpay').css('display', 'none');
    $('#placeOrderBtn').css('display', 'block');

});
// change button on click Spay method
$('#spay').click(function (){
    // var paymentBtnType = $('[name="payment_option"]').val();
    $('#placeOrderSpay').css('display', 'block');
    $('#placeOrderBtn').css('display', 'none');


    var subtotal = $('#shurjoTotalAmount').val();
    $('#hidddenTotalAmount').val(subtotal);

});
