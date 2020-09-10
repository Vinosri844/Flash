<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecipeIngredients extends Model
{
    use Notifiable;

    protected $table = 'recipe_ingredients';
    protected $primaryKey = 'recipe_ingredients_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'product_id', 'recipe_id', 'product_name', 'description', 't_product_name',
        't_description'
    ];

    protected $hidden = [];
}
