<?php

namespace App\Http\Controllers;

use App\model\Package;
use Illuminate\Http\Request;

class ConfirmMailToSuplierController extends Controller
{
    public function getAllPackageCMTS()
    {
        $confirm_mail_to_suplier = Package::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('state', 6)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'confirm_mail_to_suplier' => $confirm_mail_to_suplier
        ]);
    }

    protected function addConfirmMailToSuplierValidation($request)
    {
        $request->validate([
            'id' => 'required',
            'confirm_mail_to_suplier_date' => 'required',
            'confirm_mail_to_suplier_note' => 'required'
        ]);
    }

    public function addConfirmMailToSuplier(Request $request)
    {
        $this->addConfirmMailToSuplierValidation($request);
        $package = Package::where('id', $request->id)->first();
        $package->confirm_mail_to_suplier_date = $request->confirm_mail_to_suplier_date;
        $package->confirm_mail_to_suplier_note = $request->confirm_mail_to_suplier_note;
        $package->state = 6;
        $package->update();
        return 'Confirm Mail To Suplier Date Added Successfully';
    }

    public function editConfirmMailToSuplier($id)
    {
        $cmts = Package::where('id', $id)->first();
        return response()->json([
            'cmts' => $cmts
        ]);
    }

    protected function updateConfirmMailToSuplierValidation($request)
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
        ]);
    }

    protected function updateConfirmMailToSuplierBasic($request, $package)
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
    }

    public function updateConfirmMailToSuplier(Request $request)
    {
        $this->updateConfirmMailToSuplierValidation($request);
        $package = Package::where('id', $request->id)->first();
        $this->updateConfirmMailToSuplierBasic($request, $package);
        $package->update();
        return 'Confirm Mail To Suplier Date Updated Successfully';
    }
}
