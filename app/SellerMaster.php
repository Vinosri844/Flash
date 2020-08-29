<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SellerMaster extends Model
{
    use Notifiable;

    protected $table = 'seller_master';
    protected $primaryKey = 'seller_id';

 //   const CREATED_AT = 'created_date_time';
  //  const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'seller_name','seller_description', 'isactive','user_id','isdelete',
    ];

    protected $hidden = [];

    public function category() {
        return $this->hasMany('\App\Category', 'category_id', 'category_id');
    }
}
