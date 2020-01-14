<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email_address', 'date_of_birth', 'phone_number',  'alt_phone_number', 'address', 'nid', 'passport', 'blood_group', 'image', 'designation', 'staff_id', 'department', 'location', 'start_date', 'salary', 'first_person_name', 'first_person_phone_number', 'first_person_reletionship','second_person_name', 'second_person_phone_number', 'second_person_reletionship', 'user_type', 'password', 'status'];

    public function designationt(){
        return $this->belongsTo(StaffDesignation::class, 'designation', 'id');
    }
    public function departmentt(){
        return $this->belongsTo(Department::class, 'department');
    }
}
