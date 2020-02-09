<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PaymentLoan extends Model
{
    protected $guarded = [];
    public function cashs(){
        return $this->hasMany(CashBook::class, 'payment_loan_id', 'id');
    }
    public function cheques(){
        return $this->hasMany(BankBook::class, 'payment_loan_id', 'id');
    }
}
