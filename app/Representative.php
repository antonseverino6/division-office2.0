<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $guarded = [];
    // protected $fillable = ['name'];

    public function user() 
    {
        return $this->hasMany(User::class);
    }

    public function employeePersonalDetails() 
    {
        return $this->hasMany(EmployeePersonalDetail::class);
    }    

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }
}
