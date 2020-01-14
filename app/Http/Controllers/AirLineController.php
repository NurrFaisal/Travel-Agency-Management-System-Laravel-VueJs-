<?php

namespace App\Http\Controllers;

use App\model\AirLine;
use Illuminate\Http\Request;

class AirLineController extends Controller
{
    public function addAirLine(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $air_line = new AirLine();
        $air_line->name = $request->name;
        $air_line->save();
        return 'save';
    }

    public function getAllAirLine(){
        $air_line = AirLine::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'air_line' => $air_line
        ]);
    }

    public function editAirLine($id){
        $air_line = AirLine::where('id', $id)->first();
        return response()->json([
            'air_line' => $air_line
        ]);
    }
    public function updateAirLine(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $air_line = AirLine::where('id', $request->id)->first();
        $air_line->name = $request->name;
        $air_line->update();
        return 'update';

    }
    public function deleteAirLine($id){
        $air_line = AirLine::where('id', $id)->first();
        $air_line->delete();
        return 'delete';
    }
}
