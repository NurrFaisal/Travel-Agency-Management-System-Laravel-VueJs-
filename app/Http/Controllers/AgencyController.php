<?php

namespace App\Http\Controllers;

use App\model\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    protected function suplierValidation($request){
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required',
            'alt_phone_number' => 'required',
            'address' => 'required',
            'website' => 'required',
            'status' => 'required',
        ]);
    }

    protected function suplierBasic($request, $agency){
        $agency->name = $request->name;
        $agency->company_name = $request->company_name;
        $agency->email_address = $request->email_address;
        $agency->phone_number = $request->phone_number;
        $agency->alt_phone_number = $request->alt_phone_number;
        $agency->address = $request->address;
        $agency->website = $request->website;
        $agency->department = $request->department;
        $agency->status = $request->status;
    }

    public function addSuplier(Request $request){
        $this->suplierValidation($request);
        $agency = new Agency();
        $this->suplierBasic($request, $agency);
        $agency->save();
        return 'Success';
    }

    public function getAllAgency(){
        $agency = Agency::with('department')->orderBy('updated_at', 'desc')->get();
        return response()->json([
            'agency' => $agency
        ]);
    }

    public function editSuplier($id){
        $agency = Agency::where('id', $id)->first();
        return response()->json([
            'agency' => $agency
        ]);
    }
    public function updateSuplier(Request $request){
        $this->suplierValidation($request);
        $agency = Agency::where('id', $request->id)->first();
        $this->suplierBasic($request, $agency);
        $agency->update();
        return 'update';
    }
    public function deleteSuplier($id){
        $agency = Agency::where('id', $id)->first();
        $agency->delete();
        return 'delete';
    }
}
