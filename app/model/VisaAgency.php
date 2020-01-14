<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class VisaAgency extends Model
{
    protected $fillable = ['name', 'company_name', 'email_address', 'phone_number', 'address', 'alt_phone_number', 'website'];
}
