<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'timesheet_date',
        'working_mintus',
        'fy',
        'comments',
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    
}
