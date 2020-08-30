<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\ProductDetails;
use App\SellerBranch;
use App\SellerBranchProduct;
use App\SubCategory;
use Illuminate\Http\Request;
use App\ProductMaster;
use App\SellerMaster;
use App\Userlogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
}
