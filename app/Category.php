<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Notifiable;

	protected $table = 'category_master';
    protected $primaryKey = 'category_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';

    protected $fillable = [
        'category_name','category_description','category_image','t_category_name','isactive','isdelete',
    ];

    protected $hidden = [];



}
