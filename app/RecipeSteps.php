<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RecipeSteps extends Model
{
    use Notifiable;

    protected $table = 'recipe_steps';
    protected $primaryKey = 'recipe_step_id';

    const CREATED_AT = 'created_date_time';
    const UPDATED_AT = 'update_date_time';


    protected $fillable = [
        'recipe_id', 'step_no', 'steps', 't_steps'
    ];

    protected $hidden = [];
}
