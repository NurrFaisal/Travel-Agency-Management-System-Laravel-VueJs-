<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Package;
use App\PackageDay;
use Illuminate\Http\Request;
use Session;

class PackageController extends Controller
{
    protected function addPackageQueryValidation($request){
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

        ]);
    }
    protected function addPackageQueryBasic($request, $package){
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

    public function addPackageQuery(Request $request){
       $this->addPackageQueryValidation($request);
       $package = new Package();
       $package->staff = Session::get('staff_id');
       $package->state = 1;
       $this->addPackageQueryBasic($request, $package);
       $package->save();
       $this->packageDay($request, $package);
       return 'New Package Query Added Successfully';
    }

    public function getAllPackageQuery(){
        $user_type = Session::get('user_type');
        $package_query = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])->select('id','guest', 'country', 'destination', 'duration')->where('state', 1)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'package_query' => $package_query,
            'user_type' => $user_type
        ]);
    }
    public function getAllPackageSearch($search){
        $guest_id = [];
        $package_count = 0;
        $package = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('id', $search)->get();
        $package_c = count($package);
        if($package_c == 0){
            $guests = Guest::where('name', 'like', $search.'%')->orWhere('phone_number', 'like', $search.'%')->select('id', 'name', 'phone_number')->get();
            foreach ($guests as $key => $guest) {
                $guest_id[$key] = $guest->id;
            }
            $packages = Package::whereIn('guest', $guest_id)->get();
            $package_count = count($packages);
            $package_query = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 1)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $package_follow_up = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 2)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $package_tour_plan = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 3)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $package_guest_reaction = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 4)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $package_guest_confirm_date = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 5)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $package_visa_update = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 6)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $pacakge_ticket = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 7)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $pacakge_net_prices = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 8)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $pacakge_payment_done_due_invoice_no = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 9)
                ->whereIn('guest', $guest_id)
                ->paginate(10);
            $pacakge_date_of_journey = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])
                ->where('state', 10)
                ->whereIn('guest', $guest_id)
                ->paginate(10);

            return response()->json([
                'package_count' => $package_count,
                'package_query' => $package_query,
                'package_follow_up' => $package_follow_up,
                'itinerary_cost_submit_date' => $package_tour_plan,
                'guest_reaction' => $package_guest_reaction,
                'guest_confirm_date' => $package_guest_confirm_date,
                'package_visa_update' => $package_visa_update,
                'pacakge_ticket' => $pacakge_ticket,
                'net_prices' => $pacakge_net_prices,
                'drfdp' => $pacakge_payment_done_due_invoice_no,
                'date_of_journey' => $pacakge_date_of_journey,
            ]);

        }
        return response()->json([
            'package_count' => $package_count,
            'package' => $package

        ]);

    }
    public function editPackageQuery($id){
        $user_type = Session::get('user_type');
        $package_query = Package::with(['package_days', 'guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('id', $id)->first();
        return response()->json([
            'package_query' => $package_query,
            'user_type' => $user_type
        ]);
    }
    public function updatePackageQuery(Request $request){
        $this->addPackageQueryValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->addPackageQueryBasic($request, $package);
        $package->update();
        $package_days = PackageDay::where('package_id', $request->id)->get();
        foreach ($package_days as $package_day){
            $package_day->delete();
        }
        $this->packageDay($request, $package);
        return 'Package Query Updated Successfully';
    }
    public function ViewPackageById($id){
        $user_type = Session::get('user_type');
        $package = Package::with(['guestt' => function($q){$q->select('id', 'name');}, 'stafft' => function($q){$q->select('id', 'first_name', 'last_name');},'package_days', 'follow_up_to_suplier', 'follow_up_to_guest', 'package_net_price' => function($q){$q->with(['suplier' =>function($q){$q->select('id', 'name');}]);}])->where('id',$id)->first();
        return response()->json([
            'package' => $package,
            'user_type' => $user_type
        ]);
    }
}
