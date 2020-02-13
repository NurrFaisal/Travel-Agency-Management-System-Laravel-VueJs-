<?php

namespace App\Http\Controllers;

use App\model\Package;
use App\model\PackageNetPrice;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\PackageDay;
use App\Profit;
use Illuminate\Http\Request;

class PackageNetPriceController extends Controller
{
    protected function addPackageNetPriceValidation($request){
        $request->validate([
            'id' => 'required',
            'total_net_price' => 'required',
            'netPrices*suplier' => 'required',
            'netPrices*net_price_date' => 'required',
            'netPrices*net_price' => 'required',
        ]);
    }
    protected function savePackageSuplierTransaction($request, $net_price){
        // SuplierTransaction Start
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $net_price->net_price_date)->where('suplier_id', $net_price->suplier)->first();
        if($pre_suplier_sup_transaction == null){
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date','<', $net_price->net_price_date)->where('suplier_id', $net_price->suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date',$net_price->net_price_date)->first();
        if($pre_sup_transaction == null){
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $net_price->net_price_date)->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id =  $net_price->suplier;
        $suplier_transaction->pack_id = $net_price->pack_id;
        $suplier_transaction->transaction_date = $net_price->net_price_date;
        $suplier_transaction->narration = "Package Net Price P-".$net_price->pack_id;
        $suplier_transaction->credit_amount = $net_price->amount;
        if($pre_sup_transaction == null){
            $suplier_transaction->balance = -$net_price->amount;
        }else{
            $suplier_transaction->balance = $pre_sup_transaction->balance - $net_price->amount;
        }
        if($pre_suplier_sup_transaction == null){
            $suplier_transaction->suplier_balance = -$net_price->amount;
        }else{
            $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance - $net_price->amount;
        }
        $suplier_transaction->save();
        $next_same_dates = SuplierTransaction::where('id', '>', $suplier_transaction->id)->where('transaction_date', $suplier_transaction->transaction_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->balance -= $net_price->amount;
            if($next_same_date->suplier_id == $suplier_transaction->suplier_id){
                $next_same_date->suplier_balance -= $net_price->amount;
            }
            $next_same_date->update();
        }
        $next_dates = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->balance -= $net_price->amount;
            if($next_date->suplier_id == $suplier_transaction->suplier_id){
                $next_date->suplier_balance -= $net_price->amount;
            }
            $next_date->update();
        }
        // SuplierTransaction End
    }
    public function saveNetPriceLoop($request, $package){
        $net_price_arry = $request->netPrices;
        $net_price_arry_count = count($net_price_arry);
        for ($i = 0; $i < $net_price_arry_count; $i++){
           $net_price = new PackageNetPrice();
           $net_price->suplier = $net_price_arry[$i]['suplier'];
           $net_price->net_price_date = $net_price_arry[$i]['net_price_date'];
           $net_price->amount = $net_price_arry[$i]['net_price'];
           $net_price->pack_id = $package->id;
           $net_price->save();
           $this->savePackageSuplierTransaction($request, $net_price);
        }
    }
    public function saveUpdateNetPriceLoop($request, $package){
        $net_price_arry = $request->net_prices;
        $net_price_arry_count = count($net_price_arry);
        for ($i = 0; $i < $net_price_arry_count; $i++){
            $net_price = new PackageNetPrice();
            $net_price->suplier = $net_price_arry[$i]['suplier'];
            $net_price->net_price_date = $net_price_arry[$i]['net_price_date'];
            $net_price->amount = $net_price_arry[$i]['amount'];
            $net_price->pack_id = $package->id;
            $net_price->save();
            $this->savePackageSuplierTransaction($request, $net_price);
        }
    }
    public function addPackageNetPrice(Request $request){
        $package = Package::where('id', $request->id)->first();
        $package->grand_total_net_price = $request->total_net_price;
        $package->state = 8;
        $package->update();
        $this->saveNetPriceLoop($request, $package);
        $this->profit($package);
        return 'Package Net Price Successfully Added';
    }
    protected function profit($package){
        $profit = new Profit();
        $profit->staff_id = $package->staff;
        $profit->guest_id = $package->guest;
        $profit->pack_id = $package->id;
        $profit->profit_date = $package->return_date;
        $profit->amount = $package->grand_total_price - $package->grand_total_net_price;
        $profit->save();
    }

    public function getAllPackageNetPrice(){
        $net_prices = Package::with(['guestt' => function($q){$q->select('id','name', 'phone_number');}])->where('state', 8)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'net_prices' => $net_prices
        ]);
    }
    public function editPackageNetPrice($id){
        $package_net = Package::with(['net_prices','package_days', 'guestt'=> function($q){$q->select('id', 'name', 'phone_number');}])->where('id', $id)->first();
        return response()->json([
            'package_net' => $package_net
        ]);
    }
    protected function updatePackageNetPriceValidation($request){
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
            'ticket_date' => 'required|date',
            'ticket_type' => 'required',

            'total_net_price' => 'required',
            'net_prices*suplier' => 'required',
            'net_prices*net_price_date' => 'required',
            'net_prices*amount' => 'required',
        ]);
    }
    protected function updatePackageNetPriceBasic($request, $package){
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
        $package->confirm_date = $request->confirm_date;
        $package->journey_date = $request->journey_date;
        $package->return_date = $request->return_date;

        $package->iti_submit_to_guest_date = $request->iti_submit_to_guest_date;
        $package->visa_submit_to_us = $request->visa_submit_to_us;
        $package->visa_submit_to_em = $request->visa_submit_to_em;
        $package->visa_done_date = $request->visa_done_date;
        $package->visa_delivery_to_guest = $request->visa_delivery_to_guest;
        $package->ticket_date = $request->ticket_date;
        $package->ticket_type = $request->ticket_type;

        $package->grand_total_net_price = $request->total_net_price;



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

    protected  function removeSuplierTransaction($package){
        $suplier_transactions =SuplierTransaction::where('pack_id', $package->id)->get();
        foreach ($suplier_transactions as $suplier_transaction){
            $next_same_dates = SuplierTransaction::where('id', '>', $suplier_transaction->id)->where('transaction_date', $suplier_transaction->transaction_date)->get();
            foreach ($next_same_dates as $next_same_date){
                $next_same_date->balance += $suplier_transaction->credit_amount;
                if($next_same_date->suplier_id == $suplier_transaction->suplier_id){
                    $next_same_date->suplier_balance += $suplier_transaction->credit_amount;
                }
                $next_same_date->update();
            }
            $next_dates = SuplierTransaction::where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
            foreach ($next_dates as $next_date){
                $next_date->balance += $suplier_transaction->credit_amount;
                if($next_date->suplier_id == $suplier_transaction->suplier_id){
                    $next_date->suplier_balance += $suplier_transaction->credit_amount;
                }
                $next_date->update();
            }
            $suplier_transaction->delete();
        }
    }

    public function updatePackageNetPrice(Request $request){
        $this->updatePackageNetPriceValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->updatePackageNetPriceBasic($request, $package);
        $package->update();
        $this->removeSuplierTransaction($package);
        $package_days = PackageDay::where('package_id', $request->id)->get();
        foreach ($package_days as $package_day){
            $package_day->delete();
        }
        $this->packageDay($request, $package);
        $net_prices = PackageNetPrice::where('pack_id', $package->id)->get();
        foreach ($net_prices as $net_price){
            $net_price->delete();
        }
        $this->saveUpdateNetPriceLoop($request, $package);
        $profits = Profit::where('pack_id', $package->id)->get();
        foreach ($profits as $profit){
            $profit->delete();
        }
        $this->profit($package);
        $this->updateTransjactionBlance($request, $package);
        $this->transjaction($request, $package);
        return 'Package Net Price Updated Successfully';

    }
    protected function updateTransjactionBlance($request, $package){
        $transjaction = Transjaction::where('pack_id', $package->id)->first();
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
}
