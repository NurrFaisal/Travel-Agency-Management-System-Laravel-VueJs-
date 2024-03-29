<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Expence;
use App\model\ExpenceHead;
use Illuminate\Http\Request;
use Session;

class ExpenceController extends Controller
{
    public function getExpenceHead()
    {
        $expence_heads = ExpenceHead::orderBy('name', 'asc')->get();
        return response()->json([
            'expence_heads' => $expence_heads
        ]);
    }

    protected function expenceValidation($request)
    {
        $request->validate([
            'expence_date' => 'required',
            'expence_head' => 'required',
            'cash' => 'required',
            'cheque' => 'required',
            'total_expence_amount' => 'required',
            'narration' => 'required',
            'received_by' => 'required',
            'paid_by' => 'required',
            'approved_by' => 'required',
        ]);
    }

    protected function expenceBasic($expence, $request)
    {
        $expence->expence_date = $request->expence_date;
        $expence->expence_head = $request->expence_head;
        $expence->cash = $request->cash;
        $expence->cheque = $request->cheque;
        $expence->total_expence_amount = $request->total_expence_amount;
        $expence->narration = $request->narration;
        $expence->received_by = $request->received_by;
        $expence->paid_by = $request->paid_by;
        $expence->approved_by = $request->approved_by;
    }

    public function expenceCash($expence, $request)
    {
        if ($request->cash == true) {
            $request->validate([
                'cash' => 'required',
                'cashs.*.credit_cash_amount' => 'required'
            ]);

            $pre_cash_book = CashBook::orderBy('id', 'desc')->where('cash_date', $request->expence_date)->first();
            if ($pre_cash_book == null) {
                $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $request->expence_date)->first();
            }
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $request->expence_date)->where('branch_id', $expence->location)->first();
            if ($pre_branch_cash_book == null) {
                $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $request->expence_date)->where('branch_id', $expence->location)->first();
            }
            $cash_book = new CashBook();
            $cash_book->expence_id = $expence->id;
            $cash_book->branch_id = $expence->location;
            $cash_book->cash_date = $expence->expence_date;
            $cash_book->narration = $request->narration;
            $cash_book->credit_cash_amount = $request->cashs[0]['credit_cash_amount'];
            if ($pre_cash_book == null) {
                $cash_book->blance = -$request->cashs[0]['credit_cash_amount'];
            } else {
                $cash_book->blance = $pre_cash_book->blance - $request->cashs[0]['credit_cash_amount'];
            }
            if ($pre_branch_cash_book == null) {
                $cash_book->branch_blance = -$request->cashs[0]['credit_cash_amount'];
            } else {
                $cash_book->branch_blance = $pre_branch_cash_book->branch_blance - $request->cashs[0]['credit_cash_amount'];
            }
            $cash_book->save();

            $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_dates as $next_same_date) {
                $next_same_date->blance -= $request->cashs[0]['credit_cash_amount'];
                if ($next_same_date->branch_id == $cash_book->branch_id) {
                    $next_same_date->branch_blance -= $cash_book->credit_cash_amount;
                }
                $next_same_date->update();
            }
            $next_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
            foreach ($next_dates as $next_date) {
                $next_date->blance -= $request->cashs[0]['credit_cash_amount'];
                if ($next_date->branch_id == $cash_book->branch_id) {
                    $next_date->branch_blance -= $cash_book->credit_cash_amount;
                }
                $next_date->update();
            }
        }
    }

    public function expenceCheque($expence, $request)
    {
        if ($request->cheque == true) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.bank_name' => 'required',
                'cheques.*.bank_date' => 'required',
                'cheques.*.bank_cheque_number' => 'required',
                'cheques.*.credit_bank_amount' => 'required',
            ]);

            $cheques_arry = $request->cheques;
            $cheques_arry_count = count($cheques_arry);
            for ($i = 0; $i < $cheques_arry_count; $i++) {

                $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $cheques_arry[$i]['bank_date'])->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                if ($bank_blance == null) {
                    $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $cheques_arry[$i]['bank_date'])->where('bank_name', $cheques_arry[$i]['bank_name'])->first();
                }
                $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $cheques_arry[$i]['bank_date'])->first();
                if ($pre_bank_book == null) {
                    $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $cheques_arry[$i]['bank_date'])->first();
                }
                $bank_book = new BankBook();
                $bank_book->expence_id = $expence->id;
                $bank_book->narration = $expence->narration;
                $bank_book->bank_name = $cheques_arry[$i]['bank_name'];
                $bank_book->bank_date = $cheques_arry[$i]['bank_date'];
                $bank_book->bank_cheque_number = $cheques_arry[$i]['bank_cheque_number'];
                $bank_book->credit_bank_amount = $cheques_arry[$i]['credit_bank_amount'];
                if ($pre_bank_book == null) {
                    $bank_book->blance = -$cheques_arry[$i]['credit_bank_amount'];
                } else {
                    $bank_book->blance = $pre_bank_book->blance - $cheques_arry[$i]['credit_bank_amount'];
                }
                if ($bank_blance == null) {
                    $bank_book->bank_blance = -$cheques_arry[$i]['credit_bank_amount'];
                } else {
                    $bank_book->bank_blance = $bank_blance->bank_blance - $cheques_arry[$i]['credit_bank_amount'];
                }
                $bank_book->save();

                $next_same_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $cheques_arry[$i]['bank_date'])->get();
                foreach ($next_same_dates as $next_same_date) {
                    $next_same_date->blance -= $bank_book->credit_bank_amount;
                    if ($next_same_date->bank_name == $bank_book->bank_name) {
                        $next_same_date->bank_blance -= $bank_book->credit_bank_amount;
                    }
                    $next_same_date->update();
                }

                $next_dates = BankBook::where('bank_date', '>', $cheques_arry[$i]['bank_date'])->get();
                foreach ($next_dates as $next_date) {
                    $next_date->blance -= $bank_book->credit_bank_amount;
                    if ($next_date->bank_name == $bank_book->bank_name) {
                        $next_date->bank_blance -= $bank_book->credit_bank_amount;
                    }
                    $next_date->update();
                }

            }

        }
    }

    public function addExpence(Request $request)
    {
        $this->expenceValidation($request);
        $expence = new  Expence();
        $this->expenceBasic($expence, $request);
        $expence->location = Session::get('location');
        $expence->save();
        $this->expenceCash($expence, $request);
        $this->expenceCheque($expence, $request);
    }

    public function getAllExpence()
    {
        $expences = Expence::with(['expenceHeadt' => function ($q) {
            $q->select('id', 'name');
        }])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'expences' => $expences
        ]);
    }

    public function editExpence($id)
    {
        $expence = Expence::where('id', $id)->with(['cashs' => function ($q) {
            $q->select('id', 'expence_id', 'credit_cash_amount');
        }, 'cheques' => function ($q) {
            $q->select('id', 'expence_id', 'bank_name', 'bank_date', 'bank_cheque_number', 'credit_bank_amount');
        }])->first();
        return response()->json([
            'expence' => $expence
        ]);
    }

    protected function updateCash($request, $expence)
    {
        $cash_book = CashBook::where('expence_id', $request->id)->first();
        if ($cash_book != null) {
            $old_credit_amount = $cash_book->credit_cash_amount;
            $next_same_dates = CashBook::where('cash_date', $cash_book->cash_date)->where('id', '>', $cash_book->id)->get();
            foreach ($next_same_dates as $next_same_date) {
                $next_same_date->blance += $old_credit_amount;
                if ($next_same_date->branch_id == $cash_book->branch_id) {
                    $next_same_date->branch_blance += $old_credit_amount;
                }
                $next_same_date->update();
            }
            $next_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
            foreach ($next_dates as $next_date) {
                $next_date->blance += $old_credit_amount;
                if ($next_date->branch_id == $cash_book->branch_id) {
                    $next_date->branch_blance += $old_credit_amount;
                }
                $next_date->update();
            }
            $cash_book->delete();

        }
    }

    protected function updateCheque($request)
    {
        $bank_books = BankBook::where('expence_id', $request->id)->get();
        foreach ($bank_books as $bank_book) {
            $old_amount = $bank_book->credit_bank_amount;
            $next_same_bank_books = BankBook::where('bank_date', $bank_book->bank_date)->where('id', '>', $bank_book->id)->get();
            foreach ($next_same_bank_books as $next_same_bank_book) {
                $next_same_bank_book->blance += $old_amount;
                $next_same_bank_book->update();
            }
            $next_bank_books = BankBook::where('bank_date', '>', $bank_book->bank_date)->get();
            foreach ($next_bank_books as $next_bank_book) {
                $next_bank_book->blance += $old_amount;
                $next_bank_book->update();
            }
            $bank_book->delete();
        }


        foreach ($bank_books as $bank_book) {
            $next_bank_books = BankBook::where('id', '>', $bank_book->id)->get();
            foreach ($next_bank_books as $next_bank_book) {
                if ($bank_book->credit_bank_amount > 0) {
                    $next_bank_book->blance += $bank_book->credit_bank_amount;
                    if ($next_bank_book->bank_name == $bank_book->bank_name) {
                        $next_bank_book->bank_blance += $bank_book->credit_bank_amount;
                    }
                }
                $next_bank_book->update();
            }
            $bank_book->delete();
        }
    }

    public function updateExpence(Request $request)
    {
        $this->expenceValidation($request);
        $expence = Expence::where('id', $request->id)->first();
        $this->expenceBasic($expence, $request);
        $expence->update();
        $this->updateCash($request, $expence);
        $this->updateCheque($request);
        $this->expenceCash($expence, $request);
        $this->expenceCheque($expence, $request);

    }

    public function getAllExpenceSearch($search)
    {
        $expence_heads_id = [];
        $expence_heads = ExpenceHead::where('name', 'like', $search . '%')->get();
        foreach ($expence_heads as $key => $expence_head) {
            $expence_heads_id[$key] = $expence_head->id;
        }
        $expences = Expence::with(['expenceHeadt' => function ($q) {
            $q->select('id', 'name');
        }])
            ->where('id', $search)->orWhere('expence_date', 'like', $search . '%')
            ->orWhere('total_expence_amount', 'like', $search . '%')
            ->orWhereIn('expence_head', $expence_heads_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json([
            'expences' => $expences
        ]);
    }
}
