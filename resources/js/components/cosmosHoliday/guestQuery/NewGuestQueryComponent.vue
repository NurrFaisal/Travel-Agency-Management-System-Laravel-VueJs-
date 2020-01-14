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
                                        <h5 class="widget-title">Create new Guest Query</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/guest-query-list" class="btn btn-success">Guest Query List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <form @submit.prevent="addGuestQuery()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="guest_id">
                                                        Guest :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
<!--                                                            <select :class="{ 'is-invalid': form.errors.has('guest_id') }" class="col-xs-12 col-sm-8 " id="guest_id" name="guest_id"-->
<!--                                                                    required v-model="form.guest_id"-->
<!--                                                                    v-validate="'required'">-->
<!--                                                                <option value="">&#45;&#45;Guest Name&#45;&#45;</option>-->
<!--                                                                <option :value="guest.id" v-for="guest in getAllGuest">{{guest.name+'  ('+ guest.phone_number+')'}}</option>-->
<!--                                                            </select>-->
                                                            <select data-placeholder="Choose a Country..." v-model="form.guest_id" class="chosen-select"  style="width:350px;" tabindex="4">
                                                                    <option value=""></option>
                                                                    <option value="1">--Select Country--</option>
                                                                    <option :value="item.id" v-for="(item, index) in main_cat" >{{item.name}}</option>
                                                            </select>
<!--                                                             <v-select track-by="id" label="name" :options="selectdata"></v-select>-->

<!--                                                            <dynamic-select-->
<!--                                                                    :options="selectdata"-->
<!--                                                                    option-value="id"-->
<!--                                                                    option-text="name"-->
<!--                                                                    placeholder="type to search"-->
<!--                                                                    v-model="guest_id" />-->

                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="rf_staff"></has-error>
                                                        <span style="color: red">{{ errors.first('rf_staff') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="subject">
                                                        Subject<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.subject" :class="{ 'is-invalid': form.errors.has('subject') }"   class="col-xs-12 col-sm-8" id="subject" name="subject" placeholder="Enter Query Subject" required="" type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="subject"></has-error>
                                                        <span style="color: red">{{ errors.first('subject') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="guest_query">
                                                        Guest Query<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                         <span class="block input-icon input-icon-right">
                                                                <textarea v-validate="'required'" v-model="form.guest_query" :class="{ 'is-invalid': form.errors.has('guest_query') }"    class="col-xs-12 col-sm-8" id="guest_query" name="guest_query" placeholder="Enter Guest Full Query" ></textarea>
                                                         </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_query"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_query') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="follow_up">
                                                        Follow Up<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                         <span class="block input-icon input-icon-right">
                                                                <textarea v-validate="'required'" v-model="form.follow_up" :class="{ 'is-invalid': form.errors.has('follow_up') }"    class="col-xs-12 col-sm-8" id="follow_up" name="follow_up" placeholder="Enter Guest Full Follow Up" ></textarea>
                                                         </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="follow_up"></has-error>
                                                        <span style="color: red">{{ errors.first('follow_up') }}</span>
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
    textarea {
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
        name: "NewGuestQueryComponent",
        created(){
            this.fetchCategories()
        },
        mounted(){
            this.$store.dispatch("allGuest")
            // axios.get(`/api/get-all-guest-for-select`)
            //     .then((respose) => {
            //         this.selectdata = respose.data.guest
            //     })
            this.callJavaScript()
        },
        data(){
            return {
                categories: [],
                main_cat: [],
                cat_id: null,

                form: new Form({
                    guest_id: '',
                    subject: '',
                    guest_query: '',
                    follow_up: '',
                    status: '',
                })
            }
        },

        computed:{
            getAllGuest(){
                return this.$store.getters.get_guest
            },
            categoriesArray(){
                return _.map(this.categories, function(name, key) {
                    return name.name;
                });
            }
        },
        methods:{
            fetchCategories(){
                axios.get('/api/get-all-guest-for-select').then((response)=>{
                    this.categories = response.data.guest;
                    console.log(response.data.guest)
                    console.log(this.categories.length)
                    for(var i =0; i < this.categories.length; i++){
                        this.main_cat.push(this.categories[i])
                    }
                })
            },



            addGuestQuery(){
                this.form.post('/api/add-guest-query')
                    .then((response) => {
                        this.$router.push('/guest-query-list')
                        Toast.fire({
                            type: 'success',
                            title: 'New Guest Query Added successfully'
                        })
                    })
            },
            callJavaScript(){
                $('.chosen-select').chosen({}).change( function(obj, result) {
                    console.debug("changed: %o", arguments);

                    console.log("selected: " + result.selected);
                });
            }
        }
    }
</script>

<style scoped>

</style>