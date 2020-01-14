<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class MoneyReceived extends Model
{
    protected $fillable = ['guest', 'staff', 'bill_amount', 'total_received_amount', 'due_amount', 'narration'];

    public function staff(){
        return $this->belongsTo(Staff::class, 'sell_person');
    }

    public function guestt(){
        return $this->belongsTo(Guest::class, 'guest');
    }
    public function stafft(){
        return $this->belongsTo(Staff::class, 'staff');
    }

    public function cashs(){
        return $this->hasMany(CashBook::class, 'received_id', 'id');
    }
    public function banks(){
        return $this->hasMany(BankBook::class, 'received_id', 'id');
    }
    public function cheques(){
        return $this->hasMany(ChequeBook::class, 'received_id', 'id');
    }
    public function others(){
        return $this->hasMany(Other::class, 'received_id', 'id');
    }
}
