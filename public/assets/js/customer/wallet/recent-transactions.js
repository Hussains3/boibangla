
$(document).ready(function () {
    getRecentTransactions();
});
function getRecentTransactions() {
    var amountStatus;
    var priceValue;
    var className;
    var arrowDirection;
    var transactions = `<ul class="listview image-listview flush">`;
    $.ajax({
        type: 'GET',
        url:BASE_URL+'customer/transactions/get-recent',
        data:{},
        beforeSend:function(){
            $("#spinner-loader").show();
        },
        success: function (response) {
            if (response.status == 'success'){
                $.each(response.data,function (key,value) {
                    if (value.status == 1){
                         amountStatus = 'Credited';
                         className = 'success';
                         arrowDirection = 'down';
                         priceValue = `<div class="price amount-added"> + $ `+value.amount+`</div>`;
                    }else{
                         priceValue = `<div class="price amount-deducted"> + $ `+value.amount+`</div>`;
                         amountStatus = 'Debited';
                         className = 'warning';
                        arrowDirection = 'up';
                    }
                    transactions += `<li>
                                        <a href="#" class="item">
                                            <div class="icon-box bg-`+className+`">
                                                <i class="ti-arrow-`+arrowDirection+`" style="color: white"></i>
                                            </div>
                                            <div class="in">
                                                <div>
                                                    <div class="title">`+amountStatus+`</div>
                                                    <div class="text-small mb-05">Amount `+amountStatus+` from your wallet</div>
                                                    <div class="text-xsmall">`+value.created_at+`</div>
                                                </div>
                                                <div class="text-small mb-05 text-right">
                                                    `+priceValue+`
                                                </div>
                                            </div>
                                        </a>
                                     </li>`;
                });

            }else{
                console.log(response);
            }
            transactions += `</ul>`;
            $(".recent-transaction").html(transactions);
        },
        error:function(errorReponse){
           console.log(errorReponse);
        },
        complete:function () {
            $("#spinner-loader").hide();
        }
    });
}
