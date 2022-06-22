$(document).ready(function () {
    getHomePageProducts();
});

function getHomePageProducts() {
    var categoryProductsHtml = '';
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'get-home-page-products',
        success: function (response) {
            $.each(response.data,function (key,value) {
                categoryProductsHtml += '<dl>';
                categoryProductsHtml +='<dt>'+value.category+'</dt>';
                $.each(value.category_products,function (key2,value2) {
                    categoryProductsHtml +=  '<dd>'+value2.product_name+'</dd>';
                });
                categoryProductsHtml += '</dl>';
            });

            $("#loaded_items").html(categoryProductsHtml);
        }
    });
}

