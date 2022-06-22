
var queriesList = null;

$('#search_name').on('keyup', function () {
    queriesList.draw();
});


$(document).ready(function () {
    queriesList =  $('#queries-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+'queries/list',
            data: function (d) {
                d.search_name = $('#search_name').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "name" },
            { "data": "email" },
            { "data": "subject" },
            { "data": "message" },
            {
                data: null,
                render: function (data) {
                    var actionButtons = '<button type="button" onclick="deleteQuery('+data.id+');" title="Delete" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> </button>';
                    return actionButtons;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [2,3],
            'orderable': false
        }],

    });
});

/**
 * This function deletes the queries raised by customer from website
 * @param id
 */
function deleteQuery(id){
    $.ajax({
        method: 'POST',
        url: BASE_URL +'admin/queries/delete',
        data: {
            id: id,
        },
        success: function (response) {
            if (response.success) {
                Swal.fire('Success!', response.message, 'success');
                queriesList.draw();
            }
        }
    });
}
