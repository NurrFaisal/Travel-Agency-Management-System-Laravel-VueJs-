<template>
    <div>
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
                                        <h5 class="widget-title">Add New Expence</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/expence-list" class="btn btn-success">Expence List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="addExpence()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="debit_voucher_date">
                                                                Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.expence_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('expence_date') }"   class="col-xs-12 col-sm-12" id="debit_voucher_date" name="expence_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="expence_date"></has-error>
                                                            <span style="color: red">{{ errors.first('expence_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="expence_head">
                                                                Expence Head<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-model="form.expence_head" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('expence_head') }" required  id="expence_head" name="expence_head" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Expence Head--</option>
                                                                    <option  :value="expence_head.id" v-for="expence_head in expence_heads " >{{expence_head.name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="expence_head"></has-error>
                                                            <span style="color: red">{{ errors.first('expence_head') }}</span>
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
                                                                        <input v-model="form.cash" id="cash"  class="ace input-sm"  name="cash" type="checkbox" value="1">
                                                                        <span class="lbl"> By Cash</span>
                                                                    </label>
                                                                </div>

                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.cheque" id="cheque" class="ace input-sm" name="cheque" type="checkbox" value="1">
                                                                        <span class="lbl"> By Cheque</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="form.cash"  style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
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

                                                <div v-if="form.cheque" v-for="(cheque,index) in form.cheques" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Cheque Payment Info (Bank)</h4>
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
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_expence_amount">
                                                                Total Expence Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_expence_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('total_expence_amount') }"   class="col-xs-12 col-sm-12" id="total_expence_amount" name="total_expence_amount" placeholder="Enter Total Expence Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_expence_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('total_expence_amount') }}</span>
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
                                                            Submit
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
    export default {
        name: "NewExpence",
        mounted(){
            this.$store.dispatch('allBanks')
            this.getExpenceHead();
        },
        computed:{
            get_all_banks(){
                return this.$store.getters.get_banks
            }

        },
        data(){

            return {
                expence_heads:'',
                form: new Form({
                    expence_date:'',
                    expence_head:'',
                    cash:true,
                    cheque:false,
                    total_expence_amount:'',
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
            //Checked Unchecked End
            addExpence(){
                this.form.post('/api/add-expence')
                    .then((response) => {
                        this.form.expence_date = ''
                        this.form.expence_head = ''
                        this.form.cash = ''
                        this.form.cheque = ''
                        this.form.total_expence_amount = ''
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


                        this.$router.push('/expence-list')
                        Toast.fire({
                            type: 'success',
                            title: 'New Expence Added successfully'
                        })
                    })
                    .catch((response) => {

                    })
            },
            sumPrice(){
                this.form.due_amount = 0
                this.form.total_expence_amount = 0
                if(this.form.cashs[0].credit_cash_amount != ''){
                    this.form.total_expence_amount += parseInt(this.form.cashs[0].credit_cash_amount)
                }

                for(let i = 0; i < this.form.cheques.length; i++){
                    if(this.form.cheques[i].credit_bank_amount != ''){
                        this.form.total_expence_amount += parseInt(this.form.cheques[i].credit_bank_amount)
                    }
                }

            },
            getExpenceHead(){
                axios.get('/api/get-expence-head')
                    .then(response => {
                        this.expence_heads = response.data.expence_heads
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