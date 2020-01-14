<?php

namespace App\Http\Controllers;

use App\model\GuestDesignation;
use Illuminate\Http\Request;

class GuestDesignationController extends Controller
{
    public function addGuestDesignation(Request $request){
        $request->validate([
            'guest_designation' => 'required|min:3|max:50'
        ]);
        $guest_designation = new GuestDesignation();
        $guest_designation->slug = str_slug($request->guest_designation);
        $guest_designation->guest_designation = $request->guest_designation;
        $guest_designation->save();
        return 'save';
    }
    public function allGuestDesignation(){
        $all_guest_designations = GuestDesignation::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'all_guest_designations' => $all_guest_designations
        ], 200);
    }
    public function deleteGuestDesignation($id){
        $guest_designation = GuestDesignation::find($id);
        $guest_designation->delete();
        return 'delete';
    }
    public function editGuestDesignation($id){
        $guest_designation_info = GuestDesignation::find($id);
        return response()->json([
            'guest_designation_info' => $guest_designation_info
        ], 200);
    }
    public function updateGuestDesignation(Request $request){
        $request->validate([
            'guest_designation' => 'required'
        ]);
        $guest_designation = GuestDesignation::where('id', $request->id)->first();
        $guest_designation->slug = str_slug($request->guest_designation);
        $guest_designation->guest_designation = $request->guest_designation;
        $guest_designation->update();
        return 'update';
    }
}
