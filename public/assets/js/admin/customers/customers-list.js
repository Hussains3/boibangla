
var customerList = null;
$('#customer_name').on('keyup', function () {
    customerList.draw();
});

$(document).ready(function () {
    let urlPath = 'admin/customers/list';
    customerList =  $('#customers-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.customer_name = $('#customer_name').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},

            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "email" },
            { "data": "contact" },
        ],
        'columnDefs': [ {
            'targets': [],
            'orderable': false
        }],

    });
});
