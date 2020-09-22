<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LogisticsOrderManagement extends Model
{
    use Notifiable;

    const CREATED_AT = 'create_date_time';
    const UPDATED_AT = null;
    protected $table = 'logistics_order_management';
    protected $primaryKey = 'logistics_order_management_id';

    protected $fillable = [
        'order_id','assign_by_user_id','assign_to_user_id','status','isdelete','isactive',
    ];

    protected $hidden = [];
}
