
var discountList = null;

$('#discountNameSearch').on('keyup', function () {
    discountList.draw();
});

$(document).ready(function () {
    let urlPath = 'discounts/list';
    discountList =  $('#discount-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.discountNameSearch = $('#discountNameSearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            { "data": "coupon_name" },
            { "data": "discount" },
            { "data": "description" },
            {
                data: null,
                render: function (data) {
                    var validity = '';
                    validity += data.start_date+' - '+ data.validity_date;
                    return validity;
                }
            },
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
                    var edit_button = '<button type="button" onclick="editDiscount('+data.id+');" title="Edit Discount" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i></button>'+
                        '<button type="button" onclick="deleteDiscount('+data.id+');" title="Delete Discount" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> </button>'+
                        '<button type="button" onclick="activateDeactivate('+data.id+','+data.status+');" title="Change Status" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-refresh"></i> </button>';
                    return edit_button;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [3,4,5,6,7],
            'orderable': false
        }],

    });
});


function editDiscount(discountId) {
    $.ajax({
        method: 'GET',
        url: BASE_URL +'discounts/info',
        data: {
            discountId: discountId,
        },
        success: function (response) {
            if (response.status) {
               $("#addEditDiscountModal").modal('show');
               $("#editId").val(response.data.id);
               $("#couponName").val(response.data.coupon_name);
               $("#discount").val(response.data.discount);
               $("#description").val(response.data.description);
               $("#startDate").val(response.data.start_date);
               $("#validityDate").val(response.data.validity_date);
            }
        }
    });
}

function deleteDiscount(discountId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this discount!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'discounts/delete',
                data: {
                    discountId: discountId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        discountList.draw();
                    }
                }
            });
        }
    });
}

function activateDeactivate(discountId,status) {
    var message = ((status == 1?"De-activate":"Activate"));
    var updateStatus = ((status == 1?2:1));
    Swal.fire({
        title: " "+message+"?",
        text: "Do you want to "+message+" this discount!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'discounts/change-status',
                data: {
                    discountId: discountId,
                    updateStatus: updateStatus,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        discountList.draw();
                    }
                }
            });
        }
    });
}
