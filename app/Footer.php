<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Footer extends Model
{
    use Notifiable;

    protected $table = 'footer_settings';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'updated_date_time';


    protected $fillable = [
        'phone_number','mobile1', 'mobile2','email','website', 'google_play_store', 'app_store', 'facebook', 'twitter', 'instagram'
        ,'whatsapp', 'fb_messenger'. 'google_plus', 'delivery_title', 'basket_title', 'clock_title', 'status'
    ];

    protected $hidden = [];
}
