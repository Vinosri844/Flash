<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductMaster extends Model
{
    use Notifiable;

    protected $table = 'product_master';
    protected $primaryKey = 'product_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'product_name', 'isactive','user_id','isdelete',
    ];

    protected $hidden = [];

    public function subcategory() {
        return $this->hasMany('\App\SubCategory', 'subcategory_id', 'subcategory_id');
    }
}
