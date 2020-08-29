<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SellerBranchProduct extends Model
{
    use Notifiable;

    protected $table = 'seller_branch_product';
    protected $primaryKey = 'seller_branch_product_id';

    const CREATED_AT = 'create_date_time';
    const UPDATED_AT = 'create_date_time';


    protected $fillable = [
        'product_details_id','seller_branch_id','seller_id','isdelete','isactive',
    ];

    protected $hidden = [];

    public function product_details() {
        return $this->hasMany('\App\ProductDetails', 'product_details_id', '	product_details_id');
    }

    public function seller() {
        return $this->hasMany('\App\SellerMaster', 'seller_id', 'seller_id');
    }

    public function seller_branch() {
        return $this->hasMany('\App\SellerBranch', 'seller_branch_id', 'seller_branch_id');
    }
}
