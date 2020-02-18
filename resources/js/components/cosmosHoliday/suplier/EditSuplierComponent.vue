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
                        <router-link to="/new-suplier">New Suplier</router-link>
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
                                        <h5 class="widget-title">Update Suplier</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/suplier-list" class="btn btn-success">Guest List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updateSuplier()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="name">
                                                                Name <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-12" id="name" name="name" required="" type="text" placeholder="Enter Suplier Name">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="name"></has-error>
                                                            <span style="color: red">{{ errors.first('name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="contact_person">
                                                                Contact Person <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.contact_person" :class="{ 'is-invalid': form.errors.has('contact_person') }"   class="col-xs-12 col-sm-12" id="contact_person" name="contact_person" required="" type="text" placeholder="Enter Contact Person Name">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="contact_person"></has-error>
                                                            <span style="color: red">{{ errors.first('contact_person') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="phone_number">
                                                                Phone Number <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.phone_number" id="phone_number" name="phone_number" placeholder="Enter Phone Number"  class="col-xs-12 col-sm-12" required="" type="number" >
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="email_address">
                                                                Email Address <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.email_address" :class="{ 'is-invalid': form.errors.has('email_address') }"   class="col-xs-12 col-sm-12" id="email_address" name="email_address" required="" type="email" placeholder="Enter Eamil Address">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="email_address"></has-error>
                                                            <span style="color: red">{{ errors.first('email_address') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="country">
                                                                Country <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select :class="{ 'is-invalid': form.errors.has('country') }" class="col-xs-12" id="country"
                                                                       name="country" required
                                                                       v-model="form.country"
                                                                       v-validate="'required'">
                                                                <option value="">--Select Country--</option>
                                                                <option :value="country.id" v-for="country in getAllVisaCountry">{{country.name}}</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="country"></has-error>
                                                            <span style="color: red">{{ errors.first('country') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="product">
                                                                Product <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.product" id="product" name="product" placeholder="Enter Suplier Product Name"  class="col-xs-12 col-sm-12" required="" type="text" >
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="product"></has-error>
                                                            <span style="color: red">{{ errors.first('product') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="this.user_type == 'super-admin'" class="clearfix form-actions">
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
        name: "EditSuplierComponent",
        components: {Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch("allVisaCountry")
            axios.get(`/api/edit-suplier/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.suplier)
                    this.user_type = respose.data.user_type
                })
            this.doAjax()
        },
        computed: {
            getAllVisaCountry(){
                return this.$store.getters.get_visa_country
            },
        },
        data() {
            return {
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                user_type:'',

                form: new Form({
                    id: '',
                    name: '',
                    contact_person: '',
                    phone_number: '',
                    email_address: '',
                    country: '',
                    product: '',
                })
            }
        },
        methods:{
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
            },
            updateSuplier() {
                this.isLoading = true
                this.form.post('/api/update-suplier')
                    .then((response) => {
                        this.doAjax()
                        this.form.name = ''
                        this.form.contact_person = ''
                        this.form.phone_number = ''
                        this.form.email_address = ''
                        this.form.country = ''
                        this.form.product = ''
                        this.$router.push('/suplier-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Suplier Updated successfully'
                        })
                    })
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
