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
                                        <h5 class="widget-title">Edite Recived Visa</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/visa-list" class="btn btn-success">Visa List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updateReceivedVisa()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="name">
                                                                Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-12" id="name" name="name" placeholder="Enter Traveler's Full Name" required="" type="text">
                                                                <input type="hidden"  v-model="form.id"  >
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="name"></has-error>
                                                            <span style="color: red">{{ errors.first('name') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="phone_number">
                                                                Phone Number<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }"   class="col-xs-12 col-sm-12" id="phone_number" name="phone_number" placeholder="Enter Traveler's Phone Number" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="date_of_birth">
                                                                Date Of Birth<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.date_of_birth" :class="{ 'is-invalid': form.errors.has('date_of_birth') }"   class="col-xs-12 col-sm-12" id="date_of_birth" name="date_of_birth" placeholder="Enter Traveler's Date Of Birth" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="date_of_birth"></has-error>
                                                            <span style="color: red">{{ errors.first('date_of_birth') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="pp_number">
                                                                Passport No.<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.pp_number" :class="{ 'is-invalid': form.errors.has('pp_number') }"   class="col-xs-12 col-sm-12" id="pp_number" name="pp_number" placeholder="Enter Traveler's Passport No" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="pp_number"></has-error>
                                                            <span style="color: red">{{ errors.first('pp_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="no_of_books">
                                                                Number Of Books<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.no_of_books" :class="{ 'is-invalid': form.errors.has('no_of_books') }"   class="col-xs-12 col-sm-12" id="no_of_books" name="no_of_books" placeholder="Enter Number Of Boooks" value="1" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="no_of_books"></has-error>
                                                            <span style="color: red">{{ errors.first('no_of_books') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="pp_issue_date">
                                                                PP Issue Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.pp_issue_date" :class="{ 'is-invalid': form.errors.has('pp_issue_date') }"   class="col-xs-12 col-sm-12" id="pp_issue_date" name="pp_issue_date" placeholder="Enter Passsport Issue Date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="pp_issue_date"></has-error>
                                                            <span style="color: red">{{ errors.first('pp_issue_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="pp_expire_date">
                                                                PP Expire Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.pp_expire_date" :class="{ 'is-invalid': form.errors.has('pp_expire_date') }"   class="col-xs-12 col-sm-12" id="pp_expire_date" name="pp_expire_date" placeholder="Enter Passport Expire Date" value="1" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="pp_expire_date"></has-error>
                                                            <span style="color: red">{{ errors.first('pp_expire_date') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="country">
                                                                Country<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('country') }" v-model="form.country" id="country" name="country" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Country--</option>
                                                                    <option :value="country.id" v-for="country in getAllVisaCountry " >{{country.name}}</option>
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
                                                            <label for="type">
                                                                Type <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('type') }" v-model="form.type" id="type" name="type" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Category--</option>
                                                                    <option :value="type.id" v-for="type in getAllVisaCategory" >{{type.name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="type"></has-error>
                                                            <span style="color: red">{{ errors.first('type') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="suplier">
                                                                Suplier<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('suplier') }" v-model="form.suplier" id="suplier" name="suplier" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Suplier--</option>
                                                                    <option :value="suplier.id" v-for="suplier in getAllSuplier" >{{suplier.name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                            <span style="color: red">{{ errors.first('suplier') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="reference">
                                                                Reference<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('reference') }" v-model="form.reference" id="reference" name="reference" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Reference--</option>
                                                                    <option :value="reference.id" v-for="reference in getAllReference">{{reference.name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="reference"></has-error>
                                                            <span style="color: red">{{ errors.first('reference') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="net_price">
                                                                Net Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.net_price" :class="{ 'is-invalid': form.errors.has('net_price)') }"   class="col-xs-12 col-sm-12" id="net_price" name="net_price" placeholder="Enter Net Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="net_price"></has-error>
                                                            <span style="color: red">{{ errors.first('net_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup.prevent="sumDue()" v-validate="'required'" v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }"   class="col-xs-12 col-sm-12" id="price" name="price" placeholder="Enter price" value="1" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="price"></has-error>
                                                            <span style="color: red">{{ errors.first('price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="advance">
                                                                Advance<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup.prevent="sumDue()" v-validate="'required'" v-model="form.advance" :class="{ 'is-invalid': form.errors.has('advance)') }"   class="col-xs-12 col-sm-12" id="advance" name="advance" placeholder="Enter Advance Payment" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="advance"></has-error>
                                                            <span style="color: red">{{ errors.first('advance') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="due">
                                                                Due<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" readonly v-model="due" :class="{ 'is-invalid': form.errors.has('due') }"   class="col-xs-12 col-sm-12" id="due" name="due" placeholder="Enter Due Amount" value="0" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="due"></has-error>
                                                            <span style="color: red">{{ errors.first('due') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="sales_person">
                                                                Sales Person<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('sales_person') }" v-model="form.sales_person" id="sales_person" name="sales_person" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Sales Person--</option>
                                                                    <option :value="visa_staff.id" v-for="visa_staff in getAllVisaStaff" >{{visa_staff.first_name+' '+ visa_staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="sales_person"></has-error>
                                                            <span style="color: red">{{ errors.first('sales_person') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="recived_date">
                                                                Recived Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.received_date" :class="{ 'is-invalid': form.errors.has('recived_date') }"   class="col-xs-12 col-sm-12" id="recived_date" name="recived_date" placeholder="Enter Recived Date" value="0" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="recived_date"></has-error>
                                                            <span style="color: red">{{ errors.first('recived_date') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="payment_status">
                                                                Payment Status<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.payment_status" id="payment_status" class="ace input-sm" checked name="payment_status" type="radio" value="0">
                                                                        <span class="lbl"> Pending</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.payment_status" class="ace input-sm" name="payment_status" type="radio" value="1">
                                                                        <span class="lbl"> Success</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="payment_status"></has-error>
                                                            <span style="color: red">{{ errors.first('payment_status') }}</span>
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
        name: "EditVisaComponent",
        mounted(){
            axios.get(`/api/edit-received-visa/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.received_visa)
                    this.due = this.form.price - this.form.advance
                })
            this.$store.dispatch("allVisaCountry")
            this.$store.dispatch("allVisaCategory")
            this.$store.dispatch("allSuplier")
            this.$store.dispatch("allReference")
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaCountry(){
                return this.$store.getters.get_visa_country
            },
            getAllVisaCategory(){
                return this.$store.getters.get_visa_category
            },
            getAllSuplier(){
                return this.$store.getters.get_suplier
            },
            getAllReference(){
                return this.$store.getters.get_reference
            },
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }


        },

        data(){
            return {
                due:0,
                form: new Form({
                    id: '',
                    name: '',
                    phone_number: '',
                    date_of_birth: '',
                    pp_number: '',
                    no_of_books: '',
                    pp_issue_date: '',
                    pp_expire_date: '',
                    country: '',
                    type: '',
                    suplier: '',
                    reference: '',
                    net_price: '',
                    price: '',
                    advance: '',
                    sales_person: '',
                    received_date: '',
                    payment_status:'',
                    narration:'',

                })
            }
        },
        methods:{
            updateReceivedVisa(){
                this.form.post('/api/update-received-visa')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('state',1)
                        this.form.name = ''
                        this.form.phone_number = ''
                        this.form.date_of_birth = ''
                        this.form.pp_number = ''
                        this.form.no_of_books = ''
                        this.form.pp_issue_date = ''
                        this.form.pp_expire_date = ''
                        this.form.country = ''
                        this.form.type = ''
                        this.form.suplier = ''
                        this.form.reference = ''
                        this.form.net_price = ''
                        this.form.price = ''
                        this.form.advance = ''
                        this.form.sales_person = ''
                        this.form.received_date = ''
                        this.form.payment_status =''
                        this.$router.push('/visa-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Received Visa Updated Successfully'
                        })
                    })
                    .catch((respose) => {

                    })
            },
            sumDue(){
                this.due = this.form.price - this.form.advance
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
</style>