<?php

namespace App\Http\Controllers;

use App\model\ExpenceHead;
use Illuminate\Http\Request;

class ExpenceHeadController extends Controller
{
    public function addExpenceHead(Request $request)
    {
        $expence_head = new ExpenceHead();
        $expence_head->name = $request->name;
        $expence_head->save();
        return 'Expence Head Added Successfully';
    }

    public function getAllExpenceHead()
    {
        $expence_heads = ExpenceHead::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'expence_heads' => $expence_heads
        ]);
    }

    public function editExpenceHead($id)
    {
        $expence_head = ExpenceHead::where('id', $id)->first();
        return response()->json([
            'expence_head' => $expence_head
        ]);
    }

    public function updateExpenceHead(Request $request)
    {
        $expence_head = ExpenceHead::where('id', $request->id)->first();
        $expence_head->name = $request->name;
        $expence_head->update();
        return 'Expence Head Updated Successfully';
    }

}
