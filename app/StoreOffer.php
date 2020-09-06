<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StoreOffer extends Model
{
    use Notifiable;

    protected $table = 'store_offers';
    protected $primaryKey = 'store_offer_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'title', 'subtitle', 'min_discount', 'max_discount', 'start_date', 'end_date', 'seller_id', 'offer_image', 'isactive',
        'isdelete', 'user_id'
    ];

    public function store()
    {
        return $this->belongsTo('App\Store', 'seller_id', 'seller_id');
    }

    protected $hidden = [];
}
