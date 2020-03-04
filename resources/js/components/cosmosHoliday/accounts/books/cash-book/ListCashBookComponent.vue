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
                        Cash Book  List
<!--                        <div class="card-tools" style="float:right">-->
<!--                            <router-link to="/new-payment" class="btn btn-success">Add Payment</router-link>-->
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

                                        <th class="center">Date</th>
                                        <th>Receipt No.</th>
                                        <th>Narration</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
<!--                                        <th>Action</th>-->
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(cash, index) in  cash_books">
                                        <td>{{cash.cash_date | timeformate}}</td>
                                        <td v-if="cash.received_id != null"> M-{{cash.received_id}}</td>
                                        <td v-else-if="cash.payment_id != null"> DV-{{cash.payment_id}}</td>
                                        <td v-else-if="cash.expence_id != null"> Ex-{{cash.expence_id}}</td>
                                        <td v-else-if="cash.incentive_id != null"> In-{{cash.incentive_id}}</td>
                                        <td v-else-if="cash.salary_id != null"> S-{{cash.salary_id}}</td>
                                        <td v-else-if="cash.contra_id != null"> C-{{cash.contra_id}}</td>
                                        <td v-else-if="cash.cheque_id != null"> CQ-{{cash.cheque_id}}</td>
                                        <td v-else-if="cash.payment_loan_id != null"> PL-{{cash.payment_loan_id}}</td>
                                        <td v-else-if="cash.pl_installment_id != null"> PLI-{{cash.pl_installment_id}}</td>
                                        <td v-else-if="cash.received_loan_id != null"> RL-{{cash.received_loan_id}}</td>
                                        <td v-else-if="cash.rl_installment_id != null"> RLI-{{cash.rl_installment_id}}</td>
                                        <td v-else> N/A</td>
                                        <td>{{cash.narration}}</td>
                                        <td>{{cash.debit_cash_amount}}</td>
                                        <td>{{cash.credit_cash_amount}}</td>
                                        <td>{{cash.blance}}</td>
<!--                                        <td class="center">-->
<!--                                            <div class="hidden-sm hidden-xs btn-group">-->

<!--                                                <button class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </button>-->
<!--                                                <router-link :to="`/edit-payment/${cash.id}`" class="btn btn-xs btn-info">-->
<!--                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>-->
<!--                                                </router-link>-->

<!--                                                &lt;!&ndash;                                                <button @click.prevent="deleteGuestTitle(received.id)" class="btn btn-xs btn-danger">&ndash;&gt;-->
<!--                                                &lt;!&ndash;                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>&ndash;&gt;-->
<!--                                                &lt;!&ndash;                                                </button>&ndash;&gt;-->

<!--                                            </div>-->
<!--                                        </td>-->
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getCashBook()"
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
    let sum = 0
    export default {
        name: "ListCashBookComponent",
        components: {
            Loading
        },
        mounted() {
            this.isLoading = true
            this.getCashBook()

        },
        data(){
            return {
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                pagination:{
                    current_page: 1,
                },
                cash_books: '',
            }
        },
        methods:{
            getCashBook(){
                axios.get('/api/get-all-cash-book?page='+this.pagination.current_page)
                    .then(response => {
                        this.cash_books = response.data.cash_books.data
                        this.pagination = response.data.cash_books
                        this.doAjax();
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
            sumdebit(x, y){

                 sum += parseFloat(x - y)
                return sum
            }
        }
    }
</script>

<style scoped>

</style>
