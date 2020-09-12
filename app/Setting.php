<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Setting extends Model
{
    use Notifiable;

    protected $table = 'contact_us';
    protected $primaryKey = 'contact_us_id';

   const CREATED_AT = 'created_date_time';
   const UPDATED_AT = 'updated_date_time';


    protected $fillable = [
        'contact_name','contact_number', 'sms_contact_number','email','mintime', 'maxtime', 'delivery_charge'
    ];

    protected $hidden = [];
}
