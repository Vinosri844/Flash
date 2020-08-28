<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CommonHelper, Image, File, Validator;
use DB, Auth, Session;
use App\Category;
use App\SubCategory;

class SubCategoryController extends Controller
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

    public function index()
    {
        $masters = SubCategory::where('isdelete', 0)->orderBy('subcategory_id', 'desc')->get();
        
        return view('category.Subcategory')->with('masters', $masters);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'subcategory_name' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('sub-category.index');
        }
        $active = 0;
        // dd($request->event_status);
        if($request->event_status != null){
            $active = 1;
        }
        $event = new SubCategory;
        $event->isactive = $active;
        $event->subcategory_name = $request->subcategory_name;
        if($event->save()){
            flash()->success('Subcategory Created Successfully!');
            return redirect()->route('sub-category.index');
        }
        flash()->error('Please Try Again!');
        return redirect()->route('sub-category.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('sub-category.index');
        }
        
    }

    public function update(Request $request, $id)
    {
        try { //dd($request->all());
            $validator = Validator::make($request->all(), [
            'subcategory_name' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('sub-category.index');
        } 
        $active = 0;
        // dd($request->event_status);
        if($request->event_status != null){
            $active = 1;
        } 
        $event = SubCategory::findOrFail($id); 
        $event->subcategory_name = $request->subcategory_name;
        $event->isactive = $active;
        if($event->save()){
            flash()->success('Subcategory Updated Successfully!');
            return redirect()->route('sub-category.index');
            
        }
            flash()->error('Please Try Again!');
            return redirect()->route('sub-category.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('sub-category.index');
        }
    }

    public function destroy($id)
    {
        try {
            $event = SubCategory::findOrFail($id);
            $event->isdelete = 1;
            if($event->save()){
                flash('SubCategory Deleted Successfully!');
                return redirect()->route('sub-category.index');
            }
            flash()->error('Please Try Again!');
            return redirect()->route('sub-category.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('sub-category.index');
        }
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
