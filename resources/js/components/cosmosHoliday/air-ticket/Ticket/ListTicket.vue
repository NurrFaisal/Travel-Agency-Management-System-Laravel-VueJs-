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
                        <router-link to="/dashboard">Home</router-link>
                    </li>

                    <li>
                        <router-link to="/ticket-list">Ticket List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchAirTicket()" id="nav-search-input" v-model="searchText" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
                <div class="modal fade" id="air_ticket_refound" aria-hidden="true" role="dialog"  tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4 class="modal-title">Air Ticket Refund</h4>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="addAirTicketRefund()" method="post">
                                    <div class="row">
                                        <label for="refund_date" class="col-sm-5">Refund Date:</label>
                                        <div class="col-sm-7">
                                            <input type="date" v-model="form.refund_date" id="refund_date" name="refund_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                        </div>
                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                            <has-error style="color:red" :form="form" field="refund_date"></has-error>
                                            <span style="color: red">{{ errors.first('refund_date') }}</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label for="amount" class="col-sm-5">Amount:</label>
                                        <div class="col-sm-7">
                                            <input type="number" v-model="form.amount" id="amount" name="amount" class="form-control"  style="max-width: 95%;" value="" required="">
                                        </div>
                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                            <has-error style="color:red" :form="form" field="amount"></has-error>
                                            <span style="color: red">{{ errors.first('amount') }}</span>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-5 text-right"></div>
                                        <div class="col-sm-5">
                                            <input type="submit" name="" class="button" style="background-color: #d3d3d380 !important;" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-header">
                    <h1>
                        Tickets List
<!--                        <div class="card-tools" style="float:right">-->
<!--                            <router-link to="/new-air-ticket" class="btn btn-success">Add New Air Ticket</router-link>-->
<!--                        </div>-->
                        <br/>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">Sl.</th>
                                        <th  class="center" >Invoice No</th>
                                        <th  class="center" >PNR</th>
                                        <th  class="center" >issue Date</th>
                                        <th  class="center" >Departure Date</th>
                                        <th  class="center" >Return Date</th>
                                        <th  class="center" >Air Line</th>
                                        <th  class="center" >Net Price</th>
                                        <th  class="center" >Sector</th>
                                        <th  class="center" >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(ticket, index) in tickets">
                                        <td class="center">{{index+1}}</td>
                                        <td class="center">A-{{ticket.airticket_id}}</td>
                                        <td class="center">{{ticket.pnr}}</td>
                                        <td class="center">{{ticket.issue_date}}</td>
                                        <td class="center">{{ticket.departure_date}}</td>
                                        <td class="center">{{ticket.return_date}}</td>
                                        <td class="center">{{ticket.airlines.name}}</td>
                                        <td class="center">{{ticket.net_price}}</td>
                                        <td class="center">{{ticket.sector}}</td>
                                        <td class="center">
                                            <div class="btn-group center">
                                                <!--                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
                                                <!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                                <!--
                                                                                           </a>-->
                                                <router-link  :to="`/edit-air-ticket/${ticket.airticket_id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <a v-if="ticket.refund != 1" href="#" @click.prevent="openModalCollected(ticket.id)" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#air_ticket_refound">
                                                    Refund
                                                </a>
                                                <!--                                                                <a href="#"  @click.prevent="openPackageQueryModal(doj.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_query_modal">-->
                                                <!--                                                                    Follow Up-->
                                                <!--                                                                </a>-->
<!--                                                <a @click.prevent="downLoadInvoice(ticket.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">-->
<!--                                                    Invoice-->
<!--                                                </a>-->
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->




                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getAirTicket()"
                                ></pagination>
                            </div>
                        </div><!-- /.row -->


                        <div class="hr hr-18 dotted hr-double"></div>

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
        name: "ListTicket",
        mounted() {
            this.isLoading = true
            this.getAirTicket()

        },
        components: {
            Loading
        },
        data(){
            return {
                searchText:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',
                pagination:{
                    current_page: 1,
                },
                tickets: '',
                form: new Form({
                    id:'',
                    refund_date:'',
                    amount:'',
                }),
            }
        },
        methods:{
            getAirTicket(){
                axios.get('/api/get-all-ticket?page='+this.pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.tickets = response.data.tickets.data
                        this.pagination = response.data.tickets
                        this.doAjax();
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
            onCancel() {
                console.log('User cancelled the loader.')
            },
            searchAirTicket:_.debounce(function () {
                this.isLoading = true
                if(this.searchText != ''){
                    this.getAllSearchAirTicket(this.searchText)
                }else{
                    this.getAirTicket();
                }
            },1000),
            getAllSearchAirTicket(searchText){
                axios.get('/api/get-all-ticket-search/'+searchText+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.tickets = response.data.tickets.data
                        this.pagination = response.data.tickets
                        this.doAjax();
                    })
            },
            downLoadInvoice(id){
                this.isLoading = true
                axios.get('/invoice-print-air-ticket/'+id)
                    .then(responese => {
                        this.doAjax()
                    })
            },
            openModalCollected(id){
                this.form.id = id
            },
            addAirTicketRefund(){
                this.form.post('/api/add-air-ticket-refund')
                    .then((response) => {
                        this.form.reset()
                        if(this.searchText != ''){
                            this.getAllSearchAirTicket(this.searchText)
                        }else{
                            this.getAirTicket();
                        }
                        $('#air_ticket_refound').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Air-Ticket Refunded Successfully'
                        })
                    })
            }
        }
    }
</script>

<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
        height: 25px !important;
        border-radius: 4px !important;
    }
    textarea {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
        height: 25px !important;
        font-size: 11px;
        border-radius: 4px !important;
    }

</style>
