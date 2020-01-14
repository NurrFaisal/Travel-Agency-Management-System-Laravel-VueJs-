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
                        Others Book
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

                                        <th>Receipt No.</th>
                                        <th>Others Name</th>
                                        <th>Others Account</th>
                                        <!--                                        <th>Action</th>-->
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(other_book, index) in  other_books">
                                        <!--                                        <td>{{bank_book.created_at | timeformate}}</td>-->
                                        <td> M-{{other_book.received_id}}</td>
                                        <td>{{other_book.others_name}}</td>
                                        <td>{{other_book.others_amount}}</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getChequeBook()"
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
        name: "ListOthersComponent",
        mounted() {
            this.getChequeBook()
        },

        data(){
            return {
                pagination:{
                    current_page: 1,
                },
                other_books: '',

            }
        },
        methods:{
            getChequeBook(){
                axios.get('/api/get-all-others?page='+this.pagination.current_page)
                    .then(response => {
                        this.other_books = response.data.other_books.data
                        this.pagination = response.data.other_books
                    })
            },



        }
    }
</script>

<style scoped>

</style>