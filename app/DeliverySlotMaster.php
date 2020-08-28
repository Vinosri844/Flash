<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DeliverySlotMaster extends Model
{
    use Notifiable;

    protected $table = 'delivery_slot_master';
    protected $primaryKey = 'delivery_slot_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'from_time', 'to_time', 'is_Active','user_id','isdelete',
    ];

    protected $hidden = [];
}
