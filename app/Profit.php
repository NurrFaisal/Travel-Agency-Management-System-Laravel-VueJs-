<?php

namespace App;

use App\model\Guest;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $fillable = ['staff_id', 'guest_id', 'air_id', 'pack_id', 'visa_id', 'hotel_id', 'profit_date', 'amount'];

    public function guest(){
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
