<?php

namespace App\Http\Controllers;

use App\Airticket;
use App\model\Contra;
use App\model\Expence;
use App\model\HotelBooking;
use App\model\Incentive;
use App\model\MoneyReceived;
use App\model\Package;
use App\model\Payment;
use App\model\VisaUpdated;
use App\Salary;
use PDF;
use Illuminate\Http\Request;
use Session;
use function foo\func;


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

    public function invoicePrintMoneyReceipt($id){
        $money_receipt = MoneyReceived::with([ 'guestt'=>function($q){$q->select('id', 'name','phone_number', 'address');}, 'cashs' =>function($q){$q->select('id', 'received_id', 'debit_cash_amount');}, 'banks'=>function($q){$q->select('id', 'received_id', 'debit_bank_amount');}, 'cheques', 'others'])->where('id', $id)->first();
        $cash_amount = 0;
        $bank_amount = 0;
        $cheque_amount = 0;
        $others_amount = 0;
        foreach ($money_receipt->cashs as $cash){
            $cash_amount += $cash->debit_cash_amount;
        }
        foreach ($money_receipt->banks as $bank){
            $bank_amount += $bank->debit_bank_amount;
        }
        foreach ($money_receipt->cheques as $cheque){
            $cheque_amount += $cheque->cheque_amount;
        }
        foreach ($money_receipt->others as $other){
            $others_amount += $other->others_amount;
        }

        $total_price = $this->convert_number_to_words($money_receipt->total_received_amount);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);



//        return view('cosmosHoliday.page.invoiceMoneyReceipt', [
//            'money_receipt' => $money_receipt,
//            'cash_amount' => $cash_amount,
//            'bank_amount' => $bank_amount,
//            'cheque_amount' => $cheque_amount,
//            'others_amount' => $others_amount,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceMoneyReceipt',[
            'money_receipt' => $money_receipt,
            'cash_amount' => $cash_amount,
            'bank_amount' => $bank_amount,
            'cheque_amount' => $cheque_amount,
            'others_amount' => $others_amount,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('MoneyReceipt.pdf');

    }

    public function invoicePrintDebitVoucher($id){
        $debit_voucher = Payment::with(['cheques' => function($q){$q->select('id', 'payment_id', 'credit_bank_amount');},'cashs' =>function($q){$q->select('id', 'payment_id', 'credit_cash_amount');},'supliert' => function($q){$q->select('id','name');}])->where('id', $id)->first();
        $cash_amount = 0;
        $bank_amount = 0;
        foreach ($debit_voucher->cashs as $cash){
            $cash_amount += $cash->credit_cash_amount;
        }
        foreach ($debit_voucher->cheques as $bank){
            $bank_amount += $bank->credit_bank_amount;
        }
        $total_price = $this->convert_number_to_words($debit_voucher->total_payment_amount);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);
//        return view('cosmosHoliday.page.invoiceDebitVoucher', [
//            'debit_voucher' => $debit_voucher,
//            'cash_amount' => $cash_amount,
//            'bank_amount' => $bank_amount,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceDebitVoucher',[
            'debit_voucher' => $debit_voucher,
            'cash_amount' => $cash_amount,
            'bank_amount' => $bank_amount,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('debit_voucher.pdf');
    }

    public function invoicePrintContraVoucher($id){
        $contra = Contra::with(['bank', 'from_bank', 'to_bank'])->where('id', $id)->first();
        $total_price = $this->convert_number_to_words($contra->contra_amount);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);
//        return view('cosmosHoliday.page.invoiceContraVoucher',[
//            'contra' => $contra,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceContraVoucher', [
            'contra' => $contra,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('contra_voucher.pdf');
    }

    public function invoicePrintExpense($id){
        $expense = Expence::with(['expenceHeadt', 'cashs' =>function($q){$q->select('id', 'expence_id', 'credit_cash_amount');}, 'cheques' => function($q){$q->select('id', 'expence_id', 'credit_bank_amount');}])->where('id', $id)->first();
        $cash_amount = 0;
        $bank_amount = 0;
        foreach ($expense->cashs as $cash){
            $cash_amount += $cash->credit_cash_amount;
        }
        foreach ($expense->cheques as $bank){
            $bank_amount += $bank->credit_bank_amount;
        }
        $total_price = $this->convert_number_to_words($expense->total_expence_amount);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);
//        return view('cosmosHoliday.page.invoiceExpense', [
//            'expense' => $expense,
//            'cash_amount' => $cash_amount,
//            'bank_amount' => $bank_amount,
//            'clear_total_price' => $clear_total_price
//        ]);
            $pdf = PDF::loadView('cosmosHoliday.page.invoiceExpense',[
                'expense' => $expense,
                'cash_amount' => $cash_amount,
                'bank_amount' => $bank_amount,
                'clear_total_price' => $clear_total_price
            ])->setPaper('a4');
        return $pdf->stream('expense_voucher.pdf');
    }
    public function invoicePrintSalary($id){
        $salary = Salary::with(['stafft'=> function($q){$q->select('id', 'first_name', 'last_name');}, 'cashs' =>function($q){$q->select('id', 'salary_id', 'credit_cash_amount');}, 'cheques' => function($q){$q->select('id', 'salary_id', 'credit_bank_amount');}])->where('id', $id)->first();
        $cash_amount = 0;
        $bank_amount = 0;
        foreach ($salary->cashs as $cash){
            $cash_amount += $cash->credit_cash_amount;
        }
        foreach ($salary->cheques as $bank){
            $bank_amount += $bank->credit_bank_amount;
        }
        $total_price = $this->convert_number_to_words($salary->total_salary_amount);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);
//        return view('cosmosHoliday.page.invoiceSalary', [
//            'salary' => $salary,
//            'cash_amount' => $cash_amount,
//            'bank_amount' => $bank_amount,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceSalary',[
            'salary' => $salary,
            'cash_amount' => $cash_amount,
            'bank_amount' => $bank_amount,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('salary_voucher.pdf');
    }
    public function invoicePrintIncentive($id){
        $incentive = Incentive::with(['stafft'=> function($q){$q->select('id', 'first_name', 'last_name');}, 'cashs' =>function($q){$q->select('id', 'incentive_id', 'credit_cash_amount');}, 'cheques' => function($q){$q->select('id', 'incentive_id', 'credit_bank_amount');}])->where('id', $id)->first();
        $cash_amount = 0;
        $bank_amount = 0;
        foreach ($incentive->cashs as $cash){
            $cash_amount += $cash->credit_cash_amount;
        }
        foreach ($incentive->cheques as $bank){
            $bank_amount += $bank->credit_bank_amount;
        }
        $total_price = $this->convert_number_to_words($incentive->total_incentive_amount);
        $banned = array('point zero zero'); //add more words as you want. KEEP THE SPACE around the word
        $clear_total_price   = str_ireplace($banned, ' ', $total_price);

//        return view('cosmosHoliday.page.invoiceIncentive', [
//            'incentive' => $incentive,
//            'cash_amount' => $cash_amount,
//            'bank_amount' => $bank_amount,
//            'clear_total_price' => $clear_total_price
//        ]);
        $pdf = PDF::loadView('cosmosHoliday.page.invoiceIncentive',[
            'incentive' => $incentive,
            'cash_amount' => $cash_amount,
            'bank_amount' => $bank_amount,
            'clear_total_price' => $clear_total_price
        ])->setPaper('a4');
        return $pdf->stream('incentive_voucher.pdf');
    }





    public  function convert_number_to_words($number) {

        $hyphen      = '-';
        $conjunction = '  ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Fourty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Ninety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            100000                => 'Lac',
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
