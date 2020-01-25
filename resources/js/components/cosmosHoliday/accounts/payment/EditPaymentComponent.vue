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
                                        <h5 class="widget-title">Edit Debit Voucher</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/payment-list" class="btn btn-success">Debit Voucher List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updatePayment()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="debit_voucher_date">
                                                                Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.debit_voucher_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('debit_voucher_date') }"   class="col-xs-12 col-sm-12" id="debit_voucher_date" name="debit_voucher_date" required="" type="date">
                                                                <input v-model="form.id" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('id') }"   class="col-xs-12 col-sm-12" id="id" name="id" required="" type="hidden">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="debit_voucher_date"></has-error>
                                                            <span style="color: red">{{ errors.first('debit_voucher_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="suplier">
                                                                Suplier Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-model="form.suplier" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('suplier') }" required  id="suplier" name="suplier" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Suplier Name--</option>
                                                                    <option  :value="suplier.id" v-for="suplier in supliers " >{{suplier.name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                            <span style="color: red">{{ errors.first('suplier') }}</span>
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
                                                <div  v-show="form.cash == 1"id="cashDiv" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
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

                                                <div v-show="form.cheque == 1" class="chequeDiv" v-for="(cheque,index) in form.cheques" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
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
                                                                <select v-validate="'required'" v-model="cheque.bank_name" :class="{ 'is-invalid': form.errors.has('bank_name') }"  id="bank_name" name="bank_name" class="col-xs-12 col-sm-12" >
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
                                                                <input @keyup="sumPrice()" v-model="cheque.credit_bank_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('credit_bank_amount') }"   class="col-xs-12 col-sm-12" id="credit_bank_amount" name="credit_bank_amount" placeholder="Enter Bank Cheque Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="credit_bank_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('credit_bank_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNewCheque" @click.prevent="addCheque()">add</button>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_payment_amount">
                                                                Total Payment Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_payment_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('total_payment_amount') }"   class="col-xs-12 col-sm-12" id="total_payment_amount" name="total_payment_amount" placeholder="Enter Total Payment Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_payment_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('total_payment_amount') }}</span>
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
        name: "EditPaymentComponent",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.getAllSuplier()
            this.$store.dispatch('allBanks')
            this.editPayment()
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
                    debit_voucher_date:'',
                    suplier:'',
                    cash:'1',
                    cheque:'',
                    total_payment_amount:'',
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
                if($('#cash').prop('checked') == true){
                    $('#cashDiv').show()
                }else{
                    $('#cashDiv').hide()
                }

            },
            chequeDivFunction(){
                if($('#cheque').prop('checked') == true){
                    $('.chequeDiv').show()
                }else{
                    $('.chequeDiv').hide()
                }
            },
            //Checked Unchecked End
            addCheque(){
                if(this.form.cheques.length <= 4){
                    this.form.cheques.push({
                        bank_name:'',
                        bank_date:'',
                        bank_cheque_number:'',
                        credit_bank_amount:'',
                    })
                }else{
                    // $('.btnAddNew').hide()
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>You are not allowed to add more than 5..</a>'
                    })
                }
            },
            deleteCheque(index){

                this.$delete(this.form.cheques, index)
                console.log(this.form.cheques)
            },
            updatePayment(){
                this.form.post('/api/update-payment')
                    .then((response) => {
                        this.form.debit_voucher_date = ''
                        this.form.suplier = ''
                        this.form.cash = ''
                        this.form.cheque = ''
                        this.form.total_payment_amount = ''
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



                        this.$router.push('/payment-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Debit Voucher updated successfully'
                        })
                    })
                    .catch((response) => {

                    })
            },
            getAllSuplier(){
                axios.get('/api/get-all-active-suplier')
                    .then(response => {
                        this.supliers = response.data.supliers
                    })
                this.doAjax()

            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
            },




            sumPrice(){
                this.form.due_amount = 0
                this.form.total_payment_amount = 0
                if(this.form.cashs[0].credit_cash_amount != ''){
                    this.form.total_payment_amount += parseInt(this.form.cashs[0].credit_cash_amount)
                }

                for(let i = 0; i < this.form.cheques.length; i++){
                    if(this.form.cheques[i].credit_bank_amount != ''){
                        this.form.total_payment_amount += parseInt(this.form.cheques[i].credit_bank_amount)
                    }
                }

            },
            editPayment(){
                axios.get(`/api/edit-payment/${this.$route.params.id}`)
                    .then((respose) => {
                        this.form.fill(respose.data.payment)


                    })
            },
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
