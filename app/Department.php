<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['id', 'created_at', 'updated_at', 'department_name'];
    protected $primaryKey = 'id';
}
