<?php

namespace App\Http\Controllers;

use App\model\Package;
use App\model\Transjaction;
use App\PackageDay;
use App\Profit;
use Illuminate\Http\Request;
use Session;

class PackageVisaUpdateController extends Controller
{
    public function getAllPackageVisaUpdate(){
        $package_visa_update = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('state', 6)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'package_visa_update' => $package_visa_update
        ]);
    }

    protected function addVisaUpdateValidation($request){
        $request->validate([
            'id' => 'required',
            'total_qty' => 'required',
            'total_total_price' => 'required',
            'grand_total_price' => 'required',
            'journey_date' => 'required|date',
            'return_date' => 'required|date',
            'visa_submit_to_us' => 'required|date',
            'visa_submit_to_em' => 'required|date',
            'visa_done_date' => 'required|date',
            'visa_delivery_to_guest' => 'required|date',
        ]);
    }
    public function addVisaUpdateDateBasic($request, $package){
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

        $package->visa_submit_to_us = $request->visa_submit_to_us;
        $package->visa_submit_to_em = $request->visa_submit_to_em;
        $package->visa_done_date = $request->visa_done_date;
        $package->visa_delivery_to_guest = $request->visa_delivery_to_guest;
    }

    public function addVisaUpdateDate(Request $request){
        $this->addVisaUpdateValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->addVisaUpdateDateBasic($request, $package);
        $package->state = 6;
        $package->update();
        $this->tranjactionUpdateWithOutGuest($request,$package);
        return 'Visa update Successfully';
    }

    protected  function tranjactionUpdateWithOutGuest($request,$package){
        $transjaction = Transjaction::where('pack_id', $request->id)->first();
        $increment_blance = $request->grand_total_price - $transjaction->credit_amount;
        $old_transjaction_credit = $transjaction->credit_amount;
        $old_guest_id = $transjaction->guest_id;
        $transjaction->narration = $package->narration;
        $transjaction->credit_amount = $request->grand_total_price;
        $transjaction->blance = $transjaction->blance - $increment_blance;
        $blance_transjactions = Transjaction::where('id', '>', $transjaction->id)->get();
        foreach ($blance_transjactions as $blance_transjaction){
            $blance_transjaction->blance = $blance_transjaction->blance - $increment_blance;
            $blance_transjaction->update();
        }
        $transjaction->staff_blance = $transjaction->staff_blance - $increment_blance;
        $staff_blance_tranjactions = Transjaction::where('id', '>', $transjaction->id)->where('staff_id', $transjaction->staff_id)->get();
        foreach ($staff_blance_tranjactions as $staff_blance_tranjaction){
            $staff_blance_tranjaction->staff_blance = $staff_blance_tranjaction->staff_blance - $increment_blance;
            $staff_blance_tranjaction->update();
        }
        $transjaction->guest_blance = $transjaction->guest_blance - $increment_blance;
        $transjaction->update();
        $guest_blances = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
        foreach ($guest_blances as $guest_blance){
            $guest_blance->guest_blance = $guest_blance->guest_blance - $increment_blance;
            $guest_blance->update();
        }


    }


    public function editPackageUpdateVisa($id){
        $update_visa = Package::with(['package_days','guestt' => function($q){$q->select('id', 'name', 'phone_number');}])->where('id', $id)->first();
        return response()->json([
            'update_visa' => $update_visa
        ]);
    }

    protected function updateVisaValidation($request){
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
            'visa_submit_to_us' => 'required',
            'visa_submit_to_em' => 'required',
            'visa_done_date' => 'required',
            'visa_delivery_to_guest' => 'required',
        ]);
    }

    protected function updateVisaUpdateBasic($request, $package){
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

        $package->iti_submit_to_guest_date = $request->iti_submit_to_guest_date;
        $package->visa_submit_to_us = $request->visa_submit_to_us;
        $package->visa_submit_to_em = $request->visa_submit_to_em;
        $package->visa_done_date = $request->visa_done_date;
        $package->visa_delivery_to_guest = $request->visa_delivery_to_guest;
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

    protected function updatPackageVisaUpdate(Request $request){
        $this->updateVisaValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->updateVisaUpdateBasic($request, $package);
        $package->update();
        $package_days = PackageDay::where('package_id', $request->id)->get();
        foreach ($package_days as $package_day){
            $package_day->delete();
        }
        $this->packageDay($request, $package);
        $this->updateTransjactionBlance($request);
        return 'Package Update Visa Added Successfully';
    }
    public function updateTransjactionBlance($request){
        $transjaction = Transjaction::where('pack_id', $request->id)->first();
        $increment_blance = $request->grand_total_price - $transjaction->credit_amount;
        $old_transjaction_credit = $transjaction->credit_amount;
        $old_staff_id = $transjaction->staff_id;
        $old_guest_id = $transjaction->guest_id;
        $transjaction->guest_id = $request->guest;
//        $transjaction->staff_id = $request->sell_person;
        $transjaction->narration = $request->narration;
        $transjaction->credit_amount = $request->grand_total_price;
        $transjaction->blance = $transjaction->blance - $increment_blance;
        $blance_transjactions = Transjaction::where('id', '>', $transjaction->id)->get();
        foreach ($blance_transjactions as $blance_transjaction){
            $blance_transjaction->blance = $blance_transjaction->blance - $increment_blance;
            $blance_transjaction->update();
        }
        $transjaction->staff_blance = $transjaction->staff_blance - $increment_blance;
        $staff_blance_tranjactions = Transjaction::where('id', '>', $transjaction->id)->where('staff_id', $transjaction->staff_id)->get();
        foreach ($staff_blance_tranjactions as $staff_blance_tranjaction){
            $staff_blance_tranjaction->staff_blance = $staff_blance_tranjaction->staff_blance - $increment_blance;
            $staff_blance_tranjaction->update();
        }

        if($old_guest_id == $request->guest){
            $transjaction->guest_blance = $transjaction->guest_blance - $increment_blance;
            $transjaction->update();
            $guest_blances = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($guest_blances as $guest_blance){
                $guest_blance->guest_blance = $guest_blance->guest_blance - $increment_blance;
                $guest_blance->update();
            }
        }else{
            $pre_guest_transjaction = Transjaction::where('id', '<', $transjaction->id)->where('guest_id', $request->guest)->orderBy('id', 'desc')->first();
            if($pre_guest_transjaction){
                $transjaction->guest_blance = $pre_guest_transjaction->guest_blance - $request->grand_total_price;
            }else{
                $transjaction->guest_blance = -$request->grand_total_price;
            }
            $transjaction->update();
            $next_old_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($next_old_guest_transjactions as $next_old_guest_transjaction){
                $next_old_guest_transjaction->guest_blance = $next_old_guest_transjaction->guest_blance + $old_transjaction_credit;
                $next_old_guest_transjaction->update();
            }
            $next_new_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $request->guest)->get();
            foreach ($next_new_guest_transjactions as $next_new_guest_transjaction){
                $next_new_guest_transjaction->guest_blance = $next_new_guest_transjaction->guest_blance - $request->grand_total_price;
                $next_new_guest_transjaction->update();
            }
        }
    }
}


