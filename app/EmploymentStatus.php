<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentStatus extends Model
{
    protected $guarded = [];    

    public function employeeEmploymentDetails()
    {   
        return $this->hasMany(EmployeeEmploymentDetail::class);
    }

    public function employeePersonalDetails()
    {   
        return $this->hasMany(EmployeePersonalDetail::class);
    }

}
