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



Auth::routes();


Route::get('/', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login_submit')->name('login.submit');

Route::group(['middleware' => 'auth'], function () {

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

Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');


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
Route::get('/productDetails/{id}/delete','Admin\ProductDetailsController@productdetail_delete')->name('productDetail_delete');
Route::get('/stock/{id}/delete','Admin\ProductDetailsController@stock_delete')->name('stock_delete');

Route::get('/stock/{id}', 'Admin\ProductDetailsController@stock')->name('stock');
Route::post('/stock/{id}', 'Admin\ProductDetailsController@stock')->name('stock_submit');

//delivery
Route::get('/deliveryperson-add', 'Admin\DeliveryPersonController@deliveryperson_add')->name('deliveryperson_add');
Route::post('/deliveryperson-add', 'Admin\DeliveryPersonController@deliveryperson_add')->name('deliveryperson_submit');
Route::get('/deliveryperson-edit/{id}', 'Admin\DeliveryPersonController@deliveryperson_edit')->name('deliveryperson_edit');
Route::post('/deliveryperson-edit/{id}', 'Admin\DeliveryPersonController@deliveryperson_edit')->name('deliverypersonedit_submit');
Route::get('/deliveryperson-delete/{id}/delete', 'Admin\DeliveryPersonController@deliveryperson_delete')->name('deliveryperson_delete');

Route::get('/deliverypersons', 'Admin\DeliveryPersonController@index')->name('deliverypersons');
Route::get('/sliders', 'Admin\SliderController@index')->name('sliders');
Route::get('/slider-add', 'Admin\SliderController@slider_create')->name('slider_add');
Route::POST('/slider-add', 'Admin\SliderController@slider_create')->name('slider_submit');
Route::get('/slider-edit/{id}', 'Admin\SliderController@slider_edit')->name('slider_edit');
Route::POST('/slider-edit/{id}', 'Admin\SliderController@slider_edit')->name('slideredit_submit');
Route::get('/slider/{id}/delete','Admin\SliderController@slider_delete')->name('slider_delete');


Route::get('/placed_orders', 'Admin\OrderListController@placed_orders')->name('placed_orders');
Route::get('/assign-orders', 'Admin\OrderListController@assign_orders')->name('assign_orders');
Route::get('/pickup-orders', 'Admin\OrderListController@progress_orders')->name('pickup_orders');
Route::get('/delivered-orders', 'Admin\OrderListController@delivered_orders')->name('delivered_orders');
Route::get('/cancel-orders', 'Admin\OrderListController@cancel_orders')->name('cancel_orders');
Route::post('/assign-order', 'Admin\OrderListController@assign_order')->name('assign_order');
Route::post('/update-status', 'Admin\OrderListController@update_status')->name('update_status');


Route::get('/paymenttypes', 'Admin\PaymentTypeController@index')->name('paymenttypes');
Route::get('/paymenttype-add', 'Admin\PaymentTypeController@paymenttype_create')->name('paymenttype_add');
Route::POST('/paymenttype-add', 'Admin\PaymentTypeController@paymenttype_create')->name('paymenttype_submit');
Route::get('/paymenttype-edit/{id}', 'Admin\PaymentTypeController@paymenttype_edit')->name('paymenttype_edit');
Route::POST('/paymenttype-edit/{id}', 'Admin\PaymentTypeController@paymenttype_edit')->name('paymenttypeedit_submit');
Route::get('/Paymenttype/{id}/delete','Admin\PaymentTypeController@paymenttype_delete')->name('paymenttype_delete');

Route::get('/smstemplates', 'Admin\SmstemplateController@index')->name('smstemplates');
Route::get('/smstemplate-add', 'Admin\SmstemplateController@smstemplate_create')->name('smstemplate_add');
Route::POST('/smstemplate-add', 'Admin\SmstemplateController@smstemplate_create')->name('smstemplate_submit');
Route::get('/smstemplate-edit/{id}', 'Admin\SmstemplateController@smstemplate_edit')->name('smstemplate_edit');
Route::POST('/smstemplate-edit/{id}', 'Admin\SmstemplateController@smstemplate_edit')->name('smstemplateedit_submit');
Route::get('/smstemplate/{id}/delete','Admin\SmstemplateController@smstemplate_delete')->name('smstemplate_delete');

Route::get('/deliverycharges', 'Admin\DeliveryChargeMasterController@index')->name('deliverycharges');
Route::get('/deliverycharges-add', 'Admin\DeliveryChargeMasterController@deliverycharge_create')->name('deliverycharge_add');
Route::POST('/deliverycharges-add', 'Admin\DeliveryChargeMasterController@deliverycharge_create')->name('deliverycharge_submit');
Route::get('/deliverycharges-edit/{id}', 'Admin\DeliveryChargeMasterController@deliverycharge_edit')->name('deliverycharge_edit');
Route::POST('/deliverycharges-edit/{id}', 'Admin\DeliveryChargeMasterController@deliverycharge_edit')->name('deliverychargeedit_submit');
Route::get('/deliverycharges/{id}/delete','Admin\DeliveryChargeMasterController@deliverycharge_delete')->name('deliverycharge_delete');
//Bulk Order
Route::get('/bulkorder', 'Admin\BulkOrderController@bulkorder')->name('bulkorder');
Route::POST('/bulkorder', 'Admin\BulkOrderController@bulkorder')->name('bulkorder_submit');
Route::get('/bulkorderusers', 'Admin\BulkOrderController@bulkorderusers')->name('bulkorderusers');

//Notifications
Route::get('/notifications', 'Admin\NotificationController@index')->name('notifications');
Route::get('/send-notification', 'Admin\NotificationController@send_notification')->name('send_notification');
Route::post('/send-notification', 'Admin\NotificationController@send_notification')->name('send_notification_submit');
Route::post('/resend-notification', 'Admin\NotificationController@resend_notification')->name('resend_notification');


//reports
Route::get('/product_price', 'Admin\SubCategoryController@product_price')->name('product_price');
Route::get('/seller_product', 'Admin\SubCategoryController@seller_product')->name('seller_product');
Route::get('/seller_selling', 'Admin\SubCategoryController@seller_selling')->name('seller_selling');
Route::get('/selling_invoice', 'Admin\SubCategoryController@selling_invoice')->name('selling_invoice');
Route::get('/shopping_cart', 'Admin\SubCategoryController@shopping_cart')->name('shopping_cart');
Route::get('/wishlist', 'Admin\SubCategoryController@wishlist')->name('wishlist');

Route::get('/weights', 'Admin\WeightMasterController@index')->name('weights');
Route::get('/weight-add', 'Admin\WeightMasterController@weight_create')->name('weight_add');
Route::POST('/weight-add', 'Admin\WeightMasterController@weight_create')->name('weight_submit');
Route::get('/weight-edit/{id}', 'Admin\WeightMasterController@weight_edit')->name('weight_edit');
Route::POST('/weight-edit/{id}', 'Admin\WeightMasterController@weight_edit')->name('weightedit_submit');
Route::get('/weight/{id}/delete','Admin\WeightMasterController@weight_delete')->name('weight_delete');

Route::get('/standerd-pincodes', 'Admin\PincodeMasterController@sdindex')->name('sdpincodes');
Route::get('/SDpincode-add', 'Admin\PincodeMasterController@sdpincode_create')->name('sdpincode_add');
Route::POST('/SDpincode-add', 'Admin\PincodeMasterController@sdpincode_create')->name('sdpincode_submit');
Route::get('/SDpincode-edit/{id}', 'Admin\PincodeMasterController@sdpincode_edit')->name('sdpincode_edit');
Route::POST('/SDpincode-edit/{id}', 'Admin\PincodeMasterController@sdpincode_edit')->name('sdpincodeedit_submit');
Route::get('/SDpincode/{id}/delete','Admin\PincodeMasterController@sdpincode_delete')->name('sdpincode_delete');
Route::get('/Extended-pincodes', 'Admin\PincodeMasterController@edindex')->name('edpincodes');
Route::get('/EDpincode-add', 'Admin\PincodeMasterController@edpincode_create')->name('edpincode_add');
Route::POST('/EDpincode-add', 'Admin\PincodeMasterController@edpincode_create')->name('edpincode_submit');
Route::get('/EDpincode-edit/{id}', 'Admin\PincodeMasterController@edpincode_edit')->name('edpincode_edit');
Route::POST('/EDpincode-edit/{id}', 'Admin\PincodeMasterController@edpincode_edit')->name('edpincodeedit_submit');
Route::get('/EDpincode/{id}/delete','Admin\PincodeMasterController@edpincode_delete')->name('edpincode_delete');

Route::namespace('Admin')->group(function(){
        Route::resource('/event-master', 'MasterController');
        Route::resource('/delivery-slot-master', 'DeliverySlotMasterController');
        Route::resource('/store', 'StoreController');
        Route::resource('/customer', 'CustomerController');
        Route::resource('/membership', 'MembershipController');
        Route::resource('/store-offer', 'StoreOfferController');
        Route::resource('/category-offer', 'CategoryOfferController');
        Route::resource('/recipe-master', 'RecipeMasterController');
        Route::resource('/setting', 'SettingController');
        Route::resource('/footer', 'FooterController');
        Route::resource('/recipe-category', 'RecipeCategoryController');
        Route::resource('/recipe-sub-category', 'RecipeSubCategoryController');
        Route::resource('/manager', 'ProfileController');

        Route::get('/customer-order/{order}', 'CustomerController@order')->name('customer.order');
        Route::get('/customer-address/{address}', 'CustomerController@address')->name('customer.address');
        Route::post('/change-status', 'CommonController@change_status')->name('change.status');
        Route::get('/selling-report', 'ReportController@selling_report')->name('selling-report.index');
        Route::get('/selling-invoice', 'ReportController@selling_invoice')->name('selling-invoice.index');
        Route::get('/product-price', 'ReportController@product_price')->name('product-price.index');
        Route::get('/excel/{name}', 'ExportExcelController@excel_download')->name('excel.index');
        Route::post('/excel-import/{name}', 'ImportExcelController@excel_import')->name('excel_import.index');
    });

});
