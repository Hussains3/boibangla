
var newsletterSubscribersList = null;

$('#emailFilter').on('keyup', function () {
    newsletterSubscribersList.draw();
});


$(document).ready(function () {
    let urlPath = 'newsletters/subscribers/list';
    newsletterSubscribersList =  $('#newsletter-subscribers-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.emailFilter = $('#emailFilter').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "email" },
            {
                data: null,
                render: function (data) {
                    if (data.status == 1){
                        var statusLabels = '<span  class="badge isActive"> Active </span>';
                    }else{
                        var statusLabels = '<span  class="badge isInActive"> In-Active </span>';
                    }
                    return statusLabels;
                }
            },
            {
                data: null,
                render: function (data) {
                    var actionButtons = '<button type="button" onclick="activateDeactivateNewsletter('+data.id+','+data.status+');" title="Change Status" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-refresh"></i> </button>';
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

function activateDeactivateNewsletter(id,status) {
    var message = ((status == 0?"activate":"de-activate"));
    var updateStatus = ((status == 0?1:0));
    Swal.fire({
        title: " "+message+"?",
        text: "Do you want to "+message+" this newsletter ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'newsletters/change-status',
                data: {
                    id: id,
                    status: updateStatus,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        newsletterSubscribersList.draw();
                    }
                }
            });
        }
    });
}
