
$(document).ready(function () {
    let urlPath = 'roles/list';
    roleList =  $('#role-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.roleStatus = (($('#roleStatus').val()?$('#roleStatus').val():1));
                d.navigationStatus = $('#navigationStatus').val();
                d.roleSearch = $('#roleSearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            {
                data: null,
                render: function (data) {
                    var icon = '<i class="'+data.icon_class+'" style="font-size: 20px;"></i>';
                    return icon;
                }
            },
            { "data": "role_name" },
            { "data": "role_slug" },
            {
                data: null,
                render: function (data) {
                    if (data.navigation == '1'){
                        return 'YES';
                    }else{
                        return 'NO';
                    }
                }
            },
            {
                data: null,
                render: function (data) {
                    var edit_button = '<button type="button" onclick="editRole('+data.id+',\''+data.role_name+'\',\''+data.description+'\',\''+data.roleImage+'\',\''+data.icon_class+'\',\''+data.navigation+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> </button>'+
                        '<button type="button" onclick="deleteRole('+data.id+',\''+data.roleImage+'\');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> </button>';
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


function editRole(roleId,roleName,roleDescription,roleImage,icon_class,navigation) {
    $("#editId").val(roleId);
    $("#role").val(roleName);
    $("#description").val(roleDescription);
    $("#roleIcon").selectpicker('val',icon_class);
    $("#preRoleImage").val(roleImage);
    $("#navigation").val(navigation);
    hideErrorMessages();
    $("#addEditRoleModal").modal('show');
}

function deleteRole(roleId,roleImg) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this role!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'roles/delete',
                data: {
                    roleId: roleId,
                    roleImg: roleImg
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        roleList.draw();
                    }
                }
            });
        }
    });
}
