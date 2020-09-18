<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecipeSubCategory extends Model
{
    use Notifiable;

    protected $table = 'recipe_subcategory_master';
    protected $primaryKey = 'recipe_subcategory_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'subcategory_name', 'subcategory_image', 'subcategory_description', 'recipe_category_id',
        'user_id','isactive', 'isdelete',
    ];

    protected $hidden = [];
}
