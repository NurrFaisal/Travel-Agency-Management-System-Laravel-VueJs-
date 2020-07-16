<?php

namespace App\Http\Controllers;

use App\model\Package;
use App\model\PackageNetPrice;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\Profit;
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

    public function packageSuplierRefund(){
        $user_type = Session::get('user_type');
        $package_guest_refund = Package::with(['guestt' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('state', 20)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'suplier_refund' => $package_guest_refund,
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

    public function suplierPackageRefund(Request $request){
        $this->packageRefundValidation($request);
        $request->validate([
            'suplier_refund' => 'required',

            'net_prices*suplier' => 'required',
            'net_prices*refund_date' => 'required',
            'net_prices*net_price' => 'required',
            'net_prices*refund_amount' => 'required',
        ]);
        $package = Package::where('id', $request->id)->first();
        $package->state = 20;
        $package->guest_refund = $request->amount;
        $package->suplier_refund = $request->suplier_refund;
        $package->update();
        $this->transjaction($request, $package);
        $net_prices = PackageNetPrice::where('pack_id', $package->id)->get();
        foreach ($net_prices as $net_price) {
            $net_price->delete();
        }
        $profits = Profit::where('pack_id', $package->id)->get();
        foreach ($profits as $profit) {
            $profit->delete();
        }
        $this->profit($request, $package);
        $this->suplierLoop($request);
        return response()->json($package);
    }

    protected function profit($request, $package)
    {
        $profit = new Profit();
        $profit->staff_id = $package->staff;
        $profit->guest_id = $package->guest;
        $profit->pack_id = $package->id;
        $profit->profit_date = $request->refund_date;
        $profit->amount = $package->guest_refund - $package->suplier;
        $profit->save();
    }


    public function suplierLoop($request)
    {
        $net_price_arry = $request->net_prices;
        $net_price_arry_count = count($net_price_arry);
        for ($i = 0; $i < $net_price_arry_count; $i++) {
            $suplier = $net_price_arry[$i]['suplier'];
            $refund_date = $net_price_arry[$i]['refund_date'];
            $net_price = $net_price_arry[$i]['net_price'];
            $refund_amount = $net_price_arry[$i]['refund_amount'];
            $this->savePackageSuplierTransaction($request, $suplier, $refund_date, $net_price, $refund_amount);
        }
    }

    protected function savePackageSuplierTransaction($request, $suplier, $refund_date, $net_price, $refund_amount)
    {
        // SuplierTransaction Start
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $refund_date)->where('suplier_id', $suplier)->first();
        if ($pre_suplier_sup_transaction == null) {
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $refund_date)->where('suplier_id', $suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $refund_date)->first();
        if ($pre_sup_transaction == null) {
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $refund_date)->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id = $suplier;
        $suplier_transaction->pack_id = $request->id;
        $suplier_transaction->transaction_date = $refund_date;
        $suplier_transaction->narration = "Package Refund";
        $suplier_transaction->debit_amount = $refund_amount;
        if ($pre_sup_transaction == null) {
            $suplier_transaction->balance = $refund_amount;
        } else {
            $suplier_transaction->balance = $pre_sup_transaction->balance + $refund_amount;
        }
        if ($pre_suplier_sup_transaction == null) {
            $suplier_transaction->suplier_balance = $refund_amount;
        } else {
            $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance + $refund_amount;
        }
        $suplier_transaction->save();
        $next_same_dates = SuplierTransaction::where('id', '>', $suplier_transaction->id)->where('transaction_date', $suplier_transaction->transaction_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->balance += $refund_amount;
            if ($next_same_date->suplier_id == $suplier_transaction->suplier_id) {
                $next_same_date->suplier_balance += $refund_amount;
            }
            $next_same_date->update();
        }
        $next_dates = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->balance += $refund_amount;
            if ($next_date->suplier_id == $suplier_transaction->suplier_id) {
                $next_date->suplier_balance += $refund_amount;
            }
            $next_date->update();
        }
        // SuplierTransaction End
    }
}
