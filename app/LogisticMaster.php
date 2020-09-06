<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class LogisticMaster extends Model
{
  use Notifiable;

  const CREATED_AT = 'registration_date_time';
  const UPDATED_AT = 'registration_date_time';
  protected $table = 'logistics_master';
  protected $primaryKey = 'logistics_id';

  protected $fillable = [
      'logistics_name','logistics_driving_licence_number','isactive','user_id','isdelete',
  ];

  protected $hidden = [];

}
