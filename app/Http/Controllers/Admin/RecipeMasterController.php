<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RecipeMaster;
use App\RecipeImages;
use App\RecipeSteps;
use App\RecipeIngredients;
use App\Userlogs;
use App\Category;
use App\SubCategory;
use App\ProductMaster;
use Illuminate\Http\Request;
use Validator;

class RecipeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $recipes = RecipeMaster::where('isdelete', 0)->orderBy('created_date_time', 'desc')->get();
            return view('recipe_master.recipeMaster')->with('recipes', $recipes);
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-master.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $categories = Category::where('isdelete', 0)->orderBy('category_id', 'desc')->get();
            $products = ProductMaster::where('isdelete', 0)->orderBy('product_id', 'desc')->get();
            return view('recipe_master.recipeMasterCreate')->with(['categories' => $categories, 'products' => $products]);
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-master.create');
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
            'recipe_name' => 'required',
            'product_id' => 'required',
            'recipe_category_id' => 'required',
            'recipe_subcategory_id' => 'required',
            'recipe_type' => 'required',
            'serving_count' => 'required',
            'tot_ingredients' => 'required',
            'prepare_time' => 'required',
            'cooking_time' => 'required',
            'recipe_original_image_name' => 'required|mimes:jpeg,jpg|max:2000'
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
            return redirect()->route('recipe-master.create');
        }
        $product_original_path = "imge/p_756/r_896527/OriginalImage/"; 
        $recipe_name = $request->recipe_name;
        $file_name = preg_replace('/[^a-zA-Z0-9]/', "_", strtolower($recipe_name));
        $file_path = null;
        if($request->hasFile('recipe_original_image_name'))
        {
            if($request->file('recipe_original_image_name')->isValid())
            {
                
                $extension = $request->recipe_original_image_name->extension();
                $saved_name = $file_name.time()."." .$extension;
                $request->recipe_original_image_name->move(public_path($product_original_path), $saved_name);
                $file_path = $saved_name;
            }
        }
        $active = 0;
        if($request->isactive != null){
            $active = 1;
        }
        $product_name = ProductMaster::where('product_id', $request->product_id)->value('product_name');
        $recipe = new RecipeMaster;
        $recipe->user_id = 1;
        $recipe->isactive = $active;
        $recipe->recipe_name = $request->recipe_name;
        $recipe->serving_count = $request->serving_count;
        $recipe->tot_ingredients = $request->tot_ingredients;
        $recipe->prepare_time = $request->prepare_time;
        $recipe->cooking_time = $request->cooking_time;
        $recipe->short_description = $request->short_description;
        $recipe->user_id = 1;
        $recipe->recipe_category_id = $request->recipe_category_id;
        $recipe->recipe_subcategory_id = $request->recipe_subcategory_id;
        $recipe->recipe_type = $request->recipe_type;
        $recipe->save();
        $request->merge(['recipe_master_id' => $recipe->recipe_id, 'recipe_original_image_name' => $file_path]);
        if($recipe){
            $recipe_image = new RecipeImages;
            $recipe_image->recipe_original_image_name = $file_path;
            $recipe_image->recipe_master_id = $recipe->recipe_id;
            $recipe_image->user_id = 1;
            $recipe_image->isactive = $active;
            $recipe_image->save();
            $product = new RecipeIngredients;
            $product->recipe_id = $recipe->recipe_id;
            $product->description = $request->description;
            $product->product_id = $request->product_id;
            $product->product_name = $product_name;
            $product->save();
            if($request->contact != null){
                foreach ($request->contact as $key => $value) {
                $steps = new RecipeSteps;
                $steps->recipe_id = $recipe->recipe_id;
                $steps->step_no = $key + 1;
                $steps->steps = $value["steps"];
                $steps->save();
                }
            }
       

            flash()->success('Recipe Created Successfully!');
            return redirect()->route('recipe-master.index');
        }
        
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-master.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecipeMaster  $recipeMaster
     * @return \Illuminate\Http\Response
     */
    public function show(RecipeMaster $recipeMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecipeMaster  $recipeMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(RecipeMaster $recipeMaster)
    {
        
        try {
            $data["recipe_master"] = RecipeMaster::findOrFail($recipeMaster->recipe_id);
            $data["categories"] = Category::where('isdelete', 0)->orderBy('category_id', 'desc')->get();
            $data["sub_categories"] = SubCategory::where('isdelete', 0)->where('category_id', $recipeMaster->recipe_category_id)->get();
            $data["products"] = ProductMaster::where('isdelete', 0)->orderBy('product_id', 'desc')->get();
            $data["recipe_ingredient"] = RecipeIngredients::where('recipe_id', $recipeMaster->recipe_id)->first();
            $data["recipe_image"] = RecipeImages::where('recipe_master_id', $recipeMaster->recipe_id)->first();
            $data["recipe_steps"] = RecipeSteps::where('recipe_id', $recipeMaster->recipe_id)->get();
            return view('recipe_master.recipeMasterEdit', $data ?? NULL);
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-master.create');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecipeMaster  $recipeMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipeMaster $recipeMaster)
    {
        try {
            $validator = Validator::make($request->all(), [
            'recipe_name' => 'required',
            'product_id' => 'required',
            'recipe_category_id' => 'required',
            'recipe_subcategory_id' => 'required',
            'recipe_type' => 'required',
            'serving_count' => 'required',
            'tot_ingredients' => 'required',
            'prepare_time' => 'required',
            'cooking_time' => 'required',
            'recipe_original_image_name' => 'mimes:jpeg,jpg|max:2000'
        ]);
        if($validator->fails()){
            flash()->error('Please fill the required Fields! and Image should be Jpeg or Jpg (Max-Size: 2.5MB)');
            return redirect()->route('recipe-master.edit', $recipeMaster->recipe_id);
        }
        $product_original_path = "imge/p_756/r_896527/OriginalImage/"; 
        $recipe_name = $request->recipe_name;
        $file_name = preg_replace('/[^a-zA-Z0-9]/', "_", strtolower($recipe_name));
        $file_path = null;
        if($request->hasFile('recipe_original_image_name'))
        {
            if($request->file('recipe_original_image_name')->isValid())
            {
                
                $extension = $request->recipe_original_image_name->extension();
                $saved_name = $file_name.time()."." .$extension;
                $request->recipe_original_image_name->move(public_path($product_original_path), $saved_name);
                $file_path = $saved_name;
            }
        }
        // dd($file_path);
        $active = 0;
        if($request->isactive != null){
            $active = 1;
        }
        
        $product_name = ProductMaster::where('product_id', $request->product_id)->value('product_name');
        
        $request->merge([
            'isactive' => $active,
            'user_id' => 1,
            ]);
            $recipe = RecipeMaster::findOrFail($recipeMaster->recipe_id);
            $recipe->user_id = 1;
            $recipe->isactive = $active;
            $recipe->recipe_name = $request->recipe_name;
            $recipe->serving_count = $request->serving_count;
            $recipe->tot_ingredients = $request->tot_ingredients;
            $recipe->prepare_time = $request->prepare_time;
            $recipe->cooking_time = $request->cooking_time;
            $recipe->short_description = $request->short_description;
            $recipe->user_id = 1;
            $recipe->recipe_category_id = $request->recipe_category_id;
            $recipe->recipe_subcategory_id = $request->recipe_subcategory_id;
            $recipe->recipe_type = $request->recipe_type;
            
        // $recipe = RecipeMaster::FindorFail($recipeMaster->recipe_id)->update($request->all());
        // $request->merge(['recipe_master_id' => $recipe->recipe_id, 'recipe_original_image_name' => $file_path]);
        if($recipe->save()){
            $recipe_image = RecipeImages::where('recipe_master_id', $recipeMaster->recipe_id)->first();
            if($file_path != null){
            $recipe_image->recipe_original_image_name = $file_path;
            }
            $recipe_image->user_id = 1;
            $recipe_image->isactive = $active;
            $recipe_image->save();
            $product = RecipeIngredients::where('recipe_id', $recipeMaster->recipe_id)->first();
            // dd($product);
            $product->description = $request->description;
            $product->product_id = $request->product_id;
            $product->product_name = $product_name;
            $product->save();
            RecipeSteps::where('recipe_id', $recipeMaster->recipe_id)->delete();
            if($request->contact != null){
                foreach ($request->contact as $key => $value) {
                        $steps = new RecipeSteps;
                        $steps->recipe_id = $recipe->recipe_id;
                        $steps->step_no = $key + 1;
                        $steps->steps = $value["steps"];
                        $steps->save();
                }
            }
       

            flash()->success('Recipe Updated Successfully!');
            return redirect()->route('recipe-master.index');
        }
        
        } catch (\Throwable $th) {
            // dd($th);
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-master.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecipeMaster  $recipeMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipeMaster $recipeMaster)
    {
        try {
            $recipe = RecipeMaster::findOrFail($recipeMaster->recipe_id);
            $recipe->isdelete = 1;
            $recipe->save();
            flash()->info('Recipe Deleted Successfully!');
            return redirect()->route('recipe-master.index');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-master.index');
        }
    }
}
