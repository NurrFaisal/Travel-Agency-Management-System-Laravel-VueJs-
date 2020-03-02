<?php

namespace App\Http\Controllers;

use App\model\Guest;
use App\model\Hotel;
use App\model\Staff;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\model\VisaUpdated;
use App\Passport;
use App\Profit;
use Illuminate\Http\Request;
use Session;

class VisaUpdatedController extends Controller
{
    protected function visaUpdatedValidation($request)
    {
        $request->validate([
            'total_net_price' => 'required',
            'total_price' => 'required',
            'total_others_price' => 'required',
            'grand_total_price' => 'required',
            'received_date' => 'required',
            'client' => 'required',
            'invoice_narration' => 'required',
            'special_note' => 'required',
            // passports validation

            'passports.*.name' => 'required',
            'passports.*.passport_number' => 'required',
            'passports.*.no_of_books' => 'required',
            'passports.*.date_of_birth' => 'required',
            'passports.*.expire_date' => 'required',
            'passports.*.type' => 'required',
            'passports.*.country' => 'required',
            'passports.*.suplier' => 'required',
            'passports.*.net_price' => 'required',
            'passports.*.price' => 'required',
            'passports.*.narration' => 'required',
        ]);
    }

    protected function visaUpdatedBasic($visa_updated, $request)
    {
        $visa_updated->urgent_qty = $request->urgent_qty;
        $visa_updated->urgent_price = $request->urgent_price;
        $visa_updated->online_visa_qty = $request->online_visa_qty;
        $visa_updated->online_visa_price = $request->online_visa_price;
        $visa_updated->notary_qty = $request->notary_qty;
        $visa_updated->notary_price = $request->notary_price;
        $visa_updated->invitation_letter_qty = $request->invitation_letter_qty;
        $visa_updated->invitation_letter_price = $request->invitation_letter_price;
        $visa_updated->land_valuation_qty = $request->land_valuation_qty;
        $visa_updated->land_valuation_price = $request->land_valuation_price;
        $visa_updated->lawyer_qty = $request->lawyer_qty;
        $visa_updated->lawyer_price = $request->lawyer_price;

        $visa_updated->total_net_price = $request->total_net_price;
        $visa_updated->total_price = $request->total_price;
        $visa_updated->total_others_price = $request->total_others_price;
        $visa_updated->grand_total_price = $request->grand_total_price;
        $visa_updated->received_date = $request->received_date;
        $visa_updated->client = $request->client;
        $visa_updated->invoice_narration = $request->invoice_narration;
        $visa_updated->special_note = $request->special_note;
    }

    protected function passportsBasic($passport, $passport_arry, $i)
    {
        $passport->name = $passport_arry[$i]['name'];
        $passport->passport_number = $passport_arry[$i]['passport_number'];
        $passport->no_of_books = $passport_arry[$i]['no_of_books'];
        $passport->date_of_birth = $passport_arry[$i]['date_of_birth'];
        $passport->expire_date = $passport_arry[$i]['expire_date'];
        $passport->type = $passport_arry[$i]['type'];
        $passport->country = $passport_arry[$i]['country'];
        $passport->suplier = $passport_arry[$i]['suplier'];
        $passport->net_price = $passport_arry[$i]['net_price'];
        $passport->price = $passport_arry[$i]['price'];
        $passport->old_passport = $passport_arry[$i]['old_passport'];
        $passport->narration = $passport_arry[$i]['narration'];


    }

    protected function saveVisaSuplierTransaction($request, $passport, $visa_updated)
    {
        // SuplierTransaction Start
        $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $visa_updated->created_at->format('Y-m-d'))->where('suplier_id', $passport->suplier)->first();
        if ($pre_suplier_sup_transaction == null) {
            $pre_suplier_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $visa_updated->created_at->format('Y-m-d'))->where('suplier_id', $passport->suplier)->first();
        }
        $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', $visa_updated->created_at->format('Y-m-d'))->first();
        if ($pre_sup_transaction == null) {
            $pre_sup_transaction = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->where('transaction_date', '<', $visa_updated->created_at->format('Y-m-d'))->first();
        }
        $suplier_transaction = new SuplierTransaction();
        $suplier_transaction->suplier_id = $passport->suplier;
        $suplier_transaction->visa_id = $passport->id;
        $suplier_transaction->transaction_date = $visa_updated->created_at->format('Y-m-d');
        $suplier_transaction->narration = $passport->narration;
        $suplier_transaction->credit_amount = $passport->net_price;
        if ($pre_sup_transaction == null) {
            $suplier_transaction->balance = -$passport->net_price;
        } else {
            $suplier_transaction->balance = $pre_sup_transaction->balance - $passport->net_price;
        }
        if ($pre_suplier_sup_transaction == null) {
            $suplier_transaction->suplier_balance = -$passport->net_price;
        } else {
            $suplier_transaction->suplier_balance = $pre_suplier_sup_transaction->suplier_balance - $passport->net_price;
        }
        $suplier_transaction->save();
        $next_same_dates = SuplierTransaction::where('id', '>', $suplier_transaction->id)->where('transaction_date', $suplier_transaction->transaction_date)->get();
        foreach ($next_same_dates as $next_same_date) {
            $next_same_date->balance -= $passport->net_price;
            if ($next_same_date->suplier_id == $suplier_transaction->suplier_id) {
                $next_same_date->suplier_balance -= $passport->net_pricet;
            }
            $next_same_date->update();
        }
        $next_dates = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->balance -= $passport->net_price;;
            if ($next_date->suplier_id == $suplier_transaction->suplier_id) {
                $next_date->suplier_balance -= $passport->net_price;
            }
            $next_date->update();
        }
        // SuplierTransaction End
    }

    public function visaUpdatedPassport($visa_updated, $request)
    {
        $passport_arry = $request->passports;
        $passport_arry_len = count($passport_arry);
        for ($i = 0; $i < $passport_arry_len; $i++) {
            $passport = new Passport();
            $this->passportsBasic($passport, $passport_arry, $i);
            $passport->visa_updated_id = $visa_updated->id;
            $passport->save();
            $this->saveVisaSuplierTransaction($request, $passport, $visa_updated);
        }
    }

    protected function transjaction($request, $visa_updated)
    {
        $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $visa_updated->created_at->format('Y-m-d'))->where('guest_id', $request->client)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        if ($pre_guest_transjaction_blance == null) {
            $pre_guest_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $visa_updated->created_at->format('Y-m-d'))->where('guest_id', $request->client)->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        }
        $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $visa_updated->created_at->format('Y-m-d'))->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        if ($pre_staff_transjaction_blance == null) {
            $pre_staff_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $visa_updated->created_at->format('Y-m-d'))->where('staff_id', Session::get('staff_id'))->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        }

        $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', $visa_updated->created_at->format('Y-m-d'))->select('id', 'transjaction_date', 'narration', 'blance')->first();
        if ($pre_transjaction_blance == null) {
            $pre_transjaction_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->where('transjaction_date', '<', $visa_updated->created_at->format('Y-m-d'))->first();
        }
        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->client;
        $transjaction->staff_id = Session::get('staff_id');
        $transjaction->visa_id = $visa_updated->id;
        $transjaction->narration = $visa_updated->invoice_narration;
        $transjaction->transjaction_date = $visa_updated->created_at->format('Y-m-d');
        $transjaction->debit_amount = $visa_updated->grand_total_price;
        if ($pre_guest_transjaction_blance == null) {
            $transjaction->guest_blance = $visa_updated->grand_total_price;
        } else {
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $visa_updated->grand_total_price;
        }
        if ($pre_staff_transjaction_blance == null) {
            $transjaction->staff_blance = $visa_updated->grand_total_price;
        } else {
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $visa_updated->grand_total_price;
        }
        if ($pre_transjaction_blance == null) {
            $transjaction->blance = $visa_updated->grand_total_price;
        } else {
            $transjaction->blance = $pre_transjaction_blance->blance + $visa_updated->grand_total_price;
        }
        $transjaction->save();

        $next_dates = Transjaction::orderBy('transjaction_date', 'asc')->where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_dates as $next_date) {
            $next_date->blance += $visa_updated->grand_total_price;
            if ($next_date->guest_id == $request->selling_to) {
                $next_date->guest_blance += $visa_updated->grand_total_price;
            }
            if ($next_date->staff_id == $visa_updated->sell_person) {
                $next_date->staff_blance += $visa_updated->grand_total_price;
            }
            $next_date->update();
        }
    }

    public function addVisaUpdated(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $visa_updated = new VisaUpdated();
        $this->visaUpdatedBasic($visa_updated, $request);
        $visa_updated->sell_person = Session::get('staff_id');
        $visa_updated->state = 1;
        $visa_updated->save();
        $this->visaUpdatedPassport($visa_updated, $request);
        $this->transjaction($request, $visa_updated);
        return 'New VISA info successfully added';
    }

    public function getAllReceivedVisaUpdated()
    {
        $user_type = Session::get('user_type');
        $recieved_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 1)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'recieved_visa' => $recieved_visa,
            'user_type' => $user_type
        ]);
    }

    public function editReceivedVisaUpdated($id)
    {
        $user_type = Session::get('user_type');
        $received_visa = VisaUpdated::where('id', $id)->with(['passports', 'guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->first();
        return response()->json([
            'received_visa' => $received_visa,
            'user_type' => $user_type
        ]);
    }

    public function updateVisaSuplierTransaction($request, $passport)
    {
        // SuplierTransaction Start (Payment)
        $suplier_transaction = SuplierTransaction::where('visa_id', $passport->id)->first();
        $old_debit_amount = $suplier_transaction->credit_amount;
        $next_same_date_sup_transactions = SuplierTransaction::where('transaction_date', $suplier_transaction->transaction_date)->where('id', '>', $suplier_transaction->id)->get();
        foreach ($next_same_date_sup_transactions as $next_same_date_sup_transaction) {
            $next_same_date_sup_transaction->balance += $old_debit_amount;
            if ($next_same_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id) {
                $next_same_date_sup_transaction->suplier_balance += $old_debit_amount;
            }
            $next_same_date_sup_transaction->update();
        }
        $next_date_sup_transactions = SuplierTransaction::orderBy('transaction_date', 'asc')->where('transaction_date', '>', $suplier_transaction->transaction_date)->get();
        foreach ($next_date_sup_transactions as $next_date_sup_transaction) {
            $next_date_sup_transaction->balance += $old_debit_amount;
            if ($next_date_sup_transaction->suplier_id == $suplier_transaction->suplier_id) {
                $next_date_sup_transaction->suplier_balance += $old_debit_amount;
            }
            $next_date_sup_transaction->update();
        }
        $suplier_transaction->delete();
        // SuplierTransation End (Payment)
    }

    protected function removePassport($request)
    {
        $passports = Passport::where('visa_updated_id', $request->id)->get();
        foreach ($passports as $passport) {
            $this->updateVisaSuplierTransaction($request, $passport);
            $passport->delete();
        }
    }

    protected function updateTransjactionBlance($request, $_visa)
    {
        $transjaction = Transjaction::where('visa_id', $_visa->id)->first();
        $old_amount = $transjaction->debit_amount;
        $next_same_date_transactions = Transjaction::where('id', '>', $transjaction->id)->where('transjaction_date', $transjaction->transjaciton_date)->get();
        foreach ($next_same_date_transactions as $next_same_date_transaction) {
            $next_same_date_transaction->blance -= $old_amount;
            if ($next_same_date_transaction->guest_id == $transjaction->guest_id) {
                $next_same_date_transaction->guest_blance -= $old_amount;
            }
            if ($next_same_date_transaction->staff_id == $transjaction->staff_id) {
                $next_same_date_transaction->staff_blance -= $old_amount;
            }
            $next_same_date_transaction->update();
        }
        $next_date_transactions = Transjaction::where('transjaction_date', '>', $transjaction->transjaction_date)->get();
        foreach ($next_date_transactions as $next_date_transaction) {
            $next_date_transaction->blance -= $old_amount;
            if ($next_date_transaction->guest_id == $transjaction->guest_id) {
                $next_date_transaction->guest_blance -= $old_amount;
            }
            if ($next_date_transaction->staff_id == $transjaction->staff_id) {
                $next_date_transaction->staff_blance -= $old_amount;
            }
            $next_date_transaction->update();
        }
        $transjaction->delete();
    }

    public function updateVisaUpdated(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $received_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($received_visa, $request);
        $received_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($received_visa, $request);
        $this->updateTransjactionBlance($request, $received_visa);
        $this->transjaction($request, $received_visa);
        return 'VISA successfully Updated';
    }


    public function updateVisaUpdatedWorkAndNotary(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $work_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($work_visa, $request);
        $this->workAndNotaryBasic($work_visa, $request);
        $work_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($work_visa, $request);
        $this->updateTransjactionBlance($request, $work_visa);
        $this->transjaction($request, $work_visa);
        return 'VISA successfully Updated';
    }

    public function updateVisaUpdatedCheckedByAsst(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $this->checkedByAsstValidation($request);
        $checked_by_asst_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($checked_by_asst_visa, $request);
        $this->workAndNotaryBasic($checked_by_asst_visa, $request);
        $this->checkedByAsstBasic($checked_by_asst_visa, $request);
        $checked_by_asst_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($checked_by_asst_visa, $request);
        $this->updateTransjactionBlance($request, $checked_by_asst_visa);
        $this->transjaction($request, $checked_by_asst_visa);
        return 'VISA successfully Updated';
    }

    public function updateCheckedByOfficerUpdated(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $this->checkedByAsstValidation($request);
        $this->checkedByOffierValidation($request);
        $checked_by_officer_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($checked_by_officer_visa, $request);
        $this->workAndNotaryBasic($checked_by_officer_visa, $request);
        $this->checkedByAsstBasic($checked_by_officer_visa, $request);
        $this->checkedByOfficerBasic($checked_by_officer_visa, $request);
        $checked_by_officer_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($checked_by_officer_visa, $request);
        $this->updateTransjactionBlance($request, $checked_by_officer_visa);
        $this->transjaction($request, $checked_by_officer_visa);
        return 'VISA successfully Updated';
    }

    public function updateVisaUpdatedSubmitBy(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $this->checkedByAsstValidation($request);
        $this->checkedByOffierValidation($request);
        $this->addVisaSubmitUpdatedValidation($request);
        $submit_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($submit_visa, $request);
        $this->workAndNotaryBasic($submit_visa, $request);
        $this->checkedByAsstBasic($submit_visa, $request);
        $this->checkedByOfficerBasic($submit_visa, $request);
        $this->addVisaSubmitUpdatedBasic($submit_visa, $request);
        $submit_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($submit_visa, $request);
        $this->updateTransjactionBlance($request, $submit_visa);
        $this->transjaction($request, $submit_visa);
        return 'VISA successfully Updated';
    }

    public function updateVisaUpdatedCollectedBy(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $this->checkedByAsstValidation($request);
        $this->checkedByOffierValidation($request);
        $this->addVisaSubmitUpdatedValidation($request);
        $this->addVisaCollectedUpdatedValidation($request);
        $collected_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($collected_visa, $request);
        $this->workAndNotaryBasic($collected_visa, $request);
        $this->checkedByAsstBasic($collected_visa, $request);
        $this->checkedByOfficerBasic($collected_visa, $request);
        $this->addVisaSubmitUpdatedBasic($collected_visa, $request);
        $this->addVisaCollectedUpdatedBasic($collected_visa, $request);
        $collected_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($collected_visa, $request);
        $this->updateTransjactionBlance($request, $collected_visa);
        $this->transjaction($request, $collected_visa);
        return 'VISA successfully Updated';
    }

    public function updateVisaUpdatedGCSBy(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $this->checkedByAsstValidation($request);
        $this->checkedByOffierValidation($request);
        $this->addVisaSubmitUpdatedValidation($request);
        $this->addVisaCollectedUpdatedValidation($request);
        $this->addVisaGuestCallAndSmsUpdatedValidation($request);
        $gcs_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($gcs_visa, $request);
        $this->workAndNotaryBasic($gcs_visa, $request);
        $this->checkedByAsstBasic($gcs_visa, $request);
        $this->checkedByOfficerBasic($gcs_visa, $request);
        $this->addVisaSubmitUpdatedBasic($gcs_visa, $request);
        $this->addVisaCollectedUpdatedBasic($gcs_visa, $request);
        $this->addVisaGuestCallAndSmsUpdatedBasic($gcs_visa, $request);
        $gcs_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($gcs_visa, $request);
        $this->updateTransjactionBlance($request, $gcs_visa);
        $this->transjaction($request, $gcs_visa);
        return 'VISA successfully Updated';
    }

    public function updateVisaUpdatedDeleveredBy(Request $request)
    {
        $this->visaUpdatedValidation($request);
        $this->workAndNotaryValidation($request);
        $this->checkedByAsstValidation($request);
        $this->checkedByOffierValidation($request);
        $this->addVisaSubmitUpdatedValidation($request);
        $this->addVisaCollectedUpdatedValidation($request);
        $this->addVisaGuestCallAndSmsUpdatedValidation($request);
        $this->addVisaDeleveredUpdatedValidation($request);
        $delevered_visa = VisaUpdated::where('id', $request->id)->first();
        $this->visaUpdatedBasic($delevered_visa, $request);
        $this->workAndNotaryBasic($delevered_visa, $request);
        $this->checkedByAsstBasic($delevered_visa, $request);
        $this->checkedByOfficerBasic($delevered_visa, $request);
        $this->addVisaSubmitUpdatedBasic($delevered_visa, $request);
        $this->addVisaCollectedUpdatedBasic($delevered_visa, $request);
        $this->addVisaGuestCallAndSmsUpdatedBasic($delevered_visa, $request);
        $this->addVisaDeleveredUpdatedBasic($delevered_visa, $request);
        $delevered_visa->update();
        $this->removePassport($request);
        $this->visaUpdatedPassport($delevered_visa, $request);
        $this->updateTransjactionBlance($request, $delevered_visa);
        $this->transjaction($request, $delevered_visa);

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if ($old_profit) {
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $delevered_visa->id;
        $profit->guest_id = $request->client;
        $profit->staff_id = $delevered_visa->sell_person;
        $profit->profit_date = $delevered_visa->delevered_date;
        $profit->amount = $request->grand_total_price - $request->total_net_price;
        $profit->save();
        return 'VISA successfully Updated';
    }

    protected function workAndNotaryValidation($request)
    {
        $request->validate([
            'work_by' => 'required',
            'work_date' => 'required',
            'notary_by' => 'required',
            'notary_date' => 'required',
        ]);
    }

    protected function workAndNotaryBasic($visa_updated, $request)
    {
        $visa_updated->work_by = $request->work_by;
        $visa_updated->work_date = $request->work_date;
        $visa_updated->notary_by = $request->notary_by;
        $visa_updated->notary_date = $request->notary_date;
    }

    public function addVisaUpdatedWorkAndNotary(Request $request)
    {
        $this->workAndNotaryValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->workAndNotaryBasic($visa_updated, $request);
        $visa_updated->state = 2;
        $visa_updated->update();
    }

    protected function checkedByAsstValidation($request)
    {
        $request->validate([
            'checked_by_asst' => 'required',
            'checked_by_asst_date' => 'required',
        ]);
    }

    protected function checkedByAsstBasic($visa_updated, $request)
    {
        $visa_updated->checked_by_asst = $request->checked_by_asst;
        $visa_updated->checked_by_asst_date = $request->checked_by_asst_date;
    }

    public function addCheckedAsstByVisaUpdate(Request $request)
    {
        $this->checkedByAsstValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->checkedByAsstBasic($visa_updated, $request);
        $visa_updated->state = 3;
        $visa_updated->update();
    }

    protected function checkedByOffierValidation($request)
    {
        $request->validate([
            'checked_by_officer' => 'required',
            'checked_by_officer_date' => 'required',
        ]);
    }

    protected function checkedByOfficerBasic($visa_updated, $request)
    {
        $visa_updated->checked_by_officer = $request->checked_by_officer;
        $visa_updated->checked_by_officer_date = $request->checked_by_officer_date;
    }

    public function addCheckedByOfficerUpdated(Request $request)
    {
        $this->checkedByOffierValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->checkedByOfficerBasic($visa_updated, $request);
        $visa_updated->state = 4;
        $visa_updated->update();
    }

    public function addVisaSubmitUpdatedValidation($request)
    {
        $request->validate([
            'submit_by' => 'required',
            'submit_date' => 'required',
        ]);
    }

    public function addVisaSubmitUpdatedBasic($visa_updated, $request)
    {
        $visa_updated->submit_by = $request->submit_by;
        $visa_updated->submit_date = $request->submit_date;
    }

    public function addVisaSubmitUpdated(Request $request)
    {
        $this->addVisaSubmitUpdatedValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->addVisaSubmitUpdatedBasic($visa_updated, $request);
        $visa_updated->state = 5;
        $visa_updated->update();

    }

    protected function addVisaCollectedUpdatedValidation($request)
    {
        $request->validate([
            'collected_by' => 'required',
            'collected_date' => 'required',
        ]);
    }

    protected function addVisaCollectedUpdatedBasic($visa_updated, $request)
    {
        $visa_updated->collected_by = $request->collected_by;
        $visa_updated->collected_date = $request->collected_date;
    }

    public function addVisaCollectedUpdated(Request $request)
    {
        $this->addVisaCollectedUpdatedValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->addVisaCollectedUpdatedBasic($visa_updated, $request);
        $visa_updated->state = 6;
        $visa_updated->update();
    }

    protected function addVisaGuestCallAndSmsUpdatedValidation(Request $request)
    {
        $request->validate([
            'call_and_sms_by' => 'required',
            'call_and_sms_date' => 'required',
        ]);
    }

    protected function addVisaGuestCallAndSmsUpdatedBasic($visa_updated, $request)
    {
        $visa_updated->call_and_sms_by = $request->call_and_sms_by;
        $visa_updated->call_and_sms_date = $request->call_and_sms_date;
    }

    public function addVisaGuestCallAndSmsUpdated(Request $request)
    {
        $this->addVisaGuestCallAndSmsUpdatedValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->addVisaGuestCallAndSmsUpdatedBasic($visa_updated, $request);
        $visa_updated->state = 7;
        $visa_updated->update();
    }

    protected function addVisaDeleveredUpdatedValidation($request)
    {
        $request->validate([
            'delevered_by' => 'required',
            'delevered_date' => 'required',
        ]);
    }

    protected function addVisaDeleveredUpdatedBasic($visa_updated, $request)
    {
        $visa_updated->delevered_by = $request->delevered_by;
        $visa_updated->delevered_date = $request->delevered_date;
    }

    public function addVisaDeleveredUpdated(Request $request)
    {
        $this->addVisaDeleveredUpdatedValidation($request);
        $visa_updated = VisaUpdated::where('id', $request->id)->first();
        $this->addVisaDeleveredUpdatedBasic($visa_updated, $request);
        $visa_updated->state = 8;
        $visa_updated->update();
        $profit = new Profit();
        $profit->visa_id = $visa_updated->id;
        $profit->guest_id = $visa_updated->client;
        $profit->staff_id = $visa_updated->sell_person;
        $profit->profit_date = $visa_updated->delevered_date;
        $profit->amount = $visa_updated->grand_total_price - $visa_updated->total_net_price;
        $profit->save();
    }

    public function getAllWorkVisaUpdated()
    {
        $user_type = Session::get('user_type');
        $work_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 2)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'work_visa' => $work_visa,
            'user_type' => $user_type
        ]);
    }

    public function getAllCheckedByAsstVisaUpdated()
    {
        $checked_by_asst_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 3)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'checked_by_asst_visa' => $checked_by_asst_visa
        ]);
    }

    public function getAllCheckedByOfficerVisaUpdated()
    {
        $checked_officer_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 4)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'checked_officer_visa' => $checked_officer_visa
        ]);
    }

    public function getAllSubmitVisaUpdated()
    {
        $submit_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 5)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'submit_visa' => $submit_visa
        ]);
    }

    public function getAllCollectedVisaUpdated()
    {
        $collected_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 6)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'collected_visa' => $collected_visa
        ]);
    }

    public function getAllGCSVisaUpdated()
    {
        $gcs_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 7)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'gcs_visa' => $gcs_visa
        ]);
    }

    public function getAllDeleveredVisaUpdated()
    {
        $delelvered_visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name');
        }])->where('state', 8)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'delelvered_visa' => $delelvered_visa
        ]);
    }

    public function getAlltaff()
    {
        $all_visa_staff = Staff::orderBy('first_name')->where('department', 4)->get();
        return response()->json([
            'all_visa_staff' => $all_visa_staff
        ]);
    }

    public function getAllVisaSearch($search){
        $len = strlen($search);
        if($len == 9){
            $visa_count = 1;
            $pass_visa_id = [];
            $passports = Passport::where('passport_number', $search)->get();
            $passport_count = count($passports);
            if($passport_count > 0){
                foreach ($passports as $key => $passport){
                    $pass_visa_id[$key] = $passport->visa_updated_id;
                }
                $recieved_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 1)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);

                $work_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 2)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);
                $checked_by_asst_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 3)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);
                $checked_by_officer_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 4)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);
                $submit_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 5)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);
                $collected_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 6)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);
                $gcs_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 7)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);
                $delelvered_visas = VisaUpdated::with(['guest' => function ($q) {
                    $q->select('id', 'name', 'phone_number');
                }])
                    ->where('state', 8)
                    ->whereIn('id', $pass_visa_id)
                    ->paginate(10);

                return response()->json([
                    'visa_count' => $visa_count,
                    'recieved_visas' => $recieved_visas,
                    'work_visas' => $work_visas,
                    'checked_by_asst_visas' => $checked_by_asst_visas,
                    'checked_by_officer_visas' => $checked_by_officer_visas,
                    'submit_visas' => $submit_visas,
                    'collected_visas' => $collected_visas,
                    'gcs_visas' => $gcs_visas,
                    'delelvered_visas' => $delelvered_visas,
                ]);
            }
        }
        $guest_id = [];
        $visa_count = 0;
        $visa = VisaUpdated::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('id', $search)->get();
        $visa_c = count($visa);
        if ($visa_c == 0) {
            $guests = Guest::where('name', 'like', $search . '%')->orWhere('phone_number', 'like', $search . '%')->select('id', 'name', 'phone_number')->get();
            foreach ($guests as $key => $guest) {
                $guest_id[$key] = $guest->id;
            }
            $visas = VisaUpdated::whereIn('client', $guest_id)->get();
            $visa_count = 2;
            $recieved_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 1)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $work_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 2)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $checked_by_asst_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 3)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $checked_by_officer_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 4)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $submit_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 5)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $collected_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 6)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $gcs_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 7)
                ->whereIn('client', $guest_id)
                ->paginate(10);
            $delelvered_visas = VisaUpdated::with(['guest' => function ($q) {
                $q->select('id', 'name', 'phone_number');
            }])
                ->where('state', 8)
                ->whereIn('client', $guest_id)
                ->paginate(10);


            return response()->json([
                'visa_count' => $visa_count,
                'recieved_visas' => $recieved_visas,
                'work_visas' => $work_visas,
                'checked_by_asst_visas' => $checked_by_asst_visas,
                'checked_by_officer_visas' => $checked_by_officer_visas,
                'submit_visas' => $submit_visas,
                'collected_visas' => $collected_visas,
                'gcs_visas' => $gcs_visas,
                'delelvered_visas' => $delelvered_visas,
            ]);
        }
        return response()->json([
            'visa_count' => $visa_count,
            'visa' => $visa
        ]);

    }
    public function getAllVisaStaffsBy(){
        $staffs = Staff::where('department', 4)->orderBy('first_name', 'asc')->get();
        return response()->json([
            'staffs' => $staffs
        ]);
    }
}
