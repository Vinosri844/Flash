<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CommonHelper, Image, File, Validator;
use DB, Auth, Session;
use App\Category;
use App\SubCategory;

class CategoryController extends Controller
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

    public function index()
    { 
        $masters = Category::where('isdelete', 0)->orderBy('category_id', 'desc')->get();
        
        return view('category.category')->with('masters', $masters);
    }

    public function category_create(Request $request)
    {  
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('category')
                                ->withErrors($validator)
                                ->withInput();
                } 

                $active = 0;
                // dd($request->event_status);
                if($request->cat_status != null){
                    $active = 1;
                } 
                    DB::beginTransaction();
                    $account = new \App\Category;
                    $account->fill($request->input()); 
                    $account->isactive = $active;
                    $check = $account->save(); 

                    if($check) { 
                        DB::commit(); 
                        flash()->success('Category Created Successfully!');
                        return redirect()->route('category');
                    } else {
                        flash()->error('Please Try Again!');
                        return redirect()->route('category');
                    }

            }
            else{

                $data['category'] = Category::orderBy('category_id', 'desc')->get();
                return view('category.category_create', $data ?? NULL);
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
                    flash()->error('Please fill the required fields');
                    return redirect()->route('category_edit', $category_id)
                                ->withErrors($validator)
                                ->withInput();
                } 

                $active = 0;
                // dd($request->event_status);
                if($request->cat_status != null){
                    $active = 1;
                } 
                    DB::beginTransaction();
                    $account =  Category::find($category_id);
                    $account->fill($request->input()); 
                    $account->isactive = $active;
                    $check = $account->save(); 

                    if($check) { 
                        DB::commit(); 
                        flash()->success('Category Updated Successfully!');
                        return redirect()->route('category', $category_id);
                    } else {
                        flash()->error('Please Try Again!');
                        return view('category.category_edit');
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
        $data = Category::findOrFail($id);
        $data->isdelete = 1;
        if($data->save()){
            flash()->success('Category Deleted Successfully!');
            return redirect()->route('category');
        }
        flash()->error('Please Try Again!');
        return redirect()->route('category');
        
    }


    //Subcategory
    public function sc_index()
    { 
        $masters = SubCategory::where('isdelete', 0)->orderBy('subcategory_id', 'desc')->get();
        
        return view('category.subcategory')->with('masters', $masters);
    }

    public function subcategory_create(Request $request)
    {  
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('subcategory')
                                ->withErrors($validator)
                                ->withInput();
                } 

                $active = 0;
                 //dd($request->sc_status);
                if($request->sc_status != null){
                    $active = 1;
                } 
                    DB::beginTransaction();
                    $account = new \App\SubCategory;
                    $account->fill($request->input()); 
                    $account->isactive = $active;

                 
                    $check = $account->save(); 

                    if($check) { 
                        DB::commit(); 
                        flash()->success('Sub category Created Successfully!');
                        return redirect()->route('subcategory');
                    } else {
                        flash()->error('Please Try Again!');
                        return redirect()->route('subcategory');
                    }

            }
            else{

                $data['category'] = SubCategory::orderBy('subcategory_id', 'desc')->get();
                $data['cat'] = Category::orderBy('category_id', 'desc')->get();
                return view('category.subcategory_create', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        { dd($e);
            DB::rollback();
            return redirect()->route('subcategory')->with('error', $e->getMessage());
        }
      
    }

    public function subcategory_edit(Request $request, $subcategory_id)
    {  
        try{
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->input(), [
                    
                ]);

                // if form validation errors
                if ($validator->fails()) {
                    flash()->error('Please fill the required fields');
                    return redirect()->route('subcategory_edit', $subcategory_id)
                                ->withErrors($validator)
                                ->withInput();
                } 

                $active = 0;
                // dd($request->event_status);
                if($request->sc_status != null){
                    $active = 1;
                } 
                    DB::beginTransaction();
                    $account =  SubCategory::find($subcategory_id);
                    $account->fill($request->input()); 
                    $account->isactive = $active;
                    $check = $account->save(); 

                    if($check) { 
                        DB::commit(); 
                        flash()->success('Subcategory Updated Successfully!');
                        return redirect()->route('subcategory', $subcategory_id);
                    } else {
                        flash()->error('Please Try Again!');
                        return view('category.subcategory_edit');
                    }

            }
            else{

                $data['category'] = SubCategory::where('subcategory_id', $subcategory_id)->first();
                $data['cat'] = Category::orderBy('category_id', 'desc')->get();
                return view('category.subcategory_edit', $data ?? NULL);
            }
        }
        Catch(\Exception $e)
        { dd($e);
            DB::rollback();
            return redirect()->route('subcategory')->with('error', $e->getMessage());
        }
      
    }

    public function sc_destroy($id)
    {
        $data = SubCategory::findOrFail($id);
        $data->isdelete = 1;
        if($data->save()){
            flash()->success('Subcategory Deleted Successfully!');
            return redirect()->route('subcategory');
        }
        flash()->error('Please Try Again!');
        return redirect()->route('subcategory');
        
    }

    
}
