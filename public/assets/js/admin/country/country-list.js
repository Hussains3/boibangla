
$('#countrySearch').on('keyup', function () {
    countryList.draw();
});

$(document).ready(function () {
    let urlPath = 'countries/list';
    countryList =  $('#country-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.countryStatus = (($('#countryStatus').val()?$('#countryStatus').val():1));
                d.navigationStatus = $('#navigationStatus').val();
                d.countrySearch = $('#countrySearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            { "data": "name" },
            { "data": "shortname" },
            { "data": "phonecode" },
            {
                data: null,
                render: function (data) {
                    var edit_button = '<button type="button" onclick="editCountry('+data.id+',\''+data.name+'\',\''+data.shortname+'\',\''+data.phonecode+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> </button>'+
                        '<button type="button" onclick="deleteCountry('+data.id+');" class="btn btn-danger btn-sm" role="button" aria-pressed="true"><i class="fa fa-trash"></i> </button>';
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


function editCountry(countryId,countryName,shortname,phonecode) {
    $("#editId").val(countryId);
    $("#country").val(countryName);
    $("#shortname").val(shortname);
    $("#code").val(phonecode);
    hideErrorMessages();
    $("#addEditCountryModal").modal('show');
}

function deleteCountry(countryId,countryImg) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this country!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'countries/delete',
                data: {
                    countryId: countryId,
                    countryImg: countryImg
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        countryList.draw();
                    }
                }
            });
        }
    });
}
