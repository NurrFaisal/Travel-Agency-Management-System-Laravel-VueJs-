<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <router-link to="/dashboard">Home</router-link>
                    </li>

                    <li>
                        <router-link to="/new-suplier">New Agency</router-link>
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
                                        <h5 class="widget-title">Create New Agency</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/suplier-list" class="btn btn-success">Agency List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <form @submit.prevent="addAgency()" class="form-horizontal" method="post" role="form">

                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="name">
                                                        Name<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-8" id="name" name="name" placeholder="Enter Agency Name" required type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="name"></has-error>
                                                        <span style="color: red">{{ errors.first('name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="company_name">
                                                        Company Name<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.company_name" :class="{ 'is-invalid': form.errors.has('company_name') }"   class="col-xs-12 col-sm-8" id="company_name" name="company_name" placeholder="Enter Agency Company Name" required type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="company_name"></has-error>
                                                        <span style="color: red">{{ errors.first('company_name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="email_address">
                                                        Email Address<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.email_address" :class="{ 'is-invalid': form.errors.has('email_address') }"   class="col-xs-12 col-sm-8" id="email_address" name="email_address" placeholder="Enter Agency Email Address" required type="email">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="email_address"></has-error>
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
                                                        <input v-validate="'required'" v-model="form.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }"   class="col-xs-12 col-sm-8" id="phone_number" name="phone_number" placeholder="Enter Agency Phone Number" required type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                        <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="alt_phone_number">
                                                        Alt. Phone Number<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.alt_phone_number" :class="{ 'is-invalid': form.errors.has('alt_phone_number') }"   class="col-xs-12 col-sm-8" id="alt_phone_number" name="alt_phone_number" placeholder="Enter Agency Alt Phone Number" required type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="alt_phone_number"></has-error>
                                                        <span style="color: red">{{ errors.first('alt_phone_number') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="address">
                                                        Address<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }"   class="col-xs-12 col-sm-8" id="address" name="address" placeholder="Enter Agency Address" required type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="address"></has-error>
                                                        <span style="color: red">{{ errors.first('address') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="website">
                                                        Website<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.website" :class="{ 'is-invalid': form.errors.has('website') }"   class="col-xs-12 col-sm-8" id="website" name="website" placeholder="Enter Agency Website" required type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="website"></has-error>
                                                        <span style="color: red">{{ errors.first('website') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="department">Department :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('department') }" class="col-xs-12 col-sm-8" id="department"
                                                                    name="guest_type" required
                                                                    v-model="form.department"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Department--</option>
                                                                <option :value="department.id" v-for="department in allDepartment">{{department.department_name}}</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="department"></has-error>
                                                        <span style="color: red">{{ errors.first('department') }}</span>
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
    export default {
        name: "NewSuplierComponent",
        data() {
            return {
                form: new Form({
                    name: '',
                    company_name: '',
                    email_address: '',
                    phone_number: '',
                    alt_phone_number: '',
                    address: '',
                    website: '',
                    department: '',
                    status: '1'
                })
            }
        },
        mounted() {
            this.$store.dispatch('allDepartment')
        },
        computed: {
            allDepartment(){
                return this.$store.getters.get_department
            }

        },
        methods: {
            addAgency() {
                // console.log(this.form)
                this.form.post('/api/add-suplier')
                    .then((response) => {
                        this.form.name = ''
                        this.form.company_name = ''
                        this.form.email_address = ''
                        this.form.phone_number = ''
                        this.form.alt_phone_number = ''
                        this.form.address = ''
                        this.form.wedsite = ''
                        this.form.status = ''

                        this.$router.push('/suplier-list')
                        Toast.fire({
                            type: 'success',
                            title: ' New Suplier Added successfully'
                        })
                    })
            }
        }

    }
</script>

<style scoped>

</style>