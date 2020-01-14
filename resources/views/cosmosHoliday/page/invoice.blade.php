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
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="wrapper container" style="width: 100%">
    <!-- Main content -->
    <section class="invoice" style="margin: 10px -15px; border: 0">
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
                <div class="col-xs-7 col-md-7">Name <span style="margin-left: 63px;">: {{$package->guestt->name}}</span></div>
                <div class="col-xs-5 col-md-5">Date: {{$package->created_at->format('d-m-Y')}}</div>
            </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Address <span style="margin-left: 40px;">: {{$package->guestt->address}}</span></div>
            <div class="col-xs-5 col-md-5">Country/Combo: {{$package->country}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Phone/Mobile <span style="margin-left: 2px;">:  {{$package->guestt->phone_number}}</span></div>
            <div class="col-xs-5 col-md-5">Date Of Journey: {{date("d-m-Y", strtotime($package->journey_date))}}</div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-4">Package <span style="margin-left: 2px;">: {{$package->package_type}}</span></div>
            <div class="col-xs-3 col-md-3">Phackage ID <span >:  P-{{$package->id}}</span></div>
            <div class="col-xs-5 col-md-5" style="float: left; margin-left: -30px" >Ref. Name <span>: {{$package->guestt->Staff->first_name.' '.$package->guestt->Staff->last_name}}</span></div>
        </div>
    </font>

            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-12 table-responsive">
                    <font size="1" face="Courier New" >
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th   height="5" colspan="5" class="border" style="text-align: center; border-top: 1px solid black; padding: 10px">Package Price With Service Charge</th>
                        </tr>
                        <tr >
                            <th height="5"  width="20%" style="text-align:center; padding: 4px">Particulars</th>
                            <th height="5" width="40%" style="text-align:center; padding: 4px">Service</th>
                            <th height="5" width="5%" style="text-align:center; padding: 4px">Qty</th>
                            <th height="5" width="15%" style="text-align:center; padding: 4px">Price</th>
                            <th height="5" width="20%" style="text-align:center; padding: 4px">Total Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Adult (Above 12 years)</td>
                            <td>{{$package->adult_service}}</td>
                            <td style="text-align: center" >{{$package->adult_qty}}</td>
                            <td style="text-align: right">{{$package->adult_price}}</td>
                            <td style="text-align: right">{{$package->adult_total_price}}</td>
                        </tr>
                        <tr>
                            <td>Child (Below 12 years)</td>
                            <td>{{$package->child_service}}</td>
                            <td style="text-align: center" >{{$package->child_qty}}</td>
                            <td style="text-align: right">{{$package->child_price}}</td>
                            <td style="text-align: right">{{$package->child_total_price}}</td>
                        </tr>
                        <tr>
                            <td>Infant (Below 2 years)</td>
                            <td>{{$package->infant_service}}</td>
                            <td style="text-align: center" >{{$package->infant_qty}}</td>
                            <td style="text-align: right">{{$package->infant_price}}</td>
                            <td style="text-align: right">{{$package->infant_total_price}}</td>
                        </tr>

                        <tr>
                            <td>Others</td>
                            <td>{{$package->others_note}}</td>
                            <td style="text-align: center" >{{$package->others_qty}}</td>
                            <td style="text-align: right">{{$package->others_price}}</td>
                            <td style="text-align: right">{{$package->others_total_price}}</td>
                        </tr>

                        <tr>
                            <td>Extra Nigth</td>
                            <td>{{$package->ex_night_note}}</td>
                            <td style="text-align: center" >{{$package->ex_night_qty}}</td>
                            <td style="text-align: right">{{$package->ex_night_price}}</td>
                            <td style="text-align: right">{{$package->ex_night_total_price}}</td>
                        </tr>
                        <tr>
                            <td>Extra Sightseeing</td>
                            <td>{{$package->ex_site_seeing_note}}</td>
                            <td style="text-align: center" >{{$package->ex_site_seeing_qty}}</td>
                            <td style="text-align: right">{{$package->ex_site_seeing_price}}</td>
                            <td style="text-align: right">{{$package->ex_site_seeing_total_price}}</td>
                        </tr>

                        <tr>
                            <td>Airport Received & Drop</td>
                            <td>{{$package->airport_rd_note}}</td>
                            <td style="text-align: center" >{{$package->airport_rd_qty}}</td>
                            <td style="text-align: right">{{$package->airport_rd_price}}</td>
                            <td style="text-align: right">{{$package->airport_rd_total_price}}</td>
                        </tr>
                        <tr>
                            <td rowspan="3" colspan="2" style="text-align: justify">{{$package->extra_note}}</td>
                            <td style="text-align: center" >{{$package->first_qty}}</td>
                            <td style="text-align: right">{{$package->first_price}}</td>
                            <td style="text-align: right">{{$package->first_total_price}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center" >{{$package->second_qty}}</td>
                            <td style="text-align: right">{{$package->second_price}}</td>
                            <td style="text-align: right">{{$package->second_total_price}}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center" >{{$package->third_qty}}</td>
                            <td style="text-align: right">{{$package->third_price}}</td>
                            <td style="text-align: right">{{$package->third_total_price}}</td>
                        </tr>

                        <tr>
                            <td colspan="3"></td>
                            <td>Total Taka (BDT)</td>
                            <td style="text-align: right;"><strong>{{$package->grand_total_price}}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                    </font>
                    <div class="row" >
                        <h5 style="border-bottom: 1px solid black; margin: 0px 15px"><strong>BDT (In Word) : {{$clear_total_price}} taka only</strong></h5>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>

                    <div class="row" style="position: absolute;width: 100%; bottom: 150px">

                        <div>
                            <font size="2" face="Courier New" >
                                <div class="row" style="margin: 0px 10px">

                                    <div class="col-xs-4 col-md-4" style=" text-align: center; float: left">Customer Signature : ___________________</div>

                                    <div class="col-xs-4 col-md-4" style="text-align: center; float: right" >Prepared By : {{$package->stafft->first_name.' '.$package->stafft->last_name}}</div>
                                </div>
                            </font>
                        </div>
                    </div>

                <!-- /.col -->

            </div>

            <!-- /.row -->


            <!-- /.row -->
        </div>
    <br/>
    <br/>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
