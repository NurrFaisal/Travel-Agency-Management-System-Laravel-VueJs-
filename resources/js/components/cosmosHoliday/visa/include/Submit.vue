<template>
    <div id="submitted_passport" class="tab-pane fade in">

        <div class="modal fade" id="submit_embassy_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Collected From Embassy</h4>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addVisaSubmit()" method="post">
                            <div class="row">
                                <label for="collected_by" class="col-sm-5">Collected By:</label>
                                <div class="col-sm-7">
                                    <select v-model="form.collected_by" class="form-control " id="collected_by" name="collected_by" required style="width: 95%;">
                                        <option value="">--Select Collected Person--</option>
                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="collected_by"></has-error>
                                    <span style="color: red">{{ errors.first('collected_by') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="collected_date" class="col-sm-5">Collected Date:</label>
                                <div class="col-sm-7">
                                    <input type="date" v-model="form.collected_date" id="collected_date" name="collected_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                    <input type="hidden" v-model="form.id" >
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="collected_date"></has-error>
                                    <span style="color: red">{{ errors.first('collected_date') }}</span>
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

        <h3>Submitted To Embassy</h3>
        <div class="row">
            <div class="col-xs-12">
                <table class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Sl.</th>
                        <th  class="center" >Received</th>
                        <th  class="center" >Work</th>
                        <th  class="center" >Notary</th>
                        <th  class="center" >Checked Asst.</th>
                        <th  class="center" >Checked Officer</th>
                        <th  class="center" >Submitted</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Profit</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(s_visa, index) in submit_visas">
                        <td class="center">{{index+1}}</td>
                        <td class="center">{{s_visa.received_date}}</td>
                        <td class="center">{{s_visa.work_date}}</td>
                        <td class="center">{{s_visa.notary_date}}</td>
                        <td class="center">{{s_visa.checked_by_asst_date}}</td>
                        <td class="center">{{s_visa.checked_by_officer_date}}</td>
                        <td class="center">{{s_visa.submit_date}}</td>
                        <td class="center">{{s_visa.name}}</td>
                        <td class="center">{{s_visa.net_price}}</td>
                        <td class="center">{{s_visa.price}}</td>
                        <td class="center">200</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <router-link to="/edit-visa-submit-by" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </router-link>
                                <a href="#" @click.prevent="openModalSubmit(s_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#submit_embassy_visa_modal">
                                    Collecte
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
        name: "Submit",
        mounted(){
            this.getAllSubmitedWithPagination();
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                submit_visas: '',
                form: new Form({
                    id:'',
                    collected_by:'',
                    collected_date:'',
                })
            }
        },
        methods:{
            getAllSubmitedWithPagination(){
                axios.get('/api/get-all-submit-visa')
                    .then(response => {
                        this.submit_visas = response.data.submit_visa.data

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            openModalSubmit(id){
                this.form.id = id
            },
            addVisaSubmit(){
                this.form.post('/api/add-visa-collected')
                    .then((response) => {
                        this.form.reset()
                        this.getAllSubmitedWithPagination();
                        $('#submit_embassy_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Collected Date and Person Added successfully'
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