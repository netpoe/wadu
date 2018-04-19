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
    Route::get('/admin/orders/{order}/greet', 'OrdersController@greet')->name('admin.orders.greet');
    Route::get('/admin/orders/new', 'OrdersController@new')->name('admin.orders.new');
});

/**
 * ADMIN MENU
 */
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::get('/admin/menu/edit', 'MenuController@edit')->name('admin.menu.edit');
    Route::get('/admin/menu', 'MenuController@index')->name('admin.menu.index');
});

/**
 * ADMIN PRODUCTS
 */
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::post('/admin/products/create', 'ProductsController@create')->name('admin.products.create');
    Route::post('/admin/products/{product}/update', 'ProductsController@update')->name('admin.products.update');
});

/**
 * ADMIN PRODUCT CATEGORIES
 */
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::post('/admin/product-categories/create', 'ProductCategoriesController@create')->name('admin.product-categories.create');
    Route::post('/admin/product-categories/{productCategory}/update', 'ProductCategoriesController@update')->name('admin.product-categories.update');
});

/**
 * FRONT MENU
 */
Route::group(['namespace' => 'Front'], function(){
    Route::get('/menu/{businessSlug}/{user?}', 'MenuController@index')->name('front.menu.index');
});

/**
 * FRONT ORDERS
 */
Route::group(['namespace' => 'Front'], function(){
    Route::post('/orders/{order}/add/{product}', 'OrdersController@add')->name('front.orders.add');
    Route::post('/orders/{order}/subtract/{product}', 'OrdersController@subtract')->name('front.orders.subtract');
    Route::get('/orders/{order}/shipping', 'OrdersController@shipping')->name('front.orders.shipping');
});
