<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\Contra;
use Illuminate\Http\Request;
use Session;

class ContraController extends Controller
{
    protected function contraValidation($request)
    {
        $request->validate([
            'contra_type' => 'required',
            'contra_date' => 'required',
            'contra_amount' => 'required',
            'narration' => 'required',
        ]);
    }

    protected function preCashQuery($contra)
    {
        $pre_cash_book = CashBook::orderBy('id', 'desc')->where('cash_date', $contra->contra_date)->first();
        if ($pre_cash_book == null) {
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $contra->contra_date)->first();
        }
        return $pre_cash_book;
    }

    protected function cashBookCredit($request, $contra)
    {
        // CashBook Credit Start
//        $pre_cash_book = $this->preCashQuery($contra);
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $contra->contra_date)->first();
        if ($pre_cash_book == null) {
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $contra->contra_date)->first();
        }
        $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $contra->contra_date)->where('branch_id', $contra->location)->first();
        if ($pre_branch_cash_book == null) {
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $contra->contra_date)->where('branch_id', $contra->location)->first();
        }
        $cash_book = new CashBook();
        $cash_book->contra_id = $contra->id;
        $cash_book->branch_id = $contra->location;
        $cash_book->cash_date = $contra->contra_date;
        $cash_book->narration = $request->narration;
        $cash_book->credit_cash_amount = $request->contra_amount;
        if ($pre_cash_book != null) {
            $cash_book->blance = $pre_cash_book->blance - $request->contra_amount;
        } else {
            $cash_book->blance = -$request->contra_amount;
        }
        if ($pre_branch_cash_book == null) {
            $cash_book->branch_blance = -$request->contra_amount;
        } else {
            $cash_book->branch_blance = $pre_branch_cash_book->branch_blance - $request->contra_amount;
        }
        $cash_book->save();

        $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance -= $contra->contra_amount;
            if ($next_same_date->branch_id == $cash_book->branch_id) {
                $next_same_date->branch_blance -= $cash_book->credit_cash_amount;
            }
            $next_same_date->update();
        }
        $next_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance -= $contra->contra_amount;
            if ($next_date->branch_id == $cash_book->branch_id) {
                $next_date->branch_blance -= $cash_book->credit_cash_amount;
            }
            $next_date->update();
        }
        // CashBook Credit End
    }

    protected function cashBookDebit($request, $contra)
    {
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $contra->contra_date)->first();
        if ($pre_cash_book == null) {
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $contra->contra_date)->first();
        }
        $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $contra->contra_date)->where('branch_id', $contra->location)->first();
        if ($pre_branch_cash_book == null) {
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $contra->contra_date)->where('branch_id', $contra->location)->first();
        }
        $cash_book = new CashBook();
        $cash_book->contra_id = $contra->id;
        $cash_book->branch_id = $contra->location;
        $cash_book->cash_date = $contra->contra_date;
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->contra_amount;
//        $pre_cash_book = $this->preCashQuery($contra);
        if ($pre_cash_book == null) {
            $cash_book->blance = $request->contra_amount;
        } else {
            $cash_book->blance = $pre_cash_book->blance + $request->contra_amount;
        }
        if ($pre_branch_cash_book == null) {
            $cash_book->branch_blance = $request->contra_amount;
        } else {
            $cash_book->branch_blance = $pre_branch_cash_book->branch_blance + $request->contra_amount;
        }
        $cash_book->save();

        $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_book)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance += $contra->contra_amount;
            if ($next_same_date->branch_id == $cash_book->branch_id) {
                $next_same_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_same_date->update();
        }
        $next_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->orderBy('cash_date', 'asc')->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $contra->contra_amount;
            if ($next_date->branch_id == $cash_book->branch_id) {
                $next_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_date->update();
        }
    }

    protected function bankBlance($request, $contra)
    {
        $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $contra->contra_date)->where('bank_name', $request->bank_name)->first();
        if ($bank_blance == null) {
            $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $contra->contra_date)->where('bank_name', $request->bank_name)->first();
        }
        return $bank_blance;
    }

    protected function preBankBook($contra)
    {
        $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $contra->contra_date)->first();
        if ($pre_bank_book == null) {
            $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $contra->contra_date)->first();
        }
        return $pre_bank_book;
    }

    protected function bankBookDebit($request, $contra)
    {
        // BankBook Debit Start
        $bank_blance = $this->bankBlance($request, $contra);
        $pre_bank_book = $this->preBankBook($contra);
        $bank_book = new BankBook();
        $bank_book->contra_id = $contra->id;
        $bank_book->bank_date = $request->contra_date;
        $bank_book->bank_name = $request->bank_name;
        $bank_book->narration = $request->narration;
        $bank_book->debit_bank_amount = $request->contra_amount;
        if ($pre_bank_book != null) {
            $bank_book->blance = $pre_bank_book->blance + $request->contra_amount;
        } else {
            $bank_book->blance = $request->contra_amount;
        }

        if ($bank_blance == null) {
            $bank_book->bank_blance = $request->contra_amount;
        } else {
            $bank_book->bank_blance = $bank_blance->bank_blance + $request->contra_amount;
        }
        $bank_book->save();
        $next_same_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $bank_book->bank_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance += $request->contra_amount;
            if ($next_same_date->bank_name == $bank_book->bank_name) {
                $next_same_date->bank_blance += $request->contra_amount;
            }
            $next_same_date->update();
        }
        $next_dates = BankBook::orderBy('bank_date', 'asc')->where('bank_date', '>', $bank_book->bank_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $request->contra_amount;
            if ($next_date->bank_name == $bank_book->bank_name) {
                $next_date->bank_blance += $request->contra_amount;
            }
            $next_date->update();
        }
        //BankBook Debit End
    }

    protected function bankBookCredit($request, $contra)
    {
        // BankBook Credit Start
        $bank_blance = $this->bankBlance($request, $contra);
        $pre_bank_book = $this->preBankBook($contra);
        $bank_book = new BankBook();
        $bank_book->contra_id = $contra->id;
        $bank_book->bank_date = $request->contra_date;
        $bank_book->bank_name = $request->bank_name;
        $bank_book->narration = $request->narration;
        $bank_book->credit_bank_amount = $request->contra_amount;
        if ($pre_bank_book == null) {
            $bank_book->blance = -$contra->contra_amount;
        } else {
            $bank_book->blance = $pre_bank_book->blance - $contra->contra_amount;
        }
        if ($bank_blance == null) {
            $bank_book->bank_blance = -$contra->contra_amount;
        } else {
            $bank_book->bank_blance = $bank_blance->bank_blance - $contra->contra_amount;
        }
        $bank_book->save();

        $next_same_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $bank_book->bank_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance -= $request->contra_amount;
            if ($next_same_date->bank_name == $bank_book->bank_name) {
                $next_same_date->bank_blance -= $request->contra_amount;
            }
            $next_same_date->update();
        }
        $next_dates = BankBook::orderBy('bank_date', 'asc')->where('bank_date', '>', $bank_book->bank_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance -= $request->contra_amount;
            if ($next_date->bank_name == $bank_book->bank_name) {
                $next_date->bank_blance -= $request->contra_amount;
            }
            $next_date->update();
        }
        // BankBook Credit End
    }

    protected function contraCashToBank($request, $contra)
    {
        $this->cashBookCredit($request, $contra);
        $this->bankBookDebit($request, $contra);
    }

    protected function contraBankToCash($request, $contra)
    {
        $this->bankBookCredit($request, $contra);
        $this->cashBookDebit($request, $contra);
    }

    protected function fromBank($request, $contra)
    {
        $from_pre_bank_book = BankBook::orderBy('id', 'desc')->where('bank_date', $contra->contra_date)->first();
        if ($from_pre_bank_book == null) {
            $from_pre_bank_book = BankBook::orderBy('id', 'desc')->orderBy('bank_date', 'desc')->where('bank_date', '<', $contra->contra_date)->first();
        }

        $from_bank_blance = BankBook::orderBy('id', 'desc')->where('bank_date', $contra->contra_date)->where('bank_name', $request->from_bank_name)->first();
        if ($from_bank_blance == null) {
            $from_bank_blance = BankBook::orderBy('id', 'desc')->orderBy('bank_date', 'desc')->where('bank_date', '<', $contra->contra_date)->where('bank_name', $request->from_bank_name)->first();
        }
        $from_bank_book = new BankBook();
        $from_bank_book->contra_id = $contra->id;
        $from_bank_book->bank_date = $request->contra_date;
        $from_bank_book->bank_name = $request->from_bank_name;
        $from_bank_book->narration = $request->narration;
        $from_bank_book->credit_bank_amount = $request->contra_amount;
        if ($from_pre_bank_book == null) {
            $from_bank_book->blance = -$request->contra_amount;
        } else {
            $from_bank_book->blance = $from_pre_bank_book->blance - $request->contra_amount;
        }
        if ($from_bank_blance == null) {
            $from_bank_book->bank_blance = -$request->contra_amount;
        } else {
            $from_bank_book->bank_blance = $from_bank_blance->bank_blance - $request->contra_amount;
        }
        $from_bank_book->save();

        $next_same_dates = BankBook::where('id', '>', $from_bank_book->id)->where('bank_date', $from_bank_book->bank_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance -= $request->contra_amount;
            if ($next_same_date->bank_name == $from_bank_book->bank_name) {
                $next_same_date->bank_blance -= $request->contra_amount;
            }
            $from_bank_book->update();
        }

        $next_dates = BankBook::where('bank_date', '>', $from_bank_book->bank_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance -= $request->contra_amount;
            if ($from_bank_book->bank_name == $next_date->bank_name) {
                $next_date->bank_blance -= $request->contra_amount;
            }
            $next_date->update();
        }
    }

    protected function toBank($request, $contra)
    {

        $to_pre_bank_book = BankBook::orderBy('id', 'desc')->where('bank_date', $contra->contra_date)->first();
        if ($to_pre_bank_book == null) {
            $to_pre_bank_book = BankBook::orderBy('id', 'desc')->orderBy('bank_date', 'desc')->where('bank_date', '<', $contra->contra_date)->first();
        }
        $to_bank_blance = BankBook::orderBy('id', 'desc')->where('bank_date', $contra->contra_date)->where('bank_name', $request->to_bank_name)->first();
        if ($to_bank_blance == null) {
            $to_bank_blance = BankBook::orderBy('id', 'desc')->orderBy('bank_date', 'desc')->where('bank_date', '<', $contra->contra_date)->where('bank_name', $request->to_bank_name)->first();
        }
        $to_bank_book = new BankBook();
        $to_bank_book->contra_id = $contra->id;
        $to_bank_book->bank_date = $request->contra_date;
        $to_bank_book->bank_name = $request->to_bank_name;
        $to_bank_book->narration = $request->narration;
        $to_bank_book->debit_bank_amount = $request->contra_amount;
        if ($to_pre_bank_book == null) {
            $to_bank_book->blance = $request->contra_amount;
        } else {
            $to_bank_book->blance = $to_pre_bank_book->blance + $request->contra_amount;
        }
        if ($to_bank_blance == null) {
            $to_bank_book->bank_blance = $request->contra_amount;
        } else {
            $to_bank_book->bank_blance = $to_bank_blance->bank_blance + $request->contra_amount;
        }
        $to_bank_book->save();
        $next_same_dates = BankBook::where('id', '>', $to_bank_book->id)->where('bank_date', $to_bank_book->bank_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance += $request->contra_amount;
            if ($next_same_date->bank_name == $to_bank_book->bank_name) {
                $next_same_date->bank_blance += $request->contra_amount;
            }
            $next_same_date->update();
        }
        $next_dates = BankBook::where('bank_date', '>', $to_bank_book->bank_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $request->contra_amount;
            if ($next_date->bank_name == $to_bank_book->bank_name) {
                $next_date->bank_blance += $request->contra_amount;
            }
            $next_date->update();
        }
    }

    protected function contraBasic($request, $contra)
    {
        $contra->contra_type = $request->contra_type;
        $contra->contra_date = $request->contra_date;
        $contra->contra_amount = $request->contra_amount;
        $contra->narration = $request->narration;
    }

    public function addContra(Request $request)
    {
        $this->contraValidation($request);
        $contra = new Contra();
        $this->contraBasic($request, $contra);
        $contra->location = Session::get('location');
        if ($request->contra_type == 1) {
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->save();
            $this->contraCashToBank($request, $contra);
            return 'Cash To Bank';
        }
        if ($request->contra_type == 2) {
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->save();
            $this->contraBankToCash($request, $contra);
            return 'Bank To Cash';
        }
        if ($request->contra_type == 3) {
            $request->validate([
                'to_bank_name' => 'required',
                'from_bank_name' => 'required'
            ]);
            $contra->to_bank_name = $request->to_bank_name;
            $contra->from_bank_name = $request->from_bank_name;
            $contra->save();
            // To Bank Book Start (Debit)
            $this->toBank($request, $contra);
            // To Bank Book End (Debit)
            //FromBank Start (credit)
            $this->fromBank($request, $contra);
            //From Bank Book End (credit)
            return 'Bank To Bank';
        }
    }

    public function getAllContra()
    {
        $contras = Contra::with('bank', 'from_bank', 'to_bank')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'contras' => $contras
        ]);
    }

    public function editContra($id)
    {
        $contra = Contra::where('id', $id)->first();
        return response()->json([
            'contra' => $contra
        ]);
    }

    protected function typeOneDeleteCash($contra, $old_amount)
    {
        $cash_book = CashBook::where('contra_id', $contra->id)->first();
        $next_same_cash_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
        foreach ($next_same_cash_dates as $next_same_cash_date) {
            $next_same_cash_date->blance += $old_amount;
            if ($next_same_cash_date->branch_id == $cash_book->branch_id) {
                $next_same_cash_date->branch_blance += $old_amount;
            }
            $next_same_cash_date->update();
        }
        $next_cash_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
        foreach ($next_cash_dates as $next_cash_date) {
            $next_cash_date->blance += $old_amount;
            if ($next_cash_date->branch_id == $cash_book->branch_id) {
                $next_cash_date->branch_blance += $old_amount;
            }
            $next_cash_date->update();
        }
        $cash_book->delete();
    }

    protected function typeOneBankDelete($contra, $old_amount)
    {
        $bank_book = BankBook::where('contra_id', $contra->id)->first();
        $next_same_bank_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $bank_book->bank_date)->get();
        foreach ($next_same_bank_dates as $next_same_bank_date) {
            $next_same_bank_date->blance -= $old_amount;
            if ($next_same_bank_date->bank_name == $bank_book->bank_name) {
                $next_same_bank_date->bank_blance -= $old_amount;
            }
            $next_same_bank_date->update();
        }
        $next_bank_dates = BankBook::where('bank_date', '>', $bank_book->bank_date)->get();
        foreach ($next_bank_dates as $next_bank_date) {
            $next_bank_date->blance -= $old_amount;
            if ($next_bank_date->bank_name == $bank_book->bank_name) {
                $next_bank_date->bank_blance -= $old_amount;
            }
            $next_bank_date->update();
        }
        $bank_book->delete();
    }

    protected function typeTwoBankDelete($contra, $old_amount)
    {
        $bank_book = BankBook::where('contra_id', $contra->id)->first();
        $next_same_bank_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $bank_book->bank_date)->get();
        foreach ($next_same_bank_dates as $next_same_bank_date) {
            $next_same_bank_date->blance += $old_amount;
            if ($next_same_bank_date->bank_name == $bank_book->bank_name) {
                $next_same_bank_date->bank_blance += $old_amount;
            }
            $next_same_bank_date->update();
        }
        $next_bank_dates = BankBook::where('bank_date', '>', $bank_book->bank_date)->get();
        foreach ($next_bank_dates as $next_bank_date) {
            $next_bank_date->blance += $old_amount;
            if ($next_bank_date->bank_name == $bank_book->bank_name) {
                $next_bank_date->bank_blance += $old_amount;
            }
            $next_bank_date->update();
        }
        $bank_book->delete();
    }

    protected function typeTwoCashDelete($contra, $old_amount)
    {
        $cash_book = CashBook::where('contra_id', $contra->id)->first();
        $next_same_cash_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
        foreach ($next_same_cash_dates as $next_same_cash_date) {
            $next_same_cash_date->blance -= $old_amount;
            if ($next_same_cash_date->branch_id == $cash_book->branch_id) {
                $next_same_cash_date->branch_blance -= $old_amount;
            }
            $next_same_cash_date->update();
        }
        $next_dates = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance -= $old_amount;
            if ($next_date->branch_id == $cash_book->branch_id) {
                $next_date->branch_blance -= $old_amount;
            }
            $next_date->update();
        }
        $cash_book->delete();
    }

    protected function typeThreeFromBank($contra, $old_amount)
    {
        $from_bank_book = BankBook::where('contra_id', $contra->id)->where('bank_name', $contra->from_bank_name)->first();
        $next_from_bank_same_dates = BankBook::where('id', '>', $from_bank_book->id)->where('bank_date', $from_bank_book->bank_date)->get();
        foreach ($next_from_bank_same_dates as $next_from_bank_same_date) {
            $next_from_bank_same_date->blance += $old_amount;
            if ($next_from_bank_same_date->bank_name == $from_bank_book->bank_name) {
                $next_from_bank_same_date->bank_blance += $old_amount;
            }
            $next_from_bank_same_date->update();
        }
        $next_from_bank_dates = BankBook::where('bank_date', '>', $from_bank_book->bank_date)->get();
        foreach ($next_from_bank_dates as $next_from_bank_date) {
            $next_from_bank_date->blance += $old_amount;
            if ($next_from_bank_date->bank_name == $from_bank_book->bank_name) {
                $next_from_bank_date->bank_blance += $old_amount;
            }
            $next_from_bank_date->update();
        }
        $from_bank_book->delete();
    }

    protected function typeThreeToBank($contra, $old_amount)
    {
        $to_bank_book = BankBook::where('contra_id', $contra->id)->where('bank_name', $contra->to_bank_name)->first();
        $next_to_same_dates = BankBook::where('id', '>', $to_bank_book->id)->where('bank_date', $to_bank_book->bank_date)->get();
        foreach ($next_to_same_dates as $next_to_same_date) {
            $next_to_same_date->blance -= $old_amount;
            if ($next_to_same_date->bank_name == $to_bank_book->bank_name) {
                $next_to_same_date->bank_blance -= $old_amount;
            }
            $next_to_same_date->update();
        }
        $next_to_dates = BankBook::where('bank_date', '>', $to_bank_book->bank_date)->get();
        foreach ($next_to_dates as $next_to_date) {
            $next_to_date->blance -= $old_amount;
            if ($next_to_date->bank_name == $to_bank_book->bank_name) {
                $next_to_date->bank_blance -= $old_amount;
            }
            $next_to_date->update();
        }
        $to_bank_book->delete();
    }

    public function updateContra(Request $request)
    {
        $this->contraValidation($request);
        $contra = Contra::where('id', $request->id)->first();
        $old_amount = $contra->contra_amount;
        if ($contra->contra_type == 1) {
            $this->typeOneBankDelete($contra, $old_amount);
            $this->typeOneDeleteCash($contra, $old_amount);
        }
        if ($contra->contra_type == 2) {
            $this->typeTwoCashDelete($contra, $old_amount);
            $this->typeTwoBankDelete($contra, $old_amount);
        }
        if ($contra->contra_type == 3) {
            $this->typeThreeToBank($contra, $old_amount);
            $this->typeThreeFromBank($contra, $old_amount);

        }
        // Saved contra for update
        $this->contraBasic($request, $contra);
        if ($request->contra_type == 1) {
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->update();
            $this->contraCashToBank($request, $contra);
            return 'Cash To Bank';
        }
        if ($request->contra_type == 2) {
            $request->validate([
                'bank_name' => 'required'
            ]);
            $contra->bank_name = $request->bank_name;
            $contra->update();
            $this->contraBankToCash($request, $contra);
            return 'Bank To Cash';
        }
        if ($request->contra_type == 3) {
            $request->validate([
                'to_bank_name' => 'required',
                'from_bank_name' => 'required'
            ]);
            $contra->to_bank_name = $request->to_bank_name;
            $contra->from_bank_name = $request->from_bank_name;
            $contra->update();
            // To Bank Book Start (Debit)
            $this->toBank($request, $contra);
            // To Bank Book End (Debit)
            //FromBank Start (credit)
            $this->fromBank($request, $contra);
            //From Bank Book End (credit)
            return 'Bank To Bank';
        }

    }

    public function getAllContraSearch($search)
    {
        $contras = Contra::with('bank', 'from_bank', 'to_bank')->where('id', $search)->orWhere('contra_date', 'like', $search . '%')->orWhere('contra_amount', 'like', $search . '%')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'contras' => $contras
        ]);
    }
}
