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

        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <!-- info row -->
        <div class="invoice-info">

            <!-- Table row -->
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 5px">

                            <div class="col-xs-4 col-md-4" style="float: left">Money Receipt Number : M-{{$money_receipt->id}}</div>
                            <div class="col-xs-4 col-md-4" style="text-align: right; float: right" >Date : {{$money_receipt->created_at->format('d-m-Y')}}</div>
                        </div>
                    </font>
                </div>
            </div>
            <div class="row" style="margin: 0px 5px">
                <h4 style="text-align: center;">Customer Copy</h4>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 table-responsive">
                    <font size="1" face="Courier New" >
                    <table class="table table-bordered">
                        <tbody>
                        <tr >
                            <td colspan="4" height="5"   style="padding: 4px">Name : {{$money_receipt->guestt->name}}</td>
                        </tr>
                        <tr >
                            <td colspan="4" height="5" style="padding: 4px">Address :  {{$money_receipt->guestt->address}}</td>
                        </tr>
                        <tr >
                            <td colspan="2" height="5"  style="padding: 4px">Phone Number : {{$money_receipt->guestt->phone_number}} </td>
                            <td colspan="2" height="5"  style="padding: 4px">Payment Mode : {{$money_receipt->cash == 1 ? 'Cash' : '' }}{{$money_receipt->bank == 1 ? '-Bank' : '' }}{{$money_receipt->cheque == 1 ? '-Cheque' : '' }}{{$money_receipt->other == 1 ? '-Others' : '' }}</td>
                        </tr>
                        <tr >
                            <td  height="5"  style="padding: 4px">Cash Amount : {{$cash_amount}}</td>
                            <td  height="5"  style="padding: 4px">Bank Amount : {{$bank_amount}}</td>
                            <td  height="5"  style="padding: 4px">Cheque Amount : {{$cheque_amount}}</td>
                            <td  height="5"  style="padding: 4px">Other's Amount : {{$others_amount}}</td>
                        </tr>
                        <tr >
                            <td  height="5"  style="padding: 4px">Bill Amount : {{$money_receipt->bill_amount}}</td>
                            <td colspan="{{$money_receipt->discount < 1 ? '2': ''}}" height="5"  style="padding: 4px">Received BDT : {{$money_receipt->total_received_amount}}</td>
                            @if($money_receipt->discount > 0)
                            <td  height="5"  style="padding: 4px">Discount : {{$money_receipt->discount}}</td>
                            @endif
                            <td  height="5"  style="padding: 4px">Total Dues : {{$money_receipt->due_amount}}</td>
                        </tr>
                        <tr >
                            <td colspan="4" height="5" style="padding: 4px">BDT (in words) : {{$clear_total_price}} taka only</td>
                        </tr>
                        <tr >
                            <td colspan="4" height="5" style="padding: 4px">Narration : {{$money_receipt->narration}}</td>
                        </tr>
                        </tbody>
                    </table>
                    </font>
                </div>
            </div>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 10px">

                            <div class="col-xs-4 col-md-4" style=" float: left">Depositor's Signature : </div>

                            <div class="col-xs-4 col-md-4" style="text-align: center; float: right" >Athorized Signature : </div>
                        </div>
                    </font>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 5px">

                            <div class="col-xs-4 col-md-4" style="float: left">Money Receipt Number : M-{{$money_receipt->id}}</div>
                            <div class="col-xs-4 col-md-4" style="text-align: right; float: right" >Date : {{$money_receipt->created_at->format('d-m-Y')}}</div>
                        </div>
                    </font>
                </div>
            </div>
            <div class="row" style="margin: 0px 5px">
                <h4 style="text-align: center;">Accounts Copy</h4>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 table-responsive">
                    <font size="1" face="Courier New" >
                        <table class="table table-bordered">
                            <tbody>
                            <tr >
                                <td colspan="4" height="5"   style="padding: 4px">Name : {{$money_receipt->guestt->name}}</td>
                            </tr>
                            <tr >
                                <td colspan="4" height="5" style="padding: 4px">Address :  {{$money_receipt->guestt->address}}</td>
                            </tr>
                            <tr >
                                <td colspan="2" height="5"  style="padding: 4px">Phone Number : {{$money_receipt->guestt->phone_number}} </td>
                                <td colspan="2" height="5"  style="padding: 4px">Payment Mode : {{$money_receipt->cash == 1 ? 'Cash' : '' }}{{$money_receipt->bank == 1 ? '-Bank' : '' }}{{$money_receipt->cheque == 1 ? '-Cheque' : '' }}{{$money_receipt->other == 1 ? '-Others' : '' }}</td>
                            </tr>
                            <tr >
                                <td  height="5"  style="padding: 4px">Cash Amount : {{$cash_amount}}</td>
                                <td  height="5"  style="padding: 4px">Bank Amount : {{$bank_amount}}</td>
                                <td  height="5"  style="padding: 4px">Cheque Amount : {{$cheque_amount}}</td>
                                <td  height="5"  style="padding: 4px">Other's Amount : {{$others_amount}}</td>
                            </tr>
                            <tr >
                                <td  height="5"  style="padding: 4px">Bill Amount : {{$money_receipt->bill_amount}}</td>
                                <td colspan="{{$money_receipt->discount < 1 ? '2': ''}}" height="5"  style="padding: 4px">Received BDT : {{$money_receipt->total_received_amount}}</td>
                                @if($money_receipt->discount > 0)
                                    <td  height="5"  style="padding: 4px">Discount : {{$money_receipt->discount}}</td>
                                @endif
                                <td  height="5"  style="padding: 4px">Total Dues : {{$money_receipt->due_amount}}</td>
                            </tr>
                            <tr >
                                <td colspan="4" height="5" style="padding: 4px">BDT (in words) : {{$clear_total_price}} taka only</td>
                            </tr>
                            <tr >
                                <td colspan="4" height="5" style="padding: 4px">Narration : {{$money_receipt->narration}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </font>
                </div>
            </div>
            <div class="row">
                <div>
                    <font size="2" face="Courier New" >
                        <div class="row" style="margin: 0px 10px">

                            <div class="col-xs-4 col-md-4" style=" float: left">Depositor's Signature : </div>

                            <div class="col-xs-4 col-md-4" style="text-align: center; float: right" >Athorized Signature : </div>
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
