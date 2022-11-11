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

        
        Route::get('/order', 'OrderController@index')->name('admin-order-index');
        Route::get('/order/view/{id}', 'OrderController@view')->name('admin-order-view');
        Route::get('/order/edit/{id}', 'OrderController@edit')->name('admin-order-edit');
        Route::post('/order/edit/{id}', 'OrderController@update')->name('admin-order-update');
        Route::get('/order/delete/{id}', 'OrderController@destroy')->name('admin-order-delete');

        Route::get('/testimonial/datatables', 'TestimonialController@datatables')->name('admin-testimonial-datatables'); //JSON REQUEST
        Route::get('/testimonial', 'TestimonialController@index')->name('admin-testimonial-index');
        Route::get('/testimonial/create', 'TestimonialController@create')->name('admin-testimonial-create');
        Route::post('/testimonial/create', 'TestimonialController@store')->name('admin-testimonial-store');
        Route::get('/testimonial/edit/{id}', 'TestimonialController@edit')->name('admin-testimonial-edit');
        Route::post('/testimonial/edit/{id}', 'TestimonialController@update')->name('admin-testimonial-update');
        Route::get('/testimonial/delete/{id}', 'TestimonialController@destroy')->name('admin-testimonial-delete');
      
      
      	Route::get('/course/datatables', 'CourseController@datatables')->name('admin-course-datatables'); //JSON REQUEST
        Route::get('/course', 'CourseController@index')->name('admin-course-index');
        Route::get('/course/create', 'CourseController@create')->name('admin-course-create');
        Route::post('/course/create', 'CourseController@store')->name('admin-course-store');
        Route::get('/course/edit/{id}', 'CourseController@edit')->name('admin-course-edit');
        Route::post('/course/edit/{id}', 'CourseController@update')->name('admin-course-update');
        Route::get('/course/delete/{id}', 'CourseController@destroy')->name('admin-course-delete');

        
        Route::get('/course/week/{id}', 'CourseController@week')->name('admin-course-week');
        Route::get('/course/week/datatables/{id}', 'CourseController@week_datatables')->name('admin-course-week-datatables');
        Route::get('/course/week/add/{id}', 'CourseController@week_add')->name('admin-course-week-add');
        Route::post('/course/week/add/{id}', 'CourseController@post_week_add')->name('admin-course-week-add');
        Route::get('/course/week/edit/{id}', 'CourseController@week_edit')->name('admin-course-week-edit');
        Route::post('/course/week/edit/{id}', 'CourseController@post_week_edit')->name('admin-course-week-edit');
        Route::get('/course/week/delete/{id}', 'CourseController@week_delete')->name('admin-course-week-delete');
        
        Route::get('/course/week/lessons/{id}', 'CourseController@week_lessons')->name('admin-course-week-lessons');
        Route::get('/course/week/lessons/datatables/{id}', 'CourseController@week_lessons_datatables')->name('admin-course-week-lessons-datatables');
        Route::get('/course/week/lessons/add/{id}', 'CourseController@week_lessons_add')->name('admin-course-week-lessons-add');
        Route::post('/course/week/lessons/add/{id}', 'CourseController@post_week_lessons_add')->name('admin-course-week-lessons-add');
        Route::get('/course/week/lessons/edit/{id}', 'CourseController@week_lessons_edit')->name('admin-course-week-lessons-edit');
        Route::post('/course/week/lessons/edit/{id}', 'CourseController@post_week_lessons_edit')->name('admin-course-week-lessons-edit');
        Route::get('/course/week/lessons/delete/{id}', 'CourseController@week_lessons_delete')->name('admin-course-week-lessons-delete');

        Route::get('/course/week/lessons/chapter/{id}', 'CourseController@week_lessons_chapter')->name('admin-course-week-lessons-chapter');
        Route::get('/course/week/lessons/chapter/datatables/{id}', 'CourseController@week_lessons_chapter_datatables')->name('admin-course-week-lessons-chapter-datatables');
        Route::get('/course/week/lessons/chapter/add/{id}', 'CourseController@week_lessons_chapter_add')->name('admin-course-week-lessons-chapter-add');
        Route::post('/course/week/lessons/chapter/add/{id}', 'CourseController@post_week_lessons_chapter_add')->name('admin-course-week-lessons-chapter-add');
        Route::get('/course/week/lessons/chapter/edit/{id}', 'CourseController@week_lessons_chapter_edit')->name('admin-course-week-lessons-chapter-edit');
        Route::post('/course/week/lessons/chapter/edit/{id}', 'CourseController@post_week_lessons_chapter_edit')->name('admin-course-week-lessons-chapter-edit');
        Route::get('/course/week/lessons/chapter/delete/{id}', 'CourseController@week_lessons_chapter_delete')->name('admin-course-week-lessons-chapter-delete');

        Route::get('/course/week/lessons/chapter/topic/{id}', 'CourseController@week_lessons_chapter_topic')->name('admin-course-week-lessons-chapter-topic');
        Route::get('/course/week/lessons/chapter/topic/datatables/{id}', 'CourseController@week_lessons_chapter_topic_datatables')->name('admin-course-week-lessons-chapter-topic-datatables');
        Route::get('/course/week/lessons/chapter/topic/add/{id}', 'CourseController@week_lessons_chapter_topic_add')->name('admin-course-week-lessons-chapter-topic-add');
        Route::post('/course/week/lessons/chapter/topic/add/{id}', 'CourseController@post_week_lessons_chapter_topic_add')->name('admin-course-week-lessons-chapter-topic-add');
        Route::get('/course/week/lessons/chapter/topic/edit/{id}', 'CourseController@week_lessons_chapter_topic_edit')->name('admin-course-week-lessons-chapter-topic-edit');
        Route::post('/course/week/lessons/chapter/topic/edit/{id}', 'CourseController@post_week_lessons_chapter_topic_edit')->name('admin-course-week-lessons-chapter-topic-edit');
        Route::get('/course/week/lessons/chapter/topic/delete/{id}', 'CourseController@week_lessons_chapter_topic_delete')->name('admin-course-week-lessons-chapter-topic-delete');
    });
});
