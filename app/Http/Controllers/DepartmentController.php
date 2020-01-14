<?php

namespace App\Http\Controllers;

use App\model\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function addDepartment(Request $request){
        $department = new Department();
        $department->slug = str_slug($request->department_name);
        $department->department_name = $request->department_name;
        $department->save();
        return 'save';
    }
    public function allDepartment(){
        $department = Department::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'department' => $department
        ]);
    }
    public function editDepartment($id){
        $department = Department::find($id);
        return response()->json([
            'department' => $department
        ]);
    }
    public function updateDepartment(Request $request){
        $request->validate([
            'department_name' => 'required',
        ]);
        $department = Department::where('id', $request->id)->first();
        $department->slug = str_slug($request->department_name);
        $department->department_name = $request->department_name;
        $department->update();
        return 'update';
    }
    public function deleteDepartment($id){
        $department = Department::find($id);
        $department->delete();
        return 'Deleted';
    }
}
