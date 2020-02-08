<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Payment;
use App\model\SuplierTransaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected function paymentValidation($request){
        $request->validate([
            'debit_voucher_date' => 'required',
            'suplier' => 'required',
            'total_payment_amount' => 'required|gt:0',
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
    protected function paymentBasic($request, $payment){
        $payment->debit_voucher_date = $request->debit_voucher_date;
        $payment->suplier = $request->suplier;
        $payment->cash = $request->cash;
        $payment->cheque = $request->cheque;
        $payment->total_payment_amount = $request->total_payment_amount;
        $payment->narration = $request->narration;
        $payment->received_by = $request->received_by;
        $payment->paid_by = $request->paid_by;
        $payment->approved_by = $request->approved_by;
    }
    protected function savePaymentCash($request, $payment){
        $request->validate([
            'cash' => 'required',
            'cashs.*.credit_cash_amount' => 'required'
        ]);
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $payment->debit_voucher_date)->first();
        if($pre_cash_book == null){
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $payment->debit_voucher_date)->first();
        }
        $cash_book = new CashBook();
        $cash_book->payment_id = $payment->id;
        $cash_book->cash_date = $payment->debit_voucher_date;
        $cash_book->narration = $request->narration;
        $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
        if($pre_cash_book == null ){
            $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
        }else{
            $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
        }
        $cash_book->save();
        $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $payment->debit_voucher_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->blance -= $cash_book->credit_cash_amount;
            $next_same_date->update();
        }
        $next_dates = CashBook::orderBy('cash_date', 'asc')->where('cash_date', '>', $payment->debit_voucher_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $cash_book->credit_cash_amount;
            $next_date->update();
        }
    }
    protected function savePaymentCheque($request, $payment){
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
            $bank_book->payment_id = $payment->id;
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


    protected function savePaymentSuplierTransaction($request, $payment){
        // SuplierTransaction Start
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $payment->debit_voucher_date)->where('suplier_id', $payment->suplier)->first();
        if($pre_suplier_sup_transaction == null){
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date','<', $payment->debit_voucher_date)->where('suplier_id', $payment->suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date',$payment->debit_voucher_date)->where('suplier_id', $payment->suplier)->first();
        if($pre_sup_transaction == null){
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $payment->debit_voucher_date)->where('suplier_id', $payment->suplier)->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id =  $payment->suplier;
        $suplier_transaction->debit_voucher_id = $payment->id;
        $suplier_transaction->transaction_date = $payment->debit_voucher_date;
        $suplier_transaction->narration = $payment->narration;
        $suplier_transaction->debit_amount = $payment->total_payment_amount;
        if($pre_sup_transaction == null){
            $suplier_transaction->balance = $payment->total_payment_amount;
        }else{
            $suplier_transaction->balance = $pre_sup_transaction->balance + $payment->total_payment_amount;
        }
        if($pre_suplier_sup_transaction == null){
            $suplier_transaction->suplier_balance = $payment->total_payment_amount;
        }else{
            $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance + $payment->total_payment_amount;
        }
        $suplier_transaction->save();
        $next_same_dates = SuplierTransaction::where('id', '>', $suplier_transaction->id)->where('transaction_date', $payment->debit_voucher_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->balance += $request->total_payment_amount;
            if($next_same_date->suplier_id == $suplier_transaction->suplier_id){
                $next_same_date->suplier_balance += $request->total_payment_amount;
            }
            $next_same_date->update();
        }
        $next_dates = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $payment->debit_voucher_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->balance += $request->total_payment_amount;
            if($next_date->suplier_id == $suplier_transaction->suplier_id){
                $next_date->suplier_balance += $request->total_payment_amount;
            }
            $next_date->update();
        }
        // SuplierTransaction End
    }
    public function addPayment(Request $request){
        $this->paymentValidation($request);
        $payment = new Payment();
        $this->paymentBasic($request, $payment);
        $payment->save();
        if($request->cash == 1){
            $this->savePaymentCash($request, $payment);
        }
        if($request->cheque == 1){
            $this->savePaymentCheque($request, $payment);
        }
        $this->savePaymentSuplierTransaction($request, $payment);
        return 'Save All Books And Transaction';
    }

    public function getAllPayment(){
        $payments = Payment::with(['supliert' => function($q){$q->select('id', 'name');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'payments' => $payments
        ]);
    }

    public function editPayment($id){
        $payment = Payment::where('id', $id)->with(['cashs' => function($q){$q->select('id', 'payment_id', 'credit_cash_amount');}, 'cheques' => function($q){$q->select('id', 'payment_id', 'bank_name','bank_date', 'bank_cheque_number', 'credit_bank_amount');}])->first();
        return response()->json([
            'payment' => $payment
        ]);
    }

    protected function updatePaymentCash($request, $payment){
        // CashBook Update Start (Payment)
        $cash_book = CashBook::where('payment_id', $request->id)->first();
        if($cash_book != null){
            $old_credit_amount = $cash_book->credit_cash_amount;
            $next_same_dates = CashBook::where('cash_date', $cash_book->cash_date)->where('id', '>', $cash_book->id)->get();
            foreach ($next_same_dates as $next_same_date){
                $next_same_date->blance += $old_credit_amount;
                $next_same_date->update();
            }
            $next_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
            foreach ($next_dates as $next_date){
                $next_date->blance += $old_credit_amount;
                $next_date->update();
            }
            $cash_book->delete();

        }
        if($request->cash == 1){
            $this->savePaymentCash($request, $payment);
        }


        // CashBook Update End (Payment)
    }
    protected function updatePaymentCheque($request, $payment){
        // BankBook Update Start (Payment)
        $bank_books = BankBook::where('payment_id', $request->id)->get();
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
            $this->savePaymentCheque($request, $payment);
        }
        // BankBook Update End (Payment)
    }
    public function updatePaymentSuplierTransaction($request, $payment){
        // SuplierTransaction Start (Payment)
        $suplier_transaction = SuplierTransaction::where('debit_voucher_id', $payment->id)->first();
        $old_debit_amount = $suplier_transaction->debit_amount;
        $next_same_date_sup_transactions = SuplierTransaction::where('transaction_date', $suplier_transaction->transaction_date)->where('id', '>', $suplier_transaction->id)->get();
        foreach ($next_same_date_sup_transactions as $next_same_date_sup_transaction){
            $next_same_date_sup_transaction->balance -= $old_debit_amount;
            if($next_same_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id){
                $next_same_date_sup_transaction->suplier_balance -= $old_debit_amount;
            }
            $next_same_date_sup_transaction->update();
        }
        $next_date_sup_transactions = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_date_sup_transactions as $next_date_sup_transaction){
            $next_date_sup_transaction->balance -= $old_debit_amount;
            if($next_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id){
                $next_date_sup_transaction->suplier_balance -= $old_debit_amount;
            }
            $next_date_sup_transaction->update();
        }
        $suplier_transaction->delete();
        $this->savePaymentSuplierTransaction($request, $payment);
        // SuplierTransation End (Payment)
    }

    public function updatePayment(Request $request){
        $payment = Payment::where('id', $request->id)->first();
        $this->paymentBasic($request, $payment);
        $payment->update();
        $this->updatePaymentCash($request, $payment);
        $this->updatePaymentCheque($request, $payment);
        $this->updatePaymentSuplierTransaction($request, $payment);
    }
}
