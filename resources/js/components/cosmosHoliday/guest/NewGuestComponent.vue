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
                        <router-link to="/new-guest">New Guest</router-link>
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
                                        <h5 class="widget-title">Create new Guest</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/guest-list" class="btn btn-success">Guest List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="addGuest()" class="form-horizontal" method="post" role="form">

                                                <div class="form-group">

                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="branch">
                                                                Branch :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.branch" id="branch" class="ace input-sm" checked name="branch" type="radio" value="1">
                                                                        <span class="lbl"> Dhanmondi</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.branch" class="ace input-sm" name="branch" type="radio" value="2">
                                                                        <span class="lbl"> Banani</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="branch"></has-error>
                                                            <span style="color: red">{{ errors.first('branch') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="name">
                                                                Name <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-12" id="name" name="name" required="" type="text" placeholder="Enter Guest Name..">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="name"></has-error>
                                                            <span style="color: red">{{ errors.first('name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="guest_type">
                                                                Guest Type <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select :class="{ 'is-invalid': form.errors.has('guest_type') }" class="col-xs-12" id="guest_type"
                                                                       name="guest_type" required
                                                                       v-model="form.guest_type"
                                                                       v-validate="'required'">
                                                                <option value="">--Select Guest Type--</option>
                                                                <option :value="guest_type.id" v-for="guest_type in getAllGuestTitle">{{guest_type.guest_title}}</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="guest_type"></has-error>
                                                            <span style="color: red">{{ errors.first('guest_type') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="designation">
                                                                Designation <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select :class="{ 'is-invalid': form.errors.has('designation') }" class="col-xs-12" id="designation"
                                                                       name="designation" required
                                                                       v-model="form.designation"
                                                                       v-validate="'required'">
                                                                <option value="">--Select Designation Type--</option>
                                                                <option :value="designation.id" v-for="designation in getAllGuestDesignation">{{designation.guest_designation}}</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="designation"></has-error>
                                                            <span style="color: red">{{ errors.first('designation') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="rf_staff">
                                                                Refence Staff <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select :class="{ 'is-invalid': form.errors.has('rf_staff') }" class="col-xs-12" id="rf_staff"
                                                                       name="rf_staff" required
                                                                       v-model="form.rf_staff"
                                                                       v-validate="'required'">
                                                                <option value="">--Select Ref Staff--</option>
                                                                <option :value="rf_staff.id" v-for="rf_staff in getAllStaffs">{{rf_staff.first_name+' '+rf_staff.last_name}}</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="rf_staff"></has-error>
                                                            <span style="color: red">{{ errors.first('rf_staff') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="rf_guest">
                                                                Refence Guest <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.rf_guest" :class="{ 'is-invalid': form.errors.has('rf_guest') }"   class="col-xs-12 col-sm-12" id="rf_guest" name="rf_guest" required="" type="text" placeholder="Enter Ref Guest Name">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="rf_guest"></has-error>
                                                            <span style="color: red">{{ errors.first('rf_guest') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
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
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="alt_email_address">
                                                                Alt.Email Address <span class="text-danger"></span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.alt_email_address" id="alt_email_address" name="alt_email_address" placeholder="Enter Alt. Email Address"  class="col-xs-12 col-sm-12"  type="email" >
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="alt_email_address"></has-error>
                                                            <span style="color: red">{{ errors.first('alt_email_address') }}</span>
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
                                                                <input v-validate="'required'" v-model="form.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }"   class="col-xs-12 col-sm-12" id="phone_number" name="phone_number" required="" type="number" placeholder="Enter Phone Number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="alt_phone_number">
                                                                Alt.Phone Number <span class="text-danger"></span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.alt_phone_number" id="alt_phone_number" name="alt_phone_number" placeholder="Enter Alt.Phone Number"  class="col-xs-12 col-sm-12" type="number" >
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="alt_phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('alt_phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-8">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="address">
                                                                Address <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }"   class="col-xs-12 col-sm-12" id="address" name="address" required="" type="text" placeholder="Enter Guest Full Address...">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="address"></has-error>
                                                            <span style="color: red">{{ errors.first('address') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="pre_due">
                                                                Pre Due <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.pre_due" :class="{ 'is-invalid': form.errors.has('pre_due') }"   class="col-xs-12 col-sm-12" id="pre_due" name="pre_due" required="" type="text" placeholder="Enter Guest Pre Due...">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="pre_due"></has-error>
                                                            <span style="color: red">{{ errors.first('pre_due') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="type">
                                                                Guest Type :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.type" id="type" class="ace input-sm"  name="type" type="radio" value="0">
                                                                        <span class="lbl"> Walk</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.type" class="ace input-sm" name="type" type="radio" value="1">
                                                                        <span class="lbl"> Corporate</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="type"></has-error>
                                                            <span style="color: red">{{ errors.first('type') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="status">
                                                                Status :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.status" id="status" class="ace input-sm"  name="status" type="radio" value="1">
                                                                        <span class="lbl"> Active</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.status" class="ace input-sm" name="status" type="radio" value="0">
                                                                        <span class="lbl"> Inactive</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="status"></has-error>
                                                            <span style="color: red">{{ errors.first('status') }}</span>
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
        name: "NewGuestComponent",
        components: {Loading},
        mounted() {
            this.isLoading = true
            this.$store.dispatch("allGuestTitle")
            this.$store.dispatch("allGuestDesignation")
            this.$store.dispatch("allStaffs")
            this.doAjax()

        },
        computed: {
            getAllGuestTitle() {
                return this.$store.getters.getGuestTitle
            },
            getAllGuestDesignation() {
                return this.$store.getters.getGuestDesignation
            },
            getAllStaffs() {
                return this.$store.getters.get_staffs
            },

        },
        data() {
            return {
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    branch: '1',
                    name: '',
                    guest_type: '',
                    designation: '',
                    rf_staff: '',
                    rf_guest: '',
                    email_address: '',
                    alt_email_address: '',
                    phone_number: '',
                    alt_phone_number: '',
                    address: '',
                    pre_due: '',
                    type: '0',
                    status: '1',
                })
            }
        },
        methods: {
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },1000)
            },

            addGuest() {
                this.isLoading = true
                this.form.post('/api/add-guest')
                    .then((response) => {
                        this.doAjax()
                        this.form.branch = '1'
                        this.form.name = ''
                        this.form.guest_type = ''
                        this.form.designation = ''
                        this.form.rf_staff = ''
                        this.form.rf_guest = ''
                        this.form.email_address = ''
                        this.form.alt_email_address = ''
                        this.form.phone_number = ''
                        this.form.alt_phone_number = ''
                        this.form.address = ''
                        this.form.pre_due = ''
                        this.form.category = ''
                        this.form.type = ''
                        this.form.status = ''

                        this.$router.push('/guest-list')
                        Toast.fire({
                            type: 'success',
                            title: ' New Guest Added successfully'
                        })
                    })
                    .catch((response) => {
                        this.doAjax()
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
