
function showSubCategory(args) {
    $(args).parent().parent().next().toggleClass('sub-category-filter');
}
$(document).ready(function(){
    getSearchedProducts();
});

$("#default_filter").on('change',function () {
    getSearchedProducts();
});
$("#rating_filter").on('change',function () {
    getSearchedProducts();
});

function getSearchedProducts() {
    var search_query = $("#search_query_string").val();
    var default_filter = $("#default_filter").val();
    var rating_filter = $("#rating_filter").val();
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'products/searched'+'/'+search_query,
        data: {
            default_filter:default_filter,
            rating_filter:rating_filter,
        },
        beforeSend:function(){
            $("#loader").show() ;
        },
        success: function (response) {
            var searchedProducts = ``;
            if (response.status == 'success') {
                $.each(response.data,function (key,value) {
                    var productDetailUrl = BASE_URL + 'product/' + value.product_slug;
                    console.log(productDetailUrl);
                    var priceBox = '';
                    if (value.sale_price) {
                        priceBox += '<span class="price">' + value.sale_price + '</span><del>$' + value.regular_price + '</del>';
                        priceBox += ' <div class="on_sale"><span>' + ((value.sale_price / value.regular_price) * 100).toFixed(2) + '% Off</span></div>';
                    } else {
                        priceBox += '<span class="price">' + value.regular_price + '</span>';
                    }
                    var priceForCart = ((value.sale_price?value.sale_price:value.regular_price));
                    var randomBtnId = makeid(6);
                    var rating = value.average_rating/5*100;
                    var total_reviews = value.total_reviews;

                    searchedProducts += ` <div class="col-md-4 col-6">
                                <div class="item">
                                    <div class="product_wrap">
                                        <div class="product_img">
                                            <a href="`+productDetailUrl+`">
                                                <img src="`+BASE_URL+'storage/uploads/products/'+value.product_image+`" width="540" alt="el_img2">                                 
                                               <img class="product_hover_img" src="`+BASE_URL+'storage/uploads/products/'+((value.product_image_1?value.product_image_1:value.product_image))+`" alt="el_hover_img2">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart"><a href="javaScript:void(0);" data-spinner-id="`+randomBtnId+`" onclick="addToCart(this);" data-product-id="`+value.id+`" data-product-name="`+value.product_name+`" data-product-price="`+priceForCart+`" data-product-qty="1" data-product-image="`+value.product_image+`" ><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="`+productDetailUrl+`">`+value.product_name+`</a></h6>
                                            <div class="product_price">`+priceBox+`</div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:`+rating+`%"></div>
                                                </div>
                                                <span class="rating_num">(`+total_reviews+`)</span>
                                            </div>
                                            <div class="add-to-cart space-add-to-cart" align="center">
                                                <a href="javaScript:void(0);" data-spinner-id="`+randomBtnId+`" onclick="addToCart(this);" data-product-id="`+value.id+`" data-product-name="`+value.product_name+`" data-product-price="`+priceForCart+`" data-product-qty="1" data-product-image="`+value.product_image+`" class="btn btn-sm btn-fill-out btn-radius add-crt"><i class="icon-basket-loaded"></i>Add To Cart  <div id="addToCartSpinner`+randomBtnId+`" class="spinner-border spinner-border-sm d-none" role="status"><span class="sr-only"> Loading... </span></div></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                });
                $("#searched_products").html(searchedProducts);

            }
        },
        complete:function () {
            $("#loader").hide() ;
        }
    });
}

