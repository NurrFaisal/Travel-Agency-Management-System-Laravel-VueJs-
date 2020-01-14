<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['name', 'company_name', 'email_address', 'phone_number', 'alt_phone_number', 'address', 'website', 'department' ,'status'];

    public function department(){
        return $this->belongsTo(Department::class, 'department');
    }
}

