
$(document).ready(function () {
    getCart();
});

function getCart() {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'cart/get-cart',
        data: {},
        success: function (response) {
            if (response.status == 'success'){

                var myCart = ``;
                if (response.data.items_count>0){

                    myCart += `<table class="table w-100">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Book</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-slug">Slug</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody id="my_cart_table_body">`;

                    $.each(response.data.items,function (key,value) {
                        var productName = value.name;
                        productName = productName.substring(0, 50) + ((productName > 50 ? " &..." : ""));
                        var productImage = BASE_URL + 'storage/uploads/products/' + value.attributes.image;
                        var productPrice = value.price;
                        var productQty = value.quantity;
                        var total = productPrice*productQty;

                        myCart += ` <tr>
                                <td class="product-thumbnail p-1"><a href="#"><img src="`+productImage+`" alt="product1"></a></td>
                                <td class="product-name" data-title="Product">`+productName+`</td>
                                <td class="product-price" data-title="Price">$`+productPrice+`</td>
                                <td class="product-quantity" data-title="Quantity">
                                     <div class="quantity">
                                        <input type="button" onclick="decreaseQty(`+value.id+`);" value="-" class="minus">
                                        <input type="text" name="cart_quantity`+value.id+`" id="cart_quantity`+value.id+`" readonly value="`+productQty+`" title="Qty" class="qty input" size="4">
                                        <input type="button" onclick="increaseQty(`+value.id+`);" value="+" class="plus">
                                    </div>
                                </td>
                                <td class="product-subtotal" data-title="Total">$`+total+`</td>
                                <td class="product-remove" data-title="Remove"><a href="javaScript:void(0);" onclick="removeItem(`+value.id+`);"><i class="ti-close"></i></a></td>
                            </tr>`;
                    });
                    myCart += `</tbody>

                        </table>`;
                    $("#shop_cart_table_section").show();
                    $(".cart_sub_total_amount").text('$' + response.data.sub_total);
                    $(".cart_total_amount").text('$' + response.data.total);

                    var noofCouponCodeApplied = Object.keys(response.data.conditions).length;
                    if(noofCouponCodeApplied>0){

                        /* var couponName = Object.keys(response.data.conditions);
                         $.each(couponName,function (key,val) {

                         });*/
                        $(".coupon_applied_count").html('<strong>'+noofCouponCodeApplied+' Coupon Applied </strong>');
                        $("#couponApplied").show();
                    }else{
                        $("#couponApplied").hide();
                    }
                    $("#cart_table").html(myCart);

                }else{
                    $("#shop_cart_table_section").addClass('d-none');
                    $("#cart_empty_section").removeClass('d-none');
                }
                // for product detail page quantity increase option

                if (response.data.items_count !=0){
                    $(".cart-product-quantity").removeClass('d-none');
                }else{
                    $(".cart-product-quantity").addClass('d-none');
                }
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}


function applyCouponCode() {
    var couponCode = $("#couponCode").val();
    if (couponCode){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'cart/apply-coupon',
            data: {
                couponCode:couponCode,
            },
            success: function (response) {
                if (response.status == 'success') {
                    toastr.success(response.message);
                    $(".coupon-code-applied").show();
                    $(".coupon-code-error").hide();
                    $(".coupon-code-applied").html(response.message);

                }else if (response.status == 'error'){
                    $(".coupon-code-error").show();
                    $(".coupon-code-applied").hide();
                    $(".coupon-code-error").html(response.message);
                    toastr.warning(response.message)
                }
                setTimeout(function () {
                    $(".coupon-code-applied").hide();
                    $(".coupon-code-error").hide();
                },2000);
                $("#couponCode").val("");
                scrollToTopCutomer();
                getCart();
            },
        });
    }
}
