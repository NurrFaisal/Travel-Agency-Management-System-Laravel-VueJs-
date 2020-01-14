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
                        <router-link to="/new-package">New Package</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->
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
                                        <h5 class="widget-title">Package Net Price</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/air-ticket-list" class="btn btn-success">Air Ticket List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="addNetPrice()" class="form-horizontal" method="post" role="form">
                                                <div v-for="(employee, index) in form.netPrices" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteEmpolyee(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <h4 style="margin-left: 20px;"> Suplier Net Price Information</h4>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="suplier">
                                                                    Suplier<span class="text-danger">*</span> :
                                                                </label>
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('suplier') }" v-model="employee.suplier" id="suplier" name="suplier" required class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Suplier--</option>
                                                                    <option :value="suplier.id" v-for="suplier in supliers " >{{suplier.name}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                                <span style="color: red">{{ errors.first('suplier') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="net_price">
                                                                    Net Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="sumNetPrice()" v-validate="'required'" v-model="employee.net_price" :class="{ 'is-invalid': form.errors.has('net_price') }"   class="col-xs-12 col-sm-12" id="net_price" name="net_price" placeholder="Enter Net Price"  required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="net_price"></has-error>
                                                                <span style="color: red">{{ errors.first('net_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNew" @click.prevent="addNew()">add</button>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <div class="col-md-6" style="float: right">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_net_price">
                                                                Total Net Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.total_net_price" :class="{ 'is-invalid': form.errors.has('total_net_price') }"   class="col-xs-12 col-sm-12" id="total_net_price" name="total_net_price" placeholder="Enter Total Net Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_net_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_net_price') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="clearfix form-actions" >
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
        name: "AddNetPrice",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.getAllSuplier()
            // this.doAjax()

        },
        computed:{

        },
        data(){

            return {
                supliers: '',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    netPrices: [
                        {
                            suplier:'',
                            net_price:'',

                        }
                    ],
                    total_net_price:0,
                    id:this.$route.params.id,
                })
            }
        },
        methods:{
            addNew(){
                if(this.form.netPrices.length <= 4){
                    this.form.netPrices.push({
                        suplier:'',
                        net_price:'',
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

            deleteEmpolyee(index){
                this.$delete(this.form.netPrices, index)
            },
            addNetPrice(){
                this.isLoading = true
                this.form.post('/api/add-package-net-price')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',7)
                        this.form.id = ''
                        this.form.total_net_price = ''
                        this.form.netPrices = [
                            {
                                net_price:'',
                                suplier:'',
                            }
                        ],

                            this.$router.push('/package-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'Net Price Added successfully'
                        })
                    })
                    .catch((response) => {
                        this.isLoading = false
                    })
            },

            sumNetPrice(){
                this.form.total_net_price = 0
                for(let i = 0; i < this.form.netPrices.length; i++){
                    if(this.form.netPrices[i].net_price != ''){
                        this.form.total_net_price += parseInt(this.form.netPrices[i].net_price)
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
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
            },
            onCancel() {
                console.log('User cancelled the loader.')
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
