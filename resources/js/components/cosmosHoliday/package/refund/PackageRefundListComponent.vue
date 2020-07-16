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
                        <router-link to="/package-list">Package List</router-link>
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

                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-6"></div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li  class="active" ><a data-toggle="tab" href="#guest_refund">Guest Refund</a></li>
                                    <li ><a data-toggle="tab" href="#suplier_refund">Suplier Refund</a></li>
                                </ul>
                                <div class="tab-content ">

                                    <div id="guest_refund" class="tab-pane fade in active">


                                        <h3>Guest Refund</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Grand Total</th>
                                                        <th  class="center" >Guest Refund</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(gr, index ) in guest_refund">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{gr.guestt.name}}</td>
                                                        <td class="center">{{gr.guestt.phone_number}}</td>
                                                        <td class="center">{{gr.country}}</td>
                                                        <td class="center">{{gr.destination}}</td>
                                                        <td class="center">{{gr.duration}}</td>
                                                        <td class="center">{{gr.grand_total_price}}</td>
                                                        <td class="center">{{gr.guest_refund}}</td>
                                                        <td class="center">
<!--                                                            <div class="btn-group center">-->
<!--                                                                &lt;!&ndash;                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">&ndash;&gt;-->
<!--                                                                &lt;!&ndash;                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>&ndash;&gt;-->
<!--                                                                &lt;!&ndash;                                                                </a>&ndash;&gt;-->
<!--                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/view-package/${gr.id}`" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </router-link>-->
<!--                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-guest-confirmation-date/${gr.id}`" class="btn btn-xs btn-info">-->
<!--                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>-->
<!--                                                                </router-link>-->
<!--                                                                <router-link :to="`/add-package-visa-update-new/${gr.id}`" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#cmts_modal">-->
<!--                                                                    VISA Update-->
<!--                                                                </router-link>-->
<!--                                                                <a  @click.prevent="downLoadInvoice(gr.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">-->
<!--                                                                    Invoice-->
<!--                                                                </a>-->
<!--                                                                <a  href="#" @click.prevent="openModalCollected(gr.id)" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#air_ticket_refound">-->
<!--                                                                    Refund-->
<!--                                                                </a>-->
<!--                                                            </div>-->
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="gr_pagination.last_page > 1"
                                                        :pagination="gr_pagination"
                                                        :offset="5"
                                                        @paginate="getAllGuestRefund()"
                                            ></pagination>
                                        </div>
                                    </div>

                                    <div id="suplier_refund" class="tab-pane fade in">


                                        <h3>Suplier Refund</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Grand Total</th>
                                                        <th  class="center" >Guest Refund</th>
                                                        <th  class="center" >Suplier Refund</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(sr, index ) in suplier_refund">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{sr.guestt.name}}</td>
                                                        <td class="center">{{sr.guestt.phone_number}}</td>
                                                        <td class="center">{{sr.country}}</td>
                                                        <td class="center">{{sr.destination}}</td>
                                                        <td class="center">{{sr.duration}}</td>
                                                        <td class="center">{{sr.grand_total_price}}</td>
                                                        <td class="center">{{sr.guest_refund}}</td>
                                                        <td class="center">{{sr.suplier_refund}}</td>
                                                        <td class="center">
                                                            <!--                                                            <div class="btn-group center">-->
                                                            <!--                                                                &lt;!&ndash;                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">&ndash;&gt;-->
                                                            <!--                                                                &lt;!&ndash;                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>&ndash;&gt;-->
                                                            <!--                                                                &lt;!&ndash;                                                                </a>&ndash;&gt;-->
                                                            <!--                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/view-package/${gr.id}`" class="btn btn-xs btn-success">-->
                                                            <!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                                            <!--                                                                </router-link>-->
                                                            <!--                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-guest-confirmation-date/${gr.id}`" class="btn btn-xs btn-info">-->
                                                            <!--                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>-->
                                                            <!--                                                                </router-link>-->
                                                            <!--                                                                <router-link :to="`/add-package-visa-update-new/${gr.id}`" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#cmts_modal">-->
                                                            <!--                                                                    VISA Update-->
                                                            <!--                                                                </router-link>-->
                                                            <!--                                                                <a  @click.prevent="downLoadInvoice(gr.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">-->
                                                            <!--                                                                    Invoice-->
                                                            <!--                                                                </a>-->
                                                            <!--                                                                <a  href="#" @click.prevent="openModalCollected(gr.id)" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#air_ticket_refound">-->
                                                            <!--                                                                    Refund-->
                                                            <!--                                                                </a>-->
                                                            <!--                                                            </div>-->
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="sr_pagination.last_page > 1"
                                                        :pagination="sr_pagination"
                                                        :offset="5"
                                                        @paginate="getAllSuplierRefund()"
                                            ></pagination>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row --
                        <-- PAGE CONTENT ENDS -->
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
        name: "PackageRefundListComponent",
        components: {
            Loading
        },
        mounted() {
            this.$store.dispatch("allVisaStaff")
            this.getAllGuestRefund();
            this.getAllSuplierRefund();

        },
        computed: {
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                user_type:'',
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                guest_refund: '',
                suplier_refund: '',

                p_state: 1,


                gr_pagination:{
                    current_page: 1,
                },
                sr_pagination:{
                    current_page: 1,
                },




            }
        },
        methods: {

            //All Get Data Start

            getAllGuestRefund(){
                // this.isLoading = true
                axios.get('/api/package-guest-refund?page='+this.gr_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.guest_refund = response.data.guest_refund.data
                        this.gr_pagination = response.data.guest_refund
                        // this.doAjax()

                    })
            },

            getAllSuplierRefund(){
                // this.isLoading = true
                axios.get('/api/package-suplier-refund?page='+this.sr_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.suplier_refund = response.data.suplier_refund.data
                        this.sr_pagination = response.data.suplier_refund
                        // this.doAjax()

                    })
            },


            // All Get Data End

            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },


            // All Post Form End


        }

    }
</script>

<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }
    textarea {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
    }
</style>
