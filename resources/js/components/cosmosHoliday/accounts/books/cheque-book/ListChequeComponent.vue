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
                        Cheque Book
                        <!--                        <div class="card-tools" style="float:right">-->
                        <!--                            <router-link to="/new-payment" class="btn btn-success">Add Payment</router-link>-->
                        <!--                        </div>-->
                        <br/>
                    </h1>
                </div><!-- /.page-header -->
                <div class="modal fade" id="cheque_book_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4 class="modal-title">Cheque Clear Modal</h4>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="clearCheque()" method="post">
                                    <div v-if="form.cheque_type == 2">
                                        <div class="row">
                                            <label for="bank_name" class="col-sm-5">Bank Name:</label>
                                            <div class="col-sm-7">
                                                <select v-model="form.bank_name" class="form-control " id="bank_name" name="bank_name" required style="width: 95%;">
                                                    <option value="">--Select Bank Name--</option>
                                                    <option :value="bank.id" v-for="bank in get_all_banks">{{bank.bank_name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                <has-error style="color:red" :form="form" field="bank_name"></has-error>
                                                <span style="color: red">{{ errors.first('bank_name') }}</span>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <label for="bank_date" class="col-sm-5">Bank Date:</label>
                                            <div class="col-sm-7">
                                                <input type="date" v-model="form.bank_date" id="bank_date" name="bank_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                <input type="hidden" v-model="form.id" >
                                            </div>
                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                <has-error style="color:red" :form="form" field="bank_date"></has-error>
                                                <span style="color: red">{{ errors.first('bank_date') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="form.cheque_type == 1">

                                        <div class="row">
                                            <label for="cash_date" class="col-sm-5">Cash Date:</label>
                                            <div class="col-sm-7">
                                                <input type="date" v-model="form.cash_date" id="cash_date" name="cash_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                <input type="hidden" v-model="form.id" >
                                            </div>
                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                <has-error style="color:red" :form="form" field="cash_date"></has-error>
                                                <span style="color: red">{{ errors.first('cash_date') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class="col-sm-5 text-right"></div>
                                        <div class="col-sm-5">
                                            <input type="submit" name="" class="button" style="background-color: #d3d3d380 !important;" value="Clear">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>

                                        <th>Receipt No.</th>
                                        <th>Bank Name</th>
                                        <th>Cheque Type</th>
                                        <th>Cheque Number</th>
                                        <th>Cheque Date</th>
                                        <th>Cheque Amount</th>
                                        <th>Action</th>
                                        <!--                                        <th>Action</th>-->
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(cheque_book, index) in  cheque_books">
<!--                                        <td>{{bank_book.created_at | timeformate}}</td>-->
                                        <td> M-{{cheque_book.received_id}}</td>
                                        <td>{{cheque_book.cheque_bank_name}}</td>
                                        <td>{{cheque_book.cheque_type == 1 ? 'Cash' : 'Bank'}}</td>
                                        <td>{{cheque_book.cheque_number}}</td>
                                        <td>{{cheque_book.cheque_date}}</td>
                                        <td>{{cheque_book.cheque_amount}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

<!--                                                <button class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </button>-->
                                                <a href="" @click.prevent="openModal(cheque_book.id, cheque_book.cheque_type)" data-toggle="modal" data-target="#cheque_book_modal" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i></a>

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
        name: "ListChequeComponent",
        mounted() {
            this.getChequeBook()
            this.$store.dispatch('allBanks')
        },
        computed:{
            get_all_banks(){
                return this.$store.getters.get_banks
            }
        },
        data(){
            return {
                form: new Form({
                    id:'',
                    cheque_type:'',
                    bank_name: '',
                    bank_date: '',
                    cash_date: ''
                }),
                pagination:{
                    current_page: 1,
                },
                cheque_books: '',

            }
        },
        methods:{
            getChequeBook(){
                axios.get('/api/get-all-cheque?page='+this.pagination.current_page)
                    .then(response => {
                        this.cheque_books = response.data.cheque_books.data
                        this.pagination = response.data.cheque_books
                    })
            },
            openModal(id, type){
                this.form.id = id
                this.form.cheque_type = type
            },
            clearCheque(){
                this.form.post('/api/clear-cheque')
                    .then((response) => {
                        this.form.id = ''
                        this.form.cheque_type = ''
                        this.form.bank_name = ''
                        $('#cheque_book_modal').hide();
                        $('.modal-backdrop').remove();
                        this.getChequeBook()
                        Toast.fire({
                            type: 'success',
                            title: 'Cheque Clear successfully'
                        })

                    })
                    .catch((response) => {

                    })
            }


        }
    }
</script>

<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
        height: 25px !important;
        border-radius: 4px !important;
    }
    textarea {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
        height: 25px !important;
        font-size: 11px;
        border-radius: 4px !important;
    }

</style>