<?php

namespace App\Http\Controllers;

use App\model\CashBook;
use Illuminate\Http\Request;

class CashBookController extends Controller
{
    public function getAllCashBook(){
        $cash_books = CashBook::orderBy('cash_date')->paginate(10);
        return response()->json([
            'cash_books' => $cash_books
        ]);
    }
}
