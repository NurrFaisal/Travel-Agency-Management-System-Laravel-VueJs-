<?php

namespace App\Http\Controllers;

use App\Profit;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function getAllProfit(){
        $profits = Profit::with(['guest' =>function($q){$q->select('id', 'name', 'phone_number');}, 'staff' => function($q){$q->select('id', 'first_name', 'last_name');}])
            ->orderBy('profit_date', 'asc')
            ->paginate(10);
        return response()->json([
            'profits' => $profits
        ]);
    }
    public function getAllProfitSearch($search){
        $profits = Profit::with(['guest' =>function($q){$q->select('id', 'name', 'phone_number');}, 'staff' => function($q){$q->select('id', 'first_name', 'last_name');}])
            ->where('profit_date', 'like', $search.'%')
            ->orWhere('amount', 'like', $search.'%')
            ->orderBy('profit_date', 'asc')
            ->paginate(10);
        return response()->json([
            'profits' => $profits
        ]);
    }
}
