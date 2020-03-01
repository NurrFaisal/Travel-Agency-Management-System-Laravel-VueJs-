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
                                        <h5 class="widget-title">Edit Visa Country</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/visa-category-list" class="btn btn-success">Visa Category List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <form @submit.prevent="updateVisaCountry()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="name">
                                                        Name<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.id" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-8" id="id" name="id" placeholder="Enter Visa Country Name" required="" type="hidden">
                                                        <input v-validate="'required'" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-8" id="name" name="name" placeholder="Enter Visa Country Name" required="" type="text">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="name"></has-error>
                                                        <span style="color: red">{{ errors.first('name') }}</span>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions" v-if="user_type == 'super-admin' || user_type == 'admin'">
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
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</template>
<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "allVisaCountry",
        mounted(){
            this.isLoading = true
            axios.get(`/api/edit-visa-country/${this.$route.params.id}`)
                .then((response) => {
                    this.form.fill(response.data.visa_country)
                    this.user_type = response.data.user_type
                    this.doAjax()
                })
        },
        components: {
            Loading
        },
        data(){
            return{
                user_type:'',
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    name: "",
                    id:""
                })
            }

        },
        methods:{
            updateVisaCountry(){
                this.form.post('/api/update-visa-country')
                    .then((response) => {
                        this.form.name = ''
                        this.form.id = ''
                        this.$router.push('/visa-country-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Visa Country Updated successfully'
                        })
                    })
                    .catch((response) => {

                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
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
