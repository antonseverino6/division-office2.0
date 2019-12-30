<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoreEmployeeDetail extends Model
{
    protected $guarded = [];

    public function levelsOfCivil() 
    {
        return $this->belongsTo(LevelsOfCivil::class);
    }

    public function gradeLevel() 
    {
        return $this->belongsTo(GradeLevel::class);
    }

    public function subject() 
    {
        return $this->belongsTo(Subject::class);
    }

    public function area() 
    {
        return $this->belongsTo(Area::class);
    }

    public function component() 
    {
        return $this->belongsTo(Component::class);
    }    

    public function employeeBase() 
    {
        return $this->belongsTo(EmployeeBase::class);
    }

    public function typeOfEmployee() 
    {
        return $this->belongsTo(TypeOfEmployee::class);
    }

    public function position() 
    {
        return $this->belongsTo(Position::class);
    }
}
