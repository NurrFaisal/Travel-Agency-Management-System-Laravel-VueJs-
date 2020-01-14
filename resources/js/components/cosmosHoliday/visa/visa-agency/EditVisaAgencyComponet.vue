<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Tables</a>
                    </li>
                    <li class="active">Simple &amp; Dynamic</li>
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
                                        <h5 class="widget-title">Edit Visa Agency</h5>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">


                                            <form @submit.prevent="updateVisaAgency()" class="form-horizontal" method="post" role="form">
                                                <br>
                                                <!-- Visa Agency Register -->
                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-3">Name <span class="text-danger">*</span>: </div>
                                                            <div class="col-sm-3">Company Name <span class="text-danger">*</span>: </div>
                                                            <div class="col-sm-3">Email <span class="text-danger">*</span>: </div>
                                                            <div class="col-sm-3">Phone Number: </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-2 text-right"><p>General Info:</p></div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-sm-3 ">
                                                                <input type="hidden" id="id" v-model="form.id" name="id" class="form-control" style="max-width: 95%;" value="">
                                                                <input type="text" id="name" v-model="form.name" name="name" class="form-control" style="max-width: 95%;" value="" required="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="name"></has-error>
                                                                    <span style="color: red">{{ errors.first('name') }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 ">
                                                                <input type="text" id="company_name" v-model="form.company_name" name="company_name" class="form-control" style="max-width: 95%;" value="" required="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="company_name"></has-error>
                                                                    <span style="color: red">{{ errors.first('company_name') }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 ">
                                                                <input type="email" id="email_address" v-model="form.email_address" name="email_address" class="form-control" style="max-width: 95%;" value="" required="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="email_address"></has-error>
                                                                    <span style="color: red">{{ errors.first('email_address') }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 ">
                                                                <input type="text" id="phone_number" v-model="form.phone_number" name="phone_number" required="" class="form-control" style="max-width: 95%;" value="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                                    <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-sm-2"></div>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-3">Address <span class="text-danger">*</span>: </div>
                                                            <div class="col-sm-3">Alt. Phone Number: </div>
                                                            <div class="col-sm-3">Website: </div>
                                                            <div class="col-sm-3"></div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-2 text-right"><p>Details:</p></div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-sm-3 ">
                                                                <input type="text" id="address" v-model="form.address" name="address" class="form-control" style="max-width: 95%;" value="" required="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="address"></has-error>
                                                                    <span style="color: red">{{ errors.first('address') }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 ">
                                                                <input type="text" id="alt_phone_number" v-model="form.alt_phone_number" name="alt_phone_number" class="form-control" style="max-width: 95%;" value="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="alt_phone_number"></has-error>
                                                                    <span style="color: red">{{ errors.first('alt_phone_number') }}</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3 ">
                                                                <input type="text" id="website" v-model="form.website" name="website" class="form-control" style="max-width: 95%;" value="">
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="website"></has-error>
                                                                    <span style="color: red">{{ errors.first('website') }}</span>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-2 text-right">

                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="submit" name="" class="button" style="background-color: #d3d3d380 !important;" value="Update Visa Agency">
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
        name: "EditVisaAgencyComponent",
        mounted(){
            axios.get(`/api/edit-visa-agency/${this.$route.params.id}`)
                .then((response) => {
                    this.form.fill(response.data.visa_agency)
                })
        },
        data(){
            return{
                form: new Form({
                    id: "",
                    name: "",
                    company_name: "",
                    email_address: "",
                    phone_number: "",
                    address: "",
                    alt_phone_number: "",
                    website: ""

                })
            }

        },
        methods:{
            updateVisaAgency(){
                this.form.post('/api/update-visa-agency')
                    .then((response) => {
                        this.form.id = ''
                        this.form.name = ''
                        this.form.company_name = ''
                        this.form.email_address = ''
                        this.form.phone_number = ''
                        this.form.address = ''
                        this.form.alt_phone_number = ''
                        this.form.website = ''
                        this.$router.push('/visa-agency-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Visa Agency Updated successfully'
                        })
                    })
                    .catch((response) => {

                    })
            }
        }
    }
</script>

<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }
    textarea {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
    }
</style>