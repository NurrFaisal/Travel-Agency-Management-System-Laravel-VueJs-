<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    protected $fillable = ['expence_date', 'expence_head', 'cash', 'cheque', 'total_expence_amount', 'narration', 'received_by', 'paid_by', 'approved_by'];

    public function expenceHeadt(){
        return $this->belongsTo(ExpenceHead::class, 'expence_head');
    }
    public function cashs(){
        return $this->hasMany(CashBook::class, 'expence_id', 'id');
    }

    public function cheques(){
        return $this->hasMany(BankBook::class, 'expence_id', 'id');
    }
}
