<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    protected $fillable = ['name', 'phone_number', 'date_of_birth', 'pp_number', 'no_of_books', 'pp_issue_date', 'pp_expire_date', 'country', 'type', 'suplier', 'reference', 'net_price', 'price', 'advance', 'sales_person', 'received_date', 'payment_status', 'work_by', 'work_date', 'notary_by', 'notary_date', 'checked_by_asst', 'checked_by_asst_date', 'checked_by_officer', 'checked_by_officer_date', 'submit_by', 'submit_date', 'collected_by', 'collected_date', 'call_and_sms_by', 'call_and_sms_date', 'delevered_by', 'delevered_date', 'state'];
}
