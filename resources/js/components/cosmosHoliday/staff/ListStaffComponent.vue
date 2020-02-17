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
                        <router-link to="/staff-list">Staff List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" @keyup="search()" id="nav-search-input" v-model="searchText" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Staff List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-staff" class="btn btn-success">Add Staff</router-link>
                        </div>
                        <br/>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">Sl.</th>
                                        <th class="center">Photo</th>
                                        <th  class="center" >Staff Name</th>
                                        <th  class="center" >Phone Number</th>
                                        <th  class="center" >Email</th>
                                        <th  class="center" >Salary</th>
                                        <th  class="center" >Balance</th>

                                        <th  class="center" >Status</th>
                                        <th  class="center" >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(staff, index) in staffs">
                                        <td class="center">{{index+1}}</td>
                                        <td class="center"><img width="40" :src="staff.image"/></td>
                                        <td class="center">{{staff.first_name+' '+staff.last_name}}</td>
                                        <td class="center">{{staff.phone_number}}</td>
                                        <td class="center">{{staff.email_address}}</td>
                                        <td class="center">{{staff.salary}}.00</td>
                                        <td class="center">{{staff.transaction[0] == null ? '0.00' : staff.transaction[0].staff_blance}}</td>
                                        <td class="center">{{staff.status == 1 ? 'Active' : 'Inactive'}}</td>
                                        <td class="center">
                                            <div class="btn-group center">
                                                <!--                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
                                                <!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                                <!--                                                </a>-->
                                                <router-link  :to="`/edit-staff/${staff.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <router-link  :to="`/view-staff/${staff.id}`" class="btn btn-xs btn-success">
                                                    View
                                                </router-link>
                                                <!--                                                                <a href="#"  @click.prevent="openPackageQueryModal(doj.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_query_modal">-->
                                                <!--                                                                    Follow Up-->
                                                <!--                                                                </a>-->

                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->




                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getAllStaff()"
                                ></pagination>
                            </div>
                        </div><!-- /.row -->


                        <div class="hr hr-18 dotted hr-double"></div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
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
        name: "ListStaffComponent",

        mounted() {
            this.isLoading = true
            this.getAllStaff()
        },
        components: {
            Loading
        },
        data(){

            return {
                searchText:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',

                pagination:{
                    current_page: 1,
                },
                staffs: '',
            }
        },
        methods:{
            getAllStaff(){
                axios.get('/api/get-all-staffs?page='+this.pagination.current_page)
                    .then(response => {
                        this.staffs = response.data.staffs.data
                        this.pagination = response.data.staffs
                        this.doAjax();
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
            onCancel() {
                console.log('User cancelled the loader.')
            },
            search:_.debounce(function () {
                this.isLoading = true
                if(this.searchText != ''){
                    this.getAllSearchStaff(this.searchText)
                }else{
                    this.getAllStaff();
                }
            },1000),
            getAllSearchStaff(searchText){
                axios.get('/api/get-all-staff-search/'+searchText+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.staffs = response.data.staffs.data
                        this.pagination = response.data.staffs
                        this.isLoading = false
                    })

            },
        }
    }
</script>

<style scoped>

</style>
