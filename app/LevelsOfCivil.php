<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelsOfCivil extends Model
{
    protected $guarded = [];

    public function moreEmployeeDetails() 
    {
        return $this->hasMany(MoreEmployeeDetail::class);
    }
}
