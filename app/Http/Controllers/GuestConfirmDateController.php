<?php

namespace App\Http\Controllers;

use App\model\Package;
use App\model\Transjaction;
use App\PackageDay;
use Illuminate\Http\Request;
use Session;

class GuestConfirmDateController extends Controller
{
    public function getAllPackageConfirmDate(){
        $user_type = Session::get('user_type');
        $guest_confirm_date = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('state', 5)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'guest_confirm_date' => $guest_confirm_date,
            'user_type' => $user_type
        ]);
    }
    protected function guestConfirmationValidation($request){
        $request->validate([
            'id' => 'required',
            'total_qty' => 'required',
            'total_total_price' => 'required',
            'grand_total_price' => 'required',
            'confirm_date' => 'required|date',
            'journey_date' => 'required|date',
            'return_date' => 'required|date',
        ]);
    }
    protected function addGuestconfirmationBasic($request, $package){
        $package->adult_qty = $request->adult_qty;
        $package->adult_service = $request->adult_service;
        $package->adult_price = $request->adult_price;
        $package->adult_total_price = $request->adult_total_price;
        $package->child_qty = $request->child_qty;
        $package->child_service = $request->child_service;
        $package->child_price = $request->child_price;
        $package->child_total_price = $request->child_total_price;
        $package->infant_qty = $request->infant_qty;
        $package->infant_service = $request->infant_service;
        $package->infant_price = $request->infant_price;
        $package->infant_total_price = $request->infant_total_price;
        $package->total_qty = $request->total_qty;
        $package->total_total_price = $request->total_total_price;
        $package->ex_night_qty = $request->ex_night_qty;
        $package->ex_night_note = $request->ex_night_note;
        $package->ex_night_price = $request->ex_night_price;
        $package->ex_night_total_price = $request->ex_night_total_price;
        $package->ex_site_seeing_qty = $request->ex_site_seeing_qty;
        $package->ex_site_seeing_note = $request->ex_site_seeing_note;
        $package->ex_site_seeing_price = $request->ex_site_seeing_price;
        $package->ex_site_seeing_total_price = $request->ex_site_seeing_total_price;
        $package->airport_rd_qty = $request->airport_rd_qty;
        $package->airport_rd_note = $request->airport_rd_note;
        $package->airport_rd_price = $request->airport_rd_price;
        $package->airport_rd_total_price = $request->airport_rd_total_price;
        $package->others_qty = $request->others_qty;
        $package->others_note = $request->others_note;
        $package->others_price = $request->others_price;
        $package->others_total_price = $request->others_total_price;
        $package->grand_total_price = $request->grand_total_price;
        $package->confirm_date = $request->confirm_date;
        $package->journey_date = $request->journey_date;
        $package->return_date = $request->return_date;

        $package->extra_note = $request->extra_note;

        $package->first_qty = $request->first_qty;
        $package->first_price = $request->first_price;
        $package->first_total_price = $request->first_total_price;

        $package->second_qty = $request->second_qty;
        $package->second_price = $request->second_price;
        $package->second_total_price = $request->second_total_price;

        $package->third_qty = $request->third_qty;
        $package->third_price = $request->third_price;
        $package->third_total_price = $request->third_total_price;
    }
    public function addGuestConfirmation(Request $request){
        $this->guestConfirmationValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->addGuestconfirmationBasic($request, $package);
        $package->state = 5;
        $package->update();
        $this->transjaction($request, $package);
        return 'Guest Confirmation Added Successfully';
    }



    public function editGuestConfirmation($id){
        $user_type = Session::get('user_type');
        $guest_confirmation = Package::with(['package_days', 'guestt' => function($q){$q->select('id', 'name', 'phone_number');}])->where('id', $id)->first();
        return response()->json([
            'guest_confirmation' => $guest_confirmation,
            'user_type' => $user_type
        ]);
    }
    protected function updateGuestConfirmationValidation($request){
        $request->validate([
            'guest' => 'required',
            'package_type' => 'required',
            'country' => 'required',
            'query_date' => 'required',
            'destination' => 'required',
            'duration' => 'required',
            'adult_qty' => 'required',
            'total_qty' => 'required',
            'hotel_cat' => 'required',
            'room_qty' => 'required',
            'room_cat' => 'required',

            'package_days*day' => 'required',
            'package_days*day_date' => 'required',
            'package_days*over_night' => 'required',
            'package_days*tour_itinerary' => 'required',
            'package_days*breakfast' => 'required',
            'package_days*lunch' => 'required',
            'package_days*dinner' => 'required',

            'narration' => 'required',
            'iti_submit_to_guest_date' => 'required',

        ]);
    }
    protected function updateGuestConfirmationBasic($request, $package){
        $package->guest = $request->guest;
        $package->package_type = $request->package_type;
        $package->country = $request->country;
        $package->query_date = $request->query_date;
        $package->destination = $request->destination;
        $package->duration = $request->duration;
        $package->hotel_cat = $request->hotel_cat;
        $package->room_qty = $request->room_qty;
        $package->room_cat = $request->room_cat;
        $package->king_size = $request->king_size;
        $package->couple_size = $request->couple_size;
        $package->twin_size = $request->twin_size;
        $package->triple_size = $request->triple_size;
        $package->quared_size = $request->quared_size;
        $package->total_bed_qty = $request->total_bed_qty;
        $package->narration = $request->narration;
        $package->iti_submit_to_guest_date = $request->iti_submit_to_guest_date;
    }
    protected function packageDay($request, $package){
        $package_day_arrys = $request->package_days;
        $package_day_arrys_count = count($package_day_arrys);
        for ($i=0; $i<$package_day_arrys_count; $i++){
            $package_day = new PackageDay();
            $package_day->package_id = $package->id;
            $package_day->day = $package_day_arrys[$i]['day'];
            $package_day->day_date = $package_day_arrys[$i]['day_date'];
            $package_day->over_night = $package_day_arrys[$i]['over_night'];
            $package_day->tour_itinerary = $package_day_arrys[$i]['tour_itinerary'];
            $package_day->breakfast = $package_day_arrys[$i]['breakfast'];
            $package_day->lunch = $package_day_arrys[$i]['lunch'];
            $package_day->dinner = $package_day_arrys[$i]['dinner'];
            $package_day->save();
        }
    }
    public function updateGuestConfirmation(Request $request){
        $this->guestConfirmationValidation($request);
        $this->updateGuestConfirmationValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->updateGuestConfirmationBasic($request, $package);
        $this->addGuestConfirmationBasic($request, $package);
        $package->update();
        $package_days = PackageDay::where('package_id', $request->id)->get();
        foreach ($package_days as $package_day){
            $package_day->delete();
        }
        $this->packageDay($request, $package);
        $this->updateTransjactionBlance($request, $package);
        $this->transjaction($request, $package);
        return 'Guest Confirmation Updated Successfully';
    }
    protected function transjaction($request, $package){
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $package->confirm_date)->where('guest_id', $package->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        if($pre_guest_transjaction_blance == null){
            $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $package->confirm_date)->where('guest_id', $package->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        }
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $package->confirm_date)->where('staff_id', $package->staff)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if($pre_staff_transjaction_blance == null){
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $package->confirm_date)->where('staff_id', $package->staff)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }
        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $package->confirm_date)->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if($pre_transjaction_blance == null){
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $package->confirm_date)->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $package->guest;
        $transjaction->staff_id = $package->staff;
        $transjaction->pack_id = $package->id;
        $transjaction->narration = $package->narration;
        $transjaction->transjaction_date = $package->confirm_date;
        $transjaction->debit_amount = $package->grand_total_price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = $package->grand_total_price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $package->grand_total_price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = $package->grand_total_price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $package->grand_total_price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = $package->grand_total_price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance + $package->grand_total_price;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $package->grand_total_price;
            if($next_date->guest_id == $package->guest){
                $next_date->guest_blance += $package->grand_total_price;
            }
            if($next_date->staff_id == $package->staff){
                $next_date->staff_blance += $package->grand_total_price;
            }
            $next_date->update();
        }

    }
    protected function updateTransjactionBlance($request, $package){
        $transjaction = Transjaction::where('pack_id', $package->id)->first();
        $old_amount = $transjaction->debit_amount;
        $next_same_date_transactions = Transjaction::where('id', '>', $transjaction->id)->where('transjaction_date', $transjaction->transjaction_date)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction){
            $next_same_date_transaction->blance -= $old_amount;
            if($next_same_date_transaction->guest_id == $transjaction->guest_id){
                $next_same_date_transaction->guest_blance -= $old_amount;
            }
            if($next_same_date_transaction->staff_id == $transjaction->staff_id){
                $next_same_date_transaction->staff_blance -= $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = Transjaction::where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction){
            $next_date_transaction->blance -= $old_amount;
            if($next_date_transaction->guest_id == $transjaction->guest_id){
                $next_date_transaction->guest_blance -= $old_amount;
            }
            if($next_date_transaction->staff_id == $transjaction->staff_id){
                $next_date_transaction->staff_blance -= $old_amount;
            }
            $next_date_transaction->update();
        }
        $transjaction->delete();
    }
}
