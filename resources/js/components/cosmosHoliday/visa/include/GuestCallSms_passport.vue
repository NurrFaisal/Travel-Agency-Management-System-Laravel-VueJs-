<template>
    <div id="guest_call_sms_passport" class="tab-pane fade in">

        <div class="modal fade" id="deliver_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Collected From Embassy</h4>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addVisaCallAndSms()" method="post">
                            <div class="row">
                                <label for="delevered_by" class="col-sm-5">Deleverd By:</label>
                                <div class="col-sm-7">
                                    <select v-model="form.delevered_by" class="form-control " id="delevered_by" name="delevered_by" required style="width: 95%;">
                                        <option value="">--Select Delevered Person--</option>
                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="delevered_by"></has-error>
                                    <span style="color: red">{{ errors.first('delevered_by') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="delevered_date" class="col-sm-5">Delevered Date:</label>
                                <div class="col-sm-7">
                                    <input type="date" v-model="form.delevered_date" id="delevered_date" name="delevered_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                    <input type="hidden" v-model="form.id" >
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="delevered_date"></has-error>
                                    <span style="color: red">{{ errors.first('delevered_date') }}</span>
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


        <h3>Guest Call & SMS</h3>
        <div class="row">
            <div class="col-xs-12">
                <table class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Sl.</th>
                        <th  class="center" >Received</th>
                        <th  class="center" >Work</th>
                        <th  class="center" >Notary</th>
                        <th  class="center" >Ch: Asst.</th>
                        <th  class="center" >Ch: Officer</th>
                        <th  class="center" >Submitted</th>
                        <th  class="center" >Collected</th>
                        <th  class="center" >Call & SMS</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Profit</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(gcs, index) in gcs_visas">
                        <td class="center">{{index+1}}</td>
                        <td class="center">{{gcs.received_date}}</td>
                        <td class="center">{{gcs.work_date}}</td>
                        <td class="center">{{gcs.notary_date}}</td>
                        <td class="center">{{gcs.checked_by_asst_date}}</td>
                        <td class="center">{{gcs.checked_by_officer_date}}</td>
                        <td class="center">{{gcs.submit_date}}</td>
                        <td class="center">{{gcs.collected_date}}</td>
                        <td class="center">{{gcs.call_and_sms_date}}</td>
                        <td class="center">{{gcs.name}}</td>
                        <td class="center">{{gcs.net_price}}</td>
                        <td class="center">{{gcs.price}}</td>
                        <td class="center">200</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <router-link to="/edit-visa-call-sms-by" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </router-link>
                                <a href="#" @click.prevent="openModalDelevered(gcs.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deliver_visa_modal">
                                    Delevered
                                </a>
                                <a href="#" onclick="visa_invoice_modal_open('41')" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
    export default {
        name: "GuestCallSms_passport",
        mounted(){
            this.getAllGCSWithPagination();
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                gcs_visas: '',
                form: new Form({
                    id:'',
                    delevered_by:'',
                    delevered_date:'',
                })
            }
        },
        methods:{
            getAllGCSWithPagination(){
                axios.get('/api/get-all-gcs-visa')
                    .then(response => {
                        this.gcs_visas = response.data.gcs_visa.data

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            openModalDelevered(id){
                this.form.id = id
            },
            addVisaCallAndSms(){
                this.form.post('/api/add-visa-delevered')
                    .then((response) => {
                        this.form.reset()
                        this.getAllGCSWithPagination();
                        $('#guest_call_and_sms_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Delevered Date and Person Added successfully'
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