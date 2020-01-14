<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use App\model\MoneyReceived;
use App\model\Other;
use App\model\Transjaction;
use Illuminate\Http\Request;
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
            'due_amount' =>'required',
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
        $received->due_amount = $request->due_amount;
        $received->narration = $request->narration;
    }

    protected function cashBookFunction($request, $received){
        if($request->cash == 1){
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
            // cash
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('debit_cash_amount', 'blance')->first();
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
        }
    }
    protected function bankBookFunction($request, $received){
        if($request->bank == 1){
            $request->validate([
                'bank' => 'required',
                'banks.*.bank_name' => 'required|numeric',
                'banks.*.bank_date' => 'required|date',
                'banks.*.debit_bank_amount' => 'required|numeric',
            ]);
            $banks_arry = $request->banks;
            $banks_arry_count = count($banks_arry);
            for ($i = 0; $i < $banks_arry_count; $i++){
                $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $banks_arry[$i]['bank_name'])->first();
                $pre_bank_book = BankBook::orderBy('id', 'desc')->select('debit_bank_amount', 'blance')->first();
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
            }

            // Bank
        }
    }
    protected function chequeBookFunction($request, $received){
        if($request->cheque == 1){
            $request->validate([
                'cheque' => 'required',
                'cheques.*.cheque_bank_name' => 'required',
                'cheques.*.cheque_type' => 'required|numeric',
                'cheques.*.cheque_number' => 'required|numeric',
                'cheques.*.cheque_amount' => 'required|numeric',
                'cheques.*.cheque_date' => 'required',
            ]);
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
    }
    protected function othersBookFunction($request, $received){
        if($request->other == 1){
            $request->validate([
                'other' => 'required',
                'others.*.others_name' => 'required',
                'others.*.others_amount' => 'required',
            ]);
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
    }
    public function addReceived(Request $request){
        $this->receivedValidation($request);
        $received = new MoneyReceived();
        $this->receivedBasic($received, $request);
        $received->save();
        $this->cashBookFunction($request, $received);
        $this->bankBookFunction($request, $received);
        $this->chequeBookFunction($request, $received);
        $this->othersBookFunction($request, $received);

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->guest)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->staff)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->guest;
        $transjaction->staff_id = $request->staff;
        $transjaction->received_id = $received->id;
        $transjaction->narration = $received->narration;
        $transjaction->transjaction_date = $received->created_at->format('Y-m-d');
        $transjaction->debit_amount = $received->total_received_amount;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = $request->total_received_amount;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $request->total_received_amount;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = $request->total_received_amount;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $request->total_received_amount;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = $request->total_received_amount;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance + $request->total_received_amount;
        }
        $transjaction->save();

    }


    public function getAllReceived(){
        $receiveds = MoneyReceived::with(['guestt' => function($q){$q->select('id', 'name');}, 'stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'receiveds' => $receiveds
        ]);
    }

    public function editReceived($id){
        $received = MoneyReceived::with('cashs', 'banks', 'cheques', 'others')->where('id', $id)->first();
        return response()->json([
            'received' => $received
        ]);
    }

    public function updateReceived(Request $request){
        $this->receivedValidation($request);
       $received = MoneyReceived::where('id', $request->id)->first();
       $this->receivedBasic($received, $request);
       $cash_books = CashBook::where('received_id', $received->id)->get();
       $bank_books = BankBook::where('received_id', $request->id)->get();
       $cheque_books = ChequeBook::where('received_id', $request->id)->get();
       $others = Other::where('received_id', $request->id)->get();
       foreach ($cash_books as $cash_book){
           $cash_book->received_id = null;
           $cash_book->narration = 'update to Money Received credit (1st)';
           $cash_book->update();
           $pre_cash_book = CashBook::orderBy('id', 'desc')->select('debit_cash_amount', 'blance')->first();
           $update_cash_book = new CashBook();
           $update_cash_book->cash_date = $received->created_at->format('Y-m-d');
           $update_cash_book->narration = $cash_book->id.' '. 'Update to Money Received credit (2nd)';
           $update_cash_book->credit_cash_amount = $cash_book->debit_cash_amount;
           $update_cash_book->blance = $pre_cash_book->blance - $cash_book->debit_cash_amount;
           $update_cash_book->save();
       }
       foreach ($bank_books as $bank_book){
           $bank_book->received_id = null;
           $bank_book->narration = 'Update to credit (1st)';
           $bank_book->update();
           $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $bank_book->bank_name)->first();
           $pre_bank_book = BankBook::orderBy('id', 'desc')->select('debit_bank_amount', 'blance')->first();
           $update_bank_book = new BankBook();
           $update_bank_book->bank_name = $bank_book->bank_name;
           $update_bank_book->bank_date = $bank_book->bank_date;
           $update_bank_book->narration = $bank_book->id.' '.'Udate to credit (2nd)';
           $update_bank_book->credit_bank_amount = $bank_book->debit_bank_amount;
           $update_bank_book->blance = $pre_bank_book->blance - $bank_book->debit_bank_amount;
           $update_bank_book->bank_blance = $bank_blance->bank_blance - $bank_book->debit_bank_amount;
           $update_bank_book->save();
       }
       foreach ($cheque_books as $cheque_book){
           $cheque_book->delete();
       }
       foreach ($others as $other){
           $other->delete();
       }
        $this->cashBookFunction($request, $received);
        $this->bankBookFunction($request, $received);
        $this->chequeBookFunction($request, $received);
        $this->othersBookFunction($request, $received);
        $received->update();

        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('received_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Monery Received Transjaction 1st ( M-'.$update_first_transjaction->received_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->guest)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->staff)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->received_id = $update_first_transjaction->received_id;
        $update_scond_transjaction->narration = 'Updated Money Received Transjaction 2nd ( M-'.$update_first_transjaction->received_id.' )';
        $update_scond_transjaction->transjaction_date = $received->updated_at->format('Y-m-d');
        $update_scond_transjaction->credit_amount = $update_first_transjaction->debit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $update_first_transjaction->debit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $update_first_transjaction->debit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance - $update_first_transjaction->debit_amount;
        $update_scond_transjaction->save();


        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->guest)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->staff)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->guest;
        $transjaction->staff_id = $request->staff;
        $transjaction->received_id = $received->id;
        $transjaction->narration = $received->narration;
        $transjaction->transjaction_date = $received->created_at->format('Y-m-d');
        $transjaction->debit_amount = $received->total_received_amount;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = $request->total_received_amount;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $request->total_received_amount;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = $request->total_received_amount;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $request->total_received_amount;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = $request->total_received_amount;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance + $request->total_received_amount;
        }
        $transjaction->save();

    }
}
