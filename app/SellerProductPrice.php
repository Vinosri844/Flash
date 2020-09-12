<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerProductPrice extends Model
{
    protected $table = 'seller_product_price';
    protected $primaryKey = 'id';

       const CREATED_AT = 'date_time';
      const UPDATED_AT = 'date_time';


    protected $fillable = [
        'product_weight_details_id','price',
    ];

    protected $hidden = [];

    public function ProductWeight() {
        return $this->hasMany('\App\ProductWeightDetails', 'product_weight_details_id', 'product_weight_details_id');
    }
}
