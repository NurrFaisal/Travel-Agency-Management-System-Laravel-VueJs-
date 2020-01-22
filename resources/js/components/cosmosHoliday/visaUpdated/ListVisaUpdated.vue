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
                        <router-link to="/visa-update-list">Visa List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input autocomplete="off" class="nav-search-input" id="nav-search-input" placeholder="Search ..."
                                   type="text"/>
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Visa List
                        <div class="card-tools" style="float:right">
                            <router-link class="btn btn-success" to="/new-visa-updated">Add New Visa Updated</router-link>
                        </div>
                        <br/>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-6"></div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li :class="state == 1 ? 'active' : ''"><a data-toggle="tab" href="#received_passport">Received</a></li>
                                    <li :class="state == 2 ? 'active' : ''"><a data-toggle="tab" href="#work_passport">Work and Notary By</a></li>
                                    <!--                                    <li><a data-toggle="tab" href="#notary_passport">Notary By</a></li>-->
                                    <li :class="state == 3 ? 'active' : ''"><a data-toggle="tab" href="#checked_by_asst_passport">Checked By Asst.</a></li>
                                    <li :class="state == 4 ? 'active' : ''"><a data-toggle="tab" href="#checked_by_officer_passport">Checked By Officer</a>
                                    </li>
                                    <li :class="state == 5 ? 'active' : ''"><a data-toggle="tab" href="#submitted_passport">Submitted To Embassy</a></li>
                                    <li :class="state == 6 ? 'active' : ''"><a data-toggle="tab" href="#collected_passport">Collected Form Embassy</a></li>
                                    <li :class="state == 7 ? 'active' : ''"><a data-toggle="tab" href="#guest_call_sms_passport">Guest Call & SMS</a></li>
                                    <li :class="state == 8 ? 'active' : ''"><a data-toggle="tab" href="#delivered_passport">Delivered To Guest</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!--                                    this is receive component area-->
                                    <!--                                    <receivedPassport></receivedPassport>-->

                                    <div id="received_passport" class="tab-pane fade in "  :class="state == 1 ? 'active' : ''">
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
                                                        <th  class="center" >Name</th>
                                                        <th  class="center" >Price</th>
                                                        <th  class="center" >Others Price</th>
                                                        <th  class="center" >Grand</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(r_visa, index) in recieved_visas">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{r_visa.received_date}}</td>
                                                        <td class="center">{{r_visa.guest.name}}</td>
                                                        <td class="center">{{r_visa.total_price}}</td>
                                                        <td class="center">{{r_visa.total_others_price}}</td>
                                                        <td class="center">{{r_visa.grand_total_price}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-received-visa-updated/${r_visa.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="openModal(r_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#submit_visa_modal">
                                                                    Work
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(r_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="r_pagination.last_page > 1"
                                                        :pagination="r_pagination"
                                                        :offset="5"
                                                        @paginate="getAllReceivedWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="work_passport" class="tab-pane fade in"  :class="state == 2 ? 'active' : ''">
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
                                                                    <select v-model="form2.checked_by_asst" class="form-control " id="checked_by_asst" name="checked_by_asst" required style="width: 95%;">
                                                                        <option value="">--Select Checked By Asst--</option>
                                                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form2" field="checked_by_asst"></has-error>
                                                                    <span style="color: red">{{ errors.first('checked_by_asst') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="checked_by_asst_date" class="col-sm-5">Checkted By Asst Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form2.checked_by_asst_date" id="checked_by_asst_date" name="checked_by_asst_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                                    <input type="hidden" v-model="form2.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form2" field="checked_by_asst_date"></has-error>
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
                                                        <th  class="center" >Notary Date</th>
                                                        <th  class="center" >Name</th>
                                                        <th  class="center" >Price</th>
                                                        <th  class="center" >Others Price</th>
                                                        <th  class="center" >Grand</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr v-for="(work, index) in work_visas">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{work.received_date}}</td>
                                                        <td class="center">{{work.work_date}}</td>
                                                        <td class="center">{{work.notary_date}}</td>
                                                        <td class="center">{{work.guest.name}}</td>
                                                        <td class="center">{{work.total_price}}</td>
                                                        <td class="center">{{work.total_others_price}}</td>
                                                        <td class="center">{{work.grand_total_price}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-work-and-notary-visa-update/${work.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#" @click.prevent="openModalwork(work.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#work_visa_modal">
                                                                    Check Asst
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(work.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="w_pagination.last_page > 1"
                                                        :pagination="w_pagination"
                                                        :offset="5"
                                                        @paginate="getAllWorkWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="checked_by_asst_passport" class="tab-pane fade in" :class="state == 3 ? 'active' : ''">
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
                                                                    <select v-model="form3.checked_by_officer" class="form-control " id="checked_by_officer" name="checked_by_officer" required style="width: 95%;">
                                                                        <option value="">--Select Checked By Offier--</option>
                                                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form3" field="checked_by_officer"></has-error>
                                                                    <span style="color: red">{{ errors.first('checked_by_officer') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="checked_by_officer_date" class="col-sm-5">Checked By Asst Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form3.checked_by_officer_date" id="checked_by_officer_date" name="checked_by_officer_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                                    <input type="hidden" v-model="form3.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form3" field="checked_by_officer_date"></has-error>
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
                                                        <th  class="center" >Checked By Asst Date</th>
                                                        <th  class="center" >Name</th>
                                                        <th  class="center" >Price</th>
                                                        <th  class="center" >Others Price</th>
                                                        <th  class="center" >Grand</th>
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
                                                        <td class="center">{{c_asst.guest.name}}</td>
                                                        <td class="center">{{c_asst.total_price}}</td>
                                                        <td class="center">{{c_asst.total_others_price}}</td>
                                                        <td class="center">{{c_asst.grand_total_price}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-checked-by-asst-visa-updated/${c_asst.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#" @click.prevent="openModalCheckedAsst(c_asst.id)"  class="btn btn-xs btn-primary" data-toggle="modal" data-target="#checked_asst_visa_modal">
                                                                    Checked Officer
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(c_asst.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="cba_pagination.last_page > 1"
                                                        :pagination="cba_pagination"
                                                        :offset="5"
                                                        @paginate="getAllCheckedByAsstWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="checked_by_officer_passport" class="tab-pane fade in" :class="state == 4 ? 'active' : ''">

                                        <div class="modal fade" id="checked_officer_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Submit to Embassy</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addVisaSubmit()" method="post">
                                                            <div class="row">
                                                                <label for="submit_by" class="col-sm-5">Submit By:</label>
                                                                <div class="col-sm-7">
                                                                    <select v-model="form4.submit_by" class="form-control " id="submit_by" name="submit_by" required style="width: 95%;">
                                                                        <option value="">--Select Embassy Submit Person--</option>
                                                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="submit_by"></has-error>
                                                                    <span style="color: red">{{ errors.first('submit_by') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="submit_date" class="col-sm-5">Submit Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form4.submit_date" id="submit_date" name="submit_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                                    <input type="hidden" v-model="form4.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="submit_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('submit_date') }}</span>
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



                                        <h3>Checked By Officer</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Received Date</th>
                                                        <th  class="center" >Work Date</th>
                                                        <th  class="center" >Notary Date</th>
                                                        <th  class="center" >Checked By Asst Date</th>
                                                        <th  class="center" >Checked By Officer Date</th>
                                                        <th  class="center" >Pax Name</th>
                                                        <th  class="center" >Price</th>
                                                        <th  class="center" >Grand</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr v-for="(c_officer, index) in checked_by_officer_visas">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{c_officer.received_date}}</td>
                                                        <td class="center">{{c_officer.work_date}}</td>
                                                        <td class="center">{{c_officer.notary_date}}</td>
                                                        <td class="center">{{c_officer.checked_by_asst_date}}</td>
                                                        <td class="center">{{c_officer.checked_by_officer_date}}</td>
                                                        <td class="center">{{c_officer.guest.name}}</td>
                                                        <td class="center">{{c_officer.total_price}}</td>
                                                        <td class="center">{{c_officer.grand_total_price}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-checked-by-officer-visa-updated/${c_officer.id}`"  class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#" @click.prevent="openModalOfficer(c_officer.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#checked_officer_visa_modal">
                                                                    Submit Em:
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(c_officer.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="cbo_pagination.last_page > 1"
                                                        :pagination="cbo_pagination"
                                                        :offset="5"
                                                        @paginate="getAllCheckedByOfficerWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="submitted_passport" class="tab-pane fade in" :class="state == 5 ? 'active' : ''">

                                        <div class="modal fade" id="submit_embassy_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Collected From Embassy</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addVisaCollected()" method="post">
                                                            <div class="row">
                                                                <label for="collected_by" class="col-sm-5">Collected By:</label>
                                                                <div class="col-sm-7">
                                                                    <select v-model="form5.collected_by" class="form-control " id="collected_by" name="collected_by" required style="width: 95%;">
                                                                        <option value="">--Select Collected Person--</option>
                                                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form5" field="collected_by"></has-error>
                                                                    <span style="color: red">{{ errors.first('collected_by') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="collected_date" class="col-sm-5">Collected Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form5.collected_date" id="collected_date" name="collected_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                                    <input type="hidden" v-model="form5.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form5" field="collected_date"></has-error>
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
                                                        <th  class="center" >Received Date</th>
                                                        <th  class="center" >Work Date</th>
                                                        <th  class="center" >Notary Date</th>
                                                        <th  class="center" >Checked By Asst Date</th>
                                                        <th  class="center" >Checked By Officer Date</th>
                                                        <th  class="center" >Submit Date</th>
                                                        <th  class="center" >Name</th>
                                                        <th  class="center" >Grand</th>
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
                                                        <td class="center">{{s_visa.guest.name}}</td>
                                                        <td class="center">{{s_visa.grand_total_price}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-submited-visa-updated/${s_visa.id}`"  class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#" @click.prevent="openModalSubmit(s_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#submit_embassy_visa_modal">
                                                                    Collecte
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(s_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="s_pagination.last_page > 1"
                                                        :pagination="s_pagination"
                                                        :offset="5"
                                                        @paginate="getAllSubmitedWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="collected_passport" class="tab-pane fade in" :class="state == 6 ? 'active' : ''">

                                        <div class="modal fade" id="guest_call_and_sms_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Guest Call and SMS</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addVisaCallAndSms()" method="post">
                                                            <div class="row">
                                                                <label for="call_and_sms_by" class="col-sm-5">GCS By:</label>
                                                                <div class="col-sm-7">
                                                                    <select v-model="form6.call_and_sms_by" class="form-control " id="call_and_sms_by" name="call_and_sms_by" required style="width: 95%;">
                                                                        <option value="">--Select Call and SMS By--</option>
                                                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form6" field="call_and_sms_by"></has-error>
                                                                    <span style="color: red">{{ errors.first('call_and_sms_by') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="call_and_sms_date" class="col-sm-5">GCS Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form6.call_and_sms_date" id="call_and_sms_date" name="call_and_sms_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                                    <input type="hidden" v-model="form6.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form6" field="call_and_sms_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('call_and_sms_date') }}</span>
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


                                        <h3>Collected To Embassy</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Received Date</th>
                                                        <th  class="center" >Work Date</th>
                                                        <th  class="center" >Notary Date</th>
                                                        <th  class="center" >Checked By Asst Date</th>
                                                        <th  class="center" >Checked By Officer Date</th>
                                                        <th  class="center" >Submit Date</th>
                                                        <th  class="center" >Collected Date</th>
                                                        <th  class="center" >Name</th>
                                                        <th  class="center" >Grand</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <tr v-for="(collected,index) in collected_visas">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{collected.received_date}}</td>
                                                        <td class="center">{{collected.work_date}}</td>
                                                        <td class="center">{{collected.notary_date}}</td>
                                                        <td class="center">{{collected.checked_by_asst_date}}</td>
                                                        <td class="center">{{collected.checked_by_officer_date}}</td>
                                                        <td class="center">{{collected.submit_date}}</td>
                                                        <td class="center">{{collected.collected_date}}</td>
                                                        <td class="center">{{collected.guest.name}}</td>
                                                        <td class="center">{{collected.grand_total_price}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-collected-visa-updated/${collected.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#" @click.prevent="openModalCollected(collected.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#guest_call_and_sms_visa_modal">
                                                                    GCS
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(collected.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="c_pagination.last_page > 1"
                                                        :pagination="c_pagination"
                                                        :offset="5"
                                                        @paginate="getAllCollectedWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="guest_call_sms_passport" class="tab-pane fade in" :class="state == 7 ? 'active' : ''">

                                        <div class="modal fade" id="deliver_visa_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Delevered Visa</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addVisaDelevered()" method="post">
                                                            <div class="row">
                                                                <label for="delevered_by" class="col-sm-5">Deleverd By:</label>
                                                                <div class="col-sm-7">
                                                                    <select v-model="form7.delevered_by" class="form-control " id="delevered_by" name="delevered_by" required style="width: 95%;">
                                                                        <option value="">--Select Delevered Person--</option>
                                                                        <option :value="work.id" v-for="work in getAllVisaStaff">{{work.first_name+' '+work.last_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form7" field="delevered_by"></has-error>
                                                                    <span style="color: red">{{ errors.first('delevered_by') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="delevered_date" class="col-sm-5">Delevered Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form7.delevered_date" id="delevered_date" name="delevered_date" class="form-control"  style="max-width: 95%;" value="" required="">
                                                                    <input type="hidden" v-model="form7.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form7" field="delevered_date"></has-error>
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
                                                        <th  class="center" >Received Date</th>
                                                        <th  class="center" >Work Date</th>
                                                        <th  class="center" >Notary Date</th>
                                                        <th  class="center" >Checked By Asst Date</th>
                                                        <th  class="center" >Checked By Officer Date</th>
                                                        <th  class="center" >Submit Date</th>
                                                        <th  class="center" >Collected Date</th>
                                                        <th  class="center" >GCS Date</th>
                                                        <th  class="center" >Name</th>
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
                                                        <td class="center">{{gcs.guest.name}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'"  :to="`/edit-call-and-sms-visa-updated/${gcs.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#" @click.prevent="openModalDelevered(gcs.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deliver_visa_modal">
                                                                    Delevered
                                                                </a>
                                                                <a @click.prevent="downLoadInvoice(gcs.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="g_pagination.last_page > 1"
                                                        :pagination="g_pagination"
                                                        :offset="5"
                                                        @paginate="getAllGCSWithPagination()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="delivered_passport" class="tab-pane fade in" :class="state == 8 ? 'active' : ''">
                                        <h3>Delevery To Guest</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Received Date</th>
                                                        <th  class="center" >Work Date</th>
                                                        <th  class="center" >Notary Date</th>
                                                        <th  class="center" >Checked By Asst Date</th>
                                                        <th  class="center" >Checked By Officer Date</th>
                                                        <th  class="center" >Submit Date</th>
                                                        <th  class="center" >Collected Date</th>
                                                        <th  class="center" >GCS Date</th>
                                                        <th  class="center" >Delevered Date</th>
                                                        <th  class="center" >Name</th>
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
                                                        <td class="center">{{d_visa.guest.name}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin'" :to="`/edit-delivery-visa-updated/${d_visa.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <!--                                <a href="#" onclick="deliver_visa_modal_open('41')" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deliver_visa_modal">-->
                                                                <!--                                    Work-->
                                                                <!--                                </a>-->
                                                                <a @click.prevent="downLoadInvoice(d_visa.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
                                                                    Invoice
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="d_pagination.last_page > 1"
                                                        :pagination="d_pagination"
                                                        :offset="5"
                                                        @paginate="getAllDelevetedWithPagination ()"
                                            ></pagination>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row --
                        <-- PAGE CONTENT ENDS -->
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
        name: "ListVisaUpdated",
        mounted() {
            this.isLoading = true
            this.$store.dispatch("allVisaStaff")
            this.getAllReceivedWithPagination();
            this.getAllWorkWithPagination();
            this.getAllCheckedByAsstWithPagination();
            this.getAllCheckedByOfficerWithPagination();
            this.getAllSubmitedWithPagination();
            this.getAllCollectedWithPagination();
            this.getAllGCSWithPagination();
            this.getAllDelevetedWithPagination();

            this.sessionSet()

        },
        components: {
            Loading
        },
        computed: {
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                searchText:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',
                state: 1,

                r_pagination:{
                    current_page: 1,
                },
                w_pagination:{
                    current_page: 1,
                },
                cba_pagination:{
                    current_page: 1,
                },
                cbo_pagination:{
                    current_page: 1,
                },
                s_pagination:{
                    current_page: 1,
                },
                c_pagination:{
                    current_page: 1,
                },
                g_pagination:{
                    current_page: 1,
                },
                d_pagination:{
                    current_page: 1,
                },


                recieved_visas: '',
                work_visas: '',
                checked_by_asst_visas: '',
                checked_by_officer_visas: '',
                submit_visas: '',
                collected_visas: '',
                gcs_visas: '',
                delelvered_visas: '',
                form: new Form({
                    id:'',
                    work_by:'',
                    work_date:'',
                    notary_by: '',
                    notary_date:''
                }),
                form2: new Form({
                    id:'',
                    checked_by_asst:'',
                    checked_by_asst_date:'',
                }),
                form3: new Form({
                    id:'',
                    checked_by_officer:'',
                    checked_by_officer_date:'',
                }),
                form4: new Form({
                    id:'',
                    submit_by:'',
                    submit_date:'',
                }),
                form5: new Form({
                    id:'',
                    collected_by:'',
                    collected_date:'',
                }),
                form6: new Form({
                    id:'',
                    call_and_sms_by:'',
                    call_and_sms_date:'',
                }),
                form7: new Form({
                    id:'',
                    delevered_by:'',
                    delevered_date:'',
                })
            }
        },
        methods: {

            sessionSet(){
                if(this.$session.exists()){
                    this.state = this.$session.get('state')
                    this.$session.destroy()
                }

            },

            //All Get Data Start
            getAllReceivedWithPagination(){
                axios.get('/api/get-all-recieved-visa-updated?page='+this.r_pagination.current_page)
                    .then(response => {
                        this.recieved_visas = response.data.recieved_visa.data
                        this.r_pagination = response.data.recieved_visa
                        this.user_type = response.data.user_type
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllWorkWithPagination(){
                axios.get('/api/get-all-work-visa-updated?page='+this.w_pagination.current_page)
                    .then(response => {
                        this.work_visas = response.data.work_visa.data
                        this.w_pagination = response.data.work_visa
                        this.user_type = response.data.user_type
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllCheckedByAsstWithPagination(){
                axios.get('/api/get-all-checked-by-asst-visa-updated?page='+this.cba_pagination.current_page)
                    .then(response => {
                        this.checked_by_asst_visas = response.data.checked_by_asst_visa.data
                        this.cba_pagination = response.data.checked_by_asst_visa
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllCheckedByOfficerWithPagination(){
                axios.get('/api/get-all-checked-by-offcer-visa-updated?page='+this.cbo_pagination.current_page)
                    .then(response => {
                        this.checked_by_officer_visas = response.data.checked_officer_visa.data
                        this.cbo_pagination = response.data.checked_officer_visa

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllSubmitedWithPagination(){
                axios.get('/api/get-all-submit-visa-updated?page='+this.s_pagination.current_page)
                    .then(response => {
                        this.submit_visas = response.data.submit_visa.data
                        this.s_pagination = response.data.submit_visa

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllCollectedWithPagination(){
                axios.get('/api/get-all-collected-visa-updated?page='+this.c_pagination.current_page)
                    .then(response => {
                        this.collected_visas = response.data.collected_visa.data
                        this.c_pagination = response.data.collected_visa

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllGCSWithPagination(){
                axios.get('/api/get-all-gcs-visa-updated?page='+this.g_pagination.current_page)
                    .then(response => {
                        this.gcs_visas = response.data.gcs_visa.data
                        this.g_pagination = response.data.gcs_visa

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllDelevetedWithPagination(){
                axios.get('/api/get-all-delevered-visa-updated?page='+this.d_pagination.current_page)
                    .then(response => {
                        this.delelvered_visas = response.data.delelvered_visa.data
                        this.d_pagination = response.data.delelvered_visa
                        this.isLoading = false

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            doAjax() {
                this.isLoading = false
            },
            // All Get Data End

            // All Modal Start
            openModal(id){
                this.form.id = id
            },
            openModalwork(id){
                this.form2.id = id
            },
            openModalCheckedAsst(id){
                this.form3.id = id
            },
            openModalOfficer(id){
                this.form4.id = id
            },
            openModalSubmit(id){
                this.form5.id = id
            },
            openModalCollected(id){
                this.form6.id = id
            },
            openModalDelevered(id){
                this.form7.id = id
            },
            // All Modal End

            // All Post Form Start
            addVisaWorkAndNotary(){
                this.form.post('/api/add-visa-updated-work-and-notary')
                    .then((response) => {
                        this.form.reset()
                        this.getAllReceivedWithPagination()
                        this.getAllWorkWithPagination();
                        $('#submit_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Work and Notary Date and Persons successfully Added'
                        })
                    })
            },
            addVisaCheckedByAsst(){
                this.form2.post('/api/add-checked-asst-by-visa-updated')
                    .then((response) => {
                        this.form2.reset()
                        this.getAllWorkWithPagination();
                        this.getAllCheckedByAsstWithPagination();
                        $('#work_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Checked Asst By Date and Person successfully Added'
                        })
                    })
            },
            addVisaCheckedByOfficer(){
                this.form3.post('/api/add-checked-by-officer-updated')
                    .then((response) => {
                        this.form3.reset()
                        this.getAllCheckedByAsstWithPagination();
                        this.getAllCheckedByOfficerWithPagination();
                        $('#checked_asst_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Checked By Officer Date and Person Added successfully'
                        })
                    })
            },
            addVisaSubmit(){
                this.form4.post('/api/add-visa-submit-updated')
                    .then((response) => {
                        this.form4.reset()
                        this.getAllCheckedByOfficerWithPagination();
                        this.getAllSubmitedWithPagination();
                        $('#checked_officer_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Submit Date and Person Added successfully'
                        })
                    })
            },
            addVisaCollected(){
                this.form5.post('/api/add-visa-collected-updated')
                    .then((response) => {
                        this.form5.reset()
                        this.getAllSubmitedWithPagination();
                        this.getAllCollectedWithPagination();
                        $('#submit_embassy_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Collected Date and Person Added successfully'
                        })
                    })
            },
            addVisaCallAndSms(){
                this.form6.post('/api/add-visa-guest-call-and-sms-updated')
                    .then((response) => {
                        this.form6.reset()
                        this.getAllCollectedWithPagination();
                        this.getAllGCSWithPagination();
                        $('#guest_call_and_sms_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Call Guest Call And Sms Date and Person Added successfully'
                        })
                    })
            },
            addVisaDelevered(){
                this.form7.post('/api/add-visa-delevered-updated')
                    .then((response) => {
                        this.form7.reset()
                        this.getAllGCSWithPagination();
                        this.getAllDelevetedWithPagination();
                        $('#deliver_visa_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Delevered Date and Person Added successfully'
                        })
                    })
            },
            downLoadInvoice(id){
                this.isLoading = true
                axios.get('/invoice-print-visa/'+id)
                    .then(responese => {
                        this.doAjax()
                    })
            }


            // All Post Form End


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
