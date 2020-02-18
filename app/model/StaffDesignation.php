<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class StaffDesignation extends Model
{
    protected $guarded =[];
    public function staff(){
        return $this->hasMany(Staff::class, 'designation');
    }
}
