/**
 * This block of code shows the selected picture file name
 */
$('#product_pictures').on('change',function(e){
    if ($('#product_pictures').val()){
        let fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    }
});


function rateProduct(orderId,productId) {
    $("#product_id").val(productId);
    $("#order_id").val(orderId);
    $("#rateProductModal").modal('show');
}

$("form#rateProductForm").on("submit",function (e) {
    e.preventDefault();
    if (validateRating()){
        $('.error').html("");
        $("#addReviewBtn").attr('disabled',true);
        $("#addReviewBtnLoader").removeClass('d-none');
        $.ajax({
            type: 'POST',
            url:BASE_URL+'customer/reviews/rate',
            //data:$("#rateProductForm").serialize(),

            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "success"){
                    toastr.success(response.message);
                }else if (response.status == 'already_rated'){
                    toastr.warning(response.message);
                }
                $("form#rateProductForm")[0].reset();
                $("#rateProductModal").modal('hide');
               window.location.reload();
            },
            error:function(errorResponse){
                //console.log(errorResponse);
                var errorHtml = '';
                var count = 0;
                var errors = errorResponse.responseJSON.errors;
                $.each(errors,function (key,value) {
                    if (count != 1){
                        $.each(value, function (key2,value2) {
                            errorHtml += '<i class="fa fa-info-circle"></i> '+getErrorMessage(value2)+'<br/>';
                        });
                    }
                    count++;
                });
                $('#product_picturesError').html(errorHtml);
            },
            complete: function () {
                $("#addReviewBtnLoader").addClass('d-none');
                $("#addReviewBtn").attr('disabled',false);
            }
        });
    }else {
        console.log("Some error");
    }
});

function validateRating() {
    hideErrorMessages();
    var isValidated = true;
    var rating = $("input[name='rating']:checked").val();
    var review = $("#review").val();

    if (!rating){
        isValidated = false;
        createErrorMessages('Please select rating','ratingError');
    }else if (review == ''){
        isValidated = false;
        createErrorMessages('Please enter some review','reviewError');
    }else {
        return isValidated;
    }
}
