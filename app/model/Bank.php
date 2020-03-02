<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['bank_name'];

    public function bank_bookt(){
        return $this->hasOne(BankBook::class, 'bank_name', 'id');
    }
}
