<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Incentive;
use App\model\Staff;
use Illuminate\Http\Request;

class IncentiveController extends Controller
{
    public function getIncentiveStaff(){
        $staffs = Staff::orderBy('first_name')->select('id', 'first_name', 'last_name')->get();
        return response()->json([
            'staffs' => $staffs
        ]);

    }
    protected function incentiveValidation($request){
        $request->validate([
            'incentive_date' => 'required',
            'staff' => 'required',
            'cash' => 'required',
            'cheque' => 'required',
            'total_incentive_amount' => 'required',
            'narration' => 'required',
            'received_by' => 'required',
            'paid_by' => 'required',
            'approved_by' => 'required',
        ]);
    }
    protected function incentiveBasic($incentive, $request){
        $incentive->incentive_date = $request->incentive_date;
        $incentive->staff = $request->staff;
        $incentive->cash = $request->cash;
        $incentive->cheque = $request->cheque;
        $incentive->total_incentive_amount = $request->total_incentive_amount;
        $incentive->narration = $request->narration;
        $incentive->received_by = $request->received_by;
        $incentive->paid_by = $request->paid_by;
        $incentive->approved_by = $request->approved_by;
    }
    public function incentiveCash($incentive, $request){
        if($request->cash == true){
            $request->validate([
                'cash' => 'required',
                'cashs.*.credit_cash_amount' => 'required'
            ]);
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $cash_book = new CashBook();
            $cash_book->incentive_id = $incentive->id;
            $cash_book->cash_date = $incentive->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            if($pre_cash_book == null ){
                $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
            }else{
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
            }
            $cash_book->save();
        }
    }
    public function incentiveCheque($incentive, $request){
        if($request->cheque == true){
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
                $bank_book->incentive_id = $incentive->id;
                $bank_book->narration = $incentive->narration;
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
    public function addIncentive(Request $request){
        $this->incentiveValidation($request);
        $incentive = new Incentive();
        $this->incentiveBasic($incentive, $request);
        $incentive->save();
        $this->incentiveCash($incentive, $request);
        $this->incentiveCheque($incentive, $request);
    }
    public function getAllIncentive(){
        $incentives = Incentive::with(['stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'incentives' => $incentives
        ]);
    }
    public function editIncentive($id){
        $incentive = Incentive::where('id', $id)->with(['cashs' => function($q){$q->select('id', 'incentive_id', 'credit_cash_amount');}, 'cheques' => function($q){$q->select('id', 'incentive_id', 'bank_name','bank_date', 'bank_cheque_number', 'credit_bank_amount');}])->first();
        return response()->json([
            'incentive' => $incentive
        ]);
    }

    protected function updateCash($request, $incentive){
        $cash_book = CashBook::where('incentive_id', $request->id)->first();
        if($cash_book != null){
            $next_cash_books = CashBook::where('id', '>', $cash_book->id)->get();
            foreach ($next_cash_books as $next_cash_book){
                if($cash_book->credit_cash_amount > 0){
                    $next_cash_book->blance += $cash_book->credit_cash_amount;
                }
                $next_cash_book->update();
            }
            $cash_book->delete();
        }
    }

    protected function updateCheque($request){
        $bank_books = BankBook::where('incentive_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $next_bank_books = BankBook::where('id', '>', $bank_book->id)->get();
            foreach ($next_bank_books as $next_bank_book){
                if($bank_book->credit_bank_amount > 0){
                    $next_bank_book->blance += $bank_book->credit_bank_amount;
                    if($next_bank_book->bank_name == $bank_book->bank_name){
                        $next_bank_book->bank_blance += $bank_book->credit_bank_amount;
                    }
                }
                $next_bank_book->update();
            }
            $bank_book->delete();
        }
    }
    public function updateIncentive(Request $request){
        $this->incentiveValidation($request);
        $incentive = Incentive::where('id', $request->id)->first();
        $this->incentiveBasic($incentive, $request);
        $incentive->update();
        $this->updateCash($request, $incentive);
        $this->updateCheque($request);
        $this->incentiveCash($incentive, $request);
        $this->incentiveCheque($incentive, $request);
    }
}
