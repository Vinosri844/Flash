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

    

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'category_name' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('category.index');
        }
        $active = 0;
        // dd($request->event_status);
        if($request->event_status != null){
            $active = 1;
        } 
        $event = new Category;
        $event->isactive = $active;
        $event->category_name = $request->category_name;
        if($event->save()){
            flash()->success('Category Created Successfully!');
            return redirect()->route('category.index');
        }
        flash()->error('Please Try Again!');
        return redirect()->route('category.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('category.index');
        }
        
    }

    public function update(Request $request, $id)
    { 
        try { //dd($request->all());
            $validator = Validator::make($request->all(), [
            'category_name' => 'required' 
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required fields');
            return redirect()->route('category');
        } 
        $active = 0;
        // dd($request->event_status);
        if($request->event_status != null){
            $active = 1;
        } 
        $event = Category::findOrFail($id); 
        $event->category_name = $request->category_name;
        $event->isactive = $active;
        if($event->save()){
            flash()->success('Category Updated Successfully!');
            return redirect()->route('category');
            
        }
            flash()->error('Please Try Again!');
           
            return view('category.category_edit');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('category');
        }
    }

    public function destroy($id)
    {
        try {
            $event = Category::findOrFail($id);
            $event->isdelete = 1;
            if($event->save()){
                flash('Category Deleted Successfully!');
                return redirect()->route('category.index');
            }
            flash()->error('Please Try Again!');
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            flash()->error('Something Went wrong Please try Again!');
            return redirect()->route('category.index');
        }
    }

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

                    DB::beginTransaction();
                    $account = new \App\Category;
                    $account->fill($request->input()); 

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

                    DB::beginTransaction();
                    $account =  Category::find($category_id);
                    $account->fill($request->input()); 

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

    
}
