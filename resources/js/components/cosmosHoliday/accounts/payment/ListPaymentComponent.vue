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
                        <router-link to="/payment-list">Payment List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Payment List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-payment" class="btn btn-success">Add Payment</router-link>
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
                                        <th class="center">DV No.</th>
                                        <th>Suplier Name</th>
                                        <th>Phone Number</th>
                                        <th>Narration Name</th>
                                        <th>Received By</th>
                                        <th>Paid By</th>
                                        <th>Approved By</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(payment, index) in  payments">
                                        <td class="center">{{index+1}}</td>
                                        <td>{{payment.debit_voucher_date | timeformate}}</td>
                                        <td>DV-{{payment.id}}</td>
                                        <td>{{payment.supliert.name}}</td>
                                        <td>{{payment.supliert.phone_number}}</td>
                                        <td>{{payment.narration.substring(0,25)+"...."}}</td>
                                        <td>{{payment.received_by}}</td>
                                        <td>{{payment.paid_by}}</td>
                                        <td>{{payment.approved_by}}</td>
                                        <td>{{payment.total_payment_amount}}</td>

                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </button>
                                                <router-link :to="`/edit-payment/${payment.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <a @click.prevent="downLoadInvoice(payment.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                    Voucher
                                                </a>

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
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getPayment()"
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
        name: "ListPaymentComponent",
        mounted() {
            this.isLoading = true
            this.getPayment()
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
                pagination:{
                    current_page: 1,
                },
                payments: '',
            }
        },
        methods:{
            getPayment(){
                axios.get('/api/get-all-payment?page='+this.pagination.current_page)
                    .then(response => {
                        this.payments = response.data.payments.data
                        this.pagination = response.data.payments
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
            downLoadInvoice(id){
                this.isLoading = true
                axios.get('/invoice-print-debit-voucher/'+id)
                    .then(responese => {
                        this.doAjax()
                    })
            }
        }
    }
</script>

<style scoped>

</style>
