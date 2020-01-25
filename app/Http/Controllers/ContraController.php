<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Contra;
use Illuminate\Http\Request;

class ContraController extends Controller
{
    public function addContra(Request $request){
        $request->validate([
            'contra_type' => 'required',
            'contra_date' => 'required',
            'contra_amount' => 'required',
            'narration' => 'required',
        ]);
        $contra = new Contra();
        $contra->contra_type = $request->contra_type;
        $contra->contra_date = $request->contra_date;
        $contra->contra_amount = $request->contra_amount;
        $contra->narration = $request->narration;
        if($request->contra_type == 1){
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->save();
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('blance')->first();
            $cash_book = new CashBook();
            $cash_book->contra_id = $contra->id;
            $cash_book->cash_date = $contra->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->contra_amount;
            if($pre_cash_book != null){
                $cash_book->blance = $pre_cash_book->blance - $request->contra_amount;
            }else{
                $cash_book->blance = -$request->contra_amount;
            }
            $cash_book->save();

            $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $request->bank_name)->first();
            $pre_bank_book = BankBook::orderBy('id', 'desc')->select('blance')->first();
            $bank_book = new BankBook();
            $bank_book->contra_id = $contra->id;
            $bank_book->bank_date = $request->contra_date;
            $bank_book->bank_name = $request->bank_name;
            $bank_book->narration = $request->narration;
            $bank_book->debit_bank_amount = $request->contra_amount;
            if($pre_bank_book != null){
                $bank_book->blance = $pre_bank_book->blance + $request->contra_amount;
            }else{
                $bank_book->blance = $request->contra_amount;
            }

            if($bank_blance == null){
                $bank_book->bank_blance = $request->contra_amount;
            }else{
                $bank_book->bank_blance = $bank_blance->bank_blance + $request->contra_amount;
            }
            $bank_book->save();

        }
        if($request->contra_type == 2){
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->save();

            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('blance')->first();
            $cash_book = new CashBook();
            $cash_book->contra_id = $contra->id;
            $cash_book->cash_date = $contra->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->debit_cash_amount = $request->contra_amount;
            if($pre_cash_book == null){
                $cash_book->blance = $request->contra_amount;
            }else{
                $cash_book->blance = $pre_cash_book->blance +$request->contra_amount;
            }
            $cash_book->save();

            $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $request->bank_name)->first();
            $pre_bank_book = BankBook::orderBy('id', 'desc')->select('blance')->first();
            $bank_book = new BankBook();
            $bank_book->contra_id = $contra->id;
            $bank_book->bank_date = $request->contra_date;
            $bank_book->bank_name = $request->bank_name;
            $bank_book->narration = $request->narration;
            $bank_book->credit_bank_amount = $request->contra_amount;
            if($pre_bank_book == null){
                $bank_book->blance = -$request->contra_amount;
            }else{
                $bank_book->blance = $pre_bank_book->blance - $request->contra_amount;
            }
            if($bank_blance == null){
                $bank_book->bank_blance = -$request->contra_amount;
            }else{
                $bank_book->bank_blance = $bank_blance->bank_blance - $request->contra_amount;
            }

            $bank_book->save();
        }
        if($request->contra_type == 3){
            $request->validate([
                'to_bank_name' => 'required',
                'from_bank_name' => 'required'
            ]);
            $contra->to_bank_name = $request->to_bank_name;
            $contra->from_bank_name = $request->from_bank_name;
            $contra->save();

            $from_bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $request->from_bank_name)->first();
            $from_pre_bank_book = BankBook::orderBy('id', 'desc')->select('blance')->first();
            $from_bank_book = new BankBook();
            $from_bank_book->contra_id = $contra->id;
            $from_bank_book->bank_date = $request->contra_date;
            $from_bank_book->bank_name = $request->from_bank_name;
            $from_bank_book->narration = $request->narration;
            $from_bank_book->credit_bank_amount = $request->contra_amount;
            if($from_pre_bank_book == null){
                $from_bank_book->blance = -$request->contra_amount;
            }else{
                $from_bank_book->blance = $from_pre_bank_book->blance - $request->contra_amount;
            }
            if($from_bank_blance == null){
                $from_bank_book->bank_blance = -$request->contra_amount;
            }else{
                $from_bank_book->bank_blance = $from_bank_blance->bank_blance - $request->contra_amount;
            }
            $from_bank_book->save();


            $to_bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $request->to_bank_name)->first();
            $to_pre_bank_book = BankBook::orderBy('id', 'desc')->select('blance')->first();
            $to_bank_book = new BankBook();
            $to_bank_book->contra_id = $contra->id;
            $to_bank_book->bank_date = $request->contra_date;
            $to_bank_book->bank_name = $request->to_bank_name;
            $to_bank_book->narration = $request->narration;
            $to_bank_book->debit_bank_amount = $request->contra_amount;
            if($to_pre_bank_book == null){
                $to_bank_book->blance = $request->contra_amount;
            }else{
                $to_bank_book->blance = $to_pre_bank_book->blance + $request->contra_amount;
            }
            if($to_bank_blance == null){
                $to_bank_book->bank_blance = $request->contra_amount;
            }else{
                $to_bank_book->bank_blance = $to_bank_blance->bank_blance + $request->contra_amount;
            }
            $to_bank_book->save();
         }

    }

    public function getAllContra(){
        $contras = Contra::with('bank', 'from_bank', 'to_bank')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'contras' => $contras
        ]);
    }
    public function editContra($id){
        $contra = Contra::where('id', $id)->first();
        return response()->json([
            'contra' => $contra
        ]);
    }



    public function updateContra(Request $request){
        $request->validate([
            'id' => 'required',
            'contra_type' => 'required',
            'contra_date' => 'required',
            'contra_amount' => 'required',
            'narration' => 'required',
        ]);
        $contra = Contra::where('id', $request->id)->first();
        $contra->contra_type = $request->contra_type;
        $contra->contra_date = $request->contra_date;
        $contra->contra_amount = $request->contra_amount;
        $contra->narration = $request->narration;
        $contra->update();

        // Contra CashBook Update Start
        $cash_book = CashBook::where('contra_id', $contra->id)->first();
        if($cash_book != null){
            $next_cash_books = CashBook::where('id', '>', $cash_book->id)->get();
            foreach ($next_cash_books as $next_cash_book){
                if($cash_book->debit_cash_amount > 0){
                    $next_cash_book->blance -= $cash_book->debit_cash_amount;
                }
                if($cash_book->credit_cash_amount > 0){
                    $next_cash_book->blance += $cash_book->credit_cash_amount;
                }
                $next_cash_book->update();
            }
            $cash_book->delete();
        }
        // Contra CashBook Update End

        // Contra BankBook Update Start
        $bank_books = BankBook::where('contra_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $next_bank_books = BankBook::where('id', '>', $bank_book->id)->get();
            foreach ($next_bank_books as $next_bank_book){
                if($bank_book->debit_bank_amount > 0){
                    $next_bank_book->blance -= $bank_book->debit_bank_amount;
                    if($next_bank_book->bank_name == $bank_book->bank_name){
                        $next_bank_book->bank_blance -= $bank_book->debit_bank_amount;
                    }
                }
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
        // Contra BankBook Update End
        if($request->contra_type == 1){
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->update();

            $cash_book = new CashBook();
            $cash_book->contra_id = $contra->id;
            $cash_book->cash_date = $contra->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->contra_amount;
            $cash_book->save();

            $bank_book = new BankBook();
            $bank_book->contra_id = $contra->id;
            $bank_book->bank_date = $request->contra_date;
            $bank_book->bank_name = $request->bank_name;
            $bank_book->narration = $request->narration;
            $bank_book->debit_bank_amount = $request->contra_amount;
            $bank_book->save();

        }
        if($request->contra_type == 2){
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->update();

            $cash_book = new CashBook();
            $cash_book->contra_id = $contra->id;
            $cash_book->cash_date = $contra->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->debit_cash_amount = $request->contra_amount;
            $cash_book->save();

            $bank_book = new BankBook();
            $bank_book->contra_id = $contra->id;
            $bank_book->bank_date = $request->contra_date;
            $bank_book->bank_name = $request->bank_name;
            $bank_book->narration = $request->narration;
            $bank_book->credit_bank_amount = $request->contra_amount;
            $bank_book->save();
        }
        if($request->contra_type == 3){
            $request->validate([
                'to_bank_name' => 'required',
                'from_bank_name' => 'required'
            ]);
            $contra->to_bank_name = $request->to_bank_name;
            $contra->from_bank_name = $request->from_bank_name;
            $contra->update();

            $from_bank_book = new BankBook();
            $from_bank_book->contra_id = $contra->id;
            $from_bank_book->bank_date = $request->contra_date;
            $from_bank_book->bank_name = $request->from_bank_name;
            $from_bank_book->narration = $request->narration;
            $from_bank_book->credit_bank_amount = $request->contra_amount;
            $from_bank_book->save();

            $to_bank_book = new BankBook();
            $to_bank_book->contra_id = $contra->id;
            $to_bank_book->bank_date = $request->contra_date;
            $to_bank_book->bank_name = $request->to_bank_name;
            $to_bank_book->narration = $request->narration;
            $to_bank_book->debit_bank_amount = $request->contra_amount;
            $to_bank_book->save();
        }
    }
}
