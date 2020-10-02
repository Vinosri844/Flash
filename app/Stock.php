<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Stock extends Model
{
    use Notifiable;

    protected $table = 'stock';
    protected $primaryKey = 'stock_id';

    const CREATED_AT = 'date_time';
    const UPDATED_AT = 'date_time';


    protected $fillable = [
        'product_details_id','weight', 'weight_id','isactive',
    ];

    protected $hidden = [];

    public function productdetails() {
        return $this->hasMany('\App\ProductDetails', 'product_details_id', 'product_details_id');
    }
    public function weight()
    {
        return $this->belongsTo('App\WeightMaster', 'weight_id', 'weight_id');
    }
    public function weightmaster() {
        return $this->hasMany('\App\WeightMaster', 'weight_id', 'weight_id');
    }
}
