
var walletRequestList = null;
$('#search_status').on('change', function () {
    walletRequestList.draw();
});
$('#search_name').on('keyup', function () {
    walletRequestList.draw();
});
$('#request_id').on('keyup', function () {
    walletRequestList.draw();
});

$(document).ready(function () {
    let urlPath = 'admin/wallet/list';
    walletRequestList =  $('#wallet-requests-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.search_status = $('#search_status').val();
                d.search_name = $('#search_name').val();
                d.request_id = $('#request_id').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "request_id" },
            { "data": "txn_id" },
            { "data": "created_at" },
            { "data": "first_name" },
            { "data": "mobile" },
            { "data": null,
                render:function (data) {
                    return `৳ `+  data.amount;
                }
            },
            { "data": "payment_method" },
            {
                data: null,
                render: function (data) {
                    var statusLabel = '';
                    if (data.status == 1){
                        statusLabel = '<span class="badge pending"> Pending </span>'
                    }else if (data.status == 2){
                        statusLabel = '<span class="badge approved"> Approved </span>'
                    }else if (data.status == 3){
                        statusLabel = '<span class="badge archived"> Archived </span>'
                    }
                    return statusLabel;
                }
            },
            {
                data: null,
                render: function (data) {
                    var actionButtons = '';
                    if (data.status == 1 && data.status != 3){
                        actionButtons= '<button type="button" onclick="manageWalletRequest('+data.id+',2,'+data.user_id+');" title="Confirm" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-check-square"></i> </button>';
                        actionButtons += '<button type="button" onclick="manageWalletRequest('+data.id+',3,'+data.user_id+');" title="Archive" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> </button>';
                    }
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

