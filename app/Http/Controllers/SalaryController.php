<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Staff;
use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function getSalaryStaff(){
        $staffs = Staff::orderBy('first_name', 'asc')->get();
        return response()->json([
            'staffs' => $staffs
        ]);
    }
    protected function salaryValidation($request){
        $request->validate([
            'salary_date' => 'required',
            'staff' => 'required',
            'cash' => 'required',
            'bank' => 'required',
            'cheque' => 'required',
            'total_salary_amount' => 'required',
            'narration' => 'required',
            'received_by' => 'required',
            'paid_by' => 'required',
            'approved_by' => 'required',
        ]);
    }
    protected function salaryBasic($salary, $request){
        $salary->salary_date = $request->salary_date;
        $salary->staff = $request->staff;
        $salary->cash = $request->cash;
        $salary->bank = $request->bank;
        $salary->cheque = $request->cheque;
        $salary->total_salary_amount = $request->total_salary_amount;
        $salary->narration = $request->narration;
        $salary->received_by = $request->received_by;
        $salary->paid_by = $request->paid_by;
        $salary->approved_by = $request->approved_by;
    }
    protected function salaryCash($salary, $request){
        if($request->cash == true){
            $request->validate([
                'cash' => 'required',
                'cashs.*.credit_cash_amount' => 'required'
            ]);
            $pre_cash_book = CashBook::orderBy('id', 'desc')->where('cash_date', $request->salary_date)->first();
            if($pre_cash_book == null){
                $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $request->salary_date)->first();
            }
            $cash_book = new CashBook();
            $cash_book->salary_id = $salary->id;
            $cash_book->cash_date = $salary->created_at->format('Y-m-d');
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            if($pre_cash_book == null ){
                $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
            }else{
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
            }
            $cash_book->save();

            $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_dates as $next_same_date){
                $next_same_date->blance -= $request->cashs[0]['credit_cash_amount'];
                $next_same_date->update();
            }
            $next_dates = CashBook::where('cash_date','>', $cash_book->cash_date)->get();
            foreach ($next_dates as $next_date){
                $next_date->blance -= $request->cashs[0]['credit_cash_amount'];
                $next_date->update();
            }
        }
    }
    protected function salaryCheque($salary, $request){
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
                $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $cheques_arry[$i]['bank_date'])->where('bank_name',  $cheques_arry[$i]['bank_name'] )->first();
                if($bank_blance == null){
                    $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $cheques_arry[$i]['bank_date'])->where('bank_name',  $cheques_arry[$i]['bank_name'] )->first();
                }
                $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $cheques_arry[$i]['bank_date'])->first();
                if($pre_bank_book == null){
                    $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $cheques_arry[$i]['bank_date'])->first();
                }
                $bank_book = new BankBook();
                $bank_book->salary_id = $salary->id;
                $bank_book->narration = $salary->narration;
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
    }
    public function addSalary(Request $request){
        $this->salaryValidation($request);
        $salary = new Salary();
        $this->salaryBasic($salary, $request);
        $salary->save();
        $this->salaryCash($salary, $request);
        $this->salaryCheque($salary, $request);
    }
    public function getAllSalarys(){
        $salarys = Salary::with(['stafft' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'salarys' => $salarys
        ]);
    }
    public function editSalary($id){
        $salary = Salary::where('id', $id)->with(['cashs' => function($q){$q->select('id', 'salary_id', 'credit_cash_amount');}, 'cheques' => function($q){$q->select('id', 'salary_id', 'bank_name','bank_date', 'bank_cheque_number', 'credit_bank_amount');}])->first();
        return response()->json([
            'salary' => $salary
        ]);
    }
    protected function updateCash($request, $salary){
        $cash_book = CashBook::where('salary_id', $request->id)->first();
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
    }

    protected function updateCheque($request){
        $bank_books = BankBook::where('salary_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $old_amount = $bank_book->credit_bank_amount;
            $next_same_bank_books = BankBook::where('bank_date', $bank_book->bank_date)->where('id', '>', $bank_book->id)->get();
            foreach ($next_same_bank_books as $next_same_bank_book){
                $next_same_bank_book->blance += $old_amount;
                $next_same_bank_book->update();
            }
            $next_bank_books = BankBook::where('bank_date','>', $bank_book->bank_date)->get();
            foreach ($next_bank_books as $next_bank_book){
                $next_bank_book->blance += $old_amount;
                $next_bank_book->update();
            }
            $bank_book->delete();
        }
    }

    public function updateSalary(Request $request){
        $this->salaryValidation($request);
        $salary = Salary::where('id', $request->id)->first();
        $this->salaryBasic($salary, $request);
        $salary->update();
        $this->updateCash($request, $salary);
        $this->updateCheque($request);
        $this->salaryCash($salary, $request);
        $this->salaryCheque($salary, $request);
    }
}
