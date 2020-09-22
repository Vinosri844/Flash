<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'manager';
    protected $primaryKey = 'manager_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'updared_date_time';

    protected $fillable = [
        'manager_name','manager_emailid','isactive','user_id','isdelete',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   
}
