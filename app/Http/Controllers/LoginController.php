<?php

namespace App\Http\Controllers;

use App\model\Staff;
use Illuminate\Http\Request;
use Validator;
use Session;

class LoginController extends Controller
{
    public function login(){
        return view('cosmosHoliday.login');
    }
    public function loginInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'email_address' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            session()->flash('color', 'red');
            Session::flash('message', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
        $staff = Staff::where('email_address' , $request->email_address)->select('id','first_name', 'last_name', 'email_address', 'password', 'image', 'user_type', 'location')->first();
        if($staff){
            if (password_verify($request->password, $staff->password)){
                Session::put('staff_id', $staff->id);
                Session::put('staff_name', $staff->first_name.' '.$staff->last_name);
                Session::put('department', $staff->department);
                Session::put('user_type', $staff->user_type);
                Session::put('location', $staff->location);
                Session::put('image', $staff->image);
                return redirect('/dashboard');
            }else{
                session()->flash('color', 'red');
                session()->flash('message', 'Invalid Password !!!');
                return redirect()->back()->withInput();
            }
        }else{
            session()->flash('color', 'red');
            session()->flash('message', 'Invalid Email Address !!!');
            return redirect()->back()->withInput();
        }

    }

    public function logout(Request $request){
        $request->session()->invalidate();
        session()->flash('color', 'red');
        session()->flash('message', 'You Are Logout From This Application !!!');
        return redirect('/');
    }
}
