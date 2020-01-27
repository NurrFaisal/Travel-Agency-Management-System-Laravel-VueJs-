<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['debit_voucher_date', 'suplier', 'cash', 'cheque', 'total_payment_amount', 'narration', 'received_by', 'paid_by', 'approved_by'];

    public function supliert(){
        return $this->belongsTo(Agency::class, 'suplier');
    }

    public function cashs(){
        return $this->hasMany(CashBook::class, 'payment_id', 'id');
    }

    public function cheques(){
        return $this->hasMany(BankBook::class, 'payment_id', 'id');
    }
}
