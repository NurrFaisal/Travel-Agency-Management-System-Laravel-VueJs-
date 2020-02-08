<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ReceivedLoan;
use App\model\ReceivedLoanTransaction;
use App\ReceivedLoanHead;
use App\RLInstallment;
use Illuminate\Http\Request;

class RLInstallmentController extends Controller
{
    public function getAllReceivedLoanName(){
        $received_loans = ReceivedLoan::orderBy('rl_head', 'asc')->get();
        return response()->json([
                'received_loans' => $received_loans,
        ]);
    }
    protected function rlInstallmentValidation($request){
        $request->validate([
            'loan_id' => 'required',
            'rl_installment_date' => 'required',
            'total_received_loan_installment_amount' => 'required',
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
    protected function rlInstallmentBasic($request, $rl_installment){
        $rl_installment->loan_id = $request->loan_id;
        $rl_installment->rl_installment_date = $request->rl_installment_date;
        $rl_installment->cash = $request->cash;
        $rl_installment->cheque = $request->cheque;
        $rl_installment->total_received_loan_installment_amount = $request->total_received_loan_installment_amount;
        $rl_installment->narration = $request->narration;
        $rl_installment->received_by = $request->received_by;
        $rl_installment->paid_by = $request->paid_by;
        $rl_installment->approved_by = $request->approved_by;
    }
    protected function saveRLInstallmentCash($request, $rl_installment){
        $request->validate([
            'cash' => 'required',
            'cashs.*.credit_cash_amount' => 'required'
        ]);
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $rl_installment->rl_installment_date)->first();
        if($pre_cash_book == null){
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $rl_installment->rl_installment_date)->first();
        }
        $cash_book = new CashBook();
        $cash_book->rl_installment_id = $rl_installment->id;
        $cash_book->cash_date = $rl_installment->rl_installment_date;
        $cash_book->narration = $request->narration;
        $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
        if($pre_cash_book == null ){
            $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
        }else{
            $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
        }
        $cash_book->save();
        $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $rl_installment->rl_installment_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->blance -= $cash_book->credit_cash_amount;
            $next_same_date->update();
        }
        $next_dates = CashBook::orderBy('cash_date', 'asc')->where('cash_date', '>', $rl_installment->rl_installment_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $cash_book->credit_cash_amount;
            $next_date->update();
        }
    }
    protected function saveRLInstallmentCheque($request, $rl_installment){
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
            $bank_book->rl_installment_id = $rl_installment->id;
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
    }
    protected function saveReceivedLoanTransaction($request, $rl_installment){
        $loan_blance = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $rl_installment->rl_installment_date )->where('ins_loan_id',  $rl_installment->loan_id )->first();
        if($loan_blance == null){
            $loan_blance = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $rl_installment->rl_installment_date)->where('ins_loan_id',  $rl_installment->loan_id)->first();
            if($loan_blance == null){
                $loan_blance = ReceivedLoanTransaction::where('received_loan_id',  $rl_installment->loan_id )->first();
            }
        }
        $pre_transaction = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $rl_installment->rl_installment_date)->first();
        if($pre_transaction == null){
            $pre_transaction = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $rl_installment->rl_installment_date)->first();
        }
        $transjaction = new ReceivedLoanTransaction();
        $transjaction->ins_loan_id = $request->loan_id;
        $transjaction->rl_installment_id = $rl_installment->id;
        $transjaction->narration = $rl_installment->narration;
        $transjaction->transaction_date = $rl_installment->rl_installment_date;
        $transjaction->debit_amount = $rl_installment->total_received_loan_installment_amount;
        if($loan_blance == null){
            $transjaction->loan_blance = $rl_installment->total_received_loan_installment_amount;
        }else{
            $transjaction->loan_blance = $loan_blance->loan_blance + $rl_installment->total_received_loan_installment_amount;
        }
        if($pre_transaction == null){
            $transjaction->blance = $rl_installment->total_received_loan_installment_amount;
        }else{
            $transjaction->blance = $pre_transaction->blance + $rl_installment->total_received_loan_installment_amount;
        }
        $transjaction->save();

        $next_dates = ReceivedLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $request->total_received_loan_installment_amount;
            if($next_date->ins_loan_id == $request->loan_id){
                $next_date->loan_blance += $request->total_received_loan_installment_amount;
            }
            $next_date->update();
        }
    }
    public function addReceivedLoanInstallment(Request $request){
        $this->rlInstallmentValidation($request);
        $this->allValidation($request);
        $rl_installment = new RLInstallment();
        $this->rlInstallmentBasic($request, $rl_installment);
        $rl_installment->save();
        $this->saveReceivedLoanTransaction($request, $rl_installment);
        if($request->cash == 1) {
            $this->saveRLInstallmentCash($request, $rl_installment);
        }
        if($request->cheque == 1) {
            $this->saveRLInstallmentCheque($request, $rl_installment);
        }
        return 'RL Installment Added Successfully';
    }
    public function getAllRLInstallment(){
        $installments = RLInstallment::orderBy('rl_installment_date')->paginate(10);
        return response()->json([
            'installments' => $installments
        ]);
    }
    public function editRLInstallment($id){
        $installment = RLInstallment::with('cashs', 'cheques')->where('id', $id)->first();
        return response()->json([
            'installment' => $installment
        ]);
    }
    public function updateRLCashBook($request, $rl_installment){
        $cash_book = CashBook::where('rl_installment_id', $rl_installment->id)->first();
        if($cash_book != null){
            $old_amount = $cash_book->credit_cash_amount;
            $next_same_date_cashs = CashBook::where('id', '>', $cash_book->id)->select('id', 'rl_installment_id', 'credit_cash_amount', 'cash_date', 'blance')->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_date_cashs as $next_same_date_cash){
                $next_same_date_cash->blance += $old_amount;
                $next_same_date_cash->update();
            }
            $next_date_cashs = CashBook::where('cash_date', '>', $cash_book->cash_date)->select('id', 'rl_installment_id', 'credit_cash_amount', 'cash_date', 'blance')->get();
            foreach ($next_date_cashs as $next_date_cash){
                $next_date_cash->blance +=$old_amount;
                $next_date_cash->update();
            }
            $cash_book->delete();
        }
        if($request->cash == 1){
            $this->saveRLInstallmentCash($request, $rl_installment);
        }
    }
    public function updateRLInstallmentCheque($request, $rl_installment){
        $bank_books = BankBook::where('rl_installment_id', $request->id)->get();
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
            $this->saveRLInstallmentCheque($request, $rl_installment);
        }
    }
    public function updateRLTransaction($request, $rl_installment){
        $transaction = ReceivedLoanTransaction::where('rl_installment_id', $rl_installment->id)->first();
        $old_amount = $transaction->debit_amount;
        $next_same_date_transactions = ReceivedLoanTransaction::where('transaction_date', $transaction->transaction_date)->where('id', '>', $transaction->id)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction){
            $next_same_date_transaction->blance -= $old_amount;
            if($next_same_date_transaction->ins_loan_id == $transaction->ins_loan_id){
                $next_same_date_transaction->loan_blance -= $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = ReceivedLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transaction->transaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction){
            $next_date_transaction->blance -= $old_amount;
            if($next_date_transaction->ins_loan_id == $transaction->ins_loan_id){
                $next_date_transaction->loan_blance -= $old_amount;
            }
            $next_date_transaction->update();
        }
        $transaction->delete();
        $this->saveReceivedLoanTransaction($request, $rl_installment);
    }
    public function updateRLInstallment(Request $request){
        $this->rlInstallmentValidation($request);
        $this->allValidation($request);
        $rl_installment = RLInstallment::where('id', $request->id)->first();
        $this->rlInstallmentBasic($request, $rl_installment);
        $rl_installment->update();
        if($rl_installment->cash == 1){
            $this->updateRLCashBook($request, $rl_installment);
        }
        if($rl_installment->cheque == 1){
            $this->updateRLInstallmentCheque($request, $rl_installment);
        }
        $this->updateRLTransaction($request, $rl_installment);

        return 'Update RL Installment';
    }
}
