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
                        <router-link to="/income-list">Profit List</router-link>
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
                        Profit List
<!--                        <div class="card-tools" style="float:right">-->
<!--                            <router-link to="/new-suplier" class="btn btn-success">Add New Suplier</router-link>-->
<!--                        </div>-->
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
                                        <th class="center">Date</th>
                                        <th  class="center" >Invoice</th>
                                        <th  class="center" >Guest Name</th>
                                        <th  class="center" >Phone Number</th>
                                        <th  class="center" >Staff Name</th>

                                        <th  class="center" >Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(profit, index) in profits">
                                        <td class="center">{{profit.profit_date | timeformate}}</td>
                                        <td class="center" v-if="profit.air_id != null">A-{{profit.air_id}}</td>
                                        <td class="center" v-if="profit.pack_id != null">P-{{profit.pack_id}}</td>
                                        <td class="center" v-if="profit.visa_id != null">V-{{profit.visa_id}}</td>
                                        <td class="center" v-if="profit.hotel_id != null">H-{{profit.hotel_id}}</td>
                                        <td class="center">{{profit.guest.name}}</td>
                                        <td class="center">{{profit.guest.phone_number}}</td>
                                        <td class="center">{{profit.staff.first_name}}</td>
                                        <td class="center">{{profit.amount}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->




                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getAllProfit()"
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
        name: "ListIncome",
        mounted(){
            this.isLoading = true
            this.getAllProfit()
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
                profits: '',
            }
        },
        methods:{
            getAllProfit(){
                axios.get('/api/get-all-profit?page='+this.pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.profits = response.data.profits.data
                        this.pagination = response.data.profits
                        this.doAjax();
                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllProfitSearch(this.search_text)
                }else{
                    this.getAllProfit()
                    ;
                }
            },1000),
            getAllProfitSearch(search_text){
                axios.get(`/api/get-all-profit-search/`+search_text+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.profits = response.data.profits.data
                        this.pagination = response.data.profits
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
