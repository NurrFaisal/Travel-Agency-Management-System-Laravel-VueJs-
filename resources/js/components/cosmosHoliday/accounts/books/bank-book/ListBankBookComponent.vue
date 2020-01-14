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
                        Bank Book
                        <!--                        <div class="card-tools" style="float:right">-->
                        <!--                            <router-link to="/new-payment" class="btn btn-success">Add Payment</router-link>-->
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
                                        <th>Receipt No.</th>
                                        <th>Narration</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                        <!--                                        <th>Action</th>-->
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(bank_book, index) in  bank_books">
                                        <td>{{bank_book.created_at | timeformate}}</td>
                                        <td v-if="bank_book.received_id != null"> M-{{bank_book.received_id}}</td>
                                        <td v-else-if="bank_book.payment_id != null"> DV-{{bank_book.payment_id}}</td>
                                        <td v-else> Updated</td>
                                        <td>{{bank_book.narration}}</td>
                                        <td>{{bank_book.debit_bank_amount}}</td>
                                        <td>{{bank_book.credit_bank_amount}}</td>
                                        <td>{{bank_book.blance}}</td>
                                        <!--                                        <td class="center">-->
                                        <!--                                            <div class="hidden-sm hidden-xs btn-group">-->

                                        <!--                                                <button class="btn btn-xs btn-success">-->
                                        <!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
                                        <!--                                                </button>-->
                                        <!--                                                <router-link :to="`/edit-payment/${cash.id}`" class="btn btn-xs btn-info">-->
                                        <!--                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>-->
                                        <!--                                                </router-link>-->

                                        <!--                                                &lt;!&ndash;                                                <button @click.prevent="deleteGuestTitle(received.id)" class="btn btn-xs btn-danger">&ndash;&gt;-->
                                        <!--                                                &lt;!&ndash;                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>&ndash;&gt;-->
                                        <!--                                                &lt;!&ndash;                                                </button>&ndash;&gt;-->

                                        <!--                                            </div>-->
                                        <!--                                        </td>-->
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getCashBook()"
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
    let sum = 0
    export default {
        name: "ListBankBookComponent",
        mounted() {
            this.getCashBook()
        },
        data(){
            return {

                pagination:{
                    current_page: 1,
                },
                bank_books: '',
            }
        },
        methods:{
            getCashBook(){
                axios.get('/api/get-all-bank-book?page='+this.pagination.current_page)
                    .then(response => {
                        this.bank_books = response.data.bank_books.data
                        this.pagination = response.data.bank_books
                    })
            },
            sumdebit(x, y){

                sum += parseFloat(x - y)
                return sum
            }
        }
    }
</script>

<style scoped>

</style>