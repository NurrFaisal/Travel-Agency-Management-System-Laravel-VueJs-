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
                        <router-link to="/payment-loan-installment-list"><strong>Payment Loan Installment List</strong></router-link>
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
                        Payment Loan Installment List
                        <div class="card-tools" style="float:right">
                            <router-link :to="`/new-payment-loan-installment`" class="btn btn-success">Add Installment</router-link>
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
                                        <th>Installment By</th>
                                        <th>Narration</th>
                                        <th>Received Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(installment, index) in  installments">
                                        <td class="center">{{index+1}}</td>
                                        <td>{{installment.pl_installment_date | timeformate}}</td>
                                        <td>{{installment.cash == 1 ? 'Cash-' : ''}}{{installment.cheque == 1 ? 'Cheque' : ''}}</td>
                                        <td>{{installment.narration}}</td>
                                        <td>{{installment.total_payment_loan_installment_amount}}</td>

                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <router-link :to="`/edit-payment-loan-installment/${installment.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

<!--                                                <a @click.prevent="downLoadInvoice(installment.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">-->
<!--                                                    Receipt-->
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
                                            @paginate="getPLInstallment()"
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
        name: "ListPaymentInstallment",
        mounted() {
            this.isLoading = true
            this.getPLInstallment()
            this.doAjax()
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
                installments: '',
            }
        },
        methods:{
            getPLInstallment(){
                axios.get('/api/get-all-payment-loan-installment?page='+this.pagination.current_page)
                    .then(response => {
                        this.installments = response.data.installments.data
                        this.pagination = response.data.installments
                        this.doAjax();
                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllSearchPLInstallment(this.search_text)
                }else{
                    this.getPLInstallment();
                }
            },1000),
            getAllSearchPLInstallment(search_text){
                axios.get('/api/get-all-pl-installment-search/'+search_text+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.installments = response.data.installments.data
                        this.pagination = response.data.installments
                        this.isLoading = false
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
                axios.get('/invoice-print-money-receipt/'+id)
                    .then(responese => {
                        this.doAjax()
                    })
            }
        }
    }
</script>

<style scoped>

</style>
