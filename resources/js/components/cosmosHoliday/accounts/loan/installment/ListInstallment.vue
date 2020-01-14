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
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Installment List Of {{loan.name}}
                        <div class="card-tools" style="float:right">
                            <router-link :to="`/add-installment/${this.$route.params.id}`" class="btn btn-success">Add Installment</router-link>
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
                                        <th>Narration</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(installment , index) in  installments">
                                        <td class="center">{{index+1}}</td>
                                        <td>{{installment.created_at | timeformate}}</td>
                                        <td>{{installment.narration}}</td>
                                        <td>{{installment.total_amount}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

<!--                                                <router-link :to="`/installment/${loan.id}`" class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </router-link>-->
                                                <router-link :to="`/edit-installment/${installment.id}`" class="btn btn-xs btn-info">
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
<!--                            <div class="justify-content-center">-->
<!--                                <pagination v-if="pagination.last_page > 1"-->
<!--                                            :pagination="pagination"-->
<!--                                            :offset="5"-->
<!--                                            @paginate="getInstallment()"-->
<!--                                ></pagination>-->
<!--                            </div>-->

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
        name: "ListInstallment",
        mounted() {
            this.getInstallment()
        },
        data(){
            return {
                installments: '',
                loan: '',
            }
        },
        methods:{
            getInstallment(){
                axios.get(`/api/get-all-installment/${this.$route.params.id}`)
                    .then(response => {
                        this.installments = response.data.installments
                        this.loan = response.data.loan
                    })
            },
        }
    }
</script>

<style scoped>

</style>