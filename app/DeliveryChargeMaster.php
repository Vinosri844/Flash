<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DeliveryChargeMaster extends Model
{
    use Notifiable;

    protected $table = 'delivery_charge';
    protected $primaryKey = 'delivery_charge_id';

    const CREATED_AT = null;
    const UPDATED_AT = null;


    protected $fillable = [
        'start_amount','end_amount','delivery_charge',
    ];

    protected $hidden = [];
}
