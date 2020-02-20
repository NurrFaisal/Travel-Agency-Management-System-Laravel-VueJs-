<?php

namespace App\Http\Controllers;

use App\model\FollowUPtoGuest;
use App\model\Package;
use App\PackageDay;
use Illuminate\Http\Request;
use Session;

class GuestReactionController extends Controller
{
    public function getAllPackageGuestReaction(){
        $user_type = Session::get('user_type');
        $guest_reaction = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('state', 4)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'guest_reaction' => $guest_reaction,
            'user_type' => $user_type
        ]);
    }
    protected function guestReactionValidation($request){
        $request->validate([
            'id' => 'required',
            'guest_reaction' => 'required',
            'flw_up_to_guest_date' => 'required',
            'note' => 'required',
            'ftg_confimation' => 'required',
        ]);
    }

    public function addGuestReaction(Request $request){
        $this->guestReactionValidation($request);
        $flw_package = new FollowUPtoGuest();
        $flw_package->package_id = $request->id;
        $flw_package->flw_up_to_guest_date = $request->flw_up_to_guest_date;
        $flw_package->guest_reaction = $request->guest_reaction;
        $flw_package->note = $request->note;
        if($request->ftg_confimation == 1){
            $package = Package::where('id', $request->id)->select('id', 'state')->first();
            $package->state = 4;
            $package->update();
        }
        $flw_package->save();
        return 'Guest Follow Up Added Successfully';
    }


    public function editGuestReaction($id){
        $edit_guest_reaction = Package::with(['package_days','guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('id', $id)->first();
        return response()->json([
            'edit_guest_reaction' => $edit_guest_reaction
        ]);
    }
    protected function updateGuestReacitonValidation($request){
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
    protected function guestReactionBasic($request, $package){
        $package->guest = $request->guest;
        $package->package_type = $request->package_type;
        $package->country = $request->country;
        $package->query_date = $request->query_date;
        $package->destination = $request->destination;
        $package->duration = $request->duration;
        $package->adult_qty = $request->adult_qty;
        $package->child_qty = $request->child_qty;
        $package->infant_qty = $request->infant_qty;
        $package->total_qty = $request->total_qty;
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
    public function updateGuestReaction(Request $request){
        $this->updateGuestReacitonValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->guestReactionBasic($request, $package);
        $package->update();
        $package_days = PackageDay::where('package_id', $request->id)->get();
        foreach ($package_days as $package_day){
            $package_day->delete();
        }
        $this->packageDay($request, $package);
        return 'Follow up Guest Updated Successfully';

    }

}
