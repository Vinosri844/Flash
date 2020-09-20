<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Manager extends Authenticatable
{
  use Notifiable;

  protected $table = 'manager';
  protected $primaryKey = 'manager_id';

  const CREATED_AT = 'created_date_time';
  const UPDATED_AT = 'updared_date_time';

  protected $fillable = [
      'manager_name','manager_emailid','isactive','user_id','isdelete',
  ];

  protected $hidden = [];
}
