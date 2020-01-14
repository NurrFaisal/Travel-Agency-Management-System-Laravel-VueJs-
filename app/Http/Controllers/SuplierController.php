<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Staff;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function getAllSuplier(){
        $all_suplier = Guest::where('category', 3)->orWhere('category', 4)->select('id', 'name')->get();
        return response()->json([
           'all_suplier' =>  $all_suplier
        ]);
    }
    public function getAllReference(){
        $all_reference = Guest::where('category', 1)->orWhere('category', 2)->get();
        return response()->json([
            'all_reference' => $all_reference
        ]);
    }
    public function getAllVisaStaff(){
        $all_visa_staff = Staff::where('department', 4)->select('id', 'first_name', 'last_name')->get();
        return response()->json([
            'all_visa_staff' => $all_visa_staff
        ]);
    }
}
