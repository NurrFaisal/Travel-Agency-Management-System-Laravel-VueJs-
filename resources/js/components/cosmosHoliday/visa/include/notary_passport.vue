<template>
    <div id="notary_passport" class="tab-pane fade in">
        <h3>Notary By</h3>
        <div class="row">
            <div class="col-xs-12">
                <table class="table  table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Sl.</th>
                        <th  class="center" >Received Date</th>
                        <th  class="center" >Work Date</th>
                        <th  class="center" >Notary Date</th>
                        <th  class="center" >Pax Name</th>
                        <th  class="center" >Net Price</th>
                        <th  class="center" >Price</th>
                        <th  class="center" >Profit</th>
                        <th  class="center" >Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td class="center">1</td>
                        <td class="center">12.08.19</td>
                        <td class="center">14.08.19</td>
                        <td class="center">16.08.19</td>
                        <td class="center">Mr. X</td>
                        <td class="center">1400</td>
                        <td class="center">1600</td>
                        <td class="center">200</td>
                        <td class="center">
                            <div class="btn-group center">
                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </a>
                                <a href="http://demo.iglweb.com/ta/user/visa-register/edit/41" class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </a>
                                <a href="#" onclick="deliver_visa_modal_open('41')" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deliver_visa_modal">
                                    Work
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
        name: "notary_passport"
    }
</script>

<style scoped>

</style>