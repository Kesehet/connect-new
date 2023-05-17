<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'goal_type',
        'title',
        'description',
        'feature_points',
        'order_no',
        'fy',
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    
}
