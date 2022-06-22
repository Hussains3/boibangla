
var bookList = null;

$('#bookSearch').on('keyup', function () {
    bookList.draw();
});

$(document).ready(function () {
    let urlPath = 'books/list';
    bookList =  $('#book-table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching":false,
        buttons: [
            {
                extend: 'print',
                text: 'Print current page',
                autoPrint: false
            }
        ],
        ajax: {
            url: BASE_URL+urlPath,
            data: function (d) {
                d.bookSearch = $('#bookSearch').val();
            }
        },
        "columns": [
            {  data : 'DT_RowIndex', name: 'DT_RowIndex'},
            { "data": "book_name" },
            { "data": "sku" },
            {
                data: null,
                render: function (data) {
                    return `৳ ` + data.regular_price;
                }
            },
            {
                data: null,
                render: function (data) {
                    return `৳ ` + data.sale_price;
                }
            },
            { "data": "stock" },
            {
                data: null,
                render: function (data) {
                    if (data.stock > 0){
                        var stockStatus = '<span  class="badge in-stock"> In-Stock </span>';
                    }else{
                        var stockStatus = '<span  class="badge out-of-stock">Out of Stock</span>';
                    }
                    return stockStatus;
                }
            },
            { "data": "unit" },
            { "data": "average_rating" },
            {
                data: null,
                render: function (data) {
                    let bookInfoUrl = BASE_URL+'books/info/'+data.id
                    return `<a href="${BASE_URL}books/edit/${data.id}" class="btn btn-success btn-sm"  aria-pressed="true"><i class="fa fa-pencil"></i></a>
                        <button type="button"  class="btn btn-danger btn-sm" onclick="deletebook(${data.id});" aria-pressed="true"><i class="fa fa-trash"></i></button>
                        <a href="${bookInfoUrl}" target="_blank" class="btn btn-warning btn-sm"  ><i class="fa fa-eye"></i></a>
                        <a href="${BASE_URL}books/${data.id}/reviews" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-star"></i></a>`;
                }
            }
        ],
        'columnDefs': [ {
            'targets': [6,9],
            'orderable': false
        }],

    });
});



function deletebook(bookId) {
    Swal.fire({
        title: "Delete ?",
        text: "Are you sure to delete this book ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: 'DELETE',
                url: BASE_URL +'books/delete',
                data: {
                    bookId: bookId,
                },
                success: function (response) {
                    if (response.status == "success") {
                        Swal.fire('Success!', response.message, 'success');
                        bookList.draw();
                    }else if(response.status == "error"){
                        Swal.fire('This item is not deletable!', response.message, 'error');
                        bookList.draw();
                    }
                }
            });
        }
    });
}

/*

function getBookDetailedInfo(bookId,description,additionalInfo,book_image,book_image_1,book_image_2) {
    $.ajax({
        method: 'GET',
        url: BASE_URL +'admin/books/get-book-detail-info',
        data: {
            bookId: bookId,
        },
        success: function (response) {
            var categoriesHtml = '';
            var subCategoriesHtml = '';
            var bookImageUrl = BASE_URL+'storage/uploads/books/';
            var sr = 1;
            if (response.status == "success") {
                $.each(response.data.categories,function (key,value) {
                    categoriesHtml += '<tr><td>'+sr+'</td><td>'+value.category+'</td></tr>';
                    sr++;
                });
                $.each(response.data.subCategories,function (key2,value2) {
                    subCategoriesHtml += '<tr><td>'+sr+'</td><td>'+value2.subcategory+'</td></tr>';
                    sr++;
                });
                $("#book_info_categories").html(categoriesHtml);
                $("#book_info_sub_categories").html(subCategoriesHtml);
                if (description){
                    $("#description_content").html(description);
                }if (additionalInfo){
                    $("#other_info_content").html(additionalInfo);
                }
                $("#bookImgLabel").html('<img src="'+bookImageUrl+book_image+'" width="50"/>');
                if (book_image_1 && book_image_1 !="null"){
                    $("#bookImg1Label").html('<img src="'+bookImageUrl+book_image_1+'" width="50"/>');
                }
                if (book_image_2 && book_image_2 !="null"){
                    $("#bookImg2Label").html('<img src="'+bookImageUrl+book_image_2+'" width="50"/>');
                }

            }
        }
    });
    $("#bookInfoModal").modal('show');
}
*/

function showUploadBookModal() {
    $("#uploadBookModal").modal('show');
}

$("form#uploadBookForm").on("submit",function (e) {
    e.preventDefault();
    if (validateBulkUpload()) {
        $.ajax({
            url: BASE_URL + 'admin/books/upload',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                hideErrorMessages();
                $("#loader").show();
            },
            success: function (response) {
                if (response.status == 'success') {
                    Swal.fire('Success!', response.message, 'success');
                    bookList.draw();
                }
            },
            error: function (errorResponse) {
                console.log(errorResponse);
                printErrorMessage(errorResponse);
            },
            complete: function () {
                $("#loader").hide();
                $("#uploadBookModal").modal('hide');
            }
        });
    }

});

/**
 * This function validates the image/logo upload
 */
function validateFileUpload() {
    if ($("#book_file").val()){
        let errorMessage = '';
        let extension = $("#book_file").val().substr( ($("#book_file").val().lastIndexOf('.') +1) );
        extension = extension.toLocaleLowerCase();
        let arrayExtensions = ["csv"];

        if (arrayExtensions.lastIndexOf(extension) == -1) {
            errorMessage = 'Only CSV files are allowed';
            $("#book_file").val('');
        }
        $("#book_fileError").text(errorMessage);
    }else{
        $("#book_fileError").text("");
    }
}

/**
 * This function prepares the form data
 * with file attributes
 * @returns {FormData}
 */
function prepareFormData(formId,fileId,bookImagesId) {
    var form = $('#'+formId);
    var params = form.serializeArray();
    var files = $('#'+fileId)[0].files[0];
    var formData = new FormData();
    if (files){
        var fileName = $('#'+fileId).attr('name');
        formData.append(fileName, files);
    }
    $(params).each(function (index, element) {
        formData.append(element.name, element.value);
    });
    return formData;
}

function validateBulkUpload() {
    var isValidated = true;
    var book_file = $("#book_file").val();
    var book_images = $("#book_images").val();
    if (book_file == ""){
        $("#book_fileError").html("Please select CSV file");
        isValidated = false;
    }if (book_images == ""){
        $("#book_imagesError").html("Please select book images");
        isValidated = false;
    }
    return isValidated;
}
