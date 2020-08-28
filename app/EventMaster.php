<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EventMaster extends Model
{
    use Notifiable;

    protected $table = 'event_master';
    protected $primaryKey = 'event_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'event_name', 'is_Active','user_id','isdelete',
    ];

    protected $hidden = [];
}
