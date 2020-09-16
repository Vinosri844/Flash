<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotificationUsers extends Model
{
    use Notifiable;

    protected $table = 'notification_users';
    protected $primaryKey = 'notification_user_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = null ;


    protected $fillable = [
        'customer_device_os','customer_device_id','customer_device_token','customer_id','isactive','user_type_id',
    ];

    protected $hidden = [];

    public function customer() {
        return $this->belongsTo('\App\Customer', 'customer_id', 'customer_id');
    }
}
