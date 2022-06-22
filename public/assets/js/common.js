
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function printErrorMessage(errorResponse) {
    var errors = errorResponse.responseJSON.errors;
    hideErrorMessages();
    $.each(errors,function (key,value) {
        var errorHtml = '';
        $.each(value, function (key2,value2) {
            errorHtml += '<i class="fa fa-info-circle"></i> '+value2+'<br/>';
        });
        if (key){
            $('#'+key+'Error').html(errorHtml);
            $('#'+key+'Error').focus();
        }
    });
}

function consoleError(errorResponse) {
    var errors = errorResponse.responseJSON.errors;
    console.log(errors);
}

function enableSubmitButton(buttonId) {
    $("#"+buttonId).attr('disabled',false);
}

function hideErrorMessages() {
    $('.error').html("");
}

function createErrorMessages(message,div) {
    $('#'+div).html('<i class="fa fa-info-circle"></i> ' + message);
}

function scrollToTop() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
}
// function scrollToTopCutomer() {
//     document.getElementById('shop_cart_table_section').scrollIntoView({behavior: "smooth"});
// }

/**
 * This function is to make product slug
 * @scope local
 * @param string
 * @returns {string}
 */
function slugify(string){
    return string
        .toString()
        .trim()
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-")
        .replace(/^-+/, "")
        .replace(/-+$/, "");
}

function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

/*$("form#searchProductForm").on('submit',function (e) {
    e.preventDefault();
    var search_category = $("#search_category").val();
    var search_query = $("#search_query").val();
    var searchUrl = BASE_URL+'products/search'+'/'+search_query;
    window.location.href = searchUrl;
});*/

/**
 * This block of code is to search the product items
 * from search box
 */
$( document ).ready(function() {
    $('#search_query').select2({
        placeholder: "Search product by name or SKU",
        ajax: {
            url: BASE_URL+"search/products",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            text: item.product_name,
                            id: item.id,
                            slug:item.product_slug,
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('#search_query').on('select2:select', function (e) {
        var data = e.params.data;
        var slug = data.slug;
        window.location.href = BASE_URL+'product/'+slug;
    });



});


function getRatingPercenatge(averageRating) {
    var percetage = 0;
    if (averageRating && averageRating !='null'){
        percetage = averageRating/5*100;
    }
    return percetage;
}

function openProduct(url){
    window.location.href = url;
}

/**
 * This function hides/shows the password to text and vise-versa
 * @param passwordElement
 */
function togglePassword(passwordElement) {
    passwordElement = $('#'+passwordElement);
    if(passwordElement.attr("type") == "text"){
        passwordElement.attr('type', 'password');
        passwordElement.next().find('span i').addClass( "fa-eye-slash" );
        passwordElement.next().find('span i').removeClass( "fa-eye" );
    }else if(passwordElement.attr("type") == "password"){
        passwordElement.attr('type', 'text');
        passwordElement.next().find('span i').removeClass( "fa-eye-slash" );
        passwordElement.next().find('span i').addClass( "fa-eye" );
    }
}


/**
 * print error msgs
 * @param Object errorObject
 */
function printValidationErrorMsg(errorObject, validator) {
    if (errorObject.status == 422) {
        validator.showErrors(errorObject.responseJSON.errors);
    }
}



/*========================================================================================
                                    VALIDATION CODE
     ========================================================================================*/

function validateEmail(inputText) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.match(mailformat)) {
        return true;
    } else{
        return false;
    }
}

function validatePhoneNumber(inputtxt) {
    var phonenoPattern = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
    if( inputtxt.match(phonenoPattern) ) {
        return true;
    }
    else {
        return false;
    }
}

function validateAadharNumber(aadhar){
    if(/^[0-9]+$/.test(aadhar) && aadhar.length == 12){
        return true;
    }else{
        return false;
    }

}
/**
 * This function sanitise the server side error message in readable form
 * @param message
 * @returns {*}
 */
function getErrorMessage(message) {
    return message.replace(/[0-9,._]+/g, " ");
}
