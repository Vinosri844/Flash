<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductImages extends Model
{
    use Notifiable;

    protected $table = 'product_images';
    protected $primaryKey = 'product_images_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'created_date_time';


    protected $fillable = [
        'product_original_image_name', 'product_compress_image_name','product_thumbnail_image_name',
    ];

    protected $hidden = [];

    public function product() {
        return $this->hasMany('\App\ProductMaster', 'product_id', 'product_id');
    }
}
