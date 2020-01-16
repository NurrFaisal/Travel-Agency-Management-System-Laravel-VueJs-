<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $guarded = [];
    public function countryt(){
        return $this->belongsTo(VisaCountry::class, 'country');
    }
}

