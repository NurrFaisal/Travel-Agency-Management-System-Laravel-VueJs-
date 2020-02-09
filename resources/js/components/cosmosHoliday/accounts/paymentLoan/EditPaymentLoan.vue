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
                                        <h5 class="widget-title">Edit Payment Loan</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link :to="`/payment-loan-list`" class="btn btn-success">Payment Loan List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updatePaymentLoan()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="pl_date">
                                                                Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.pl_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('pl_date') }"   class="col-xs-12 col-sm-12" id="pl_date" name="pl_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="pl_date"></has-error>
                                                            <span style="color: red">{{ errors.first('pl_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="pl_name">
                                                                Payment Loan Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.pl_name" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('pl_name') }"   class="col-xs-12 col-sm-12" id="pl_name" name="pl_name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="pl_name"></has-error>
                                                            <span style="color: red">{{ errors.first('pl_name') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label>
                                                                Payment Mode<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.cash" id="cash" @click="cashDivFunction()"  class="ace input-sm"  name="cash" type="checkbox" value="1">
                                                                        <span class="lbl"> By Cash</span>
                                                                    </label>
                                                                </div>

                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.cheque" id="cheque" @click="chequeDivFunction()" class="ace input-sm" name="cheque" type="checkbox" value="1">
                                                                        <span class="lbl"> By Cheque</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="form.cash == 1"  style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Cash Payment Info</h4>
                                                    <div class="form-group ">
                                                        <div class="col-md-12">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="credit_cash_amount">
                                                                    Cash Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPrice()" v-model="form.cashs[0].credit_cash_amount" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('credit_cash_amount') }"   class="col-xs-12 col-sm-12" id="credit_cash_amount" name="credit_cash_amount" placeholder="Enter Cash Payment Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="credit_cash_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('credit_cash_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-if="form.cheque == 1"  v-for="(cheque,index) in form.cheques" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Cheque Payment Info (Bank)</h4>
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteCheque(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="bank_name">
                                                                    Bank Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <select v-validate="'required'" v-model="cheque.bank_name" :class="{ 'is-invalid': form.errors.has('bank_name') }" required  id="bank_name" name="bank_name" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Bank--</option>
                                                                    <option :value="bank.id" v-for="bank in get_all_banks " >{{bank.bank_name}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="bank_name"></has-error>
                                                                <span style="color: red">{{ errors.first('bank_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="bank_date">
                                                                    Cheque Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="cheque.bank_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('bank_date') }"   class="col-xs-12 col-sm-12" id="bank_date" name="bank_date" placeholder="Enter Cheque Date" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="bank_date"></has-error>
                                                                <span style="color: red">{{ errors.first('bank_date') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">

                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="bank_cheque_number">
                                                                    Cheque Number<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="cheque.bank_cheque_number" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('bank_cheque_number') }"   class="col-xs-12 col-sm-12" id="bank_cheque_number" name="bank_cheque_number" placeholder="Enter Bank Cheque Number" required="" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="bank_cheque_number"></has-error>
                                                                <span style="color: red">{{ errors.first('bank_cheque_number') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="credit_bank_amount">
                                                                    Cheque Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="sumPrice()" v-model="cheque.credit_bank_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('credit_bank_amount') }"   class="col-xs-12 col-sm-12" id="credit_bank_amount" name="credit_bank_amount" placeholder="Enter Bank Cheque Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="credit_bank_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('credit_bank_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_payment_loan_amount">
                                                                Total Payment Loan Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_payment_loan_amount" v-validate="'required'" required :class="{ 'is-invalid': form.errors.has('total_payment_loan_amount') }"   class="col-xs-12 col-sm-12" id="total_payment_loan_amount" name="total_payment_loan_amount"  required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_payment_loan_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('total_payment_loan_amount') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="narration">
                                                                Narration<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.narration" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('narration') }"   class="col-xs-12 col-sm-12" id="narration" name="narration" placeholder="Enter Some Narration" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="narration"></has-error>
                                                            <span style="color: red">{{ errors.first('narration') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="received_by">
                                                                Received By <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.received_by" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('received_by') }"   class="col-xs-12 col-sm-12" id="received_by" name="received_by" placeholder="Enter Received By Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="received_by"></has-error>
                                                            <span style="color: red">{{ errors.first('received_by') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="paid_by">
                                                                Paid By <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.paid_by" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('paid_by') }"   class="col-xs-12 col-sm-12" id="paid_by" name="paid_by" placeholder="Enter Paid By Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="paid_by"></has-error>
                                                            <span style="color: red">{{ errors.first('paid_by') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="approved_by">
                                                                Approved By <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.approved_by" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('approved_by') }"   class="col-xs-12 col-sm-12" id="approved_by" name="approved_by" placeholder="Enter Approved By Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="approved_by"></has-error>
                                                            <span style="color: red">{{ errors.first('approved_by') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <button class="btn" type="reset">
                                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                                            Reset
                                                        </button>

                                                        &nbsp; &nbsp; &nbsp;

                                                        <button class="btn btn-info" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
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
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "EditPaymentLoan",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.getPaymentLoan()
            this.$store.dispatch('allBanks')
            this.isLoading = false
        },
        computed:{
            get_all_banks(){
                return this.$store.getters.get_banks
            }
        },
        data(){

            return {
                supliers: '',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    id:'',
                    pl_date:'',
                    pl_name:'',
                    cash:'1',
                    cheque:'',
                    total_payment_loan_amount:'',
                    narration:'',
                    received_by:'',
                    paid_by:'',
                    approved_by:'',
                    cashs:[
                        {
                            credit_cash_amount:'',
                        }
                    ],

                    cheques:[
                        {
                            bank_name:'',
                            bank_date:'',
                            bank_cheque_number:'',
                            credit_bank_amount:'',
                        }
                    ],

                })
            }
        },
        methods:{

            //Checked Unchecked Start
            cashDivFunction(){
                this.form.cashs = [
                    {
                        credit_cash_amount:''
                    }
                ]
                this.sumPrice()

            },
            chequeDivFunction(){
                this.form.cheques = [
                    {
                        bank_name:'',
                        bank_date:'',
                        bank_cheque_number:'',
                        credit_bank_amount:'',
                    }
                ]
                this.sumPrice()
            },
            //Checked Unchecked End
            getPaymentLoan(){
                axios.get(`/api/edit-payment-loan/${this.$route.params.id}`)
                    .then(response => {
                        this.form.fill(response.data.payment_loan)
                        this.doAjax();
                    })
            },
            updatePaymentLoan(){
                this.isLoading = true
                this.form.post('/api/update-payment-loan')
                    .then((response) => {
                        this.form.id = ''
                        this.form.pl_date = ''
                        this.form.pl_name = ''
                        this.form.cash = ''
                        this.form.cheque = ''
                        this.form.total_payment_loan_amount = ''
                        this.form.narration = ''
                        this.form.received_by = ''
                        this.form.paid_by = ''
                        this.form.approved_by = ''
                        this.form.cashs = [
                            {
                                credit_cash_amount:''
                            }
                        ]
                        this.form.cheques = [
                            {
                                bank_name:'',
                                bank_date:'',
                                bank_cheque_number:'',
                                credit_bank_amount:'',
                            }
                        ]
                        this.$router.push('/payment-loan-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'New Payment Loan Added successfully'
                        })
                    })
                    .catch((response) => {
                        this.isLoading = false
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
            },
            onCancel() {
                console.log('User cancelled the loader.')
            },
            sumPrice(){
                this.form.total_payment_loan_amount = 0
                if(this.form.cashs[0].credit_cash_amount != ''){
                    this.form.total_payment_loan_amount += parseInt(this.form.cashs[0].credit_cash_amount)
                }
                for(let i = 0; i < this.form.cheques.length; i++){
                    if(this.form.cheques[i].credit_bank_amount != ''){
                        this.form.total_payment_loan_amount += parseInt(this.form.cheques[i].credit_bank_amount)
                    }
                }

            }
        }
    }
</script>

<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
        height: 25px !important;
        border-radius: 4px !important;
    }
    textarea {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
        height: 25px !important;
        font-size: 11px;
        border-radius: 4px !important;
    }
    .chosen-single{
        backgrond:red!important;

    }
    .chosen-container-single{
        width:100%!important;
    }
</style>
