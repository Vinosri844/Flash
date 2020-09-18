<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecipeCategory extends Model
{
    use Notifiable;

    protected $table = 'recipe_category_master';
    protected $primaryKey = 'recipe_category_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'category_name',
        'user_id','isactive', 'isdelete',
    ];

    protected $hidden = [];
}
