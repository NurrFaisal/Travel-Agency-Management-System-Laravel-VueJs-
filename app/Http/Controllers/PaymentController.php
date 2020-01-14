<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Payment;
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

        $cash_books = CashBook::where('payment_id', $request->id)->get();
        foreach ($cash_books as $cash_book){
            $cash_book->payment_id = null;
            $cash_book->narration = 'update to debit (1st)';
            $cash_book->update();
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $update_cash_book = new CashBook();
            $update_cash_book->cash_date = $payment->created_at->format('Y-m-d');
            $update_cash_book->narration = $cash_book->id.' '. 'Update to debit (2nd)';
            $update_cash_book->debit_cash_amount = $cash_book->credit_cash_amount;
            $update_cash_book->blance = $pre_cash_book->blance + $cash_book->credit_cash_amount;
            $update_cash_book->save();
        }
        $bank_books = BankBook::where('payment_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $bank_book->payment_id = null;
            $bank_book->narration = 'Update to debit (1st)';
            $bank_book->update();
            $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $bank_book->bank_name)->first();
            $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
            $update_bank_book = new BankBook();
            $update_bank_book->bank_name = $bank_book->bank_name;
            $update_bank_book->bank_date = $bank_book->bank_date;
            $update_bank_book->bank_cheque_number = $bank_book->bank_cheque_number;
            $update_bank_book->narration = $bank_book->id.' '.'Udate to debit (2nd)';
            $update_bank_book->debit_bank_amount = $bank_book->credit_bank_amount;
            $update_bank_book->blance = $pre_bank_book->blance + $bank_book->credit_bank_amount;
            $update_bank_book->bank_blance = $bank_blance->bank_blance + $bank_book->credit_bank_amount;
            $update_bank_book->save();
        }
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
                $bank_book->blance = $pre_bank_book->blance - $cheques_arry[$i]['credit_bank_amount'];
                $bank_book->bank_blance = $bank_blance->bank_blance - $cheques_arry[$i]['credit_bank_amount'];
                $bank_book->save();
            }

        }

    }
}
