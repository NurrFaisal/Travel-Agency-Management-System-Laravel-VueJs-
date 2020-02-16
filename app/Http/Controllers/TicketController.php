<?php

namespace App\Http\Controllers;

use App\SubAirticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function getAllAirTicket(){
        $date = Carbon::now()->format('Y-m-d');
        $tickets = SubAirticket::with('airlines')->where('departure_date', $date)->orWhere('departure_date', '>', $date)->orderBy('departure_date', 'asc')->paginate(10);
        return response()->json([
            'tickets' => $tickets
        ]);
    }
    public function getAllTicketSearch($search){
        $tickets = SubAirticket::with('airlines')->where('airticket_id', $search)->orWhere('departure_date', 'like', $search.'%')->orWhere('return_date', 'like', $search.'%')->orWhere('pnr', 'like', $search.'%')->orderBy('departure_date', 'asc')->paginate(10);
        return response()->json([
            'tickets' => $tickets
        ]);
    }
}
