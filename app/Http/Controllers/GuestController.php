<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Transjaction;
use Illuminate\Http\Request;
use Session;

class GuestController extends Controller
{
    protected function guestValidation($request){
        $request->validate([
            'branch' => 'required',
            'name' => 'required|max:191',
            'guest_type' => 'required|numeric',
            'designation' => 'required|numeric',
            'rf_staff' => 'required|numeric',
            'rf_guest' => 'required|max:191',
            'email_address' => 'required|max:191',
            'alt_email_address' => 'required|max:191',
            'phone_number' => 'required|max:15|min:11',
            'alt_phone_number' => 'required|max:15|min:11',
            'address' => 'required',
            'status' => 'required|numeric',
        ]);
    }
    protected function uniqueEmailandPhoneValidation($request){
        $request->validate([
            'email_address' => 'required|email|unique:guests',
            'phone_number' => 'required|unique:guests',
        ]);
    }
    protected function guestBasic($request, $guest){
        $guest->branch = $request->branch;
        $guest->name = $request->name;
        $guest->guest_type = $request->guest_type;
        $guest->designation = $request->designation;
        $guest->rf_staff = $request->rf_staff;
        $guest->rf_guest = $request->rf_guest;
        $guest->email_address = $request->email_address;
        $guest->alt_email_address = $request->alt_email_address;
        $guest->phone_number = $request->phone_number;
        $guest->alt_phone_number = $request->alt_phone_number;
        $guest->address = $request->address;
        $guest->type = $request->type;
        $guest->status = $request->status;
    }
    public function addGuest(Request $request){
        $this->guestValidation($request);
        $this->uniqueEmailandPhoneValidation($request);
        $guest = new Guest();
        $this->guestBasic($request, $guest);
        $guest->save();
        return 'success';
    }

    public function getAllGuest(){
        $user_type = Session::get('user_type');
        if($user_type == 'super-admin' || $user_type == 'admin'){
            $guests = Guest::with(['Staff' =>function($q){$q->select('id', 'first_name', 'last_name');}, 'transjactions'=>function($q){$q->select('id','guest_id', 'transjaction_date',  'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc');}])
                ->orderBy('updated_at', 'desc')
                ->select('id', 'name', 'phone_number', 'email_address', 'rf_staff', 'status')
                ->paginate(10);
        }else{
            $guests = Guest::with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}, 'transjactions' => function($q){$q->select('id', 'guest_id', 'transjaction_date', 'guest_blance')->orderBy('transjaction_date', 'desc');}])->where('rf_staff', Session::get('staff_id'))->paginate(10);
        }

        return response()->json([
            'guests' => $guests,
            'user_type' => $user_type
        ]);
    }
    public function dueGuest(){
       
    }
    public function getAllGuestSearch($search){
        $user_type = Session::get('user_type');
        if($user_type == 'super-admin' || $user_type == 'admin' || $user_type == 'operation'){
            $guests = Guest::with(['Staff' =>function($q){$q->select('id', 'first_name', 'last_name');}, 'transjactions'=>function($q){$q->select('id','guest_id', 'transjaction_date',  'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->first();}])
                ->where('name', 'like', $search.'%')
                ->orWhere('phone_number', 'like', $search.'%')
                ->orWhere('alt_phone_number', 'like', $search.'%')
                ->orWhere('email_address', 'like', $search.'%')
                ->orWhere('alt_email_address', 'like', $search.'%')
                ->orWhere('id', 'like', $search)
                ->orderBy('updated_at', 'desc')->select('id', 'name', 'phone_number', 'email_address', 'rf_staff', 'status')
                ->paginate(10);
        }else{
            $guests = Guest::where('name', 'like', $search.'%')
                ->where('rf_staff',Session::get('staff_id'))
                ->orWhere('phone_number', 'like', $search.'%')
                ->orWhere('alt_phone_number', 'like', $search.'%')
                ->orWhere('email_address', 'like', $search.'%')
                ->orWhere('alt_email_address', 'like', $search.'%')
                ->orWhere('id', 'like', $search)
                ->with(['Staff' =>function($q){$q->select('id', 'first_name', 'last_name');}, 'transjactions'=>function($q){$q->select('id','guest_id', 'transjaction_date',  'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->first();}])
                ->orderBy('updated_at', 'desc')->select('id', 'name', 'phone_number', 'email_address', 'rf_staff', 'status')
                ->paginate(10);
        }
        return response()->json([
            'guests' => $guests,
            'user_type' => $user_type
        ]);

    }

    public function deleteGuest($id){
        $guest = Guest::where('id', $id)->first();
        $transjaction = Transjaction::where('guest_id', $id)->get();
        if($transjaction->isEmpty()){
            $guest->delete();
            return 'Deleted';
        }
        return 'NotDeleted';
    }
    public function editGuest($id){
        $user_type = Session::get('user_type');
        $guest = Guest::with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->where('id', $id)->first();
        return response()->json([
            'guest' => $guest,
            'user_type' => $user_type
        ]);
    }
    public function updateGuest(Request $request){
        $this->guestValidation($request);
        $guest = Guest::where('id', $request->id)->first();
        if($request->email_address != $guest->email_address){
            $request->validate([
                'email_address' => 'required|email|unique:staff',
            ]);
            $guest->email_address = $request->email_address;
        }
        $this->guestBasic($request, $guest);
        $guest->update();
        return 'update';
    }
    public function getAllGuestRefernce($query){
        $guests = Guest::where('name', 'like', $query.'%')->orWhere('phone_number', 'like', $query.'%')->select('id', 'name', 'phone_number')->orderBy('name', 'asc')->get();
        return response()->json([
            'guests' => $guests
        ]);
    }
    public function getAllGuestTransaction($id){
        $transjactions = Transjaction::with(['staff'=>function($q){$q->select('id', 'first_name', 'last_name', 'phone_number');}])->orderBy('transjaction_date', 'asc')->where('guest_id', $id)->paginate(10);
        return response()->json([
            'transjactions' => $transjactions
        ]);
    }
    public function getAllGuestTransactionSearch($id, $search){
        $transjactions = Transjaction::with(['staff'=>function($q){$q->select('id', 'first_name', 'last_name', 'phone_number');}])->where('transjaction_date', 'like', $search.'%')->orderBy('transjaction_date', 'asc')->where('guest_id', $id)->paginate(10);
        return response()->json([
            'transjactions' => $transjactions
        ]);
    }




}
