<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaymentTypeMaster extends Model
{
    use Notifiable;

    protected $table = 'payment_type_master';
    protected $primaryKey = 'payment_type_id';

    const CREATED_AT = 'create_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'payment_name','isactive','isdelete',
    ];

    protected $hidden = [];
}
