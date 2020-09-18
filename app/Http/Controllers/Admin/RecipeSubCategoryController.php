<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RecipeSubCategory;
use App\Category;
use Illuminate\Http\Request;
use Validator;

class RecipeSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipe_subcategory = RecipeSubCategory::where('isdelete', 0)->orderBy('recipe_subcategory_id', 'desc')->get();
        return view('recipe_subcategory.recipeSubCategory')->with('recipe_subcategory', $recipe_subcategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::where('isdelete', 0)->get();
            return view('recipe_subcategory.recipeSubCategoryCreate')->with('categories', $categories);
        } catch (\Throwable $th) {
            //throw $th;
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-sub-category.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
            'recipe_category_id' => 'required',
            'subcategory_name' => 'required',
            'subcategory_image' => 'required|mimes:jpeg,jpg|max:2000'
            ]);
            if($validator->fails()){
                flash()->error('Please fill the required fields');
                return redirect()->route('recipe-subcategory.create');
            }

            $product_original_path = "imge/rs_745/m37593449/OriginalImage/"; 
            $recipe_name = $request->subcategory_name;
            $file_name = str_replace(" ", "_", strtolower($recipe_name));
            $file_path = null;
            if($request->hasFile('subcategory_image'))
            {
                if($request->file('subcategory_image')->isValid())
                {
                    $extension = $request->subcategory_image->extension();
                    $saved_name = $file_name.time()."." .$extension;
                    $request->subcategory_image->move(public_path($product_original_path), $saved_name);
                    $file_path = $saved_name;
                }
            }
            $active = 0;
            if($request->isactive != null){
                $active = 1;
            }
            $request->merge(['isactive' => $active, 'user_id' => 1, 'subcategory_image' => $file_path]);
            $recipe_subcategory = RecipeSubCategory::create($request->input());
            if($recipe_subcategory){
                user_logs('Recipe Sub-Category', 'Create', "Create Recipe Sub-Category - ". $request->subcategory_name, 'recipe_subcategory_master', $recipe_subcategory->recipe_subcategory_id);
            }
            flash()->success('Recipe Sub-Category Created Successfully!');
            return redirect()->route('recipe-sub-category.index');
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-sub-category.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecipeSubCategory  $recipeSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RecipeSubCategory $recipeSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecipeSubCategory  $recipeSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RecipeSubCategory $recipeSubCategory)
    {
        try {
           
            $recipe_subcategory = RecipeSubCategory::findOrFail($recipeSubCategory->recipe_subcategory_id);
            $categories = Category::where('isdelete', 0)->get();
            return view('recipe_subcategory.recipeSubCategoryEdit')->with(['categories' => $categories, 'recipe_subcategory' => $recipe_subcategory]);
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-sub-category.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecipeSubCategory  $recipeSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipeSubCategory $recipeSubCategory)
    {
        try {
            $validator = Validator::make($request->all(), [
            'recipe_category_id' => 'required',
            'subcategory_name' => 'required',
            'subcategory_image' => 'mimes:jpeg,jpg|max:2000'
            ]);
            if($validator->fails()){
                flash()->error('Please fill the required fields');
                return redirect()->route('recipe-subcategory.create');
            }

            $product_original_path = "imge/rs_745/m37593449/OriginalImage/"; 
            $recipe_name = $request->subcategory_name;
            $file_name = str_replace(" ", "_", strtolower($recipe_name));
            $file_path = null;
            if($request->hasFile('subcategory_image'))
            {
                if($request->file('subcategory_image')->isValid())
                {
                    $extension = $request->subcategory_image->extension();
                    $saved_name = $file_name.time()."." .$extension;
                    $request->subcategory_image->move(public_path($product_original_path), $saved_name);
                    $file_path = $saved_name;
                }
            }
            $active = 0;
            if($request->isactive != null){
                $active = 1;
            }
            if($file_path != null){
                $request->merge(['subcategory_image' => $file_path]);
            }
            $request->merge(['isactive' => $active]);
            $recipe_subcategory = RecipeSubCategory::findOrFail($recipeSubCategory->recipe_subcategory_id)->update($request->input());
            if($recipe_subcategory){
                user_logs('Recipe Sub-Category', 'Update', "Update Recipe Sub-Category - ". $request->subcategory_name, 'recipe_subcategory_master', $recipeSubCategory->recipe_subcategory_id);
            }
            flash()->success('Recipe Sub-Category Updated Successfully!');
            return redirect()->route('recipe-sub-category.index');
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-sub-category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecipeSubCategory  $recipeSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipeSubCategory $recipeSubCategory)
    {
        try {
            $recipe_category = RecipeSubCategory::findOrFail($recipeSubCategory->recipe_subcategory_id)->update(['isdelete' => 1]);
            flash()->info('Recipe Sub-Category Deleted Successfully!');
            return redirect()->route('recipe-sub-category.index');
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-sub-category.index');
        }
    }
}
