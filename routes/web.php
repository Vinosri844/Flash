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

Route::get('/theme', 'Admin\SubCategoryController@layout')->name('layout');

//login
Route::get('/', 'Admin\SubCategoryController@login')->name('login');



//reports
Route::get('/product_price', 'Admin\SubCategoryController@product_price')->name('product_price');
Route::get('/seller_product', 'Admin\SubCategoryController@seller_product')->name('seller_product');
Route::get('/seller_selling', 'Admin\SubCategoryController@seller_selling')->name('seller_selling');
Route::get('/selling_invoice', 'Admin\SubCategoryController@selling_invoice')->name('selling_invoice');
Route::get('/shopping_cart', 'Admin\SubCategoryController@shopping_cart')->name('shopping_cart');
Route::get('/wishlist', 'Admin\SubCategoryController@wishlist')->name('wishlist');




Route::namespace('Admin')->group(function(){
    Route::resource('/event-master', 'MasterController');
    Route::resource('/sub-category', 'SubCategoryController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/delivery-slot-master', 'DeliverySlotMasterController');
    // Route::post('/event-master', 'MasterController@store')->name('event_master');
   
});
Route::get('/wishlist', 'Admin\BaseController@wishlist')->name('wishlist');
