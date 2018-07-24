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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

Route::get('/home', 'HomeController@index')->name('home');

/**
 * ADMIN ORDERS
 */
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::post('/admin/orders/create', 'OrdersController@create')->name('admin.orders.create');
    Route::get('/admin/orders/{order}/greet', 'OrdersController@greet')->name('admin.orders.greet');
    Route::get('/admin/orders/new', 'OrdersController@new')->name('admin.orders.new');
    Route::get('/admin/orders', 'OrdersController@index')->name('admin.orders.index');
    Route::get('/admin/orders/{order}', 'OrdersController@show')->name('admin.orders.show');
    Route::get('/admin/orders/{order?}/process', 'OrdersController@process')->name('admin.orders.process');
    Route::get('/admin/orders/{order}/ready-to-ship', 'OrdersController@readyToShip')->name('admin.orders.ready-to-ship');
    Route::get('/admin/orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');
});

/**
 * ADMIN BUSINESS
 */
// TODO only BUSINESS_OWNER can see this page
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::post('/admin/business/users/{user}/update', 'BusinessController@updateUser')->name('admin.business.users.update');
    Route::post('/admin/business/users/create', 'BusinessController@createUser')->name('admin.business.users.create');
    Route::get('/admin/business/users', 'BusinessController@users')->name('admin.business.users');
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
    Route::get('/menu/{businessSlug}/order/{order}', 'MenuController@index')->name('front.menu.index');
    Route::get('/menu/preview', 'MenuController@preview')->name('front.menu.preview');
});

/**
 * FRONT SHIPPING
 */
Route::group(['namespace' => 'Front'], function(){
    Route::post('/shipping/{order}', 'ShippingController@store')->name('front.shipping.store');
});

/**
 * FRONT ORDERS
 */
Route::group(['namespace' => 'Front'], function(){
    Route::post('/orders/{order}/add/{product}', 'OrdersController@add')->name('front.orders.add');
    Route::post('/orders/{order}/subtract/{product}', 'OrdersController@subtract')->name('front.orders.subtract');
    Route::post('/orders/{order}/payment-type', 'OrdersController@paymentType')->name('front.orders.payment-type');
    Route::get('/orders/{order}/shipping', 'OrdersController@shipping')->name('front.orders.shipping');
    Route::get('/orders/{order}/checkout', 'OrdersController@checkout')->name('front.orders.checkout');
    Route::get('/orders/{order}/pending', 'OrdersController@pending')->name('front.orders.pending');
    Route::get('/orders/{business}/new', 'OrdersController@new')->name('front.orders.new');
});

/**
 * FRONT CHECKOUT
 */
Route::group(['namespace' => 'Front'], function(){
    Route::post('/checkout/{order}/store', 'CheckoutController@store')->name('front.checkout.store');
});
