<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Contra extends Model
{
    protected $fillable = ['contra_type', 'contra_date', 'contra_amount', 'from_bank_name', 'to_bank_name', 'bank_name', 'narration'];

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_name');
    }
    public function from_bank(){
        return $this->belongsTo(Bank::class, 'from_bank_name');
    }
    public function to_bank(){
        return $this->belongsTo(Bank::class, 'to_bank_name');
    }
}
