<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{


    Route::resource('bookRequests', BookRequestController::class);
    Route::resource('quotes', QuoteController::class);


    //surjopay payment getway req
    Route::post('/send-amarpay-request', 'AmarpayController@send')->name('send-money');
    Route::post('/set-apdata-session', 'AmarpayController@spSession')->name('ap-session');
    Route::post('/set-apdata-success', 'AmarpayController@success')->name('ap-success');
    Route::post('/set-apdata-fail', 'AmarpayController@fail')->name('ap-fail');




    // Home Routes
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::post('check-login', 'LoginController@validateLogin')->name('validateLogin');
    Route::post('/mailcheck', 'RegisterController@mailcheck')->name('mailcheck');
    Route::post('/phonecheck', 'RegisterController@phonecheck')->name('phonecheck');
    Route::group(['prefix' => 'common'], function () {
        Route::post('get-searched-book', 'CommonController@getSearchedBooks')->name('getSearchedBooks');
        Route::post('get-affiliation-book', 'CommonController@getAffiliationBooks')->name('getAffiliationBooks');
    });
    Route::post('bookSearch', 'HomeController@bookSearch')->name('bookSearch');



    // Front End
    Route::get('categories/show/{categorySlag}', 'CategoryController@categoryShow')->name('showCategory');
    Route::get('subcategories/show/{subcategoryslug}', 'SubCategoryController@showSubCategory')->name('showSubCategory');
    Route::get('tags/show/{tagSlag}', 'TagController@tagShow')->name('showTag');
    // Route::get('books/show/{bookSlag}', 'BookController@bookShow')->name('showBook');
    Route::get('featuredAuthors', 'AuthorController@customerAuthors')->name('cfeaturedAuthors');
    Route::get('author/{authorSlug}', 'AuthorController@authorBooks')->name('cAuthorBooks');
    Route::get('publication/{publicationsSlug}', 'PublicationController@publicationsBooks')->name('cPublicationBooks');
    Route::get('aboutus', 'HomeController@aboutUS')->name('aboutUs');
    Route::get('privacy-policies', 'HomeController@privacyPolicies')->name('privacyPolicies');
    Route::get('termsOfUse', 'HomeController@termsOfUse')->name('termsOfUse');
    Route::get('returnPolicy', 'HomeController@returnPolicy')->name('returnPolicy');
    Route::get('contact-us', 'HomeController@contactUs')->name('viewContactUs');
    Route::get('secure-shoping', 'HomeController@secureshoping')->name('secureshoping');
    Route::get('copyrigt-tpolicy', 'HomeController@copyrigttpolicy')->name('copyrigttpolicy');
    Route::get('payment', 'HomeController@payment')->name('payment');
    Route::get('shipping', 'HomeController@shipping')->name('shipping');
    Route::get('faq', 'HomeController@faq')->name('faq');
    Route::get('sitemap', 'HomeController@sitemap')->name('sitemap');
    Route::get('corporatesell', 'HomeController@getQuote')->name('get-quote');
    Route::get('customerbookrequest', 'HomeController@customerbookrequest')->name('customerbookrequest');
    Route::post('send-enquiry', 'ContactUsController@contactUs')->name('contactUs');
    Route::get('fileDownload', 'HomeController@fileDownload')->name('fileDownload');




    Route::group(['prefix' => 'book'], function () {
        Route::get('related/{bookId}', 'BookController@getRelatedBooks')->name('getRelatedBooks');
        Route::get('reviews', 'BookController@getBookReviews')->name('getBookReviews');
        Route::get('{bookSlug}', 'BookController@getBookDetail')->name('getBookDetail');
        Route::get('brand/{brandSlug}', 'BookController@getBooksByBrands')->name('viewBookByBrand');
    });

    // Affiliats
    Route::group(['prefix' => 'affiliats'], function () {
        Route::get('aboutAffiliatProgram', 'HomeController@aboutAffiliat')->name('gaffiliats');
        Route::get('affiliatPayment', 'HomeController@paymentAffiliat')->name('gaffiliatsPayment');
        Route::get('affiliatCondition', 'HomeController@termsAffiliat')->name('gaffiliatsCondition');
    });


    Route::group(['prefix' => 'account'], function () {
        Route::get('verify/{token}', 'RegisterController@accountVerify')->name('accountVerify');
    });



    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@index')->name('viewCart');
        Route::post('create-cart', 'CartController@createCart')->name('createCart');
        Route::get('get-cart', 'CartController@getCart')->name('getCart');
        Route::post('remove-cart-item', 'CartController@removeCart')->name('removeCart');
        Route::post('update-cart', 'CartController@updateCart')->name('updateCart');
        Route::post('apply-coupon', 'CartController@applyCouponCode')->name('applyCouponCode');
        Route::get('proceed-to-checkout', 'CartController@proceedToCheckout')->name('proceedToCheckout');
    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', 'CheckoutController@index')->name('viewCheckout');
        Route::post('place-order', 'CheckoutController@placeOrder')->name('placeOrder');
        Route::get('order-completed', 'CheckoutController@orderCompleted')->name('orderCompleted');
    });

    // Authentications
    Route::group(['middleware' => ['guest']], function() {

        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');


        // Social Signup
        // Login or signup with facebook and google
        Route::get('auth/google','SocialController@googleRedirect')->name('auth.googleRedirect');
        Route::get('auth/google/callback','SocialController@loginWithGoogle')->name('auth.loginWithGoogle');

        //Login with facebook
        Route::get('auth/facebook','SocialController@facebookRedirect')->name('auth.facebookRedirect');
        Route::get('auth/facebook/callback','SocialController@loginWithFacebook')->name('auth.loginWithFacebook');


        //Password
        Route::group(['prefix' => 'password'], function () {
            Route::get('reset', 'PasswordController@resetPassword')->name('resetPassword');
            Route::post('verify', 'PasswordController@resetMyPassword')->name('resetMyPassword');
            Route::get('setup/{token}', 'PasswordController@setupPassword')->name('setupPassword');
            Route::post('update', 'PasswordController@updateNewPassword')->name('updateNewPassword');
        });




    });







    Route::group(['middleware' => 'auth'], function() {

        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('affiliations', AffiliationController::class);
        Route::resource('wishlists', WishlistController::class);
        Route::resource('affiliationapplication', AffiliatorApplicationController::class);
        Route::resource('affiliationLinks', AffiliationLinkController::class);


        Route::group(['prefix' => 'common'], function () {
            Route::get('categories', 'CommonController@getAllCategories')->name('getAllCategories');
            Route::post('get-sub-category', 'CommonController@getSubCategories')->name('getSubCategories');
        });


        // billow code will be transfer
        Route::group(['prefix' => 'dashboard'], function() {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::get('/myaccount', 'DashboardController@myaccount')->name('myaccount');
            Route::get('/editmyaccount', 'DashboardController@editmyaccount')->name('editmyaccount');
            Route::get('/wishlist', 'DashboardController@customerWishlist')->name('viewCustomerWishlist');
            Route::get('/changePassword', 'DashboardController@changePassword')->name('viewCustomerChangePassword');
            Route::get('/creviewes', 'DashboardController@customerReview')->name('viewCustomerRatigReviews');
            Route::get('/caddresses', 'DashboardController@customerAddresses')->name('viewCustomerAddresses');
            Route::get('/corder', 'DashboardController@customerOrders')->name('viewCustomerOrders');
            Route::get('/affiLinks', 'DashboardController@affiliatorLinks')->name('affiliLinks');
            Route::get('/affiBookReport', 'DashboardController@affiliatorProduct')->name('affiliatorProduct');
            Route::get('/earningReport', 'DashboardController@earningReport')->name('earningReport');
        });

        //Logout Routes
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');



        // Author
        Route::group(['prefix' => 'authors'], function () {
            Route::get('/', 'AuthorController@index')->name('viewAuthors');
            Route::post('create', 'AuthorController@saveAuthor')->name('saveAuthor');
            Route::post('update', 'AuthorController@saveAuthor')->name('updateAuthor');
            Route::get('list', 'AuthorController@getAuthorList')->name('saveAuthor');
            Route::delete('delete', 'AuthorController@deleteAuthor')->name('deleteAuthor');
            Route::post('change-status', 'AuthorController@changeAuthorStatus')->name('changeAuthorStatus');

        });

        // Category
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', 'CategoryController@index')->name('viewCategory');
            Route::post('create', 'CategoryController@saveCategory')->name('saveCategory');
            Route::post('update', 'CategoryController@saveCategory')->name('updateCategory');
            Route::get('list', 'CategoryController@getCategoryList')->name('saveCategory');
            Route::delete('delete', 'CategoryController@deleteCategory')->name('deleteCategory');
        });


        // Country
        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', 'CountryController@index')->name('viewCountry');
            Route::post('create', 'CountryController@saveCountry')->name('saveCountry');
            Route::post('update', 'CountryController@saveCountry')->name('updateCountry');
            Route::get('list', 'CountryController@getCountryList')->name('saveCountry');
            Route::delete('delete', 'CountryController@deleteCountry')->name('deleteCountry');
        });

        // Language
        Route::group(['prefix' => 'languages'], function () {
            Route::get('/', 'LanguageController@index')->name('viewLanguage');
            Route::post('create', 'LanguageController@saveLanguage')->name('saveLanguage');
            Route::post('update', 'LanguageController@saveLanguage')->name('updateLanguage');
            Route::get('list', 'LanguageController@getLanguageList')->name('saveLanguage');
            Route::delete('delete', 'LanguageController@deleteLanguage')->name('deleteLanguage');
        });

        // Sub Category
        Route::group(['prefix' => 'sub-categories'], function () {
            Route::get('/', 'SubCategoryController@index')->name('viewSubCategory');
            Route::post('create', 'SubCategoryController@saveSubCategory')->name('saveSubCategory');
            Route::patch('update', 'SubCategoryController@saveSubCategory')->name('updateSubCategory');
            Route::get('list', 'SubCategoryController@getSubCategoryList')->name('getSubCategoryList');
            Route::delete('delete', 'SubCategoryController@deleteSubCategory')->name('deleteSubCategory');
        });

        // Publication
        Route::group(['prefix' => 'publications'], function () {
            Route::get('/', 'PublicationController@index')->name('viewPublications');
            Route::post('create', 'PublicationController@savePublications')->name('savePublications');
            Route::post('update', 'PublicationController@savePublications')->name('updatePublications');
            Route::get('list', 'PublicationController@getPublicationList')->name('getPublicationList');
            Route::delete('delete', 'PublicationController@deletePublication')->name('deletePublication');
            Route::post('change-status', 'PublicationController@changePublicationStatus')->name('changePublicationStatus');
        });

        // Tag
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagController@index')->name('viewTags');
            Route::post('create', 'TagController@saveTag')->name('createTag');
            Route::patch('update', 'TagController@saveTag')->name('updateTag');
            Route::get('list', 'TagController@listTags')->name('listTags');
            Route::delete('delete', 'TagController@deleteTags')->name('deleteTags');
        });


        // Newsletter
        Route::group(['prefix' => 'newsletters'], function () {


            Route::get('/preview', 'NewsletterController@preview');
            Route::get('list', 'NewsletterController@getAllNewsletters')->name('getAllNewsletters');


            Route::group(['prefix' => 'subscribers'], function () {
                Route::get('/', 'NewsletterController@getSubscribers')->name('viewSubscribers');
                Route::get('list', 'NewsletterController@listSubscribers')->name('listSubscribers');
                Route::post('change-status', 'NewsletterController@changeSubscriberStatus')->name('changeSubscriberStatus');
            });




            Route::group(['prefix' => 'compose'], function () {
                Route::get('/', 'NewsletterController@composeNewsletter')->name('ViewComposeNewsletter');
                Route::post('compose-newsletter', 'NewsletterController@saveComposedNewsletters')->name('saveComposedNewsletters');
            });
        });


        // Books
        Route::group(['prefix' => 'books'], function () {
            Route::get('/', 'BookController@index')->name('viewBooks');
            Route::get('add', 'BookController@addBooks')->name('addBooks');
            Route::post('create', 'BookController@createBook')->name('createBook');
            Route::post('update', 'BookController@createBook')->name('updateBook');
            Route::get('edit/{bookId}', 'BookController@editBook')->name('editBook');
            Route::delete('delete', 'BookController@deleteBook')->name('deleteBook');
            Route::get('list', 'BookController@listBooks')->name('listBooks');
            Route::get('info/{bookId}', 'BookController@getBookInfo')->name('getBookInfo');
            Route::post('upload', 'BookController@uploadBook')->name('uploadBook');
            Route::get('{bookId}/reviews', 'BookController@bookReviews')->name('bookReviews');
            Route::get('{bookId}/list-reviews', 'BookController@listBookReviews')->name('listBookReviews');
            Route::post('archive-review', 'BookController@archiveBookReview')->name('archiveBookReview');

        });

        // Discount
        Route::group(['prefix' => 'discounts'], function () {
            Route::get('/', 'DiscountController@index')->name('viewDiscounts');
            Route::post('create', 'DiscountController@createDiscount')->name('createDiscount');
            Route::patch('update', 'DiscountController@createDiscount')->name('updateDiscount');
            Route::get('list', 'DiscountController@listDiscount')->name('listDiscount');
            Route::get('info', 'DiscountController@getDiscountInfo')->name('getDiscountInfo');
            Route::delete('delete', 'DiscountController@deleteDiscount')->name('deleteDiscount');
            Route::post('change-status', 'DiscountController@changeDiscountStatus')->name('changeDiscountStatus');
            Route::get('get-attributes', 'DiscountController@getAttrr')->name('getAttrr');
        });

        //User
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('viewUsers');
            Route::get('create', 'UserController@create')->name('users.create');
            Route::post('store', 'UserController@store')->name('users.store');
            Route::get('show/{user}', 'UserController@show')->name('users.show');
            Route::get('edit/{user}', 'UserController@edit')->name('users.edit');
            Route::patch('update/{user}', 'UserController@update')->name('users.update');
            Route::delete('delete', 'UserController@destroy')->name('users.destroy');
            Route::get('list', 'UserController@getUserList')->name('getUserList');


            Route::get('admins', 'UserController@adminUser')->name('users.admin');
            Route::get('operator', 'UserController@operator')->name('users.operator');
            Route::get('publisher', 'UserController@publisher')->name('users.publisher');
            Route::get('affiliator', 'UserController@affiliator')->name('users.affiliator');
            Route::get('customer', 'UserController@customer')->name('users.customer');

        });



        Route::group(['prefix' => 'addresses'], function () {
            // Route::get('/', 'AddressController@index')->name('viewCustomerAddresses');
            Route::get('add', 'AddressController@addAddress')->name('addAddress');
            Route::get('edit/{addressId}', 'AddressController@editAddress')->name('editAddress');
            Route::post('create', 'AddressController@createUpdateAddress')->name('createAddress');
            Route::patch('update', 'AddressController@createUpdateAddress')->name('updateAddress');
            Route::delete('delete', 'AddressController@deleteAddress')->name('deleteAddress');
        });


        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrderController@index')->name('viewOrders');
            Route::get('list', 'OrderController@getOrdersList')->name('getOrdersList');
            Route::get('/bydate', 'OrderController@bydate')->name('viewOrdersBydate');

            Route::get('list/today', 'OrderController@getOrdersListDay')->name('orderbydate');
            Route::get('detail/{orderId}', 'OrderController@getOrderDetail')->name('getOrderDetail');
            Route::post('confirm', 'OrderController@confirmOrder')->name('confirmOrder');
            Route::post('cancel', 'OrderController@cancelOrder')->name('cancelOrder');
            Route::post('mark-processeing', 'OrderController@markProcessing')->name('markProcessing');
            Route::post('mark-shipped', 'OrderController@markShipped')->name('markShipped');
            Route::post('mark-delivered', 'OrderController@markDelivered')->name('markDelivered');
            Route::get('/mail', 'OrderController@mail')->name('mail');


            Route::get('invoice-download/{orderId}', 'OrderController@downloadInvoice')->name('downloadInvoice');
            Route::get('customerdetail/{orderId}', 'OrderController@getMyOrderDetail')->name('getMyOrderDetail');

        });


        Route::group(['prefix' => 'order-tracking'], function () {
            Route::get('/', 'TrackOrderController@index')->name('viewTrackOrder');
            Route::get('track', 'TrackOrderController@trackOrder')->name('trackOrder');
        });



        Route::group(['prefix' => 'wallet'], function () {
            Route::get('/requests', 'WalletController@index')->name('viewWalletRequests');
            Route::get('list', 'WalletController@listWalletRequests')->name('listWalletRequests');
            Route::post('change-status', 'WalletController@statusWalletRequest')->name('statusWalletRequest');
        });



        Route::group(['prefix' => 'media'], function () {

            Route::group(['prefix' => 'banner'], function () {
                Route::get('/', 'MediaController@index')->name('viewBannerImages');
                Route::post('save', 'MediaController@saveBanner')->name('saveBanner');
                Route::get('list', 'MediaController@listBanner')->name('listBanner');
                Route::get('info', 'MediaController@getBannerInfo')->name('getBannerInfo');
                Route::delete('delete', 'MediaController@deleteBanner')->name('deleteBanner');
                Route::patch('change-status', 'MediaController@changeMediaStatus')->name('changeMediaStatus');
            });


            Route::group(['prefix' => 'others'], function () {
                Route::get('/', 'MediaController@viewOtherMedia')->name('viewOtherMedia');
                Route::get('list', 'MediaController@listOtherMedia')->name('listOtherMedia');
                Route::get('info', 'MediaController@getOtherMediaInfo')->name('getOtherMediaInfo');
                Route::post('save', 'MediaController@saveOtherMedia')->name('saveOtherMedia');
            });


        });



        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'SettingController@viewSettings')->name('viewSetting');
            Route::post('update', 'SettingController@updateSettings')->name('updateSettings');
        });




        Route::group(['prefix' => 'popup'], function () {
            Route::get('/', 'PopupController@index')->name('viewPopup');
            Route::post('update', 'PopupController@updatePopup')->name('updatePopup');
        });


        Route::group(['prefix' => 'reviews'], function () {
            Route::get('/', 'ReviewController@index')->name('viewReviews');
            Route::post('rate', 'ReviewController@rateBook')->name('rateBook.store');
        });



        Route::group(['prefix' => 'queries'], function () {
            Route::get('/', 'QueryController@index')->name('viewQueries');
            Route::get('list', 'QueryController@listQueries')->name('listQueries');
            Route::post('delete', 'QueryController@deleteQuery')->name('deleteQuery');
        });



        Route::group(['prefix' => 'stories'], function () {
            Route::get('/', 'StoryController@index')->name('viewStories');
            Route::post('save', 'StoryController@saveStory')->name('saveStory');
            Route::get('list', 'StoryController@listStories')->name('listStories');
            Route::delete('delete', 'StoryController@deleteStory')->name('deleteStory');
            Route::get('info', 'StoryController@getStoryInfo')->name('getStoryInfo');
        });





    });
});
