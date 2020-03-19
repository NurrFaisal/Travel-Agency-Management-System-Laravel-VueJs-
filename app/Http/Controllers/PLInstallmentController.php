<?php

namespace App\Http\Controllers;

use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use App\model\PaymentLoan;
use App\model\PaymentLoanTransaction;
use App\model\PLInstallment;
use App\model\ReceivedLoanTransaction;
use Illuminate\Http\Request;
use Session;

class PLInstallmentController extends Controller
{
    public function getAllPaymentLoanName()
    {
        $payment_loans = PaymentLoan::orderBy('pl_name')->get();
        return response()->json([
            'payment_loans' => $payment_loans
        ]);
    }

    protected function plInstallmentValidation($request)
    {
        $request->validate([
            'pl_installment_date' => 'required',
            'loan_id' => 'required',
            'total_payment_loan_installment_amount' => 'required',
            'narration' => 'required',
            'received_by' => 'required',
            'paid_by' => 'required',
            'approved_by' => 'required',
        ]);
    }

    protected function allValidation($request)
    {
        if ($request->cash == 1) {
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }
        if ($request->bank == 1) {
            $request->validate([
                'bank' => 'required',
                'banks.*.bank_name' => 'required|numeric',
                'banks.*.bank_date' => 'required|date',
                'banks.*.debit_bank_amount' => 'required|numeric',
            ]);
        }
        if ($request->cheque == 1) {
            $request->validate([
                'cheque' => 'required',
                'cheques.*.cheque_bank_name' => 'required',
                'cheques.*.cheque_type' => 'required|numeric',
                'cheques.*.cheque_number' => 'required|numeric',
                'cheques.*.cheque_amount' => 'required|numeric',
                'cheques.*.cheque_date' => 'required',
            ]);
        }
        if ($request->cash != 1 && $request->bank != 1 && $request->cheque != 1) {
            $request->validate([
                'cash' => 'required|numeric',
                'cashs.*.debit_cash_amount' => 'required|numeric',
            ]);
        }
    }

    public function plInstallmentBasic($request, $pl_installment)
    {
        $pl_installment->pl_installment_date = $request->pl_installment_date;
        $pl_installment->loan_id = $request->loan_id;
        $pl_installment->cash = $request->cash;
        $pl_installment->bank = $request->bank;
        $pl_installment->cheque = $request->cheque;
        $pl_installment->total_payment_loan_installment_amount = $request->total_payment_loan_installment_amount;
        $pl_installment->narration = $request->narration;
        $pl_installment->received_by = $request->received_by;
        $pl_installment->paid_by = $request->paid_by;
        $pl_installment->approved_by = $request->approved_by;
    }

    protected function savePLInstallmentCash($request, $pl_installment)
    {
        $request->validate([
            'cash' => 'required',
            'cashs.*.debit_cash_amount' => 'required'
        ]);
        $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $pl_installment->pl_installment_date)->first();
        if ($pre_cash_book == null) {
            $pre_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $pl_installment->pl_installment_date)->first();
        }
        $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', $pl_installment->pl_installment_date)->where('branch_id', $pl_installment->location)->first();
        if ($pre_branch_cash_book == null) {
            $pre_branch_cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->where('cash_date', '<', $pl_installment->pl_installment_date)->where('branch_id', $pl_installment->location)->first();
        }
        $cash_book = new CashBook();
        $cash_book->pl_installment_id = $pl_installment->id;
        $cash_book->branch_id = $pl_installment->location;
        $cash_book->cash_date = $pl_installment->pl_installment_date;
        $cash_book->narration = $request->narration;
        $cash_book->debit_cash_amount = $request->cashs[0]['debit_cash_amount'];
        if ($pre_cash_book == null) {
            $cash_book->blance = $request->cashs[0]['debit_cash_amount'];
        } else {
            $cash_book->blance = $pre_cash_book->blance + $request->cashs[0]['debit_cash_amount'];
        }
        if ($pre_branch_cash_book == null) {
            $cash_book->branch_blance = $request->cashs[0]['debit_cash_amount'];
        } else {
            $cash_book->branch_blance = $pre_branch_cash_book->branch_blance + $request->cashs[0]['debit_cash_amount'];
        }
        $cash_book->save();
        $next_same_dates = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $pl_installment->pl_installment_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->blance += $cash_book->debit_cash_amount;
            if ($next_same_date->branch_id == $cash_book->branch_id) {
                $next_same_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_same_date->update();
        }
        $next_dates = CashBook::orderBy('cash_date', 'asc')->where('cash_date', '>', $pl_installment->pl_installment_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $cash_book->debit_cash_amount;
            if ($next_date->branch_id == $cash_book->branch_id) {
                $next_date->branch_blance += $cash_book->debit_cash_amount;
            }
            $next_date->update();
        }
    }

    protected function savePLInstallmentBank($request, $pl_installment)
    {
        $request->validate([
            'bank' => 'required',
            'banks.*.bank_name' => 'required',
            'banks.*.bank_date' => 'required',
            'banks.*.debit_bank_amount' => 'required',
        ]);

        $banks_arry = $request->banks;
        $banks_arry_count = count($banks_arry);
        for ($i = 0; $i < $banks_arry_count; $i++) {
            $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $banks_arry[$i]['bank_date'])->where('bank_name', $banks_arry[$i]['bank_name'])->first();
            if ($bank_blance == null) {
                $bank_blance = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $banks_arry[$i]['bank_date'])->where('bank_name', $banks_arry[$i]['bank_name'])->first();
            }
            $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', $banks_arry[$i]['bank_date'])->first();
            if ($pre_bank_book == null) {
                $pre_bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->where('bank_date', '<', $banks_arry[$i]['bank_date'])->first();
            }
            $bank_book = new BankBook();
            $bank_book->pl_installment_id = $pl_installment->id;
            $bank_book->narration = $request->narration;
            $bank_book->bank_name = $banks_arry[$i]['bank_name'];
            $bank_book->bank_date = $banks_arry[$i]['bank_date'];
            $bank_book->debit_bank_amount = $banks_arry[$i]['debit_bank_amount'];
            if ($pre_bank_book == null) {
                $bank_book->blance = $banks_arry[$i]['debit_bank_amount'];
            } else {
                $bank_book->blance = $pre_bank_book->blance + $banks_arry[$i]['debit_bank_amount'];
            }

            if ($bank_blance == null) {
                $bank_book->bank_blance = $banks_arry[$i]['debit_bank_amount'];
            } else {
                $bank_book->bank_blance = $bank_blance->bank_blance + $banks_arry[$i]['debit_bank_amount'];
            }
            $bank_book->save();

            $next_same_dates = BankBook::where('id', '>', $bank_book->id)->where('bank_date', $banks_arry[$i]['bank_date'])->get();
            foreach ($next_same_dates as $next_same_date) {
                $next_same_date->blance += $bank_book->debit_bank_amount;
                if ($next_same_date->bank_name == $bank_book->bank_name) {
                    $next_same_date->bank_blance += $bank_book->debit_bank_amount;
                }
                $next_same_date->update();
            }

            $next_dates = BankBook::where('bank_date', '>', $banks_arry[$i]['bank_date'])->get();
            foreach ($next_dates as $next_date) {
                $next_date->blance += $bank_book->debit_bank_amount;
                if ($next_date->bank_name == $bank_book->bank_name) {
                    $next_date->bank_blance += $bank_book->debit_bank_amount;
                }
                $next_date->update();
            }

        }
    }

    protected function chequeBookFunction($request, $payment_loan)
    {
        $cheques_arry = $request->cheques;
        $cheques_arry_count = count($cheques_arry);
        for ($i = 0; $i < $cheques_arry_count; $i++) {
            $cheque_book = new ChequeBook();
            $cheque_book->pl_installment_id = $payment_loan->id;
            $cheque_book->cheque_bank_name = $cheques_arry[$i]['cheque_bank_name'];
            $cheque_book->cheque_type = $cheques_arry[$i]['cheque_type'];
            $cheque_book->cheque_number = $cheques_arry[$i]['cheque_number'];
            $cheque_book->cheque_date = $cheques_arry[$i]['cheque_date'];
            $cheque_book->cheque_amount = $cheques_arry[$i]['cheque_amount'];
            $cheque_book->status = 0;
            $cheque_book->location = $payment_loan->location;
            $cheque_book->save();
        }

        // Cheque
    }

    protected function savePaymentLoanTransaction($request, $pl_installment)
    {
        $loan_blance = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $pl_installment->pl_installment_date)->where('ins_payment_id', $pl_installment->loan_id)->first();
        if ($loan_blance == null) {
            $loan_blance = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $pl_installment->pl_installment_date)->where('ins_payment_id', $pl_installment->loan_id)->first();
            if ($loan_blance == null) {
                $loan_blance = PaymentLoanTransaction::where('payment_loan_id', $pl_installment->loan_id)->first();
            }
        }
        $pre_transaction = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $pl_installment->pl_installment_date)->first();
        if ($pre_transaction == null) {
            $pre_transaction = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $pl_installment->pl_installment_date)->first();
        }
        $transjaction = new PaymentLoanTransaction();
        $transjaction->ins_payment_id = $request->loan_id;
        $transjaction->pl_installment_id = $pl_installment->id;
        $transjaction->narration = $pl_installment->narration;
        $transjaction->transaction_date = $pl_installment->pl_installment_date;
        $transjaction->credit_amount = $pl_installment->total_payment_loan_installment_amount;
        if ($loan_blance == null) {
            $transjaction->loan_blance = -$pl_installment->total_payment_loan_installment_amount;
        } else {
            $transjaction->loan_blance = $loan_blance->loan_blance - $pl_installment->total_payment_loan_installment_amount;
        }
        if ($pre_transaction == null) {
            $transjaction->blance = -$pl_installment->total_payment_loan_installment_amount;
        } else {
            $transjaction->blance = $pre_transaction->blance - $pl_installment->total_payment_loan_installment_amount;
        }
        $transjaction->save();

        $next_dates = PaymentLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transjaction->transaction_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance -= $request->total_payment_loan_installment_amount;
            if ($next_date->ins_payment_id == $request->loan_id) {
                $next_date->loan_blance -= $request->total_payment_loan_installment_amount;
            }
            $next_date->update();
        }
    }

    public function addPaymentLoanInstallment(Request $request)
    {
        $this->plInstallmentValidation($request);
        $this->allValidation($request);
        $pl_installment = new PLInstallment();
        $this->plInstallmentBasic($request, $pl_installment);
        $pl_installment->location = Session::get('location');
        $pl_installment->save();
        $this->savePaymentLoanTransaction($request, $pl_installment);
        if ($request->cash) {
            $this->savePLInstallmentCash($request, $pl_installment);
        }
        if ($request->bank) {
            $this->savePLInstallmentBank($request, $pl_installment);
        }
        if ($request->cheque) {
            $this->chequeBookFunction($request, $pl_installment);
        }
        return 'Payment Loan Installment Saved Successfully...';
    }

    public function getAllPaymentLoanInstallment()
    {
        $installments = PLInstallment::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'installments' => $installments
        ]);
    }

    public function editPaymentLoanInstallment($id)
    {
        $installment = PLInstallment::with('cashs', 'banks', 'cheques')->where('id', $id)->first();
        return response()->json([
            'installment' => $installment
        ]);
    }

    public function updatePLCashBook($request, $pl_installment)
    {
        $cash_book = CashBook::where('pl_installment_id', $pl_installment->id)->first();
        if ($cash_book != null) {
            $old_amount = $cash_book->debit_cash_amount;
            $next_same_date_cashs = CashBook::where('id', '>', $cash_book->id)->where('cash_date', $cash_book->cash_date)->get();
            foreach ($next_same_date_cashs as $next_same_date_cash) {
                $next_same_date_cash->blance -= $old_amount;
                if ($next_same_date_cash->branch_id == $cash_book->branch_id) {
                    $next_same_date_cash->branch_blance -= $old_amount;
                }
                $next_same_date_cash->update();
            }
            $next_date_cashs = CashBook::where('cash_date', '>', $cash_book->cash_date)->get();
            foreach ($next_date_cashs as $next_date_cash) {
                $next_date_cash->blance -= $old_amount;
                if ($next_date_cash->branch_id == $cash_book->branch_id) {
                    $next_date_cash->branch_blance -= $old_amount;
                }
                $next_date_cash->update();
            }
            $cash_book->delete();
        }
        if ($request->cash) {
            $this->savePLInstallmentCash($request, $pl_installment);
        }
    }

    public function updatePLInstallmentBank($request, $pl_installment)
    {
        $bank_books = BankBook::where('pl_installment_id', $request->id)->get();
        foreach ($bank_books as $bank_book) {
            $old_amount = $bank_book->debit_bank_amount;
            $next_same_bank_books = BankBook::where('bank_date', $bank_book->bank_date)->where('id', '>', $bank_book->id)->get();
            foreach ($next_same_bank_books as $next_same_bank_book) {
                $next_same_bank_book->blance -= $old_amount;
                if ($next_same_bank_book->bank_name == $bank_book->bank_name) {
                    $next_same_bank_book->bank_blance -= $old_amount;
                }
                $next_same_bank_book->update();
            }
            $next_bank_books = BankBook::where('bank_date', '>', $bank_book->bank_date)->orderBy('bank_date', 'asc')->get();
            foreach ($next_bank_books as $next_bank_book) {
                $next_bank_book->blance -= $old_amount;
                if ($next_bank_book->bank_name == $bank_book->bank_name) {
                    $next_bank_book->bank_blance -= $old_amount;
                }
                $next_bank_book->update();
            }
            $bank_book->delete();
        }
        if ($request->bank) {
            $this->savePLInstallmentBank($request, $pl_installment);
        }
    }

    protected function updateChequeBook($request, $pl_installment)
    {
        $cheque_books = ChequeBook::where('pl_installment_id', $pl_installment->id)->get();
        foreach ($cheque_books as $cheque_book) {
            $cheque_book->delete();
        }
        if ($request->cheque) {
            $this->chequeBookFunction($request, $pl_installment);
        }
    }

    public function updatePLTransaction($request, $pl_installment)
    {
        $transaction = PaymentLoanTransaction::where('pl_installment_id', $pl_installment->id)->first();
        $old_amount = $transaction->credit_amount;
        $next_same_date_transactions = PaymentLoanTransaction::where('transaction_date', $transaction->transaction_date)->where('id', '>', $transaction->id)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction) {
            $next_same_date_transaction->blance += $old_amount;
            if ($next_same_date_transaction->ins_payment_id == $transaction->ins_payment_id) {
                $next_same_date_transaction->loan_blance += $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = PaymentLoanTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $transaction->transaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction) {
            $next_date_transaction->blance += $old_amount;
            if ($next_date_transaction->ins_payment_id == $transaction->ins_payment_id) {
                $next_date_transaction->loan_blance += $old_amount;
            }
            $next_date_transaction->update();
        }
        $transaction->delete();
        $this->savePaymentLoanTransaction($request, $pl_installment);
    }

    public function udpatePaymentLoanInstallment(Request $request)
    {
        $this->plInstallmentValidation($request);
        $this->allValidation($request);
        $pl_installment = PLInstallment::with('cashs', 'banks', 'cheques')->where('id', $request->id)->first();
        $this->plInstallmentBasic($request, $pl_installment);
        $pl_installment->save();
        $this->updatePLCashBook($request, $pl_installment);
        $this->updatePLInstallmentBank($request, $pl_installment);
        $this->updateChequeBook($request, $pl_installment);
        $this->updatePLTransaction($request, $pl_installment);
        return "update payment loan transaction";
    }

    public function getAllPLLoanInstallment($search)
    {
        $payment_loans_id = [];
        $payment_loans = PaymentLoan::orderBy('pl_name', 'asc')
            ->where('pl_name', 'like', $search . '%')
            ->get();
        foreach ($payment_loans as $key => $payment_loan) {
            $payment_loans_id[$key] = $payment_loan->id;
        }
        $installments = PLInstallment::orderBy('pl_installment_date')
            ->where('id', $search)
            ->orWhere('pl_installment_date', 'like', $search . '%')
            ->orWhere('total_payment_loan_installment_amount', 'like', $search . '%')
            ->orWhereIn('loan_id', $payment_loans_id)
            ->paginate(10);
        return response()->json([
            'installments' => $installments
        ]);
    }
}
