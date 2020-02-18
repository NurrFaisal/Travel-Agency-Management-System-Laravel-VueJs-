<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Transjaction extends Model
{
    protected $guarded = [];

    public function guest(){
        return $this->belongsTo(Guest::class, 'guest_id');
    }
    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
