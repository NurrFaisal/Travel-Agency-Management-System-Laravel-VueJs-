<?php

namespace App\Http\Controllers;

use App\model\Package;
use App\model\Transjaction;
use App\Profit;
use Illuminate\Http\Request;

class PDDINController extends Controller
{
    public function getAllPaymentDoneDueInvoiceNo()
    {
        $payment_done_due_invoice_no = Package::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('state', 9)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'payment_done_due_invoice_no' => $payment_done_due_invoice_no
        ]);
    }

    protected function addPaymentValidation($request)
    {
        $request->validate([
            'payment_date' => 'required',
            'price' => 'required',
            'advance' => 'required',
            'payment_note' => 'required',
        ]);
    }

    public function addPayment(Request $request)
    {
        $this->addPaymentValidation($request);
        $package = Package::where('id', $request->id)->first();
        $package->payment_date = $request->payment_date;
        $package->net_price = $request->net_price;
        $package->price = $request->price;
        $package->advance = $request->advance;
        $package->payment_note = $request->payment_note;
        $package->state = 9;
        $package->update();

        $profit = new Profit();
        $profit->pack_id = $package->id;
        $profit->guest_id = $package->guest_id;
        $profit->staff_id = $package->staff_id;
        $profit->amount = $request->price - $request->net_price;
        $profit->save();


        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $package->guest_id)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $package->staff_id)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $package->guest_id;
        $transjaction->staff_id = $package->staff_id;
        $transjaction->pack_id = $package->id;
        $transjaction->narration = $package->narration;
        $transjaction->transjaction_date = $package->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if ($pre_guest_transjaction_blance == null) {
            $transjaction->guest_blance = -$request->price;
        } else {
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if ($pre_staff_transjaction_blance == null) {
            $transjaction->staff_blance = -$request->price;
        } else {
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if ($pre_transjaction_blance == null) {
            $transjaction->blance = -$request->price;
        } else {
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();

        return 'Payment Date And Price Added Successfully';
    }

    public function EditPddin($id)
    {
        $pddin = Package::where('id', $id)->first();
        return response()->json([
            'pddin' => $pddin
        ]);
    }

    protected function updatePaymentValidation($request)
    {
        $request->validate([
            'guest_id' => 'required|numeric',
            'staff_id' => 'required|numeric',
            'country' => 'required',
            'destination' => 'required',
            'duration' => 'required',
            'query_date' => 'required|date',
            'journey_date' => 'required|date',
            'return_date' => 'required|date',
            'pax' => 'required|numeric',
            'adult' => 'required|numeric',
            'child' => 'required|numeric',
            'infant' => 'required|numeric',
            'hotel_type' => 'required',
            'room_type' => 'required|numeric',
            'tour_by' => 'required|numeric',
            'query_note' => 'required',
            'follow_up_for_price_to_suplier' => 'required|numeric',
            'itinerary_cost_submit_date' => 'required|numeric',
            'guest_reaction' => 'required',
            'guest_reaction_date' => 'required',
            'guest_confirm_date' => 'required',
            'guest_confirm_note' => 'required',
            'confirm_mail_to_suplier_date' => 'required',
            'confirm_mail_to_suplier_note' => 'required',
            'visa_update_date' => 'required',
            'visa_update_note' => 'required',
            'ready_for_delivery' => 'required',
            'ready_for_delivery_note' => 'required',
            'payment_date' => 'required',
            'net_price' => 'required',
            'price' => 'required',
            'advance' => 'required',
            'payment_note' => 'required',
        ]);
    }

    protected function updatePaymentBasic($request, $package)
    {
        $package->guest_id = $request->guest_id;
        $package->staff_id = $request->staff_id;
        $package->country = $request->country;
        $package->destination = $request->destination;
        $package->duration = $request->duration;
        $package->query_date = $request->query_date;
        $package->journey_date = $request->journey_date;
        $package->return_date = $request->return_date;
        $package->pax = $request->pax;
        $package->adult = $request->adult;
        $package->child = $request->child;
        $package->infant = $request->infant;
        $package->hotel_type = $request->hotel_type;
        $package->room_type = $request->room_type;
        $package->tour_by = $request->tour_by;
        $package->query_note = $request->query_note;
        $package->follow_up_for_price_to_suplier = $request->follow_up_for_price_to_suplier;
        $package->itinerary_cost_submit_date = $request->itinerary_cost_submit_date;
        $package->guest_reaction = $request->guest_reaction;
        $package->guest_reaction_date = $request->guest_reaction_date;
        $package->guest_confirm_date = $request->guest_confirm_date;
        $package->guest_confirm_note = $request->guest_confirm_note;
        $package->confirm_mail_to_suplier_date = $request->confirm_mail_to_suplier_date;
        $package->confirm_mail_to_suplier_note = $request->confirm_mail_to_suplier_note;
        $package->visa_update_date = $request->visa_update_date;
        $package->visa_update_note = $request->visa_update_note;
        $package->ready_for_delivery = $request->ready_for_delivery;
        $package->ready_for_delivery_note = $request->ready_for_delivery_note;
        $package->payment_date = $request->payment_date;
        $package->net_price = $request->net_price;
        $package->price = $request->price;
        $package->advance = $request->advance;
        $package->payment_note = $request->payment_note;
    }

    public function updatePayment(Request $request)
    {
        $this->updatePaymentValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->updatePaymentBasic($request, $package);
        $package->update();

        $old_profit = Profit::where('pack_id', $package->id)->first();
        if ($old_profit) {
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->pack_id = $package->id;
        $profit->guest_id = $package->guest_id;
        $profit->staff_id = $package->staff_id;
        $profit->profit_date = $package->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();

        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('pack_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Package Transjaction 1st ( P-' . $update_first_transjaction->pack_id . ' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $package->guest_id)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $package->staff_id)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->pack_id = $update_first_transjaction->pack_id;
        $update_scond_transjaction->narration = 'Updated Package Transjaction 2nd ( P-' . $update_first_transjaction->pack_id . ' )';
        $update_scond_transjaction->transjaction_date = $package->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $package->guest_id)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $package->staff_id)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->guest_id;
        $transjaction->staff_id = $request->staff_id;
        $transjaction->pack_id = $package->id;
        $transjaction->narration = $package->narration;
        $transjaction->transjaction_date = $package->updated_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if ($pre_guest_transjaction_blance == null) {
            $transjaction->guest_blance = -$request->price;
        } else {
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if ($pre_staff_transjaction_blance == null) {
            $transjaction->staff_blance = -$request->price;
        } else {
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if ($pre_transjaction_blance == null) {
            $transjaction->blance = -$request->price;
        } else {
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();

        return 'Payment info updated Successfully';
    }
}
