<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Transjaction;
use Illuminate\Http\Request;
use Session;
use DB;

class GuestController extends Controller
{
    protected function guestValidation($request)
    {
        $request->validate([
            'branch' => 'required',
            'name' => 'required|max:191',
            'guest_type' => 'required|numeric',
            'designation' => 'required|numeric',
            'rf_staff' => 'required|numeric',
            'rf_guest' => 'required|max:191',
            'email_address' => 'required|max:191',
            'phone_number' => 'required|max:15|min:11',
            'address' => 'required',
            'pre_due' => 'required',
            'status' => 'required|numeric',
        ]);
    }

    protected function uniqueEmailandPhoneValidation($request)
    {
        $request->validate([
            'email_address' => 'required|email|unique:guests',
            'phone_number' => 'required|unique:guests',
        ]);
    }

    protected function guestBasic($request, $guest)
    {
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
        $guest->pre_due = $request->pre_due;
        $guest->type = $request->type;
        $guest->status = $request->status;
    }

    public function addGuest(Request $request)
    {
        $this->guestValidation($request);
        $this->uniqueEmailandPhoneValidation($request);
        $guest = new Guest();
        $this->guestBasic($request, $guest);
        $guest->save();
        $this->transjaction($request, $guest);
        return 'success';
    }

    protected function transjaction($request, $guest){

        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $guest->created_at)->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if ($pre_staff_transjaction_blance == null) {
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $guest->created_at)->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }
        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $guest->created_at)->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if ($pre_transjaction_blance == null) {
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $guest->created_at)->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $guest->id;
        $transjaction->staff_id = Session::get('staff_id');
        $transjaction->pre_due = $guest->id;
        $transjaction->narration = "Pre Due";
        $transjaction->transjaction_date = $guest->created_at;
        $transjaction->debit_amount = $guest->pre_due;
        $transjaction->guest_blance = $guest->pre_due;

        if ($pre_staff_transjaction_blance == null) {
            $transjaction->staff_blance = $guest->pre_due;
        } else {
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $guest->pre_due;
        }
        if ($pre_transjaction_blance == null) {
            $transjaction->blance = $guest->pre_due;
        } else {
            $transjaction->blance = $pre_transjaction_blance->blance + $guest->pre_due;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $guest->pre_due;
            if ($next_date->staff_id == $guest->rf_staff) {
                $next_date->staff_blance += $guest->pre_due;
            }
            $next_date->update();
        }

    }



    public function getAllGuest()
    {
        $user_type = Session::get('user_type');
        if ($user_type == 'super-admin' || $user_type == 'admin') {
            $guests = Guest::with(['Staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'transjactions' => function ($q) {
                $q->select('id', 'guest_id', 'transjaction_date', 'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc');
            }])
                ->orderBy('updated_at', 'desc')
                ->select('id', 'name', 'phone_number', 'email_address', 'rf_staff', 'status')
                ->paginate(10);
        } else {
            $guests = Guest::with(['Staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'transjactions' => function ($q) {
                $q->select('id', 'guest_id', 'transjaction_date', 'guest_blance')->orderBy('transjaction_date', 'desc');
            }])->where('rf_staff', Session::get('staff_id'))->paginate(10);
        }

        return response()->json([
            'guests' => $guests,
            'user_type' => $user_type
        ]);
    }


    public function dueGuest()
    {

    }

    public function getAllGuestSearch($search)
    {
        $user_type = Session::get('user_type');
        if ($user_type == 'super-admin' || $user_type == 'admin' || $user_type == 'operation') {
            $guests = Guest::with(['Staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'transjactions' => function ($q) {
                $q->select('id', 'guest_id', 'transjaction_date', 'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->first();
            }])
                ->where('name', 'like', $search . '%')
                ->orWhere('phone_number', 'like', $search . '%')
                ->orWhere('alt_phone_number', 'like', $search . '%')
                ->orWhere('email_address', 'like', $search . '%')
                ->orWhere('alt_email_address', 'like', $search . '%')
                ->orWhere('id', 'like', $search)
                ->orderBy('updated_at', 'desc')->select('id', 'name', 'phone_number', 'email_address', 'rf_staff', 'status')
                ->paginate(10);
        } else {
            $guests = Guest::where('name', 'like', $search . '%')
                ->where('rf_staff', Session::get('staff_id'))
                ->orWhere('phone_number', 'like', $search . '%')
                ->orWhere('alt_phone_number', 'like', $search . '%')
                ->orWhere('email_address', 'like', $search . '%')
                ->orWhere('alt_email_address', 'like', $search . '%')
                ->orWhere('id', 'like', $search)
                ->with(['Staff' => function ($q) {
                    $q->select('id', 'first_name', 'last_name');
                }, 'transjactions' => function ($q) {
                    $q->select('id', 'guest_id', 'transjaction_date', 'guest_blance')->orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->first();
                }])
                ->orderBy('updated_at', 'desc')->select('id', 'name', 'phone_number', 'email_address', 'rf_staff', 'status')
                ->paginate(10);
        }
        return response()->json([
            'guests' => $guests,
            'user_type' => $user_type
        ]);

    }

    public function deleteGuest($id)
    {
        $guest = Guest::where('id', $id)->first();
        $transjaction = Transjaction::where('guest_id', $id)->get();
        if ($transjaction->isEmpty()) {
            $guest->delete();
            return 'Deleted';
        }
        return 'NotDeleted';
    }

    public function editGuest($id)
    {
        $user_type = Session::get('user_type');
        $guest = Guest::with(['Staff' => function ($q) {
            $q->select('id', 'first_name', 'last_name');
        }])->where('id', $id)->first();
        return response()->json([
            'guest' => $guest,
            'user_type' => $user_type
        ]);
    }

    public function updateGuest(Request $request)
    {
        $this->guestValidation($request);
        $guest = Guest::where('id', $request->id)->first();
        if ($request->email_address != $guest->email_address) {
            $request->validate([
                'email_address' => 'required|email|unique:staff',
            ]);
            $guest->email_address = $request->email_address;
        }
        $this->guestBasic($request, $guest);
        $guest->update();
        $this->updateTransjactionBlance($request, $guest);
        return 'update';
    }

    protected function updateTransjactionBlance($request, $guest){
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $guest->created_at)->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if ($pre_staff_transjaction_blance == null) {
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $guest->created_at)->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }
        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $guest->created_at)->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if ($pre_transjaction_blance == null) {
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $guest->created_at)->first();
        }
        $transjaction = Transjaction::where('pre_due', $guest->id)->first();
        $old_amount = $transjaction->debit_amount;
        $diffrent_amount = $request->pre_due - $old_amount;
        $transjaction->debit_amount = $request->pre_due;
        $transjaction->guest_blance = $request->pre_due;
        if ($pre_staff_transjaction_blance == null) {
            $transjaction->staff_blance = $guest->pre_due;
        } else {
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $guest->pre_due;
        }
        if ($pre_transjaction_blance == null) {
            $transjaction->blance = $guest->pre_due;
        } else {
            $transjaction->blance = $pre_transjaction_blance->blance + $guest->pre_due;
        }
        $transjaction->update();


        $next_same_date_transactions = Transjaction::where('id', '>', $transjaction->id)->where('transjaction_date', $transjaction->transjaction_date)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction) {
            $next_same_date_transaction->blance += $diffrent_amount;
            if ($next_same_date_transaction->guest_id == $transjaction->guest_id) {
                $next_same_date_transaction->guest_blance += $diffrent_amount;
            }
            if ($next_same_date_transaction->staff_id == $transjaction->staff_id) {
                $next_same_date_transaction->staff_blance += $diffrent_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = Transjaction::where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction) {
            $next_date_transaction->blance += $diffrent_amount;
            if ($next_date_transaction->guest_id == $transjaction->guest_id) {
                $next_date_transaction->guest_blance += $diffrent_amount;
            }
            if ($next_date_transaction->staff_id == $transjaction->staff_id) {
                $next_date_transaction->staff_blance += $diffrent_amount;
            }
            $next_date_transaction->update();
        }

    }


    public function getAllGuestRefernce($query)
    {
        $guests = Guest::where('name', 'like', $query . '%')->orWhere('phone_number', 'like', $query . '%')->select('id', 'name', 'phone_number')->orderBy('name', 'asc')->get();
        return response()->json([
            'guests' => $guests
        ]);
    }

    public function getAllGuestTransaction($id)
    {
        $transjactions = Transjaction::with(['staff' => function ($q) {
            $q->select('id', 'first_name', 'last_name', 'phone_number');
        }])->orderBy('transjaction_date', 'asc')->where('guest_id', $id)->paginate(10);
        return response()->json([
            'transjactions' => $transjactions
        ]);
    }

    public function getAllGuestTransactionSearch($id, $search)
    {
        $transjactions = Transjaction::with(['staff' => function ($q) {
            $q->select('id', 'first_name', 'last_name', 'phone_number');
        }])->where('transjaction_date', 'like', $search . '%')->orderBy('transjaction_date', 'asc')->where('guest_id', $id)->paginate(10);
        return response()->json([
            'transjactions' => $transjactions
        ]);
    }


}
