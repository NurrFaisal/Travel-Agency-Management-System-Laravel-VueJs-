<?php

namespace App\Http\Controllers;

use App\model\VisaCategory;
use Illuminate\Http\Request;

class VisaCategoryController extends Controller
{
    public function addVisaCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $visa_category = new VisaCategory();
        $visa_category->name = $request->name;
        $visa_category->save();
        return 'success';
    }

    public function getAllVisaCategory()
    {
        $visa_category = VisaCategory::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'visa_category' => $visa_category
        ]);
    }

    public function editVisaCategory($id)
    {
        $visa_category = VisaCategory::where('id', $id)->first();
        return response()->json([
            'visa_category' => $visa_category
        ]);
    }

    public function updateVisaCategory(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $visa_category = VisaCategory::where('id', $request->id)->first();
        $visa_category->name = $request->name;
        $visa_category->update();
        return 'updated';
    }

    public function deleteVisaCategory($id)
    {
        $visa_category = VisaCategory::where('id', $id)->first();
        $visa_category->delete();
        return 'delete';
    }
}
