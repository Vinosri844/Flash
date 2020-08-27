<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CommonHelper, Image, File, Validator;
use DB, Auth, Session;
use App\Category;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function layout()
    { 
        return view('layouts');
    }

    public function login()
    { 
        return view('login');
    }

<<<<<<< HEAD
    public function category()
    { 
        return view('category.category');
=======
    public function category(Request $request)
    {  
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    return redirect()->route('category')
                                ->withErrors($validator)
                                ->withInput();
                } 

                    DB::beginTransaction();
                    $account = new \App\Category;
                    $account->fill($request->input()); 

                    $check = $account->save(); 

                    if($check) { 
                        DB::commit(); 
                        return redirect()->route('category')->with('success', 'Category created successfully');;
                    } else {
                        throw new \Exception(trans('page_title.accounts').' '.trans('common.flash.insert_fail'));
                    }

            }
            else{

                $data['category'] = Category::orderBy('category_id', 'desc')->get();
                return view('category.category', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        { dd($e);
            DB::rollback();
            return redirect()->route('category')->with('error', $e->getMessage());
        }
      
    }

    public function category_edit(Request $request, $category_id)
    {  
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    return redirect()->route('category_edit', $category_id)
                                ->withErrors($validator)
                                ->withInput();
                } 

                    DB::beginTransaction();
                    $account =  Category::find($category_id);
                    $account->fill($request->input()); 

                    $check = $account->save(); 

                    if($check) { 
                        DB::commit(); 
                        return redirect()->route('category_edit', $category_id)->with('success', 'Category Updated successfully');
                    } else {
                        throw new \Exception(trans('page_title.accounts').' '.trans('common.flash.insert_fail'));
                    }

            }
            else{

                $data['category'] = Category::where('category_id', $category_id)->first();
                return view('category.category_edit', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        { dd($e);
            DB::rollback();
            return redirect()->route('category')->with('error', $e->getMessage());
        }
      
    }

    public function category_destroy($id)
    {
        //Retrieve the employee
        $data = Category::find($id);
        //delete
        $data->delete();
        return redirect()->route('category');
    }

    public function ca_changeStatus(Request $request, User $user)
    {
        DB::beginTransaction();
        $user = Category::find($request->category_id);
        $user->isactive = $request->isactive; 
        $user->save();
  
        DB::commit(); 
        return response()->json(['success'=>"Status changed successfully."]);
>>>>>>> 3504569212137e9394caf99b06b42453d1c62e97
    }

    public function subcategory()
    { 
        return view('category.subcategory');
    }

    public function product_price()
    { 
        return view('reports.product_price');
    }

    public function seller_product()
    { 
        return view('reports.seller_product');
    }

    public function seller_selling()
    { 
        return view('reports.seller_selling');
    }

    public function selling_invoice()
    { 
        return view('reports.selling_invoice');
    }

    public function shopping_cart()
    { 
        return view('reports.shopping_cart');
    }

    public function wishlist()
    { 
        return view('reports.wishlist');
    }

    

}
