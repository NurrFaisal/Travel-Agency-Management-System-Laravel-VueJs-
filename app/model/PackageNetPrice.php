<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PackageNetPrice extends Model
{
    protected $guarded = [];

    public function suplier(){
        return $this->belongsTo(Agency::class, 'suplier');
    }
}
