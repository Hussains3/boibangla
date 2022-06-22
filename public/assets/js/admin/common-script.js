$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
     beforeSend:function () {
        //$(".spinner-loader").show();
        $("#loader").show();
         hideProcessingMessage();
     },
     complete:function () {
         //$(".spinner-loader").hide();
         $("#loader").hide();
     }
});

/**
 * This function is just used to hide the message "Processing.."
 * of dataTable while loading from database
 */
function hideProcessingMessage() {
    var tableIds = ['order-table','category-table','sub-category-table','brand-table','tags-table',
        'product-table','discount-table','customers-table','orders-table','newsletter-table','wallet-requests-table',
        'banner-image-table',
    ];

    $.each(tableIds,function (key,value) {
        $('#'+value+'_processing').hide();
    });
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
