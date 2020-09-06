<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryOffer extends Model
{
    use Notifiable;

    protected $table = 'category_offers';
    protected $primaryKey = 'category_offer_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'title', 'subtitle', 'min_discount', 'max_discount', 'start_date', 'end_date', 'seller_id', 'offer_image', 'isactive',
        'isdelete', 'user_id', 'category_id'
    ];

    public function store()
    {
        return $this->belongsTo('App\Store', 'seller_id', 'seller_id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }
   

    protected $hidden = [];
}
