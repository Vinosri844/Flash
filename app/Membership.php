<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Membership extends Model
{
    use Notifiable;

    protected $table = 'membership';
    protected $primaryKey = 'membership_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'initial_amount', 'current_amount', 'validity', 'order_amount', 'cashback_amount', 'isActive', 'isdelete', 'user_id'
    ];

    protected $hidden = [];
}
