<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubCategory extends Model
{
    use Notifiable;

    protected $table = 'subcategory_master';
    protected $primaryKey = 'subcategory_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'subcategory_name','subcategory_description','subcategory_image','t_subcategory_name','isactive','isdelete','category_id'
    ];

    protected $hidden = [];

    public function category() {
        return $this->belongsTo('\App\Category', 'category_id', 'category_id');
    }
}
