<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Transjaction;
use Illuminate\Http\Request;

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
        $guest = new Guest();
        $this->guestBasic($request, $guest);
        $guest->save();
        return 'success';
    }

    public function getAllGuest(){
        $guests = Guest::with(['transjactions'=>function($q){$q->select('id','guest_id', 'transjaction_date',  'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc');}])->orderBy('updated_at', 'desc')->select('id', 'name', 'phone_number', 'email_address', 'status')->paginate(10);
        return response()->json([
            'guests' => $guests
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
        $guest = Guest::with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->where('id', $id)->first();
        return response()->json([
            'guest' => $guest
        ]);
    }
    public function updateGuest(Request $request){
        $this->guestValidation($request);
        $guest = Guest::where('id', $request->id)->first();
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



}
