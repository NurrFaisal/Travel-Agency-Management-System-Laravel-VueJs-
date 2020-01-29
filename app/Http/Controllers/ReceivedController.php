<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use App\model\Discount;
use App\model\MoneyReceived;
use App\model\Other;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use Illuminate\Http\Request;
use mysql_xdevapi\Collection;
use phpDocumentor\Reflection\Types\Null_;

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
        $cash_book = new CashBook();
        $cash_book->received_id = $received->id;
        $cash_book->cash_date = $received->created_at->format('Y-m-d');
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->cashs[0]['debit_cash_amount'];
        if($pre_cash_book == null ){
            $cash_book->blance = $request->cashs[0]['debit_cash_amount'];
        }else{
            $cash_book->blance = $pre_cash_book->blance + $request->cashs[0]['debit_cash_amount'];
        }
        $cash_book->save();
        $next_dates = CashBook::orderBy('cash_date', 'asc')->where('cash_date', '>', $received->created_at->format('Y-m-d'))->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $cash_book->debit_cash_amount;
            $next_date->update();
        }

    }
    protected function bankBookFunction($request, $received){
        $banks_arry = $request->banks;
        $banks_arry_count = count($banks_arry);
        for ($i = 0; $i < $banks_arry_count; $i++){
            $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_name',  $banks_arry[$i]['bank_name'] )->first();
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
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('guest_id', $request->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->where('staff_id', $request->guest)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();

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

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $received->created_at->format('Y-m-d'))->get();
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
        $discount->money_receipt_id = $received->id;
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
        $receiveds = MoneyReceived::with(['guestt' => function($q){$q->select('id', 'name');}, 'stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'receiveds' => $receiveds
        ]);
    }

    public function editReceived($id){
        $received = MoneyReceived::with(['cashs', 'banks', 'cheques', 'others', 'guestt' => function($q){$q->select('id', 'name','phone_number');}])->where('id', $id)->first();
        return response()->json([
            'received' => $received
        ]);
    }

    public function updateReceived(Request $request){
        $this->receivedValidation($request);
        if($request->cash == 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }elseif($request->bank == 1) {
            $request->validate([
                'bank' => 'required',
                'banks.*.bank_name' => 'required|numeric',
                'banks.*.bank_date' => 'required|date',
                'banks.*.debit_bank_amount' => 'required|numeric',
            ]);
        }elseif($request->cheque == 1) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.cheque_bank_name' => 'required',
                'cheques.*.cheque_type' => 'required|numeric',
                'cheques.*.cheque_number' => 'required|numeric',
                'cheques.*.cheque_amount' => 'required|numeric',
                'cheques.*.cheque_date' => 'required',
            ]);
        }elseif($request->other == 1) {
            $request->validate([
                'other' => 'required',
                'others.*.others_name' => 'required',
                'others.*.others_amount' => 'required',
            ]);
        }else{
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }
        $received = MoneyReceived::where('id', $request->id)->first();
        $this->receivedBasic($received, $request);

       // Cash Book Start
       $cash_book = CashBook::where('received_id', $received->id)->first();
       $increment_balance = $request->cashs[0]['debit_cash_amount'] - $cash_book->debit_cash_amount;
       $cash_book->narration = $request->narration;
       $cash_book->debit_cash_amount = $request->cashs[0]['debit_cash_amount'];
       $cash_book->blance = $cash_book->blance + $increment_balance;
       $cash_book->update();
       $cash_book_blances = CashBook::where('id', '>', $cash_book->id)->get();
       foreach ($cash_book_blances as $cash_book_blance){
           $cash_book_blance->blance += $increment_balance;
           $cash_book_blance->update();
       }
       // Cash Book End
        // Bank Book Start
       $bank_books = BankBook::where('received_id', $request->id)->get();
       foreach ($bank_books as $bank_book){
           $next_bank_books = BankBook::where('id', '>', $bank_book->id)->get();
           foreach ($next_bank_books as $next_bank_book){
               $next_bank_book->blance -= $bank_book->debit_bank_amount;
               if($next_bank_book->bank_name == $bank_book->bank_name){
                   $next_bank_book->bank_blance -= $bank_book->debit_bank_amount;
               }
               $next_bank_book->update();
           }
           $bank_book->delete();
       }
        $this->bankBookFunction($request, $received);

       // Bank Book End

        // Cheque Book Start
       $cheque_books = ChequeBook::where('received_id', $request->id)->get();
        foreach ($cheque_books as $cheque_book){
            $cheque_book->delete();
        }
        $this->chequeBookFunction($request, $received);

        // Cheque Book End

        // Others Book Start
       $others = Other::where('received_id', $request->id)->get();
       foreach ($others as $other){
           $other->delete();
       }
        $this->othersBookFunction($request, $received);
       // Others Book End
        $received->update();


        // Transaction Update Start
        $this->updateTransjactionBlance($request);
        $this->updateTransactionDiscount($request);
        // Transaction Update End
        $discount = Discount::where('money_receipt_id', $received->id)->first();
        if($discount != null){
            if($request->discount > 0){
                $discount->delete();
                $new_discount = new Discount();
                $new_discount->guest_id = $request->guest;
                $new_discount->staff_id = $request->staff;
                $new_discount->money_receipt_id = $received->id;
                $new_discount->discount_date = $received->created_at->format('Y-m-d');
                $new_discount->amount = $request->discount;
                $new_discount->save();
            }else{
                $discount->amount = 0;
                $discount->update();
            }
        }

    }
    public function updateTransjactionBlance($request){
        $transjaction = Transjaction::where('received_id', $request->id)->first();
        $decrement_blance = $request->total_received_amount - $transjaction->credit_amount;
        $old_transjaction_credit = $transjaction->credit_amount;
        $old_staff_id = $transjaction->staff_id;
        $old_guest_id = $transjaction->guest_id;


        $transjaction->guest_id = $request->guest;
        $transjaction->narration = $request->narration;
        $transjaction->credit_amount = $request->total_received_amount;
        $transjaction->blance = $transjaction->blance - $decrement_blance;
        $blance_transjactions = Transjaction::where('id', '>', $transjaction->id)->get();
        foreach ($blance_transjactions as $blance_transjaction){
            $blance_transjaction->blance = $blance_transjaction->blance - $decrement_blance;
            $blance_transjaction->update();
        }
        $transjaction->staff_blance = $transjaction->staff_blance - $decrement_blance;
        $staff_blance_tranjactions = Transjaction::where('id', '>', $transjaction->id)->where('staff_id', $transjaction->staff_id)->get();
        foreach ($staff_blance_tranjactions as $staff_blance_tranjaction){
            $staff_blance_tranjaction->staff_blance = $staff_blance_tranjaction->staff_blance - $decrement_blance;
            $staff_blance_tranjaction->update();
        }

        if($old_guest_id == $request->guest){
            $transjaction->guest_blance = $transjaction->guest_blance - $decrement_blance;
            $transjaction->update();
            $guest_blances = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($guest_blances as $guest_blance){
                $guest_blance->guest_blance = $guest_blance->guest_blance - $decrement_blance;
                $guest_blance->update();
            }
        }else{
            $pre_guest_transjaction = Transjaction::where('id', '<', $transjaction->id)->where('guest_id', $request->guest)->orderBy('id', 'desc')->first();
            if($pre_guest_transjaction){
                $transjaction->guest_blance = $pre_guest_transjaction->guest_blance - $request->total_received_amount;
            }else{
                $transjaction->guest_blance = $request->total_received_amount;
            }
            $transjaction->update();
            $next_old_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($next_old_guest_transjactions as $next_old_guest_transjaction){
                $next_old_guest_transjaction->guest_blance = $next_old_guest_transjaction->guest_blance + $old_transjaction_credit;
                $next_old_guest_transjaction->update();
            }
            $next_new_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $request->guest)->get();
            foreach ($next_new_guest_transjactions as $next_new_guest_transjaction){
                $next_new_guest_transjaction->guest_blance = $next_new_guest_transjaction->guest_blance - $request->total_received_amount;
                $next_new_guest_transjaction->update();
            }
        }
    }

    protected  function updateTransactionDiscount($request){
        if($request->discount == ''){
            $discount = 0;
        }else{
            $discount = $request->discount;
        }

        $transjaction = Transjaction::where('discount_id', $request->id)->first();
        if($transjaction !=null){
            $decrement_blance = $discount - $transjaction->credit_amount;
            $old_transjaction_credit = $transjaction->credit_amount;
            $old_staff_id = $transjaction->staff_id;
            $old_guest_id = $transjaction->guest_id;
        }
        $transjaction->guest_id = $request->guest;
        $transjaction->narration = $request->narration;
        $transjaction->credit_amount = $discount;
        $transjaction->blance = $transjaction->blance - $decrement_blance;
        $blance_transjactions = Transjaction::where('id', '>', $transjaction->id)->get();
        foreach ($blance_transjactions as $blance_transjaction){
            $blance_transjaction->blance = $blance_transjaction->blance - $decrement_blance;
            $blance_transjaction->update();
        }
        $transjaction->staff_blance = $transjaction->staff_blance - $decrement_blance;
        $staff_blance_tranjactions = Transjaction::where('id', '>', $transjaction->id)->where('staff_id', $transjaction->staff_id)->get();
        foreach ($staff_blance_tranjactions as $staff_blance_tranjaction){
            $staff_blance_tranjaction->staff_blance = $staff_blance_tranjaction->staff_blance - $decrement_blance;
            $staff_blance_tranjaction->update();
        }

        if($old_guest_id == $request->guest){
            $transjaction->guest_blance = $transjaction->guest_blance - $decrement_blance;
            $transjaction->update();
            $guest_blances = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($guest_blances as $guest_blance){
                $guest_blance->guest_blance = $guest_blance->guest_blance - $decrement_blance;
                $guest_blance->update();
            }
        }else{
            $pre_guest_transjaction = Transjaction::where('id', '<', $transjaction->id)->where('guest_id', $request->guest)->orderBy('id', 'desc')->first();
            if($pre_guest_transjaction){
                $transjaction->guest_blance = $pre_guest_transjaction->guest_blance - $discount;
            }else{
                $transjaction->guest_blance = $discount;
            }
            $transjaction->update();
            $next_old_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($next_old_guest_transjactions as $next_old_guest_transjaction){
                $next_old_guest_transjaction->guest_blance = $next_old_guest_transjaction->guest_blance + $old_transjaction_credit;
                $next_old_guest_transjaction->update();
            }
            $next_new_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $request->guest)->get();
            foreach ($next_new_guest_transjactions as $next_new_guest_transjaction){
                $next_new_guest_transjaction->guest_blance = $next_new_guest_transjaction->guest_blance - $discount;
                $next_new_guest_transjaction->update();
            }
        }
    }



    public function getGuestLastBalance($id){
        $transaction = Transjaction::orderBy('id', 'desc')->where('guest_id', $id)->select('id', 'guest_id', 'guest_blance')->first();
        return response()->json([
            'transaction' => $transaction
        ]);
    }


}
