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
                                        <td class="center">{{ticket.sector}}</td>
                                        <td class="center">
                                            <div class="btn-group center">
                                                <!--                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
                                                <!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                                <!--                                                </a>-->
                                                <router-link  :to="`/edit-air-ticket/${ticket.airticket_id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
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
            }
        }
    }
</script>

<style scoped>

</style>
