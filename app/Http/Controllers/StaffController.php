<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Staff;
use App\model\Transjaction;
use App\Profit;
use Illuminate\Http\Request;
use Image;
use Session;

class StaffController extends Controller
{
    protected function staffValidation($request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'alt_phone_number' => 'required',
            'address' => 'required',
            'nid' => 'required',
            'passport' => 'required',
            'blood_group' => 'required',
            'designation' => 'required|numeric',
            'staff_id' => 'required|numeric',
            'department' => 'required|numeric',
            'location' => 'required',
            'start_date' => 'required|date',
            'salary' => 'required',
            'first_person_name' => 'required',
            'first_person_phone_number' => 'required',
            'first_person_relationship' => 'required',
            'second_person_name' => 'required',
            'second_person_phone_number' => 'required',
            'second_person_relationship' => 'required',
            'user_type' => 'required',
            'status' => 'required',
        ]);
    }

    protected function uniqueEmailandPhoneValidation($request)
    {
        $request->validate([
            'email_address' => 'required|email|unique:staff',
            'phone_number' => 'required|unique:staff',
        ]);
    }

    protected function pwdValidation($request)
    {
        $request->validate([
            'password' => 'required_with:confirm_password|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);
    }

    protected function pwdValidationUpdate($request)
    {
        $request->validate([
            'password_up' => 'required_with:confirm_password_up|same:confirm_password_up|min:6',
            'confirm_password_up' => 'required',
        ]);
    }

    protected function staffImagesave($request, $staff)
    {
        $str_position = strpos($request->image, ';');
        $sub = substr($request->image, 0, $str_position);
        $ex = explode('/', $sub)[1];
        $image_name = time() . "." . $ex;
        $image = Image::make($request->image)->resize(200, 200);
        $custom_path = '/cosmosHoliday/uploadImage/staff/';
        $upload_path = public_path() . $custom_path;
        $image->save($upload_path . $image_name);
        $staff->image = $custom_path . $image_name;
    }

    protected function pwd($request, $staff)
    {
        $staff->password = bcrypt($request->password);
    }

    protected function emailandphonenumber($request, $staff)
    {
        $staff->email_address = $request->email_address;
        $staff->phone_number = $request->phone_number;
    }

    protected function StaffBasicInfo($request, $staff)
    {
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->date_of_birth = $request->date_of_birth;
        $staff->alt_phone_number = $request->alt_phone_number;
        $staff->address = $request->address;
        $staff->nid = $request->nid;
        $staff->passport = $request->passport;
        $staff->blood_group = $request->blood_group;
//        $staff->image = $request->image;
        $staff->designation = $request->designation;
        $staff->staff_id = $request->staff_id;
        $staff->department = $request->department;
        $staff->location = $request->location;
        $staff->start_date = $request->start_date;
        $staff->salary = $request->salary;
        $staff->first_person_name = $request->first_person_name;
        $staff->first_person_phone_number = $request->first_person_phone_number;
        $staff->first_person_relationship = $request->first_person_relationship;
        $staff->second_person_name = $request->second_person_name;
        $staff->second_person_phone_number = $request->second_person_phone_number;
        $staff->second_person_relationship = $request->second_person_relationship;
        $staff->user_type = $request->user_type;
        $staff->status = $request->status;
    }

    public function addStaff(Request $request)
    {
        $staff = new Staff();
        $this->staffValidation($request);
        $this->pwdValidation($request);
        $this->uniqueEmailandPhoneValidation($request, $staff);
        $this->staffImagesave($request, $staff);
        $this->StaffBasicInfo($request, $staff);
        $this->emailandphonenumber($request, $staff);
        $this->pwd($request, $staff);
        $staff->save();
        return 'save';
    }

    public function getAllStaff()
    {
        $staffs = Staff::with(['transaction' => function ($q) {
            $q->select('id', 'staff_id', 'staff_blance')->orderBy('id', 'desc');
        }])->orderBy('first_name', 'asc')->select('id', 'first_name', 'last_name', 'phone_number', 'image', 'email_address', 'salary', 'status')->paginate(10);
        $staff_count = Staff::count();
        return response()->json([
            'staffs' => $staffs,
            'staff_count' => $staff_count
        ], 200);
    }

    public function getAllStaffForSelect()
    {
        $staffs = Staff::orderBy('first_name')->select('id', 'first_name', 'last_name')->get();
        return response()->json([
            'staffs' => $staffs
        ], 200);
    }

    public function deleteStaff($id)
    {
        $staff = Staff::where('id', $id)->first();
        $public_path = public_path();
        $image_path = $public_path . $staff->image;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }
        $staff->delete();
        return 'delete Staff';
    }

    public function editeStaff($id)
    {
        $user_type = Session::get('user_type');
        $staff = Staff::find($id);
        return response()->json([
            'staff' => $staff,
            'user_type' => $user_type
        ], 200);
    }

    public function updateStaff(Request $request)
    {
        $staff = Staff::where('id', $request->id)->first();
        $this->staffValidation($request);
        if ($request->password_up != '') {
            $this->pwdValidationUpdate($request);
        }
        if ($request->email_address != $staff->email_address) {
            $request->validate([
                'email_address' => 'required|email|unique:staff',
            ]);
            $staff->email_address = $request->email_address;
        }

        if ($request->phone_number != $staff->phone_number) {
            $request->validate([
                'phone_number' => 'required|unique:staff',
            ]);
            $staff->phone_number = $request->phone_number;
        }
        if ($request->image != $staff->image) {
            if (file_exists($staff->image)) {
                unlink($staff->image);
            }
            $this->staffImagesave($request, $staff);
        }
        if ($request->password_up != '') {
            $staff->password = bcrypt($request->password_up);
        }
        $this->StaffBasicInfo($request, $staff);
        $staff->update();
        return 'update';
    }

    public function getAllStaffRefernce($query)
    {
        $staffs = Staff::where('first_name', 'like', $query . '%')->select('id', 'first_name', 'last_name')->orderBy('first_name', 'asc')->get();
        return response()->json([
            'staffs' => $staffs
        ]);
    }

    public function viewStaff($id)
    {
        $staff = Staff::with(['designationt' => function ($q) {
            $q->select('id', 'staff_designation');
        }, 'departmentt' => function ($q) {
            $q->select('id', 'department_name');
        }])->where('id', $id)->first();
        return response()->json([
            'staff' => $staff
        ]);
    }

    public function getAllStaffProfit($id)
    {
        $profits = Profit::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('staff_id', $id)->orderBy('profit_date', 'desc')->paginate(10);
        $sum_profits = Profit::where('staff_id', Session::get('staff_id'))->sum('amount');
        return response()->json([
            'profits' => $profits,
            'sum_profits' => $sum_profits,
        ]);
    }

    public function getAllStaffProfitSearch($id, $search)
    {
        $profits = Profit::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('staff_id', $id)->orderBy('profit_date', 'desc')->where('profit_date', 'like', $search . '%')->paginate(10);
        $sum_profits = Profit::where('staff_id', Session::get('staff_id'))->sum('amount');
        return response()->json([
            'profits' => $profits,
            'sum_profits' => $sum_profits,
        ]);
    }

    public function getAllStaffGuest($id)
    {
        $guests = Guest::with(['transjactions' => function ($q) {
            $q->select('id', 'guest_id', 'transjaction_date', 'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc');
        }])->where('rf_staff', $id)->select('id', 'name', 'email_address', 'phone_number', 'alt_phone_number', 'rf_staff')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'guests' => $guests
        ]);
    }

    public function getAllStaffTransaction($id)
    {
        $transjactions = Transjaction::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->orderBy('transjaction_date', 'asc')->where('staff_id', $id)->paginate(10);
        return response()->json([
            'transjactions' => $transjactions
        ]);
    }

    public function getAllStaffSearch($search)
    {
        $staffs = Staff::with(['transaction' => function ($q) {
            $q->select('id', 'staff_id', 'staff_blance')->orderBy('id', 'desc');
        }])
            ->orderBy('first_name', 'asc')
            ->select('id', 'first_name', 'last_name', 'phone_number', 'image', 'email_address', 'salary', 'status')
            ->where('first_name', 'like', $search . '%')
            ->orwhere('last_name', 'like', $search . '%')
            ->orwhere('phone_number', 'like', $search . '%')
            ->orwhere('alt_phone_number', 'like', $search . '%')
            ->orwhere('email_address', 'like', $search . '%')
            ->paginate(10);
        $staff_count = Staff::count();
        return response()->json([
            'staffs' => $staffs,
            'staff_count' => $staff_count
        ], 200);
    }
}
