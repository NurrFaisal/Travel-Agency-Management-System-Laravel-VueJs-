<?php

namespace App\model;

use App\ReceivedLoanHead;
use Illuminate\Database\Eloquent\Model;

class ReceivedLoan extends Model
{
    protected $guarded = [];

    public function cashs(){
        return $this->hasMany(CashBook::class, 'received_loan_id', 'id');
    }
    public function banks(){
        return $this->hasMany(BankBook::class, 'received_loan_id', 'id');
    }
    public function cheques(){
        return $this->hasMany(ChequeBook::class, 'received_loan_id', 'id');
    }
}
