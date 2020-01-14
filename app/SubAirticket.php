<?php

namespace App;

use App\model\AirLine;
use Illuminate\Database\Eloquent\Model;

class SubAirticket extends Model
{
    protected $fillable = ['airticket_id', 'issue_date', 'departure_date', 'return_date', 'air_lines', 'pnr', '	sector', '	net_price', 'price', 'suplier'];

    public function airlines(){
        return $this->belongsTo(AirLine::class, 'air_lines');
    }
}
