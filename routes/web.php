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



Route::get('/home', 'HomeController@index')->name('home');

// Admin Access Routes
Route::group(['prefix' => 'admin'], function () {

    // Authentication
    Route::get('login', 'Web\Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Web\Admin\Auth\LoginController@login');
    Route::get('logout', 'Web\Admin\Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes
    Route::get('register', 'Web\Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Web\Admin\Auth\RegisterController@register');

    // Password Reset
    Route::get('password/reset', 'Web\Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Web\Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Web\Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Web\Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');

    // Email Verification
    Route::get('email/verify', 'Web\Admin\Auth\VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}', 'Web\Admin\Auth\VerificationController@verify')->name('admin.verification.verify');
    Route::get('email/resend', 'Web\Admin\Auth\VerificationController@resend')->name('admin.verification.resend');
});


// Admin System Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission']], function () {

    //Home Admin
    Route::get('/home', 'Web\Admin\AdminController@index')->name('admin.home');

    //Roles Admin
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/',                 'Web\Admin\RolesController@index')->name('roles.index');
        Route::get('/create',           'Web\Admin\RolesController@create')->name('roles.create');
        Route::post('/',                'Web\Admin\RolesController@store')->name('roles.store');
        Route::get('/{id}',             'Web\Admin\RolesController@show')->name('roles.show');
        Route::get('/{id}/edit',        'Web\Admin\RolesController@edit')->name('roles.edit');
        Route::put('/{id}',             'Web\Admin\RolesController@update')->name('roles.update');
        Route::delete('/{id}',          'Web\Admin\RolesController@destroy')->name('roles.destroy');
        Route::put('/status/{id}',      'Web\Admin\RolesController@status')->name('roles.status');
        Route::get('/permission/{id}',  'Web\Admin\RolesController@permission')->name('roles.permission');
        Route::put('/permission/{id}',  'Web\Admin\RolesController@save_permission')->name('roles.savePermission');
    });

    //Usuarios Admin
    Route::group(['prefix' => 'users'], function () {
        Route::get('/',                 'Web\Admin\UsersController@index')->name('users.index');
        Route::get('/create',           'Web\Admin\UsersController@create')->name('users.create');
        Route::post('/',                'Web\Admin\UsersController@store')->name('users.store');
        Route::get('/{id}',             'Web\Admin\UsersController@show')->name('users.show');
        Route::get('/{id}/edit',        'Web\Admin\UsersController@edit')->name('users.edit');
        Route::put('/{id}',             'Web\Admin\UsersController@update')->name('users.update');
        Route::delete('/{id}',          'Web\Admin\UsersController@destroy')->name('users.destroy');
        Route::put('/status/{id}',      'Web\Admin\UsersController@status')->name('users.status');
    });

    Route::group(['prefix' => 'configuration'], function () {
        Route::get('/',                 'Web\Admin\ConfigurationsController@index')->name('configuration.index');
        Route::get('/{id}',             'Web\Admin\ConfigurationsController@show')->name('configuration.show');
        Route::get('/{id}/edit',        'Web\Admin\ConfigurationsController@edit')->name('configuration.edit');
        Route::put('/{id}',             'Web\Admin\ConfigurationsController@update')->name('configuration.update');
        Route::put('/status/{id}',      'Web\Admin\ConfigurationsController@status')->name('configuration.status');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/',                 'Web\Admin\CategoriesController@index')->name('categories.index');
        Route::get('/create',           'Web\Admin\CategoriesController@create')->name('categories.create');
        Route::post('/',                'Web\Admin\CategoriesController@store')->name('categories.store');
        Route::get('/{id}',             'Web\Admin\CategoriesController@show')->name('categories.show');
        Route::get('/{id}/edit',        'Web\Admin\CategoriesController@edit')->name('categories.edit');
        Route::put('/{id}',             'Web\Admin\CategoriesController@update')->name('categories.update');
        Route::delete('/{id}',          'Web\Admin\CategoriesController@destroy')->name('categories.destroy');
        Route::put('/status/{id}',      'Web\Admin\CategoriesController@status')->name('categories.status');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/',                 'Web\Admin\ProductsController@index')->name('products.index');
        Route::get('/create',           'Web\Admin\ProductsController@create')->name('products.create');
        Route::post('/',                'Web\Admin\ProductsController@store')->name('products.store');
        Route::get('/{id}',             'Web\Admin\ProductsController@show')->name('products.show');
        Route::get('/{id}/edit',        'Web\Admin\ProductsController@edit')->name('products.edit');
        Route::put('/{id}',             'Web\Admin\ProductsController@update')->name('products.update');
        Route::delete('/{id}',          'Web\Admin\ProductsController@destroy')->name('products.destroy');
        Route::put('/status/{id}',      'Web\Admin\ProductsController@status')->name('products.status');
        Route::get('/images/{id}',      'Web\Admin\ProductsController@imagesCreate')->name('products.images');
        Route::post('/images',          'Web\Admin\ProductsController@imagesSave')->name('products.saveImages');
        Route::delete('/images/{id}',   'Web\Admin\ProductsController@imagesDelete')->name('products.imagesDelete');
        Route::put('/images/status/{id}','Web\Admin\ProductsController@imagesStatus')->name('products.statusImages');
    });

    Route::group(['prefix' => 'topics'], function () {
        Route::get('/',                 'Web\Admin\TopicsController@index')->name('topics.index');
        Route::get('/create',           'Web\Admin\TopicsController@create')->name('topics.create');
        Route::post('/',                'Web\Admin\TopicsController@store')->name('topics.store');
        Route::get('/{id}',             'Web\Admin\TopicsController@show')->name('topics.show');
        Route::get('/{id}/edit',        'Web\Admin\TopicsController@edit')->name('topics.edit');
        Route::put('/{id}',             'Web\Admin\TopicsController@update')->name('topics.update');
        Route::delete('/{id}',          'Web\Admin\TopicsController@destroy')->name('topics.destroy');
        Route::put('/status/{id}',      'Web\Admin\TopicsController@status')->name('topics.status');
    });

    Route::group(['prefix' => 'faqs'], function () {
        Route::get('/',                 'Web\Admin\FaqsController@index')->name('faqs.index');
        Route::get('/create',           'Web\Admin\FaqsController@create')->name('faqs.create');
        Route::post('/',                'Web\Admin\FaqsController@store')->name('faqs.store');
        Route::get('/{id}',             'Web\Admin\FaqsController@show')->name('faqs.show');
        Route::get('/{id}/edit',        'Web\Admin\FaqsController@edit')->name('faqs.edit');
        Route::put('/{id}',             'Web\Admin\FaqsController@update')->name('faqs.update');
        Route::delete('/{id}',          'Web\Admin\FaqsController@destroy')->name('faqs.destroy');
        Route::put('/status/{id}',      'Web\Admin\FaqsController@status')->name('faqs.status');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/',                 'Web\Admin\BannersController@index')->name('banners.index');
        Route::get('/create',           'Web\Admin\BannersController@create')->name('banners.create');
        Route::post('/',                'Web\Admin\BannersController@store')->name('banners.store');
        Route::get('/{id}',             'Web\Admin\BannersController@show')->name('banners.show');
        Route::get('/{id}/edit',        'Web\Admin\BannersController@edit')->name('banners.edit');
        Route::put('/{id}',             'Web\Admin\BannersController@update')->name('banners.update');
        Route::delete('/{id}',          'Web\Admin\BannersController@destroy')->name('banners.destroy');
        Route::put('/status/{id}',      'Web\Admin\BannersController@status')->name('banners.status');
    });

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/',                 'Web\Admin\PagesController@index')->name('pages.index');
        Route::get('/create',           'Web\Admin\PagesController@create')->name('pages.create');
        Route::post('/',                'Web\Admin\PagesController@store')->name('pages.store');
        Route::get('/{id}',             'Web\Admin\PagesController@show')->name('pages.show');
        Route::get('/{id}/edit',        'Web\Admin\PagesController@edit')->name('pages.edit');
        Route::put('/{id}',             'Web\Admin\PagesController@update')->name('pages.update');
        Route::delete('/{id}',          'Web\Admin\PagesController@destroy')->name('pages.destroy');
        Route::put('/status/{id}',      'Web\Admin\PagesController@status')->name('pages.status');
    });
});
