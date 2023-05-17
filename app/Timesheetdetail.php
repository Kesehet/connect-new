<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheetdetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timesheet_id',
        'working_mintus',
        'comments',
    ];

    
}
