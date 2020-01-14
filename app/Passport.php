<?php

namespace App;

use App\model\VisaCategory;
use App\model\VisaCountry;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $fillable = ['visa_updated_id', 'name', 'passport_number', 'no_of_books', 'date_of_birth', 'expire_date', 'type', 'country', 'suplier', 'net_price', 'price', 'others_price', 'narration'];

    public function typet(){
        return $this->belongsTo(VisaCategory::class, 'type');
    }
    public function countryt(){
        return $this->belongsTo(VisaCountry::class, 'country');
    }
}
