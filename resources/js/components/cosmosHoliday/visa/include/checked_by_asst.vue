<template>
    <div id="checked_by_asst_passport" class="tab-pane fade in">
        <div class="modal fade" id="checked_asst_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Submit to Checked Officer</h4>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addVisaCheckedByOfficer()" method="post">
                            <div class="row">
                                <label for="checked_by_officer" class="col-sm-5">Checked By Officer:</label>
                                <div class="col-sm-7">
                                    <select v-model="form.checked_by_officer" class="form-control " id="checked_by_officer" name="checked_by_officer" required style="width: 95%;">
                                        <option value="">--Select Checked By Offier--</option>
                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="checked_by_officer"></has-error>
                                    <span style="color: red">{{ errors.first('checked_by_officer') }}</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label for="checked_by_officer_date" class="col-sm-5">Checked By Asst Date:</label>
                                <div class="col-sm-7">
                                    <input type="date" v-model="form.checked_by_officer_date" id="checked_by_officer_date" name="checked_by_officer_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                    <input type="hidden" v-model="form.id" >
                                </div>
                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                    <has-error style="color:red" :form="form" field="checked_by_officer_date"></has-error>
                                    <span style="color: red">{{ errors.first('checked_by_officer_date') }}</span>
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
        <h3>Checked By Asst.</h3>
        <div class="row">
            <div class="col-xs-12">
                <table class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Sl.</th>
                        <th  class="center" >Received Date</th>
                        <th  class="center" >Work Date</th>
                        <th  class="center" >Notary Date</th>
                        <th  class="center" >Checked Asst. Date</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Profit</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(c_asst, index ) in checked_by_asst_visas">
                        <td class="center">{{index+1}}</td>
                        <td class="center">{{c_asst.received_date}}</td>
                        <td class="center">{{c_asst.work_date}}</td>
                        <td class="center">{{c_asst.notary_date}}</td>
                        <td class="center">{{c_asst.checked_by_asst_date}}</td>
                        <td class="center">{{c_asst.name}}</td>
                        <td class="center">1400</td>
                        <td class="center">1600</td>
                        <td class="center">200</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <router-link to="/edit-visa-checked-by-asst" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </router-link>
                                <a href="#" @click.prevent="openModalCheckedAsst(c_asst.id)"  class="btn btn-xs btn-primary" data-toggle="modal" data-target="#checked_asst_visa_modal">
                                    Checked Officer
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
        name: "checked_by_asst",
        mounted(){
            this.getAllCheckedByAsstWithPagination();
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                checked_by_asst_visas: '',
                form: new Form({
                    id:'',
                    checked_by_officer:'',
                    checked_by_officer_date:'',
                })
            }
        },
        methods:{
            getAllCheckedByAsstWithPagination(){
                axios.get('/api/get-all-checked-by-asst-visa')
                    .then(response => {
                        this.checked_by_asst_visas = response.data.checked_by_asst_visa.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            openModalCheckedAsst(id){
                this.form.id = id
            },
            addVisaCheckedByOfficer(){
                console.log(this.form)
                this.form.post('/api/add-checked-by-officer')
                    .then((response) => {
                        this.form.reset()
                        this.getAllCheckedByAsstWithPagination();
                        $('#checked_asst_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Checked By Officer Date and Person Added successfully'
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