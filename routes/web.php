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




//This route run when user is not login 
Route::group(['middleware' => ['CheckNotLogin']], function () {
	Route::get('/', function () {
    return view('admin.login');
});
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('getlogindata', 'LoginController@getLoginData')->name('getlogindata');
    Route::post('getsignupdata', 'LoginController@getSignupData')->name('getsignupdata');
    Route::post('getforgotpassworddata', 'LoginController@getForgotPasswordData')->name('getforgotpassworddata');

    Route::get('reset_password/{code}', 'LoginController@resetPassword')->name('reset_password');
    Route::post('getresetpassworddata', 'LoginController@getResetPasswordData')->name('getresetpassworddata');
    Route::get('verify_otp', 'LoginController@verify_otp')->name('verify_otp');
});

//This route is run when user is login
Route::group(['middleware' => ['CheckLogin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //This route for profile 
    Route::get('profile', 'DashboardController@profile')->name('profile');
    Route::post('update_profile_details', 'DashboardController@updateProfile')->name('update_profile_details');
    Route::get('change_password', 'DashboardController@changePassword')->name('change_password');
    Route::post('set_change_password', 'DashboardController@setChangePassword')->name('set_change_password');

    //This route for employee
    Route::get('employee/list', 'EmployeeController@index')->name('employeelist');
    Route::get('employee/add', 'EmployeeController@add')->name('add_employee');
    Route::post('employee/add_data', 'EmployeeController@add_data')->name('add_employee_data');
    Route::get('employee/edit/{id?}', 'EmployeeController@edit')->name('edit_employee');
    Route::post('employee/update', 'EmployeeController@update')->name('edit_employee_data');

    //This route for users
    Route::get('users/list', 'UserController@index')->name('userslist');
    Route::post('users/search_data', 'UserController@getUserListDataByAjax')->name('users_search_data');
    Route::get('user/add', 'UserController@add')->name('add_user');
    Route::post('user/add_data', 'UserController@add_data')->name('add_user_data');
    Route::get('user/edit/{id?}', 'UserController@edit')->name('edit_user');
    Route::post('user/update', 'UserController@update')->name('edit_user_data');
    Route::get('user/view/{id?}', 'UserController@view')->name('view_user');

    //This route for orders of the user
    Route::get('orders/list', 'OrdersController@index')->name('orderslist');
    Route::post('orders/table_list', 'OrdersController@ordersTableData')->name('orders_table_list');
    Route::post('orders/get_order_data', 'OrdersController@getOrderData')->name('get_order_data');
    Route::get('orders/view/{id?}', 'OrdersController@view')->name('view_order');
   
    Route::post('orders/addweight', 'OrdersController@addOrderWeight')->name('orders_add_weight');
    Route::post('orders/changestatus', 'OrdersController@changeOrderStatus')->name('change_order_status');

    //This route for offers
    Route::get('offers/list', 'OfferController@index')->name('offerslist');
    Route::get('offers/add', 'OfferController@add')->name('add_offer');
    Route::post('offers/add_data', 'OfferController@add_data')->name('add_offer_data');
    Route::get('offers/edit/{id?}', 'OfferController@edit')->name('edit_offer');
    Route::post('offers/update', 'OfferController@update')->name('edit_offer_data');

    //This route for services
    Route::get('services/list', 'ServicesController@index')->name('serviceslist');
    Route::get('services/{type}/{id?}/', 'ServicesController@operations')->name('services_operation');
    Route::post('services/getservicedata', 'ServicesController@get_service_data')->name('get_service_data');

    //This route for services category
    Route::get('services_category/list', 'ServicesController@services_category')->name('servicescategorylist');
    Route::get('services_category/{type}/{id?}/', 'ServicesController@services_category_operations')->name('services_category_operation');
    Route::post('services_category/getservicedata', 'ServicesController@get_service_category_data')->name('get_service_category_data');

    //This route for services category type
    Route::get('services_category_type/list', 'ServicesController@services_category_type')->name('servicescategorytypelist');
    Route::get('services_category_type/{type}/{id?}/', 'ServicesController@services_category_type_operations')->name('services_category_type_operation');
    Route::post('services_category_type/getservicedata', 'ServicesController@get_services_category_type_data')->name('get_services_category_type_data');

    //Wallet Route
    Route::get('wallet/history/{id?}', 'walletController@index')->name('wallet_history');
    Route::post('wallet/addamount', 'walletController@add_amount')->name('add_amount');
});



Route::group(['middleware' => ['CheckLogin']], function () {
    Route::get('logout', 'LoginController@logout')->name('logout');
});


//This route is for execute migration
Route::get('migrate', function () {
    Artisan::call('migrate');

    return 'Database migration success.';
});
