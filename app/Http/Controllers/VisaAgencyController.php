<?php

namespace App\Http\Controllers;

use App\model\VisaAgency;
use Illuminate\Http\Request;

class VisaAgencyController extends Controller
{
    protected function visaAgencyValidation($request){
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required|min:11|numeric',
            'address' => 'required',
        ]);
    }
    protected function visaAgencyBasic($request, $visa_agency){
        $visa_agency->name = $request->name;
        $visa_agency->company_name = $request->company_name;
        $visa_agency->email_address = $request->email_address;
        $visa_agency->phone_number = $request->phone_number;
        $visa_agency->address = $request->address;
    }

    public function addVisaAgency(Request $request){
        $this->visaAgencyValidation($request);
        $visa_agency = new VisaAgency();
        $this->visaAgencyBasic($request, $visa_agency);
        $visa_agency->save();
        return 'save';
    }
    public function getAllVisaAgency(){
        $visa_agency = VisaAgency::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'visa_agency' => $visa_agency
        ]);
    }
    public function deleteVisaAgency($id){
        $visa_agency = VisaAgency::where('id', $id)->first();
        $visa_agency->delete();
        return 'Deleted';
    }

    public function editVisaAgency($id){
        $visa_agency = VisaAgency::where('id', $id)->first();
        return response()->json([
            'visa_agency' => $visa_agency
        ]);
    }
    public function updateVisaAgency(Request $request){
        $this->visaAgencyValidation($request);
        $visa_agency = VisaAgency::where('id', $request->id)->first();
        $this->visaAgencyBasic($request, $visa_agency);
        $visa_agency->update();
        return 'updated';

    }
}
