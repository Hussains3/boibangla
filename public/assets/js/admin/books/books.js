/**
 * This block of code is just to set the
 * placeholders for select statements
 */
$(function () {
    $("#bookCategory").select2({
        placeholder: {
            text: "Select"
        }
    });
    $("#bookSubCategory").select2({
        placeholder: {
            text: "Select"
        }
    });
    $("#bookpublication").select2({
        placeholder: {
            text: "Select"
        }
    });
    $("#bookCountry").select2({
        placeholder: {
            text: "Select"
        }
    });
    $("#bookLanguage").select2({
        placeholder: {
            text: "Select"
        }
    });
    // $("#bookDisplay").select2({
    //     placeholder: {
    //         text: "Select"
    //     }
    // });
    $("#book_tags").select2({
        placeholder: {
            text: "Select"
        }
    });
    $("#bookauthor").select2({
        placeholder: {
            text: "Select"
        }
    });
});

/**
 * This block of code just show the generated
 * slug for the book
 */
// $("#bookName").on('change',function () {
//     var bookName = $("#bookName").val();
//     if (bookName){
//         $("#bookSlug").val(slugify(bookName));
//     }
// });

/**
 * This block of code finds the subcategories on
 * change of category dropdown
 */
$("#bookCategory").on('change',function () {
    var categories = $("#bookCategory").val();
    getSubCategories(categories);
});


/**
 * This block of code finds the books on
 * change of search
 */
$("#bookSearch").on('keyup',function () {
    var search = $("#bookSearch").val();
    if (search){
        getSearchedBooks(search);
        $(".search-dropdown").css('display', 'block');
    }else{
        $(".search-dropdown").css('display', 'none');
    }
});


/**
 * This block of code just put the
 * dropdown values selected in case of edit
 */
$(function () {
    if ($("#editId").val()){
        $("#loader").show();
        var categories = $("#editCategoryIds").val();
       var publicationIds = $("#publicationIds").val();
        var bookDisplayIds = $("#bookDisplayIds").val();
        var taggedIds = $("#taggedIds").val();
         setTimeout(function () {
             if (categories){
                 $("#bookCategory").val(categories.split(',')).trigger("change");
             }
            if (publicationIds){
                $("#bookpublication").val(publicationIds.split(',')).trigger("change");
            }
            if(taggedIds){
                $("#book_tags").val(taggedIds.split(',')).trigger("change");
            }
            if (bookDisplayIds){
                $("#bookDisplay").val(bookDisplayIds.split(',')).trigger("change");
            }
             $("#loader").hide();
        },2000);
    }
});


/**
 * This function is to get subcategories based on categoryId
 * @scope local
 * @param categories
 */
function getSubCategories(categories) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'common/get-sub-category',
        data: {
            category:categories
        },
        success: function (response) {
            var subCategoryHtml = '';
            if (response.status == "success") {
                var subCategories = response.data;
                $.each(subCategories,function (key,value) {
                    subCategoryHtml += '<option value="'+value.id+'">'+value.subcategory+'</option>';
                });
                $("#bookSubCategory").html(subCategoryHtml);
                if ($("#editId").val()) {
                   $("#bookSubCategory").val($("#editSubCategoryIds").val().split(','));
                   $('#bookSubCategory').trigger('change');
                }
            }
        }
    });
}


/**
 * This function is to get book  based on search
 * @scope local
 * @param search
 */
function getSearchedBooks (search) {

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'common/get-searched-book',
        data: {bookSearch : search},
        beforeSend:function(){
            $("#divLoader").css('display', 'block');
        },
        success: function (response) {
            if (response.data) {
                console.log('data paisi'+response.data);
            }
            $("#divLoader").css('display', 'none');
            console.log('got search response');
            console.log(response.data);
            var bookResult = '';
            if (response.status == "success") {

                var bookResults = response.data;
                $.each(bookResults,function (key,value) {
                    // bookResult += '<li value="'+value.id+'">'+value.book_name+'</li>';
                    bookResult += '<li><a class="search-list-book d-flex align-items-center" href="'+BASE_URL+'book/'+value.book_slug+'"><span class="cover"><img alt="'+value.book_name+'" class="owl-lazy backup_book_picture" src="'+BASE_URL+'storage/uploads/books/'+value.book_image+'" style="opacity: 1;margin-right: 20px;" width="30"></span>'+value.book_name+'</a></li>';
                });
                $("#resultsBooks").html(bookResult);
            }
        }
    });
}







/**
 * This block of code is to save books to database
 */
var requestMethod,requestApi;
$("form#addEditBookForm").on("submit",function (e) {
    e.preventDefault();
    var editId = $("#editId").val();
    if (editId){
        requestMethod = 'POST';
        requestApi = 'update';
    }else{
        requestMethod = 'POST';
        requestApi = 'create';
    }
    if (validateBookForm()){
        $("#loader").show();
        $.ajax({
            type: requestMethod,
            url: BASE_URL + 'books/'+requestApi,
            processData: false,
            contentType: false,
            data: new FormData(this),
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire('Success!', response.message, 'success').then(function () {
                        window.location.href = BASE_URL+'books';
                    });
                }
            },
            error: function (errroResponse) {
                printErrorMessage(errroResponse);
                scrollToTop();
            },
            complete: function () {
                $("#loader").hide();
                scrollToTop();
            }
        });
    }else{
        scrollToTop();
    }

});


/**
 * This function is to validate form before final submit
 * @returns {boolean}
 */
function validateBookForm() {
    var isValidated = true;
    // var bookSku = $("#bookSku").val();
    var bookName = $("#bookName").val();
    var regularPrice = $("#regularPrice").val();
    var salePrice = $("#salePrice").val();
    var bookSlug = $("#bookSlug").val();
    var stock = $("#bookStock").val();
    var bookpublication = $("#bookpublication").val();
    var bookauthor = $("#bookauthor").val();
    var bookIsbn = $("#bookIsbn").val();
    var shortPdf = $("#shortPdf").val();
    // var bookUnit = $("#bookUnit").val();
    // var bookImage = $("#bookImage").val();
    // var categories = $("#bookCategory").val();
    // var bookSubCategory = $("#bookSubCategory").val();
    // var description = $("#bookDescription").val();
    // var book_tags = $("#book_tags").val();
    // var bookDisplay = $("#bookDisplay").val();
    hideErrorMessages();


    // book name checking
    if (bookName == ""){
        $("#bookNameError").html("<i class='fa fa-info-circle'></i> Please enter book name");
        isValidated = false;
    }
    // book ISBN checking
    if (bookSlug == ""){
        $("#bookIsbnError").html("<i class='fa fa-info-circle'></i> Please enter ISBN name");
        isValidated = false;
    }

    // book regular price checking
    if (regularPrice == ""){
        $("#regularPriceError").html("<i class='fa fa-info-circle'></i> Please enter regular price");
        isValidated = false;
    }

    // book sale price checking
    if (salePrice == ""){
        $("#salePriceError").html("<i class='fa fa-info-circle'></i> Please enter sale price");
        isValidated = false;
    }

    // book slug check
    if (bookSlug == ""){
        $("#bookSlugError").html("<i class='fa fa-info-circle'></i> Please enter book slug");
        isValidated = false;
    }

    //book stock check
    if (stock == ""){
        $("#bookStockError").html("<i class='fa fa-info-circle'></i> Please enter stock");
        isValidated = false;
    }

    // book publication ckeck
    if (!bookpublication){
        $("#bookPublicationError").html("<i class='fa fa-info-circle'></i> Please select Publication");
        isValidated = false;
    }
    return isValidated;
}

/**
 * This function is to clear extra form values after successfully save
 * @scope local
 */
function clearFormValues(){
    $("#addEditBookForm")[0].reset();
    $("#bookCategory").val([]).trigger("change");
    $("#bookSubCategory").val([]).trigger("change");
    $("#bookDescription").val("");
    CKEDITOR.instances['additionalInfo'].setData("");
}

// ckeditor init for Short Description
// CKEDITOR.replace( 'bookDescription' );
// CKEDITOR.add;
// ckeditor init for Additonal Information
// CKEDITOR.replace( 'additionalInfo' );
// CKEDITOR.add;




