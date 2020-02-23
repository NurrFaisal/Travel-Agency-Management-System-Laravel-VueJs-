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
    protected function saveHotelSuplierTransaction($request, $hotel, $hotel_booking){
        // SuplierTransaction Start
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $hotel_booking->created_at->format('Y-m-d'))->where('suplier_id', $hotel->suplier)->first();
        if($pre_suplier_sup_transaction == null){
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date','<', $hotel_booking->created_at->format('Y-m-d'))->where('suplier_id', $hotel->suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date',$hotel_booking->created_at->format('Y-m-d'))->first();
        if($pre_sup_transaction == null){
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $hotel_booking->created_at->format('Y-m-d'))->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id =  $hotel->suplier;
        $suplier_transaction->hotel_id = $hotel->id;
        $suplier_transaction->transaction_date = $hotel->check_in;
        $suplier_transaction->narration = $hotel->note;
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

        $next_dates = SuplierTransaction::where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->balance -= $hotel->net_price;;
            if($next_date->suplier_id == $suplier_transaction->suplier_id){
                $next_date->suplier_balance -= $hotel->net_price;
            }
            $next_date->update();
        }
        // SuplierTransaction End
    }
    protected function saveHotelBookingProfit($hotel_booking, $check_out_date){
        $profit = new Profit();
        $profit->hotel_id = $hotel_booking->id;
        $profit->staff_id = $hotel_booking->sell_person;
        $profit->guest_id = $hotel_booking->client;
        $profit->profit_date = $check_out_date;
        $profit->amount = $hotel_booking->total_price - $hotel_booking->total_net_price;
        $profit->save();
    }
    protected function transjaction($request, $hotel_booking){
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $hotel_booking->created_at->format('Y-m-d'))->where('guest_id', $hotel_booking->client)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        if($pre_guest_transjaction_blance == null){
            $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $hotel_booking->created_at->format('Y-m-d'))->where('guest_id', $hotel_booking->client)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        }
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $hotel_booking->created_at->format('Y-m-d'))->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if($pre_staff_transjaction_blance == null){
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $hotel_booking->created_at->format('Y-m-d'))->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }

        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date',$hotel_booking->created_at->format('Y-m-d'))->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if($pre_transjaction_blance == null){
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<',$hotel_booking->created_at->format('Y-m-d'))->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $hotel_booking->client;
        $transjaction->staff_id = Session::get('staff_id');
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
            $transjaction->blance = $hotel_booking->total_price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance + $hotel_booking->total_price;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $hotel_booking->total_price;
            if($next_date->guest_id == $request->selling_to){
                $next_date->guest_blance += $hotel_booking->total_price;
            }
            if($next_date->staff_id == $hotel_booking->sell_person){
                $next_date->staff_blance += $hotel_booking->total_price;
            }
            $next_date->update();
        }
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
            $this->saveHotelSuplierTransaction($request, $hotel, $hotel_booking);
        }
        $check_out_date = $hotel_arry[$index]['check_out'];
        $this->saveHotelBookingProfit($hotel_booking, $check_out_date);
        $this->transjaction($request, $hotel_booking);
        return 'New Hotel Booking Added Successfully';
    }

    public function getAllHotelBooking(){
        $hotel_bookings = HotelBooking::with(['guest' => function($q){$q->select('id', 'name', 'phone_number');}, 'staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->orderBy('id', 'desc')->select('id',  'client', 'sell_person','customer_name', 'created_at', 'total_net_price', 'total_price')->paginate(10);
        return response()->json([
            'hotel_bookings' => $hotel_bookings
        ]);
    }

    public function getAllHotelBookingSearch($search){
        $hotel_bookings = HotelBooking::with(['guest' => function($q){$q->select('id', 'name', 'phone_number');}, 'staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->where('id', 'like', $search.'%')->orWhere('created_at', 'like', $search.'%')->orWhere('customer_name', 'like', $search.'%')->orderBy('id', 'desc')->select('id',  'client', 'sell_person','customer_name', 'created_at', 'total_net_price', 'total_price')->paginate(10);
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
            $old_debit_amount = $suplier_transaction->credit_amount;
            $next_same_date_sup_transactions = SuplierTransaction::where('transaction_date', $suplier_transaction->transaction_date)->where('id', '>', $suplier_transaction->id)->get();
            foreach ($next_same_date_sup_transactions as $next_same_date_sup_transaction){
                $next_same_date_sup_transaction->balance += $old_debit_amount;
                if($next_same_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id){
                    $next_same_date_sup_transaction->suplier_balance += $old_debit_amount;
                }
                $next_same_date_sup_transaction->update();
            }
            $next_date_sup_transactions = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
            foreach ($next_date_sup_transactions as $next_date_sup_transaction){
                $next_date_sup_transaction->balance += $old_debit_amount;
                if($next_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id){
                    $next_date_sup_transaction->suplier_balance += $old_debit_amount;
                }
                $next_date_sup_transaction->update();
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
            $index = $i;
            $this->saveHotelSuplierTransaction($request, $hotel, $hotel_booking);

        }
        $old_profit = Profit::where('hotel_id', $hotel_booking->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $check_out_date = $hotel_arry[$index]['check_out'];
        $this->saveHotelBookingProfit($hotel_booking, $check_out_date);
        $this->updateTransjactionBlance($request, $hotel_booking);
        $this->transjaction($request, $hotel_booking);
        return 'Hotel Booking Updated Successfully';
    }


    protected function updateTransjactionBlance($request, $hotel_booking){
        $transjaction = Transjaction::where('hotel_id', $hotel_booking->id)->first();
        $old_amount = $transjaction->debit_amount;
        $next_same_date_transactions = Transjaction::where('id', '>', $transjaction->id)->where('transjaction_date', $transjaction->transjaciton_date)->get();
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
