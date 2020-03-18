<?php

namespace App\Http\Controllers;

use App\Airticket;
use App\model\Guest;
use App\model\Pax;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\Profit;
use App\SubAirticket;
use Carbon\Carbon;
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
    protected function saveAirSuplierTransaction($request, $sup_air_ticket){
        // SuplierTransaction Start
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $sup_air_ticket->issue_date)->where('suplier_id', $sup_air_ticket->suplier)->first();
        if($pre_suplier_sup_transaction == null){
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date','<', $sup_air_ticket->issue_date)->where('suplier_id', $sup_air_ticket->suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date',$sup_air_ticket->issue_date)->first();
        if($pre_sup_transaction == null){
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $sup_air_ticket->issue_date)->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id =  $sup_air_ticket->suplier;
        $suplier_transaction->air_id = $sup_air_ticket->id;
        $suplier_transaction->transaction_date = $sup_air_ticket->issue_date;
        $suplier_transaction->narration = $sup_air_ticket->sector;
        $suplier_transaction->credit_amount = $sup_air_ticket->net_price;
        if($pre_sup_transaction == null){
            $suplier_transaction->balance = -$sup_air_ticket->net_price;
        }else{
            $suplier_transaction->balance = $pre_sup_transaction->balance - $sup_air_ticket->net_price;
        }
        if($pre_suplier_sup_transaction == null){
            $suplier_transaction->suplier_balance = -$sup_air_ticket->net_price;
        }else{
            $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance - $sup_air_ticket->net_price;
        }
        $suplier_transaction->save();
        $next_same_dates = SuplierTransaction::where('id', '>', $suplier_transaction->id)->where('transaction_date', $suplier_transaction->transaction_date)->get();
        foreach ($next_same_dates as $next_same_date){
            $next_same_date->balance -= $sup_air_ticket->net_price;
            if($next_same_date->suplier_id == $suplier_transaction->suplier_id){
                $next_same_date->suplier_balance -= $sup_air_ticket->net_pricet;
            }
            $next_same_date->update();
        }
        $next_dates = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->balance -= $sup_air_ticket->net_price;;
            if($next_date->suplier_id == $suplier_transaction->suplier_id){
                $next_date->suplier_balance -= $sup_air_ticket->net_price;
            }
            $next_date->update();
        }
        // SuplierTransaction End
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
            $this->saveAirSuplierTransaction($request, $sup_air_ticket);
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
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $airticket->created_at)->where('guest_id', $request->selling_to)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        if($pre_guest_transjaction_blance == null){
            $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $airticket->created_at)->where('guest_id', $request->selling_to)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        }
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $airticket->created_at)->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if($pre_staff_transjaction_blance == null){
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $airticket->created_at)->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }
        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date',$airticket->created_at)->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if($pre_transjaction_blance == null){
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<',$airticket->created_at)->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->selling_to;
        $transjaction->staff_id = Session::get('staff_id');
        $transjaction->air_id = $airticket->id;
        $transjaction->narration = $airticket->narration;
        $transjaction->transjaction_date = $airticket->created_at;
        $transjaction->debit_amount = $airticket->total_price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = $airticket->total_price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $airticket->total_price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = $airticket->total_price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $airticket->total_price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = $airticket->total_price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance + $airticket->total_price;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->blance += $airticket->total_price;
            if($next_date->guest_id == $request->selling_to){
                $next_date->guest_blance += $airticket->total_price;
            }
            if($next_date->staff_id == $airticket->sell_person){
                $next_date->staff_blance += $airticket->total_price;
            }
            $next_date->update();
        }

    }
    public function addAirTicket(Request $request){
        $this->airTicketValidation($request);
        $airticket = new Airticket();
        $this->airTicketBasic($airticket, $request);
        $airticket->invoice_date = Carbon::now()->format('Y-m-d');
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
        if($user_type == 'super-admin' || $user_type == 'admin' || $user_type == 'operation') {
            $air_tickets = Airticket::with(['staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])->select('id', 'destination', 'sell_person', 'total_price', 'selling_to', 'print')->orderBy('id', 'desc')->paginate(10);
        }else{
            $air_tickets = Airticket::with(['staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'guest' => function ($q) {
                $q->select('id', 'name', 'phone_number', 'print');
            }])->where('sell_person', Session::get('staff_id'))->select('id', 'destination', 'sell_person', 'total_price', 'selling_to', 'print')->orderBy('id', 'desc')->paginate(10);
        }
        return response()->json([
            'air_tickets' => $air_tickets,
            'user_type' => $user_type
        ]);
    }
    public function getAllAirTicketSearch($search){
        $guest_id = [];
        $user_type = Session::get('user_type');
        if($user_type == 'super-admin' || $user_type == 'admin' || $user_type == 'operation') {
            $guests = Guest::where('phone_number', 'LIKE', $search . '%')->select('id', 'phone_number')->get();
            foreach ($guests as $key => $guest) {
                $guest_id[$key] = $guest->id;
            }
            $air_tickets = Airticket::where('id', $search)->orWhereIn('selling_to', $guest_id)->orWhere('created_at', 'like', $search . '%')->with(['staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])->orderBy('id', 'desc')->paginate(10);
        }else{
            $guests = Guest::where('phone_number', 'LIKE', $search . '%')->select('id', 'phone_number')->get();
            foreach ($guests as $key => $guest) {
                $guest_id[$key] = $guest->id;
            }
            $air_tickets = Airticket::where('sell_person', Session::get('staff_id'))->where('id', $search)->orWhereIn('selling_to', $guest_id)->orWhere('created_at', 'like', $search . '%')->with(['staff' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }, 'guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])->orderBy('id', 'desc')->paginate(10);
        }
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
    public function updateAirSuplierTransaction($request, $sup_air_ticket){
        // SuplierTransaction Start (Payment)
        $suplier_transaction = SuplierTransaction::where('air_id', $sup_air_ticket->id)->first();
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
        // SuplierTransation End (Payment)
    }
    protected function updateTransjactionBlance($request, $airticket){
        $transjaction = Transjaction::where('air_id', $airticket->id)->first();
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

    public function updateAirTicket(Request $request){
        $request->validate([
            'id' => 'required|numeric'
        ]);
        $this->airTicketValidation($request);
        $airticket = Airticket::where('id', $request->id)->first();
        $this->airTicketBasic($airticket, $request);
        $airticket->update();
        $sup_airtickets = SubAirticket::where('airticket_id', $request->id)->get();
        foreach ($sup_airtickets as $sup_air_ticket){
            $this->updateAirSuplierTransaction($request, $sup_air_ticket);
            $sup_air_ticket->delete();
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
        $this->updateTransjactionBlance($request, $airticket);
        $this->transjaction($request, $airticket);

        return 'Air Ticket Sucessfully Updated';
    }

}
