<?php

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

Route::middleware(['web'])->group(function () {
    Route::get('', ['uses' => 'SiteController@index', 'as' => 'index']);
    Route::get('/', ['uses' => 'SiteController@index', 'as' => '/']);
    Route::get('index', ['uses' => 'SiteController@index', 'as' => 'index']);


    Route::get('about-us', 'SiteController@get_about_us')->name('about-us');
    Route::get('recipe', 'SiteController@recipe')->name('recipe');
//	Route::get('about-us', 'SiteController@get_static_page')->name('about-us');
    Route::get('privacy-policy', 'SiteController@get_static_page')->name('privacy-policy');
    Route::get('terms-condition', 'SiteController@get_static_page')->name('terms-condition');
    Route::get('return-refund-policy', 'SiteController@get_static_page')->name('return-refund-policy');
    Route::get('contact-us', 'SiteController@get_contactus')->name('contact-us');
    Route::post('contact-us', 'SiteController@post_contact')->name('contact-us');

    Route::get('/blog', 'SiteController@blog')->name('blog');

    Route::get('/product/{category}/{subcategory?}', 'SiteController@category')->name('product.category');
    Route::get('/product/{slug1}/{slug2}', 'SiteController@subcategory')->name('product.subcat');
    
    Route::get('e-books', 'SiteController@e_books')->name('e-books');
    Route::get('product-details/{id}', 'SiteController@get_product_details')->name('product-details');
    /*     * ******************** Cart ************************ */

    Route::get('cart', ['uses' => 'CartController@index', 'as' => 'cart']);
    Route::get('update-cart', ['uses' => 'CartController@update_cart', 'as' => 'update-cart']);
    Route::post('add-cart', ['uses' => 'CartController@add_to_cart', 'as' => 'add-cart']);
    Route::post('remove-cart', ['uses' => 'CartController@remove_from_cart', 'as' => 'remove-cart']);
});
Route::middleware(['user_not_logged_in'])->group(function () {
    Route::post('signup', 'SiteController@post_signup')->name('signup');
    Route::get('active-account/{id}/{token}', 'SiteController@get_active_account')->name('active-account');
//    Route::post('resend-active-token', 'SiteController@resend_active_token')->name('resend-active-token');
    Route::post('login', 'SiteController@post_login')->name('login');
    Route::put('forgot-password', 'SiteController@post_forgot_password')->name('forgot-password');
    Route::get('reset-password/{id}/{token}', 'SiteController@get_reset_password')->name('reset-password');
    Route::put('set-password', 'SiteController@post_reset_password')->name('set-password');
});
Route::middleware(['user_logged_in'])->group(function () {
    Route::get('logout', ['uses' => 'SiteController@logout', 'as' => 'logout']);
    Route::get('dashboard', ['uses' => 'UserController@dashboard', 'as' => 'dashboard']);
    Route::get('profile', 'UserController@get_profile')->name('my-profile');
    Route::post('upload-picture', 'UserController@upload_picture')->name('upload-picture');
    Route::post('profile', 'UserController@post_profile')->name('post-myprofile');
    Route::post('post-reset-password', 'UserController@reset_password')->name('post-reset-password');

    Route::get('checkout', ['uses' => 'SiteController@checkout', 'as' => 'checkout']);
    Route::post('checkout', ['uses' => 'SiteController@post_checkout', 'as' => 'checkout']);
    Route::get('thank-you', ['uses' => 'SiteController@thank_you', 'as' => 'thank-you']);
//    Route::post('apply-coupon', ['uses' => 'SiteController@apply_coupon', 'as' => 'apply-coupon']);
    Route::post('docheckoutpayment', 'RazorpayController@docheckoutpayment')->name('docheckoutpayment');


    Route::get('user-order', 'UserController@order')->name('user-order');
    Route::get('user-order-datatable', 'UserController@order_datatable')->name('user-order-datatable');
    Route::get('book-read/{id}', 'UserController@book_read')->name('book-read');
});
