<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PincodeMaster extends Model
{
    use Notifiable;

    protected $table = 'pincode_master';
    protected $primaryKey = 'pincode_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'updated_date_time';

    protected $fillable = [
        'pincode_type','pincode', 'user_id','delivery_charge','isactive','isdelete',
    ];

    protected $hidden = [];

}
