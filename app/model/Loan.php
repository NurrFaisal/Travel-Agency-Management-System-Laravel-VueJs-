<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['name', 'narration', 'loan_date', 'amount'];
}
