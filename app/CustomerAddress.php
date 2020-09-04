<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerAddress extends Model
{
    use Notifiable;

    protected $table = 'customer_address';
    protected $primaryKey = 'customer_address_id';

    const CREATED_AT = 'create_date_time';
    // const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'customer_name', 'prefix', 'address_1', 'address_2', 'mobile', 'city', 'state', 'country', 'pincode', 'type',
        'near_my_landmark', 'customer_id', 'isactive', 'isdelete'
    ];

    protected $hidden = [];
    
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'customer_id');
    }
}
