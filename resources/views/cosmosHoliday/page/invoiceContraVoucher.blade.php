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

        <!-- info row -->
        <div class="invoice-info">

            <!-- Table row -->
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="row">
                <h3 style="text-align: center"><strong>Cosmos Holiday</strong></h3>
                <p style="text-align: center">Plaza A.R (4th Floor), Beside Sobhanbag Mosque, Dhanmondi, Dhaka, Bangladesh.</p>
            </div>
            <div class="row">
                <h4 style="text-align: center">Contra Voucher</h4>
            </div>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 5px">

                            <div class="col-xs-4 col-md-4" style="float: left">Contra Voucher Number : C - {{$contra->id}}</div>
                            <div class="col-xs-4 col-md-4" style="text-align: right; float: right" >Date : {{$contra->created_at->format('d-m-Y')}}</div>
                        </div>
                    </font>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-12 table-responsive">
                    <font size="2" face="Courier New" >
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td height="5"   style="padding: 4px">Contra Date : {{date('d-m-Y', strtotime($contra->contra_date))}}</td>
                            <td height="5"   style="padding: 4px ; border-top-color: white;"></td>
                            <td height="5"   style="padding: 4px">Contra Type :
                                @if($contra->contra_type == 1)
                                    Cash To Bank
                                @elseif($contra->contra_type == 2)
                                    Bank To Cash
                                @else
                                    Bank To Bank
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th  height="5" width="33%" style="text-align: center; padding: 4px">From</th>
                            <th  height="5" width="34%" style="text-align: center; padding: 4px">To</th>
                            <th  height="5" width="33%" style="text-align: center; padding: 4px">Amount</th>
                        </tr>
                        <tr >
                            <td  height="5"  style="text-align:center; padding: 4px">
                                @if($contra->contra_type == 1)
                                    Cash
                                @elseif($contra->contra_type == 2)
                                     {{$contra->bank->bank_name}}
                                @else
                                     {{$contra->from_bank->bank_name}}
                                @endif



                            </td>
                            <td  height="5"  style="text-align:center; padding: 4px">
                                @if($contra->contra_type == 1)
                                    {{$contra->bank->bank_name}}
                                @elseif($contra->contra_type == 2)
                                       Cash
                                @else
                                    {{$contra->to_bank->bank_name}}
                                @endif
                            </td>
                            <td  height="5"  style="text-align:center; padding: 4px">{{$contra->contra_amount}}</td>
                        </tr>
                        <tr >
                            <td colspan="3" height="5" style="padding: 4px">Narration : {{$contra->narration}}</td>
                        </tr>
                        <tr >
                            <td colspan="3" height="5" style="padding: 4px">BDT (in words) : {{$clear_total_price}} Taka Only</td>
                        </tr>

                        </tbody>
                    </table>
                    </font>
                </div>
            </div>
            <br/>
            <br/>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 10px">

                            <div class="col-xs-3 col-md-3" style=" float: left">Received By</div>
                            <div class="col-xs-3 col-md-3" style="text-align: left">Prepared  By</div>
                            <div class="col-xs-3 col-md-3" style="text-align: left">Paid By</div>
                            <div class="col-xs-3 col-md-3" style="text-align: right; float: right" >Approved By</div>
                        </div>
                    </font>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
