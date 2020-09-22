<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InvoiceMasterData extends Model
{
    use Notifiable;

    protected $table = 'invoice_master_data';
    protected $primaryKey = 'invoice_master_id';

    const CREATED_AT = null;
    const UPDATED_AT = null;


    protected $fillable = [
        'customer_id', 'payment_type_method', 'order_id', 'payable_amount', 'wallet_amount', 'final_paid_amount',
        'cancel_amount', 'before_promocode_cancel_amount', 'promocode_amount', 'promocode_type', 'no_of_product',
        'promocode', 'before_promocode_amount', 'after_promocode_amount', 'delivery_charge', 'order_date_time', 'delivery_date_time',
        'delivery_date', 'delivery_time_slot',
        'received_date_time', 'generate_order_id', 'order_number', 'payment_id', 'order_delivery_status_id', 'invoice_file_name', 'customer_name',
        'customer_mobile_no', 'customer_address_1', 'customer_address_2', 'city', 'state', 'country', 'extra_amount', 'ismembership', 'membership_id', 'near_by_landmark', 'type', 'pincode',

    ];

    protected $hidden = [];
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'order_id');
    }
}
