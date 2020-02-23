<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cosmos Holiday</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    @include('cosmosHoliday.page.css')
    <style>
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1px solid #333;
        }

        @page  {
            margin: 0;
            padding: 0;
        }
        body{
            margin: 0;
            padding: 0;


        }
        .table-bordered>tbody>tr>td{
            padding: 2px;
        }
    </style>
</head>
<body>
<div class="wrapper container" style="width: 100%">
    <!-- Main content -->
    <section class="invoice container" style="margin: 10px -15px; border: 0; height: 900px">
        <!-- title row -->
{{--        <div class="row">--}}
{{--            <div class="col-xs-12">--}}
{{--                <h2 class="page-header">--}}
{{--                    Cosmos Holiday.--}}
{{--                    <small class="pull-right">Date: {{\Carbon\Carbon::now()->format('d-m-Y')}}</small>--}}
{{--                </h2>--}}
{{--            </div>--}}
{{--            <!-- /.col -->--}}
{{--        </div>--}}
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <!-- info row -->
        <div class="invoice-info">
{{--            <div class="col-sm-4 invoice-col">--}}
{{--                <address>--}}
{{--                    <strong>{{$guest->name}}</strong><br>--}}
{{--                    Phone: (+88) {{$guest->phone_number}}<br>--}}
{{--                    Email: {{$guest->email_address}}--}}
{{--                    <p style="text-align: justify">Address: {{$guest->address}}</p>--}}
{{--                    @if(isset($start_date))--}}
{{--                        <h4><strong>{{date('d-m-y', strtotime($start_date))}} - {{date('d-m-y', strtotime($end_date))}}</strong></h4>--}}
{{--                    @endif--}}
{{--                </address>--}}
{{--            </div>--}}
            <!-- Table row -->
    <font size="2" face="Courier New" >

            <div class="row">
                <div class="col-xs-7 col-md-7">Name <span style="margin-left: 63px;">: {{$visa->guest->name}}</span></div>
                <div class="col-xs-5 col-md-5">Date: {{$visa->created_at->format('d-m-Y')}}</div>
            </div>

        <div class="row">
            <div class="col-xs-7 col-md-7">Phone/Mobile <span style="margin-left: 2px;">: {{$visa->guest->phone_number}}</span></div>
            <div class="col-xs-5 col-md-5">Ref Name: {{$visa->guest->Staff->first_name.' '.$visa->guest->Staff->last_name}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Email <span style="margin-left: 2px;">: {{$visa->guest->email_address}}</span></div>
            <div class="col-xs-5 col-md-5">Invoice ID: V-{{$visa->id}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Address <span style="margin-left: 40px;">: {{$visa->guest->address}}</span></div>
            @if($visa->print > 1)
            <div class="col-xs-5 col-md-5">Douplicate Print : {{$visa->print}}</div>
            @else
            <div class="col-xs-5 col-md-5"></div>
            @endif
        </div>
    </font>

            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-12 table-responsive">
                    <font size="1" face="Courier New" >
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th   height="5" colspan="7" class="border" style="text-align: center; border-top: 1px solid black; padding: 2px">Visa Price With Service Charge</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th height="5" width="15%"  style="text-align:center; padding: 2px">Name</th>
                                <th height="5" width="13%" style="text-align:center; padding: 2px">Passport No.</th>
                                <th height="5" width="12%" style="text-align:center; padding: 2px">No. of Books</th>
                                <th height="5" width="12%" style="text-align:center; padding: 2px">Type</th>
                                <th height="5" width="12%" style="text-align:center; padding: 2px">Duration</th>
                                <th height="5" width="12%" style="text-align:center; padding: 2px">Country</th>
                                <th height="5" width="12%" style="text-align:center; padding: 2px">Price</th>
                            </tr>
                            @foreach($passports as $passport)
                            <tr >
                                <td height="5" style=" padding: 2px">{{$passport->name}}</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$passport->passport_number}}</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$passport->no_of_books}}</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$passport->typet->name}}</td>
                                <td height="5" style="text-align:center; padding: 2px">Urgent</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$passport->countryt->name}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$passport->price}}</td>
                            </tr>
                            @endforeach

                            <tr >
                                <td height="5" colspan="5" style=" padding: 2px"></td>
                                <td height="5" style="text-align:right; padding: 2px"><strong>Total Amount :</strong></td>
                                <td height="5" style="text-align:right; padding: 2px"><strong>{{$visa->total_price}}</strong></td>
                            </tr>

                        </tbody>
                    </table>
                    </font>

                </div>
                <!-- /.col -->

            </div>

    <div class="row">
        <div class="col-xs-12 col-md-12 table-responsive">
            <font size="1" face="Courier New" >
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th   height="5" width="55%;" class="border" style="text-align: center; border-top: 1px solid black; padding: 2px">Special Note</th>
                        <th   height="5" colspan="4" class="border" style="text-align: center; border-top: 1px solid black; padding: 2px">Others Information & Service Charge</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr >
                        <th height="5" rowspan="9" style="text-align:justify; padding: 2px">
                            <p style="padding: 5px">{{$visa->special_note}}</p>
                        </th>
                        <th height="5" style="text-align:center; padding: 2px">Title</th>
                        <th height="5" style="text-align:center; padding: 2px">Price</th>
                        <th height="5" style="text-align:center; padding: 2px">Qty</th>
                        <th height="5" style="text-align:center; padding: 2px">Amount</th>
                    </tr>
                    <tr >
                        <td height="5" style=" padding: 2px">Urgent</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->urgent_price ?? '-'}}</td>
                        <td height="5" style="text-align:center; padding: 2px">{{$visa->urgent_qty ?? '-'}}</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->urgent_price*$visa->urgent_qty}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" style=" padding: 2px">Online Visa</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->online_visa_price ?? '-'}}</td>
                        <td height="5" style="text-align:center; padding: 2px">{{$visa->online_visa_qty ?? '-'}}</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->online_visa_price*$visa->online_visa_qty}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" style=" padding: 2px">Notary</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->notary_price ?? '-'}}</td>
                        <td height="5" style="text-align:center; padding: 2px">{{$visa->notary_qty ?? '-'}}</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->notary_price*$visa->notary_qty}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" style=" padding: 2px">Invitation Letter</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->invitation_letter_price ?? '-'}}</td>
                        <td height="5" style="text-align:center; padding: 2px">{{$visa->invitation_letter_qty ?? '-'}}</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->invitation_letter_price*$visa->invitation_qty}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" style=" padding: 2px">Land Validation</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->land_valuation_price ?? '-'}}</td>
                        <td height="5" style="text-align:center; padding: 2px">{{$visa->land_valuation_qty ?? '-'}}</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->land_valuation_price*$visa->land_valuation_qty}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" style=" padding: 2px">Lawyer Fees</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->lawyer_fees_price ?? '- '}}</td>
                        <td height="5" style="text-align:center; padding: 2px">{{$visa->lawyer_fees_qty ?? '- '}}</td>
                        <td height="5" style="text-align:right; padding: 2px">{{$visa->lawyer_fees_price*$visa->lawyer_fees_qty}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" colspan="3" style="text-align: right; padding: 2px"><strong>Total Others & Service Charge Amount:</strong></td>
                        <td height="5" style="text-align:right; padding: 2px"><strong>{{$visa->total_others_price}}</strong></td>
                    </tr>
                    <tr >
                        <td height="5" colspan="3" style="text-align: right; padding: 2px"><strong>Grand Total:</strong></td>
                        <td height="5" style="text-align:right; padding: 2px"><strong>{{$visa->grand_total_price}}</strong></td>
                    </tr>
                    <tr >
                        <td height="5" colspan="5" style="text-align: left; padding: 2px"><strong>In Word: {{$visa->word}}</strong></td>

                    </tr>

                    </tbody>
                </table>
            </font>

        </div>
        <!-- /.col -->

    </div>
    <br/>


    <br/>
    <br/>

    <div class="row" style="position: absolute;width: 100%; bottom: 150px">

        <div>
            <font size="2" face="Courier New" >
                <div class="row" style="margin: 0px 10px">

                    <div class="col-xs-4 col-md-4" style=" text-align: center; float: left">Customer Signature : ___________________</div>

                    <div class="col-xs-4 col-md-4" style="text-align: center; float: right" >Prepared By : {{$visa->staff->first_name.' '.$visa->staff->last_name}}</div>
                </div>
            </font>
        </div>
    </div>

            <!-- /.row -->


            <!-- /.row -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
