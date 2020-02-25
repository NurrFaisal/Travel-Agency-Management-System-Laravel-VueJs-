<?php

namespace App\Http\Controllers;

use App\model\AirTicketRefund;
use App\model\SuplierTransaction;
use App\SubAirticket;
use Illuminate\Http\Request;
use Session;

class AirTicketRefundController extends Controller
{
    protected function airTicketRefundValidation($request){
        $request->validate([
            'id' => 'required',
            'refund_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);
    }
    protected function refundSupTransaction($air_ticket_refund, $air_ticket_id, $pnr){
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $air_ticket_refund->refund_date)->where('suplier_id', $air_ticket_refund->suplier)->first();
        if($pre_suplier_sup_transaction == null){
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date','<', $air_ticket_refund->refund_date)->where('suplier_id', $air_ticket_refund->suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date',$air_ticket_refund->refund_date)->first();
        if($pre_sup_transaction == null){
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $air_ticket_refund->refund_date)->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id =  $air_ticket_refund->suplier;
        $suplier_transaction->air_ticket_refund_id = $air_ticket_refund->id;
        $suplier_transaction->transaction_date = $air_ticket_refund->refund_date;
        $suplier_transaction->narration ='This '.$pnr.' (A-'.$air_ticket_id.') Refunded';
        $suplier_transaction->debit_amount = $air_ticket_refund->amount;
        if($pre_sup_transaction == null){
            $suplier_transaction->balance = $air_ticket_refund->amount;
        }else{
            $suplier_transaction->balance = $pre_sup_transaction->balance +  $air_ticket_refund->amount;
        }
        if($pre_suplier_sup_transaction == null){
            $suplier_transaction->suplier_balance = $air_ticket_refund->amount;
        }else{
            $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance + $air_ticket_refund->amount;
        }
        $suplier_transaction->save();
        $next_dates = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_dates as $next_date){
            $next_date->balance += $air_ticket_refund->amount;
            if($next_date->suplier_id == $suplier_transaction->suplier_id){
                $next_date->suplier_balance += $air_ticket_refund->amount;
            }
            $next_date->update();
        }
    }
    public function addAirTicketRefund(Request $request){
        $this->airTicketRefundValidation($request);
        $sub_air_ticket = SubAirticket::where('id', $request->id)->first();
        $sub_air_ticket->refund = 1;
        $sub_air_ticket->update();
        $air_ticket_refund = new AirTicketRefund();
        $air_ticket_refund->ticket_id = $request->id;
        $air_ticket_refund->refund_date = $request->refund_date;
        $air_ticket_refund->amount = $request->amount;
        $air_ticket_refund->suplier = $sub_air_ticket->suplier;
        $air_ticket_refund->save();
        $this->refundSupTransaction($air_ticket_refund, $sub_air_ticket->id, $sub_air_ticket->pnr);
        return 'AirTicket Refund Successfully';
    }
    public function getAllAirTicketRefund(){
        $user_type = Session::get('user_type');
        $air_ticket_refunds = AirTicketRefund::with('subAirTicket')->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'air_ticket_refunds' => $air_ticket_refunds,
            'user_type' => $user_type
        ]);
    }
    public function editAirTicketRefund($id){
        $air_ticket_refund = AirTicketRefund::where('id', $id)->first();
        return response()->json([
            'air_ticket_refund' => $air_ticket_refund
        ]);
    }
    public function updateAirTicketRefundSuplierTransaction($air_ticket_refund){
        // SuplierTransaction Start (Payment)
        $suplier_transaction = SuplierTransaction::where('air_ticket_refund_id', $air_ticket_refund->id)->first();
        $old_debit_amount = $suplier_transaction->debit_amount;
        $next_same_date_sup_transactions = SuplierTransaction::where('transaction_date', $suplier_transaction->transaction_date)->where('id', '>', $suplier_transaction->id)->get();
        foreach ($next_same_date_sup_transactions as $next_same_date_sup_transaction){
            $next_same_date_sup_transaction->balance -= $old_debit_amount;
            if($next_same_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id){
                $next_same_date_sup_transaction->suplier_balance -= $old_debit_amount;
            }
            $next_same_date_sup_transaction->update();
        }
        $next_date_sup_transactions = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_date_sup_transactions as $next_date_sup_transaction){
            $next_date_sup_transaction->balance -= $old_debit_amount;
            if($next_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id){
                $next_date_sup_transaction->suplier_balance -= $old_debit_amount;
            }
            $next_date_sup_transaction->update();
        }
        $suplier_transaction->delete();
        // SuplierTransation End (Payment)
    }
    public function updateAirTicketRefund(Request $request){
        $this->airTicketRefundValidation($request);
        $sub_air_ticket = SubAirticket::where('id', $request->ticket_id)->first();
        $air_ticket_refund = AirTicketRefund::where('id', $request->id)->first();
        $air_ticket_refund->refund_date = $request->refund_date;
        $air_ticket_refund->amount = $request->amount;
        $air_ticket_refund->update();
        $this->updateAirTicketRefundSuplierTransaction($air_ticket_refund);
        $this->refundSupTransaction($air_ticket_refund, $sub_air_ticket->id, $sub_air_ticket->pnr);
        return 'Air Ticket Refund Updated Successfully';

    }
}
