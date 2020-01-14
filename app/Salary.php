<?php

namespace App;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Staff;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['salary_date', 'staff', 'cash', 'bank', 'cheque', 'total_salary_amount', 'narration', 'received_by', 'paid_by', 'approved_by'];

    public function stafft(){
        return $this->belongsTo(Staff::class, 'staff');
    }
    public function cashs(){
        return $this->hasMany(CashBook::class, 'salary_id', 'id');
    }

    public function cheques(){
        return $this->hasMany(BankBook::class, 'salary_id', 'id');
    }
}
