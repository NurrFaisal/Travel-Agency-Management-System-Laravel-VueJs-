<?php

namespace App\Http\Controllers;


use App\model\GuestTitle;
use Illuminate\Http\Request;
use Session;

class GuestTitleController extends Controller
{
    public function addGuestTitle(Request $request)
    {
        $request->validate([
            'guest_title' => 'required|min:3|max:50'
        ]);
        $guest_title = new  GuestTitle();
        $guest_title->slug = str_slug($request->guest_title);
        $guest_title->guest_title = $request->guest_title;
        $guest_title->save();
        return 'save';
    }

    public function getAllGuestTitle()
    {
        $all_guest_titles = GuestTitle::orderBy('updated_at', 'desc')->get();
        return response()->json([
            'all_guest_titles' => $all_guest_titles
        ], 200);
    }

    public function getAllGuestTitleForSelect()
    {
        $all_guest_titles = GuestTitle::orderBy('guest_title')->get();
        return response()->json([
            'all_guest_titles' => $all_guest_titles
        ], 200);
    }

    public function deleteGuestTitle($id)
    {
        $guest_title = GuestTitle::find($id);
        $guest_title->delete();
        return 'Delete Guest Title';
    }

    public function editGuestTitle($id)
    {
        $user_type = Session::get('user_type');
        $guest_title_info = GuestTitle::find($id);
        return response()->json([
            'guest_title_info' => $guest_title_info,
            'user_type' => $user_type
        ], 200);
    }

    public function updateGuestTitle(Request $request)
    {
        $request->validate([
            'guest_title' => 'required|min:3|max:50'
        ]);
        $guest_title = GuestTitle::where('id', $request->id)->first();
        $guest_title->slug = str_slug($request->guest_title);
        $guest_title->guest_title = $request->guest_title;
        $guest_title->update();
        return 'update';
    }

    public function getAllGetTitleNew($query)
    {
        $all_guest_titles = GuestTitle::where('guest_title', 'like', $query . '%')->select('id', 'guest_title')->orderBy('guest_title', 'asc')->get();
        return response()->json([
            'customers' => $all_guest_titles
        ], 200);
    }
}
