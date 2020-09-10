<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecipeMaster extends Model
{
    use Notifiable;

    protected $table = 'recipe_master';
    protected $primaryKey = 'recipe_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'recipe_category_id', 'recipe_subcategory_id', 'recipe_name', 'serving_count', 'top_ingredients', 'prepare_time',
        'cooking_time', 'short_description', 'recipe_type'. 'package_price', 'package_include', 't_recipe_name',
        'user_id', 'isactive', 'isdelete'
    ];

    protected $hidden = [];

    public function recipe_image()
    {
        return $this->belongsTo('App\RecipeImages', 'recipe_id', 'recipe_master_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'recipe_category_id', 'category_id');
    }
    public function sub_category()
    {
        return $this->belongsTo('App\SubCategory', 'recipe_subcategory_id', 'subcategory_id');
    }

    
}
