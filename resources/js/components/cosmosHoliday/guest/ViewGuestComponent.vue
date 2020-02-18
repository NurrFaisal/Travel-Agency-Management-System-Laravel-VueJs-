<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Guest Transaction</li>
                </ul><!-- /.breadcrumb -->

            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        Guest Transaction
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div>
                            <div id="user-profile-2" class="user-profile">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs padding-18">

                                        <li class="active">
                                            <a data-toggle="tab" href="#transjaction" aria-expanded="false">
                                                <i class="blue ace-icon fa fa-users bigger-120"></i>
                                                Transjaction
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="tab-content no-border padding-24">
                                        <div id="transjaction" class="tab-pane active">
                                            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                                                <ul class="breadcrumb">

                                                </ul><!-- /.breadcrumb -->

                                                <div class="nav-search" id="nav-search">
                                                    <form class="form-search">
                                                       <span class="input-icon">
                                                           <input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchText()" id="nav-search-input" v-model="search_text" autocomplete="off" />
                                                           <i class="ace-icon fa fa-search nav-search-icon"></i></span>
                                                    </form>
                                                </div><!-- /.nav-search -->
                                            </div>
                                            <div class="row">
                                                <loading :active.sync="isLoading"
                                                         :can-cancel="false"
                                                         color="#438EB9"
                                                         :width=this.width
                                                         :height=this.height
                                                         loader="bars"
                                                         :is-full-page="fullPage">
                                                </loading>
                                                <div class="col-xs-12">
                                                    <!-- PAGE CONTENT BEGINS -->
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <table id="simple-table_transaction" class="table  table-bordered table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th class="center">Date</th>
                                                                    <th class="center">Invoice No</th>
                                                                    <th class="center">Narration</th>
                                                                    <th class="center">Staff Name</th>
                                                                    <th class="center">Debit</th>
                                                                    <th class="center">Credit</th>
                                                                    <th class="center">Blance</th>
                                                                </tr>
                                                                </thead>

                                                                <tbody>
                                                                <tr v-for="(transjaction, index) in  transjactions">
                                                                    <td>{{transjaction.transjaction_date | timeformate}}</td>
                                                                    <td v-if="transjaction.air_id != null">A-{{transjaction.air_id}}</td>
                                                                    <td v-if="transjaction.pack_id != null">P-{{transjaction.pack_id}}</td>
                                                                    <td v-if="transjaction.hotel_id != null">H-{{transjaction.hotel_id}}</td>
                                                                    <td v-if="transjaction.visa_id != null">V-{{transjaction.visa_id}}</td>
                                                                    <td style="background-color: greenyellow;" v-if="transjaction.received_id != null">M-{{transjaction.received_id}}</td>
                                                                    <td v-if="transjaction.discount_id != null">D-{{transjaction.discount_id}}</td>
                                                                    <td>{{transjaction.narration}}</td>
                                                                    <td>{{transjaction.staff.first_name}}</td>
                                                                    <td>{{transjaction.debit_amount}}</td>
                                                                    <td>{{transjaction.credit_amount}}</td>
                                                                    <td>{{transjaction.guest_blance}}</td>


                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div><!-- /.span -->
                                                        <div class="justify-content-center">
                                                            <pagination v-if="pagination.last_page > 1"
                                                                        :pagination="pagination"
                                                                        :offset="5"
                                                                        @paginate="getAllGuestTransaction()"
                                                            ></pagination>
                                                        </div>

                                                    </div><!-- /.row -->
                                                    <div class="hr hr-18 dotted hr-double"></div>
                                                    <!-- PAGE CONTENT ENDS -->
                                                </div><!-- /.col -->
                                            </div><!-- /.row -->
                                        </div><!-- /#pictures -->
                                    </div>
                                </div>
                            </div>
                        </div>
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
        name: "ViewGuestComponent",
        mounted() {
            this.isLoading = true
            this.getAllGuestTransaction()
        },
        components: {
            Loading
        },
        data(){
            return {
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                search_text:'',
                transjactions:'',
                pagination:{
                    current_page: 1,
                },


            }
        },
        methods:{

            getAllGuestTransaction(){
                axios.get(`/api/get-all-guest-transaction/${this.$route.params.id}?page=`+this.pagination.current_page)
                    .then(response => {
                        this.transjactions = response.data.transjactions.data
                        this.pagination = response.data.transjactions
                        this.isLoading = false
                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllSearchTransaction(this.search_text)
                }else{
                    this.getAllGuestTransaction();
                }
            },1000),
            getAllSearchTransaction(searchText){
                axios.get(`/api/get-all-staff-transaction-search/${this.$route.params.id}/`+searchText+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.transjactions = response.data.transjactions.data
                        this.pagination = response.data.transjactions
                        this.isLoading = false
                    })
            },
        }
    }
</script>

<style scoped>

</style>
