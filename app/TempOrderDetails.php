<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TempOrderDetails extends Model
{
    use Notifiable;

    protected $table = 'temp_order_details';
    protected $primaryKey = 'temp_order_details_id';

    const CREATED_AT = 'create_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'sub_order_id', 'sub_order_number', 'order_id', 'product_weight_details_id', 'quantity', 'seller_id',
        'shopping_cart_id', 'order_delivery_status_id', 'isdelete', 'isordercancel', 'cancel_by_user_id',
        'cancel_by_user_type_id', 'cancel_date_time', 'cancel_reason', 'return_date_time', 'no_item_return',
        'return_reason', 'return_by_user_id', 'return_by_user_type_id'

    ];

    protected $hidden = [];

    public function store()
    {
        return $this->belongsTo('App\Store', 'seller_id', 'seller_id');
    }

    public function product()
    {
        return $this->belongsTo('App\User', 'foreign_key', 'other_key');
    }
}
