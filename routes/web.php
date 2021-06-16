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

// Route::get('/', function () {
//     return view('welcome');
// }); // to show the welcome page 

Route::get('/', 'HomeController@index'); // take me direct to login page

Auth::routes(['register' => false, 'reset' => false]); // put false to disable the resgister page

Route::get('/home', 'HomeController@index')->name('home');

// for the user if he auth
Route::middleware(['auth'])->group(function(){
         
    // route for cashier
    Route::get('/cashier', 'Cashier\CashierController@index');
    Route::get('/cashier/getMenuByCategory/{category_id}', 'Cashier\CashierController@getMenuByCategory');
    Route::get('/cashier/getTable', 'Cashier\CashierController@getTables');
    Route::get('/cashier/getSaleDetailsByTable/{table_id}', 'Cashier\CashierController@getSaleDetailsByTable');
    
    Route::post('/cashier/orderFood', 'Cashier\CashierController@orderFood');

    Route::post('/cashier/deleteSaleDetail', 'Cashier\CashierController@deleteSaleDetail');
    Route::post('/cashier/increase-quantity', 'Cashier\CashierController@increaseQuantity');
    Route::post('/cashier/decrease-quantity', 'Cashier\CashierController@decreaseQuantity');
    
    Route::post('/cashier/confirmOrderStatus', 'Cashier\CashierController@confirmOrderStatus');
    Route::post('/cashier/savePayment', 'Cashier\CashierController@savePayment');
    Route::get('/cashier/showReceipt/{saleID}', 'Cashier\CashierController@showReceipt');
    
});

Route::middleware(['auth', 'VerifyAdmin'])->group(function(){
    
    Route::get('/management', function () {
        return view('management/index');
    });
    // route for management
    Route::resource('management/category', 'Management\CategoryController');
    Route::resource('management/menu', 'Management\MenuController');
    Route::resource('management/table', 'Management\TableController');
    Route::resource('management/user', 'Management\UserController');

    // route fot report
    Route::get('/report', 'Report\ReportController@index');
    Route::get('/report/show', 'Report\ReportController@show');
    
    //Export to excel
    Route::get('/report/show/export' , 'Report\ReportController@export');
});


