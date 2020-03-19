<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use App\model\Discount;
use App\model\Guest;
use App\model\MoneyReceived;
use App\model\Other;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;
use phpDocumentor\Reflection\Types\Null_;
use Session;

class ReceivedController extends Controller
{
    protected function receivedValidation($request){
        $request->validate([
            'guest' => 'required',
            'staff' => 'required',
            'bill_amount' => 'required',
            // array validation defined in down
            'total_received_amount' =>'required',
            'narration' =>'required',
        ]);
    }

    protected function receivedBasic($received, $request){
        $received->guest = $request->guest;
        $received->staff = $request->staff;
        $received->cash = $request->cash;
        $received->bank = $request->bank;
        $received->cheque = $request->cheque;
        $received->other = $request->other;
        $received->bill_amount = $request->bill_amount;
        $received->total_received_amount = $request->total_received_amount;
        $received->discount = $request->discount;
        $received->due_amount = $request->due_amount;
        $received->narration = $request->narration;
    }

    protected function cashBookFunction($request, $received){
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $received->created_at->format('Y-m-d'))->first();
        if($pre_cash_book == null){
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $received->created_at->format('Y-m-d'))->first();
        }
        $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $received->created_at->format('Y-m-d'))->where('branch_id', $received->location)->first();
        if($pre_branch_cash_book == null){
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $received->created_at->format('Y-m-d'))->where('branch_id', $received->location)->first();
        }
        $cash_book = new CashBook();
        $cash_book->received_id = $received->id;
        $cash_book->branch_id = $received->location;
        $cash_book->cash_date = $received->created_at->format('Y-m-d');
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->cashs[0]['debit_cash_amount'];
        if($pre_cash_book == null ){
            $cash_book->blance = $request->cashs[0]['debit_cash_amount'];
        }else{
            $cash_book->blance = $pre_cash_book->blance + $request->cashs[0]['debit_cash_amount'];
        }
        if($pre_branch_cash_book == null){
            $cash_book->branch_blance = $request->cashs[0]['debit_cash_amount'];
        }else{
            $cash_book->branch_blance = $pre_branch_cash_book->branch_blance + $request->cashs[0]['debit_cash_amount'];
        }
        $cash_book->save();
        $next_dates = CashBook::orderBy('cash_date', 'asc')->where('cash_date', '>', $received->created_at->format('Y-m-d'))->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $cash_book->debit_cash_amount;
            if($next_date->branch_id == $cash_book->branch_id){
                $next_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_date->update();
        }

    }
    protected function bankBookFunction($request, $received){
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
            $bank_book->received_id = $received->id;
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
    protected function chequeBookFunction($request, $received){
            $cheques_arry = $request->cheques;
            $cheques_arry_count = count($cheques_arry);
            for ($i = 0; $i < $cheques_arry_count; $i++){
                $cheque_book = new ChequeBook();
                $cheque_book->received_id = $received->id;
                $cheque_book->cheque_bank_name = $cheques_arry[$i]['cheque_bank_name'];
                $cheque_book->cheque_type = $cheques_arry[$i]['cheque_type'];
                $cheque_book->cheque_number = $cheques_arry[$i]['cheque_number'];
                $cheque_book->cheque_date = $cheques_arry[$i]['cheque_date'];
                $cheque_book->cheque_amount = $cheques_arry[$i]['cheque_amount'];
                $cheque_book->status = 0;
                $cheque_book->location = $received->location;
                $cheque_book->save();
            }

            // Cheque
        }
    protected function othersBookFunction($request, $received){
            $others_arry = $request->others;
            $others_arry_count = count($others_arry);
            for ($i = 0; $i < $others_arry_count; $i++){
                $other = new Other();
                $other->received_id = $received->id;
                $other->others_name = $others_arry[$i]['others_name'];
                $other->others_amount = $others_arry[$i]['others_amount'];
                $other->save();
            }

            // Other
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
        if($request->other == 1) {
            $request->validate([
                'other' => 'required',
                'others.*.others_name' => 'required',
                'others.*.others_amount' => 'required',
            ]);
        }
        if($request->cash != 1 && $request->bank != 1 && $request->cheque != 1 && $request->other != 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }
    }
    protected function saveallbooks($request, $received){
        if($request->cash == 1){
            $this->cashBookFunction($request, $received);
        }
        if($request->bank == 1) {
            $this->bankBookFunction($request, $received);
        }
        if($request->cheque == 1) {
            $this->chequeBookFunction($request, $received);
        }
        if($request->other == 1) {
            $this->othersBookFunction($request, $received);
        }
    }
    protected function saveReceivedTransaction($request, $received){
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $received->created_at->format('Y-m-d'))->where('guest_id', $received->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        if($pre_guest_transjaction_blance == null){
            $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $received->created_at->format('Y-m-d'))->where('guest_id', $received->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        }
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $received->created_at->format('Y-m-d'))->where('staff_id', $request->staff)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if($pre_staff_transjaction_blance == null){
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $received->created_at->format('Y-m-d'))->where('staff_id', $request->staff)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }
        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date',$received->created_at->format('Y-m-d'))->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if($pre_transjaction_blance == null){
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<',$received->created_at->format('Y-m-d'))->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->guest;
        $transjaction->staff_id = $request->staff;
        $transjaction->received_id = $received->id;
        $transjaction->narration = $received->narration;
        $transjaction->transjaction_date = $received->created_at->format('Y-m-d');
        $transjaction->credit_amount = $received->total_received_amount;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->total_received_amount;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->total_received_amount;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->total_received_amount;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->total_received_amount;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->total_received_amount;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->total_received_amount;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $request->total_received_amount;
            if($next_date->guest_id == $request->guest){
                $next_date->guest_blance -= $request->total_received_amount;
            }
            if($next_date->staff_id == $request->staff){
                $next_date->staff_blance -= $request->total_received_amount;
            }
            $next_date->update();
        }
    }

    public function saveRecivedDiscount($request, $received){
        $discount = new Discount();
        $discount->guest_id = $request->guest;
        $discount->staff_id = $request->staff;
        $discount->received_id = $received->id;
        $discount->discount_date = $received->created_at->format('Y-m-d');
        $discount->amount = $request->discount;
        $discount->save();
        // Discount Transaction Start
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('guest_id', $request->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->where('staff_id', $request->guest)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();

        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $discount->discount_date)->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if($pre_transjaction_blance == null){
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<' ,$discount->discount_date)->first();
        }
        $dicount_transjaction = new Transjaction();
        $dicount_transjaction->guest_id = $request->guest;
        $dicount_transjaction->staff_id = $request->staff;
        $dicount_transjaction->discount_id = $discount->id;
        $dicount_transjaction->narration = $received->narration.'(Discount)';
        $dicount_transjaction->transjaction_date = $received->created_at->format('Y-m-d');
        $dicount_transjaction->credit_amount = $request->discount;
        if($pre_guest_transjaction_blance == null){
            $dicount_transjaction->guest_blance = -$request->discount;
        }else{
            $dicount_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->discount;
        }
        if($pre_staff_transjaction_blance == null){
            $dicount_transjaction->staff_blance = -$request->discount;
        }else{
            $dicount_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->discount;
        }
        if($pre_transjaction_blance == null){
            $dicount_transjaction->blance = -$request->discount;
        }else{
            $dicount_transjaction->blance = $pre_transjaction_blance->blance - $request->discount;
        }
        $dicount_transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $discount->discount_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance -= $request->discount;
            if($next_date->guest_id == $request->guest){
                $next_date->guest_blance -= $request->discount;
            }
            if($next_date->staff_id == $request->staff){
                $next_date->staff_blance -= $request->discount;
            }
            $next_date->update();
        }



        // Discount Transaction End
    }

    public function addReceived(Request $request){
        $this->receivedValidation($request);
        $this->allValidation($request);
        $received = new MoneyReceived();
        $received->location = Session::get('location');
        $this->receivedBasic($received, $request);
        $received->save();
        $this->saveallbooks($request, $received);
        $this->saveReceivedTransaction($request, $received);
        // Discount Start
        if($request->discount > 0){
            $this->saveRecivedDiscount($request, $received);
        }
        // Discount End
        return "Success";

    }


    public function getAllReceived(){
        $receiveds = MoneyReceived::with(['guestt' => function($q){$q->select('id', 'name', 'phone_number');}, 'stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'receiveds' => $receiveds
        ]);
    }

    public function editReceived($id){
        $user_type = Session::get('user_type');
        $received = MoneyReceived::with(['cashs', 'banks', 'cheques', 'others', 'guestt' => function($q){$q->select('id', 'name','phone_number');}])->where('id', $id)->first();
        return response()->json([
            'received' => $received,
            'user_type' => $user_type
        ]);
    }
    public function updateCashBook($request, $received){
        $cash_book = CashBook::where('received_id', $received->id)->select('id', 'received_id', 'debit_cash_amount', 'cash_date', 'blance', 'narration', 'branch_id', 'branch_blance')->first();
        if($cash_book != null){
            $old_amount = $cash_book->debit_cash_amount;
            $next_same_date_cashs = CashBook::where('id', '>', $cash_book->id)->select('id', 'received_id', 'debit_cash_amount', 'cash_date', 'blance', 'branch_id', 'branch_blance')->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_date_cashs as $next_same_date_cash){
                $next_same_date_cash->blance -= $old_amount;
                if($next_same_date_cash->branch_id == $cash_book->branch_id){
                    $next_same_date_cash->branch_blance -= $old_amount;
                }
                $next_same_date_cash->update();
            }
            $next_date_cashs = CashBook::where('cash_date', '>', $cash_book->cash_date)->select('id', 'received_id', 'debit_cash_amount', 'cash_date', 'blance','branch_id', 'branch_blance')->get();
            foreach ($next_date_cashs as $next_date_cash){
                $next_date_cash->blance -=$old_amount;
                if($next_date_cash->branch_id == $cash_book->branch_id){
                    $next_date_cash->branch_blance -= $old_amount;
                }
                $next_date_cash->update();
            }
            $cash_book->delete();
        }
        if($request->cash == 1){
            $this->cashBookFunction($request, $received);
        }
    }
    protected function updateBankBook($request, $received){
        $bank_books = BankBook::where('received_id', $received->id)->select('id', 'received_id', 'debit_bank_amount', 'bank_date', 'blance', 'bank_blance', 'bank_name')->get();
        foreach ($bank_books as $bank_book){
            $decrement = $bank_book->debit_bank_amount;
            $next_same_date_banks = BankBook::where('id', '>', $bank_book->id)->select('id', 'received_id', 'debit_bank_amount', 'bank_date', 'blance', 'bank_blance', 'bank_name')->where('bank_date', $bank_book->bank_date)->get();
            foreach ($next_same_date_banks as $next_same_date_bank){
                $next_same_date_bank->blance -= $decrement;
                if($next_same_date_bank->bank_name == $bank_book->bank_name){
                    $next_same_date_bank->bank_blance -= $decrement;
                }
                $next_same_date_bank->update();
            }
            $next_date_banks = BankBook::orderBy('bank_date', 'asc')->where('bank_date', '>', $bank_book->bank_date)->select('id', 'received_id', 'debit_bank_amount', 'bank_date', 'blance', 'bank_blance', 'bank_name')->get();
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
            $this->bankBookFunction($request, $received);
        }
    }
    protected function updateChequeBook($request, $received){
        $cheque_books = ChequeBook::where('received_id', $received->id)->get();
        foreach ($cheque_books as $cheque_book){
            $cheque_book->delete();
        }
        if($request->cheque == 1) {
            $this->chequeBookFunction($request, $received);
        }
    }
    protected function updateOtherBook($request, $received){
        $other_books = Other::where('received_id', $received->id)->get();
        foreach ($other_books as $other_book){
            $other_book->delete();
        }
        if($request->other == 1) {
            $this->othersBookFunction($request, $received);
        }
    }
    protected function updateReceivedTransaction($request, $received){
        $transjaction = Transjaction::where('received_id', $received->id)->select('id', 'guest_id', 'staff_id', 'received_id', 'transjaction_date', 'narration', 'credit_amount', 'blance', 'guest_blance', 'staff_blance')->first();
        $old_amount = $transjaction->credit_amount;
        $next_same_date_transactions = Transjaction::where('id', '>', $transjaction->id)->where('transjaction_date', $transjaction->transjaction_date)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction){
            $next_same_date_transaction->blance += $old_amount;
            if($next_same_date_transaction->guest_id == $transjaction->guest_id){
                $next_same_date_transaction->guest_blance += $old_amount;
            }
            if($next_same_date_transaction->staff_id == $transjaction->staff_id){
                $next_same_date_transaction->staff_blance += $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = Transjaction::where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction){
            $next_date_transaction->blance += $old_amount;
            if($next_date_transaction->guest_id == $transjaction->guest_id){
                $next_date_transaction->guest_blance += $old_amount;
            }
            if($next_date_transaction->staff_id == $transjaction->staff_id){
                $next_date_transaction->staff_blance += $old_amount;
            }
            $next_date_transaction->update();
        }
        $transjaction->delete();
        $this->saveReceivedTransaction($request, $received);
    }
    protected function updateReceivedDiscount($request, $received){
        $discount = Discount::where('received_id', $received->id)->first();
        if ($discount != null){
            $old_amount = $discount->amount;
            $discount_transaction = Transjaction::where('discount_id', $discount->id)->first();
            $next_same_date_discount_trans = Transjaction::where('id', '>', $discount_transaction->id)->where('transjaction_date', $discount_transaction->transjaction_date)->get();
            foreach ($next_same_date_discount_trans as $next_same_date_discount_tran){
                $next_same_date_discount_tran->blance += $old_amount;
                if($next_same_date_discount_tran->guest_id == $discount_transaction->guest_id){
                    $next_same_date_discount_tran->guest_blance += $old_amount;
                }
                if ($next_same_date_discount_tran->staff_id == $discount_transaction->staff_id){
                    $next_same_date_discount_tran->satff_blance += $old_amount;
                }
                $next_same_date_discount_tran->update();
            }
            $next_date_dis_transactions = Transjaction::where('transjaction_date', '>', $discount_transaction->transaction_date)->get();
            foreach ($next_date_dis_transactions as $next_date_dis_transaction){
                $next_date_dis_transaction->blance += $old_amount;
                if($next_date_dis_transaction->guest_id == $discount_transaction->guest_id){
                    $next_date_dis_transaction->guest_blance += $old_amount;
                }
                if ($next_date_dis_transaction->staff_id == $discount_transaction->staff_id){
                    $next_date_dis_transaction->staff_blance += $old_amount;
                }
                $next_date_dis_transaction->update();
            }
            $discount_transaction->delete();
        }
        // Discount Start
        if($request->discount > 0){
            $this->saveRecivedDiscount($request, $received);
        }
        // Discount End
    }

    public function updateReceived(Request $request){
        $this->receivedValidation($request);
        $this->allValidation($request);
        $received = MoneyReceived::where('id', $request->id)->first();
        $this->receivedBasic($received, $request);
        $received->update();
        $this->updateCashBook($request, $received);
        $this->updateBankBook($request, $received);
        $this->updateChequeBook($request, $received);
        $this->updateOtherBook($request, $received);
        $this->updateReceivedTransaction($request, $received);
        $this->updateReceivedDiscount($request, $received);
        return "Success Update";
    }
    public function getGuestLastBalance($id){
        $transaction = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('guest_id', $id)->select('id', 'guest_id', 'guest_blance')->first();
        return response()->json([
            'transaction' => $transaction
        ]);
    }
    public function getAllReceivedSearch($search){
        $receiveds = MoneyReceived::with(['guestt' => function($q){$q->select('id', 'name', 'phone_number');}, 'stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])
            ->where('id', $search)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $receiveds_count = count($receiveds);
        if($receiveds_count == 0){
            $guest_id = [];
            $guests = Guest::where('name', 'like', $search.'%')->orWhere('phone_number', 'like', $search.'%')->select('id', 'name', 'phone_number')->get();
            foreach ($guests as $key => $guest){
                $guest_id[$key] = $guest->id;
            }
            $receiveds = MoneyReceived::with(['guestt' => function($q){$q->select('id', 'name', 'phone_number');}, 'stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])
                ->whereIn('guest', $guest_id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        return response()->json([
            'receiveds' => $receiveds
        ]);
    }


}
