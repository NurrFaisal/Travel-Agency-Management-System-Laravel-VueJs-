<template>
    <div id="received_passport" class="tab-pane fade in active">
        <div class="modal fade" id="submit_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Submit to Work And Notary</h4>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addVisaWorkAndNotary()" method="post">
                            <div class="row">
                                <label for="work_by" class="col-sm-5">Work By:</label>
                                <div class="col-sm-7">
                                    <select v-model="form.work_by" class="form-control " id="work_by" name="work_by" required style="width: 95%;">
                                        <option value="">--Select Work By--</option>
                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="work_by"></has-error>
                                    <span style="color: red">{{ errors.first('work_by') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="work_date" class="col-sm-5">Work Date:</label>
                                <div class="col-sm-7">
                                    <input type="date" v-model="form.work_date" id="work_date" name="work_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="work_date"></has-error>
                                    <span style="color: red">{{ errors.first('work_date') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="notary_by" class="col-sm-5">Notary By:</label>
                                <div class="col-sm-7">
                                    <select v-model="form.notary_by" class="form-control " id="notary_by" name="notary_by" style="width: 95%;">
                                        <option value="">--Select Notary By--</option>
                                        <option :value="notary.id" v-for="notary in getAllVisaStaff">{{notary.first_name+' '+notary.last_name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="notary_by"></has-error>
                                    <span style="color: red">{{ errors.first('notary_by') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="notary_date" class="col-sm-5">Notary Date:</label>
                                <div class="col-sm-7">
                                    <input type="hidden" id="id" name="id" v-model="form.id"  style="max-width: 95%;" required="">
                                    <input v-model="form.notary_date" type="date" id="notary_date" name="notary_date" class="form-control" style="max-width: 95%;" value="" required="">
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="notary_date"></has-error>
                                    <span style="color: red">{{ errors.first('notary_date') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-5 text-right"></div>
                                <div class="col-sm-5">
                                    <input type="submit" name="" class="button" style="background-color: #d3d3d380 !important;" value="Submit">
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
        <h3>Received Passport</h3>
        <div class="row">
            <div class="col-xs-12">
                <table id="simple-table" class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Sl.</th>
                        <th  class="center" >Received Date</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Profit</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(r_visa, index) in recieved_visas">
                        <td class="center">{{index+1}}</td>
                        <td class="center">{{r_visa.received_date}}</td>
                        <td class="center">{{r_visa.name}}</td>
                        <td class="center">{{r_visa.net_price}}</td>
                        <td class="center">{{r_visa.price}}</td>
                        <td class="center">200</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <router-link  to="/edit-visa/:id" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </router-link>
                                <a href="#"  @click.prevent="openModal(r_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#submit_visa_modal">
                                    Work
                                </a>
                                <a href="#" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                    Invoice
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- /.span -->
        </div>
    </div>
</template>

<script>
    import Work_passport from "./work_passport";
    export default {
        name: "received_passport",
        components: {Work_passport,},
        mounted(){
            this.getAllReceivedWithPagination();
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                recieved_visas: '',
                form: new Form({
                    id:'',
                    work_by:'',
                    work_date:'',
                    notary_by: '',
                    notary_date:''
                })
            }
        },
        methods:{
            getAllReceivedWithPagination(){
                axios.get('/api/get-all-recieved-visa')
                    .then(response => {
                        this.recieved_visas = response.data.recieved_visa.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            openModal(id){
                this.form.id = id
            },
            addVisaWorkAndNotary(){
               this.form.post('/api/add-visa-work-and-notary')
                   .then((response) => {
                       this.form.reset()
                       this.getAllReceivedWithPagination()
                       $('#submit_visa_modal').modal("hide");
                       $('.modal-backdrop').remove();
                       Toast.fire({
                           type: 'success',
                           title: 'Work and Notary Date and Person Added successfully'
                       })
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