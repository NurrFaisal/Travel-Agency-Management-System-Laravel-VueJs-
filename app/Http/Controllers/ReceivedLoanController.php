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
        $pre_transaction = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $received_loan->rl_date)->first();
        if($pre_transaction == null){
            $pre_transaction = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $received_loan->rl_date)->first();
        }
        $transjaction = new ReceivedLoanTransaction();
        $transjaction->received_loan_id = $received_loan->id;
        $transjaction->narration = $received_loan->narration;
        $transjaction->transaction_date = $received_loan->rl_date;
        $transjaction->credit_amount = $received_loan->total_received_loan_amount;
        $transjaction->loan_blance = -$received_loan->total_received_loan_amount;
        if($pre_transaction == null){
            $transjaction->blance = -$request->total_received_loan_amount;
        }else{
            $transjaction->blance = $pre_transaction->blance - $request->total_received_loan_amount;
        }
        $transjaction->save();
        $next_same_dates = ReceivedLoanTransaction::where('id', '>', $transjaction->id)->where('transaction_date', $transjaction->transaction_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->blance -= $request->total_received_loan_amount;
            if($next_same_date->ins_loan_id == $transjaction->received_loan_id){
                $next_same_date->loan_blance -= $request->total_received_loan_amount;
            }
            $next_same_date->update();
        }
        $next_dates = ReceivedLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $request->total_received_loan_amount;
            if($next_date->ins_loan_id == $transjaction->received_loan_id){
                $next_date->loan_blance -= $request->total_received_loan_amount;
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
        $this->saveReceivedLoanTransaction($request, $received_loan);
        $this->saveallbooks($request, $received_loan);
        return 'Saved All Book And Transaction';
    }
    public function getAllReceivedLoan(){
        $received_loans = ReceivedLoan::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'received_loans' => $received_loans
        ]);
    }
    public function editReceivedLoan($id){
        $received_loan = ReceivedLoan::with('cashs', 'banks', 'cheques')->where('id', $id)->first();
        return response()->json([
            'received_loan' => $received_loan
        ]);
    }
    public function updateCashBook($request, $received_loan){
        $cash_book = CashBook::where('received_loan_id', $received_loan->id)->select('id', 'received_loan_id', 'debit_cash_amount', 'cash_date', 'blance', 'narration')->first();
        if($cash_book != null){
            $old_amount = $cash_book->debit_cash_amount;
            $next_same_date_cashs = CashBook::where('id', '>', $cash_book->id)->select('id', 'received_loan_id', 'debit_cash_amount', 'cash_date', 'blance')->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_date_cashs as $next_same_date_cash){
                $next_same_date_cash->blance -= $old_amount;
                $next_same_date_cash->update();
            }
            $next_date_cashs = CashBook::where('cash_date', '>', $cash_book->cash_date)->select('id', 'received_id', 'debit_cash_amount', 'cash_date', 'blance')->get();
            foreach ($next_date_cashs as $next_date_cash){
                $next_date_cash->blance -=$old_amount;
                $next_date_cash->update();
            }
            $cash_book->delete();
        }
        if($request->cash == 1){
            $this->cashBookFunction($request, $received_loan);
        }
    }
    protected function updateBankBook($request, $received_loan){
        $bank_books = BankBook::where('received_loan_id', $received_loan->id)->select('id', 'received_loan_id', 'debit_bank_amount', 'bank_date', 'blance', 'bank_blance', 'bank_name')->get();
        foreach ($bank_books as $bank_book){
            $decrement = $bank_book->debit_bank_amount;
            $next_same_date_banks = BankBook::where('id', '>', $bank_book->id)->select('id', 'received_loan_id', 'debit_bank_amount', 'bank_date', 'blance', 'bank_blance', 'bank_name')->where('bank_date', $bank_book->bank_date)->get();
            foreach ($next_same_date_banks as $next_same_date_bank){
                $next_same_date_bank->blance -= $decrement;
                if($next_same_date_bank->bank_name == $bank_book->bank_name){
                    $next_same_date_bank->bank_blance -= $decrement;
                }
                $next_same_date_bank->update();
            }
            $next_date_banks = BankBook::where('bank_date', '>', $bank_book->bank_date)->select('id', 'received_loan_id', 'debit_bank_amount', 'bank_date', 'blance', 'bank_blance', 'bank_name')->get();
            foreach ($next_date_banks as $next_date_bank){
                $next_date_bank->blance -= $decrement;
                if($next_date_bank->bank_name == $bank_book->bank_name){
                    $next_date_bank->bank_blance -= $decrement;
                }
                $next_date_bank->update();
            }
            $bank_book->delete();
        }
        if($request->bank == 1) {
            $this->bankBookFunction($request, $received_loan);
        }
    }
    protected function updateChequeBook($request, $received_loan){
        $cheque_books = ChequeBook::where('received_loan_id', $received_loan->id)->get();
        foreach ($cheque_books as $cheque_book){
            $cheque_book->delete();
        }
        if($request->cheque == 1) {
            $this->chequeBookFunction($request, $received_loan);
        }
    }
    protected function updateReceivedTransaction($request, $received_loan){
        $transjaction = ReceivedLoanTransaction::where('received_loan_id', $received_loan->id)->first();
        $old_amount = $transjaction->credit_amount;
        $next_same_date_transactions = ReceivedLoanTransaction::where('id', '>', $transjaction->id)->where('transaction_date', $transjaction->transaciton_date)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction){
            $next_same_date_transaction->blance += $old_amount;
            if($next_same_date_transaction->ins_loan_id == $transjaction->received_loan_id){
                $next_same_date_transaction->loan_blance += $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = ReceivedLoanTransaction::where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction){
            $next_date_transaction->blance += $old_amount;
            if($next_date_transaction->ins_loan_id == $transjaction->received_loan_id){
                $next_date_transaction->loan_blance += $old_amount;
            }
            $next_date_transaction->update();
        }
        $transjaction->delete();
        $this->saveReceivedLoanTransaction($request, $received_loan);
    }
    public function updateReceivedLoan(Request $request){
        $this->receivedLoanValidation($request);
        $this->allValidation($request);
        $received_loan = ReceivedLoan::where('id', $request->id)->first();
        $this->receivedLoanBasic($request, $received_loan);
        $received_loan->update();
        $this->updateCashBook($request, $received_loan);
        $this->updateBankBook($request, $received_loan);
        $this->updateChequeBook($request, $received_loan);
        $this->updateReceivedTransaction($request, $received_loan);
        return 'Received Loan Updated Successfully';
    }
}
