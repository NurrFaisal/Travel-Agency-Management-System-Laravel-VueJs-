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
                <div class="col-xs-7 col-md-7">Name <span style="margin-left: 63px;">: {{$hotel_booking->guest->name}}</span></div>
                <div class="col-xs-5 col-md-5">Date: {{$hotel_booking->created_at->format('d-m-Y')}}</div>
            </div>

        <div class="row">
            <div class="col-xs-7 col-md-7">Phone/Mobile <span style="margin-left: 2px;">: {{$hotel_booking->guest->phone_number}}</span></div>
            <div class="col-xs-5 col-md-5">Ref Name: {{$hotel_booking->guest->Staff->first_name.' '.$hotel_booking->guest->Staff->last_name}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Email <span style="margin-left: 2px;">: {{$hotel_booking->guest->email_address}}</span></div>
            <div class="col-xs-5 col-md-5">Invoice ID: H-{{$hotel_booking->id}}</div>
        </div>
        <div class="row">
            <div class="col-xs-7 col-md-7">Address <span style="margin-left: 40px;">: {{$hotel_booking->guest->address}}</span></div>
            @if($hotel_booking->print > 1)
                <div class="col-xs-5 col-md-5">Duplicate Print <span style="margin-left: 40px;">: {{$hotel_booking->print}}</span></div>
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
                    <tr>
                        <th   height="5" colspan="6" class="border" style="border-top: 1px solid black; padding: 2px"><b>Guest Name : </b>{{$hotel_booking->customer_name}}</th>
                    </tr>
                </table>
            </font>
            <font size="1" face="Courier New" >
                <table class="table table-bordered" style="margin-bottom: -1px">
                    <tr>
                        <th   height="5" colspan="6" class="border" style="text-align: center; border-top: 1px solid black; padding: 2px"><b>Hotel Booking Price With Service Charge</b></th>
                    </tr>
                </table>
            </font>
            @foreach($hotels as $hotel)
            <font size="1" face="Courier New" >
                <table class="table table-bordered">
                    <tbody>
                    <tr >
                        <th height="5" colspan="2" width="42%"  style="text-align:center; padding: 2px"><b>Hotel Info</b></th>
                        <th height="5" width="10%" style="text-align:center; padding: 2px"><b>Room Cate:</b></th>
                        <th height="5" width="10%" style="text-align:center; padding: 2px"><b>Per Room</b></th>
                        <th height="5" width="5%" style="text-align:center; padding: 2px"><b>Qty</b></th>
                        <th height="5" width="10%" style="text-align:center; padding: 2px"><b>Service</b></th>
                        <th height="5" width="8%" style="text-align:center; padding: 2px"><b>Price</b></th>
                        <th height="5" width="5%" style="text-align:center; padding: 2px"><b>Qty</b></th>
                        <th height="5" width="8%" style="text-align:center; padding: 2px"><b>Amount</b></th>
                    </tr>
                    <tr >
                        <td height="5" colspan="2" style=" padding: 1px"><b>Hotel Name :</b> {{$hotel->hotel_name}}</td>
                        <td height="5" style="text-align:center; padding: 1px">King Size Bed</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->king_size_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->king_size}}</td>
                        <td height="5" colspan="2" style="text-align:center; padding: 1px">Total Room Cost</td>
{{--                        <td height="5" style="text-align:right; padding: 1px">60000.00</td>--}}
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->room_qty}}</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->room_total_price}}</td>
                    </tr>
                    <tr >
                        <td height="5" colspan="2" style=" padding: 1px"> <b>Address :</b> {{$hotel->address}}</td>
                        <td height="5" style="text-align:center; padding: 1px">Couple Bed</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->couple_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->couple}}</td>
                        <td height="5" style="text-align:center; padding: 1px"> Extra Bed</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->extra_bed_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->extra_bed_qty}}</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->extra_bed_qty*$hotel->extra_bed_price}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" colspan="2" style=" padding: 1px"><b>Room Category :</b> Dileux</td>
                        <td height="5" style="text-align:center; padding: 1px">Twin Bed</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->twin_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->twin}}</td>
                        <td height="5" style="text-align:center; padding: 1px">Breakfast</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->breakfast_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->breakfast_qty}}</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->breakfast_qty*$hotel->breakfast_price}}.00</td>
                    </tr>
                    <tr >
                        <td height="5"  style=" padding: 1px"> <b style="color: red">Check-In :</b> {{ date("d-m-Y", strtotime($hotel->check_in))}}</td>
                        <td height="5"  style=" padding: 1px"> <b style="color: red">Check-Out :</b> {{ date("d-m-Y", strtotime($hotel->check_out))}}</td>
                        <td height="5" style="text-align:center; padding: 2px">Triple Bed</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->triple_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->triple}}</td>
                        <td height="5" style="text-align:center; padding: 1px">Early Check-In</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->early_check_in_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->early_check_in_qty}}</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->early_check_in_qty*$hotel->early_check_in_price}}.00</td>
                    </tr>
                    <tr >
                        <td height="5" colspan="2" style=" padding: 1px"><b>Note :</b> {{$hotel->note}}</td>
                        <td height="5" style="text-align:center; padding: 1px">Quared Bed</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->quared_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->quared}}</td>
                        <td height="5" style="text-align:center; padding: 1px">Late Check-Out</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->late_check_out_price}}</td>
                        <td height="5" style="text-align:center; padding: 1px">{{$hotel->late_check_out_qty}}</td>
                        <td height="5" style="text-align:right; padding: 1px">{{$hotel->late_check_out_qty*$hotel->late_check_out_price}}.00</td>
                    </tr>

                    <tr >
                        <td height="5" colspan="6" style=" padding: 1px"></td>
                        <td height="5" colspan="2" style="text-align:right; padding: 1px"><strong>Total :</strong></td>
                        <td height="5" style="text-align:right; padding: 1px"><strong>{{$hotel->total_hotel_price}}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </font>
            @endforeach


            <font size="1" face="Courier New" >
                <table class="table table-bordered" style="margin-top: -21px;">
                    <tr >
                        <td height="5" colspan="6" style=" padding: 2px"><b>In word : {{$clear_total_price}} Taka Only.</b></td>
                        <td height="5" colspan="2" style="text-align:right; padding: 2px"><strong>Grand Total :</strong></td>
                        <td height="5" style="text-align:right; padding: 2px"><strong>{{$hotel_booking->total_price}}</strong></td>
                    </tr>
                </table>
            </font>

        </div>
        <!-- /.col -->

    </div>


    <div class="row">
        <div class="col-xs-12 col-md-12 table-responsive">
            <font size="1" face="Courier New" >
                <table class="table table-bordered">
                    <tbody>
                    <tr >
                        <th width="16%" style="text-align:center; padding: 2px; color: red"><h5><b>Special Note :</b></h5></th>
                        <th  width="42%" style="text-align:center; padding: 2px">
                            <h5><b>International Hotel <span style="color: red">Check in Time : 2PM/4PM</span></b></h5>
                            <p>(if Hotel rooms are available some time Hotel Management can Give Early Check in on request)</p>
                        </th>

                        <th  width="42%" style="text-align:center; padding: 2px">
                            <h5><b>International Hotel <span style="color: red">Check Out Time : 10AM/12AM</span></b></h5>
                            <p>(if you need Early Check in & Late Check Out, You can Pay Direct to Hotel Reception as per hotel Rules)</p>
                        </th>

                    </tr>
                    <tr >
                        <th  colspan="3" style="text-align:center; padding: 2px">
                            <h5><b>Some time you Have to go for early Transfer to Another City or Sightseeing in that case</b></h5>
                            <h5 style="color: red"><b>May be you Miss the Hotel Complinentary Breakfast</b></h5>
                        </th>
                    </tr>
                    </tbody>

                </table>
            </font>

        </div>
        <!-- /.col -->

    </div>

    <div class="row" style="position: absolute;width: 100%; bottom: 150px">

        <div>
            <font size="2" face="Courier New" >
                <div class="row" style="margin: 0px 10px">

                    <div class="col-xs-4 col-md-4" style=" text-align: center; float: left">Customer Signature : ___________________</div>

                    <div class="col-xs-4 col-md-4" style="text-align: center; float: right" >Prepared By : {{$hotel_booking->staff->first_name.' '.$hotel_booking->staff->last_name}}</div>
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
