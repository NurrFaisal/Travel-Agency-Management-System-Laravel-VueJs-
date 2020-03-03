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
{{--<script>--}}
{{--    window.print()--}}
{{--</script>--}}

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
                <div class="col-xs-7 col-md-7">Name <span style="margin-left: 63px;">: {{$air_ticket->guest->name}}</span></div>
                <div class="col-xs-5 col-md-5">Date: {{ date("d-m-Y", strtotime($air_ticket->created_at))}}</div>
            </div>

        <div class="row">
            <div class="col-xs-7 col-md-7">Phone/Mobile <span style="margin-left: 2px;">: {{$air_ticket->guest->phone_number}}</span></div>
            <div class="col-xs-5 col-md-5">Ref Name: {{$air_ticket->guest->Staff->first_name.' '.$air_ticket->guest->Staff->last_name}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Email <span style="margin-left: 2px;">: {{$air_ticket->guest->email_address}}</span></div>
            <div class="col-xs-5 col-md-5">Invoice ID: A-{{$air_ticket->id}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Address <span style="margin-left: 40px;">: {{$air_ticket->guest->address}}</span></div>
            @if($air_ticket->print > 1)
            <div class="col-xs-5 col-md-5">Duplicate Print <span style="margin-left: 40px;">: {{$air_ticket->print}}</span></div>
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
                            <th   height="5" colspan="4" class="border" style="text-align: center; border-top: 1px solid black; padding: 2px">Air Ticket Price With Service Charge</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th height="5" width="35%"  style="text-align:center; padding: 2px">Classification</th>
                                <th height="5" width="15%" style="text-align:center; padding: 2px">Qty</th>
                                <th height="5" width="25%" style="text-align:center; padding: 2px">Price</th>
                                <th height="5" width="25%" style="text-align:center; padding: 2px">Total Amount</th>
                            </tr>
                            <tr >
                                <td height="5" style=" padding: 2px">Adult (Above 12 years)</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$air_ticket->adult_qty}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->adult_price}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->adult_total_price}}</td>
                            </tr>
                            <tr >
                                <td height="5" style="padding: 2px">Child (Below 12 years)</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$air_ticket->child_qty}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->child_price}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->child_total_price}}</td>
                            </tr>
                            <tr >
                                <td height="5" style=" padding: 2px">Infant (Below 2 years)</td>
                                <td height="5" style="text-align:center; padding: 2px">{{$air_ticket->infant_qty}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->infant_price}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->infant_total_price}}</td>
                            </tr>
                            <tr >
                                <td height="5" style=" padding: 2px">Special Service Requirement <strong>(SSR)</strong></td>
                                <td height="5" style="text-align:center; padding: 2px">{{$air_ticket->ssr_qty}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->ssr_price}}</td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->ssr_total_price}}</td>
                            </tr>
                            <tr >
                                <td height="5" style=" padding: 2px">Note : Group Ticket (Adult, Child & Infant Same Price)</td>
                                <td height="5" style="text-align:center; padding: 2px"></td>
                                <td height="5" style="text-align:right; padding: 2px"></td>
                                <td height="5" style="text-align:right; padding: 2px"></td>
                            </tr>

                            <tr >
                                <td height="5" colspan="2" style="text-align:center; padding: 6px"></td>
                                <td height="5" style="text-align:right; padding: 2px"><strong>Service :</strong></td>
                                <td height="5" style="text-align:right; padding: 2px">{{$air_ticket->serveice_amount}}</td>
                            </tr>
                            <tr >
                                <td height="5" colspan="3"  style=" padding: 2px"><strong>Destination :</strong> {{$air_ticket->destination}}</td>
                                <td height="5" style="text-align:center; padding: 2px"></td>
                            </tr>
                            <tr >
                                <td height="5"  style="padding: 2px"><strong>Journey Date :</strong> {{date("d-m-Y", strtotime($air_ticket->journey_date))}}</td>
                                <td height="5" colspan="2" style=" padding: 2px"><strong>Return Date :</strong> {{date("d-m-Y", strtotime($air_ticket->return_date))}}</td>
                                <td height="5" style="padding: 2px"></td>
                            </tr>
                            <tr >
                                <td height="5"  style=" padding: 2px"><strong>Ticket Class :</strong> {{$air_ticket->class == 0 ? 'Economy' : 'Business'}}</td>
                                <td height="5" colspan="2" style=" padding: 2px"><strong>Ticket Type :</strong> {{$air_ticket->type == 0 ? 'Domestic' : 'International'}}</td>
                                <td height="5" style="text-align:center; padding: 2px"></td>
                            </tr>
                            <tr >
                                <td height="5"  style=" padding: 2px"><strong>Hand Luggagges Rules : {{$air_ticket->hand_luggages_rules. 'KG ('.$air_ticket->hand_luggages_rules_description.')' ?? 'Not Available' }}</strong></td>
                                <td height="5" colspan="2" style=" padding: 2px"><strong>Luggages Rules : {{$air_ticket->luggages_rules. 'KG ('.$air_ticket->luggages_rules_description.')' ?? 'Not Available' }}</strong></td>
                                <td height="5" style="text-align:center; padding: 2px"></td>
                            </tr>
                            <tr >
                                <td height="5"  style=" padding: 2px"><strong>Ticket Rules :</strong> @if($air_ticket->ticket_rules == 1)<span style="color: red; font-size: 15px"><b>Non-Refundable</b></span> @else <span style="color: green; font-size: 15px"><b>Refundable</b></span>@endif</td>
                                <td height="5"  style=" padding: 2px"><strong>Food Rules : @if($air_ticket->food_rules == 1)<span style="color: red; font-size: 15px">No</span> @else <span style="color: green; font-size: 15px">Yes</span> @endif</strong></td>
                                <td height="5"  style=" padding: 2px"><strong>Date Change :</strong>  @if($air_ticket->date_change == 0)<span style="color: green; font-size: 15px"><b>Available</b></span>@else <span style="color: red; font-size: 15px"><b>Not-Available</b></span>@endif</td>
                                <td height="5" style=" padding: 2px"></td>
                            </tr>
                            <tr >
                                <td height="5" colspan="3"  style=" padding: 2px"><strong>Note :</strong> {{$air_ticket->note}}</td>
                                <td height="5" style=" padding: 2px"></td>
                            </tr>

                            <tr >
                                <td height="5" colspan="2" style=" padding: 2px"><strong>In Word : </strong>{{$clear_total_price}} </td>
                                <td height="5" style="text-align:right; padding: 2px"><strong>Total Amount :</strong></td>
                                <td height="5" style="text-align:right; padding: 2px"><strong>{{$air_ticket->total_amount}}</strong></td>
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
                    <tr >
                        <th height="5" colspan="3" style="text-align:center; padding: 2px">All Pax Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i =0;
                    @endphp
                    @while($i <=$paxs_arry_len)
                    <tr >
                        <td height="5" width="33%" style="padding: 2px">{{$i+1}}.
                            {{$paxs_arry[$i]['pax_title'] == 1 ? 'Mr.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 2 ? 'Mrs.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 3 ? 'Miss.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 4 ? 'Mstr.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 5 ? 'Ms.': ''}}
                            {{$paxs_arry[$i]['name'] ?? ''}}
                        </td>
                        @php $i++ @endphp
                        <td height="5" width="33%" style="padding: 2px">{{$i+1}}.
                            @if($i < $paxs_arry_len)
                                {{$paxs_arry[$i]['pax_title'] == 1 ? 'Mr.': ''}}
                                {{$paxs_arry[$i]['pax_title'] == 2 ? 'Mrs.': ''}}
                                {{$paxs_arry[$i]['pax_title'] == 3 ? 'Miss.': ''}}
                                {{$paxs_arry[$i]['pax_title'] == 4 ? 'Mstr.': ''}}
                                {{$paxs_arry[$i]['pax_title'] == 5 ? 'Ms.': ''}}
                                {{$paxs_arry[$i]['name'] ?? ''}}
                            @endif
                        </td>
                        @php $i++ @endphp
                        <td height="5" width="34%" style="padding: 2px">{{$i+1}}.
                        @if($i < $paxs_arry_len)
                            {{$paxs_arry[$i]['pax_title'] == 1 ? 'Mr.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 2 ? 'Mrs.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 3 ? 'Miss.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 4 ? 'Mstr.': ''}}
                            {{$paxs_arry[$i]['pax_title'] == 5 ? 'Ms.': ''}}
                            {{$paxs_arry[$i]['name'] ?? ''}}
                        @endif
                        @php $i++ @endphp
                    </tr>
                    @endwhile


                    </tbody>
                </table>
            </font>
            <h5>Narration : {{$air_ticket->narration}}</h5>

        </div>
        <!-- /.col -->

    </div>
    <br/>


    <br/>
    <br/>
{{--    <div style=";--}}
{{--    border: 1px solid;--}}
{{--    padding: 20px;--}}
{{--     margin-bottom: 100px;--}}
{{--    width: 100%;">--}}
{{--        <font size="2" face="Courier New" >--}}

{{--            <div class="row">--}}
{{--                <div class="col-xs-7 col-md-7">Class <span style="margin-left: 63px;">: Business</span></div>--}}
{{--                <div class="col-xs-5 col-md-5">Luggages Rules: 20 KG</div>--}}
{{--            </div>--}}
{{--            <br/>--}}
{{--            <br/>--}}

{{--            <div class="row">--}}
{{--                <div class="col-xs-7 col-md-7">Food Rules <span style="margin-left: 2px;">: Yes</span></div>--}}
{{--                <div class="col-xs-5 col-md-5">Tricket Rules: Non-Refundable</div>--}}
{{--            </div>--}}
{{--        </font>--}}
{{--    </div>--}}

    <div class="row" style="position: absolute;width: 100%; bottom: 150px">

        <div>
            <font size="2" face="Courier New" >
                <div class="row" style="margin: 0px 10px">

                    <div class="col-xs-4 col-md-4" style=" text-align: center; float: left">Customer Signature : ___________________</div>

                    <div class="col-xs-4 col-md-4" style="text-align: center; float: right" >Prepared By : {{$air_ticket->staff->first_name.' '.$air_ticket->staff->last_name}}</div>
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
