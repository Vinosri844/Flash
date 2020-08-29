<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use Notifiable;

    protected $table = 'seller_master';
    protected $primaryKey = 'seller_id';

    const CREATED_AT = 'registration_date_time';
    const UPDATED_AT = 'approve_date_time';


    protected $fillable = [
        'seller_name', 'seller_description', 'seller_pan_number', 'seller_pan_number_image', 'seller_cst_tin_number', 
        'seller_gst_tin_number', 'seller_food_licence_number', 'seller_fssai_number', 'seller_service_tax_number', 
        'seller_company_image', 'seller_user_name', 'seller_password', 'val_1', 'val_2', 'isactive', 'isdelete',
         'isapprove', 'approve_by', 'leaving_date_time', 'disapprove_date_time',
        'disapprove_by', 'category_id', 'user_id', 'gcmapns_id', 'seller_errand', 'seller_emailid', 't_seller_name',
        'seller_cart_value', 'is_Active','user_id','isdelete',
    ];

    protected $hidden = [];
}
