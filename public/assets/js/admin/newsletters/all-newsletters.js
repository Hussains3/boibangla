
var newsletterList = null;

$(document).ready(function () {
    newsletterList =  $('#newsletter-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+'newsletters/list',
            data: function (d) {
               // d.emailFilter = $('#emailFilter').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "title" },
            { "data": "link" },
            { "data": "description" },
            {
                data: null,
                render: function (row) {
                    var thumbnail = '<img src="'+BASE_URL+'storage/uploads/media/'+row.image+'" class="img-responsive" width="50"/>';
                    return thumbnail;
                }
            },
        ],
        'columnDefs': [ {
            'targets': [2,3],
            'orderable': false
        }],

    });
});
