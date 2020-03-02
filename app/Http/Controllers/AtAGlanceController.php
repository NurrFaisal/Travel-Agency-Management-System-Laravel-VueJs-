<?php

namespace App\Http\Controllers;

use App\Airticket;
use App\model\BankBook;
use App\model\CashBook;
use App\model\ChequeBook;
use App\model\Expence;
use App\model\HotelBooking;
use App\model\Incentive;
use App\model\MoneyReceived;
use App\model\Other;
use App\model\Package;
use App\model\Payment;
use App\model\PaymentLoanTransaction;
use App\model\ReceivedLoanTransaction;
use App\model\SuplierTransaction;
use App\model\Transjaction;
use App\model\VisaUpdated;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AtAGlanceController extends Controller
{
    public function viewAtAGlance(){
        $today = Carbon::now()->format('Y-m-d');
        $air_ticket_count = Airticket::where('invoice_date', $today)->count();
        $air_ticket_sum = Airticket::where('invoice_date', $today)->sum('total_price');

        $package_count = Package::whereDate('created_at','=', $today)->count();
        $package_sum = Package::whereDate('created_at','=', $today)->sum('total_total_price');

        $visa_count = VisaUpdated::whereDate('created_at','=', $today)->count();
        $visa_sum = VisaUpdated::whereDate('created_at','=', $today)->sum('grand_total_price');

        $hotel_booking_count = HotelBooking::whereDate('created_at','=', $today)->count();
        $hotel_booking_sum = HotelBooking::whereDate('created_at','=', $today)->sum('total_price');

        $cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->select('cash_date', 'blance')->first();
        $bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->select('bank_date', 'blance')->first();
        $cheque = ChequeBook::where('cheque_date', $today)->sum('cheque_amount');
        $others = Other::whereDate('created_at','=', $today)->sum('others_amount');

        $guest_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->select('transjaction_date', 'blance')->first();
        $suplier_blance = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->select('transaction_date', 'balance')->first();

        $received = MoneyReceived::whereDate('created_at', '=', $today)->sum('total_received_amount');
        $payment = Payment::whereDate('debit_voucher_date', '=', $today)->sum('total_payment_amount');

        $received_loan = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->select('transaction_date', 'blance')->first();
        $payment_loan = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->select('transaction_date', 'blance')->first();

        $expense = Expence::where('expence_date', $today)->sum('total_expence_amount');
        $salary = Salary::where('salary_date', $today)->sum('total_salary_amount');
        $incentive = Incentive::where('incentive_date', $today)->sum('total_incentive_amount');
        return response()->json([
            'air_ticket_count' => $air_ticket_count,
            'air_ticket_sum' => $air_ticket_sum,
            'package_count' => $package_count,
            'package_sum' => $package_sum,
            'visa_count' => $visa_count,
            'visa_sum' => $visa_sum,
            'hotel_booking_count' => $hotel_booking_count,
            'hotel_booking_sum' => $hotel_booking_sum,
            'cash_book' => $cash_book,
            'bank_book' => $bank_book,
            'cheque' => $cheque,
            'others' => $others,
            'guest_blance' => $guest_blance,
            'suplier_blance' => $suplier_blance,
            'received' => $received,
            'payment' => $payment,
            'received_loan' => $received_loan,
            'payment_loan' => $payment_loan,
            'expense' => $expense,
            'salary' => $salary,
            'incentive' => $incentive,
        ]);
    }
    public function viewAtAGlanceSearch($search){
        $today = $search;
        $air_ticket_count = Airticket::where('invoice_date','like', $today.'%')->count();
        $air_ticket_sum = Airticket::where('invoice_date', 'like', $today.'%')->sum('total_price');

        $package_count = Package::whereDate('created_at','like', $today.'%')->count();
        $package_sum = Package::whereDate('created_at','like', $today.'%')->sum('total_total_price');

        $visa_count = VisaUpdated::whereDate('created_at','like', $today.'%')->count();
        $visa_sum = VisaUpdated::whereDate('created_at','like', $today.'%')->sum('grand_total_price');

        $hotel_booking_count = HotelBooking::whereDate('created_at','like', $today.'%')->count();
        $hotel_booking_sum = HotelBooking::whereDate('created_at','like', $today.'%')->sum('total_price');

        $cash_book = CashBook::orderBy('cash_date', 'desc')->orderBy('id', 'desc')->select('cash_date', 'blance')->first();
        $bank_book = BankBook::orderBy('bank_date', 'desc')->orderBy('id', 'desc')->select('bank_date', 'blance')->first();
        $cheque = ChequeBook::where('cheque_date', 'like', $today.'%')->sum('cheque_amount');
        $others = Other::whereDate('created_at','like', $today.'%')->sum('others_amount');

        $guest_blance = Transjaction::orderBy('transjaction_date', 'desc')->orderBy('id', 'desc')->select('transjaction_date', 'blance')->first();
        $suplier_blance = SuplierTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->select('transaction_date', 'balance')->first();

        $received = MoneyReceived::whereDate('created_at', 'like', $today.'%')->sum('total_received_amount');
        $payment = Payment::whereDate('debit_voucher_date', 'like', $today.'%')->sum('total_payment_amount');

        $received_loan = ReceivedLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->select('transaction_date', 'blance')->first();
        $payment_loan = PaymentLoanTransaction::orderBy('transaction_date', 'desc')->orderBy('id', 'desc')->select('transaction_date', 'blance')->first();

        $expense = Expence::where('expence_date', 'like', $today.'%')->sum('total_expence_amount');
        $salary = Salary::where('salary_date', 'like', $today.'%')->sum('total_salary_amount');
        $incentive = Incentive::where('incentive_date', 'like', $today.'%')->sum('total_incentive_amount');
        return response()->json([
            'air_ticket_count' => $air_ticket_count,
            'air_ticket_sum' => $air_ticket_sum,
            'package_count' => $package_count,
            'package_sum' => $package_sum,
            'visa_count' => $visa_count,
            'visa_sum' => $visa_sum,
            'hotel_booking_count' => $hotel_booking_count,
            'hotel_booking_sum' => $hotel_booking_sum,
            'cash_book' => $cash_book,
            'bank_book' => $bank_book,
            'cheque' => $cheque,
            'others' => $others,
            'guest_blance' => $guest_blance,
            'suplier_blance' => $suplier_blance,
            'received' => $received,
            'payment' => $payment,
            'received_loan' => $received_loan,
            'payment_loan' => $payment_loan,
            'expense' => $expense,
            'salary' => $salary,
            'incentive' => $incentive,
        ]);
    }
}
