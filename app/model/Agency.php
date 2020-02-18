<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $guarded = [];
    public function countryt(){
        return $this->belongsTo(VisaCountry::class, 'country');
    }
    public function transactions(){
        return $this->hasOne(SuplierTransaction::class, 'suplier_id');
    }
}

