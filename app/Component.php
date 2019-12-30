<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function moreEmployeeDetails() 
    {
        return $this->hasMany(MoreEmployeeDetail::class);
    }
}
