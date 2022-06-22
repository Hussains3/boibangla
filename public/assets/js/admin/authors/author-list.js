
$('#authorSearch').on('keyup', function () {
    authorList.draw();
});

$(document).ready(function () {
    let urlPath = 'authors/list';
    authorList =  $('#author-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.authorSearch = $('#authorSearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            {  data: null,
                render: function (data) {
                    var authorImageUrl = BASE_URL+'storage/uploads/authorUpload/';
                    if (data.pimage && data.pimage !="null"){
                        return '<img src="'+authorImageUrl+data.pimage+'" width="50"/>';
                    }else{
                        return  '';
                    }
                }
            },
            { "data": "name" },
            { "data": "slug" },
            { "data": "discount" },
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
                    var edit_button = '<button type="button" onclick="editAuthor('+data.id+',\''+data.discount+'\',\''+data.name+'\',\''+data.description+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> </button>'+
                    '<button type="button" onclick="activateDeactivateAuthor('+data.id+','+data.status+');" title="Change Status" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-refresh"></i> </button>';
                    return edit_button;
                }
            }
        ],
        'columnDefs': [ {
            'targets': "no-sort",
            'orderable': false
        }],
    });
});


function editAuthor(authorId,discount,name,description) {
    $("#editId").val(authorId);
    $("#name").val(name);
    $("#description").val(description);
    $("#discount").val(discount);
    hideErrorMessages();
    $("#addEditAuthorModal").modal('show');
}


function activateDeactivateAuthor(authorID,status) {
    var message = ((status == 1?"De-activate":"Activate"));
    var updateStatus = ((status == 1?2:1));
    Swal.fire({
        title: " "+message+"?",
        text: "Do you want to "+message+" this athor ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'POST',
                url: BASE_URL +'authors/change-status',
                data: {
                    authorID: authorID,
                    updateStatus: updateStatus,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        authorList.draw();
                    }
                }
            });
        }
    });
}


// Delete Author
function deleteAuthor(authorId,authorImg) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this author!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'authors/delete',
                data: {
                    authorId: authorId,
                    authorImg: authorImg
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        authorList.draw();
                    }
                }
            });
        }
    });
}
