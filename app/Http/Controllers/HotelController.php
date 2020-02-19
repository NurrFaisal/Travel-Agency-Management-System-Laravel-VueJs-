<?php

namespace App\Http\Controllers;

use App\model\Hotel;
use App\Passport;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function getAllHotel(){
        $hotels = Hotel::with(['suplier' => function($q){$q->select('id', 'name');}])->orderBy('created_at', 'desc')->paginate(10);
        return response()->json([
            'hotels' => $hotels
        ]);
    }
    public function getAllHotelSearch($search){
        $hotels = Hotel::with(['suplier' => function($q){$q->select('id', 'name');}])->where('hotel_booking_id', 'like', $search.'%')->orWhere('hotel_booking_ref', 'like', $search.'%')->orWhere('hotel_name', 'like', $search.'%')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json([
            'hotels' => $hotels
        ]);
    }
}
