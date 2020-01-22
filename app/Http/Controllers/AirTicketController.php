<?php

namespace App\Http\Controllers;

use App\Airticket;
use App\model\Pax;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\Profit;
use App\SubAirticket;
use Illuminate\Http\Request;
use Session;

class AirTicketController extends Controller
{
    protected function airTicketValidation($request){
       $request->validate([
           'destination' => 'required',
           'adult_qty' => 'required',
           'adult_price' => 'required',
           'adult_total_price' => 'required',
           'total_amount' => 'required |required_with:total_price|same:total_price',
           'total_net_price' => 'required',
           'total_price' => 'required',
           'selling_to' => 'required',
           'word' => 'required',
           'note' => 'required',
           'journey_date' => 'required',
           'return_date' => 'required',
           'ticket_class' => 'required',
           'food_rules' => 'required',
           'narration' => 'required',
           'ticket_type' => 'required',
           'ticket_rules' => 'required',

           'empolyees.*.issue_date' => 'required',
           'empolyees.*.departure_date' => 'required',
           'empolyees.*.return_date' => 'required',
           'empolyees.*.air_lines' => 'required',
           'empolyees.*.pnr' => 'required',
           'empolyees.*.sector' => 'required',
           'empolyees.*.net_price' => 'required',
           'empolyees.*.price' => 'required',
           'empolyees.*.suplier' => 'required',

           'paxs.*.pax_title' => 'required',
           'paxs.*.name' => 'required',
           'paxs.*.date_of_birth' => 'required',
           'paxs.*.passport_number' => 'required',
           'paxs.*.pp_issue_date' => 'required',
           'paxs.*.pp_expire_date' => 'required',
       ]);
    }


    protected function airTicketBasic($airticket, $request){
        $airticket->destination = $request->destination;

        $airticket->adult_qty = $request->adult_qty;
        $airticket->adult_price = $request->adult_price;
        $airticket->adult_total_price = $request->adult_total_price;

        $airticket->child_qty = $request->child_qty;
        $airticket->child_price = $request->child_price;
        $airticket->child_total_price = $request->child_total_price;

        $airticket->infant_qty = $request->infant_qty;
        $airticket->infant_price = $request->infant_price;
        $airticket->infant_total_price = $request->infant_total_price;

        $airticket->ssr_qty = $request->ssr_qty;
        $airticket->ssr_price = $request->ssr_price;
        $airticket->ssr_total_price = $request->ssr_total_price;

        $airticket->service_amount = $request->service_amount;
        $airticket->total_amount = $request->total_amount;
        $airticket->total_net_price = $request->total_net_price;
        $airticket->total_price = $request->total_price;
        $airticket->selling_to = $request->selling_to;
        $airticket->word = $request->word;
        $airticket->note = $request->note;
        $airticket->journey_date = $request->journey_date;
        $airticket->return_date = $request->return_date;
        $airticket->ticket_class = $request->ticket_class;
        $airticket->food_rules = $request->food_rules;
        $airticket->date_change = $request->date_change;
        $airticket->narration = $request->narration;
        $airticket->ticket_type = $request->ticket_type;
        $airticket->ticket_rules = $request->ticket_rules;
        $airticket->luggages_rules = $request->luggages_rules;
        $airticket->luggages_rules_description = $request->luggages_rules_description;
        $airticket->hand_luggages_rules = $request->hand_luggages_rules;
        $airticket->hand_luggages_rules_description = $request->hand_luggages_rules_description;
    }
    public function saveEmployeeLoop($request, $airticket){
        $employees_arry = $request->empolyees;
        $employees_arry_count = count($employees_arry);
        for ($i = 0; $i < $employees_arry_count; $i++){
            $sup_air_ticket = new SubAirticket();
            $sup_air_ticket->issue_date = $employees_arry[$i]['issue_date'];
            $sup_air_ticket->departure_date = $employees_arry[$i]['departure_date'];
            $sup_air_ticket->return_date =  $employees_arry[$i]['return_date'];
            $sup_air_ticket->air_lines =  $employees_arry[$i]['air_lines'];
            $sup_air_ticket->pnr =  $employees_arry[$i]['pnr'];
            $sup_air_ticket->sector = $employees_arry[$i]['sector'];
            $sup_air_ticket->net_price =  $employees_arry[$i]['net_price'];
            $sup_air_ticket->price = $employees_arry[$i]['price'];
            $sup_air_ticket->suplier =  $employees_arry[$i]['suplier'];
            $sup_air_ticket->airticket_id = $airticket->id;
            $sup_air_ticket->save();

            // SuplierTransaction Start
            $pre_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->first();
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('id', 'desc')->where('suplier_id', $sup_air_ticket->suplier)->first();

            $suplier_transaction = new SuplierTransaction();
            $suplier_transaction->suplier_id =  $sup_air_ticket->suplier;
            $suplier_transaction->air_id = $sup_air_ticket->id;
            $suplier_transaction->transaction_date = $airticket->created_at->format('Y-m-d');
            $suplier_transaction->narration = $sup_air_ticket->sector;
            $suplier_transaction->debit_amount = $sup_air_ticket->net_price;
            if($pre_sup_transaction == null){
                $suplier_transaction->balance = $sup_air_ticket->net_price;
            }else{
                $suplier_transaction->balance = $pre_sup_transaction->balance+$sup_air_ticket->net_price;
            }
            if($pre_suplier_sup_transaction == null){
                $suplier_transaction->suplier_balance = $sup_air_ticket->net_price;
            }else{
                $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance+$sup_air_ticket->net_price;
            }
            $suplier_transaction->save();
            // SuplierTransaction End

        }
    }


    public function savePaxLoop($request, $airticket){
        $paxs_arry = $request->paxs;
        $paxs_arry_count = count($paxs_arry);
        for ($i = 0; $i < $paxs_arry_count; $i++){
            $pax = new Pax();
            $pax->pax_title = $paxs_arry[$i]['pax_title'];
            $pax->name = $paxs_arry[$i]['name'];
            $pax->date_of_birth = $paxs_arry[$i]['date_of_birth'];
            $pax->gender = $paxs_arry[$i]['gender'];
            $pax->phone_number = $paxs_arry[$i]['phone_number'];
            $pax->passport_number = $paxs_arry[$i]['passport_number'];
            $pax->pp_issue_date = $paxs_arry[$i]['pp_issue_date'];
            $pax->pp_expire_date = $paxs_arry[$i]['pp_expire_date'];
            $pax->airticket_id = $airticket->id;
            $pax->save();
        }
    }
    protected function saveProfit($request, $airticket){
        $profit = new Profit();
        $profit->staff_id = Session::get('staff_id');
        $profit->guest_id = $request->selling_to;
        $profit->air_id = $airticket->id;
        $profit->profit_date = $airticket->return_date;
        $profit->amount = $request->total_price - $request->total_net_price;
        $profit->save();
    }
    protected function transjaction($request, $airticket){
        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->selling_to)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', Session::get('staff_id'))->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();
        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->selling_to;
        $transjaction->staff_id = Session::get('staff_id');
        $transjaction->air_id = $airticket->id;
        $transjaction->narration = $request->narration;
        $transjaction->transjaction_date = $airticket->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->total_price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->total_price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->total_price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->total_price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->total_price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->total_price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->total_price;
        }
        $transjaction->save();
    }
    public function addAirTicket(Request $request){
        $this->airTicketValidation($request);
        $airticket = new Airticket();
        $this->airTicketBasic($airticket, $request);
        $airticket->sell_person = Session::get('staff_id');
        $airticket->save();
        $this->savePaxLoop($request, $airticket);
        $this->saveEmployeeLoop($request, $airticket);
        $this->saveProfit($request,$airticket);
        $this->transjaction($request, $airticket);
        return 'Air Ticket Information Added Successfully';
    }

    public function getAllAirTicket(){
        $user_type = Session::get('user_type');
        $air_tickets = Airticket::with(['staff' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guest' => function($q){$q->select('id', 'name','phone_number');}])->select('id', 'destination', 'sell_person', 'total_price', 'selling_to')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'air_tickets' => $air_tickets,
            'user_type' => $user_type
        ]);
    }
    public function getAllAirTicketSearch($search){
        $user_type = Session::get('user_type');
        $air_tickets = Airticket::where('id', $search)->orWhere('total_price', 'LIKE', $search.'%')->orWhere('note', 'Like', $search.'%')->orWhere('narration', 'Like', $search.'%')->with(['staff' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guest' => function($q){$q->select('id', 'name','phone_number');}])->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'air_tickets' => $air_tickets,
             'user_type' => $user_type
        ]);
    }

    public function editAirTicket($id){
        $air_ticket = Airticket::with(['staff' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guest' => function($q){$q->select('id', 'name','phone_number');}, 'empolyees' => function($q){$q->with('airlines')->select('airticket_id', 'issue_date', 'departure_date', 'return_date', 'air_lines', 'pnr', 'sector', 'net_price', 'price', 'suplier');}, 'paxs' => function($q){$q->select('id', 'pax_title', 'name', 'gender','date_of_birth', 'phone_number', 'passport_number','pp_issue_date', 'pp_expire_date', 'airticket_id');}])->where('id', $id)->first();
        $user_type = Session::get('user_type');
        return response()->json([
            'air_ticket' => $air_ticket,
            'user_type' => $user_type
        ]);
    }
    protected function firstTransjaction($request){
        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('air_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Air Transjaction 1st ( A-'.$update_first_transjaction->air_id.' )';
        $update_first_transjaction->update();
        return $update_first_transjaction;
    }
    protected function secondTrnasjaction($request, $airticket, $update_first_transjaction){
        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->selling_to)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', Session::get('staff_id'))->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->air_id = $update_first_transjaction->air_id;
        $update_scond_transjaction->narration = 'Updated Air Transjaction 2nd ( A-'.$update_first_transjaction->air_id.' )';
        $update_scond_transjaction->transjaction_date = $airticket->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();
    }
    public function updateAirTicket(Request $request){
        $request->validate([
            'id' => 'required|numeric'
        ]);
        $this->airTicketValidation($request);
        $airticket = Airticket::where('id', $request->id)->first();
        $this->airTicketBasic($airticket, $request);
        $airticket->update();
        $sup_airtickets = SubAirticket::where('airticket_id', $request->id)->get();
        foreach ($sup_airtickets as $sup_airticket){
            $suplier_transaction = SuplierTransaction::where('air_id', $sup_airticket->id)->first();
            $next_transactions = SuplierTransaction::where('id', '>', $suplier_transaction->id)->get();
            foreach ($next_transactions as $next_transaction){
                $next_transactions->balance = $next_transaction->balance - $suplier_transaction->debit_amount;
                if($suplier_transaction->suplier_id = $next_transaction->suplier_id){
                    $next_transaction->suplier_balance = $next_transaction->suplier_balance - $suplier_transaction->debit_amount;
                }
                $next_transaction->update();
            }
            $suplier_transaction->delete();
            $sup_airticket->delete();
        }
        $this->saveEmployeeLoop($request, $airticket);
        $old_profit = Profit::where('air_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $this->saveProfit($request,$airticket);
        $paxs = Pax::where('airticket_id', $request->id)->get();
        foreach ($paxs as $pax){
            $pax->delete();
        }
        $this->savePaxLoop($request, $airticket);
        $this->updateTransjactionBlance($request);

//        $this->savePaxLoop($request, $airticket);
//        $update_first_transjaction = $this->firstTransjaction($request);
//        $this->secondTrnasjaction($request, $airticket, $update_first_transjaction);
//        $this->transjaction($request, $airticket);
        return 'Air Ticket Sucessfully Updated';
    }

    public function updateTransjactionBlance($request){
        $transjaction = Transjaction::where('air_id', $request->id)->first();
        $increment_blance = $request->total_price - $transjaction->credit_amount;
        $old_transjaction_credit = $transjaction->credit_amount;
        $old_staff_id = $transjaction->staff_id;
        $old_guest_id = $transjaction->guest_id;
        $transjaction->guest_id = $request->selling_to;
//        $transjaction->staff_id = $request->sell_person;
        $transjaction->narration = $request->narration;
        $transjaction->credit_amount = $request->total_price;
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

        if($old_guest_id == $request->selling_to){
            $transjaction->guest_blance = $transjaction->guest_blance - $increment_blance;
            $transjaction->update();
            $guest_blances = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($guest_blances as $guest_blance){
                $guest_blance->guest_blance = $guest_blance->guest_blance - $increment_blance;
                $guest_blance->update();
            }
        }else{
            $pre_guest_transjaction = Transjaction::where('id', '<', $transjaction->id)->where('guest_id', $request->selling_to)->orderBy('id', 'desc')->first();
            if($pre_guest_transjaction){
                $transjaction->guest_blance = $pre_guest_transjaction->guest_blance - $request->total_amount;
            }else{
                $transjaction->guest_blance = -$request->total_amount;
            }


            $transjaction->update();
            $next_old_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $old_guest_id)->get();
            foreach ($next_old_guest_transjactions as $next_old_guest_transjaction){
                $next_old_guest_transjaction->guest_blance = $next_old_guest_transjaction->guest_blance + $old_transjaction_credit;
                $next_old_guest_transjaction->update();
            }
            $next_new_guest_transjactions = Transjaction::where('id', '>', $transjaction->id)->where('guest_id', $request->selling_to)->get();
            foreach ($next_new_guest_transjactions as $next_new_guest_transjaction){
                $next_new_guest_transjaction->guest_blance = $next_new_guest_transjaction->guest_blance - $request->total_price;
                $next_new_guest_transjaction->update();
            }
        }
    }
}
