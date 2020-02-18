<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['branch', 'name', 'guest_type', 'designation', 'rf_staff', 'rf_guest', 'email_address', 'alt_email_address', 'phone_number', 'alt_phone_number', 'address', 'status'];

    public function GuestQueries(){
        return $this->hasMany(GuestQuery::class, '', 'guest_id');
    }
    public function Staff(){
        return $this->belongsTo(Staff::class, 'rf_staff');
    }
    public function transjactions(){
        return $this->hasOne(Transjaction::class, 'guest_id');
    }
}
