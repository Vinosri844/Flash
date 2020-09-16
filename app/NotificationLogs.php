<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotificationLogs extends Model
{
    use Notifiable;

    protected $table = 'notification_logs';
    protected $primaryKey = 'notification_logs_id';

    const CREATED_AT = 'create_date_time';
    const UPDATED_AT = null ;


    protected $fillable = [
        'notification_user_id','message','title','type','isactive','customer_id','type_id',
    ];

    protected $hidden = [];

    public function notification_user() {
        return $this->belongsTo('\App\NotificatioinUsers', 'notification_user_id', 'notification_user_id');
    }
    public function customer() {
        return $this->belongsTo('\App\Customer', 'customer_id', 'customer_id');
    }
}
