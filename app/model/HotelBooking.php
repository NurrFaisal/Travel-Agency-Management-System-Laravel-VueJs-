<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    protected $fillable = ['id','customer_name', 'phone_number', 'total_price', 'client', 'sell_person'];

    public function guest(){
        return $this->belongsTo(Guest::class, 'client');
    }
    public function staff(){
        return $this->belongsTo(Staff::class, 'sell_person');
    }
    public function hotels(){
        return $this->hasMany(Hotel::class,  'hotel_booking_id', 'id' );
    }
}
