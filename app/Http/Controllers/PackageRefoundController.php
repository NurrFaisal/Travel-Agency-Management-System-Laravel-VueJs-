<?php

namespace App\Http\Controllers;

use App\model\Package;
use App\model\Transjaction;
use Illuminate\Http\Request;
use Session;

class PackageRefoundController extends Controller
{
    protected function packageRefundValidation($request)
    {
        $request->validate([
            'id' => 'required',
            'refund_date' => 'required|date',
            'amount' => 'required|numeric',
        ]);
    }

    public function packageRefund(Request $request){
        $package = Package::where('id', $request->id)->first();
        $package->state = 0;
        $package->guest_refund = $request->amount;
        $package->update();
        $this->transjaction($request, $package);
        return response()->json($package);
    }

    public function packageGuestRefund(){
        $user_type = Session::get('user_type');
        $package_guest_refund = Package::with(['guestt' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('state', 0)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'guest_refund' => $package_guest_refund,
            'user_type' => $user_type
        ]);
    }

    protected function transjaction($request, $package)
    {
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $request->refund_date)->where('guest_id', $package->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        if ($pre_guest_transjaction_blance == null) {
            $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $request->refund_date)->where('guest_id', $package->guest)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        }
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $request->refund_date)->where('staff_id', $package->staff)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if ($pre_staff_transjaction_blance == null) {
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $request->refund_date)->where('staff_id', $package->staff)->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }
        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $request->refund_date)->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if ($pre_transjaction_blance == null) {
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $request->refund_date)->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $package->guest;
        $transjaction->staff_id = $package->staff;
        $transjaction->pack_id = $package->id;
        $transjaction->narration = "Package Refund";
        $transjaction->transjaction_date = $request->refund_date;
        $transjaction->credit_amount = $request->amount;
        if ($pre_guest_transjaction_blance == null) {
            $transjaction->guest_blance = $request->amount;
        } else {
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->amount;
        }
        if ($pre_staff_transjaction_blance == null) {
            $transjaction->staff_blance = $request->amount;
        } else {
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->amount;
        }
        if ($pre_transjaction_blance == null) {
            $transjaction->blance = $request->amount;
        } else {
            $transjaction->blance = $pre_transjaction_blance->blance - $request->amount;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance -= $request->amount;
            if ($next_date->guest_id == $package->guest) {
                $next_date->guest_blance -= $request->amount;
            }
            if ($next_date->staff_id == $package->staff) {
                $next_date->staff_blance -= $request->amount;
            }
            $next_date->update();
        }

    }
}
