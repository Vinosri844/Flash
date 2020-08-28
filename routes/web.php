<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/theme', 'Admin\BaseController@layout')->name('layout');

//login
Route::get('/', 'Admin\BaseController@login')->name('login');

Route::get('/category', 'Admin\BaseController@category')->name('category');
//category
Route::get('/category', 'Admin\BaseController@category')->name('category');
Route::post('/category', 'Admin\BaseController@category')->name('category_submit');
Route::get('/category/{id}', 'Admin\BaseController@category_edit')->name('category_edit');
Route::post('/category/{id}', 'Admin\BaseController@category_edit')->name('category_edit_submit');
Route::get('/category/{id}/delete','Admin\BaseController@category_destroy')->name('category_destroy');

Route::post('ca-changeStatus', 'Admin\BaseController@ca_changeStatus');

Route::get('/subcategory', 'Admin\BaseController@subcategory')->name('subcategory');

//reports
Route::get('/product_price', 'Admin\BaseController@product_price')->name('product_price');
Route::get('/seller_product', 'Admin\BaseController@seller_product')->name('seller_product');
Route::get('/seller_selling', 'Admin\BaseController@seller_selling')->name('seller_selling');
Route::get('/selling_invoice', 'Admin\BaseController@selling_invoice')->name('selling_invoice');
Route::get('/shopping_cart', 'Admin\BaseController@shopping_cart')->name('shopping_cart');
Route::get('/wishlist', 'Admin\BaseController@wishlist')->name('wishlist');




Route::namespace('Admin')->group(function(){
    Route::resource('/event-master', 'MasterController');
    Route::resource('/delivery-slot-master', 'DeliverySlotMasterController');
    // Route::post('/event-master', 'MasterController@store')->name('event_master');
});
Route::get('/wishlist', 'Admin\BaseController@wishlist')->name('wishlist');
