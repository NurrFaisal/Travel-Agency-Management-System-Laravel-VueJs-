<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Tables</a>
                    </li>
                    <li class="active">Simple &amp; Dynamic</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input autocomplete="off" class="nav-search-input" id="nav-search-input" placeholder="Search ..." type="text"/>
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="space-6"></div>
                            <div class="vspace-12-sm"></div>
                            <div class="">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h5 class="widget-title">Edit Guest Title</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/guest-title-list" class="btn btn-success">Guest List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <form @submit.prevent="updateAirTicketRefund()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="refund_date">
                                                        Refund Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.refund_date" :class="{ 'is-invalid': form.errors.has('refund_date') }"   class="col-xs-12 col-sm-8" id="refund_date" name="refund_date"  required="" type="date">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="refund_date"></has-error>
                                                        <span style="color: red">{{ errors.first('refund_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="amount">
                                                        Amount<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input v-validate="'required'" v-model="form.amount" :class="{ 'is-invalid': form.errors.has('amount') }"   class="col-xs-12 col-sm-8" id="amount" name="amount"  required="" type="number">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="amount"></has-error>
                                                        <span style="color: red">{{ errors.first('amount') }}</span>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <button class="btn" type="reset">
                                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                                            Reset
                                                        </button>

                                                        &nbsp; &nbsp; &nbsp;
                                                        <button class="btn btn-info" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditAirTicketRefund",
        mounted(){
            axios.get(`/api/edit-air-ticket-refund/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.air_ticket_refund)
                })
        },
        data(){
            return{
                form: new Form({
                    id: "",
                    ticket_id: "",
                    refund_date: "",
                    amount:""
                })
            }

        },
        methods:{
            updateAirTicketRefund(){
                this.form.post('/api/update-air-ticket-refund')
                    .then((respose) => {
                        this.form.refund_date = ''
                        this.form.amount = ''
                        this.form.id = ''
                        this.$router.push('/air-ticket-refund-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Air Ticket Refund Updated successfully'
                        })
                    })
                    .catch((respose) => {

                    })
            }
        }
    }
</script>

<style scoped>
    input {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }
    textarea {
        background-color: rgb(223, 240, 216) !important;
        color: rgb(0, 0, 0) !important;
    }

    select {
        background-color: #dff0d8 !important;
        color: #000 !important;
    }
</style>
