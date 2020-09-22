<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RecipeCategory;
use Illuminate\Http\Request;
use Validator;

class RecipeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $recipe_category = RecipeCategory::where('isdelete', 0)->orderBy('recipe_category_id', 'desc')->get();
            return view('recipe_category.recipeCategory')->with('recipe_category', $recipe_category);
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            // dd($request);
            $validator = Validator::make($request->all(), [
            'category_name' => 'required' 
            ]);
            if($validator->fails()){
                flash()->error('Please fill the required fields');
                return redirect()->route('recipe-category.index');
            }
            $active = 0;
            if($request->isactive != null){
                $active = 1;
            }
            $request->merge(['isactive' => $active, 'user_id' => 1]);
            $recipe_category = RecipeCategory::create($request->all());
            if($recipe_category){
                $user = user_logs('Recipe Category', 'Insert', "Insert Recipe Category - ". $request->category_name, 'recipe_category_master', $recipe_category->recipe_category_id);
                if($user){
                    flash()->success('Recipe Category Created Successfully!');
                    return redirect()->route('recipe-category.index');
                }
            }
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecipeCategory  $recipeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RecipeCategory $recipeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecipeCategory  $recipeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RecipeCategory $recipeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecipeCategory  $recipeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecipeCategory $recipeCategory)
    {
        try {
            $validator = Validator::make($request->all(), [
            'category_name' => 'required' 
            ]);
            if($validator->fails()){
                flash()->error('Please fill the required fields');
                return redirect()->route('recipe-category.index');
            }
            $active = 0;
            if($request->isactive != null){
                $active = 1;
            }
            $request->merge(['isactive' => $active, 'user_id' => 1]);
            $recipe_category = RecipeCategory::findOrFail($recipeCategory->recipe_category_id)->update($request->all());
            if($recipe_category){
                $user = user_logs('Recipe Category', 'Update', "Update Recipe Category - ". $request->category_name, 'recipe_category_master', $recipeCategory->recipe_category_id);
                if($user){
                    flash()->success('Recipe Category Updated Successfully!');
                    return redirect()->route('recipe-category.index');
                }
            }
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecipeCategory  $recipeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecipeCategory $recipeCategory)
    {
        try {
            $recipe_category = RecipeCategory::findOrFail($recipeCategory->recipe_category_id);
            $recipe_category->isdelete = 1;
            if($recipe_category->save()){
                $user = user_logs('Recipe Category', 'Trash', "Delete Recipe Category - ". $recipe_category->category_name, 'recipe_category_master', $recipeCategory->recipe_category_id);
                if($user){
                    flash()->info('Recipe Category Deleted Successfully!');
                    return redirect()->route('recipe-category.index');
                }
            }
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        } catch (\Throwable $th) {
            flash()->error('Something went Wrong Please Try Again!');
            return redirect()->route('recipe-category.index');
        }
    }
}
