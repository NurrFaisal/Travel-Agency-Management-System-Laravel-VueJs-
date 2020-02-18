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
                        <router-link to="/suplier-list">Supliers List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchText()" id="nav-search-input" v-model="search_text" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Supliers List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-suplier" class="btn btn-success">Add New Suplier</router-link>
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
                                        <th  class="center" >Company Name</th>
                                        <th  class="center" >Contact Person</th>
                                        <th  class="center" >Phone Number</th>
                                        <th  class="center" >Email</th>
                                        <th  class="center" >Country</th>
                                        <th  class="center" >Balance</th>
                                        <th  class="center" >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(suplier, index) in supliers">
                                        <td class="center">{{index+1}}</td>
                                        <td class="center">{{suplier.name}}</td>
                                        <td class="center">{{suplier.contact_person}}</td>
                                        <td class="center">{{suplier.phone_number}}</td>
                                        <td class="center">{{suplier.email_address}}</td>
                                        <td class="center">{{suplier.countryt.name}}</td>
                                        <td class="center">{{suplier.transactions == null ? '-' : suplier.transactions.suplier_balance}}</td>
                                        <td class="center">
                                            <div class="btn-group center">
                                                <!--                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
                                                <!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                                <!--
                                                                                         </a>-->
                                                <router-link  :to="`/edit-suplier/${suplier.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <router-link :to="`/view-suplier/${suplier.id}`" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </router-link>
                                                <!--                                                                <a href="#"  @click.prevent="openPackageQueryModal(doj.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_query_modal">-->
                                                <!--                                                                    Follow Up-->
                                                <!--                                                                </a>-->
<!--                                                <a href="#" @click.prevent="deleteSuplier(suplier.id)"  class="btn btn-xs btn-danger"  title="Delete">-->
<!--                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>-->
<!--                                                </a>-->
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
                                            @paginate="getAllSuplier()"
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
        name: "ListSuplierComponent",
        mounted(){
            this.isLoading = true
            this.getAllSuplier()
        },
        components: {
            Loading
        },
        data(){
            return {
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',
                pagination:{
                    current_page: 1,
                },
                supliers: '',
            }
        },
        methods:{
            getAllSuplier(){
                axios.get('/api/get-all-supliers?page='+this.pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.supliers = response.data.supliers.data
                        this.pagination = response.data.supliers
                        this.doAjax();
                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllSuplierSearch(this.search_text)
                }else{
                    this.getAllSuplier();
                }
            },1000),
            getAllSuplierSearch(search_text){
                axios.get(`/api/get-all-suplier-search/`+search_text+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.supliers = response.data.supliers.data
                        this.pagination = response.data.supliers
                        this.isLoading = false
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },




            // deleteAgency(id){
            //     Swal.fire({
            //         title: 'Are you sure?',
            //         text: "You won't be able to revert this!",
            //         type: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Yes, delete it!'
            //     }).then((result) => {
            //         if (result.value) {
            //             axios.get('/api/delete-suplier/'+id)
            //                 .then((response) =>{
            //                     Toast.fire({
            //                         type: 'success',
            //                         title: 'Agency Deleted successfully'
            //                     })
            //                     this.$store.dispatch("allAgency")
            //                 })
            //
            //         }
            //     })
            // }
        }
    }
</script>

<style scoped>

</style>
