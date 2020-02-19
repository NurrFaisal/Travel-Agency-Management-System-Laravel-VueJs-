<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $guarded = [];

    public function suplier(){
        return $this->belongsTo(Agency::class, 'suplier');
    }
}
