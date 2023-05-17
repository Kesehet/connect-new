<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','first_name', 'last_name', 'role', 'email',
        'password','phone','address','gender','dob','join_date','job_type','city','salary','age',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
   //For counting the leave
    public function leave()
    {
        return $this->HasMAny('App\Leave','employee_id');
    }
    
    //For counting the leave
    public function timesheet()
    {
        return $this->HasMAny('App\Timesheet','user_id');
    }
    
    //For counting the leave
    public function goal()
    {
        return $this->HasMAny('App\Goal','user_id');
    }
    public function tasks()
    {
        return $this->HasMany(Task::class);
    }
    

    public function get_UserNumber(){

        $this->db->select("count(*) as no");
        $query = $this->db->get("users");
        return $query->result();

    }
}
