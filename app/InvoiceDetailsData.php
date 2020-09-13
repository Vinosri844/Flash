<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InvoiceDetailsData extends Model
{
    use Notifiable;

    protected $table = 'invoice_details_data';
    protected $primaryKey = 'invoice_details_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'updated_date_time';


    protected $fillable = [
        'order_details_id', 'invoice_master_id', 'order_id', 'sub_order_number', 'product_qty', 'product_name',
        'product_weight', 'product_weight_display', 'seller_name', 'product_price', 'before_discount_price',
        'discount', 'm_discount_per', 'm_discount_value', 'm_price', 'val_1', 'product_weight_details_id',
        'val_2', 'order_delivery_status_id', 'order_delivery_status_name'
        
    ];

    protected $hidden = [];
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'order_id');
    }
}
