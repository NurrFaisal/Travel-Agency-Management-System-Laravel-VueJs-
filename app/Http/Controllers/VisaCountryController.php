<?php

namespace App\Http\Controllers;

use App\model\VisaCountry;
use Illuminate\Http\Request;

class VisaCountryController extends Controller
{
    public function addVisaCountry(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $visa_country = new VisaCountry();
        $visa_country->name = $request->name;
        $visa_country->save();
        return 'saved';
    }

    public function getAllVisaCountry(){
        $visa_country = VisaCountry::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'visa_country' => $visa_country
        ]);
    }

    public function deleteVisaCountry($id){
        return 'Not Perfect';
        $visa_country = VisaCountry::where('id', $id)->first();
        $visa_country->delete();
        return 'delete';
    }

    public function editVisaCountry($id){
        $visa_country = VisaCountry::where('id', $id)->first();
        return response()->json([
            'visa_country' => $visa_country
        ]);
    }
    public function updateVisaCountry(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $visa_country = VisaCountry::where('id', $request->id)->first();
        $visa_country->name = $request->name;
        $visa_country->update();
        return 'update';
    }
}
