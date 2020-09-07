<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BulkOrderUser extends Model
{
  use Notifiable;


  protected $table = 'bulk_order_user';
  protected $primaryKey = 'id';


  const CREATED_AT = 'created_date_time';
  const UPDATED_AT = 'updated_date_time';

  protected $fillable = [
      'name','email','mobile_no','event_id','no_of_people',
  ];

  protected $hidden = [];

  public function event() {
      return $this->hasMany('\App\EventMaster', 'event_id', 'event_id');
  }
}
