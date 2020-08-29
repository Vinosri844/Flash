<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Userlogs extends Model
{
    use Notifiable;

    protected $table = 'user_logs';
    protected $primaryKey = 'user_logs_id ';

    const CREATED_AT = 'log_date_time';
    const UPDATED_AT = 'device_log_date_time';


    protected $fillable = [
        'form_name', 'operation_type', 'user_id', 'description', 'OS', 'table_name', 'reference_id', 'ip_device_id', 'device_id',
        'user_type_id', 'authcode', 'analysis_type', 'analysis_id'
    ];

    protected $hidden = [];

}
