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
                                        <h5 class="widget-title">Create New Contra Voucher</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/contra-list" class="btn btn-success">Contra Voucher List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="addContra()" class="form-horizontal" method="post" role="form">

                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="contra_type">
                                                                Contra Type<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input v-model="form.contra_type" id="contra_type" class="ace input-sm"  name="contra_type" type="radio" value="1">
                                                                        <span class="lbl"> Cash To Bank</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input   v-model="form.contra_type" class="ace input-sm" name="contra_type" type="radio" value="2">
                                                                        <span class="lbl"> Bank To Cash</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input   v-model="form.contra_type" class="ace input-sm" name="contra_type" type="radio" value="3">
                                                                        <span class="lbl"> Bank To Bank</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="contra_type"></has-error>
                                                            <span style="color: red">{{ errors.first('contra_type') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                               <div v-if="form.contra_type == 1"  style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                   <h4>Cash To Bank</h4>
                                                   <div class="form-group ">
                                                       <div class="col-md-6">
                                                           <div class="col-xs-12 col-sm-12">
                                                               <label for="contra_date">
                                                                   Contra Date<span class="text-danger">*</span> :
                                                               </label>
                                                               <span class="block input-icon input-icon-right">
                                                                <input v-model="form.contra_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('contra_date') }"   class="col-xs-12 col-sm-12" id="contra_date" name="contra_date" required="" type="date">
                                                            </span>
                                                           </div>
                                                           <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                               <has-error style="color:red" :form="form" field="contra_date"></has-error>
                                                               <span style="color: red">{{ errors.first('contra_date') }}</span>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <div class="col-xs-12 col-sm-12">
                                                               <label for="cash_bank_name">
                                                                   Bank Name<span class="text-danger">*</span> :
                                                               </label>
                                                               <span class="block input-icon input-icon-right">
                                                                <select v-model="form.bank_name" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('bank_name') }" required  id="cash_bank_name" name="bank_name" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Bank Name--</option>
                                                                    <option  :value="bank.id" v-for="bank in get_all_banks " >{{bank.bank_name}}</option>
                                                                </select>
                                                            </span>
                                                           </div>
                                                           <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                               <has-error style="color:red" :form="form" field="bank_name"></has-error>
                                                               <span style="color: red">{{ errors.first('bank_name') }}</span>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="form-group ">
                                                       <div class="col-md-6">
                                                           <div class="col-xs-12 col-sm-12">
                                                               <label for="amount">
                                                                   Amount<span class="text-danger">*</span> :
                                                               </label>
                                                               <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.contra_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('amount') }"   class="col-xs-12 col-sm-12" id="amount" name="amount" placeholder="Enter Contra Amount" required="" type="number">
                                                            </span>
                                                           </div>
                                                           <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                               <has-error style="color:red" :form="form" field="amount"></has-error>
                                                               <span style="color: red">{{ errors.first('amount') }}</span>
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
                                               </div>
                                                <div  v-if="form.contra_type == 2" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Bank To Cash</h4>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="contra_date">
                                                                    Contra Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="form.contra_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('contra_date') }"   class="col-xs-12 col-sm-12" id="contra_date" name="contra_date" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="contra_date"></has-error>
                                                                <span style="color: red">{{ errors.first('contra_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="bank_bank_name">
                                                                    Bank Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <select v-model="form.bank_name" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('bank_name') }" required  id="bank_bank_name" name="bank_name" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Bank Name--</option>
                                                                    <option  :value="bank.id" v-for="bank in get_all_banks " >{{bank.bank_name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="bank_name"></has-error>
                                                                <span style="color: red">{{ errors.first('bank_name') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="amount">
                                                                    Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.contra_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('amount') }"   class="col-xs-12 col-sm-12" id="amount" name="amount" placeholder="Enter Contra Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="amount"></has-error>
                                                                <span style="color: red">{{ errors.first('amount') }}</span>
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
                                                </div>
                                                <div v-if="form.contra_type == 3" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <h4>Bank To Bank</h4>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="from_bank_name">
                                                                    From Bank Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <select v-model="form.from_bank_name" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('from_bank_name') }" required  id="from_bank_name" name="from_bank_name" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Bank Name--</option>
                                                                    <option  :value="bank.id" v-for="bank in get_all_banks " >{{bank.bank_name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="from_bank_name"></has-error>
                                                                <span style="color: red">{{ errors.first('from_bank_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="to_bank_name">
                                                                    To Bank Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <select v-model="form.to_bank_name" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('to_bank_name') }" required  id="to_bank_name" name="to_bank_name" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Bank Name--</option>
                                                                    <option  :value="bank.id" v-for="bank in get_all_banks " >{{bank.bank_name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="to_bank_name"></has-error>
                                                                <span style="color: red">{{ errors.first('to_bank_name') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="contra_date">
                                                                    Contra Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="form.contra_date" v-validate="'required'" :class="{ 'is-invalid': form.errors.has('contra_date') }"   class="col-xs-12 col-sm-12" id="contra_date" name="contra_date" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="contra_date"></has-error>
                                                                <span style="color: red">{{ errors.first('contra_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="amount">
                                                                    Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.contra_amount" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('amount') }"   class="col-xs-12 col-sm-12" id="amount" name="amount" placeholder="Enter Contra Amount" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="amount"></has-error>
                                                                <span style="color: red">{{ errors.first('amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">

                                                        <div class="col-md-12">
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
        name: "NewContraComponent",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch('allBanks')
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


                form: new Form({
                    contra_type:'1',
                    contra_date:'',
                    bank_name:'',
                    from_bank_name:'',
                    to_bank_name:'',
                    contra_amount:'',
                    narration: '',
                })
            }
        },
        methods:{
            addContra(){
                // this.isLoading = true
                this.form.post('/api/add-contra')
                    .then((response) => {
                        console.log(response.data)
                        this.form.contra_type = ''
                        this.form.contra_date = ''
                        this.form.bank_name = ''
                        this.form.contra_amount = ''
                        this.form.narration = ''

                        this.isLoading = false
                        this.$router.push('/contra-list')
                        Toast.fire({
                            type: 'success',
                            title: 'New Contra Voucher Added successfully'
                        })
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
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
