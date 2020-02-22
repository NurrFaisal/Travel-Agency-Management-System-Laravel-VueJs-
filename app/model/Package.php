<?php

namespace App\model;

use App\PackageDay;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['guest', 'country','destination', 'duration', 'query_date', 'journey_date', 'return_date', 'pax', 'adult', 'child', 'infant', 'hotel_type', 'room_type', 'tour_by', 'query_note', 'follow_up_for_price_to_suplier', '	itinerary_cost_submit_date', 'guest_reaction', 'guest_confirm_date', 'guest_confirm_note', 'confirm_mail_to_suplier_date', 'confirm_mail_to_suplier_note', 'v_submit_to_embassy_date', 'v_visa_done_date', 'v_delivery_to_guest_date', 'ready_for_delivery', 'price', 'advance', 'document_collection_by_date', 'document_collection_by_note', 'confirm_date_of_journey', 'state', 'status'];


    public function guestt(){
        return $this->belongsTo(Guest::class, 'guest');
    }
    public function package_days(){
        return $this->hasMany(PackageDay::class, 'package_id');
    }
    public function stafft(){
        return $this->belongsTo(Staff::class, 'staff');
    }
    public function net_prices(){
        return $this->hasMany(PackageNetPrice::class, 'pack_id');
    }
    public function follow_up_to_suplier(){
        return $this->hasMany(FollowUPToSuplier::class, 'package_id');
    }
    public function follow_up_to_guest(){
        return $this->hasMany(FollowUPtoGuest::class, 'package_id');
    }
    public function package_net_price(){
        return $this->hasMany(PackageNetPrice::class, 'pack_id');
    }


//    public function getPackageTypeAttribute($value){
//        if($value == 1){
//            return 'FIT';
//        }
//        if($value == 2){
//            return 'Customise';
//        }
//        if($value == 3){
//            return 'Regular';
//        }
//        if($value == 4){
//            return 'Cosmos Group Tour';
//        }
//        if($value == 5){
//            return 'Eid Group';
//        }
//        if($value == 6){
//            return 'Eid FIT';
//        }
//        if($value == 7){
//            return 'Student Group';
//        }
//        if($value == 8){
//            return 'Corporate Group';
//        }
//        if($value == 9){
//            return 'VIP Group';
//        }
//        if($value == 10){
//            return 'Others';
//        }
//
//
//
//
//    }
}
