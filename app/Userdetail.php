<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'pancard',
        'uanumber',
        'aadharcard',
        'bknumber',
        'bkname',
        'ifscode',
        'certification',
        'grd_diploma',
        'uni_grd',
        'inst_grd',
        'year_pass_grd',
        'uni_pg',
        'inst_pg',
        'year_pass_pg',
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
