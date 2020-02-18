<template>
   <div>
       <div class="main-content-inner">
           <div class="breadcrumbs ace-save-state">
               <ul class="breadcrumb">
                   <li>
                       <i class="ace-icon fa fa-home home-icon"></i>
                       <a href="#">Home</a>
                   </li>


                   <li class="active">User Profile</li>
               </ul><!-- /.breadcrumb -->

           </div>

           <div class="page-content">
               <div class="page-header">
                   <h1>
                       User Profile Page
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
                                           <a data-toggle="tab" href="#basic" aria-expanded="true">
                                               <i class="green ace-icon fa fa-user bigger-120"></i>
                                               Basic
                                           </a>
                                       </li>

                                       <li class="">
                                           <a data-toggle="tab" href="#job_information" aria-expanded="false">
                                               <i class="orange ace-icon fa fa-rss bigger-120"></i>
                                               Job Information
                                           </a>
                                       </li>

                                       <li class="">
                                           <a data-toggle="tab" href="#emergency_contact" aria-expanded="false">
                                               <i class="blue ace-icon fa fa-users bigger-120"></i>
                                               Emergency Contact
                                           </a>
                                       </li>

                                       <li class="">
                                           <a data-toggle="tab" href="#guest" aria-expanded="false">
                                               <i class="blue ace-icon fa fa-users bigger-120"></i>
                                               Guest
                                           </a>
                                       </li>
                                       <li class="">
                                           <a data-toggle="tab" href="#transjaction" aria-expanded="false">
                                               <i class="blue ace-icon fa fa-users bigger-120"></i>
                                               Transjaction
                                           </a>
                                       </li>
                                       <li class="">
                                           <a data-toggle="tab" href="#profit" aria-expanded="false">
                                               <i class="blue ace-icon fa fa-users bigger-120"></i>
                                               Profit
                                           </a>
                                       </li>
                                   </ul>

                                   <div class="tab-content no-border padding-24">
                                       <div id="basic" class="tab-pane active">
                                           <loading :active.sync="isLoading"
                                                    :can-cancel="false"
                                                    color="#438EB9"
                                                    :width=this.width
                                                    :height=this.height
                                                    loader="bars"
                                                    :is-full-page="fullPage">
                                           </loading>
                                           <div class="row">
                                               <div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">
																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" :src="staff.image">
															</span>

                                                   <div class="space space-4"></div>


                                               </div><!-- /.col -->

                                               <div class="col-xs-12 col-sm-9">
                                                   <h4 class="blue">
                                                       <span class="middle">{{staff.first_name+' '+staff.last_name}}</span>
                                                   </h4>

                                                   <div class="profile-user-info">
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Username </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.first_name+' '+staff.last_name}}</span>
                                                           </div>
                                                       </div>

                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Location </div>

                                                           <div class="profile-info-value">
                                                               <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                               <span>{{staff.address}}</span>
                                                           </div>
                                                       </div>

                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Date Of Birth </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.date_of_birth}}</span>
                                                           </div>
                                                       </div>
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Phone Number </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.phone_number}}</span>
                                                           </div>
                                                       </div>
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name">Alt Phone Number </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.alt_phone_number}}</span>
                                                           </div>
                                                       </div>
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Email Address </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.email_address}}</span>
                                                           </div>
                                                       </div>
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Passport Number </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.passport}}</span>
                                                           </div>
                                                       </div>
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> NID </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.nid}}</span>
                                                           </div>
                                                       </div>
                                                       <div class="profile-info-row">
                                                           <div class="profile-info-name"> Blood Group </div>

                                                           <div class="profile-info-value">
                                                               <span>{{staff.blood_group}}</span>
                                                           </div>
                                                       </div>


                                                   </div>

                                                   <div class="hr hr-8 dotted"></div>


                                               </div><!-- /.col -->
                                           </div>
                                       </div><!-- /#home -->
                                       <div id="job_information" class="tab-pane">
                                           <div class="row">
                                               <div class="col-xs-12">
                                                   <table id="simple-table" class="table  table-bordered table-hover">
                                                       <thead>
                                                       <tr>
                                                           <th colspan="2" class="center">Job Information</th>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                       <tr>
                                                           <th class="center">Designation</th>
                                                           <th class="center">{{staff.designationt.staff_designation}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Staff ID</th>
                                                           <th class="center">COS-{{staff.staff_id}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Department</th>
                                                           <th class="center">{{staff.departmentt.department_name}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Location</th>
                                                           <th class="center">{{staff.location == 1 ? 'Dhanmondi' : 'Banani'}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Start Date</th>
                                                           <th class="center">{{staff.start_date}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Salary</th>
                                                           <th class="center">BDT - {{staff.salary}} /=</th>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                               </div><!-- /.span -->
                                           </div>
                                       </div><!-- /#feed -->
                                       <div id="emergency_contact" class="tab-pane">
                                           <div class="row">
                                               <div class="col-xs-12">
                                                   <table id="simple-table_fp" class="table  table-bordered table-hover">
                                                       <thead>
                                                       <tr>
                                                           <th colspan="2" class="center">First Person Information</th>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                       <tr>
                                                           <th class="center">Name</th>
                                                           <th class="center">{{staff.first_person_name}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Phone Number</th>
                                                           <th class="center">{{staff.first_person_phone_number}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Reletionship</th>
                                                           <th class="center">{{staff.first_person_relationship}}</th>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                                   <br/>
                                                   <table id="simple-table_2" class="table  table-bordered table-hover">
                                                       <thead>
                                                       <tr>
                                                           <th colspan="2" class="center">Second Person Information</th>
                                                       </tr>
                                                       </thead>
                                                       <tbody>
                                                       <tr>
                                                           <th class="center">Name</th>
                                                           <th class="center">{{staff.second_person_name}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Phone Number</th>
                                                           <th class="center">{{staff.second_person_phone_number}}</th>
                                                       </tr>
                                                       <tr>
                                                           <th class="center">Reletionship</th>
                                                           <th class="center">{{staff.second_person_relationship}}</th>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                               </div><!-- /.span -->
                                           </div>
                                       </div><!-- /#friends -->
                                       <div id="guest" class="tab-pane">
                                           <div class="row">
                                               <div class="col-xs-12">
                                                   <!-- PAGE CONTENT BEGINS -->
                                                   <div class="row">
                                                       <div class="col-xs-12">
                                                           <table id="simple-table_guest" class="table  table-bordered table-hover">
                                                               <thead>
                                                               <tr>
                                                                   <th class="center">Sl.</th>
                                                                   <th class="center">Name</th>
                                                                   <th>Email Address</th>
                                                                   <th>Phone Number</th>
                                                                   <th>Alt Phone Number</th>
                                                                   <th>Action</th>
                                                               </tr>
                                                               </thead>

                                                               <tbody>
                                                               <tr v-for="(guest, index) in  guests">
                                                                   <td class="center">{{index+1}}</td>
                                                                   <td>{{guest.name}}</td>
                                                                   <td>{{guest.email_address}}</td>
                                                                   <td>{{guest.phone_number}}</td>
                                                                   <td>{{guest.alt_phone_number}}</td>

                                                                   <td class="center">
                                                                       <div class="hidden-sm hidden-xs btn-group">

                                                                           <button class="btn btn-xs btn-success">
                                                                               <i class="ace-icon fa fa-eye bigger-120"></i>
                                                                           </button>
<!--                                                                           <router-link :to="`/edit-received/${received.id}`" class="btn btn-xs btn-info">-->
<!--                                                                               <i class="ace-icon fa fa-pencil bigger-120"></i>-->
<!--                                                                           </router-link>-->

                                                                           <!--                                                <button @click.prevent="deleteGuestTitle(received.id)" class="btn btn-xs btn-danger">-->
                                                                           <!--                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>-->
                                                                           <!--                                                </button>-->

                                                                       </div>
                                                                   </td>
                                                               </tr>
                                                               </tbody>
                                                           </table>
                                                       </div><!-- /.span -->
                                                       <div class="justify-content-center">
                                                           <pagination v-if="pagination2.last_page > 1"
                                                                       :pagination="pagination2"
                                                                       :offset="5"
                                                                       @paginate="getAllStaffGuest()"
                                                           ></pagination>
                                                       </div>

                                                   </div><!-- /.row -->
                                                   <div class="hr hr-18 dotted hr-double"></div>
                                                   <!-- PAGE CONTENT ENDS -->
                                               </div><!-- /.col -->
                                           </div><!-- /.row -->
                                       </div><!-- /#pictures -->
                                       <div id="transjaction" class="tab-pane">
                                           <div class="row">
                                               <div class="col-xs-12">
                                                   <!-- PAGE CONTENT BEGINS -->
                                                   <div class="row">
                                                       <div class="col-xs-12">
                                                           <table id="simple-table_transaction" class="table  table-bordered table-hover">
                                                               <thead>
                                                               <tr>
                                                                   <th class="center">Date</th>
                                                                   <th class="center">Invoice No</th>
                                                                   <th class="center">Guest Name</th>
                                                                   <th class="center">Phone Number</th>
                                                                   <th class="center">Narration</th>
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
                                                                   <td v-if="transjaction.received_id != null">M-{{transjaction.received_id}}</td>
                                                                   <td v-if="transjaction.discount_id != null">D-{{transjaction.discount_id}}</td>
                                                                   <td>{{transjaction.guest.name}}</td>
                                                                   <td>{{transjaction.guest.phone_number}}</td>
                                                                   <td>{{transjaction.narration}}</td>
                                                                   <td>{{transjaction.debit_amount}}</td>
                                                                   <td>{{transjaction.credit_amount}}</td>
                                                                   <td>{{transjaction.staff_blance}}</td>


                                                               </tr>
                                                               </tbody>
                                                           </table>
                                                       </div><!-- /.span -->
                                                       <div class="justify-content-center">
                                                           <pagination v-if="pagination3.last_page > 1"
                                                                       :pagination="pagination3"
                                                                       :offset="5"
                                                                       @paginate="getAllStaffTransaction()"
                                                           ></pagination>
                                                       </div>

                                                   </div><!-- /.row -->
                                                   <div class="hr hr-18 dotted hr-double"></div>
                                                   <!-- PAGE CONTENT ENDS -->
                                               </div><!-- /.col -->
                                           </div><!-- /.row -->
                                       </div><!-- /#pictures -->
                                       <div id="profit" class="tab-pane">

                                           <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                                               <ul class="breadcrumb">

                                               </ul><!-- /.breadcrumb -->

                                               <div class="nav-search" id="nav-search">
                                                   <form class="form-search">
                                                       <span class="input-icon">
                                                           <input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchProfit()" id="nav-search-input" v-model="search_profit" autocomplete="off" />
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
                                                           <table id="simple-table_profit" class="table  table-bordered table-hover">
                                                               <thead>
                                                               <tr>
                                                                   <th class="center">Sl.</th>
                                                                   <th class="center">Guest</th>
                                                                   <th class="center">Phone Number</th>
                                                                   <th>Invoice</th>
                                                                   <th>Date</th>
                                                                   <th>Amount</th>
                                                               </tr>
                                                               </thead>

                                                               <tbody>
                                                               <tr v-for="(profit, index) in  profits">
                                                                   <td class="center">{{index+1}}</td>
                                                                   <td>{{profit.guest.name}}</td>
                                                                   <td>{{profit.guest.phone_number}}</td>
                                                                   <td v-if="profit.air_id != null">A-{{profit.air_id}}</td>
                                                                   <td v-if="profit.visa_id != null">V-{{profit.visa_id}}</td>
                                                                   <td v-if="profit.hotel_id != null">H-{{profit.hotel_id}}</td>
                                                                   <td v-if="profit.pack_id != null">P-{{profit.pack_id}}</td>
                                                                   <td>{{profit.profit_date}}</td>
                                                                   <td>{{profit.amount}}</td>
                                                               </tr>
                                                               </tbody>
                                                               <tfoot>
                                                               <tr>
                                                                   <th colspan="5" style="text-align: right">Total :</th>
                                                                   <th>{{sum_profits}}</th>
                                                               </tr>
                                                               </tfoot>
                                                           </table>
                                                       </div><!-- /.span -->
                                                       <div class="justify-content-center">
                                                           <pagination v-if="pagination.last_page > 1"
                                                                       :pagination="pagination"
                                                                       :offset="5"
                                                                       @paginate="getStaffProfit()"
                                                           ></pagination>
                                                       </div>

                                                   </div><!-- /.row -->
                                                   <div class="hr hr-18 dotted hr-double"></div>
                                                   <!-- PAGE CONTENT ENDS -->
                                               </div><!-- /.col -->
                                           </div>
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
        name: "ViewStaffComponent",
        mounted() {
            this.isLoading = true
            this.getStaffProfit()
            this.getAllStaffGuest()
            this.getAllStaffTransaction()
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

                search_profit:'',


                staff:'',
                profits:'',
                sum_profits:'',
                guests:'',
                transjactions:'',
                pagination:{
                    current_page: 1,
                },
                pagination2:{
                    current_page: 1,
                },
                pagination3:{
                    current_page: 1,
                },

            }
        },

        created() {
            axios.get(`/api/view-staff/${this.$route.params.id}`)
                .then((response) => {
                    this.staff = response.data.staff
                })
        },
        methods:{
            getStaffProfit(){
                axios.get(`/api/get-all-staff-profit/${this.$route.params.id}?page=`+this.pagination.current_page)
                    .then(response => {
                        this.sum_profits = response.data.sum_profits
                        this.profits = response.data.profits.data
                        this.pagination = response.data.profits
                        this.isLoading = false
                    })
            },
            getAllStaffGuest(){
                axios.get(`/api/get-all-staff-guest/${this.$route.params.id}?page=`+this.pagination2.current_page)
                    .then(response => {
                        this.guests = response.data.guests.data
                        this.pagination2 = response.data.guests
                        this.isLoading = false
                    })
            },
            getAllStaffTransaction(){
                axios.get(`/api/get-all-staff-transaction/${this.$route.params.id}?page=`+this.pagination3.current_page)
                    .then(response => {
                        this.transjactions = response.data.transjactions.data
                        this.pagination3 = response.data.transjactions
                        this.isLoading = false
                    })
            },
            searchProfit:_.debounce(function () {
                this.isLoading = true
                if(this.search_profit != ''){
                    this.getAllSearchProfit(this.search_profit)
                }else{
                    this.getStaffProfit();
                }
            },1000),
            getAllSearchProfit(searchText){
                axios.get(`/api/get-all-staff-profit-search/${this.$route.params.id}/`+searchText+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.sum_profits = response.data.sum_profits
                        this.profits = response.data.profits.data
                        this.pagination = response.data.profits
                        this.isLoading = false
                    })

            },
        }
    }
</script>

<style scoped>

</style>
