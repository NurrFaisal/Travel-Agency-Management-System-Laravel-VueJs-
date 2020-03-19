<?php

namespace App\Http\Controllers;

use App\model\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
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

    public function getAllAgency()
    {
        $agency = Agency::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'agency' => $agency
        ]);
    }

    public function editSuplier($id)
    {
        $agency = Agency::where('id', $id)->first();
        return response()->json([
            'agency' => $agency
        ]);
    }

    public function updateSuplier(Request $request)
    {
        $this->suplierValidation($request);
        $agency = Agency::where('id', $request->id)->first();
        $this->suplierBasic($request, $agency);
        $agency->update();
        return 'update';
    }

    public function deleteSuplier($id)
    {
        $agency = Agency::where('id', $id)->first();
        $agency->delete();
        return 'delete';
    }
}
