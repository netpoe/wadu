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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * ADMIN ORDERS
 */
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::post('/admin/orders/create', 'OrdersController@create')->name('admin.orders.create');
    Route::get('/admin/orders/new', 'OrdersController@new')->name('admin.orders.new');
});
