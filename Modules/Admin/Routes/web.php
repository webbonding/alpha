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

Route::prefix('admin')->group(function() {

    Route::get('clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return "Cache,View is cleared";
    });



    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('admin-login', ['uses' => 'AuthController@get_login', 'as' => 'admin-login']);
        Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
        Route::get('admin-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'admin-lockscreen']);
        Route::post('admin-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'admin-lockscreen']);
    });

    Route::middleware(['admin_logged_in'])->group(function () {
        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);
        Route::get('admin-profile', ['uses' => 'DashboardController@get_profile', 'as' => 'admin-profile']);
        Route::post('admin-profile', ['uses' => 'DashboardController@post_profile', 'as' => 'admin-profile']);


        Route::get('admin-change-password', ['uses' => 'DashboardController@get_change_password', 'as' => 'admin-change-password']);
        Route::post('admin-change-password', ['uses' => 'DashboardController@post_change_password', 'as' => 'admin-change-password']);
        Route::get('user-change-image', ['uses' => 'DashboardController@get_change_image', 'as' => 'user-change-image']);
        Route::post('user-change-image', ['uses' => 'DashboardController@post_change_image', 'as' => 'user-change-image']);


        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);

        Route::get('settings', ['uses' => 'SettingsController@index', 'as' => 'settings']);
        Route::post('settings', ['uses' => 'SettingsController@store', 'as' => 'settings']);

        Route::get('login-history', ['uses' => 'LoginHistoryController@index', 'as' => 'login-history']);
        Route::get('login-history-list', ['uses' => 'LoginHistoryController@get_list', 'as' => 'login-history-list']);

        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);
        Route::get('emailNotification-list', ['uses' => 'EmailNotificationController@get_list', 'as' => 'emailNotification-list']);
        Route::get('emailNotification', ['uses' => 'EmailNotificationController@index', 'as' => 'emailNotification']);
        Route::get('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@get_edit', 'as' => 'emailNotification-edit']);
        Route::post('emailNotification-edit/{id}', ['uses' => 'EmailNotificationController@post_edit', 'as' => 'emailNotification-edit']);

        Route::get('faqpage-list', ['uses' => 'FaqController@get_list', 'as' => 'faqpage-list']);
        Route::get('faqpage', ['uses' => 'FaqController@index', 'as' => 'faqpage']);
        Route::get('faqpage-edit/{id}', ['uses' => 'FaqController@get_edit', 'as' => 'faqpage-edit']);
        Route::post('faqpage-edit/{id}', ['uses' => 'FaqController@post_edit', 'as' => 'faqpage-edit']);
        Route::get('faqpage-add', ['uses' => 'FaqController@get_add', 'as' => 'faqpage-add']);
        Route::get('faqpage-delete/{id}', ['uses' => 'FaqController@get_delete', 'as' => 'faqpage-delete']);
        Route::post('faqpage-add', ['uses' => 'FaqController@post_add', 'as' => 'faqpage-add']);

        Route::get('aboutuspage', ['uses' => 'AboutusController@index', 'as' => 'aboutuspage']);
        Route::get('aboutus-list', ['uses' => 'AboutusController@get_list', 'as' => 'aboutus-list']);
        Route::get('aboutuspage-edit/{id}', ['uses' => 'AboutusController@get_edit', 'as' => 'aboutuspage-edit']);
        Route::post('aboutuspage-edit/{id}', ['uses' => 'AboutusController@post_edit', 'as' => 'aboutuspage-edit']);
        Route::get('aboutuspage-add', ['uses' => 'AboutusController@get_add', 'as' => 'aboutuspage-add']);
        Route::post('aboutuspage-add', ['uses' => 'AboutusController@post_add', 'as' => 'aboutuspage-add']);
        Route::get('aboutuspage-delete/{id}', ['uses' => 'AboutusController@delete', 'as' => 'aboutuspage-delete']);

        Route::get('contactus-list', ['uses' => 'ContactusController@get_list', 'as' => 'contactus-list']);
        Route::get('contactus', ['uses' => 'ContactusController@index', 'as' => 'contactus']);
        Route::get('contactus-view/{id}', ['uses' => 'ContactusController@get_view', 'as' => 'contactus-view']);

        Route::resource('static-page', 'StaticpageController');

        Route::get('cms', ['uses' => 'CmsController@index', 'as' => 'cms']);
        Route::get('cms-list', ['uses' => 'CmsController@get_list', 'as' => 'cms-list']);
        Route::get('cms-edit/{id}', ['uses' => 'CmsController@get_edit', 'as' => 'cms-edit']);
        Route::post('cms-edit/{id}', ['uses' => 'CmsController@post_edit', 'as' => 'cms-edit']);

        Route::get('cmspage', ['uses' => 'CmspageController@index', 'as' => 'cmspage']);
        Route::get('cmspage-list', ['uses' => 'CmspageController@get_list', 'as' => 'cmspage-list']);
        Route::get('cmspage-edit/{id}', ['uses' => 'CmspageController@get_edit', 'as' => 'cmspage-edit']);
        Route::post('cmspage-edit/{id}', ['uses' => 'CmspageController@post_edit', 'as' => 'cmspage-edit']);



        Route::get('users', ['uses' => 'UserController@get_user_list', 'as' => 'users']);
        Route::get('user-list-datatable', ['uses' => 'UserController@get_user_list_datatable', 'as' => 'user-list-datatable']);
        Route::get('user-add', ['uses' => 'UserController@get_add_user', 'as' => 'user-add']);
        Route::post('user-add', ['uses' => 'UserController@post_add_user', 'as' => 'user-add']);
        Route::get('user-edit/{id}', ['uses' => 'UserController@get_edit_user', 'as' => 'user-edit']);
        Route::put('user-edit/{id}', ['uses' => 'UserController@post_edit_user', 'as' => 'user-edit']);
        Route::post('user-delete/{id}', ['uses' => 'UserController@delete', 'as' => 'user-delete']);
        Route::get('users-csv', ['uses' => 'UserController@get_users_csv', 'as' => 'users-csv']);

        Route::get('/category/datatables', 'CategoryController@datatables')->name('admin-cat-datatables'); //JSON REQUEST
        Route::get('/category', 'CategoryController@index')->name('admin-cat-index');
        Route::get('/category/create', 'CategoryController@create')->name('admin-cat-create');
        Route::post('/category/create', 'CategoryController@store')->name('admin-cat-store');
        Route::get('/category/edit/{id}', 'CategoryController@edit')->name('admin-cat-edit');
        Route::post('/category/edit/{id}', 'CategoryController@update')->name('admin-cat-update');
        Route::get('/category/delete/{id}', 'CategoryController@destroy')->name('admin-cat-delete');
        Route::get('/category/status/{id1}/{id2}', 'CategoryController@status')->name('admin-cat-status');

        // SUBCATEGORY SECTION ------------

        Route::get('/subcategory/datatables', 'SubCategoryController@datatables')->name('admin-subcat-datatables'); //JSON REQUEST
        Route::get('/subcategory', 'SubCategoryController@index')->name('admin-subcat-index');
        Route::get('/subcategory/create', 'SubCategoryController@create')->name('admin-subcat-create');
        Route::post('/subcategory/create', 'SubCategoryController@store')->name('admin-subcat-store');
        Route::get('/subcategory/edit/{id}', 'SubCategoryController@edit')->name('admin-subcat-edit');
        Route::post('/subcategory/edit/{id}', 'SubCategoryController@update')->name('admin-subcat-update');
        Route::get('/subcategory/delete/{id}', 'SubCategoryController@destroy')->name('admin-subcat-delete');
        Route::get('/subcategory/status/{id1}/{id2}', 'SubCategoryController@status')->name('admin-subcat-status');
        Route::get('/load/subcategories/{id}/', 'SubCategoryController@load')->name('admin-subcat-load'); //JSON REQUEST
        // SUBCATEGORY SECTION ENDS------------

        Route::get('/blog/datatables', 'BlogController@datatables')->name('admin-blog-datatables'); //JSON REQUEST
        Route::get('/blog', 'BlogController@index')->name('admin-blog-index');
        Route::get('/blog/create', 'BlogController@create')->name('admin-blog-create');
        Route::post('/blog/create', 'BlogController@store')->name('admin-blog-store');
        Route::get('/blog/edit/{id}', 'BlogController@edit')->name('admin-blog-edit');
        Route::post('/blog/edit/{id}', 'BlogController@update')->name('admin-blog-update');
        Route::get('/blog/delete/{id}', 'BlogController@destroy')->name('admin-blog-delete');
        
        Route::get('/slider/datatables', 'SliderController@datatables')->name('admin-slider-datatables'); //JSON REQUEST
        Route::get('/slider', 'SliderController@index')->name('admin-slider-index');
        Route::get('/slider/create', 'SliderController@create')->name('admin-slider-create');
        Route::post('/slider/create', 'SliderController@store')->name('admin-slider-store');
        Route::get('/slider/edit/{id}', 'SliderController@edit')->name('admin-slider-edit');
        Route::post('/slider/edit/{id}', 'SliderController@update')->name('admin-slider-update');
        Route::get('/slider/delete/{id}', 'SliderController@destroy')->name('admin-slider-delete');

        Route::get('admin-products', ['uses' => 'ProductController@index', 'as' => 'admin-products']);
        Route::get('admin-viewproduct/{id}', ['uses' => 'ProductController@view', 'as' => 'admin-viewproduct']);
        Route::get('admin-products-list-datatable', ['uses' => 'ProductController@get_products_list_datatable', 'as' => 'admin-products-list-datatable']);
        Route::get('admin-addproduct', ['uses' => 'ProductController@add_product', 'as' => 'admin-addproduct']);
        Route::post('admin-addproduct', ['uses' => 'ProductController@post_add_product', 'as' => 'admin-addproduct']);
        Route::get('admin-updateproduct/{id}', ['uses' => 'ProductController@get_update', 'as' => 'admin-updateproduct']);
        Route::post('admin-updateproduct/{id}', ['uses' => 'ProductController@post_update', 'as' => 'admin-updateproduct']);
        Route::get('admin-deleteproduct/{id}', ['uses' => 'ProductController@delete', 'as' => 'admin-deleteproduct']);
        
        Route::get('/order/datatables', 'OrderController@datatables')->name('admin-order-datatables'); //JSON REQUEST
        Route::get('/order', 'OrderController@index')->name('admin-order-index');
        Route::get('/order/view/{id}', 'OrderController@view')->name('admin-order-view');
        Route::get('/order/edit/{id}', 'OrderController@edit')->name('admin-order-edit');
        Route::post('/order/edit/{id}', 'OrderController@update')->name('admin-order-update');
        Route::get('/order/delete/{id}', 'OrderController@destroy')->name('admin-order-delete');
    });
});
