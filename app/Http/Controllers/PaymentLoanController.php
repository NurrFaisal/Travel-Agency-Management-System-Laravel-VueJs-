<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\PaymentLoan;
use App\model\PaymentLoanTransaction;
use Illuminate\Http\Request;
use Session;

class PaymentLoanController extends Controller
{
    protected function paymentLoanValidation($request){
        $request->validate([
            'pl_date' => 'required|date',
            'pl_name' => 'required',
            'total_payment_loan_amount' => 'required',
            'narration' => 'required',
            'received_by' => 'required',
            'paid_by' => 'required',
            'approved_by' => 'required',
        ]);
    }
    protected function allValidation($request){
        if($request->cash == 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.credit_cash_amount' => 'required|numeric',
            ]);
        }
        if($request->cheque == 1) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.bank_name' => 'required',
                'cheques.*.bank_date' => 'required',
                'cheques.*.bank_cheque_number' => 'required',
                'cheques.*.credit_bank_amount' => 'required',
            ]);
        }
        if($request->cash != 1 && $request->cheque != 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.credit_cash_amount' => 'required|numeric',
            ]);
        }
    }
    protected function paymentLoanBasic($request, $payment_loan){
        $payment_loan->pl_date = $request->pl_date;
        $payment_loan->pl_name = $request->pl_name;
        $payment_loan->cash = $request->cash;
        $payment_loan->cheque = $request->cheque;
        $payment_loan->total_payment_loan_amount = $request->total_payment_loan_amount;
        $payment_loan->narration = $request->narration;
        $payment_loan->received_by = $request->received_by;
        $payment_loan->paid_by = $request->paid_by;
        $payment_loan->approved_by = $request->approved_by;
    }
    public function savePaymentTransaction($request, $payment_loan){
        $pre_transaction = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $payment_loan->pl_date)->first();
        if($pre_transaction == null){
            $pre_transaction = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $payment_loan->pl_date)->first();
        }
        $transjaction = new PaymentLoanTransaction();
        $transjaction->payment_loan_id = $payment_loan->id;
        $transjaction->narration = $payment_loan->narration;
        $transjaction->transaction_date = $payment_loan->pl_date;
        $transjaction->debit_amount = $payment_loan->total_payment_loan_amount;
        $transjaction->loan_blance = $payment_loan->total_payment_loan_amount;
        if($pre_transaction == null){
            $transjaction->blance = $request->total_payment_loan_amount;
        }else{
            $transjaction->blance = $pre_transaction->blance + $request->total_payment_loan_amount;
        }
        $transjaction->save();
        $next_same_dates = PaymentLoanTransaction::where('id', '>', $transjaction->id)->where('transaction_date', $transjaction->transaction_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->blance += $request->total_payment_loan_amount;
            if($next_same_date->ins_payment_id == $transjaction->payment_loan_id){
                $next_same_date->loan_blance += $request->total_payment_loan_amount;
            }
            $next_same_date->update();
        }
        $next_dates = PaymentLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $request->total_payment_loan_amount;
            if($next_date->ins_payment_id == $transjaction->payment_loan_id){
                $next_date->loan_blance += $request->total_payment_loan_amount;
            }
            $next_date->update();
        }
    }
    protected function cashBookFunction($request, $payment_loan){
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $payment_loan->pl_date)->first();
        if($pre_cash_book == null){
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $payment_loan->pl_date)->first();
        }
        $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $payment_loan->pl_date)->where('branch_id', $payment_loan->location)->first();
        if($pre_branch_cash_book == null){
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $payment_loan->pl_date)->where('branch_id', $payment_loan->location)->first();
        }
        $cash_book = new CashBook();
        $cash_book->payment_loan_id = $payment_loan->id;
        $cash_book->branch_id = $payment_loan->location;
        $cash_book->cash_date = $payment_loan->pl_date;
        $cash_book->narration = $request->narration;
        $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
        if($pre_cash_book == null ){
            $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
        }else{
            $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
        }
        if($pre_branch_cash_book == null){
            $cash_book->branch_blance = -$request->cashs[0]['credit_cash_amount'];
        }else{
            $cash_book->branch_blance = $pre_branch_cash_book->branch_blance - $request->cashs[0]['credit_cash_amount'];
        }
        $cash_book->save();
        $next_same_dates = CashBook::where('id','>', $cash_book->id)->where('cash_date', $payment_loan->pl_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->blance -= $cash_book->credit_cash_amount;
            if($next_same_date->branch_id == $cash_book->branch_id){
                $next_same_date->branch_blance -= $cash_book->credit_cash_amount;
            }
            $next_same_date->update();
        }
        $next_dates = CashBook::where('cash_date', '>', $payment_loan->pl_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $cash_book->credit_cash_amount;
            if($next_date->branch_id == $cash_book->branch_id){
                $next_date->branch_blance -= $cash_book->credit_cash_amount;
            }
            $next_date->update();
        }

    }
    protected function chequeBookFunction($request, $payment_loan){
        $request->validate([
            'cheque' => 'required',
            'cheques.*.bank_name' => 'required',
            'cheques.*.bank_date' => 'required',
            'cheques.*.bank_cheque_number' => 'required',
            'cheques.*.credit_bank_amount' => 'required',
        ]);

        $cheques_arry = $request->cheques;
        $cheques_arry_count = count($cheques_arry);
        for ($i = 0; $i < $cheques_arry_count; $i++){
            $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $cheques_arry[$i]['bank_date'])->where('bank_name',  $cheques_arry[$i]['bank_name'] )->first();
            if($bank_blance == null){
                $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $cheques_arry[$i]['bank_date'])->where('bank_name',  $cheques_arry[$i]['bank_name'] )->first();
            }
            $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $cheques_arry[$i]['bank_date'])->first();
            if($pre_bank_book == null){
                $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $cheques_arry[$i]['bank_date'])->first();
            }
            $bank_book = new BankBook();
            $bank_book->payment_loan_id = $payment_loan->id;
            $bank_book->branch_id = $payment_loan->location;
            $bank_book->narration = $request->narration;
            $bank_book->bank_name = $cheques_arry[$i]['bank_name'];
            $bank_book->bank_date = $cheques_arry[$i]['bank_date'];
            $bank_book->bank_cheque_number = $cheques_arry[$i]['bank_cheque_number'];
            $bank_book->credit_bank_amount = $cheques_arry[$i]['credit_bank_amount'];
            if($pre_bank_book == null){
                $bank_book->blance = -$cheques_arry[$i]['credit_bank_amount'];
            }else{
                $bank_book->blance = $pre_bank_book->blance - $cheques_arry[$i]['credit_bank_amount'];
            }

            if($bank_blance == null){
                $bank_book->bank_blance = -$cheques_arry[$i]['credit_bank_amount'];
            }else{
                $bank_book->bank_blance = $bank_blance->bank_blance - $cheques_arry[$i]['credit_bank_amount'];
            }
            $bank_book->save();

            $next_same_dates = BankBook::where('id','>', $bank_book->id)->where('bank_date', $cheques_arry[$i]['bank_date'])->get();
            foreach ($next_same_dates as $next_same_date){
                $next_same_date->blance -= $bank_book->credit_bank_amount;
                if($next_same_date->bank_name == $bank_book->bank_name){
                    $next_same_date->bank_blance -= $bank_book->credit_bank_amount;
                }
                $next_same_date->update();
            }

            $next_dates = BankBook::where('bank_date', '>', $cheques_arry[$i]['bank_date'])->get();
            foreach ($next_dates as $next_date){
                $next_date->blance -= $bank_book->credit_bank_amount;
                if($next_date->bank_name == $bank_book->bank_name){
                    $next_date->bank_blance -= $bank_book->credit_bank_amount;
                }
                $next_date->update();
            }

        }

        // Bank
    }
    public function addPaymentLoan(Request $request){
        $this->paymentLoanValidation($request);
        $this->allValidation($request);
        $payment_loan = new PaymentLoan();
        $this->paymentLoanBasic($request, $payment_loan);
        $payment_loan->location = Session::get('location');
        $payment_loan->save();
        $this->savePaymentTransaction($request, $payment_loan);
        if($request->cash == 1){
            $this->cashBookFunction($request, $payment_loan);
        }
        if($request->cheque == 1){
            $this->chequeBookFunction($request, $payment_loan);
        }
        return 'Save Payment Transaciton';
    }
    public function getAllPaymentLoans(){
        $payment_loans = PaymentLoan::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'payment_loans' => $payment_loans
        ]);
    }
    public function editPaymentLoan($id){
        $payment_loan = PaymentLoan::with('cashs', 'cheques')->where('id', $id)->first();
        return response()->json([
            'payment_loan' => $payment_loan
        ]);
    }
    public function updateCashBook($request, $payment_loan){
        $cash_book = CashBook::where('payment_loan_id', $payment_loan->id)->first();
        if($cash_book != null){
            $old_amount = $cash_book->credit_cash_amount;
            $next_same_date_cashs = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_date_cashs as $next_same_date_cash){
                $next_same_date_cash->blance += $old_amount;
                if($next_same_date_cash->branch_id == $cash_book->branch_id){
                    $next_same_date_cash->branch_blance += $old_amount;
                }
                $next_same_date_cash->update();
            }
            $next_date_cashs = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
            foreach ($next_date_cashs as $next_date_cash){
                $next_date_cash->blance +=$old_amount;
                if($next_date_cash->branch_id == $cash_book->branch_id){
                    $next_date_cash->branch_blance += $old_amount;
                }
                $next_date_cash->update();
            }
            $cash_book->delete();
        }
        if($request->cash == 1){
            $this->cashBookFunction($request, $payment_loan);
        }
    }
    public function updateChequeBook($request, $payment_loan){
        $bank_books = BankBook::where('payment_loan_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $old_amount = $bank_book->credit_bank_amount;
            $next_same_bank_books = BankBook::where('bank_date', $bank_book->bank_date)->where('id', '>', $bank_book->id)->get();
            foreach ($next_same_bank_books as $next_same_bank_book){
                $next_same_bank_book->blance += $old_amount;
                if($next_same_bank_book->bank_name == $bank_book->bank_name){
                    $next_same_bank_book->bank_blance += $old_amount;
                }
                $next_same_bank_book->update();
            }
            $next_bank_books = BankBook::where('bank_date','>', $bank_book->bank_date)->orderBy('bank_date', 'asc')->get();
            foreach ($next_bank_books as $next_bank_book){
                $next_bank_book->blance += $old_amount;
                if($next_bank_book->bank_name == $bank_book->bank_name){
                    $next_bank_book->bank_blance += $old_amount;
                }
                $next_bank_book->update();
            }
            $bank_book->delete();
        }
        if($request->cheque == 1) {
            $this->chequeBookFunction($request, $payment_loan);
        }
    }
    protected function updatePaymentTransaction($request, $payment_loan){
        $transjaction = PaymentLoanTransaction::where('payment_loan_id', $payment_loan->id)->first();
        $old_amount = $transjaction->debit_amount;
        $next_same_date_transactions = PaymentLoanTransaction::where('id', '>', $transjaction->id)->where('transaction_date', $transjaction->transaciton_date)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction){
            $next_same_date_transaction->blance -= $old_amount;
            if($next_same_date_transaction->ins_payment_id == $transjaction->payment_loan_id){
                $next_same_date_transaction->loan_blance -= $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = PaymentLoanTransaction::where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction){
            $next_date_transaction->blance -= $old_amount;
            if($next_date_transaction->ins_payment_id == $transjaction->payment_loan_id){
                $next_date_transaction->loan_blance -= $old_amount;
            }
            $next_date_transaction->update();
        }
        $transjaction->delete();
        $this->savePaymentTransaction($request, $payment_loan);
    }
    public function updatePaymentLoan(Request $request){
        $this->paymentLoanValidation($request);
        $this->allValidation($request);
        $payment_loan = PaymentLoan::where('id', $request->id)->first();
        $this->paymentLoanBasic($request, $payment_loan);
        $payment_loan->update();
        $this->updateCashBook($request, $payment_loan);
        $this->updateChequeBook($request, $payment_loan);
        $this->updatePaymentTransaction($request, $payment_loan);
        return 'Update Payment Loan Transaction';
    }
    public function getAllPaymentLoanSearch($search){
        $payment_loans = PaymentLoan::orderBy('id', 'desc')
            ->where('id', $search.'%')
            ->orWhere('pl_date', 'like', $search.'%')
            ->orWhere('pl_name', 'like', $search.'%')
            ->orWhere('total_payment_loan_amount', 'like', $search.'%')
            ->paginate(10);
        return response()->json([
            'payment_loans' => $payment_loans
        ]);

    }
}
