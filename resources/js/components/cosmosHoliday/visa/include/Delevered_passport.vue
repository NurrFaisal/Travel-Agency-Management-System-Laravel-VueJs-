<template>
    <div id="delivered_passport" class="tab-pane fade in">
        <h3>Delevery To Guest</h3>
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
                        <th  class="center" >Delevery</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(d_visa,index) in delelvered_visas">
                        <td class="center">{{index+1}}</td>
                        <td class="center">{{d_visa.received_date}}</td>
                        <td class="center">{{d_visa.work_date}}</td>
                        <td class="center">{{d_visa.notary_date}}</td>
                        <td class="center">{{d_visa.checked_by_asst_date}}</td>
                        <td class="center">{{d_visa.checked_by_officer_date}}</td>
                        <td class="center">{{d_visa.submit_date}}</td>
                        <td class="center">{{d_visa.collected_date}}</td>
                        <td class="center">{{d_visa.call_and_sms_date}}</td>
                        <td class="center">{{d_visa.delevered_date}}</td>
                        <td class="center">{{d_visa.name}}</td>
                        <td class="center">{{d_visa.net_price}}</td>
                        <td class="center">{{d_visa.price}}</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <router-link to="/edit-visa-delevered-by" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </router-link>
<!--                                <a href="#" onclick="deliver_visa_modal_open('41')" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deliver_visa_modal">-->
<!--                                    Work-->
<!--                                </a>-->
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
        name: "Delevered_passport",
        mounted(){
            this.getAllDelevetedWithPagination();
            this.$store.dispatch("allVisaStaff")
        },
        computed:{
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                delelvered_visas: '',
                form: new Form({
                    id:'',
                    delevered_by:'',
                    delevered_date:'',
                })
            }
        },
        methods:{
            getAllDelevetedWithPagination(){
                axios.get('/api/get-all-delevered-visa')
                    .then(response => {
                        this.delelvered_visas = response.data.delelvered_visa.data

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
                        this.getAllDelevetedWithPagination();
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

</style>