<?php

namespace App\Http\Controllers;

use App\model\GuestQuery;
use Illuminate\Http\Request;
use Validator;
use Session;

class GuestQueryController extends Controller
{
    protected function guestQueryValition($request){
        $request->validate([
            'guest_id' => 'required',
            'subject' => 'required',
            'guest_query' => 'required',
            'follow_up' => 'required',
            'status' => 'required'
        ]);
    }
    public function addGuestQuery(Request $request){
        $guest_qurey = new GuestQuery();
        $this->guestQueryValition($request);
        $guest_qurey->guest_id = $request->guest_id;
        $guest_qurey->staff_id = Session::get('staff_id');
        $guest_qurey->subject = $request->subject;
        $guest_qurey->guest_query = $request->guest_query;
        $guest_qurey->follow_up =  $request->follow_up;
        $guest_qurey->status = $request->status;
        $guest_qurey->save();
        return 'save';
    }
    public function getAllguestQuery(){
        $guest_query = GuestQuery::with(['staff' => function($q){$q->select('id', 'last_name');}, 'Guest' => function($q){ $q->select('id', 'name');}])->orderBy('updated_at', 'desc')->get();
        return response()->json([
            'guest_query' => $guest_query
        ]);
    }
    public function editGuestQuery($id){
        $guest_query = GuestQuery::with('guest')->where('id', $id)->first();
        return response()->json([
            'guest_query' => $guest_query
        ]);
    }
    public function updateGuestQuery(Request $request){
        $guest_query = GuestQuery::where('id', $request->id)->first();
        $guest_query->guest_id = $request->guest_id;
        $guest_query->subject = $request->subject;
        $guest_query->guest_query = $request->guest_query;
        $guest_query->follow_up =  $request->follow_up;
        $guest_query->status = $request->status;
        $guest_query->update();
        return 'update';
    }
    public function deleteGuestQuery($id){
        $guest_query = GuestQuery::where('id', $id)->first();
        $guest_query->delete();
        return 'delete';
    }
}
