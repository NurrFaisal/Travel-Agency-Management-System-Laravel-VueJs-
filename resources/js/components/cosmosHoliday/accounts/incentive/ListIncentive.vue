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
                        <router-link to="/incentive-list">Incentive List</router-link>
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
                        Incentive List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-incentive" class="btn btn-success">Add Incentive</router-link>
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
                                        <th>Name</th>
                                        <th>Payment</th>
                                        <th>Narration</th>
                                        <th>Amount</th>
                                        <th>Received By</th>
                                        <th>Paid By</th>
                                        <th>Approved By</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(incentive , index) in  incentives">
                                        <td class="center">{{index+1}}</td>
                                        <td>{{incentive.incentive_date | timeformate}}</td>
                                        <td>{{incentive.stafft.first_name+' '+incentive.stafft.last_name}}</td>
                                        <td v-if="incentive.cash == 1 && incentive.cheque == 1">Cash/Cheque</td>
                                        <td v-else-if="incentive.cash == 1">Cash</td>
                                        <td v-else-if="incentive.cheque == 1">Cheque</td>
                                        <td>{{incentive.narration}}</td>
                                        <td>{{incentive.total_incentive_amount}}</td>
                                        <td>{{incentive.received_by}}</td>
                                        <td>{{incentive.paid_by}}</td>
                                        <td>{{incentive.approved_by}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <!--                                                <router-link :to="`/installment/${expence.id}`" class="btn btn-xs btn-success">-->
                                                <!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                                <!--                                                </router-link>-->
                                                <router-link :to="`/edit-incentive/${incentive.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <a @click.prevent="downLoadInvoice(incentive.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                    Voucher
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
                                            @paginate="getIncentive()"
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
        name: "ListIncentive",
        mounted() {
            this.isLoading = true
            this.getIncentive()
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
                incentives: '',
            }
        },
        methods:{
            getIncentive(){
                axios.get('/api/get-all-incentives?page='+this.pagination.current_page)
                    .then(response => {
                        this.incentives = response.data.incentives.data
                        this.pagination = response.data.incentives
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
                axios.get('/invoice-print-incentive/'+id)
                    .then(responese => {
                        this.doAjax()
                    })
            }
        }
    }
</script>

<style scoped>

</style>
