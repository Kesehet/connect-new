<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userassign extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'assign_id'
    ];
}
