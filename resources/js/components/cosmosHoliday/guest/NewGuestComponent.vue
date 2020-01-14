<template>
    <div class="autocomplate">
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
                                        <h5 class="widget-title">Create new Customer</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/guest-list" class="btn btn-success">Guest List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <form @submit.prevent="addGuest()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right">
                                                        <label class="control-label">Branch</label>
                                                        <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <div class="row">
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input checked class="ace input-sm" name="branch" type="radio" v-model="form.branch" value="1">
                                                                        <span class="lbl"> Dhanmondi</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input class="ace input-sm" name="branch" type="radio" v-model="form.branch" value="2">
                                                                        <span class="lbl"> Banani</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="branch"></has-error>
                                                        <span style="color: red">{{ errors.first('branch') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="name">
                                                        Name<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-8" id="name" name="name" placeholder="Enter Guest Name" required="" type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="name"></has-error>
                                                        <span style="color: red">{{ errors.first('name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="guest_type">Type :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('guest_type') }" class="col-xs-12 col-sm-8" id="guest_type"
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
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="designation">
                                                        Designaiton :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('designation') }" class="col-xs-12 col-sm-8 " id="designation"
                                                                    name="designation" required
                                                                    v-model="form.designation"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Designation--</option>
                                                                <option :value="designation.id" v-for="designation in getAllGuestDesignation">{{designation.guest_designation}}</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="designation"></has-error>
                                                        <span style="color: red">{{ errors.first('designation') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="rf_staff">Refernce Staff :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <AutoComplate :shouldReset="true" @change="onchange"  :items="staffs" filterby="first_name" @Selected="customerSelected"/>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="rf_staff"></has-error>
                                                        <span style="color: red">{{ errors.first('rf_staff') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="rf_guest">
                                                        Reference Guest<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <input v-model="form.rf_guest"  :class="{ 'is-invalid': form.errors.has('rf_guest') }" class="col-xs-12 col-sm-8" id="rf_guest" name="rf_guest_name" placeholder="Enter Referernce Guust Name" required="" type="text" value="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="rf_guest"></has-error>
                                                        <span style="color: red">{{ errors.first('rf_guest') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="email_address">
                                                        Email<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <input v-validate="`required`" v-model="form.email_address" :class="{ 'is-invalid': form.errors.has('email_address') }" class="col-xs-12 col-sm-8" id="email_address" name="email_address" placeholder="Enter Guest Email Address" required="" type="email" value="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="email_address"></has-error>
                                                        <span style="color: red">{{ errors.first('email_address') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="alt_email_address">
                                                        Email (Emergency)<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <input class="col-xs-12 col-sm-8" v-model="form.alt_email_address" id="alt_email_address" name="alt_email_address" placeholder="Enter Alt. Email Address" required="" type="email" value="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color: red" :form="form" field="email_address"></has-error>
                                                        <span style="color: red">{{ errors.first('email_address') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="phone_number">
                                                        Phone Number<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <input v-model="form.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }" class="col-xs-12 col-sm-8" id="phone_number" name="phone_number" placeholder="Enter Guest Phone Number" required="" type="text" value="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                        <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="alt_phone_number">
                                                        Alt. Phone Number<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <input v-model="form.alt_phone_number" :class="{ 'is-invalid': form.errors.has('alt_phone_number') }" class="col-xs-12 col-sm-8" id="alt_phone_number" name="alt_phone_number" placeholder="Enter Guest Alt. Phone Number Number" required="" type="text" value="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="alt_phone_number"></has-error>
                                                        <span style="color: red">{{ errors.first('alt_phone_number') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="address">
                                                        Address<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <input v-model="form.address" class="col-xs-12 col-sm-8" id="address" name="address" placeholder="Enter Guest Address" required="" type="text" value="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="address"></has-error>
                                                        <span style="color: red">{{ errors.first('address') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="category">Category :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('category') }" class="col-xs-12 col-sm-8" id="category"
                                                                    name="category" required
                                                                    v-model="form.category"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Category--</option>
                                                                <option value="1">Guest</option>
                                                                <option value="2">Sup Agency</option>
                                                                <option value="3">Suplier</option>
                                                                <option value="4">Suplier and Sup Agency</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="category"></has-error>
                                                        <span style="color: red">{{ errors.first('category') }}</span>
                                                    </div>
                                                </div>


                                                <div class="form-group ">
                                                <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right">
                                                    <label class="control-label">Type</label>
                                                    <span class="text-danger">*</span> :
                                                </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <div class="row">
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input checked  v-model="form.type" class="ace input-sm" name="type" type="radio" value="0">
                                                                        <span class="lbl"> Walk</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input v-model="form.type" class="ace input-sm" name="type" type="radio" value="1">
                                                                        <span class="lbl"> Corporate</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="status"></has-error>
                                                        <span style="color: red">{{ errors.first('status') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right">
                                                        <label class="control-label">Status</label>
                                                        <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <div class="row">
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input checked  v-model="form.status" class="ace input-sm" name="status" type="radio" value="1">
                                                                        <span class="lbl"> Active</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input v-model="form.status" class="ace input-sm" name="status" type="radio" value="0">
                                                                        <span class="lbl"> Inactive</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="status"></has-error>
                                                        <span style="color: red">{{ errors.first('status') }}</span>
                                                    </div>
                                                </div>
<!--                                                {{staffs}}-->

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
<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
    }
</style>

<script>
    import AutoComplate from "../searchSelect/AutoComplate";
    export default {
        name: "NewGuestComponent",
        components: {AutoComplate},
        data() {
            return {
                staffs: '',
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
                    category: '',
                    type: '0',
                    status: '1',
                })
            }
        },
        mounted() {
            // $(function () {
            //     //Initialize Select2 Elements
            //     $('.select2').select2()
            // })
            this.$store.dispatch("allGuestTitle")
            this.$store.dispatch("allGuestDesignation")
            this.$store.dispatch("allStaffs")

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
        methods: {
            toggleVisible(){
              this.visible = !this.visible
            },

            customerSelected(customer){
                this.form.rf_staff = customer.id;

            },
            onchange(query){
                if(query != ''){
                    this.allRefernceStaff(query)
                }
            },
            allRefernceStaff(query){
                axios.get(`/api/get-all-refernce-staff/${query}`)
                    .then(response => {
                        this.staffs = response.data.staffs
                    })
            },

            addGuest() {
                // console.log(this.form)
                this.form.post('/api/add-guest')
                    .then((response) => {
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
                        this.form.category = ''
                        this.form.type = ''
                        this.form.status = ''

                        this.$router.push('/guest-list')
                        Toast.fire({
                            type: 'success',
                            title: ' New Guest Added successfully'
                        })
                    })
            }
        }

    }
</script>

<style scoped>




</style>