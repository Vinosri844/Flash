<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class BulkOrder extends Model
{
  use Notifiable;


  protected $table = 'bulk_order';
  protected $primaryKey = 'id';


  const CREATED_AT = 'created_date_time';
  const UPDATED_AT = 'updated_date_time';

  protected $fillable = [
      'title','subtitle','contact','userid','button_text',
  ];

  protected $hidden = [];
}
