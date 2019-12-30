<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfEmployee extends Model
{
    protected $guarded = [];

    public function employeeBases()
    {
        return $this->hasMany(EmployeeBase::class);
    }
    
    public function position() 
    {
        return $this->hasMany(Position::class);
    }

    public function moreEmployeeDetails() 
    {
        return $this->hasMany(MoreEmployeeDetail::class);
    }

}
