<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Installment;
use App\model\Loan;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    protected function installmentValidation($request)
    {
        $request->validate([
            'loan_id' => 'required',
            'narration' => 'required',
            'total_amount' => 'required',
        ]);
    }

    protected function installmentBasic($installment, $request)
    {
        $installment->loan_id = $request->loan_id;
        $installment->cash = $request->cash;
        $installment->cheque = $request->cheque;
        $installment->narration = $request->narration;
        $installment->total_amount = $request->total_amount;
    }

    public function addInstallment(Request $request)
    {
        $this->installmentValidation($request);
        $installment = new Installment();
        $this->installmentBasic($installment, $request);
        $installment->save();
        if ($request->cash == 1) {
            $request->validate([
                'cash' => 'required',
                'cashs.*.credit_cash_amount' => 'required'
            ]);
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $cash_book = new CashBook();
            $cash_book->installment_id = $installment->id;
            $cash_book->cash_date = $request->cashs[0]['cash_date'];
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            $cash_book->narration = $request->narration;
            if ($pre_cash_book == null) {
                $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
            } else {
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
            }
            $cash_book->save();
        }

        if ($request->cheque == 1) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.bank_name' => 'required',
                'cheques.*.bank_date' => 'required',
                'cheques.*.bank_cheque_number' => 'required',
                'cheques.*.credit_bank_amount' => 'required',
            ]);
            $cheques_arry = $request->cheques;
            $cheques_arry_count = count($cheques_arry);
            for ($i = 0; $i < $cheques_arry_count; $i++) {
                $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
                $bank_book = new BankBook();
                $bank_book->installment_id = $installment->id;
                $bank_book->narration = $request->narration;
                $bank_book->bank_name = $cheques_arry[$i]['bank_name'];
                $bank_book->bank_date = $cheques_arry[$i]['bank_date'];
                $bank_book->bank_cheque_number = $cheques_arry[$i]['bank_cheque_number'];
                $bank_book->credit_bank_amount = $cheques_arry[$i]['credit_bank_amount'];
                if ($pre_bank_book == null) {
                    $bank_book->blance = -$cheques_arry[$i]['credit_bank_amount'];
                } else {
                    $bank_book->blance = $pre_bank_book->blance - $cheques_arry[$i]['credit_bank_amount'];
                }

                if ($bank_blance == null) {
                    $bank_book->bank_blance = -$cheques_arry[$i]['credit_bank_amount'];
                } else {
                    $bank_book->bank_blance = $bank_blance->bank_blance - $cheques_arry[$i]['credit_bank_amount'];
                }

                $bank_book->save();
            }

        }
    }

    public function getAllInstallment($id)
    {
        $installments = Installment::where('loan_id', $id)->get();
        $loan = Loan::where('id', $id)->select('id', 'name')->first();
        return response()->json([
            'installments' => $installments,
            'loan' => $loan
        ]);
    }

    public function editInstallment($id)
    {
        $installment = Installment::where('id', $id)->with(['cashs' => function ($q) {
            $q->select('id', 'installment_id', 'cash_date', 'credit_cash_amount');
        }, 'cheques' => function ($q) {
            $q->select('id', 'installment_id', 'bank_name', 'bank_date', 'bank_cheque_number', 'credit_bank_amount');
        }])->first();
        return response()->json([
            'installment' => $installment
        ]);

    }

    public function updateInstallment(Request $request)
    {
        $this->installmentValidation($request);
        $installment = Installment::where('id', $request->id)->first();
        $this->installmentBasic($installment, $request);
        $installment->update();
        $cash_book = CashBook::where('installment_id', $request->id)->first();
        if ($cash_book != null) {
            $cash_book->installment_id = null;
            $cash_book->narration = 'Update installment (1st)';
            $cash_book->update();
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $update_cash_book = new  CashBook();
            $update_cash_book->cash_date = $request->cashs[0]['cash_date'];
            $update_cash_book->narration = $cash_book->id . ' ' . ' Update Installment (2nd)';
            $update_cash_book->debit_cash_amount = $cash_book->credit_cash_amount;
            $update_cash_book->blance = $pre_cash_book->blance + $cash_book->credit_cash_amount;
            $update_cash_book->save();
        }

        if ($request->cash == 1) {
            $request->validate([
                'cash' => 'required',
                'cashs.*.credit_cash_amount' => 'required'
            ]);
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $cash_book = new CashBook();
            $cash_book->installment_id = $installment->id;
            $cash_book->cash_date = $request->cashs[0]['cash_date'];
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            $cash_book->narration = $request->narration;
            if ($pre_cash_book == null) {
                $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
            } else {
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
            }
            $cash_book->save();
        }
        $bank_books = BankBook::where('installment_id', $request->id)->get();
        foreach ($bank_books as $bank_book) {
            $bank_book->installment_id = null;
            $bank_book->narration = 'Update Installment (1st)';
            $bank_book->update();
            $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $bank_book->bank_name)->first();
            $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
            $update_bank_book = new BankBook();
            $update_bank_book->bank_name = $bank_book->bank_name;
            $update_bank_book->bank_date = $bank_book->bank_date;
            $update_bank_book->narration = $bank_book->id . ' ' . 'Updated Installment (2nd)';
            $update_bank_book->debit_bank_amount = $bank_book->credit_bank_amount;
            $update_bank_book->blance = $pre_bank_book->blance + $bank_book->credit_bank_amount;
            $update_bank_book->bank_blance = $bank_blance->bank_blance + $bank_book->credit_bank_amount;
            $update_bank_book->save();
        }
        if ($request->cheque == 1) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.bank_name' => 'required',
                'cheques.*.bank_date' => 'required',
                'cheques.*.bank_cheque_number' => 'required',
                'cheques.*.credit_bank_amount' => 'required',
            ]);
            $cheques_arry = $request->cheques;
            $cheques_arry_count = count($cheques_arry);
            for ($i = 0; $i < $cheques_arry_count; $i++) {
                $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
                $bank_book = new BankBook();
                $bank_book->installment_id = $installment->id;
                $bank_book->narration = $request->narration;
                $bank_book->bank_name = $cheques_arry[$i]['bank_name'];
                $bank_book->bank_date = $cheques_arry[$i]['bank_date'];
                $bank_book->bank_cheque_number = $cheques_arry[$i]['bank_cheque_number'];
                $bank_book->credit_bank_amount = $cheques_arry[$i]['credit_bank_amount'];
                if ($pre_bank_book == null) {
                    $bank_book->blance = -$cheques_arry[$i]['credit_bank_amount'];
                } else {
                    $bank_book->blance = $pre_bank_book->blance - $cheques_arry[$i]['credit_bank_amount'];
                }
                if ($bank_blance == null) {
                    $bank_book->bank_blance = -$cheques_arry[$i]['credit_bank_amount'];
                } else {
                    $bank_book->bank_blance = $bank_blance->bank_blance - $cheques_arry[$i]['credit_bank_amount'];
                }
                $bank_book->save();
            }

        }


    }

}
