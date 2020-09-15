<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Slider extends Model
{
    use Notifiable;

    protected $table = 'slider';
    protected $primaryKey = 'slider_id';

    const CREATED_AT = null;
      const UPDATED_AT = null ;


    protected $fillable = [
        'slider_image','OS','web_home_slider_position','slider_position','isactive','seller_id','subcategory_id',
    ];

    protected $hidden = [];

    public function category() {
        return $this->hasMany('\App\Category', 'category_id', 'category_id');
    }
    public function subcategory() {
        return $this->hasMany('\App\SubCategory', 'subcategory_id', 'subcategory_id');
    }
}
