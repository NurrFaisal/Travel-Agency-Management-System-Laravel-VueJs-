<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use Illuminate\Http\Request;

class ChequeBookController extends Controller
{
    public function getAllCheque(){
        $cheque_books = ChequeBook::where('status', 0)->paginate(10);
        return response()->json([
            'cheque_books' => $cheque_books
        ]);
    }
    public function clearCheque(Request $request){
        $cheque_book = ChequeBook::where('id', $request->id)->first();
        $cheque_book->status = 1;
        if($cheque_book->cheque_type == 1){
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('blance')->first();
            $cash_book = new CashBook();
            $cash_book->cheque_id = $request->id;
            $cash_book->cash_date = $request->cash_date;
            $cash_book->narration = 'Cheque To Cash';
            $cash_book->debit_cash_amount = $cheque_book->cheque_amount;
            $cash_book->blance = $pre_cash_book->blance + $cheque_book->cheque_amount;
            $cash_book->save();
            $cheque_book->update();
        }
        if($cheque_book->cheque_type == 0){
            $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $request->bank_name)->first();
            $pre_bank_book = BankBook::orderBy('id', 'desc')->first();
            $bank_book = new BankBook();
            $bank_book->cheque_id = $request->id;
            $bank_book->bank_name = $request->bank_name;
            $bank_book->bank_date = $request->bank_date;
            $bank_book->narration = 'Cheque To Bank';
            $bank_book->debit_bank_amount = $cheque_book->cheque_amount;
            $bank_book->blance = $pre_bank_book->blance + $cheque_book->cheque_amount;
            $bank_book->bank_blance = $bank_blance->bank_blance + $cheque_book->cheque_amount;
            $bank_book->save();
            $cheque_book->update();
        }
    }
    public function getAllClearCheque(){
        $cheque_books = ChequeBook::where('status', 1)->paginate(10);
        return response()->json([
            'cheque_books' => $cheque_books
        ]);
    }
}
