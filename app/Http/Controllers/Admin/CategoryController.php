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
                     // Image Upload
                     if($request->hasFile('category_image')) {
                        $photo = $request->file('category_image');

                        if(isset($photo) && !empty($photo) && $photo->isValid()) {
                            $rules = array('photo' => 'required|mimes:png,jpg,jpeg'); 
                            $validator = Validator::make(array('photo'=> $photo), $rules);
                            if($validator->passes()) {
                                $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('category_name'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                                $file_path = public_path(config('constants.category_img_path').$file_name);
                                $file_path1 = public_path(config('constants.category_img_path1').$file_name);
                                $file_path2 = public_path(config('constants.category_img_path2').$file_name);

                                $save_photo = Image::make($photo->getRealPath())->save($file_path);
                                $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                                // Resize Image
                                $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);
                                
                                $account->category_image = $file_name;
                            }
                        }
                    }
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
        {
            //dd($e);
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
                    // Image Upload
                    if($request->hasFile('category_image')) {
                        $photo = $request->file('category_image');

                        if(isset($photo) && !empty($photo) && $photo->isValid()) {
                            $rules = array('photo' => 'required|mimes:png,jpg,jpeg'); 
                            $validator = Validator::make(array('photo'=> $photo), $rules);
                            if($validator->passes()) {
                                $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('category_name'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                                $file_path = public_path(config('constants.category_img_path').$file_name);
                                $file_path1 = public_path(config('constants.category_img_path1').$file_name);
                                $file_path2 = public_path(config('constants.category_img_path2').$file_name);

                                $save_photo = Image::make($photo->getRealPath())->save($file_path);
                                $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                                // Resize Image
                                $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);
                                
                                $account->category_image = $file_name;
                            }
                        }
                    }
                   
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
        {
            //dd($e);
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
                    // Image Upload
                    if($request->hasFile('subcategory_image')) {
                        $photo = $request->file('subcategory_image');

                        if(isset($photo) && !empty($photo) && $photo->isValid()) {
                            $rules = array('photo' => 'required|mimes:png,jpg,jpeg'); 
                            $validator = Validator::make(array('photo'=> $photo), $rules);
                            if($validator->passes()) {
                                $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('subcategory_name'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                                $file_path = public_path(config('constants.subcategory_img_path').$file_name);
                                $file_path1 = public_path(config('constants.subcategory_img_path1').$file_name);
                                $file_path2 = public_path(config('constants.subcategory_img_path2').$file_name);

                                $save_photo = Image::make($photo->getRealPath())->save($file_path);
                                $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                                // Resize Image
                                $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);
                                
                                $account->subcategory_image = $file_name;
                            }
                        }
                    }
                 
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

    public function catby_subcategory(Request $request){
        $category_id = $request->get('category_id');
        // $categories=DB::select("select * from account where account_role_id = 3 and account_country_id =".$country_id);
        $subcategories = SubCategory::where('category_id','=',$category_id)->where('isactive',1)->get();
       // dump($subcategories);
        // return view('categories_list',$categories);

        $view= view('category/subcategories_list')->with(['sub_cat'=>$subcategories])->render();
        return response()->json(['html'=>$view]);
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
                        // Image Upload
                        if($request->hasFile('subcategory_image')) {
                            $photo = $request->file('subcategory_image');
    
                            if(isset($photo) && !empty($photo) && $photo->isValid()) {
                                $rules = array('photo' => 'required|mimes:png,jpg,jpeg'); 
                                $validator = Validator::make(array('photo'=> $photo), $rules);
                                if($validator->passes()) {
                                    $file_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($request->input('subcategory_name'))).'_'.time().'.'.$photo->getClientOriginalExtension();
                                    $file_path = public_path(config('constants.subcategory_img_path').$file_name);
                                    $file_path1 = public_path(config('constants.subcategory_img_path1').$file_name);
                                    $file_path2 = public_path(config('constants.subcategory_img_path2').$file_name);
    
                                    $save_photo = Image::make($photo->getRealPath())->save($file_path);
                                    $save_photo = Image::make($photo->getRealPath())->save($file_path2);
                                    // Resize Image
                                    $save_photo = Image::make($photo->getRealPath())->resize(config('constants.image_width'), config('constants.image_height'))->save($file_path1);
                                    
                                    $account->subcategory_image = $file_name;
                                }
                            }
                        }
                   
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
        {
            //dd($e);
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
