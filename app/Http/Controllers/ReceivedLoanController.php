<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use App\model\ReceivedLoan;
use App\model\ReceivedLoanTransaction;
use Illuminate\Http\Request;

class ReceivedLoanController extends Controller
{
    protected function receivedLoanValidation($request){
        $request->validate([
            'rl_date' => 'required',
            'rl_head' => 'required',
            // array validation defined in down
            'total_received_loan_amount' =>'required',
            'narration' =>'required',
        ]);
    }
    protected function allValidation($request){
        if($request->cash == 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }
        if($request->bank == 1) {
            $request->validate([
                'bank' => 'required',
                'banks.*.bank_name' => 'required|numeric',
                'banks.*.bank_date' => 'required|date',
                'banks.*.debit_bank_amount' => 'required|numeric',
            ]);
        }
        if($request->cheque == 1) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.cheque_bank_name' => 'required',
                'cheques.*.cheque_type' => 'required|numeric',
                'cheques.*.cheque_number' => 'required|numeric',
                'cheques.*.cheque_amount' => 'required|numeric',
                'cheques.*.cheque_date' => 'required',
            ]);
        }
        if($request->cash != 1 && $request->bank != 1 && $request->cheque != 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }
    }
    protected function receivedLoanBasic($request, $received_loan){
        $received_loan->rl_date = $request->rl_date;
        $received_loan->rl_head = $request->rl_head;
        $received_loan->cash = $request->cash;
        $received_loan->bank = $request->bank;
        $received_loan->cheque = $request->cheque;
        $received_loan->total_received_loan_amount = $request->total_received_loan_amount;
        $received_loan->narration = $request->narration;
    }
    protected function cashBookFunction($request, $received_loan){
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $received_loan->rl_date)->first();
        if($pre_cash_book == null){
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $received_loan->rl_date)->first();
        }
        $cash_book = new CashBook();
        $cash_book->received_loan_id = $received_loan->id;
        $cash_book->cash_date = $received_loan->rl_date;
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->cashs[0]['debit_cash_amount'];
        if($pre_cash_book == null ){
            $cash_book->blance = $request->cashs[0]['debit_cash_amount'];
        }else{
            $cash_book->blance = $pre_cash_book->blance + $request->cashs[0]['debit_cash_amount'];
        }
        $cash_book->save();
        $next_same_dates = CashBook::where('id','>', $cash_book->id)->where('cash_date', $received_loan->rl_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->blance += $cash_book->debit_cash_amount;
            $next_same_date->update();
        }
        $next_dates = CashBook::where('cash_date', '>', $received_loan->rl_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $cash_book->debit_cash_amount;
            $next_date->update();
        }

    }
    protected function bankBookFunction($request, $received_loan){
        $banks_arry = $request->banks;
        $banks_arry_count = count($banks_arry);
        for ($i = 0; $i < $banks_arry_count; $i++){
            $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $banks_arry[$i]['bank_date'])->where('bank_name',  $banks_arry[$i]['bank_name'] )->first();
            if($bank_blance == null){
                $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $banks_arry[$i]['bank_date'])->where('bank_name',  $banks_arry[$i]['bank_name'] )->first();
            }
            $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $banks_arry[$i]['bank_date'])->first();
            if($pre_bank_book == null){
                $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $banks_arry[$i]['bank_date'])->first();
            }
            $bank_book = new BankBook();
            $bank_book->received_loan_id = $received_loan->id;
            $bank_book->bank_name = $banks_arry[$i]['bank_name'];
            $bank_book->bank_date = $banks_arry[$i]['bank_date'];
            $bank_book->narration = $request->narration;
            $bank_book->debit_bank_amount = $banks_arry[$i]['debit_bank_amount'];
            if($pre_bank_book == null){
                $bank_book->blance = $banks_arry[$i]['debit_bank_amount'];
            }else{
                $bank_book->blance = $pre_bank_book->blance + $banks_arry[$i]['debit_bank_amount'];
            }
            if($bank_blance == null){
                $bank_book->bank_blance = $banks_arry[$i]['debit_bank_amount'];
            }else{
                $bank_book->bank_blance = $bank_blance->bank_blance + $banks_arry[$i]['debit_bank_amount'];
            }
            $bank_book->save();
            $next_same_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $banks_arry[$i]['bank_date'])->get();
            foreach ($next_same_dates as $next_same_date){
                $next_same_date->blance += $bank_book->debit_bank_amount;
                if($next_same_date->bank_name == $bank_book->bank_name){
                    $next_same_date->bank_blance += $bank_book->debit_bank_amount;
                }
                $next_same_date->update();
            }

            $next_dates = BankBook::orderBy('bank_date', 'asc')->where('bank_date', '>', $banks_arry[$i]['bank_date'])->get();
            foreach ($next_dates as $next_date){
                $next_date->blance += $bank_book->debit_bank_amount;
                if($next_date->bank_name == $bank_book->bank_name){
                    $next_date->bank_blance += $bank_book->debit_bank_amount;
                }
                $next_date->update();
            }


        }

        // Bank
    }
    protected function chequeBookFunction($request, $received_loan){
        $cheques_arry = $request->cheques;
        $cheques_arry_count = count($cheques_arry);
        for ($i = 0; $i < $cheques_arry_count; $i++){
            $cheque_book = new ChequeBook();
            $cheque_book->received_loan_id = $received_loan->id;
            $cheque_book->cheque_bank_name = $cheques_arry[$i]['cheque_bank_name'];
            $cheque_book->cheque_type = $cheques_arry[$i]['cheque_type'];
            $cheque_book->cheque_number = $cheques_arry[$i]['cheque_number'];
            $cheque_book->cheque_date = $cheques_arry[$i]['cheque_date'];
            $cheque_book->cheque_amount = $cheques_arry[$i]['cheque_amount'];
            $cheque_book->status = 0;
            $cheque_book->save();
        }

        // Cheque
    }
    protected function saveallbooks($request, $received_loan){
        if($request->cash == 1){
            $this->cashBookFunction($request, $received_loan);
        }
        if($request->bank == 1) {
            $this->bankBookFunction($request, $received_loan);
        }
        if($request->cheque == 1) {
            $this->chequeBookFunction($request, $received_loan);
        }
    }
    protected function saveReceivedLoanTransaction($request, $received_loan){
        $head_blance = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $received_loan->rl_date )->where('rl_head',  $received_loan->rl_head )->first();
        if($head_blance == null){
            $head_blance = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $received_loan->rl_date)->where('rl_head',  $received_loan->rl_head )->first();
        }
        $pre_transaction = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $received_loan->rl_date)->first();
        if($pre_transaction == null){
            $pre_transaction = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $received_loan->rl_date)->first();
        }
        $transjaction = new ReceivedLoanTransaction();
        $transjaction->rl_head = $request->rl_head;
        $transjaction->received_loan_id = $received_loan->id;
        $transjaction->narration = $received_loan->narration;
        $transjaction->transaction_date = $received_loan->rl_date;
        $transjaction->credit_amount = $received_loan->total_received_loan_amount;
        if($head_blance == null){
            $transjaction->rl_head_blance = -$request->total_received_loan_amount;
        }else{
            $transjaction->rl_head_blance = $head_blance->rl_head_blance - $request->total_received_loan_amount;
        }
        if($pre_transaction == null){
            $transjaction->blance = -$request->total_received_loan_amount;
        }else{
            $transjaction->blance = $pre_transaction->blance - $request->total_received_loan_amount;
        }
        $transjaction->save();

        $next_dates = ReceivedLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $request->total_received_loan_amount;
            if($next_date->rl_head == $request->rl_head){
                $next_date->rl_head_blance -= $request->total_received_loan_amount;
            }
            $next_date->update();
        }
    }
    public function addReceivedLoan(Request $request){
        $this->receivedLoanValidation($request);
        $this->allValidation($request);
        $received_loan = new ReceivedLoan();
        $this->receivedLoanBasic($request, $received_loan);
        $received_loan->save();
        $this->saveallbooks($request, $received_loan);
        $this->saveReceivedLoanTransaction($request, $received_loan);
        return 'Saved All Book And Transaction';
    }
    public function getAllReceivedLoan(){
        $received_loans = ReceivedLoan::with('head')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'received_loans' => $received_loans
        ]);
    }
    public function editReceivedLoan($id){
        $received_loan = ReceivedLoan::with('cashs', 'banks', 'cheques', 'head')->where('id', $id)->first();
        return response()->json([
            'received_loan' => $received_loan
        ]);
    }
    public function updateReceivedLoan(Request $request){
        return $request;
    }
}
