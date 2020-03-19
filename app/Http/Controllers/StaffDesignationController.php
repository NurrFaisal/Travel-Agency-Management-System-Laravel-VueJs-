<?php

namespace App\Http\Controllers;

use App\model\StaffDesignation;
use Illuminate\Http\Request;

class StaffDesignationController extends Controller
{
    public function addStaffDesignation(Request $request)
    {
        $request->validate([
            'staff_designation' => 'required'
        ]);
        $staff_designation = new StaffDesignation();
        $staff_designation->slug = str_slug($request->staff_designation);
        $staff_designation->staff_designation = $request->staff_designation;
        $staff_designation->save();
        return 'save';
    }

    public function allStaffDesignation()
    {
        $staff_designations = StaffDesignation::orderBy('staff_designation', 'desc')->get();
        return response()->json([
            'staff_designations' => $staff_designations
        ]);
    }

    public function editStaffDesignation($id)
    {
        $staff_designation = StaffDesignation::where('id', $id)->first();
        return response()->json([
            'staff_designation' => $staff_designation
        ]);
    }

    public function updateStaffDesignation(Request $request)
    {
        $request->validate([
            'staff_designation' => 'required'
        ]);
        $staff_desigantion = StaffDesignation::where('id', $request->id)->first();
        $staff_desigantion->slug = str_slug($request->staff_designation);
        $staff_desigantion->staff_designation = $request->staff_designation;
        $staff_desigantion->update();
        return 'update';
    }

    public function deleteStaffDesignation($id)
    {
        $staff_designation = StaffDesignation::find($id);
        $staff_designation->delete();
        return 'delete';
    }
}
