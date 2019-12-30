<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeBase extends Model
{
    protected $guarded = [];

    public function typeOfEmployee()
    {
        return $this->belongsTo(typeOfEmployee::class);
    }

    public function moreEmployeeDetails() 
    {
        return $this->hasMany(MoreEmployeeDetail::class);
    }
}
