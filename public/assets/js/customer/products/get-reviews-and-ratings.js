
$(document).ready(function () {
    let productId = $("#productId").val();
    getReviews(productId);
});

/**
 * This function loads the reviews for the product
 * @param productId
 */
function getReviews(productId) {
    $.ajax({
        type: 'GET',
        url:BASE_URL+'product/reviews',
        data:{productId:productId},
        success: function (response) {
            let produuctReviews = ``;
            if (response.status == "success"){
                if (response.data){
                    $.each(response.data,function (responseKey,responseValue) {
                        var ratingPercentage = responseValue.rating/5*100;
                        let reviewPicHtml = ``;
                        let userPic = responseValue.profile_pic;
                        if (responseValue.review_pictures){
                            let reviewPictures = responseValue.review_pictures.split(',');
                            reviewPicHtml += `<ul style="list-style: none;" class="review-pictures"><li>`;
                            $.each(reviewPictures,function (pictureKey,picture) {
                                let reviewPicUrl = BASE_URL + 'storage/uploads/products-reviews/'+ picture ;
                                reviewPicHtml += `<a href="javaScript:void(0);" onclick="zoomReviewImage('`+reviewPicUrl+`');"><img src="`+reviewPicUrl+`" class="img-responsive pl-2" width="150" /></a>`;
                            });
                            reviewPicHtml += `</li></ul>`;
                        }
                        produuctReviews += `<li>
                                        <div class="comment_img">
                                            <img src="${userPic}" width="50" alt="user1"/>
                                        </div>
                                        <div class="comment_block" style="padding-left: 90px !important;">
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:`+ratingPercentage+`%"></div>
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author">`+responseValue.first_name+` `+responseValue.last_name+ `</span>
                                                <span class="comment-date">`+responseValue.review_date+`</span>
                                            </p>

                                            <div class="description">
                                                <p>`+responseValue.remark+`</p>
                                            </div>
                                           `+reviewPicHtml+`
                                        </div>
                                    </li>`;
                    });
                    $(".rating_num").text(`(`+response.data.length+`)`);
                    $("#product-reviews").html(produuctReviews);
                }
            }
        },
        error:function(errorReponse){
            consoleError(errorReponse);
        },
        complete: function () {
           $("#reviews-loader").hide();
        }
    });
}

/**
 * This function shows the product review image
 * in a modal box
 * @param imageUrl
 */
function zoomReviewImage(imageUrl) {
    $("#zoomReviewImageModal").modal('show');
    $("#zoomReviewImageModal .modal-body").html('<img src="'+imageUrl+'"/>');
}
