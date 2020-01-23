<?php

namespace App\Http\Controllers;

use App\model\Hotel;
use App\model\HotelBooking;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\Profit;
use Illuminate\Http\Request;
use Session;

class HotelBookingController extends Controller
{
    protected function hotelBookingValidation($request){
        $request->validate([
            'customer_name' => 'required',
            'total_net_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'client' => 'required|numeric',
            'hotels.*.hotel_name' => 'required',
            'hotels.*.check_in' => 'required|date',
            'hotels.*.check_out' => 'required|date',
            'hotels.*.number_of_persons' => 'required|numeric',
            'hotels.*.number_of_room' => 'required|numeric',
            'hotels.*.hotel_booking_ref' => 'required',
            'hotels.*.net_price' => 'required|numeric',
            'hotels.*.suplier' => 'required|numeric',
            'hotels.*.room_category' => 'required',
            'hotels.*.note' => 'required',
            'hotels.*.address' => 'required',
            'hotels.*.room_qty' => 'required',
            'hotels.*.room_total_price' => 'required',
            'hotels.*.total_hotel_price' => 'required',

        ]);
    }
    protected function hotelBookingBasic($request, $hotel_booking){
        $hotel_booking->customer_name = $request->customer_name;
        $hotel_booking->total_net_price = $request->total_net_price;
        $hotel_booking->total_price = $request->total_price;
        $hotel_booking->client = $request->client;
        $hotel_booking->narration = $request->narration;
    }
    protected function hotelBasic($hotel, $hotel_arry, $i){
        $hotel->hotel_name = $hotel_arry[$i]['hotel_name'];
        $hotel->check_in = $hotel_arry[$i]['check_in'];
        $hotel->check_out = $hotel_arry[$i]['check_out'];
        $hotel->number_of_persons = $hotel_arry[$i]['number_of_persons'];
        $hotel->number_of_room = $hotel_arry[$i]['number_of_room'];
        $hotel->hotel_booking_ref = $hotel_arry[$i]['hotel_booking_ref'];
        $hotel->net_price = $hotel_arry[$i]['net_price'];
        $hotel->suplier = $hotel_arry[$i]['suplier'];
        $hotel->room_category = $hotel_arry[$i]['room_category'];
        $hotel->note = $hotel_arry[$i]['note'];
        $hotel->address = $hotel_arry[$i]['address'];

        $hotel->king_size = $hotel_arry[$i]['king_size'];
        $hotel->king_size_price = $hotel_arry[$i]['king_size_price'];
        $hotel->couple = $hotel_arry[$i]['couple'];
        $hotel->couple_price = $hotel_arry[$i]['couple_price'];
        $hotel->twin = $hotel_arry[$i]['twin'];
        $hotel->twin_price = $hotel_arry[$i]['twin_price'];
        $hotel->triple = $hotel_arry[$i]['triple'];
        $hotel->triple_price = $hotel_arry[$i]['triple_price'];
        $hotel->quared = $hotel_arry[$i]['quared'];
        $hotel->quared_price = $hotel_arry[$i]['quared_price'];

        $hotel->room_qty = $hotel_arry[$i]['room_qty'];
        $hotel->room_total_price = $hotel_arry[$i]['room_total_price'];

        $hotel->extra_bed_qty = $hotel_arry[$i]['extra_bed_qty'];
        $hotel->extra_bed_price = $hotel_arry[$i]['extra_bed_price'];
        $hotel->extra_bed_total_price = $hotel_arry[$i]['extra_bed_total_price'];
        $hotel->breakfast_qty = $hotel_arry[$i]['breakfast_qty'];
        $hotel->breakfast_price = $hotel_arry[$i]['breakfast_price'];
        $hotel->breakfast_total_price = $hotel_arry[$i]['breakfast_total_price'];
        $hotel->early_check_in_qty = $hotel_arry[$i]['early_check_in_qty'];
        $hotel->early_check_in_price = $hotel_arry[$i]['early_check_in_price'];
        $hotel->early_check_in_total_price = $hotel_arry[$i]['early_check_in_total_price'];
        $hotel->late_check_out_qty = $hotel_arry[$i]['late_check_out_qty'];
        $hotel->late_check_out_price = $hotel_arry[$i]['late_check_out_price'];
        $hotel->late_check_out_total_price = $hotel_arry[$i]['late_check_out_total_price'];

        $hotel->total_hotel_price = $hotel_arry[$i]['total_hotel_price'];


    }
    public function addHotelBooking(Request $request){
        $this->hotelBookingValidation($request);
        $hotel_booking = new HotelBooking();
        $this->hotelBookingBasic($request, $hotel_booking);
        $hotel_booking->sell_person = Session::get('staff_id');
        $hotel_booking->save();
        $hotel_arry = $request->hotels;
        $hotel_arry_lenth = count($hotel_arry);
        for ($i =0; $i < $hotel_arry_lenth; $i++){
            $hotel = new Hotel();
            $this->hotelBasic($hotel, $hotel_arry, $i);
            $hotel->hotel_booking_id = $hotel_booking->id;
            $hotel->save();
            $index = $i;

            //SuplierTransaction Start
            $pre_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->first();
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->where('suplier_id', $hotel->suplier)->first();

            $suplier_transaction = new SuplierTransaction();
            $suplier_transaction->suplier_id =  $hotel->suplier;
            $suplier_transaction->hotel_id = $hotel->id;
            $suplier_transaction->transaction_date = $hotel->created_at->format('Y-m-d');
            $suplier_transaction->narration = $hotel->hotel_name;
            $suplier_transaction->credit_amount = $hotel->net_price;
            if($pre_sup_transaction == null){
                $suplier_transaction->balance = -$hotel->net_price;
            }else{
                $suplier_transaction->balance = $pre_sup_transaction->balance - $hotel->net_price;
            }
            if($pre_suplier_sup_transaction == null){
                $suplier_transaction->suplier_balance = -$hotel->net_price;
            }else{
                $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance - $hotel->net_price;
            }
            $suplier_transaction->save();
            //SuplierTransaction End


        }
        $profit = new Profit();
        $profit->hotel_id = $hotel_booking->id;
        $profit->staff_id = $hotel_booking->sell_person;
        $profit->guest_id = $hotel_booking->client;
        $profit->profit_date = $hotel_arry[$index]['check_out'];
        $profit->amount = $hotel_booking->total_price - $hotel_booking->total_net_price;
        $profit->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $hotel_booking->client)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $hotel_booking->sell_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $hotel_booking->client;
        $transjaction->staff_id = $hotel_booking->sell_person;
        $transjaction->hotel_id = $hotel_booking->id;
        $transjaction->narration = $hotel_booking->narration;
        $transjaction->transjaction_date = $hotel_booking->created_at->format('Y-m-d');
        $transjaction->debit_amount = $hotel_booking->total_price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = $hotel_booking->total_price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $hotel_booking->total_price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = $hotel_booking->total_price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $hotel_booking->total_price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = $request->total_price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance + $request->total_price;
        }
        $transjaction->save();



        return 'New Hotel Booking Added Successfully';
    }

    public function getAllHotelBooking(){
        $hotel_bookings = HotelBooking::with(['guest' => function($q){$q->select('id', 'name');}, 'staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->select('id',  'client', 'sell_person', 'total_net_price', 'total_price')->paginate(10);
        return response()->json([
            'hotel_bookings' => $hotel_bookings
        ]);
    }

    public function editHotelBooking($id){
        $user_type = Session::get('user_type');
        $hotel_booking = HotelBooking::with(['hotels', 'guest'=>function($q){$q->select('id','name','phone_number');}])->where('id', $id)->first();
        return response()->json([
            'hotel_booking' => $hotel_booking,
            'user_type' => $user_type
        ]);
    }
    public function updateHotelBooking(Request $request){
        $this->hotelBookingValidation($request);
        $hotel_booking = HotelBooking::where('id', $request->id)->first();
        $this->hotelBookingBasic($request, $hotel_booking);
        $hotel_booking->update();
        $hotels = Hotel::where('hotel_booking_id', $request->id)->get();
        foreach ($hotels as $hotel){
            $suplier_transaction = SuplierTransaction::where('hotel_id', $hotel->id)->first();
            $next_transactions = SuplierTransaction::where('id', '>', $hotel->id)->get();
            foreach ($next_transactions as $next_transaction){
                $next_transactions->balance = $next_transaction->balance + $suplier_transaction->credit_amount;
                if($suplier_transaction->suplier_id = $next_transaction->suplier_id){
                    $next_transaction->suplier_balance = $next_transaction->suplier_balance + $suplier_transaction->credit_amount;
                }
                $next_transaction->update();
            }
            $suplier_transaction->delete();
            $hotel->delete();
        }
        $hotel_arry = $request->hotels;
        $hotel_arry_lenth = count($hotel_arry);
        for ($i =0; $i < $hotel_arry_lenth; $i++){
            $hotel = new Hotel();
            $this->hotelBasic($hotel, $hotel_arry, $i);
            $hotel->hotel_booking_id = $hotel_booking->id;
            $hotel->save();

            //SuplierTransaction Start
            $pre_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->first();
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->where('suplier_id', $hotel->suplier)->first();

            $suplier_transaction = new SuplierTransaction();
            $suplier_transaction->suplier_id =  $hotel->suplier;
            $suplier_transaction->hotel_id = $hotel->id;
            $suplier_transaction->transaction_date = $hotel->created_at->format('Y-m-d');
            $suplier_transaction->narration = $hotel->hotel_name;
            $suplier_transaction->credit_amount = $hotel->net_price;
            if($pre_sup_transaction == null){
                $suplier_transaction->balance = -$hotel->net_price;
            }else{
                $suplier_transaction->balance = $pre_sup_transaction->balance - $hotel->net_price;
            }
            if($pre_suplier_sup_transaction == null){
                $suplier_transaction->suplier_balance = -$hotel->net_price;
            }else{
                $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance - $hotel->net_price;
            }
            $suplier_transaction->save();
            //SuplierTransaction End
        }
        $old_profit = Profit::where('hotel_id', $hotel_booking->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->hotel_id = $hotel_booking->id;
        $profit->staff_id = $hotel_booking->sell_person;
        $profit->guest_id = $hotel_booking->client;
        $profit->profit_date = $hotel_booking->created_at->format('Y-m-d');
        $profit->amount = $hotel_booking->total_price - $hotel_booking->total_net_price;
        $profit->save();
        $this->updateTransjactionBlance($request);

//        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('hotel_id', $request->id)->first();
//        $update_first_transjaction->hotel_id = null;
//        $update_first_transjaction->narration = 'Updated Hotel Transjaction 1st ( H-'.$update_first_transjaction->hotel_id.' )';
//        $update_first_transjaction->update();
//
//
//        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->client)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
//        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sell_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
//        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();
//
//        $update_scond_transjaction = new Transjaction();
//        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
//        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
//        $update_scond_transjaction->narration = 'Updated Hotel Transjaction 2nd ( H-'.$update_first_transjaction->hotel_id.' )';
//        $update_scond_transjaction->transjaction_date = $hotel_booking->updated_at->format('Y-m-d');
//        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
//        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
//        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
//        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
//        $update_scond_transjaction->save();
//
//        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->client)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
//        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sell_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
//        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();
//
//        $transjaction = new Transjaction();
//        $transjaction->guest_id = $request->client;
//        $transjaction->staff_id = $request->sell_person;
//        $transjaction->hotel_id = $hotel_booking->id;
//        $transjaction->narration = $request->narration;
//        $transjaction->transjaction_date = $hotel_booking->created_at->format('Y-m-d');
//        $transjaction->credit_amount = $request->total_price;
//        if($pre_guest_transjaction_blance == null){
//            $transjaction->guest_blance = -$request->total_price;
//        }else{
//            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->total_price;
//        }
//        if($pre_staff_transjaction_blance == null){
//            $transjaction->staff_blance = -$request->total_price;
//        }else{
//            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->total_price;
//        }
//        if($pre_transjaction_blance == null){
//            $transjaction->blance = -$request->total_price;
//        }else{
//            $transjaction->blance = $pre_transjaction_blance->blance - $request->total_price;
//        }
//        $transjaction->save();

        return 'Hotel Booking Updated Successfully';
    }


    public function updateTransjactionBlance($request){
        $transjaction = Transjaction::where('hotel_id', $request->id)->first();
        $increment_blance = $request->total_price - $transjaction->debit_amount;
        $old_transjaction_debit = $transjaction->debit_amount;
        $old_staff_id = $transjaction->staff_id;
        $old_guest_id = $transjaction->guest_id;
        $transjaction->guest_id = $request->client;
//        $transjaction->staff_id = $request->sell_person;
        $transjaction->narration = $request->narration;
        $transjaction->debit_amount = $request->total_price;
        $transjaction->blance = $transjaction->blance + $increment_blance;
        $blance_transjactions = Transjaction::where('id', '>', $transjaction->id)->get();
        foreach ($blance_transjactions as $blance_transjaction){
            $blance_transjaction->blance = $blance_transjaction->blance + $increment_blance;
            $blance_transjaction->update();
        }
        $transjaction->staff_blance = $transjaction->staff_blance + $increment_blance;
        $staff_blance_tranjactions = Transjaction::where('id', '>', $transjaction->id)->where('staff_id', $transjaction->staff_id)->get();
        foreach ($staff_blance_tranjactions as $staff_blance_tranjaction){
            $staff_blance_tranjaction->staff_blance = $staff_blance_tranjaction->staff_blance + $increment_blance;
            $staff_blance_tranjaction->update();
        }

        if($old_guest_id == $request->client){
            $transjaction->guest_blance = $transjaction->guest_blance + $increment_blance;
            $transjaction->update();
            $guest_blances = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($guest_blances as $guest_blance){
                $guest_blance->guest_blance = $guest_blance->guest_blance + $increment_blance;
                $guest_blance->update();
            }
        }else{
            $pre_guest_transjaction = Transjaction::where('id', '<', $transjaction->id)->where('guest_id', $request->client)->orderBy('id', 'desc')->first();
            if($pre_guest_transjaction){
                $transjaction->guest_blance = $pre_guest_transjaction->guest_blance + $request->total_price;
            }else{
                $transjaction->guest_blance = $request->total_price;
            }


            $transjaction->update();
            $next_old_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($next_old_guest_transjactions as $next_old_guest_transjaction){
                $next_old_guest_transjaction->guest_blance = $next_old_guest_transjaction->guest_blance - $old_transjaction_debit;
                $next_old_guest_transjaction->update();
            }
            $next_new_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $request->client)->get();
            foreach ($next_new_guest_transjactions as $next_new_guest_transjaction){
                $next_new_guest_transjaction->guest_blance = $next_new_guest_transjaction->guest_blance + $request->total_price;
                $next_new_guest_transjaction->update();
            }
        }
    }

}
