<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePersonalDetail extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function representative() 
    {
        return $this->belongsTo(Representative::class);
    }

    public function employeeEmploymentDetail()
    {
        return $this->hasOne(EmployeeEmploymentDetail::class);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function employmentStatus() 
    {
        return $this->belongsTo(EmploymentStatus::class);
    }    
}
