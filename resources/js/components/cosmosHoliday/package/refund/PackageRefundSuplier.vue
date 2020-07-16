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
                                        <h5 class="widget-title">Rufund Package with Suplier</h5>

                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="suplierPackageRefund()" class="form-horizontal" method="post" role="form">

                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="refund_date">
                                                                Refund Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.refund_date" :class="{ 'is-invalid': form.errors.has('refund_date') }"   class="col-xs-12 col-sm-12" id="refund_date" name="refund_date"  required type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="refund_date"></has-error>
                                                            <span style="color: red">{{ errors.first('refund_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="grand_total_price">
                                                                Grand Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input readonly disabled v-validate="'required'" v-model="form.grand_total_price" :class="{ 'is-invalid': form.errors.has('grand_total_price') }"   class="col-xs-12 col-sm-12" id="grand_total_price" name="grand_total_price"  required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="grand_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('grand_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="amount">
                                                                Refund Amount <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.amount" :class="{ 'is-invalid': form.errors.has('amount') }"   class="col-xs-12 col-sm-12" id="amount" name="amount" placeholder="Enter Refund Amount" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="amount"></has-error>
                                                            <span style="color: red">{{ errors.first('amount') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div v-for="(employee, index) in form.net_prices" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">

                                                    <div class="form-group ">
                                                        <h4 style="margin-left: 20px;"> Suplier Refund</h4>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="suplier">
                                                                    Suplier<span class="text-danger">*</span> :
                                                                </label>
                                                                <select disabled v-validate="'required'" :class="{ 'is-invalid': form.errors.has('suplier') }" v-model="employee.suplier" id="suplier" name="suplier" required class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Suplier--</option>
                                                                    <option :value="suplier.id" v-for="suplier in supliers " >{{suplier.name}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                                <span style="color: red">{{ errors.first('suplier') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="refund_date">
                                                                    Refund Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  v-validate="'required'" v-model="employee.refund_date" :class="{ 'is-invalid': form.errors.has('refund_date') }"   class="col-xs-12 col-sm-12" id="refund_date" name="refund_date"  required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="refund_date"></has-error>
                                                                <span style="color: red">{{ errors.first('refund_date') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="net_price">
                                                                    Net Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input readonly disabled  v-validate="'required'" v-model="employee.amount" :class="{ 'is-invalid': form.errors.has('net_price') }"   class="col-xs-12 col-sm-12" id="net_price" name="net_price" placeholder="Enter Net Price"  required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="net_price"></has-error>
                                                                <span style="color: red">{{ errors.first('net_price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="refund_amount">
                                                                    Refund Amount<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumNetPrice()"  v-validate="'required'" v-model="employee.refund_amount" :class="{ 'is-invalid': form.errors.has('refund_amount') }"   class="col-xs-12 col-sm-12" id="refund_amount" name="refund_amount" placeholder="Enter Refund Amount"  required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="refund_amount"></has-error>
                                                                <span style="color: red">{{ errors.first('refund_amount') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
<!--                                                    <div style="float: right">-->
<!--                                                        <button class="btnAddNew" @click.prevent="addNewNet()">add</button>-->
<!--                                                    </div>-->
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="suplier_refund">
                                                                Total Suplier Refund<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled readonly v-validate="'required'" v-model="form.suplier_refund" :class="{ 'is-invalid': form.errors.has('suplier_refund') }"   class="col-xs-12 col-sm-12" id="suplier_refund" name="suplier_refund" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="refund_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('refund_amount') }}</span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="clearfix form-actions" v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <button class="btn" type="reset">
                                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                                            Reset
                                                        </button>

                                                        &nbsp; &nbsp; &nbsp;

                                                        <button class="btn btn-info" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Refund
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
    import GuestAutoComplate from "../../searchSelect/GuestAutoComplate";
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "PackageRefundSuplier",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.getAllSuplier()
            axios.get(`/api/edit-package-net-price/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.package_net)
                    this.form.total_net_price = respose.data.package_net.grand_total_net_price
                    this.name = respose.data.package_net.guestt.name;
                    this.phone_number = respose.data.package_net.guestt.phone_number;
                    this.user_type = respose.data.user_type;
                    this.isLoading = false
                })


        },
        computed:{

        },
        data(){
            return {
                name:'',
                phone_number:'',
                user_type:'',

                allReference: '',
                guests:'',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                supliers: '',

                form: new Form({
                    id:'',

                    refund_date:'',
                    grand_total_price:'',
                    amount:'',
                    suplier_refund:'',

                    net_prices: [
                        {
                            suplier:'',
                            refund_date:'',
                            net_price:'',
                            refund_amount:'',

                        }
                    ],

                })
            }
        },
        methods:{
            sumNetPrice(){
                this.form.suplier_refund = 0
                for(let i = 0; i < this.form.net_prices.length; i++){
                    if(this.form.net_prices[i].refund_amount != ''){
                        this.form.suplier_refund += parseInt(this.form.net_prices[i].refund_amount)
                    }
                }
            },

            getAllSuplier(){
                axios.get('/api/get-all-active-suplier')
                    .then(response => {
                        this.supliers = response.data.supliers
                    })
                this.doAjax()

            },
            suplierPackageRefund(){
                this.isLoading = true
                this.form.post('/api/suplier-package-refund')
                    .then((response) => {

                        this.form.id = ''
                        this.form.refund_date = ''
                        this.form.grand_total_price = ''
                        this.form.amount = ''

                            this.form.net_prices = [
                                {
                                    suplier:'',
                                    refund_date:'',
                                    net_price:'',
                                    refund_amount:'',
                                }
                            ]

                        this.$router.push('/package-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'Package Suplier Refund successfully'
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
