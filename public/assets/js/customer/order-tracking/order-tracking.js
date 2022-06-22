$("form#track-order-form").on("submit",function (e) {
    e.preventDefault();
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'order-tracking/track',
        data: $("#track-order-form").serialize(),
        beforeSend:function(){
            $(".error").text("");
            $("#loader").show();
        },
        success: function (response) {
            if (response.success) {
              let orderTrackingHtml = ``;
                if (response.data.tracking_data.length){
                     orderTrackingHtml = `<p class="pt-5">Tracking details for order No. #<span class="font-weight-bold">`+response.data.order_no+`</span></p>`;
                    $.each(response.data.tracking_data,function (key,trackingData) {
                        let orderStatusClass = `status-pending`;
                        if (trackingData.status == 2){
                            orderStatusClass = `status-confirmed`;
                        } if (trackingData.status == 3){
                            orderStatusClass = `status-delivered`;
                        }if (trackingData.status == 4){
                            orderStatusClass = `status-canceled`;
                        }
                        orderTrackingHtml += `
                            <div class="tracking-item">
                                <div class="tracking-icon `+orderStatusClass+` ">
                                    `+(trackingData.status == 4 ? '<i class="fa fa-times" ></i>': '<i class="fa fa-check" ></i>')+`
                                </div>
                                <div class="tracking-date" style="font-size: 12px;">`+trackingData.processing_date+`</div>
                                <div class="tracking-content">`+trackingData.remark+`</div>
                            </div>`;
                    });
                }else{
                    orderTrackingHtml += `<p>No data available</p>`;
                }
                $("#order_no").val("");
                $("#tracking-data").html(orderTrackingHtml);
            }
        },
        error:function (errorResponse) {
            $("#tracking-data").html("");
            printErrorMessage(errorResponse)
        },
        complete:function () {
            $("#loader").hide();
        }
    });
});
