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
                        <router-link to="/bank-list">Bank List</router-link>
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
                        Bank List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-bank" class="btn btn-success">Add New Bank</router-link>
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
                                        <th>Date</th>
                                        <th>Bank Name</th>
                                        <th>Debit </th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(bank, index) in  banks">
                                        <td class="center">{{index+1}}</td>
                                        <td>{{bank.updated_at | timeformate}}</td>
                                        <td>{{bank.bank_name}}</td>
                                        <td>{{sumDebit(bank.bank_bookt)}}</td>
                                        <td>{{sumCredit(bank.bank_bookt)}}</td>
                                        <td>{{allBalance()}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">
                                                <router-link :to="`/bank-book-by-id/${bank.id}`" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </router-link>
                                                <router-link :to="`/edit-bank/${bank.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

<!--                                                <button @click.prevent="deleteBank(bank.id)" class="btn btn-xs btn-danger">-->
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
<!--                                            @paginate="getBanks()"-->
<!--                                ></pagination>-->
<!--                            </div>-->
                        </div><!-- /.row -->

                        <div class="hr hr-18 dotted hr-double"></div>
                        <h1 style="float: right">Total Balace : {{allBalance()}}   /=</h1>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
</template>

<script>
    let total = 0
    export default {

        name: "ListBankComponent",
        mounted() {
           this.getBanks()
        },
        data(){
            return {
                // pagination:{
                //     current_page: 1,
                // },
                banks: '',
            }
        },
        methods:{

            getBanks(){
                axios.get('/api/get-all-bank')
                    .then(response => {
                        this.banks = response.data.banks
                        // this.pagination = response.data.banks
                    })
            },

            sumDebit(blances){
                let sum =0
                for(let i=0; i< blances.length; i++){
                    sum +=parseFloat(blances[i].debit_bank_amount)
                }
                total +=sum

                return sum

            },
            sumCredit(blances){
                let csum = 0
                for(let i=0; i< blances.length; i++){
                    csum +=parseFloat(blances[i].credit_bank_amount)
                }
                total -=csum

                return csum

            },
            allBalance(){
             return total
            },



            deleteBank(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.get('/api/delete-bank/'+id)
                            .then((response) =>{
                                // console.log(response.data)
                                Toast.fire({
                                    type: 'success',
                                    title: 'Bank Deleted successfully'
                                })
                                this.getBanks()
                            })

                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>