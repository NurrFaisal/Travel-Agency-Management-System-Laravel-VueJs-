<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class GuestQuery extends Model
{
    protected $fillable = ['guest_id', 'subject', 'staff_id', 'guest_qurey', 'follow_up', 'status'];

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    public function guest(){
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
