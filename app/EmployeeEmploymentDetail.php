<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeEmploymentDetail extends Model
{
    protected $guarded = [];

    public function employeePersonalDetail()
    {
        return $this->belongsTo(EmployeePersonalDetail::class);
    }

    public function employmentStatus() 
    {
        return $this->belongsTo(EmploymentStatus::class);
    }
}
