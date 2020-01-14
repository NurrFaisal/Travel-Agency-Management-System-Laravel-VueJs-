<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    protected $fillable = ['incentive_date', 'staff', 'cash', 'cheque', 'total_incentive_amount', 'narration', 'received_by', 'paid_by', 'approved_by'];

    public function stafft(){
        return $this->belongsTo(Staff::class, 'staff');
    }
    public function cashs(){
        return $this->hasMany(CashBook::class, 'incentive_id', 'id');
    }

    public function cheques(){
        return $this->hasMany(BankBook::class, 'incentive_id', 'id');
    }
}
