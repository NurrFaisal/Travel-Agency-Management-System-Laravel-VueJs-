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
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
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
                $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
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
        $cash_books = CashBook::where('salary_id', $request->id)->get();
        foreach ($cash_books as $cash_book){
            $cash_book->salary_id = null;
            $cash_book->narration = 'update salary to debit (1st)';
            $cash_book->update();
            $pre_cash_book = CashBook::orderBy('id', 'desc')->select('credit_cash_amount', 'blance')->first();
            $update_cash_book = new CashBook();
            $update_cash_book->cash_date = $salary->created_at->format('Y-m-d');
            $update_cash_book->narration = $cash_book->id.' '. 'Update salary to debit (2nd)';
            $update_cash_book->debit_cash_amount = $cash_book->credit_cash_amount;
            $update_cash_book->blance = $pre_cash_book->blance + $cash_book->credit_cash_amount;
            $update_cash_book->save();
        }
    }

    protected function updateCheque($request){
        $bank_books = BankBook::where('salary_id', $request->id)->get();
        foreach ($bank_books as $bank_book){
            $bank_book->salary_id = null;
            $bank_book->narration = 'Update salary to debit (1st)';
            $bank_book->update();
            $bank_blance = BankBook::orderBy('id', 'desc')->where('bank_name', $bank_book->bank_name)->first();
            $pre_bank_book = BankBook::orderBy('id', 'desc')->select('credit_bank_amount', 'blance')->first();
            $update_bank_book = new BankBook();
            $update_bank_book->bank_name = $bank_book->bank_name;
            $update_bank_book->bank_date = $bank_book->bank_date;
            $update_bank_book->bank_cheque_number = $bank_book->bank_cheque_number;
            $update_bank_book->narration = $bank_book->id.' '.'Udate salary to debit (2nd)';
            $update_bank_book->debit_bank_amount = $bank_book->credit_bank_amount;
            $update_bank_book->blance = $pre_bank_book->blance + $bank_book->credit_bank_amount;
            $update_bank_book->bank_blance = $bank_blance->bank_blance + $bank_book->credit_bank_amount;
            $update_bank_book->save();
        }
    }

    public function updateSalary(Request $request){
        $this->salaryValidation($request);
        $salary = Salary::where('id', $request->id)->first();
        $this->updateCash($request, $salary);
        $this->updateCheque($request);
        $this->salaryCash($salary, $request);
        $this->salaryCheque($salary, $request);
    }
}
