
var orderList = null;
$('#enddate').on('change', function () {
    orderList.draw();
});
$('#enddate').on('change', function () {
    orderList.draw();
});

$(document).ready(function () {
    let urlPath = 'orders/list/today';
    orderList =  $('#order-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.startdate = $('#startdate').val();
                d.enddate = $('#enddate').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},

            { "data": "order_no" },
            { "data": "order_date" },
            { "data": "payment_method" },
            { "data": "discounts" },
            { "data" : null,
                render:function (data) {
                    return `৳ `+ data.payment_amount;
                }
            },
            {
                data: null,
                render: function (data) {
                    var statusLabel = '';
                    if (data.status == 1){
                        statusLabel = '<span class="badge order-pending"> Pending </span>'
                    }else if (data.status == 2){
                        statusLabel = '<span class="badge order-confirmed"> Confirmed </span>'
                    }else if (data.status == 3){
                        statusLabel = '<span class="badge order-delivered"> Delivered </span>'
                    }else if (data.status == 4){
                        statusLabel = '<span class="badge order-canceled"> Canceled </span>'
                    }
                    return statusLabel;
                }
            },
            {
                data: null,
                render: function (data) {
                    var actionButtons,orderDetailLink;
                    orderDetailLink = BASE_URL+'orders/detail/'+data.id;
                    if (data.status == 1){
                        actionButtons = '<button type="button" onclick="confirmOrder('+data.id+');" title="Confirm Order" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fa fa-check-square"></i> </button>';
                        actionButtons += '<button type="button" onclick="cancelOrder('+data.id+');" title="Cancel Order" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-times"></i> </button>';

                    } else if (data.status == 2){
                        actionButtons = '<button type="button" onclick="deliverOrder('+data.id+');" title="Deliver Order" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-check"></i> </button>';
                    }else{
                        actionButtons = '';
                    }
                    actionButtons += '<a href="'+orderDetailLink+'" target="_blank" title="Order detail" class="btn btn-warning btn-sm"  ><i class="fa fa-eye"></i></a>';
                    return actionButtons;
                }
            }
        ],
        'columnDefs': [ {
            'targets': "no-sort",
            'orderable': false
        }],

    });
});

