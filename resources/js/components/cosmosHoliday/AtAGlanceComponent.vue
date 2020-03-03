<template>
    <div>
        <loading :active.sync="isLoading"
                 :can-cancel="false"
                 color="#438EB9"
                 :width=this.width
                 :height=this.height
                 loader="bars"
                 :is-full-page="fullPage">
        </loading>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchText()" id="nav-search-input" v-model="search_text" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->

                        <div class="row">
                            <div class="space-6"></div>
                            <div class="vspace-12-sm"></div>
                            <div class="">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h5 class="widget-title">At a Glance</h5>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <div class="row">
                                                <div class="space-6"></div>
                                                <div class="col-sm-12 infobox-container">
                                                    <div class="infobox infobox-green">
                                                        <div class="infobox-icon">
                                                            <i class="ace-icon fa fa-plane"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <span class="infobox-data-number">{{air_ticket_count}}</span>
                                                            <div class="infobox-content"><strong>Air-Ticket</strong></div>
                                                        </div>

                                                    </div>

                                                    <div class="infobox infobox-blue">
                                                        <div class="infobox-icon">
                                                            <i class="ace-icon fa fa-umbrella"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <span class="infobox-data-number">{{package_count}}</span>
                                                            <div class="infobox-content"><strong>Package</strong></div>
                                                        </div>

                                                    </div>

                                                    <div class="infobox infobox-pink">
                                                        <div class="infobox-icon">
                                                            <i class="ace-icon fa fa-cloud"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <span class="infobox-data-number">{{visa_count}}</span>
                                                            <div class="infobox-content"><strong>VISA</strong></div>
                                                        </div>
                                                    </div>

                                                    <div class="infobox infobox-red">
                                                        <div class="infobox-icon">
                                                            <i class="ace-icon fa fa-hotel"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <span class="infobox-data-number">{{hotel_booking_count}}</span>
                                                            <div class="infobox-content"><strong>Hotel Booking</strong></div>
                                                        </div>
                                                    </div>
                                                    <div class="infobox infobox-green">
                                                        <div class="infobox-icon">
                                                            <i class="ace-icon fa fa-money"></i>
                                                        </div>

                                                        <div class="infobox-data">
                                                            <span class="infobox-data-number">{{air_ticket_count+package_count+hotel_booking_count+visa_count}}</span>
                                                            <div class="infobox-content"><strong>Total</strong></div>
                                                        </div>
                                                    </div>

                                                    <div class="space-6"></div>
                                                </div>

                                                <div class="vspace-12-sm"></div>

                                            </div><!-- /.row -->
                                            <div class="row">

                                                <div class="col-xs-12">

                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th style="background-color: whitesmoke; font-size: 17px" colspan="5" class="center widget-title"><strong>Sevice</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="center" style="background-color: #9ABC32; color:white"><strong>Air-Ticket</strong></th>
                                                            <th class="center" style="background-color: #6FB3E0; color:white"><strong>Package</strong></th>
                                                            <th class="center" style="background-color: #CB6FD7; color:white"><strong>VISA</strong></th>
                                                            <th class="center" style="background-color: #D53F40; color:white"><strong>Hotel Booking</strong></th>
                                                            <th class="center" style="background-color: #9ABC32; color:white"><strong>Total</strong></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th style="font-size: 17px; color: #9ABC32" class="center"><strong>{{air_ticket_sum}}</strong></th>
                                                            <th style="font-size: 17px; color: #6FB3E0" class="center"><strong>{{package_sum}}</strong></th>
                                                            <th style="font-size: 17px; color: #CB6FD7" class="center"><strong>{{visa_sum}}</strong></th>
                                                            <th style="font-size: 17px; color: #D53F40" class="center"><strong>{{hotel_booking_sum}}</strong></th>
                                                            <th style="font-size: 17px; color: #9ABC32" class="center"><strong>{{sum_service}}.00</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th style="background-color: whitesmoke; font-size: 17px" colspan="4" class="center widget-title"><strong>Accounts</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="center" style="background-color: #9ABC32; color:white"><strong>Cash Closing Balance</strong></th>
                                                            <th class="center" style="background-color: #6FB3E0; color:white"><strong>Bank Closing Balance</strong></th>
                                                            <th class="center" style="background-color: #CB6FD7; color:white"><strong>Unclear Cheque Amount</strong></th>
                                                            <th class="center" style="background-color: #D53F40; color:white"><strong>Other's Amount</strong></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th style="font-size: 17px; color: #9ABC32" class="center"><strong>{{cash_book}}</strong></th>
                                                            <th style="font-size: 17px; color: #6FB3E0" class="center"><strong>{{bank_book}}</strong></th>
                                                            <th style="font-size: 17px; color: #CB6FD7" class="center"><strong>{{cheque}}</strong></th>
                                                            <th style="font-size: 17px; color: #D53F40" class="center"><strong>{{others}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th style="background-color: whitesmoke; font-size: 17px" colspan="4" class="center widget-title"><strong>Balance</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="center" style="background-color: #9ABC32; color:white"><strong>Account Receivable</strong></th>
                                                            <th class="center" style="background-color: #6FB3E0; color:white"><strong>Account Payable</strong></th>
                                                            <th class="center" style="background-color: #CB6FD7; color:white"><strong>Received</strong></th>
                                                            <th class="center" style="background-color: #D53F40; color:white"><strong>Payment</strong></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th style="font-size: 17px; color: #9ABC32" class="center"><strong>{{guest_blance}}</strong></th>
                                                            <th style="font-size: 17px; color: #6FB3E0" class="center"><strong>{{suplier_blance}}</strong></th>
                                                            <th style="font-size: 17px; color: #CB6FD7" class="center"><strong>{{received}}</strong></th>
                                                            <th style="font-size: 17px; color: #D53F40" class="center"><strong>{{payment}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th style="background-color: whitesmoke; font-size: 17px" colspan="5" class="center widget-title"><strong>Loan and Expense</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="center" style="background-color: #9ABC32; color:white"><strong>Received Loan</strong></th>
                                                            <th class="center" style="background-color: #6FB3E0; color:white"><strong>Payment Loan</strong></th>
                                                            <th class="center" style="background-color: #CB6FD7; color:white"><strong>Expense</strong></th>
                                                            <th class="center" style="background-color: #D53F40; color:white"><strong>Salary</strong></th>
                                                            <th class="center" style="background-color: green; color:white"><strong>Incentive</strong></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th style="font-size: 17px; color: #9ABC32" class="center"><strong>{{received_loan}}</strong></th>
                                                            <th style="font-size: 17px; color: #6FB3E0" class="center"><strong>{{payment_loan}}</strong></th>
                                                            <th style="font-size: 17px; color: #CB6FD7" class="center"><strong>{{expense}}</strong></th>
                                                            <th style="font-size: 17px; color: #D53F40" class="center"><strong>{{salary}}</strong></th>
                                                            <th style="font-size: 17px; color: green" class="center"><strong>{{incentive}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th style="background-color: whitesmoke; font-size: 17px" colspan="2" class="center widget-title"><strong>Accounts</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="center" style="background-color: #9ABC32; color:white"><strong>Dhanmondi Cash Closing Balance</strong></th>
                                                            <th class="center" style="background-color: #6FB3E0; color:white"><strong>Banani Cash Closing Balance</strong></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th style="font-size: 17px; color: #9ABC32" class="center"><strong>{{dhanmondi_cash_book}}</strong></th>
                                                            <th style="font-size: 17px; color: #6FB3E0" class="center"><strong>{{banani_cash_book}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>



                                                </div><!-- /.span -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "AtAGlanceComponent",
        components: {Loading},
        mounted(){
            this.atAGlance()
        },
        computed:{
            sum_service(){
                return parseInt(this.air_ticket_sum)+parseInt(this.package_sum)+parseInt(this.visa_sum)+parseInt(this.hotel_booking_sum)
            }
        },

        data(){
            return {
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',

                air_ticket_count:0,
                package_count:0,
                visa_count:0,
                hotel_booking_count:0,

                air_ticket_sum:0,
                package_sum:0,
                visa_sum:0,
                hotel_booking_sum:0,

                guest_blance:0,
                suplier_blance:0,
                received:0,
                payment:0,

                cash_book:'',
                bank_book:'',
                cheque:0,
                others:0,

                dhanmondi_cash_book:'',
                banani_cash_book:'',

                received_loan:'',
                payment_loan:'',
                expense:0,
                salary:0,
                incentive:0,


                user_type:'super-admin',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
            }
        },
        methods:{
            atAGlance(){
                this.isLoading = true
                axios.get(`/api/view-at-a-glance`)
                    .then((response) => {
                        this.air_ticket_count = response.data.air_ticket_count
                        this.package_count = response.data.package_count
                        this.visa_count = response.data.visa_count
                        this.hotel_booking_count = response.data.hotel_booking_count
                        this.air_ticket_sum = response.data.air_ticket_sum
                        this.package_sum = response.data.package_sum
                        this.visa_sum = response.data.visa_sum
                        this.hotel_booking_sum = response.data.hotel_booking_sum
                        this.cash_book = response.data.cash_book.blance
                        if(response.data.dhanmondi_cash_book != null){
                            this.dhanmondi_cash_book = response.data.dhanmondi_cash_book.branch_blance
                        }else{
                            this.dhanmondi_cash_book = 0.00
                        }
                        if(response.data.banani_cash_book != null){
                            this.banani_cash_book = response.data.banani_cash_book.branch_blance
                        }else{
                            this.banani_cash_book = 0.00
                        }

                        this.bank_book = response.data.bank_book.blance
                        this.cheque = response.data.cheque
                        this.others = response.data.others
                        this.guest_blance = response.data.guest_blance.blance
                        this.suplier_blance = response.data.suplier_blance.balance
                        this.received = response.data.received
                        this.payment = response.data.payment
                        this.received_loan = response.data.received_loan.blance
                        this.payment_loan = response.data.payment_loan.blance
                        this.expense = response.data.expense
                        this.salary = response.data.salary
                        this.incentive = response.data.incentive
                        this.isLoading = false
                    })
            },



            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.atAGlanceSearch(this.search_text)
                }else{
                    this.atAGlance();
                }
            },1000),
            atAGlanceSearch(search_text){
                axios.get('/api/view-at-a-glance-search/'+search_text)
                    .then(response => {
                        this.air_ticket_count = response.data.air_ticket_count
                        this.package_count = response.data.package_count
                        this.visa_count = response.data.visa_count
                        this.hotel_booking_count = response.data.hotel_booking_count
                        this.air_ticket_sum = response.data.air_ticket_sum
                        this.package_sum = response.data.package_sum
                        this.visa_sum = response.data.visa_sum
                        this.hotel_booking_sum = response.data.hotel_booking_sum
                        this.cash_book = response.data.cash_book.blance
                        this.bank_book = response.data.bank_book.blance
                        this.cheque = response.data.cheque
                        this.others = response.data.others
                        this.guest_blance = response.data.guest_blance.blance
                        this.suplier_blance = response.data.suplier_blance.balance
                        this.received = response.data.received
                        this.payment = response.data.payment
                        this.received_loan = response.data.received_loan.blance
                        this.payment_loan = response.data.payment_loan.blance
                        this.expense = response.data.expense
                        this.salary = response.data.salary
                        this.incentive = response.data.incentive
                        this.isLoading = false
                    })

            },
        }
    }
</script>

<style scoped>
    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
        height: 25px !important;
        font-size: 11px;
        border-radius: 4px !important;
    }
</style>
