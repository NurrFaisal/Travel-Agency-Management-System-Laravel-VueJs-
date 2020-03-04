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
                        <router-link to="/contra-list">Contra List</router-link>
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
                        Contra List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-contra" class="btn btn-success">Add Contra</router-link>
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
                                        <th class="center">Contra Type</th>
                                        <th>Contra Date</th>
                                        <th>Contra No.</th>
                                        <th>Bank Name</th>
                                        <th>Narration</th>
                                        <th>Contra Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(contra, index) in  contras">
                                        <td class="center">{{index+1}}</td>
                                        <td v-if="contra.contra_type == 1">Cash To Bank</td>
                                        <td v-if="contra.contra_type == 2">Bank To Cash</td>
                                        <td v-if="contra.contra_type == 3">Bank To Bank</td>
                                        <td>{{contra.contra_date | timeformate}}</td>
                                        <td>C-{{contra.id}}</td>
                                        <td v-if="contra.bank_name != null">{{contra.bank.bank_name}}</td>
                                        <td v-if="contra.from_bank_name != null">{{contra.from_bank.bank_name}} To {{contra.to_bank.bank_name}}</td>
                                        <td>{{contra.narration}}</td>
                                        <td>{{contra.contra_amount}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </button>
                                                <router-link :to="`/edit-contra/${contra.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>
                                                <a @click.prevent="downLoadInvoice(contra.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                    Voucher
                                                </a>

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
                                            @paginate="getContra()"
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
        name: "ListContraComponent",
        mounted() {
            this.isLoading = true
            this.getContra()
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

                pagination:{
                    current_page: 1,
                },
                contras: '',
            }
        },
        methods:{
            getContra(){
                axios.get('/api/get-all-contra?page='+this.pagination.current_page)
                    .then(response => {
                        this.contras = response.data.contras.data
                        this.pagination = response.data.contras
                        this.doAjax();
                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllSearchContra(this.search_text)
                }else{
                    this.getContra();
                }
            },1000),
            getAllSearchContra(search_text){
                axios.get('/api/get-all-contra-search/'+search_text+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.contras = response.data.contras.data
                        this.pagination = response.data.contras
                        this.isLoading = false
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
            downLoadInvoice(id){
                this.isLoading = true
                axios.get('/invoice-print-contra-voucher/'+id, {responseType: 'blob'})
                    .then(response => {
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', 'contra.pdf'); //or any other extension
                        document.body.appendChild(link);
                        link.click();
                        this.doAjax()
                    })
            }
        }
    }
</script>

<style scoped>

</style>
