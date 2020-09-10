<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecipeImages extends Model
{
    use Notifiable;

    protected $table = 'recipe_images';
    protected $primaryKey = 'recipe_images_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'delete_date_time';


    protected $fillable = [
        'recipe_orginal_image_name', 'recipe_compress_image_name', 'recipe_thumbnail_image_name', 'recipe_master_id',
        'user_id','isactive', 'isdelete',
    ];

    protected $hidden = [];

}
