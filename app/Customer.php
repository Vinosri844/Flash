<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;

    protected $table = 'customer_master';
    protected $primaryKey = 'customer_id';

    const CREATED_AT = 'create_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'user_id', 'customer_name', 'prefix', 'customer_lastname', 'customer_logintype', 'customer_logintype',
        'customer_loginid', 'customer_contact_no', 'customer_password', 'customer_emailid', 'customer_gender',
        'customer_image', 'customer_birthdate', 'customer_profession', 'customer_marital_status', 'customer_anniversary_date',
        'referal_code', 'customer_device_os', 'customer_device_id', 'customer_device_token', 'issms', 'isnotification',
        'isoffers', 'last_login_date_time', 'isactive', 'isdelete', 'isverified'
    ];

    protected $hidden = [];

    public function customer_address()
    {
        return $this->hasMany('App\CustomerAddress', 'customer_id', 'customer_id');
    }

}
