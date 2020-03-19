<?php

namespace App\Http\Controllers;

use App\model\Agency;
use App\model\Guest;
use App\model\Staff;
use App\model\SuplierTransaction;
use Illuminate\Http\Request;
use Session;

class SuplierController extends Controller
{
    protected function suplierValidation($request)
    {
        $request->validate([
            'name' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required|email',
            'country' => 'required',
            'product' => 'required',
        ]);
    }

    protected function suplierBasic($request, $agency)
    {
        $agency->name = $request->name;
        $agency->contact_person = $request->contact_person;
        $agency->phone_number = $request->phone_number;
        $agency->email_address = $request->email_address;
        $agency->country = $request->country;
        $agency->product = $request->product;
    }

    public function addSuplier(Request $request)
    {
        $this->suplierValidation($request);
        $agency = new Agency();
        $this->suplierBasic($request, $agency);
        $agency->save();
        return 'Success';
    }

    public function getAllSuplier()
    {
        $supliers = Agency::with(['countryt', 'transactions' => function ($q) {
            $q->select('id', 'transaction_date', 'suplier_id', 'suplier_balance')->orderBy('transaction_date', 'desc')->orderBy('id', 'desc');
        }])->orderBy('name')->paginate(10);
        return response()->json([
            'supliers' => $supliers
        ]);
    }

    public function editSuplier($id)
    {
        $user_type = Session::get('user_type');
        $suplier = Agency::where('id', $id)->first();
        return response()->json([
            'suplier' => $suplier,
            'user_type' => $user_type
        ]);
    }

    public function updateSuplier(Request $request)
    {
        $this->suplierValidation($request);
        $suplier = Agency::where('id', $request->id)->first();
        $this->suplierBasic($request, $suplier);
        $suplier->update();
        return 'Success';
    }

    public function getAllActiveSuplier()
    {
        $supliers = Agency::orderBy('name')->select('id', 'name')->get();
        return response()->json([
            'supliers' => $supliers
        ]);
    }

    public function getAllSuplierSearch($search)
    {
        $supliers = Agency::with(['countryt', 'transactions' => function ($q) {
            $q->select('id', 'transaction_date', 'suplier_id', 'suplier_balance')->orderBy('transaction_date', 'desc')->orderBy('id', 'desc');
        }])->where('id', 'like', $search)->orWhere('contact_person', 'like', $search . '%')->orWhere('name', 'like', $search . '%')->orWhere('phone_number', 'like', $search . '%')->orWhere('email_address', 'like', $search . '%')->orderBy('name')->paginate(10);
        return response()->json([
            'supliers' => $supliers
        ]);
    }

    public function getAllSuplierTransaction($id)
    {
        $transjactions = SuplierTransaction::where('suplier_id', $id)->orderBy('transaction_date', 'asc')->paginate(10);
        return response()->json([
            'transjaction' => $transjactions
        ]);
    }

    public function getAllSuplierTransactionSearch($id, $search)
    {
        $transjactions = SuplierTransaction::where('suplier_id', $id)->where('transaction_date', 'like', $search . '%')->orderBy('transaction_date', 'asc')->paginate(10);
        return response()->json([
            'transjaction' => $transjactions
        ]);
    }
}
