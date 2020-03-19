<?php

namespace App\Http\Controllers;

use App\model\Bank;
use App\model\BankBook;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function addBank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required'
        ]);
        $bank = new Bank();
        $bank->bank_name = $request->bank_name;
        $bank->save();
        return 'New Bank Added Successfully';
    }

    public function getAllBank()
    {
        $banks = Bank::with(['bank_bookt' => function ($q) {
            $q->select('bank_name', 'debit_bank_amount', 'credit_bank_amount', 'blance', 'bank_blance')->orderBy('bank_date', 'desc');
        }])->orderBy('updated_at', 'asc')->get();
        $bank_book_blance = BankBook::select('blance')->orderBy('bank_date', 'desc')->first();
        return response()->json([
            'banks' => $banks,
            'bank_book_blance' => $bank_book_blance
        ]);
    }

    public function editBank($id)
    {
        $bank = Bank::where('id', $id)->first();
        return response()->json([
            'bank' => $bank
        ]);
    }

    public function updateBank(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'bank_name' => 'required'
        ]);
        $bank = Bank::where('id', $request->id)->first();
        $bank->bank_name = $request->bank_name;
        $bank->update();
        return 'Bank Updated Successfully';
    }

    public function deleteBank($id)
    {
        $bank = Bank::where('id', $id)->first();
        $bank->delete();
        return 'Bank Deleted Successfully';
    }

    public function getAllModuleBank()
    {
        $banks = Bank::orderBy('updated_at', 'asc')->get();
        return response()->json([
            'banks' => $banks
        ]);
    }
}
