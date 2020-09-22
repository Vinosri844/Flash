<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderDeliveryStatus extends Model
{
    use Notifiable;

    protected $table = 'order_delivery_status';
    protected $primaryKey = 'order_delivery_status_id';

    const CREATED_AT = null;
    const UPDATED_AT = null;


    protected $fillable = [
        'sub_order_id','order_delivery_status_name',
    ];

    protected $hidden = [];
}
