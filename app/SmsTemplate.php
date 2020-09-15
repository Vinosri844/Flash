<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SmsTemplate extends Model
{
    use Notifiable;

    protected $table = 'sms_template';
    protected $primaryKey = 'sms_template_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = null;


    protected $fillable = [
        'sms_template_name','sms_template_data',
    ];

    protected $hidden = [];
}
