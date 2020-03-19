<?php

namespace App\Http\Controllers;

use App\model\Staff;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function getAllAirTicketStarff()
    {
        $air_ticket_staff = Staff::where('department', 3)->select('id', 'first_name', 'last_name')->get();
        return response()->json([
            'air_ticket_staff' => $air_ticket_staff
        ]);
    }
}
