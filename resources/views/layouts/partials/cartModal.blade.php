<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="header">
            <a href="/" class="site-logo">
                <img alt="Bookswagon" src="https://www.bookswagon.com/images/logos/shop-logo.png"></a>
            <h1>My Shopping Cart
                <label id="lblCartItems">(0 items)</label>
            </h1>
            <span class="close">&times;</span>
        </div>
        <div class="tab_container">
            <div class="tab_content" id="tab1" style="display: block;">
                <div id="BookCart_uplnShopping">
                    <div class="full-loader" style="display: none;">
                        <div id="loader">
                        </div>
                    </div>
                    <input type="hidden" name="BookCart$hdnTotalQty" id="BookCart_hdnTotalQty" value=" (0 items)">
                    <div class="p-1">
                        <div class="shopping-top">
                            <div id="BookCart_lvCart_divCartMsg" class="shopping-msg" style="display:none;"></div>
                            <div class=" " id="cart_table" style="overflow: scroll;">



                            </div>
                        </div>
                    </div>
                    <div class="shopping-bottom px-1">
                        <div class="">

                        </div>
                        <div class="">
                            <div class="total-ammount d-flex justify-content-end">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">Cart Subtotal</td>
                                            <td class="cart_sub_total_amount">$0</td>
                                        </tr>
                                        <tr id="couponApplied" style="display: none">
                                            <td>Coupon</td>
                                            <td class="coupon_applied_count"><strong>0 Coupon Applied </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Shipping Charge</td>
                                            <td class="cart_shiping_charge"></td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">Total</td>
                                            <td class="cart_total_amount gren-amount"><strong>$0</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfloat">
                        </div>
                    </div>


                    <div class="pt-1 px-1">
                        <p>If you have a coupon code, please apply it below.</p>
                        <div class="coupon field_form input-group">
                            <div class="input-fild">
                                <input type="text" name="couponCode" id="couponCode" class="form-control"
                                    placeholder="Enter Coupon Code..">
                            </div>
                            <div class="input-group-append">
                                <button onclick="applyCouponCode();" class="btn-red" type="submit">Apply
                                    Coupon</button>
                            </div>
                        </div>
                    </div>


                    <div class="shopping-action">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td align="left">
                                    </td>
                                    <td align="center">
                                    </td>
                                    <td class="p-1">
                                        <a href="javaScript:void(0)" onclick="checkLoggedIn();"
                                            class="btn-red">Proceed To CheckOut</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
