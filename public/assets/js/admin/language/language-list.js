
var languageList = null;


$('#languageSearch').on('keyup', function () {
    languageList.draw();
});

$(document).ready(function () {
    let urlPath = 'languages/list';
    languageList =  $('#language-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.languageSearch = $('#languageSearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "id" },
            { "data": "name" },
            { "data": "code" },
            {
                data: null,
                render: function (data) {
                    var edit_button = '<button type="button" onclick="editLanguage('+data.id+',\''+data.name+'\',\''+data.code+'\');" class="btn btn-success btn-sm" role="button" aria-pressed="true"><i class="fa fa-pencil"></i> </button>';
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


function editLanguage(languageId,languageName,code) {
    $("#editId").val(languageId);
    $("#name").val(languageName);
    $("#code").val(code);
    hideErrorMessages();
    $("#addEditLanguageModal").modal('show');
}
