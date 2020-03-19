<?php

namespace App\Http\Controllers;

use App\model\Other;
use Illuminate\Http\Request;

class OthersController extends Controller
{
    public function getAllOthers()
    {
        $other_books = Other::orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'other_books' => $other_books
        ]);
    }
}
