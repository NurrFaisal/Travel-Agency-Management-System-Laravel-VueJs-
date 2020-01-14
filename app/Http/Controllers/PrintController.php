<?php

namespace App\Http\Controllers;

use App\Airticket;
use App\model\HotelBooking;
use App\model\Package;
use App\model\VisaUpdated;
use PDF;
use Illuminate\Http\Request;
use Session;


class PrintController extends Controller
{
    public function invoicePrint(){
        return view('cosmosHoliday.page.invoice');
    }

    public function downloadInvoice(){
        $data = ['one', 'two', 'three', 'four', 'five', 'six', 'seven'];
        $pdf = PDF::loadView('cosmosHoliday.page.invoice',[
            'data' => $data
        ])->setPaper('a4');;
        return $pdf->stream('invoice.pdf');
    }

    public function invoicePrintAirTicket($id){
        $air_ticket = Airticket::with(['staff' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guest' => function($q){$q->with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->select('id', 'name','phone_number', 'email_address', 'rf_staff', 'address');}, 'empolyees' => function($q){$q->with('airlines')->select('airticket_id', 'issue_date', 'departure_date', 'return_date', 'air_lines', 'pnr', 'sector', 'net_price', 'price', 'suplier');}, 'paxs' => function($q){$q->select('id', 'pax_title', 'name', 'gender', 'airticket_id');}])->where('id', $id)->first();
        $paxs_arry =  $air_ticket->paxs->toArray();
        $paxs_arry_len = count($paxs_arry);
//        return view('cosmosHoliday.page.invoiceAir', [
//            'air_ticket' => $air_ticket,
//            'paxs_arry' => $paxs_arry,
//            'paxs_arry_len' => $paxs_arry_len,
//
//        ]);

        $pdf = PDF::loadView('cosmosHoliday.page.invoiceAir',[
            'air_ticket' => $air_ticket,
            'paxs_arry' => $paxs_arry,
            'paxs_arry_len' => $paxs_arry_len,
        ])->setPaper('a4');
        return $pdf->stream('invoice.pdf');
    }

    public function invoicePrintVisa($id){
        $visa = VisaUpdated::where('id', $id)->with(['staff' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guest' => function($q){$q->with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->select('id', 'name','phone_number', 'email_address', 'rf_staff', 'address');}, 'passports'=>function($q){$q->with(['typet' =>function($q){$q->select('id', 'name');}, 'countryt' => function($q){$q->select('id', 'name');} ]);} ])->first();
        $passports = $visa->passports;
//        return view('cosmosHoliday.page.invoiceVisa', [
//            'visa' => $visa,
//            'passports' => $passports
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceVisa',[
            'visa' => $visa,
            'passports' => $passports
        ])->setPaper('a4');
        return $pdf->stream('invoiceVisa.pdf');
    }

    public function invoicePrintHotel($id){
        $hotel_booking = HotelBooking::where('id', $id)->with(['staff' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guest' => function($q){$q->with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->select('id', 'name','phone_number', 'email_address', 'rf_staff', 'address');}, 'hotels' ])->first();
        $hotels = $hotel_booking->hotels;
        $total_price = $this->convert_number_to_words($hotel_booking->total_price);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);

//        return view('cosmosHoliday.page.invoiceHotel', [
//            'hotel_booking' => $hotel_booking,
//            'hotels' => $hotels,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceHotel',[
            'hotel_booking' => $hotel_booking,
            'hotels' => $hotels,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('invoiceHotel.pdf');
    }

    public function invoicePrintPackage($id){
        $package = Package::where('id', $id)->with(['stafft' => function ($q){$q->select('id', 'first_name', 'last_name');}, 'guestt' => function($q){$q->with(['Staff' => function($q){$q->select('id', 'first_name', 'last_name');}])->select('id', 'name','phone_number', 'email_address', 'rf_staff', 'address');} ])->first();
        $total_price = $this->convert_number_to_words($package->grand_total_price);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);
//        return $clear_total_price;
//        return $package;

//        return view('cosmosHoliday.page.invoice', [
//            'package' => $package,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoice',[
            'package' => $package,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('invoicePackage.pdf');
    }





    public  function convert_number_to_words($number) {

        $hyphen      = '-';
        $conjunction = '  ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            100000                => 'lak',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;

            case $number < 100000:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $remainder = $number % $baseUnit;
                $numBaseUnits = (int) ($number / $baseUnit);

                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[1000];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;


            default:
                $baseUnit = pow(100000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {

                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);

                }
                break;
        }


        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;

            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


}
