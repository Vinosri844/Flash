<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SellerBranch extends Model
{
    use Notifiable;

    protected $table = 'seller_branch';
    protected $primaryKey = 'seller_branch_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'seller_branch_name','seller_branch_address', 'seller_branch_pincode','	seller_id','isdelete',
    ];

    protected $hidden = [];

    public function seller() {
        return $this->hasMany('\App\SellerMaster', 'seller_id', 'seller_id');
    }
}
