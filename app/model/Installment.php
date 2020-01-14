<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = ['loan_id', 'narration', 'total_amount'];

    public function cashs(){
        return $this->hasMany(CashBook::class, 'installment_id', 'id');
    }
    public function cheques(){
        return $this->hasMany(BankBook::class, 'installment_id', 'id');
    }
}
