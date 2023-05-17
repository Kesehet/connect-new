<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'goal_id',
        'user_comment',
        'manager_comment',
        'fy',
        'rating'
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /*public function scopeApproved($query)
    {
        return $query->where('is_approved',true);
    }*/
}
