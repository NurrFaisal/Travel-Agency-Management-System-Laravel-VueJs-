<?php

namespace App\Http\Controllers;

use App\model\Package;
use Illuminate\Http\Request;

class PackageInvoiceController extends Controller
{
    public function getAllInvoice()
    {
        $invoice = Package::with(['guest' => function ($q) {
            $q->select('id', 'name', 'phone_number');
        }])->where('state', 12)->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'invoice' => $invoice
        ]);
    }
}
