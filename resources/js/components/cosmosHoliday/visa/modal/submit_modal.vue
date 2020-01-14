<template>
    <div class="modal fade" id="submit_visa_modal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Submit Passport</h4>
                </div>
                <div class="modal-body">
                    <form action="http://demo.iglweb.com/ta/user/visa-register/pp-submit" method="post">
                        <input type="hidden" name="_token" value="IuxxEhjyufN0pFlcGT87y4RAuj4iv4CPUtam4mOo">                    <input type="hidden" name="visa_no" id="visa_no_for_submit">
                        <div class="row">
                            <label for="btb_visa_agency" class="col-sm-5">Reference:</label>
                            <div class="col-sm-7">
                                <select class="chosen-select form-control " id="" name="btb_visa_agency" data-placeholder=" -- " required="" style="width: 100%; display: none;">
                                    <option value=""> </option>
                                    <option value="6">
                                        Surplus Holidays | 01725181100
                                    </option>
                                    <option value="7">
                                        A2Z Travels | 01789562356
                                    </option>
                                </select><div class="chosen-container chosen-container-single" style="width: 0px;" title=""><a class="chosen-single chosen-default"><span> -- </span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="net_price" class="col-sm-5">Net Price:</label>
                            <div class="col-sm-7">
                                <input type="number" id="net_price" name="net_price" min="0" class="form-control" style="max-width: 95%;" value="" required="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label for="submit_date" class="col-sm-5">Submit Date:</label>
                            <div class="col-sm-7">
                                <input type="text" id="submit_date" name="submit_date" class="form-control submit_date" data-date-format="yyyy-mm-dd" autocomplete="off" style="max-width: 95%;" value="" required="">
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
</template>

<script>
    export default {
        name: "submit_modal"
    }
</script>

<style scoped>

</style>