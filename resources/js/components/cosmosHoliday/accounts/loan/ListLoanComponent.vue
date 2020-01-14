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
                        <router-link to="/loan-list">Loan List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Loan List
                        <div class="card-tools" style="float:right">
                            <router-link to="/add-load" class="btn btn-success">Add Loan</router-link>
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
                                        <th class="center">Date</th>
                                        <th>Name</th>
                                        <th>Narration</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(loan , index) in  loans">
                                        <td class="center">{{index+1}}</td>
                                        <td>{{loan.loan_date | timeformate}}</td>
                                        <td>{{loan.name}}</td>
                                        <td>{{loan.narration}}</td>
                                        <td>{{loan.amount}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <router-link :to="`/installment/${loan.id}`" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </router-link>
                                                <router-link :to="`/edit-loan/${loan.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

                                                <!--                                                <button @click.prevent="deleteGuestTitle(received.id)" class="btn btn-xs btn-danger">-->
                                                <!--                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>-->
                                                <!--                                                </button>-->

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
                                            @paginate="getLoan()"
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
    export default {
        name: "ListLoanComponent",
        mounted() {
            this.getLoan()
        },
        data(){
            return {
                pagination:{
                    current_page: 1,
                },
                loans: '',
            }
        },
        methods:{
            getLoan(){
                axios.get('/api/get-all-loans?page='+this.pagination.current_page)
                    .then(response => {
                        this.loans = response.data.loans.data
                        this.pagination = response.data.loans
                    })
            },
        }
    }
</script>

<style scoped>

</style>