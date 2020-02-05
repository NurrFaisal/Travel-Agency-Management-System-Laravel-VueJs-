<?php

namespace App\Http\Controllers;

use App\ReceivedLoanHead;
use Illuminate\Http\Request;

class ReceivedLoanHeadController extends Controller
{
    public function addReceivedLoanHead(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $rl_head = new ReceivedLoanHead();
        $rl_head->name = $request->name;
        $rl_head->save();
        return 'Received Loan Head Added Successfully';
    }
    public function getAllReceivedLoanHead(){
        $rl_heads = ReceivedLoanHead::orderBy('name')->get();
        return response()->json([
            'rl_heads' => $rl_heads
        ]);
    }
    public function getReceivedLoanHead($id){
        $rl_head = ReceivedLoanHead::where('id', $id)->first();
        return response()->json([
            'rl_head' => $rl_head
        ]);
    }
    public function updateReceivedLoanHead(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        $rl_head = ReceivedLoanHead::where('id', $request->id)->first();
        $rl_head->name = $request->name;
        $rl_head->update();
        return 'Update Received Loan Head';
    }
}
