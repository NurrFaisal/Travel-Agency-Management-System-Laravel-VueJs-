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
                                        <h5 class="widget-title">Edit Money Receipt</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/received-list" class="btn btn-success">Money Receipt List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updateReceived()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="guest">
                                                                Guest Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-model="form.guest" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('guest') }" required  id="guest" name="guest" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Guest Name--</option>
                                                                    <option  :value="guest.id" v-for="guest in getAllReference " >{{guest.name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="guest"></has-error>
                                                            <span style="color: red">{{ errors.first('guest') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="staff">
                                                                Staff Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-model="form.staff" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('staff') }" required  id="staff" name="staff" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Staff--</option>
                                                                    <option  :value="staff.id" v-for="staff in get_all_staffs " >{{staff.first_name+' '+staff.last_name}}</option>
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
                                                            <label for="bill_amount">
                                                                Bill Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.id"    required="" type="hidden">
                                                                <input v-model="form.bill_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('bill_amount') }"   class="col-xs-12 col-sm-12" id="bill_amount" name="bill_amount" placeholder="Enter Invoice Bill Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="bill_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('bill_amount') }}</span>
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
                                                                <div class="radio col-md-3">
                                                                    <label>
                                                                        <input @click="cashMark()" v-model="form.cash" id="cash"  class="ace input-sm"  name="cash" type="checkbox" value="1">
                                                                        <span class="lbl"> By Cash</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-3">
                                                                    <label>
                                                                        <input @click="bankMark()"  v-model="form.bank"  id="bank"  class="ace input-sm" name="bank" type="checkbox" value="1">
                                                                        <span class="lbl"> By Bank</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-3">
                                                                    <label>
                                                                        <input @click="chequeMark" v-model="form.cheque" id="cheque"  class="ace input-sm" name="cheque" type="checkbox" value="1">
                                                                        <span class="lbl"> By Cheque</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-3">
                                                                    <label>
                                                                        <input @click="othersMark" v-model="form.other" id="others"  class="ace input-sm" name="other" type="checkbox" value="1">
                                                                        <span class="lbl"> By Others</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="form.cash == 1" id="cashDiv" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Cash Payment Info</h4>
                                                    <div class="form-group ">
                                                        <div class="col-md-12">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="debit_cash_amount">
                                                                    Cash Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPrice()" v-model="form.cashs[0].debit_cash_amount" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('debit_cash_amount') }"   class="col-xs-12 col-sm-12" id="debit_cash_amount" name="debit_cash_amount" placeholder="Enter Cash Payment Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="debit_cash_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('debit_cash_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div  v-if="form.bank == 1" class="bankDiv" v-for="(bank,index) in form.banks"  style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Bank Payment Info</h4>
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteBank(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="bank_name">
                                                                    Bank Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                               <select v-validate="'required'" v-model="bank.bank_name" :class="{ 'is-invalid': form.errors.has('bank_name') }"  id="bank_name" name="bank_name" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Bank--</option>
                                                                    <option :value="bank.id" v-for="bank in get_all_banks " >{{bank.bank_name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="bank_name"></has-error>
                                                                <span style="color: red">{{ errors.first('bank_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="bank_date">
                                                                    Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="bank.bank_date" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('bank_date') }"   class="col-xs-12 col-sm-12" id="bank_date" name="bank_date" placeholder="Enter Bank Amount" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="bank_date"></has-error>
                                                                <span style="color: red">{{ errors.first('bank_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="debit_bank_amount">
                                                                    Bank Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPrice()" v-model="bank.debit_bank_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('debit_bank_amount') }"   class="col-xs-12 col-sm-12" id="debit_bank_amount" name="debit_bank_amount" placeholder="Enter Bank Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="debit_bank_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('debit_bank_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddBank" @click.prevent="addBank()">add</button>
                                                    </div>
                                                </div>
                                                <div  v-if="form.cheque == 1" class="chequeDiv" v-for="(cheque,index) in form.cheques" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Cheque Payment Info</h4>
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteCheque(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="cheque_bank_name">
                                                                    Bank Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                    <input v-model="cheque.cheque_bank_name" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('cheque_bank_name') }"   class="col-xs-12 col-sm-12" id="cheque_bank_name" name="cheque_bank_name" placeholder="Enter Bank Name Here...." required="" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="cheque_bank_name"></has-error>
                                                                <span style="color: red">{{ errors.first('cheque_bank_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="cheque_date">
                                                                    Cheque Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="cheque.cheque_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('cheque_date') }"   class="col-xs-12 col-sm-12" id="cheque_date" name="cheque_date" placeholder="Enter Cheque Date" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="cheque_date"></has-error>
                                                                <span style="color: red">{{ errors.first('cheque_date') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="cheque_type">
                                                                    Cheque Type<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">

                                                                    <select v-validate="'required'" v-model="cheque.cheque_type" :class="{ 'is-invalid': form.errors.has('cheque_type') }"  id="cheque_type" name="cheque_type" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Cheque Type--</option>
                                                                    <option value="1"  >Cash Cheque</option>
                                                                    <option value="2"  >Account Payee Cheque</option>
                                                                </select>
                                                                    <!--                                                                <input v-model="cheque.cheque_type" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('cheque_type') }"   class="col-xs-12 col-sm-12" id="cheque_type" name="cheque_type" placeholder="Enter Cheque Number" required="" type="number">-->
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="cheque_number"></has-error>
                                                                <span style="color: red">{{ errors.first('cheque_number') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="cheque_number">
                                                                    Cheque Number<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="cheque.cheque_number" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('cheque_number') }"   class="col-xs-12 col-sm-12" id="cheque_number" name="cheque_number" placeholder="Enter Cheque Number" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="cheque_number"></has-error>
                                                                <span style="color: red">{{ errors.first('cheque_number') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="cheque_amount">
                                                                    Cheque Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPrice()" v-model="cheque.cheque_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('cheque_amount') }"   class="col-xs-12 col-sm-12" id="cheque_amount" name="cheque_amount" placeholder="Enter Cheque Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="cheque_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('cheque_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNewCheque" @click.prevent="addCheque()">add</button>
                                                    </div>
                                                </div>
                                                <div  v-if="form.other == 1" class="othersDiv" v-for="(other,index) in form.others" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Others Payment Info</h4>
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteOthers(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="others_name">
                                                                    Others Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="other.others_name" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('others_name') }"   class="col-xs-12 col-sm-12" id="others_name" name="others_name" placeholder="Enter Others Name" required="" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="others_name"></has-error>
                                                                <span style="color: red">{{ errors.first('others_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="others_amount">
                                                                    Others Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPrice()" v-model="other.others_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('others_amount') }"   class="col-xs-12 col-sm-12" id="others_amount" name="others_amount" placeholder="Enter Others Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="others_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('others_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNewOthers" @click.prevent="addOthers()">add</button>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_received_amount">
                                                                Total Received Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_received_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('total_received_amount') }"   class="col-xs-12 col-sm-12" id="total_received_amount" name="total_received_amount" placeholder="Enter Total Received Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_received_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('total_received_amount') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="due_amount">
                                                                Due Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.due_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('due_amount') }"   class="col-xs-12 col-sm-12" id="due_amount" name="due_amount" placeholder="Enter Due Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="due_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('due_amount') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="narration">
                                                                Narration <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.narration" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('narration') }"   class="col-xs-12 col-sm-12" id="narration" name="narration" placeholder="Enter Some Narration" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="narration"></has-error>
                                                            <span style="color: red">{{ errors.first('narration') }}</span>
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
    export default {
        name: "EditReceivedComponent",
        mounted(){
            this.$store.dispatch("allGuest")
            this.$store.dispatch('allStaffs')
            this.$store.dispatch('allBanks')
            this.editReceived()
        },
        computed:{
            getAllReference(){
                return this.$store.getters.get_guest
            },

            get_all_staffs(){
                return this.$store.getters.get_staffs
            },
            get_all_banks(){
                return this.$store.getters.get_banks
            }

        },
        data(){

            return {
                form: new Form({
                    id:'',
                    guest:'',
                    staff:'',
                    bill_amount:'',
                    cash:'1',
                    bank:'',
                    cheque:'',
                    other:'',
                    total_received_amount:'',
                    due_amount:'',
                    narration:'',

                    cashs:[
                        {
                            debit_cash_amount:0,
                        }
                    ],

                    banks:[
                        {
                            bank_name:'',
                            bank_date:'',
                            debit_bank_amount:0,
                        }
                    ],
                    cheques:[
                        {
                            cheque_bank_name:'',
                            cheque_type:'',
                            cheque_number:'',
                            cheque_amount:0,
                            cheque_date:'',
                        }
                    ],
                    others:[
                        {
                            others_name:'',
                            others_amount:0,
                        }
                    ]
                })
            }
        },
        methods:{

            cashMark(){
                this.form.cashs = [
                    {
                        debit_cash_amount:0
                    }
                ]
                this.sumPrice()
            },
            bankMark(){
                this.form.banks = [
                    {
                        bank_name:'',
                        bank_date:'',
                        debit_bank_amount:0,
                    }
                ]
                this.sumPrice()
            },
            othersMark(){
                this.form.others = [
                    {
                        others_name:'',
                        others_amount:0,
                    }
                ]
                this.sumPrice()
            },
            chequeMark(){
                this.form.cheques = [
                    {
                        cheque_bank_name:'',
                        cheque_date:'',
                        cheque_type:'',
                        cheque_number:'',
                        cheque_amount:0,
                    }
                ]
                this.sumPrice()
            },
            addBank(){
                if(this.form.banks.length <= 4){
                    this.form.banks.push({
                        bank_name:'',
                        bank_date:'',
                        debit_bank_amount:0,
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
            addCheque(){
                if(this.form.cheques.length <= 4){
                    this.form.cheques.push({
                        cheque_bank_name:'',
                        cheque_date:'',
                        cheque_type:'',
                        cheque_number:'',
                        cheque_amount:0,
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
            addOthers(){
                if(this.form.others.length <= 4){
                    this.form.others.push({
                        others_name:'',
                        others_amount:0,
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
            deleteBank(index){

                this.$delete(this.form.banks, index)
                console.log(this.form.banks)
            },
            deleteCheque(index){

                this.$delete(this.form.cheques, index)
                console.log(this.form.cheques)
            },
            deleteOthers(index){

                this.$delete(this.form.others, index)
                console.log(this.form.others)
            },


            updateReceived(){
                this.form.post('/api/update-received')
                    .then((response) => {
                        this.form.id = ''
                        this.form.guest = ''
                        this.form.staff = ''
                        this.form.bill_amount = ''
                        this.form.cash = ''
                        this.form.bank = ''
                        this.form.cheque = ''
                        this.form.other = ''
                        this.form.total_received_amount = ''
                        this.form.due_amount = ''
                        this.form.narration = ''
                        this.form.cashs = [
                            {
                                debit_cash_amount:0
                            }
                        ]
                        this.form.banks = [
                            {
                                bank_name:'',
                                bank_date:'',
                                debit_bank_amount:0,
                            }
                        ],
                            this.form.cheques = [
                                {
                                    cheque_bank_name:'',
                                    cheque_date:'',
                                    cheque_type:'',
                                    cheque_number:'',
                                    cheque_amount:0,
                                }
                            ]
                        this.form.others = [
                            {
                                others_name:'',
                                others_amount:0,
                            }
                        ]


                        this.$router.push('/received-list')
                        Toast.fire({
                            type: 'success',
                            title: 'New Money Receipt Added successfully'
                        })
                    })
                    .catch((response) => {

                    })
            },
            sumPrice(){
                this.form.due_amount = 0
                this.form.total_received_amount = 0
                if(this.form.cashs[0].debit_cash_amount != ''){
                    this.form.total_received_amount += parseInt(this.form.cashs[0].debit_cash_amount)
                }
                for(let i = 0; i < this.form.banks.length; i++){
                    if(this.form.banks[i].debit_bank_amount != ''){
                        this.form.total_received_amount += parseInt(this.form.banks[i].debit_bank_amount)
                    }
                }
                for(let i = 0; i < this.form.cheques.length; i++){
                    if(this.form.cheques[i].cheque_amount != ''){
                        this.form.total_received_amount += parseInt(this.form.cheques[i].cheque_amount)
                    }
                }
                for(let i = 0; i < this.form.others.length; i++){
                    if(this.form.others[i].others_amount != ''){
                        this.form.total_received_amount += parseInt(this.form.others[i].others_amount)
                    }
                }
                this.form.due_amount = parseInt(this.form.bill_amount) - this.form.total_received_amount

            },

            editReceived(){
                axios.get(`/api/edit-received/${this.$route.params.id}`)
                    .then((respose) => {
                        this.form.fill(respose.data.received)


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