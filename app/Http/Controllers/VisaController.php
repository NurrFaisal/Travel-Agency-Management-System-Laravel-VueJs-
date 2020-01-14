<?php

namespace App\Http\Controllers;

use App\model\Transjaction;
use App\model\Visa;
use App\Profit;
use Illuminate\Http\Request;
use Session;

class VisaController extends Controller
{
    protected function newVisaValidation($request){
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'pp_number' => 'required',
            'no_of_books' => 'required|numeric',
            'pp_issue_date' => 'required|date',
            'pp_expire_date' => 'required|date',
            'country' => 'required|numeric',
            'type' => 'required|numeric',
            'suplier' => 'required|numeric',
            'reference' => 'required|numeric',
            'net_price' => 'required|numeric',
            'price' => 'required|numeric',
            'advance' => 'required|numeric',
            'sales_person' => 'required|numeric',
            'received_date' => 'required|date',
            'payment_status' => 'required|numeric',
        ]);
    }

    protected function addWorkAndNotaryValidation($request){
        $request->validate([
            'work_by' => 'required|numeric',
            'work_date' => 'required|date',
            'notary_by' => 'required|numeric',
            'notary_date' => 'required',
        ]);
    }
    protected function newVisaBasic($request, $visa){
        $visa->name = $request->name;
        $visa->phone_number = $request->phone_number;
        $visa->date_of_birth = $request->date_of_birth;
        $visa->pp_number = $request->pp_number;
        $visa->no_of_books = $request->no_of_books;
        $visa->pp_issue_date = $request->pp_issue_date;
        $visa->pp_expire_date = $request->pp_expire_date;
        $visa->country = $request->country;
        $visa->type = $request->type;
        $visa->suplier = $request->suplier;
        $visa->reference = $request->reference;
        $visa->net_price = $request->net_price;
        $visa->price = $request->price;
        $visa->advance = $request->advance;
        $visa->sales_person = $request->sales_person;
        $visa->received_date = $request->received_date;
        $visa->narration = $request->narration;
        $visa->payment_status = $request->payment_status;
    }

    public function addVisa(Request $request){
        $this->newVisaValidation($request);
        $visa = new Visa();
        $this->newVisaBasic($request, $visa);
        $visa->save();

        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $request->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'visa added';
    }

    public function getAllRecievedVisa(){
        $recieved_visa = Visa::where('state', 1)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'recieved_visa' => $recieved_visa
        ]);
    }
    public function getAllWorkVisa(){
        $work_visa = Visa::where('state', 2)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'work_visa' => $work_visa
        ]);
    }

    protected function addVisaWorkAndNotaryValidation($request){
        $request->validate([
            'id' => 'required|numeric',
            'work_by' => 'required|numeric',
            'work_date' => 'required|date',
            'notary_by' => 'required|numeric',
            'notary_date' => 'required|date',
        ]);
    }

    public function addVisaWorkAndNotary(Request $request){
        $this->addVisaWorkAndNotaryValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date= $request->notary_date;
        $visa->state = 2;
        $visa->update();;
        return 'work and notary info added successfully';
    }
    protected function addCheckedByAsstValidation($request){
        $request->validate([
            'checked_by_asst' => 'required|numeric',
            'checked_by_asst_date' => 'required|date',
        ]);
    }
    public function addCheckedByAsst(Request $request){
        $this->addCheckedByAsstValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->state = 3;
        $visa->update();
        return 'checked By Asst info Updated';
    }
    public function getAllCheckedByAsstVisa(){
        $checked_by_asst_visa = Visa::where('state', 3)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'checked_by_asst_visa' => $checked_by_asst_visa
        ]);
    }
    protected function addCheckedByOfficerValidation($request){
        $request->validate([
            'checked_by_officer' => 'required|numeric',
            'checked_by_officer_date' => 'required|date'
        ]);
    }
    public function addCheckedByOfficer(Request $request){
        $this->addCheckedByOfficerValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $visa->checked_by_officer = $request->checked_by_officer;
        $visa->checked_by_officer_date = $request->checked_by_officer_date;
        $visa->state = 4;
        $visa->update();
        return 'checked by officer info updated successfully';
    }
    public function getAllCheckedByOfficerVisa(){
        $checked_officer_visa = Visa::where('state', 4)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'checked_officer_visa' => $checked_officer_visa
        ]);
    }
    protected function addVisaSubmitValidation($request){
        $request->validate([
            'submit_by' => 'required|numeric',
            'submit_date' => 'required|date',
        ]);
    }
    public function addVisaSubmit(Request $request){
        $this->addVisaSubmitValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $visa->submit_by = $request->submit_by;
        $visa->submit_date = $request->submit_date;
        $visa->state = 5;
        $visa->update();
        return 'Visa Submit info Updated Successfully';
    }

    public function getAllSubmitVisa(){
        $submit_visa = Visa::where('state', 5)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'submit_visa' => $submit_visa
        ]);
    }
    protected function addVisaCollectedValidation($request){
        $request->validate([
            'collected_by' => 'required|numeric',
            'collected_date' => 'required|date'
        ]);
    }
    public function addVisaCollected(Request $request){
        $this->addVisaCollectedValidation($request);
        $collected_visa = Visa::where('id', $request->id)->first();
        $collected_visa->collected_by = $request->collected_by;
        $collected_visa->collected_date = $request->collected_date;
        $collected_visa->state = 6;
        $collected_visa->update();
        return 'Add Collected Visa info Updated Successfully';
    }
    public function getAllCollectedVisa(){
        $collected_visa = Visa::where('state', 6)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'collected_visa' => $collected_visa
        ]);
    }
    protected function addVisaGuestCallAndSmsValidation($request){
        $request->validate([
            'call_and_sms_by' => 'required|numeric',
            'call_and_sms_date' => 'required|date',
        ]);
    }

    public function addVisaGuestCallAndSms(Request $request){
        $this->addVisaGuestCallAndSmsValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $visa->call_and_sms_by = $request->call_and_sms_by;
        $visa->call_and_sms_date = $request->call_and_sms_date;
        $visa->state = 7;
        $visa->update();
        return 'Guest Call And Sms Info Updated Successfully';
    }
    public function getAllGCSVisa(){
        $gcs_visa = Visa::where('state', 7)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'gcs_visa' => $gcs_visa
        ]);
    }

    protected function addVisaDeleveredValidation($request){
        $request->validate([
            'delevered_by' => 'required|numeric',
            'delevered_date' => 'required|date'
        ]);
    }
    public function addVisaDelevered(Request $request){
        $this->addVisaDeleveredValidation($request);
        $delevered_visa = Visa::where('id', $request->id)->first();
        $delevered_visa->delevered_by = $request->delevered_by;
        $delevered_visa->delevered_date = $request->delevered_date;
        $delevered_visa->state = 8;
        $delevered_visa->update();
        return 'Delevered Date and Person Added Successfully';
    }
    public function getAllDeleveredVisa(){
        $delevered_visa = Visa::where('state', 8)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'delelvered_visa' => $delevered_visa
        ]);
    }

    // Edit Visa Start

    public function editReceivedVisa($id){
        $received_visa = Visa::where('id', $id)->first();
        return response()->json([
            'received_visa' => $received_visa
        ]);
    }
    public function updateReceivedVisa(Request $request){
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->update();
        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();


        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'received visa updated successfully';
    }

    public function editWorkAndNotaryVisa($id){
        $work_visa = Visa::where('id', $id)->first();
        return response()->json([
            'work_visa' => $work_visa
        ]);
    }
    public function updateWorkAndNotaryVisa(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();


        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Work And Notary Visa Updated Successfully';
    }

    public function editCheckedByAsst($id){
        $checked_by_asst = Visa::where('id', $id)->first();
        return response()->json([
            'checked_by_asst' => $checked_by_asst
        ]);
    }

    public function updateCheckedByAsst(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $this->addCheckedByAsstValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();


        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Checked By Asst Visa Updated Successfully';
    }


    // Edit Checked By Officer Start
    public function editCheckedByOfficer($id){
        $checked_by_officer = Visa::where('id', $id)->first();
        return response()->json([
            'checked_by_officer' => $checked_by_officer
        ]);
    }


    public function updateCheckedByOfficer(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $this->addCheckedByAsstValidation($request);
        $this->addCheckedByOfficerValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->checked_by_officer = $request->checked_by_officer;
        $visa->checked_by_officer_date = $request->checked_by_officer_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();
        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Checked By Officer Visa Updated Successfully';
    }

    // Edit Checked By Officer End

    // Edit Submited Visa Start
    public function editSubmitedVisa($id){
        $submited_visa = Visa::where('id', $id)->first();
        return response()->json([
            'submited_visa' => $submited_visa
        ]);
    }

    public function updateSubmitVisa(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $this->addCheckedByAsstValidation($request);
        $this->addCheckedByOfficerValidation($request);
        $this->addVisaSubmitValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->checked_by_officer = $request->checked_by_officer;
        $visa->checked_by_officer_date = $request->checked_by_officer_date;
        $visa->submit_by = $request->submit_by;
        $visa->submit_date = $request->submit_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();

        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Submit Visa Updated Successfully';
    }

    // Edit Submited Visa End

    // Edit Collected Visa Start
    public function editCollectedVisa($id){
        $collected_visa = Visa::where('id', $id)->first();
        return response()->json([
            'collected_visa' => $collected_visa
        ]);
    }

    public function updateCollectedVisa(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $this->addCheckedByAsstValidation($request);
        $this->addCheckedByOfficerValidation($request);
        $this->addVisaSubmitValidation($request);
        $this->addVisaCollectedValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->checked_by_officer = $request->checked_by_officer;
        $visa->checked_by_officer_date = $request->checked_by_officer_date;
        $visa->submit_by = $request->submit_by;
        $visa->submit_date = $request->submit_date;
        $visa->collected_by = $request->collected_by;
        $visa->collected_date = $request->collected_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();

        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Collected Visa Updated Successfully';
    }
    // Edit Collected Visa End

    // Edit Call And Sms Visa Start
    public function editCallAndSmsVisa($id){
        $call_and_sms_visa = Visa::where('id', $id)->first();
        return response()->json([
            'call_and_sms_visa' => $call_and_sms_visa
        ]);
    }

    public function updateCallAndSmsVisa(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $this->addCheckedByAsstValidation($request);
        $this->addCheckedByOfficerValidation($request);
        $this->addVisaSubmitValidation($request);
        $this->addVisaCollectedValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->checked_by_officer = $request->checked_by_officer;
        $visa->checked_by_officer_date = $request->checked_by_officer_date;
        $visa->submit_by = $request->submit_by;
        $visa->submit_date = $request->submit_date;
        $visa->collected_by = $request->collected_by;
        $visa->collected_date = $request->collected_date;
        $visa->call_and_sms_by = $request->call_and_sms_by;
        $visa->call_and_sms_date = $request->call_and_sms_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();

        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Call And Sms By Visa Updated Successfully';
    }
    // Edit Call And Sms Visa End


    // Edit Delevered Visa Start
    public function editDeleveredVisa($id){
        $delevered_visa = Visa::where('id', $id)->first();
        return response()->json([
            'delevered_visa' => $delevered_visa
        ]);
    }

    public function updateDeleveredVisa(Request $request){
        $this->newVisaValidation($request);
        $this->addWorkAndNotaryValidation($request);
        $this->addCheckedByAsstValidation($request);
        $this->addCheckedByOfficerValidation($request);
        $this->addVisaSubmitValidation($request);
        $this->addVisaCollectedValidation($request);
        $visa = Visa::where('id', $request->id)->first();
        $this->newVisaBasic($request, $visa);
        $visa->work_by = $request->work_by;
        $visa->work_date = $request->work_date;
        $visa->notary_by = $request->notary_by;
        $visa->notary_date = $request->notary_date;
        $visa->checked_by_asst = $request->checked_by_asst;
        $visa->checked_by_asst_date = $request->checked_by_asst_date;
        $visa->checked_by_officer = $request->checked_by_officer;
        $visa->checked_by_officer_date = $request->checked_by_officer_date;
        $visa->submit_by = $request->submit_by;
        $visa->submit_date = $request->submit_date;
        $visa->collected_by = $request->collected_by;
        $visa->collected_date = $request->collected_date;
        $visa->call_and_sms_by = $request->call_and_sms_by;
        $visa->call_and_sms_date = $request->call_and_sms_date;
        $visa->delevered_by = $request->delevered_by;
        $visa->delevered_date = $request->delevered_date;
        $visa->update();

        $old_profit = Profit::where('visa_id', $request->id)->first();
        if($old_profit){
            $old_profit->delete();
        }
        $profit = new Profit();
        $profit->visa_id = $visa->id;
        $profit->guest_id = $request->reference;
        $profit->staff_id = $request->sales_person;
        $profit->profit_date = $visa->created_at->format('Y-m-d');
        $profit->amount = $request->price - $request->net_price;
        $profit->save();

        $update_first_transjaction = Transjaction::orderBy('id', 'desc')->where('visa_id', $request->id)->first();
        $update_first_transjaction->narration = 'Updated Visa Transjaction 1st ( V-'.$update_first_transjaction->visa_id.' )';
        $update_first_transjaction->update();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $update_scond_transjaction = new Transjaction();
        $update_scond_transjaction->guest_id = $update_first_transjaction->guest_id;
        $update_scond_transjaction->staff_id = $update_first_transjaction->staff_id;
        $update_scond_transjaction->visa_id = $update_first_transjaction->visa_id;
        $update_scond_transjaction->narration = 'Updated Visa Transjaction 2nd ( P-'.$update_first_transjaction->visa_id.' )';
        $update_scond_transjaction->transjaction_date = $visa->updated_at->format('Y-m-d');
        $update_scond_transjaction->debit_amount = $update_first_transjaction->credit_amount;
        $update_scond_transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->blance = $pre_transjaction_blance->blance + $update_first_transjaction->credit_amount;
        $update_scond_transjaction->save();

        $pre_guest_transjaction_blance = Transjaction::where('guest_id', $request->reference)->orderBy('id', 'desc')->select('id', 'guest_id', 'transjaction_date', 'narration', 'guest_blance')->first();
        $pre_staff_transjaction_blance = Transjaction::where('staff_id', $request->sales_person)->orderBy('id', 'desc')->select('id', 'staff_id', 'transjaction_date', 'narration', 'staff_blance')->first();
        $pre_transjaction_blance = Transjaction::orderBy('id', 'desc')->select('id', 'transjaction_date', 'narration', 'blance')->first();

        $transjaction = new Transjaction();
        $transjaction->guest_id = $request->reference;
        $transjaction->staff_id = $request->sales_person;
        $transjaction->visa_id = $visa->id;
        $transjaction->narration = $visa->narration;
        $transjaction->transjaction_date = $visa->created_at->format('Y-m-d');
        $transjaction->credit_amount = $request->price;
        if($pre_guest_transjaction_blance == null){
            $transjaction->guest_blance = -$request->price;
        }else{
            $transjaction->guest_blance = $pre_guest_transjaction_blance->guest_blance - $request->price;
        }
        if($pre_staff_transjaction_blance == null){
            $transjaction->staff_blance = -$request->price;
        }else{
            $transjaction->staff_blance = $pre_staff_transjaction_blance->staff_blance - $request->price;
        }
        if($pre_transjaction_blance == null){
            $transjaction->blance = -$request->price;
        }else{
            $transjaction->blance = $pre_transjaction_blance->blance - $request->price;
        }
        $transjaction->save();
        return 'Delevered Visa Updated Successfully';
    }
    // Edit Delevered Visa End

    // Edit Visa End

}
