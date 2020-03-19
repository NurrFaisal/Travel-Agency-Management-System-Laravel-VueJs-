<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use Illuminate\Http\Request;

class ChequeBookController extends Controller
{
    public function getAllCheque()
    {
        $cheque_books = ChequeBook::where('status', 0)->paginate(10);
        return response()->json([
            'cheque_books' => $cheque_books
        ]);
    }

    protected function cashBookFunction($request, $cheque_book)
    {
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $request->cash_date)->first();
        if ($pre_cash_book == null) {
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $request->cash_date)->first();
        }
        $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $request->cash_date)->where('branch_id', $cheque_book->location)->first();
        if ($pre_branch_cash_book == null) {
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $request->cash_date)->where('branch_id', $cheque_book->location)->first();
        }
        $cash_book = new CashBook();
        $cash_book->cheque_id = $cheque_book->id;
        $cash_book->branch_id = $cheque_book->location;
        $cash_book->cash_date = $request->cash_date;
        $cash_book->narration = 'Cheque To Cash';
        $cash_book->debit_cash_amount = $cheque_book->cheque_amount;
        if ($pre_cash_book == null) {
            $cash_book->blance = $cheque_book->cheque_amount;
        } else {
            $cash_book->blance = $pre_cash_book->blance + $cheque_book->cheque_amount;
        }
        if ($pre_branch_cash_book == null) {
            $cash_book->branch_blance = $cheque_book->cheque_amount;
        } else {
            $cash_book->branch_blance = $pre_branch_cash_book->branch_blance + $cheque_book->cheque_amount;
        }
        $cash_book->save();
        $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $request->cash_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance += $cash_book->debit_cash_amount;
            if ($next_same_date->branch_id == $cash_book->branch_id) {
                $next_same_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_same_date->update();
        }
        $next_dates = CashBook::where('cash_date', '>', $request->cash_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $cash_book->debit_cash_amount;
            if ($next_date->branch_id == $cash_book->branch_id) {
                $next_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_date->update();
        }

    }

    protected function bankBookFunction($request, $cheque_book)
    {
        $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $request->bank_date)->where('bank_name', $request->bank_name)->first();
        if ($bank_blance == null) {
            $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $request->bank_date)->where('bank_name', $request->bank_name)->first();
        }
        $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $request->bank_date)->first();
        if ($pre_bank_book == null) {
            $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $request->bank_date)->first();
        }
        $bank_book = new BankBook();
        $bank_book->cheque_id = $cheque_book->id;
        $bank_book->bank_name = $request->bank_name;
        $bank_book->bank_date = $request->bank_date;
        $bank_book->narration = 'Cheque To Bank';
        $bank_book->debit_bank_amount = $cheque_book->cheque_amount;
        if ($pre_bank_book == null) {
            $bank_book->blance = $cheque_book->cheque_amount;
        } else {
            $bank_book->blance = $pre_bank_book->blance + $cheque_book->cheque_amount;
        }
        if ($bank_blance == null) {
            $bank_book->bank_blance = $cheque_book->cheque_amount;
        } else {
            $bank_book->bank_blance = $bank_blance->bank_blance + $cheque_book->cheque_amount;
        }
        $bank_book->save();
        $next_same_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $request->bank_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance += $bank_book->debit_bank_amount;
            if ($next_same_date->bank_name == $bank_book->bank_name) {
                $next_same_date->bank_blance += $bank_book->debit_bank_amount;
            }
            $next_same_date->update();
        }

        $next_dates = BankBook::orderBy('bank_date', 'asc')->where('bank_date', '>', $request->bank_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $bank_book->debit_bank_amount;
            if ($next_date->bank_name == $bank_book->bank_name) {
                $next_date->bank_blance += $bank_book->debit_bank_amount;
            }
            $next_date->update();
        }
    }

    public function clearCheque(Request $request)
    {
        $cheque_book = ChequeBook::where('id', $request->id)->first();
        $cheque_book->status = 1;
        if ($cheque_book->cheque_type == 1) {
            $this->cashBookFunction($request, $cheque_book);
        }
        if ($cheque_book->cheque_type == 2) {
            $this->bankBookFunction($request, $cheque_book);
        }
        $cheque_book->update();
    }

    public function getAllClearCheque()
    {
        $cheque_books = ChequeBook::where('status', 1)->paginate(10);
        return response()->json([
            'cheque_books' => $cheque_books
        ]);
    }
}
