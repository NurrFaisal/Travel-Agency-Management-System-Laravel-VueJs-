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
            'total_payment_amount' => 'required',
            'narration' => 'required',
            'received_by' => 'required',
            'paid_by' => 'required',
            'approved_by' => 'required',
        ]);
    }
    public function addPayment(Request $request){
        $payment = new Payment();
        $payment->debit_voucher_date = $request->debit_voucher_date;
        $payment->suplier = $request->suplier;
        $payment->cash = $request->cash;
        $payment->cheque = $request->cheque;
        $payment->total_payment_amount = $request->total_payment_amount;
        $payment->narration = $request->narration;
        $payment->received_by = $request->received_by;
        $payment->paid_by = $request->paid_by;
        $payment->approved_by = $request->approved_by;
        $payment->save();

        if($request->cash == 1){
            $request->validate([
                'cash' => 'required',
                'cashs.*.credit_cash_amount' => 'required'
            ]);
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $cash_book = new CashBook();
            $cash_book->payment_id = $payment->id;
            $cash_book->cash_date = $payment->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            if($pre_cash_book == null ){
                $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
            }else{
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
            }
            $cash_book->save();
        }
        if($request->cheque == 1){
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
                $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
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
            }

        }



        // SuplierTransaction Start
        $pre_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->first();
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->where('suplier_id', $payment->suplier)->first();

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
        // SuplierTransaction End





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

    public function updatePayment(Request $request){
        $payment = Payment::where('id', $request->id)->first();
        $payment->debit_voucher_date = $request->debit_voucher_date;
        $payment->suplier = $request->suplier;
        $payment->cash = $request->cash;
        $payment->cheque = $request->cheque;
        $payment->total_payment_amount = $request->total_payment_amount;
        $payment->narration = $request->narration;
        $payment->received_by = $request->received_by;
        $payment->paid_by = $request->paid_by;
        $payment->approved_by = $request->approved_by;
        $payment->update();

        // CashBook Update Start (Payment)
        $cash_book = CashBook::where('payment_id', $request->id)->first();
        if($cash_book != null){
            $decrement_blance = $request->cashs[0]['credit_cash_amount'] - $cash_book->credit_cash_amount;
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            $cash_book->blance = $cash_book->blance - $decrement_blance;
            $cash_book->update();
            $cash_book_blances = CashBook::where('id', '>', $cash_book->id)->get();
            foreach ($cash_book_blances as $cash_book_blance){
                $cash_book_blance->blance -= $decrement_blance;
                $cash_book_blance->update();
            }
        }else{
            if($request->cash == 1){
                $request->validate([
                    'cash' => 'required',
                    'cashs.*.credit_cash_amount' => 'required'
                ]);
                $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
                $cash_book = new CashBook();
                $cash_book->payment_id = $payment->id;
                $cash_book->cash_date = $payment->created_at->format('Y-m-d');
                $cash_book->narration = $request->narration;
                $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
                $cash_book->save();
            }
        }

        // CashBook Update End (Payment)

        // BankBook Update Start (Payment)
        $bank_books = BankBook::where('payment_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $next_bank_books = BankBook::where('id', '>', $bank_book->id)->get();
            foreach ($next_bank_books as $next_bank_book){
                $next_bank_book->blance += $bank_book->credit_bank_amount;
                if($next_bank_book->bank_name == $bank_book->bank_name){
                    $next_bank_book->bank_blance += $bank_book->credit_bank_amount;
                }
                $next_bank_book->update();
            }
            $bank_book->delete();
        }


        if($request->cheque == 1){
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
                $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
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
            }

        }
        // BankBook Update End (Payment)

        // SuplierTransaction Start (Payment)
        $suplier_transaction = SuplierTransaction::where('debit_voucher_id', $payment->id)->first();
        $old_debit_amount = $suplier_transaction->debit_amount;
        $incredment_blance = $payment->total_payment_amount - $old_debit_amount;
        $suplier_transaction->transaction_date = $payment->debit_voucher_date;
        $suplier_transaction->narration = $payment->narration;
        $suplier_transaction->debit_amount = $payment->total_payment_amount;
        $suplier_transaction->balance += $incredment_blance;
        $suplier_transaction->suplier_balance += $incredment_blance;
        $suplier_transaction->update();

        $next_suplier_transactions = SuplierTransaction::where('id', '>', $suplier_transaction->id)->get();
        foreach ($next_suplier_transactions as $next_suplier_transaction){
            $next_suplier_transaction->balance += $incredment_blance;
            if($suplier_transaction->suplier_id == $next_suplier_transaction->suplier_id){
                $next_suplier_transaction->suplier_balance += $incredment_blance;
            }
            $next_suplier_transaction->update();
        }
        // SuplierTransation End (Payment)


    }
}
