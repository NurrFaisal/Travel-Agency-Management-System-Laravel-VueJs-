<?php

namespace App;

use App\model\Guest;
use App\model\Pax;
use App\model\Staff;
use Illuminate\Database\Eloquent\Model;

class Airticket extends Model
{
    protected $fillable = [ 'destination', 'adult_qty', 'adult_price','adult_total_price','child_qty','child_price', 'child_total_price','infant_qty','infant_price','infant_total_price','ssr_qty', 'ssr_price', 'ssr_total_price', 'service_amount', 'total_amount', 'total_net_price', 'total_price', 'selling_to', 'sell_person', 'word','note', 'journey_date', 'return_date', 'ticket_class', 'food_rules', 'narration', 'ticket_type', 'ticket_rules', 'luggages_rules', 'luggages_rules_description', 'hand_luggages_rules', 'hand_luggages_rules_description'];

    public function staff(){
        return $this->belongsTo(Staff::class, 'sell_person');
    }

    public function guest(){
        return $this->belongsTo(Guest::class, 'selling_to');
    }

    public function empolyees(){
        return $this->hasMany(SubAirticket::class, 'airticket_id', 'id');
    }
    public function paxs(){
        return $this->hasMany(Pax::class, 'airticket_id', 'id');
    }

}
