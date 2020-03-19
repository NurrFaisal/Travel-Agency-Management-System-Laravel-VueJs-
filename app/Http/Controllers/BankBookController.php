<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use Illuminate\Http\Request;

class BankBookController extends Controller
{
    public function getAllBankBook()
    {
        $bank_books = BankBook::orderBy('bank_date')->paginate(10);
        return response()->json([
            'bank_books' => $bank_books
        ]);
    }

    public function getAllBankBookDetails($id)
    {
        $bank_books = BankBook::where('bank_name', $id)->orderBy('id')->paginate(10);
        return response()->json([
            'bank_books' => $bank_books
        ]);
    }
}
