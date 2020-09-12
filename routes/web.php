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
Route::get('/', 'Auth\LoginController@login')->name('login');
Route::get('/login', 'Auth\LoginController@login')->name('login');
   Route::post('/login-post', 'Auth\LoginController@loginSubmit')->name('loginSubmit');


//category
Route::get('/category', 'Admin\CategoryController@index')->name('category');
Route::get('/category-create', 'Admin\CategoryController@category_create')->name('category_create');
Route::post('/category-create', 'Admin\CategoryController@category_create')->name('category_submit');
Route::get('/category/{id}', 'Admin\CategoryController@category_edit')->name('category_edit');
Route::post('/category/{id}', 'Admin\CategoryController@category_edit')->name('category_edit_submit');
Route::get('/category/{id}/delete','Admin\CategoryController@category_destroy')->name('category_destroy');

//subcategory
Route::get('/subcategory', 'Admin\CategoryController@sc_index')->name('subcategory');
Route::get('/subcategory-create', 'Admin\CategoryController@subcategory_create')->name('subcategory_create');
Route::post('/catby-subcategory', 'Admin\CategoryController@catby_subcategory')->name('catby_subcategory');
Route::post('/subcategory-create', 'Admin\CategoryController@subcategory_create')->name('subcategory_submit');
Route::get('/subcategory/{id}', 'Admin\CategoryController@subcategory_edit')->name('subcategory_edit');
Route::post('/subcategory/{id}', 'Admin\CategoryController@subcategory_edit')->name('subcategory_edit_submit');
Route::get('/subcategory/{id}/delete','Admin\CategoryController@sc_destroy')->name('subcategory_destroy');

//products
Route::get('/products', 'Admin\ProductController@index')->name('products');
Route::get('/product-create', 'Admin\ProductController@product_create')->name('product_create');
Route::post('/product-create', 'Admin\ProductController@product_create')->name('product_submit');
Route::get('/product/{id}', 'Admin\ProductController@product_edit')->name('product_edit');
Route::post('/product/{id}', 'Admin\ProductController@product_edit')->name('product_edit_submit');
Route::get('/product/{id}/delete','Admin\ProductController@product_delete')->name('product_delete');

//product_details
Route::get('/productDetails', 'Admin\ProductDetailsController@index')->name('productDetails');
Route::get('/productDetails/{id}', 'Admin\ProductDetailsController@productdetail_edit')->name('productDetail_edit');
Route::post('/productDetails/{id}', 'Admin\ProductDetailsController@productdetail_edit')->name('productDetail_edit_submit');
Route::get('/productDetails/{id}/delete','Admin\ProductDetailsController@product_delete')->name('productDetail_delete');

Route::get('/stock/{id}', 'Admin\ProductDetailsController@stock')->name('stock');
Route::post('/stock/{id}', 'Admin\ProductDetailsController@stock')->name('stock_submit');

//delivery
Route::get('/deliveryperson-add', 'Admin\DeliveryPersonController@deliveryperson_add')->name('deliveryperson_add');
Route::post('/deliveryperson-add', 'Admin\DeliveryPersonController@deliveryperson_add')->name('deliveryperson_submit');
Route::get('/deliveryperson-edit/{id}', 'Admin\DeliveryPersonController@deliveryperson_edit')->name('deliveryperson_edit');
Route::post('/deliveryperson-edit/{id}', 'Admin\DeliveryPersonController@deliveryperson_edit')->name('deliverypersonedit_submit');
Route::get('/deliveryperson-delete/{id}/delete', 'Admin\DeliveryPersonController@deliveryperson_delete')->name('deliveryperson_delete');

Route::get('/deliverypersons', 'Admin\DeliveryPersonController@index')->name('deliverypersons');

//Bulk Order
Route::get('/bulkorder', 'Admin\BulkOrderController@bulkorder')->name('bulkorder');
Route::POST('/bulkorder', 'Admin\BulkOrderController@bulkorder')->name('bulkorder_submit');
Route::get('/bulkorderusers', 'Admin\BulkOrderController@bulkorderusers')->name('bulkorderusers');


//reports
Route::get('/product_price', 'Admin\SubCategoryController@product_price')->name('product_price');
Route::get('/seller_product', 'Admin\SubCategoryController@seller_product')->name('seller_product');
Route::get('/seller_selling', 'Admin\SubCategoryController@seller_selling')->name('seller_selling');
Route::get('/selling_invoice', 'Admin\SubCategoryController@selling_invoice')->name('selling_invoice');
Route::get('/shopping_cart', 'Admin\SubCategoryController@shopping_cart')->name('shopping_cart');
Route::get('/wishlist', 'Admin\SubCategoryController@wishlist')->name('wishlist');




Route::namespace('Admin')->group(function(){
    Route::resource('/event-master', 'MasterController');
    //Route::resource('/sub-category', 'SubCategoryController');
    //Route::resource('/category', 'CategoryController');
    Route::resource('/delivery-slot-master', 'DeliverySlotMasterController');
    Route::resource('/store', 'StoreController');
    Route::resource('/customer', 'CustomerController');
    Route::resource('/membership', 'MembershipController');
    // Route::resource('/customer-address', 'CustomerAddressController');
    Route::resource('/store-offer', 'StoreOfferController');
    Route::resource('/category-offer', 'CategoryOfferController');
    Route::resource('/recipe-master', 'RecipeMasterController');
    Route::resource('/excel', 'ExportExcelController');

    // Route::post('/event-master', 'MasterController@store')->name('event_master');
    Route::get('/customer-order/{order}', 'CustomerController@order')->name('customer.order');
    Route::get('/customer-address/{address}', 'CustomerController@address')->name('customer.address');
    Route::post('change-status', 'CommonController@change_status')->name('change.status');

});
Route::get('/wishlist', 'Admin\BaseController@wishlist')->name('wishlist');
