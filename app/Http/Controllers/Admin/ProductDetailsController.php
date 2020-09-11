<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductDetails;
use App\ProductWeightDetails;
use App\SellerBranch;
use App\SellerBranchProduct;
use App\Stock;
use App\SubCategory;
use App\WeightMaster;
use Illuminate\Http\Request;
use App\ProductMaster;
use App\SellerMaster;
use App\Userlogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\SellerProductPrice;
use CommonLib, CommonHelper, Image, File, Carbon, DB, Validator;

class ProductDetailsController extends Controller
{
    public function index()
    {
        $masters = ProductDetails::with('product','seller')->where('isdelete', 0)->orderBy('product_details_id', 'desc')->get();

        return view('productDetails.productDetail')->with('masters', $masters);
    }



    public function product_create(Request $request,$productdetail_id)
    {
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    'product_name' => 'required'
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('products')
                        ->withErrors($validator)
                        ->withInput();
                }
                $current_date = date('Y-m-d H:i:s');


            }
            else{

                $data['category'] = Category::orderBy('category_id', 'desc')->get();
                $data['subcategory'] = SubCategory::orderBy('subcategory_id', 'desc')->get();
                $data['seller'] = SellerMaster::where('isactive',1)->where('isdelete',0)->get();


                return view('products.product_create', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        {
            //  dd($e);
            DB::rollback();
            return redirect()->route('products')->with('error', $e->getMessage());
        }

    }


    public function productdetail_edit(Request $request,$productdetail_id){
        try{

            if($request->isMethod('post'))
            {

                $validator = Validator::make($request->input(), [
                ]);


                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('products')
                        ->withErrors($validator)
                        ->withInput();
                }
                //dd($productdetail_id);
                $current_date = date('Y-m-d H:i:s');
                DB::beginTransaction();
                $product_short_description=$request->product_short_description;
                $discount=$request->discount;
                $user = Auth::user();
                $isActive = isset($request->product_status) ? 1 : 0 ;
                $isActive_jain = isset($request->isAcive_jain) ? 1 : 0 ;
                $isActive_service = isset($request->isActive_service) ? 1 : 0 ;

                $ingredients = $request->ingredients;
                $remarks = $request->remarks;
                $title = $request->productdetail_title;


                $productdetail = ProductDetails::find($productdetail_id);
                $productdetail->product_id = $request->product_id;
                $productdetail->seller_id = $request->seller_id;
                $productdetail->product_details_ingredients = $ingredients;
                $productdetail->product_details_description = $product_short_description;
                $productdetail->product_details_remarks = $remarks;
                $productdetail->product_details_discount = $discount;
                $productdetail->product_details_title = $title;
                //  $product_details->create_date_time = $current_date;tproduct_name
                //  $product_details->update_date_time = $current_date;
                $productdetail->stock = 0;
                $productdetail->isactive = $isActive;
                $productdetail->isjain = $isActive_jain;
                $productdetail->isservice = $isActive_service;
                $productdetail->isdelete = 0;
                $productdetail->save();
                DB::commit();
                return redirect()->route('productDetails');
            }else{
                $data['productdetail'] = ProductDetails::find($productdetail_id);
                $data['products'] = ProductMaster::where('isdelete',0)->orderby('product_id','desc')->get();
                $data['seller'] = SellerMaster::where('isactive',1)->where('isdelete',0)->get();
                return view('productDetails.productdetail_edit', $data ?? NULL);

            }
        }catch (\Exception $exception){
            DB::rollback();
            return redirect()->route('productDetails')->with('error', $exception->getMessage());
        }

    }

    public function stock(Request $request,$productdetails_id){
        if($request->isMethod('post'))
        {
            $current_date = date('Y-m-d H:i:s');
            DB::beginTransaction();
          $productdetail = ProductDetails::find($productdetails_id);
            $stock = new Stock();
          $stock->weight_id = $request->weight;
          $stock->weight = $request->stock;
          $stock->date_time = $current_date;
          $stock->product_details_id = $productdetails_id;
          $stock->save();

            $discount = $productdetail->product_details_discount;
          $productweight = new ProductWeightDetails();
          $productweight->weight_id = $request->weight;
          $productweight->seller_price = $request->seller_price;
          $productweight->before_discount_price = $request->price;
          $productweight->price =round($request->price -(($request->price * $discount)/100));
          $productweight->product_details_id = $productdetails_id;
          $productweight->isdelete = 0;
          $productweight->save();

          $sellerproductprice = new SellerProductPrice();
          $sellerproductprice->product_weight_details_id  = $productweight->product_weight_details_id;
          $sellerproductprice->price =$request->price;
          $sellerproductprice->date_time = $current_date;
          $sellerproductprice->save();
         DB::commit();
            return redirect()->route('stock',$productdetails_id);

        }else{
            $productdetail = ProductDetails::find($productdetails_id);
            $data['product'] = ProductMaster::find($productdetail->product_id);
            $data['productdetail'] = $productdetail;
            $data['seller'] = SellerMaster::find($productdetail->seller_id);
            $data['weights'] = WeightMaster::where('isactive',1)->where('isdelete',0)->get();
            $data['stocks'] = DB::table('stock')
                ->join('weight_master','weight_master.weight_id','=','stock.weight_id')
                ->where('product_details_id','=',$productdetails_id)->get();
            return view('productDetails.stock', $data ?? NULL);
        }
    }
}
