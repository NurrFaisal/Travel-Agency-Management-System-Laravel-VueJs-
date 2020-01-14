<template>
    <div id="work_passport" class="tab-pane fade in">
        <div class="modal fade" id="work_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Submit to Checked Asst</h4>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addVisaCheckedByAsst()" method="post">
                            <div class="row">
                                <label for="checked_by_asst" class="col-sm-5">Checked By Asst:</label>
                                <div class="col-sm-7">
                                    <select v-model="form.checked_by_asst" class="form-control " id="checked_by_asst" name="checked_by_asst" required style="width: 95%;">
                                        <option value="">--Select Checked By Asst--</option>
                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="checked_by_asst"></has-error>
                                    <span style="color: red">{{ errors.first('checked_by_asst') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="checked_by_asst_date" class="col-sm-5">Checkted By Asst Date:</label>
                                <div class="col-sm-7">
                                    <input type="date" v-model="form.checked_by_asst_date" id="checked_by_asst_date" name="checked_by_asst_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                    <input type="hidden" v-model="form.id" >
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="checked_by_asst_date"></has-error>
                                    <span style="color: red">{{ errors.first('checked_by_asst_date') }}</span>
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

        <h3>Worked By</h3>
        <div class="row">
            <div class="col-xs-12">
                <table class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Sl.</th>
                        <th  class="center" >Received Date</th>
                        <th  class="center" >Work Date</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Profit</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(work, index) in work_visas">
                        <td class="center">{{index+1}}</td>
                        <td class="center">{{work.received_date}}</td>
                        <td class="center">{{work.work_date}}</td>
                        <td class="center">{{work.name}}</td>
                        <td class="center">{{work.net_price}}</td>
                        <td class="center">{{work.price}}</td>
                        <td class="center">200</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <router-link to="/edit-visa-work-and-notary" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </router-link>
                                <a href="#" @click.prevent="openModalwork(work.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#work_visa_modal">
                                    Check Asst
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
        name: "work_passport",
        mounted(){
            this.getAllWorkWithPagination();
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                work_visas: '',
                form: new Form({
                    id:'',
                    checked_by_asst:'',
                    checked_by_asst_date:'',
                })
            }
        },
        methods:{
            getAllWorkWithPagination(){
                axios.get('/api/get-all-work-visa')
                    .then(response => {
                        console.log(response.data)
                        this.work_visas = response.data.work_visa.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            openModalwork(id){
                this.form.id = id
            },
            addVisaCheckedByAsst(){
                this.form.post('/api/add-checked-asst-by')
                    .then((response) => {
                        this.form.reset()
                        this.getAllWorkWithPagination();
                        $('#work_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Checked Asst By Date and Person Added successfully'
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