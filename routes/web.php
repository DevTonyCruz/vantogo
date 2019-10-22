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
    //Route::get('register', 'Web\Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
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

    Route::group(['prefix' => 'drivers'], function () {
        Route::get('/',                 'Web\Admin\DriversController@index')->name('drivers.index');
        Route::get('/create',           'Web\Admin\DriversController@create')->name('drivers.create');
        Route::post('/',                'Web\Admin\DriversController@store')->name('drivers.store');
        Route::get('/{id}',             'Web\Admin\DriversController@show')->name('drivers.show');
        Route::get('/{id}/edit',        'Web\Admin\DriversController@edit')->name('drivers.edit');
        Route::put('/{id}',             'Web\Admin\DriversController@update')->name('drivers.update');
        Route::delete('/{id}',          'Web\Admin\DriversController@destroy')->name('drivers.destroy');
        Route::put('/status/{id}',      'Web\Admin\DriversController@status')->name('drivers.status');
    });

    Route::group(['prefix' => 'cars'], function () {
        Route::get('/',                 'Web\Admin\CarsController@index')->name('cars.index');
        Route::get('/create',           'Web\Admin\CarsController@create')->name('cars.create');
        Route::post('/',                'Web\Admin\CarsController@store')->name('cars.store');
        Route::get('/{id}',             'Web\Admin\CarsController@show')->name('cars.show');
        Route::get('/{id}/edit',        'Web\Admin\CarsController@edit')->name('cars.edit');
        Route::put('/{id}',             'Web\Admin\CarsController@update')->name('cars.update');
        Route::delete('/{id}',          'Web\Admin\CarsController@destroy')->name('cars.destroy');
        Route::put('/status/{id}',      'Web\Admin\CarsController@status')->name('cars.status');
    });

    Route::group(['prefix' => 'routes'], function () {
        Route::get('/',                 'Web\Admin\RoutesController@index')->name('routes.index');
        Route::get('/create',           'Web\Admin\RoutesController@create')->name('routes.create');
        Route::post('/',                'Web\Admin\RoutesController@store')->name('routes.store');
        Route::get('/{id}',             'Web\Admin\RoutesController@show')->name('routes.show');
        Route::get('/{id}/edit',        'Web\Admin\RoutesController@edit')->name('routes.edit');
        Route::put('/{id}',             'Web\Admin\RoutesController@update')->name('routes.update');
        Route::delete('/{id}',          'Web\Admin\RoutesController@destroy')->name('routes.destroy');
        Route::put('/status/{id}',      'Web\Admin\RoutesController@status')->name('routes.status');
    });

    Route::group(['prefix' => 'travels'], function () {
        Route::get('/',                 'Web\Admin\TravelsController@index')->name('travels.index');
        Route::get('/create',           'Web\Admin\TravelsController@create')->name('travels.create');
        Route::post('/',                'Web\Admin\TravelsController@store')->name('travels.store');
        Route::get('/{id}',             'Web\Admin\TravelsController@show')->name('travels.show');
        Route::get('/{id}/edit',        'Web\Admin\TravelsController@edit')->name('travels.edit');
        Route::put('/{id}',             'Web\Admin\TravelsController@update')->name('travels.update');
        Route::delete('/{id}',          'Web\Admin\TravelsController@destroy')->name('travels.destroy');
        Route::put('/status/{id}',      'Web\Admin\TravelsController@status')->name('travels.status');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/',                 'Web\Admin\ProfileController@index')->name('profile.index');
        /*Route::get('/create',           'Web\Admin\ProfileController@create')->name('profile.create');
        Route::post('/',                'Web\Admin\ProfileController@store')->name('profile.store');
        Route::get('/{id}/edit',        'Web\Admin\ProfileController@edit')->name('profile.edit');
        Route::put('/{id}',             'Web\Admin\ProfileController@update')->name('profile.update');
        Route::delete('/{id}',          'Web\Admin\ProfileController@destroy')->name('profile.destroy');
        Route::put('/status/{id}',      'Web\Admin\ProfileController@status')->name('profile.status');*/
    });
});


Route::get('/',                 'Web\Front\HomeController@index')->name('front.home.index');
Route::post('/viaje',           'Web\Front\HomeController@viaje')->name('front.home.viaje');
Route::get('/asientos',         'Web\Front\HomeController@asientos')->name('front.home.asientos');
Route::post('/pasajeros',       'Web\Front\HomeController@pasajeros')->name('front.home.pasajeros');
Route::get('/pago',             'Web\Front\HomeController@pago')->name('front.home.pago');

Route::group(['prefix' => 'payment'], function () {
    Route::post('/cart', 'Web\Front\PaymentController@cartPayment')->name('payment.cart');
});
/*Route::post('/',                'Web\Admin\RolesController@store')->name('roles.store');
Route::get('/{id}',             'Web\Admin\RolesController@show')->name('roles.show');
Route::get('/{id}/edit',        'Web\Admin\RolesController@edit')->name('roles.edit');
Route::put('/{id}',             'Web\Admin\RolesController@update')->name('roles.update');
Route::delete('/{id}',          'Web\Admin\RolesController@destroy')->name('roles.destroy');
Route::put('/status/{id}',      'Web\Admin\RolesController@status')->name('roles.status');
Route::get('/permission/{id}',  'Web\Admin\RolesController@permission')->name('roles.permission');
Route::put('/permission/{id}',  'Web\Admin\RolesController@save_permission')->name('roles.savePermission');*/
