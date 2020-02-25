<?php

namespace App\model;

use App\SubAirticket;
use Illuminate\Database\Eloquent\Model;

class AirTicketRefund extends Model
{
    protected $guarded =[];

    public function subAirTicket(){
        return $this->belongsTo(SubAirticket::class, 'ticket_id');
    }
}
