<?php

namespace App\Http\Controllers;

use App\model\CashBook;
use App\model\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function addLoan(Request $request)
    {
        $loan = new Loan();
        $loan->name = $request->name;
        $loan->narration = $request->narration;
        $loan->loan_date = $request->loan_date;
        $loan->amount = $request->amount;
        $loan->save();
        $pre_cash_book = CashBook::orderBy('id', 'desc')->select('debit_cash_amount', 'blance')->first();
        $cash_book = new CashBook();
        $cash_book->loan_id = $loan->id;
        $cash_book->cash_date = $request->loan_date;
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->amount;
        if ($pre_cash_book == null) {
            $cash_book->blance = $request->amount;
        } else {
            $cash_book->blance = $pre_cash_book->blance + $request->amount;
        }

        $cash_book->save();
    }

    public function getAllLoans()
    {
        $loans = Loan::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'loans' => $loans
        ]);
    }

    public function editLoan($id)
    {
        $loan = Loan::where('id', $id)->first();
        return response()->json([
            'loan' => $loan
        ]);
    }

    public function updateLoan(Request $request)
    {
        $loan = Loan::where('id', $request->id)->first();
        $loan->name = $request->name;
        $loan->narration = $request->narration;
        $loan->loan_date = $request->loan_date;
        $loan->amount = $request->amount;
        $loan->update();
        $cash_book = CashBook::where('loan_id', $request->id)->first();
        if ($cash_book != null) {
            $cash_book->loan_id = null;
            $cash_book->narration = 'Update Loan (1st)';
            $cash_book->update();
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('debit_cash_amount', 'blance')->first();
            $update_cash_book = new  CashBook();
            $update_cash_book->cash_date = $request->cashs[0]['cash_date'];
            $update_cash_book->credit_cash_amount = $cash_book->debit_cash_amount;
            $update_cash_book->narration = $cash_book->id . ' ' . ' Update Loan (2nd)';
            $update_cash_book->blance = $pre_cash_book->blance - $cash_book->debit_cash_amount;
            $update_cash_book->save();
        }
        $pre_cash_book = CashBook::orderBy('id', 'desc')->select('debit_cash_amount', 'blance')->first();
        $cash_book = new CashBook();
        $cash_book->loan_id = $loan->id;
        $cash_book->cash_date = $request->loan_date;
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->amount;
        if ($pre_cash_book == null) {
            $cash_book->blance = $request->amount;
        } else {
            $cash_book->blance = $pre_cash_book->blance + $request->amount;
        }

        $cash_book->save();
    }

}
