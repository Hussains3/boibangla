
var publicationList = null;
$('#publicationNameSearch').on('keyup', function () {
    publicationList.draw();
});

$('#publicationStatus').on('change', function () {
    publicationList.draw();
});

$(document).ready(function () {
    let urlPath = 'publications/list';

    publicationList =  $('#publication-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":true,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.publicationStatus = $("#publicationStatus").val();
                d.publicationNameSearch = $('#publicationNameSearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            {  data: null,
                render: function (data) {
                    var publicationImageUrl = BASE_URL+'storage/uploads/publications/';
                    if (data.logo && data.logo !="null"){
                        return '<img src="'+publicationImageUrl+data.logo+'" width="50"/>';
                    }else{
                        return  '';
                    }
                }
            },

            { "data": "name" },
            { "data": "discount" },
            { "data": "description" },
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
                    var edit_button = '<button type="button" onclick="editPublisher('+data.id+',\''+data.discount+'\',\''+data.name+'\',\''+data.slug+'\',\''+data.description+'\',\''+data.logo+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> </button>'+
                        '<button type="button" onclick="deletePublisher('+data.id+',\''+data.logo+'\');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i></button>'+
                        '<button type="button" onclick="activateDeactivatePublisher('+data.id+','+data.status+');" title="Change Status" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-refresh"></i> </button>';
                    return edit_button;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [2,5,6],
            'orderable': false
        }],

    });
});


function editPublisher(publicationId,discount,publicationName,slug,description,logo) {
    $("#editId").val(publicationId);
    $("#publicationName").val(publicationName);
    $("#publicationSlug").val(slug);
    $("#prePublisherLogo").val(logo);
    $("#discount").val(discount);
    $("#description").val(description);
    hideErrorMessages();
    $("#addEditPublicationModal").modal('show');
}

function deletePublisher(publicationId,logo) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this publication!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'publications/delete',
                data: {
                    publicationId: publicationId,
                    logo: logo
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        publicationList.draw();
                    }else if (response.status == "error"){
                        Swal.fire("Can't be deleted ", response.message, 'error');
                    }
                }
            });
        }
    });
}


function activateDeactivatePublisher(publicationId,status) {
    var message = ((status == 1?"Activate":"De-activate"));
    var updateStatus = ((status == 1?2:1));
    Swal.fire({
        title: " "+message+"?",
        text: "Do you want to "+message+" this publication ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'publications/change-status',
                data: {
                    publicationId: publicationId,
                    updateStatus: updateStatus,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        publicationList.draw();
                    }
                }
            });
        }
    });
}
