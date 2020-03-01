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
                        <router-link to="/new-package">New Package</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input autocomplete="off" class="nav-search-input" id="nav-search-input" placeholder="Search ..." type="text"/>
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
                                        <h5 class="widget-title">Package Details</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/package-list" class="btn btn-success">Package List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <table id="simple-table_fp" class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="2" class="center widget-title">Package Basic Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center">Invoice ID</th>
                                                            <th class="center">P - {{package.id}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Guest Name</th>
                                                            <th class="center">{{package.guestt.name}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Staff Name</th>
                                                            <th class="center">{{package.stafft.first_name+' '+package.stafft.last_name}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Query Date</th>
                                                            <th class="center">{{package.query_date}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Package Type</th>
                                                            <th v-if="package.package_type == 1" class="center">FIT</th>
                                                            <th v-if="package.package_type == 2" class="center">Customise</th>
                                                            <th v-if="package.package_type == 3" class="center">Regular</th>
                                                            <th v-if="package.package_type == 4" class="center">Cosmos Group Tour</th>
                                                            <th v-if="package.package_type == 5" class="center">Eid Group</th>
                                                            <th v-if="package.package_type == 6" class="center">Eid FIT</th>
                                                            <th v-if="package.package_type == 7" class="center">Student Group</th>
                                                            <th v-if="package.package_type == 8" class="center">Corporate Group</th>
                                                            <th v-if="package.package_type == 9" class="center">VIP Group</th>
                                                            <th v-if="package.package_type == 10" class="center">Others</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Country</th>
                                                            <th class="center">{{package.country}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Destination</th>
                                                            <th class="center">{{package.destination}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Duration</th>
                                                            <th class="center">{{package.duration}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Confirm Date</th>
                                                            <th class="center">{{package.confirm_date}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Journey Date</th>
                                                            <th class="center">{{package.journey_date}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Return Date</th>
                                                            <th class="center">{{package.return_date}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Invoice Print</th>
                                                            <th class="center">{{package.print}}</th>
                                                        </tr>
                                                        <tr v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'" >
                                                            <th class="center">Grand Total Net Price</th>
                                                            <th class="center">{{package.grand_total_net_price}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">Grand Total Price</th>
                                                            <th class="center">{{package.grand_total_price}}</th>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="7" class="center widget-title">Days</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center"><strong>Day</strong></th>
                                                            <th class="center"><strong>Date</strong></th>
                                                            <th class="center"><strong>Over Night</strong></th>
                                                            <th class="center"><strong>Breakfast</strong></th>
                                                            <th class="center"><strong>Lunch</strong></th>
                                                            <th class="center"><strong>Dinner</strong></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody v-for="day in package.package_days">
                                                           <tr>
                                                            <th class="center"><strong>{{day.day}}</strong></th>
                                                            <th class="center"><strong>{{day.day_date}}</strong></th>
                                                            <th class="center"><strong>{{day.over_night}}</strong></th>
                                                            <th class="center"><strong>{{day.breakfast == 1 ? 'Yes' : 'No'}}</strong></th>
                                                            <th class="center"><strong>{{day.lunch == 1 ? 'Yes' : 'No'}}</strong></th>
                                                            <th class="center"><strong>{{day.dinner == 1 ? 'Yes' : 'No'}}</strong></th>
                                                        </tr>
                                                           <tr>
                                                               <th colspan="7">Itinerary : {{day.tour_itinerary}}</th>
                                                           </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="3" class="center widget-title">Follow Up To Suplier</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Date</strong></th>
                                                            <th class="center"><strong>Note</strong></th>
                                                        </tr>
                                                        <tr v-for="fs in package.follow_up_to_suplier">
                                                            <th class="center"><strong>{{fs.flw_up_to_suplier_date}}</strong></th>
                                                            <th><strong>{{fs.note}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="3" class="center widget-title">Follow Up To Guest</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Date</strong></th>
                                                            <th class="center"><strong>Guest Reaction</strong></th>
                                                            <th class="center"><strong>Note</strong></th>
                                                        </tr>
                                                        <tr v-for="fg in package.follow_up_to_guest">
                                                            <th class="center"><strong>{{fg.flw_up_to_guest_date}}</strong></th>
                                                            <th class="center">
                                                                <strong v-if="fg.guest_reaction == 1">Excellent</strong>
                                                                <strong v-if="fg.guest_reaction == 2">Good</strong>
                                                                <strong v-if="fg.guest_reaction == 3">Medium</strong>
                                                                <strong v-if="fg.guest_reaction == 4">Poor</strong>
                                                            </th>
                                                            <th><strong>{{fg.note}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover" v-if="user_type == 'super-admin' ||  user_type == 'admin' || user_type == 'operation'">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="3" class="center widget-title">Net Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Date</strong></th>
                                                            <th class="center"><strong>Suplier</strong></th>
                                                            <th class="center"><strong>amount</strong></th>
                                                        </tr>
                                                        <tr v-for="net_price in package.package_net_price">
                                                            <th class="center"><strong>{{net_price.net_price_date}}</strong></th>
                                                            <th class="center"><strong>{{net_price.suplier.name}}</strong></th>
                                                            <th><strong>{{net_price.amount}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="6" class="center widget-title">Pax Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Pax</strong></th>
                                                            <th class="center"><strong>Qty</strong></th>
                                                            <th class="center"><strong>Service</strong></th>
                                                            <th class="center"><strong>Price</strong></th>
                                                            <th class="center"><strong>Total Price</strong></th>
                                                        </tr>
                                                        <tr v-if="package.adult_qty > 0">
                                                            <th class="center"><strong>Adult</strong></th>
                                                            <th class="center"><strong>{{package.adult_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.adult_service}}</strong></th>
                                                            <th class="center"><strong>{{package.adult_price}}</strong></th>
                                                            <th class="center"><strong>{{package.adult_total_price}}</strong></th>
                                                        </tr>
                                                        <tr  v-if="package.child_qty > 0">
                                                            <th class="center"><strong>Child</strong></th>
                                                            <th class="center"><strong>{{package.child_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.child_service}}</strong></th>
                                                            <th class="center"><strong>{{package.child_price}}</strong></th>
                                                            <th class="center"><strong>{{package.child_total_price}}</strong></th>
                                                        </tr>
                                                        <tr v-if="package.infant_qty > 0">
                                                            <th class="center"><strong>Infant</strong></th>
                                                            <th class="center"><strong>{{package.infant_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.infant_service}}</strong></th>
                                                            <th class="center"><strong>{{package.infant_price}}</strong></th>
                                                            <th class="center"><strong>{{package.infant_total_price}}</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center" colspan="4"><strong style="float: right">Total Price</strong></th>
                                                            <th class="center"><strong>{{package.total_total_price}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="10" class="center widget-title">Hotel Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Category</strong></th>
                                                            <th class="center"><strong>Room Qty</strong></th>
                                                            <th class="center"><strong>Room Cate:</strong></th>
                                                            <th class="center"><strong>King</strong></th>
                                                            <th class="center"><strong>Couple</strong></th>
                                                            <th class="center"><strong>Twin</strong></th>
                                                            <th class="center"><strong>Triple</strong></th>
                                                            <th class="center"><strong>Quared</strong></th>
                                                            <th class="center"><strong>Total</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center">
                                                                <strong v-if="package.hotel_cat == 1">7 Star</strong>
                                                                <strong v-if="package.hotel_cat == 2">5 Star</strong>
                                                                <strong v-if="package.hotel_cat == 3">4 Star</strong>
                                                                <strong v-if="package.hotel_cat == 4">3.5 Star</strong>
                                                                <strong v-if="package.hotel_cat == 5">2.5 Star</strong>
                                                                <strong v-if="package.hotel_cat == 6">2 Star</strong>
                                                                <strong v-if="package.hotel_cat == 7">Others</strong>
                                                            </th>
                                                            <th class="center"><strong>{{package.room_qty}}</strong></th>
                                                            <th class="center">
                                                                <strong v-if="package.room_cat == 1">Stander</strong>
                                                                <strong v-if="package.room_cat == 2">Delux</strong>
                                                                <strong v-if="package.room_cat == 3">Super Delux</strong>
                                                                <strong v-if="package.room_cat == 4">Executive Suite</strong>
                                                                <strong v-if="package.room_cat == 5">Mini Suite</strong>
                                                                <strong v-if="package.room_cat == 6">President Suite</strong>
                                                                <strong v-if="package.room_cat == 7">Adjoining rooms</strong>
                                                                <strong v-if="package.room_cat == 8">Adjacent rooms</strong>
                                                                <strong v-if="package.room_cat == 9">Villa</strong>
                                                                <strong v-if="package.room_cat == 10">Floored Room</strong>
                                                            </th>
                                                            <th class="center"><strong>{{package.king_size}}</strong></th>
                                                            <th class="center"><strong>{{package.couple_size}}</strong></th>
                                                            <th class="center"><strong>{{package.twin_size}}</strong></th>
                                                            <th class="center"><strong>{{package.triple_size}}</strong></th>
                                                            <th class="center"><strong>{{package.quared_size}}</strong></th>
                                                            <th class="center"><strong>{{package.total_bed_qty}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="7" class="center widget-title">Service Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Service</strong></th>
                                                            <th class="center"><strong>Qty</strong></th>
                                                            <th class="center"><strong>Note</strong></th>
                                                            <th class="center"><strong>Net Price</strong></th>
                                                            <th class="center"><strong>Price</strong></th>
                                                            <th class="center"><strong>Total Price</strong></th>
                                                        </tr>
                                                        <tr v-if="package.ex_night_qty > 0">
                                                            <th class="center"><strong>Extra Night</strong></th>
                                                            <th class="center"><strong>{{package.ex_night_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.ex_night_note}}</strong></th>
                                                            <th class="center">
                                                                <strong>
                                                                    {{user_type == 'super-admin' ||  user_type == 'admin' || user_type == 'operation'? package.ex_night_net_price : 'N/A'}}
                                                                </strong>
                                                            </th>
                                                            <th class="center"><strong>{{package.ex_night_price}}</strong></th>
                                                            <th class="center"><strong>{{package.ex_night_total_price}}</strong></th>
                                                        </tr>
                                                        <tr v-if="package.ex_site_seeing_qty > 0">
                                                            <th class="center"><strong>Extra Sightseeing</strong></th>
                                                            <th class="center"><strong>{{package.ex_site_seeing_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.ex_site_seeing_note}}</strong></th>
                                                            <th class="center">
                                                                <strong>
                                                                    {{user_type == 'super-admin' ||  user_type == 'admin' || user_type == 'operation'? package.ex_site_seeing_net_price : 'N/A'}}
                                                                </strong>
                                                            </th>
                                                            <th class="center"><strong>{{package.ex_site_seeing_price}}</strong></th>
                                                            <th class="center"><strong>{{package.ex_site_seeing_total_price}}</strong></th>
                                                        </tr>
                                                        <tr v-if="package.airport_rd_qty > 0">
                                                            <th class="center"><strong>Airport Rec&Drop</strong></th>
                                                            <th class="center"><strong>{{package.airport_rd_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.airport_rd_note}}</strong></th>
                                                            <th class="center">
                                                                <strong>
                                                                    {{user_type == 'super-admin' ||  user_type == 'admin' || user_type == 'operation'? package.airport_rd_net_price : 'N/A'}}
                                                                </strong>
                                                            </th>
                                                            <th class="center"><strong>{{package.airport_rd_price}}</strong></th>
                                                            <th class="center"><strong>{{package.airport_rd_total_price}}</strong></th>
                                                        </tr>
                                                        <tr v-if="package.others_qty > 0">
                                                            <th class="center"><strong>Others</strong></th>
                                                            <th class="center"><strong>{{package.others_qty}}</strong></th>
                                                            <th class="center"><strong>{{package.others_note}}</strong></th>
                                                            <th class="center">
                                                                <strong>
                                                                    {{user_type == 'super-admin' ||  user_type == 'admin' || user_type == 'operation'? package.others_net_price : 'N/A'}}
                                                                </strong>
                                                            </th>
                                                            <th class="center"><strong>{{package.others_price}}</strong></th>
                                                            <th class="center"><strong>{{package.others_total_price}}</strong></th>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="5" class="center widget-title">VISA Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Submit to Us</strong></th>
                                                            <th class="center"><strong>Submit to Embassy</strong></th>
                                                            <th class="center"><strong>VISA Done</strong></th>
                                                            <th class="center"><strong>VISA Delivered</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center"><strong>{{package.visa_submit_to_us}}</strong></th>
                                                            <th class="center"><strong>{{package.visa_submit_to_em}}</strong></th>
                                                            <th class="center"><strong>{{package.visa_done_date}}</strong></th>
                                                            <th class="center"><strong>{{package.visa_delivery_to_guest}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="5" class="center widget-title">Ticket Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Travel By</strong></th>
                                                            <th class="center"><strong>Date</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center"><strong>{{package.ticket_type}}</strong></th>
                                                            <th class="center"><strong>{{package.ticket_date}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="5" class="center widget-title">Document Info</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>Document Ready Date</strong></th>
                                                            <th class="center"><strong>Document Delivery Date</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center"><strong>{{package.document_ready_date}}</strong></th>
                                                            <th class="center"><strong>{{package.document_delivery_date}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="4" class="center widget-title">Extra Service</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class="center"><strong>First Qty : {{package.first_qty}}</strong></th>
                                                            <th class="center"><strong>First Price : {{package.first_price}}</strong></th>
                                                            <th class="center"><strong>First Total Price : {{package.first_total_price}}</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center"><strong>Second Qty : {{package.second_qty}}</strong></th>
                                                            <th class="center"><strong>Second Price : {{package.second_price}}</strong></th>
                                                            <th class="center"><strong>Second Total Price : {{package.second_total_price}}</strong></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="center"><strong>Third Qty : {{package.third_qty}}</strong></th>
                                                            <th class="center"><strong>Third Price : {{package.third_price}}</strong></th>
                                                            <th class="center"><strong>Third Total Price : {{package.third_total_price}}</strong></th>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="4" class="center widget-title">
                                                               Extra Note
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="4" class="center widget-title">
                                                                <p style="text-align: justify">{{package.extra_note}}</p>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                    <br/>
                                                    <table class="table  table-bordered table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th colspan="4" class="center widget-title">
                                                                Narration
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="4" class="center widget-title">
                                                                <p style="text-align: justify">{{package.narration}}</p>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                    </table>

                                                </div><!-- /.span -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</template>

<script>
    import GuestAutoComplate from "../searchSelect/GuestAutoComplate";
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "ViewPackageComponent",
        components: {GuestAutoComplate, Loading},
        mounted(){
            this.viewPackage()
        },
        data(){
            return {
                package:'',
                user_type:'super-admin',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
            }
        },
        methods:{
            viewPackage(){
                this.isLoading = true
                axios.get(`/api/view-package/${this.$route.params.id}`)
                    .then((response) => {
                        this.package = response.data.package
                        this.isLoading = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>
