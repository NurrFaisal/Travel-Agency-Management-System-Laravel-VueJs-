<?php

namespace App\model;

use App\Passport;
use Illuminate\Database\Eloquent\Model;

class VisaUpdated extends Model
{
    protected $fillable = [ 'total_net_price', 'total_price', 'total_others_price', 'grand_total_price', 'client', 'sell_person', 'received_date', 'invoice_narration'];

    public function passports(){
        return $this->hasMany(Passport::class, 'visa_updated_id', 'id');
    }
    public function guest(){
        return $this->belongsTo(Guest::class, 'client');
    }
    public function staff(){
        return $this->belongsTo(Staff::class, 'sell_person');
    }

}
