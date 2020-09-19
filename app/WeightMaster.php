<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WeightMaster extends Model
{
    use Notifiable;

    protected $table = 'weight_master';
    protected $primaryKey = 'weight_id';

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'weight_display','actual_weight', 'unit','isactive','isdelete',
    ];

    protected $hidden = [];

    public function productdetails() {
        return $this->hasMany('\App\ProductDetails', 'product_details_id', 'product_details_id');
    }

}
