$(document).ready(function () {
    getRelatedProducts();
});

function getRelatedProducts() {
    var productId = $("#productId").val();
    var productTypeDiv = "featured_product_items";
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'product/related/'+productId,
        data:{},
        success: function (response) {
            if (response.status == 'success') {
                var newAndFeaturedItems = '';
                newAndFeaturedItems += '<div id="'+productTypeDiv+'" class="product_slider carousel_slider owl-carousel owl-theme dot_style1">';
                $.each(response.data, function (key2, value2) {
                    var productDetailUrl = BASE_URL + 'product/' + value2.product_slug;
                    var priceBox = '';
                    if (value2.sale_price) {
                        priceBox += '<span class="price">৳' + value2.sale_price + '</span><br/><del>৳' + value2.regular_price + '</del>';
                        priceBox += ' <div class="on_sale"><span>' + ((( value2.regular_price - value2.sale_price )/ value2.regular_price) * 100).toFixed(2) + '% Off</span></div>';
                    } else {
                        priceBox += '<span class="price">৳' + value2.regular_price + '</span>';
                    }
                    var priceForCart = ((value2.sale_price?value2.sale_price:value2.regular_price));
                    var randomBtnId = makeid(6);
                    var rating = getRatingPercenatge(value2.average_rating);
                    var total_reviews = value2.total_reviews;

                    newAndFeaturedItems += '<div class="item">' +
                        '                            <div class="product_wrap">' +
                        '                                <div class="product_img" onclick="openProduct(`'+productDetailUrl+'`);" style="cursor:pointer">' +
                        '                                    <a href="'+productDetailUrl+'">' +
                        '                                        <img src="'+BASE_URL+'storage/uploads/products/'+value2.product_image+'" width="540" alt="el_img2">' +
                        '                                        <img class="product_hover_img" src="'+BASE_URL+'storage/uploads/products/'+((value2.product_image_1?value2.product_image_1:value2.product_image))+'" alt="el_hover_img2">' +
                        '                                    </a>' +
                        '                                    <div class="product_action_box">' +
                        '                                        <ul class="list_none pr_action_btn">'+
                        '                                            <li class="add-to-cart"><a href="javaScript:void(0);" data-spinner-id="'+randomBtnId+'" onclick="addToCart(this);" data-product-id="'+value2.id+'" data-product-name="'+value2.product_name+'" data-product-price="'+priceForCart+'" data-product-qty="1" data-product-image="'+value2.product_image+'"><i class="icon-basket-loaded"></i> Add To Cart</a></li>' +
                        '                                        </ul>' +
                        '                                    </div>' +
                        '                                </div>' +
                        '                                <div class="product_info">' +
                        '                                    <h6 class="product_title"><a href="'+productDetailUrl+'">'+value2.product_name+'</a></h6>' +
                        '                                    <div class="product_price">'+priceBox+'</div>' +
                        '                                    <div class="rating_wrap mt-4" style="height: 40px;">' +
                        '                                        <div class="rating">' +
                        '                                            <div class="product_rate" style="width:'+rating+'%"></div>' +
                        '                                        </div>' +
                        '                                        <span class="rating_num">('+total_reviews+')</span>\n' +
                        '                                    </div>' +
                        '                                    <div class="add-to-cart">' +
                        '                                        <a href="javaScript:void(0);" data-spinner-id="'+randomBtnId+'" onclick="addToCart(this);" data-product-id="'+value2.id+'" data-product-name="'+value2.product_name+'" data-product-price="'+priceForCart+'" data-product-qty="1" data-product-image="'+value2.product_image+'" class="btn btn-sm btn-fill-out btn-radius add-crt"><i class="icon-basket-loaded"></i>Add To Cart  <div id="addToCartSpinner'+randomBtnId+'" class="spinner-border spinner-border-sm d-none" role="status"><span class="sr-only"> Loading... </span></div></a>' +
                        '                                    </div>' +
                        '                                </div>' +
                        '                            </div>' +
                        '                        </div>';

                });
                newAndFeaturedItems += '</div>';
                $('#related-products').html(newAndFeaturedItems);
                $('#'+productTypeDiv).owlCarousel({
                    navigation : true, // Show next and prev buttons
                    loop:true,
                    margin:10,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:2,
                            nav:true,
                            loop:false,
                            rewind: true
                        },
                        600:{
                            items:3,
                            nav:false,
                            loop:false,
                            rewind: true

                        },
                        1000:{
                            items:4,
                            nav:false,
                            loop:false,
                            rewind: true
                        }
                    }
                });
            }
        }
    });
}
