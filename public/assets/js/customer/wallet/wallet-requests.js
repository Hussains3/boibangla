
function getMyWalletRequests() {
    $.ajax({
        type: 'GET',
        url:BASE_URL+'customer/wallet-requests/list',
        data:{
            length:'',
        },
        beforeSend:function(){
            $("#spinner-loader").show();
        },
        success: function (response) {
            setWalletRequestData(response);
        },
        error:function(errorResponse){
            console.log(errorResponse);
        },
        complete:function () {
            $("#spinner-loader").hide();
        }
    });
}

function getTopWalletRequests() {
    $.ajax({
        type: 'GET',
        url:BASE_URL+'customer/wallet-requests/list',
        data:{
            length:5,
        },
        beforeSend:function(){
            $("#spinner-loader").show();
        },
        success: function (response) {
            setWalletRequestData(response);
        },
        error:function(errorResponse){
            console.log(errorResponse);
        },
        complete:function () {
            $("#spinner-loader").hide();
        }
    });
}

function setWalletRequestData(response) {
    let walletRequestList = `<ul class="listview image-listview flush">`;
    if (response.status == 'success'){
        if(response.data.length) {
            $.each(response.data, function (key, value) {
                let requestStatus, statusClass;
                if (value.status == 1) {
                    requestStatus = 'Pending';
                    statusClass = 'request-pending';
                } else if (value.status == 2) {
                    requestStatus = 'approved';
                    statusClass = 'request-approved';
                } else {
                    requestStatus = 'archived';
                    statusClass = 'request-archived';
                }
                let requestDetailUrl = BASE_URL + 'customer/wallet-requests/info/' + value.id;
                walletRequestList += `<li>
                                        <a href="` + requestDetailUrl + `" class="item">
                                            <div class="icon-box bg-primary">
                                                <i class="ti-money" style="color: white"></i>
                                            </div>
                                            <div class="in">
                                                <div>
                                                    <div class="title">` + value.payment_method + `</div>
                                                      <div class="text-small">Wallet Request Id : ` + value.request_id + `</div>
                                                    <div class="text-small mb-05">Your request for ` + value.amount + ` is <span class="` + statusClass + `">` + requestStatus + `</span></div>
                                                    <div class="text-xsmall">` + value.created_at + `</div>
                                                </div>
                                                <div class="text-small mb-05 text-right">
                                                    <div class="price"> ৳ ` + value.amount + `</div>
                                                </div>
                                            </div>
                                        </a>
                                     </li>`;
            });
        }else{
            walletRequestList += `<li class="item pt-5">You did not made any requests !</li>`;
        }
    }
    walletRequestList += `</ul>`;
    if (page == "dashboard"){
        walletRequestList += `<a href="`+BASE_URL+`customer/wallet-requests`+`" class="item pb-4" style="padding-top: 10px;">View More</a>`;
    }
    $(".wallet-requests-container").html(walletRequestList);
}
