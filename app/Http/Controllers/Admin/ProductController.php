<?php

namespace App\Http\Controllers\admin;

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
class ProductController extends Controller
{


    public function index()
    {
        $masters = ProductMaster::with('subcategory')->where('isdelete', 0)->orderBy('product_id', 'desc')->get();

        return view('products.product')->with('masters', $masters);
    }


    public function product_create(Request $request)
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

                $category_id=$request->category_id;
                $subcategory_id=$request->subcat_id;
                $category = Category::find($category_id);
                $subcategory =SubCategory::find($subcategory_id);
                $subcategory_name=$subcategory['subcategory_name'];
                $product_name=$request->product_name;
                $product_short_description=$request->product_short_description;
                $optional_value=$request->optional_name;
                $user = Auth::user();

                $tproduct_name=$request->tproduct_name;
                $tproduct_short_description=$request->tproduct_short_description;
                $isActive = isset($request->product_status) ? 1 : 0 ;
                $isActive_jain = isset($request->isAcive_jain) ? 1 : 0 ;
                $isActive_service = isset($request->isActive_service) ? 1 : 0 ;
                $seller_ids = $request->productstore_id;

                $ingredients = $request->ingredients;
                $t_ingredients = $request->t_ingredients;
                $remarks = $request->remarks;
                $title = $request->product_title;
                DB::beginTransaction();
                $product = new ProductMaster();
                $product->product_name=$product_name;
                $product->subcategory_id=$subcategory_id;
                $product->product_description=$product_short_description;
                $product->product_alias_name=$optional_value;
                $product->user_id=isset($user->user_id) ? $user->user_id : 1;
                $product->created_date_time=$current_date;
                $product->update_date_time=$current_date;
                $product->isactive=$isActive;
                $product->tproduct_name=$tproduct_name;
                $product->tproduct_description=$tproduct_short_description;
                $check = $product->save();
              //  userlog
                $userlog_description="Insert Product Name - ".$product_name;
                $userlog = new Userlogs();
                $userlog->form_name = 'Product';
                $userlog->operation_type = 'insert';
                $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;;
                $userlog->log_date_time = $current_date;
                $userlog->description = $userlog_description;
                $userlog->OS = $request->os ? $request->os : "windows";
                $userlog->table_name = 'product_master';
                $userlog->reference_id = $product->product_id;
                $userlog->ip_device_id = $request->getHost();
                $userlog->user_type_id = 4;
                $userlog->save();
              //product details insert
                if($product->product_id){
                    foreach ($seller_ids as $seller_id) {
                      $product_details = new ProductDetails();
                      $product_details->product_id = $product->product_id;
                      $product_details->seller_id = $seller_id;
                      $product_details->product_details_ingredients = $ingredients;
                      $product_details->product_details_description = $product_short_description;
                      $product_details->product_details_remarks = $remarks;
                      $product_details->product_details_discount = 0;
                      $product_details->product_details_title = $title;
                    //  $product_details->create_date_time = $current_date;
                    //  $product_details->update_date_time = $current_date;
                      $product_details->stock = 0;
                      $product_details->isactive = 0;
                      $product_details->isjain = $isActive_jain;
                      $product_details->isservice = $isActive_service;
                      $product_details->isdelete = 0;
                      $product_details->t_product_details_ingredients = $t_ingredients;
                      $product_details->t_product_details_description = $tproduct_short_description;
                      $product_details->save();

               //product details log
                     if($product_details->product_details_id ){
                         $row_branch =  SellerBranch::with('seller')->where('seller_id',$seller_id)->first();
                         $userlog_description = "Insert Product Details as seller name-" . $row_branch->seller[0]['seller_name'] . " and product name-" . $product_name;
                         $userlog = new Userlogs();
                         $userlog->form_name = 'Product Details';
                         $userlog->operation_type = 'insert';
                         $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;;
                         $userlog->log_date_time = $current_date;
                         $userlog->description = $userlog_description;
                         $userlog->OS = $request->os ? $request->os : "windows";
                         $userlog->table_name = 'product_details';
                         $userlog->reference_id = $product_details->product_details_id;
                         $userlog->ip_device_id = $request->getHost();
                         $userlog->user_type_id = 4;
                         $userlog->save();
                     }
                        $branch_id = $row_branch->seller_branch_id;
                        $branchproduct = new SellerBranchProduct();
                        $branchproduct->product_details_id =   $product_details->product_details_id;
                        $branchproduct->seller_id = $seller_id;
                        $branchproduct->seller_branch_id = $branch_id;
                        $branchproduct->isactive = 1;
                        $branchproduct->isdelete = 0;
                        $branchproduct->save();
                        if($branchproduct->seller_branch_product_id){
                            $userlog_description = "Insert Seller Branch Product name-" . $product_name;
                            $userlog = new Userlogs();
                            $userlog->form_name = 'Branch Product name';
                            $userlog->operation_type = 'insert';
                            $userlog->user_id = isset($user->user_id) ? $user->user_id : 1;;
                            $userlog->log_date_time = $current_date;
                            $userlog->description = $userlog_description;
                            $userlog->OS = $request->os ? $request->os : "windows";
                            $userlog->table_name = 'seller_branch_product';
                            $userlog->reference_id = $branchproduct->seller_branch_product_id;
                            $userlog->ip_device_id = $request->getHost();
                            $userlog->user_type_id = 4;
                            $userlog->save();
                        }
                    }
                }

                if($check) {
                    DB::commit();
                   // flash()->success('Product Created Successfully!');
                    Session::flash('message', 'Product Created Successfully!');
                    return redirect()->route('products');
                } else {
                   // flash()->error('Please Try Again!');
                    Session::flash('alert-class', 'Please Try Again!');
                    return redirect()->route('products');
                }

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


    public function product_edit(Request $request, $product_id)
    {
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [

                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('product_edit', $product_id)
                        ->withErrors($validator)
                        ->withInput();
                }

                DB::beginTransaction();
                $product =  ProductMaster::find($product_id);
                $product->fill($request->input());

                $check = $product->save();

                if($check) {
                    DB::commit();
                    flash()->success('Product Updated Successfully!');
                    return redirect()->route('products', $product_id);
                } else {
                    flash()->error('Please Try Again!');
                    return view('products.product_edit');
                }

            }
            else{
                $data['product'] = ProductMaster::where('product_id', $product_id)->first();
                return view('products.product_edit', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        {
            //dd($e);
            DB::rollback();
            return redirect()->route('category')->with('error', $e->getMessage());
        }

    }
}
