
var bannerList = null;

$('#banner_filter').change('keyup', function () {
    bannerList.draw();
});


$(document).ready(function () {
    let urlPath = 'media/banner/list';
    bannerList =  $('#banner-image-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.banner_filter = $('#banner_filter').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "file" },
            {
                "data": null,
                render: function (data) {
                    let bannerUrl = BASE_URL+'storage/uploads/media/'+data.file;
                    return `<a href="`+bannerUrl+`" target="_blank"><img src="`+bannerUrl+`" width="100"/></a>`;
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
                    var actionButtons;
                    actionButtons = '<button type="button" onclick="statusBanner('+data.id+','+data.status+');" title="Change Status" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-refresh"></i> </button>' +
                        '<button type="button" onclick="editBanner('+data.id+');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i></button>'+
                        '<button type="button" onclick="deleteBanner('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></button>';
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


function editBanner(bannerId) {
    $.ajax({
        method: 'GET',
        url: BASE_URL +'media/banner/info',
        data: {
            bannerId: bannerId,
        },
        success: function (response) {
            let banner = response.banner.data;
            console.log(banner);
            $("#editId").val(bannerId);
            $("#title").val(banner.title);
            $("#sub_title").val(banner.sub_title);
            $("#button_label").val(banner.button_label);
            $("#button_link").val(banner.button_link);
            $("#pre_file").val(response.banner.file);
            $("#addEditBannerModal").modal('show');

        }
    });

}

function deleteBanner(bannerId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this banner!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'media/banner/delete',
                data: {
                    bannerId: bannerId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        bannerList.draw();
                    }
                }
            });
        }
    });
}
function statusBanner(bannerId,status) {
    var message = ((status == 1?"activate":"de-activate"));
    var updateStatus = ((status == 2?1:2));
    Swal.fire({
        title: " "+message+"?",
        text: "Do you want to "+message+" this banner!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'PATCH',
                url: BASE_URL +'media/banner/change-status',
                data: {
                    bannerId: bannerId,
                    updateStatus: updateStatus,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        bannerList.draw();
                    }
                }
            });
        }
    });
}

