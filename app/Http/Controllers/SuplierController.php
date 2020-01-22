<?php

namespace App\Http\Controllers;

use App\model\Agency;
use App\model\Guest;
use App\model\Staff;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    protected function suplierValidation($request){
        $request->validate([
            'name' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required|email',
            'country' => 'required',
            'product' => 'required',
        ]);
    }

    protected function suplierBasic($request, $agency){
        $agency->name = $request->name;
        $agency->contact_person = $request->contact_person;
        $agency->phone_number = $request->phone_number;
        $agency->email_address = $request->email_address;
        $agency->country = $request->country;
        $agency->product = $request->product;
    }
    public function addSuplier(Request $request){
        $this->suplierValidation($request);
        $agency = new Agency();
        $this->suplierBasic($request, $agency);
        $agency->save();
        return 'Success';
    }

    public function getAllSuplier(){
        $supliers = Agency::with('countryt')->orderBy('name')->paginate(10);
        return response()->json([
           'supliers' =>  $supliers
        ]);
    }
    public function editSuplier($id){
        $suplier = Agency::where('id', $id)->first();
        return response()->json([
            'suplier' => $suplier
        ]);
    }
    public function updateSuplier(Request $request){
        $this->suplierValidation($request);
        $suplier = Agency::where('id', $request->id)->first();
        $this->suplierBasic($request, $suplier);
        $suplier->update();
        return 'Success';
    }
    public function getAllActiveSuplier(){
        $supliers = Agency::orderBy('name')->select('id', 'name')->get();
        return response()->json([
            'supliers' => $supliers
        ]);
    }
}
