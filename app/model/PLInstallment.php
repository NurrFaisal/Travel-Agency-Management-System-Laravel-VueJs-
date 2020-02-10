<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PLInstallment extends Model
{
    protected $guarded = [];

    public function cashs(){
        return $this->hasMany(CashBook::class, 'pl_installment_id', 'id');
    }
    public function banks(){
        return $this->hasMany(BankBook::class, 'pl_installment_id', 'id');
    }
    public function cheques(){
        return $this->hasMany(ChequeBook::class, 'pl_installment_id', 'id');
    }
}
