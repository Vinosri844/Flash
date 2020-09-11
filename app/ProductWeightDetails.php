<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductWeightDetails extends Model
{
    use Notifiable;

    protected $table = 'product_weight_details';
    protected $primaryKey = 'product_weight_details_id';

    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'before_discount_price','price', 'weight_id','isactive','product_weight_code',
    ];

    protected $hidden = [];

    public function productdetails() {
        return $this->hasMany('\App\ProductDetails', 'product_details_id', 'product_details_id');
    }

    public function weightmaster() {
        return $this->hasMany('\App\WeightMaster', 'weight_id', 'weight_id');
    }
}
