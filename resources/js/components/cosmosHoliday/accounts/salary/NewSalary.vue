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
                                        <h5 class="widget-title">Add New Salary</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/salary-list" class="btn btn-success">Salary List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="addSalary()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="salary_date">
                                                                Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.salary_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('salary_date') }"   class="col-xs-12 col-sm-12" id="salary_date" name="salary_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="salary_date"></has-error>
                                                            <span style="color: red">{{ errors.first('salary_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="staff">
                                                                Staff <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-model="form.staff" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('staff') }" required  id="staff" name="staff" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Staff--</option>
                                                                    <option  :value="staff.id" v-for="staff in staffs " >{{staff.first_name+' '+staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="staff"></has-error>
                                                            <span style="color: red">{{ errors.first('staff') }}</span>
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
                                                            <label for="total_salary_amount">
                                                                Total Salary Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_salary_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('total_salary_amount') }"   class="col-xs-12 col-sm-12" id="total_salary_amount" name="total_salary_amount" placeholder="Total Salary Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_salary_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('total_salary_amount') }}</span>
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
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "NewSalary",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch('allBanks')
            this.getStaff();
            this.doAjax()
        },
        computed:{
            get_all_banks(){
                return this.$store.getters.get_banks
            }

        },
        data(){

            return {
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,


                staffs:'',
                form: new Form({
                    salary_date:'',
                    staff:'',
                    cash:true,
                    bank:false,
                    cheque:false,
                    total_salary_amount:'',
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
            addSalary(){
                this.form.post('/api/add-salary')
                    .then((response) => {
                        this.form.salary_date = ''
                        this.form.staff = ''
                        this.form.cash = ''
                        this.form.bank = ''
                        this.form.cheque = ''
                        this.form.total_salary_amount = ''
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


                        this.$router.push('/salary-list')
                        Toast.fire({
                            type: 'success',
                            title: 'New Salary Added successfully'
                        })
                    })
                    .catch((response) => {

                    })
            },
            sumPrice(){
                this.form.due_amount = 0
                this.form.total_salary_amount = 0
                if(this.form.cash == true) {
                    if (this.form.cashs[0].credit_cash_amount != '') {
                        this.form.total_salary_amount += parseInt(this.form.cashs[0].credit_cash_amount)
                    }
                }

                for(let i = 0; i < this.form.cheques.length; i++){
                    if(this.form.cheques[i].credit_bank_amount != ''){
                        this.form.total_salary_amount += parseInt(this.form.cheques[i].credit_bank_amount)
                    }
                }


            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
            },
            getStaff(){
                axios.get('/api/get-salary-staff')
                    .then(response => {
                        this.staffs = response.data.staffs
                    })
            },
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
