

$(document).ready(function () {
    getCart();
});

function addToCart(arg) {
    var cartModal = $("#myModal");
    var bookId = $(arg).attr('data-book-id');
    var bookName = $(arg).attr('data-book-name');
    var bookPrice = $(arg).attr('data-book-price');
    var bookQuantity = $(arg).attr('data-book-qty');
    var bookImage = $(arg).attr('data-book-image');
    var addToCartSpinnerId = $(arg).attr('data-spinner-id');
    $('#addToCartSpinner'+addToCartSpinnerId).removeClass('d-none');
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'cart/create-cart',
        data:{
            bookId:bookId,
            bookName:bookName,
            bookPrice:bookPrice,
            bookQuantity:bookQuantity,
            bookImage:bookImage,
        },
        success: function (response) {
            if (response.status == 'success'){
                toastr.success(response.message);
                getCart();
                cartModal.css('display','block');
            }
        },
        error:function (error) {
            console.log(error);
        },
        complete:function () {
            $('#addToCartSpinner'+addToCartSpinnerId).addClass('d-none');
        }
    });
}

function getCart() {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'cart/get-cart',
        data: {},
        success: function (response) {
            if (response.status == 'success'){

                setHomePageCartData(response);

                setCartPageData(response);

                setCheckoutPageData(response);

                // for book detail page quantity increase option

                if (response.data.items_count !=0){
                    var headerCartCount = $('#headerCartCount');
                    var mobileheaderCartCount = $('#mobileheaderCartCount');
                    var lblCartItems = $('#lblCartItems');
                    headerCartCount.html(response.data.items_count);
                    mobileheaderCartCount.html(response.data.items_count);
                    lblCartItems.html('('+response.data.items_count+' items)');
                    $(".cart-book-quantity").removeClass('d-none');
                }else{
                    $(".cart-book-quantity").addClass('d-none');
                }
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function removeItem(bookId) {
    if (confirm("Are you sure to remove this book from cart? Coupon will be reset(if applied),need to apply again  if you have")){
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'cart/remove-cart-item',
            data: {
                bookId: bookId,
            },
            success: function (response) {
                if (response.status == 'success') {
                    toastr.success(response.message);
                    // var id = '#cart_quantity'+bookId;

                    $('#cart_quantity'+bookId).val("1");
                    getCart();
                    location.reload();
                }
            },
        });
    }
}

function setHomePageCartData(response) {
    var cartDropDown = ``;
    if (response.data.items_count>0){
        $.each(response.data.items,function (key,value) {
            var bookName = value.name;
            bookName = bookName.substring(0, 30) + ((bookName > 30 ? " &..." : ""));
            var bookImage = BASE_URL+'storage/uploads/books/'+value.attributes.image;
            var bookPrice = value.price;
            var bookQty = value.quantity;
            cartDropDown += `<li>
                        <a href="javaScript:void(0);" onclick="removeItem(`+value.id+`);" class="item_remove"><i class="ion-close"></i></a>
                        <a href="#"><img src="`+bookImage+`" class="backup_book_picture" width="40" alt="cart_thumb1">`+bookName+`</a>
                        <span class="cart_quantity"> `+bookQty+` x <span class="cart_amount"> <span class="price_symbole">৳</span></span>`+bookPrice+`</span>
                    </li>`;
        });
        $(".cart_list").show();
        $(".cart_list").html(cartDropDown);
        $("#cartHasItems").show();
        $("#cart_empty").hide();
    }else{
        $("#cart_empty").show();
        $("#cartHasItems").hide();
        $(".cart_list").hide();
    }

    $(".cart_count").text(response.data.items_count);
    $(".cart_sub_total").text(response.data.sub_total);
    $(".cart_total_price").text(response.data.sub_total);
}

function setCartPageData(response) {
    var myCart = ``;
    if (response.data.items_count>0){

        myCart += `<table class="table w-100">
                            <thead>
                            <tr>
                                <th class="book-thumbnail">&nbsp;</th>
                                <th class="book-name">Product</th>
                                <th class="book-price">Price</th>
                                <th class="book-quantity">Quantity</th>
                                <th class="book-subtotal">Total</th>
                                <th class="book-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody id="my_cart_table_body">`;

        $.each(response.data.items,function (key,value) {
            var bookName = value.name;
            bookName = bookName.substring(0, 50) + ((bookName > 50 ? " &..." : ""));
            var bookImage = BASE_URL + 'storage/uploads/books/' + value.attributes.image;
            var bookPrice = value.price;
            var bookQty = value.quantity;
            var total = bookPrice*bookQty;
            var bookUrl = value.attributes.url;

            myCart += ` <tr>
                                <td class="book-thumbnail "><a href="#"><img src="`+bookImage+`" class="backup_book_picture" alt="book1" width="40"></a></td>
                                <td class="book-name" data-title="Product"><a href="${bookUrl}">`+bookName+`</a></td>
                                <td class="book-price" data-title="Price">৳`+bookPrice+`</td>
                                <td class="book-quantity" data-title="Quantity">
                                     <div class=" d-flex">
                                        <input type="button" onclick="decreaseQty(`+value.id+`);" value="-" class="minus btn-red-micro">
                                        <input type="text" name="cart_quantity`+value.id+`" id="cart_quantity`+value.id+`" readonly value="`+bookQty+`" title="Qty" class="qty qty-input" size="4">
                                        <input type="button" onclick="increaseQty(`+value.id+`);" value="+" class="plus btn-red-micro">
                                    </div>
                                </td>
                                <td class="book-subtotal" data-title="Total">৳`+total+`</td>
                                <td class="book-remove d-flex justify-content-end" data-title="Remove"><a class="btn-red" href="javaScript:void(0);" onclick="removeItem(`+value.id+`);">x</a></td>
                            </tr>`;
        });
        myCart += `</tbody>

                        </table>`;
        $("#shop_cart_table_section").show();
        $(".cart_sub_total_amount").text('৳' + response.data.sub_total);

        var noofCouponCodeApplied = Object.keys(response.data.conditions).length;
        if(noofCouponCodeApplied>0){
            let coponsAppliedText = ``;
            let discountAmount = 0;
            let coupons = response.data.conditions;
             var couponsApplied = Object.keys(coupons);
             $.each(couponsApplied,function (key,coupon) {
                 coponsAppliedText += coupon+',';
             });
            $.each(coupons,function (condition,conditionValue) {
                discountAmount = discountAmount + conditionValue.parsedRawValue;
            });
            coponsAppliedText = coponsAppliedText.replace(/,\s*$/, "");
            $(".coupon_applied_count").html('<strong>'+coponsAppliedText+' Coupon Applied with discount of ৳ '+discountAmount+'</strong>');
            $("#couponApplied").show();
        }else{
            $("#couponApplied").hide();
        }

        var deliveryCharge = 'Free';
        if (response.data.delivery_charge != null){
            deliveryCharge = '৳'+response.data.delivery_charge;
            $(".cart_total_amount").text('৳' + Math.round(response.data.total+parseFloat(response.data.delivery_charge)));
        }else{
            $(".cart_total_amount").text('৳' + Math.round(response.data.total));
        }
        $(".cart_shiping_charge").text(deliveryCharge);


        $("#cart_table").html(myCart);
    }else{
        $("#shop_cart_table_section").addClass('d-none');
        $("#cart_empty_section").removeClass('d-none');
    }
    $("#cart-loader").attr("style", "display: none !important");
}

function setCheckoutPageData(response) {
    var checkoutOrders = ``;
    var deliveryCharge = ``;
    var total = 0.0;
    checkoutOrders += ` <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>`;
    $.each(response.data.items,function (key,value) {
        var bookName = value.name;
        bookName = bookName.substring(0, 50) + ((bookName > 50 ? " &..." : ""));
        var bookImage = BASE_URL + 'storage/uploads/books/' + value.attributes.image;
        var bookPrice = value.price;
        var bookQty = value.quantity;

         deliveryCharge = ' Free';
        if (response.data.delivery_charge != null && response.data.total < 1500){
            deliveryCharge = '৳'+response.data.delivery_charge;
            total = Math.round(response.data.total+parseFloat(response.data.delivery_charge));
        }else{
            total = response.data.total;
        }
        checkoutOrders += ` <tr>
                                <td>`+bookName+`<span class="book-qty"> x `+bookQty+`</span></td>
                                <td>৳`+bookPrice+`</td>
                            </tr>`;
    });
    checkoutOrders += ` </tbody>
                            <tfoot>
                            <tr>
                                <th>SubTotal</th>
                                <td class="book-subtotal">৳`+response.data.sub_total+`</td>
                            </tr>`;
    var noofCouponCodeApplied = Object.keys(response.data.conditions).length;
    if (noofCouponCodeApplied) {
        let coponsAppliedText = ``;
        let discountAmount = 0;
        let coupons = response.data.conditions;
        var couponsApplied = Object.keys(coupons);
        $.each(couponsApplied,function (key,coupon) {
            coponsAppliedText += coupon+',';
        });
        $.each(coupons,function (condition,conditionValue) {
            discountAmount = discountAmount + conditionValue.parsedRawValue;
        });
        coponsAppliedText = coponsAppliedText.replace(/,\s*$/, "");
        checkoutOrders += `<tr>
                                <th>Coupon</th>
                                <td class="coupon_applied_count">`+coponsAppliedText+` Coupon Applied with ৳`+discountAmount+`</td>
                              </tr>`;
    }
    checkoutOrders += `<tr>
                            <th>Delivery Charge</th>
                            <td>`+deliveryCharge+`</td>
                        </tr>
                        <tr>
                            <th>Total</th>
<!--                            <td class="book-subtotal get-total-amount">৳`+total+`</td>-->
                            <td class="book-subtotal">৳`+total+`<input type="hidden" id="shurjoTotalAmount" class="get-total-amount" value="`+total+`"></td>
                        </tr>
                    </tfoot>`;

    $(".order_table").html(checkoutOrders);
}

function increaseQty(bookId) {
    var cart_quantity = parseInt($('#cart_quantity'+bookId).val());
    cart_quantity = cart_quantity+1;
    $('#cart_quantity'+bookId).val(cart_quantity-1);
    updateCart(bookId,'plus');
}

function decreaseQty(bookId) {
    var cart_quantity = parseInt($('#cart_quantity'+bookId).val());
    if (cart_quantity>1){
        cart_quantity = cart_quantity-1;
        $('#cart_quantity'+bookId).val(cart_quantity+1);
        updateCart(bookId,'minus');
    }
}

function updateCart(bookId,action) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'cart/update-cart',
        data: {
            action:action,
            bookId: bookId,
        },
        success: function (response) {
            if (response.status == 'success') {
                toastr.success(response.message);
                getCart();
            }
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
                }else if (response.status == 'error'){
                    toastr.warning(response.message)
                }
                setTimeout(function () {
                    $(".coupon-code-applied").hide();
                    $(".coupon-code-error").hide();
                },2000);
                $("#couponCode").val("");
                getCart();
            },
        });
    }
}

function checkLoggedIn() {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'cart/proceed-to-checkout',
        beforeSend:function(){
            $("#loader").show();
        },
        success: function (response) {
            if (response.status == 'loggedin') {
                window.location.href = BASE_URL+'checkout';
            }else if(response.status == 'error'){
                toastr.warning(response.message);
                $("#loginModal").modal('show');
            }
        },
        complete:function () {
            $("#loader").hide();
        }
    });
}

