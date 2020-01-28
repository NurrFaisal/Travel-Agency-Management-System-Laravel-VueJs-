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
            <div class="row">
                <h3 style="text-align: center"><strong>Cosmos Holiday</strong></h3>
                <p style="text-align: center">Plaza A.R (4th Floor), Beside Sobhanbag Mosque, Dhanmondi, Dhaka, Bangladesh.</p>
            </div>
            <div class="row">
                <h4 style="text-align: center">Expense Voucher</h4>
            </div>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 5px">

                            <div class="col-xs-4 col-md-4" style="float: left">Expense Voucher Number : E-{{$expense->id}}</div>
                            <div class="col-xs-4 col-md-4" style="text-align: right; float: right" >Date : {{$expense->created_at->format('d-m-Y')}}</div>
                        </div>
                    </font>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-md-12 table-responsive">
                    <font size="1" face="Courier New" >
                    <table class="table table-bordered">
                        <tbody>
                        <tr >
                            <td colspan="4" height="5"   style="padding: 4px">Expense Head : {{$expense->expenceHeadt->name}}</td>
                        </tr>

                        <tr >
                            <th rowspan="3" height="5" width="70%"  style="padding: 4px; text-align: justify">Note : {{$expense->narration}}</th>
                            <th  height="5" width="10%" style="padding: 4px; text-align: center">Cash</th>
                            <th  height="5" width="10%" style="padding: 4px; text-align: center">Bank</th>
                            <th  height="5" width="10%" style="padding: 4px; text-align: center">Total</th>
                        </tr>
                        <tr >
                            <td  height="5" width="10%" style="text-align:right; padding: 4px">{{$cash_amount}}.00</td>
                            <td  height="5" width="10%"  style="text-align:right; padding: 4px">{{$bank_amount}}.00</td>
                            <td  height="5" width="10%" style="text-align:right; padding: 4px">{{$expense->total_expence_amount}}</td>
                        </tr>
                        <tr >
                            <td colspan="3"  height="5"  style="padding: 4px"><strong>Grand Total :</strong> <span style="float: right"><strong>{{$expense->total_expence_amount}}</strong></span></td>
                        </tr>
                        <tr >
                            <td colspan="4" height="5" style="padding: 4px">BDT (in words) : {{$clear_total_price}} taka only</td>
                        </tr>

                        </tbody>
                    </table>
                    </font>
                </div>
            </div>
            <br/>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 10px">

                            <div class="col-xs-4 col-md-4" style=" float: left">Received By</div>
                            <div class="col-xs-3 col-md-3" style="text-align: center">Paid By</div>
                            <div class="col-xs-5 col-md-5" style="text-align: right; float: right" >Approved By</div>
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
