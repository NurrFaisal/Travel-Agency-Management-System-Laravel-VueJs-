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
                        <router-link to="/hotel-booking-list">Hotel Booking List</router-link>
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

                <div class="page-header">
                    <h1>
                        Hotel Booking List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-hotel-booking" class="btn btn-success">New Hotel Booking</router-link>
                        </div>
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
                                        <th class="center">Date</th>
                                        <th class="center">Invoice ID</th>
                                        <th  class="center" >Guest Name</th>
                                        <th  class="center" >Phone Number</th>
                                        <th  class="center" >Customer Name</th>
                                        <th  class="center" >Sell Person</th>

                                        <th  class="center" >Total Price</th>
                                        <th  class="center" >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(hotel_booking, index) in hotel_bookings">
                                        <td class="center">{{index+1}}</td>
                                        <td class="center">{{hotel_booking.created_at | timeformate}}</td>
                                        <td class="center">H-{{hotel_booking.id}}</td>
                                        <td class="center">{{hotel_booking.guest.name}}</td>
                                        <td class="center">{{hotel_booking.guest.phone_number}}</td>
                                        <td class="center">{{hotel_booking.customer_name}}</td>
                                        <td class="center">{{hotel_booking.staff.first_name+' '+hotel_booking.staff.last_name}}</td>
                                        <td class="center">{{hotel_booking.total_price}}</td>
                                        <td class="center">
                                            <div class="btn-group center">
<!--                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </a>-->
                                                <router-link  :to="`/edit-hotel-booking/${hotel_booking.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <!--                                                                <a href="#"  @click.prevent="openPackageQueryModal(doj.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_query_modal">-->
                                                <!--                                                                    Follow Up-->
                                                <!--                                                                </a>-->
                                                <a @click.prevent="downLoadInvoice(hotel_booking.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                    Invoice
                                                </a>
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
                                            @paginate="getHotelBooking()"
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
        name: "ListHostelBookingComponent",
        mounted() {
            this.isLoading = true
            this.getHotelBooking()
        },
        components: {
            Loading
        },
        data(){

            return {
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',

                pagination:{
                    current_page: 1,
                },
                hotel_bookings: '',
            }
        },
        methods:{
            getHotelBooking(){
                axios.get('/api/get-all-hotel-booking?page='+this.pagination.current_page)
                    .then(response => {
                        this.hotel_bookings = response.data.hotel_bookings.data
                        this.pagination = response.data.hotel_bookings
                        this.doAjax();
                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllSearchHotelBooking(this.search_text)
                }else{
                    this.getHotelBooking();
                }
            },1000),
            getAllSearchHotelBooking(search_text){
                axios.get('/api/get-all-hotel-booking-search/'+search_text+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.hotel_bookings = response.data.hotel_bookings.data
                        this.pagination = response.data.hotel_bookings
                        this.isLoading = false
                    })

            },
            downLoadInvoice(id){
                this.isLoading = true
                axios.get('/invoice-print-hotel-count/'+id)
                    .then(responese => {
                        this.downLoadInvoiceCount(id)
                    })
            },
            downLoadInvoiceCount(id){
                this.isLoading = true
                axios.get('/invoice-print-hotel/'+id, {responseType: 'blob'})
                    .then(response => {
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', 'hotel_booking.pdf'); //or any other extension
                        document.body.appendChild(link);
                        link.click();
                        this.doAjax()
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
        }
    }
</script>

<style scoped>

</style>
