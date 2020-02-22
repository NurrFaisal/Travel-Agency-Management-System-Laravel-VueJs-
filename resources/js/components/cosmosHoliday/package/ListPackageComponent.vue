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
                        <router-link to="/package-list">Package List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchText()" id="nav-search-input" v-model="search_text" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Package List
                        <div class="card-tools" style="float:right">
                            <router-link class="btn btn-success" to="/new-package">Add New Package</router-link>
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
                                    <li @click="packageSession(1)" :class="p_state == 1 ? 'active' : ''"><a data-toggle="tab" href="#guest_query">Guest Query</a></li>
                                    <li @click="packageSession(2)" :class="p_state == 2 ? 'active' : ''"><a data-toggle="tab" href="#follow_up">Follow Up To Suplier</a></li>
                                    <li @click="packageSession(3)" :class="p_state == 3 ? 'active' : ''"><a data-toggle="tab" href="#icsd">Tour Plan Submit To Guest</a></li>
                                    <li @click="packageSession(4)" :class="p_state == 4 ? 'active' : ''"><a data-toggle="tab" href="#guest_reaction_tab">Follow Up To Guest</a></li>
                                    <li @click="packageSession(5)" :class="p_state == 5 ? 'active' : ''"><a data-toggle="tab" href="#guest_confirm_date_tab">Guest Confirmation</a></li>
<!--                                    <li :class="p_state == 6 ? 'active' : ''"><a data-toggle="tab" href="#cmts">VISA Update</a></li>-->
                                    <li @click="packageSession(6)" :class="p_state == 6 ? 'active' : ''"><a data-toggle="tab" href="#visa_update">Visa Update</a></li>
                                    <li @click="packageSession(7)" :class="p_state == 7 ? 'active' : ''"><a data-toggle="tab" href="#drfdp">Ticket</a></li>


                                    <li  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'" @click="packageSession(8)" :class="p_state == 8 ? 'active' : ''"><a data-toggle="tab" href="#package_net_price">Net Price</a></li>


                                    <li @click="packageSession(9)" :class="p_state == 9 ? 'active' : ''"><a data-toggle="tab" href="#pddin">Document Ready</a></li>
<!--                                    <li :class="p_state == 9 ? 'active' : ''"><a data-toggle="tab" href="#dcbg">Document </a></li>-->
                                    <li @click="packageSession(10)" :class="p_state == 10 ? 'active' : ''"><a data-toggle="tab" href="#date_of_journey">Delivered</a></li>
                                </ul>
                                <div class="tab-content">
<!--                                    package Query Start-->
                                    <div id="guest_query" class="tab-pane fade in" :class="p_state == 1 ? 'active' : ''">
                                        <div class="modal fade" id="package_query_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Follow Up</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addPackageFollowUp()" method="post">
                                                            <br/>
                                                            <div class="row">
                                                                <label class="col-sm-5">Follow Up to Suplier:</label>
                                                                <div class="col-sm-7">
                                                                    <span class="block input-icon input-icon-right">
                                                            <div class="row">
                                                                <div class=" col-md-6">
                                                                    <label>
                                                                        <input class="ace input-sm" name="flw_up_to_suplier" type="radio" v-model="form.flw_up_to_suplier" value="0">
                                                                        <span class="lbl"> Not Confirm</span>
                                                                    </label>
                                                                </div>
                                                                <div class=" col-md-6">
                                                                    <label>
                                                                        <input class="ace input-sm" name="flw_up_to_suplier" type="radio" v-model="form.flw_up_to_suplier" value="1">
                                                                        <span class="lbl"> Confirm</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </span>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="flw_up_to_suplier"></has-error>
                                                                    <span style="color: red">{{ errors.first('flw_up_to_suplier') }}</span>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <div class="row">
                                                                <label for="flw_up_to_suplier_date" class="col-sm-5">Flw up sup:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form.flw_up_to_suplier_date" id="flw_up_to_suplier_date" name="flw_up_to_suplier_date" class="form-control"  style="max-width: 95%;" required="">
                                                                    <input type="hidden" v-model="form.id">
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="flw_up_to_suplier_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('flw_up_to_suplier_date') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="note" class="col-sm-5">Note:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" v-model="form.note" id="note" name="note" class="form-control"  style="max-width: 95%;"  required="">
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form" field="note"></has-error>
                                                                    <span style="color: red">{{ errors.first('note') }}</span>
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
                                        <h3>Guest Query</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table id="simple-table" class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(pq, index) in package_query">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{pq.guestt.name}}</td>
                                                        <td class="center">{{pq.guestt.phone_number}}</td>
                                                        <td class="center">{{pq.country}}</td>
                                                        <td class="center">{{pq.destination}}</td>
                                                        <td class="center">{{pq.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-package-query/${pq.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="openPackageQueryModal(pq.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_query_modal">
                                                                    Flw-Up-Suplier
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="pq_pagination.last_page > 1"
                                                        :pagination="pq_pagination"
                                                        :offset="5"
                                                        @paginate="getPackageQuery()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    package Query End-->
<!--                                    package Follow up Start-->
                                    <div id="follow_up" class="tab-pane fade in" :class="p_state == 2 ? 'active' : ''">
                                        <div class="modal fade" id="package_follow_up_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Package Itinary Cost Submit Date</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addItineryCostSubmitDate()" method="post">
                                                            <br/>
                                                            <div class="row">
                                                                <label for="iti_submit_to_guest_date" class="col-sm-5">Tour Plan Submit To Guest Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form2.iti_submit_to_guest_date" id="iti_submit_to_guest_date" name="iti_submit_to_guest_date" class="form-control"  style="max-width: 95%;" required="">
                                                                    <input type="hidden" v-model="form2.id">
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form2" field="iti_submit_to_guest_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('iti_submit_to_guest_date') }}</span>
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

                                        <h3>Package Follow Up To Suplier</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(pfu, index) in package_follow_up">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{pfu.guestt.name}}</td>
                                                        <td class="center">{{pfu.guestt.phone_number}}</td>
                                                        <td class="center">{{pfu.country}}</td>
                                                        <td class="center">{{pfu.destination}}</td>
                                                        <td class="center">{{pfu.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-package-follow-up/${pfu.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="openPackageFollowUpModal(pfu.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_follow_up_modal">
                                                                    TPSG Date
                                                                </a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="pf_pagination.last_page > 1"
                                                        :pagination="pf_pagination"
                                                        :offset="5"
                                                        @paginate="getAllPackageFollowUp()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    package Followup End-->
<!--                                   Tour Plan Submit to Guest Start-->
                                    <div id="icsd" class="tab-pane fade in" :class="p_state == 3 ? 'active' : ''">
                                        <div class="modal fade" id="package_icsd_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Add Guest Reaction</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addGuestReaction()" method="post">
                                                            <div class="row">
                                                                <label for="flw_up_to_guest_date" class="col-sm-5">Guest Follow up Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form3.flw_up_to_guest_date" id="flw_up_to_guest_date" name="flw_up_to_guest_date" class="form-control"  style="max-width: 95%;" value="" required>
                                                                    <input type="hidden" v-model="form3.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form3" field="flw_up_to_guest_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('flw_up_to_guest_date') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="guest_reaction" class="col-sm-5">Guest Reaction:</label>
                                                                <div class="col-sm-7">
                                                                <select v-model="form3.guest_reaction" class="form-control " id="guest_reaction" name="guest_reaction" required style="width: 95%;">
                                                                    <option value="">--Select Guest Reaction--</option>
                                                                    <option value="1">Excellent</option>
                                                                    <option value="2">Good</option>
                                                                    <option value="3">Medium</option>
                                                                    <option value="4">Poor</option>
                                                                </select>
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form3" field="guest_reaction"></has-error>
                                                                    <span style="color: red">{{ errors.first('guest_reaction') }}</span>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <div class="row">
                                                                <label class="col-sm-5">Guest Follow up Note:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" v-model="form3.note"  name="note" class="form-control"  style="max-width: 95%;" value="" required>
                                                                    <input type="hidden" v-model="form3.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form3" field="note"></has-error>
                                                                    <span style="color: red">{{ errors.first('note') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class=" col-md-6">
                                                                    <label>
                                                                        <input class="ace input-sm" name="ftg_confimation" type="radio" v-model="form3.ftg_confimation" value="0">
                                                                        <span class="lbl"> Not Confirm</span>
                                                                    </label>
                                                                </div>
                                                                <div class=" col-md-6">
                                                                    <label>
                                                                        <input class="ace input-sm" name="ftg_confimation" type="radio" v-model="form3.ftg_confimation" value="1">
                                                                        <span class="lbl"> Confirm</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <br/>

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
                                        <h3>Tour Plan Submit To Guest</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(icsd, index ) in itinerary_cost_submit_date">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{icsd.guestt.name}}</td>
                                                        <td class="center">{{icsd.guestt.phone_number}}</td>
                                                        <td class="center">{{icsd.country}}</td>
                                                        <td class="center">{{icsd.destination}}</td>
                                                        <td class="center">{{icsd.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-itinerary-cost-submit-date/${icsd.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="icsd_modal(icsd.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_icsd_modal">
                                                                    Guest Reaction
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="icsd_pagination.last_page > 1"
                                                        :pagination="icsd_pagination"
                                                        :offset="5"
                                                        @paginate="itineraryCostSubmitDate()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    Tour Plan Submit to Guest End-->
<!--                                    Follow up to Guest Start-->
                                    <div id="guest_reaction_tab" class="tab-pane fade in" :class="p_state == 4 ? 'active' : ''">
                                        <h3>Follow Up To Guest</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(gr, index ) in guest_reaction">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{gr.guestt.name}}</td>
                                                        <td class="center">{{gr.guestt.phone_number}}</td>
                                                        <td class="center">{{gr.country}}</td>
                                                        <td class="center">{{gr.destination}}</td>
                                                        <td class="center">{{gr.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-guest-reaction/${gr.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <router-link  :to="`/add-guest-confirmation/${gr.id}`" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#guest_reaction_modal">
                                                                    Guest Confirmation
                                                                </router-link>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- /.span -->
                                        </div>
                                        <div class="justify-content-center">
                                            <pagination v-if="gr_pagination.last_page > 1"
                                                        :pagination="gr_pagination"
                                                        :offset="5"
                                                        @paginate="getAllGuestReactionPackage()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    Follow up to Guest End-->
<!--                                    Guest Confirmation Start-->
                                    <div id="guest_confirm_date_tab" class="tab-pane fade in" :class="p_state == 5 ? 'active' : ''">
                                        <h3>Guest Confirmation</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(gcd, index ) in guest_confirm_date">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{gcd.guestt.name}}</td>
                                                        <td class="center">{{gcd.guestt.phone_number}}</td>
                                                        <td class="center">{{gcd.country}}</td>
                                                        <td class="center">{{gcd.destination}}</td>
                                                        <td class="center">{{gcd.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-guest-confirmation-date/${gcd.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <router-link :to="`/add-package-visa-update-new/${gcd.id}`" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#cmts_modal">
                                                                    VISA Update
                                                                </router-link>
                                                                <a  @click.prevent="downLoadInvoice(gcd.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
                                            <pagination v-if="gcd_pagination.last_page > 1"
                                                        :pagination="gcd_pagination"
                                                        :offset="5"
                                                        @paginate="getAllGuestConfirmDate()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    Guest Confirmation End-->
<!--                                 Package Visa Update Start-->
                                    <div id="visa_update" class="tab-pane fade in" :class="p_state == 6 ? 'active' : ''">

                                        <div class="modal fade" id="DRFDP_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Package Ticket Info</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addTicket()" method="post">
                                                            <div class="row">
                                                                <label for="ticket_date" class="col-sm-5">Ticket Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form7.ticket_date" id="ticket_date" name="ticket_date" class="form-control"  style="max-width: 95%;" required="">
                                                                    <input type="hidden" v-model="form7.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form7" field="ticket_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('ticket_date') }}</span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="ticket_type" class="col-sm-5">Ticket By:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" v-model="form7.ticket_type" id="ticket_type" name="ticket_type" class="form-control"  style="max-width: 95%;"  required="">
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form7" field="ticket_type"></has-error>
                                                                    <span style="color: red">{{ errors.first('ticket_type') }}</span>
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
                                        <h3>Visa Update</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(vu, index ) in package_visa_update">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{vu.guestt.name}}</td>
                                                        <td class="center">{{vu.guestt.phone_number}}</td>
                                                        <td class="center">{{vu.country}}</td>
                                                        <td class="center">{{vu.destination}}</td>
                                                        <td class="center">{{vu.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'" :to="`/edit-package-visa-update/${vu.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="openDRFDPModal(vu.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#DRFDP_modal">
                                                                    Ticket
                                                                </a>
                                                                <a  @click.prevent="downLoadInvoice(vu.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
                                            <pagination v-if="vu_pagination.last_page > 1"
                                                        :pagination="vu_pagination"
                                                        :offset="5"
                                                        @paginate="getAllPackageVisaUpdate()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    package Visa Update End-->
<!--                                    package Ticket Start-->
                                    <div id="drfdp" class="tab-pane fade in" :class="p_state == 7 ? 'active' : ''">
                                        <h3>Package Ticket Info</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(dp, index ) in pacakge_ticket">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{dp.guestt.name}}</td>
                                                        <td class="center">{{dp.guestt.phone_number}}</td>
                                                        <td class="center">{{dp.country}}</td>
                                                        <td class="center">{{dp.destination}}</td>
                                                        <td class="center">{{dp.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-drfdp/${dp.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <router-link :to="`/package-net-price/${dp.id}`" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#payment_modal">
                                                                    Net Price
                                                                </router-link>
                                                                <a @click.prevent="downLoadInvoice(dp.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
                                            <pagination v-if="dp_pagination.last_page > 1"
                                                        :pagination="dp_pagination"
                                                        :offset="5"
                                                        @paginate="getAllTicket ()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    Package Ticket End-->
<!--                                    package Net Price Start-->
                                    <div id="package_net_price" class="tab-pane fade in" :class="p_state == 8 ? 'active' : ''">
                                        <div class="modal fade" id="document_ready_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Add Document Ready Date</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addDocumentReady()" method="post">
                                                            <div class="row">
                                                                <label for="document_ready_date" class="col-sm-5">Document Ready Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form8.document_ready_date" id="document_ready_date" name="document_ready_date" class="form-control"  style="max-width: 95%;" required="">
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form8" field="document_ready_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('document_ready_date') }}</span>
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

                                        <h3>Package Net Price</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(net_price, index ) in net_prices">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{net_price.guestt.name}}</td>
                                                        <td class="center">{{net_price.guestt.phone_number}}</td>
                                                        <td class="center">{{net_price.country}}</td>
                                                        <td class="center">{{net_price.destination}}</td>
                                                        <td class="center">{{net_price.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-package-net-price/${net_price.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="openDocumentReadyModal(net_price.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#document_ready_modal">
                                                                    Document Ready
                                                                </a>
                                                                <a href="#" @click.prevent="downLoadInvoice(net_price.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
                                            <pagination v-if="pddin_pagination.last_page > 1"
                                                        :pagination="pddin_pagination"
                                                        :offset="5"
                                                        @paginate="getAllDocumentReady()"
                                            ></pagination>
                                        </div>
                                    </div>
<!--                                    package End Price End-->
                                    <div id="pddin" class="tab-pane fade in" :class="p_state == 9 ? 'active' : ''">
                                        <div class="modal fade" id="document_collection_modal" aria-hidden="true" role="dialog"  tabindex="-1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">Add Document Delivery Date</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form @submit.prevent="addDocumentDelivery()" method="post">
                                                            <div class="row">
                                                                <label for="document_delivery_date" class="col-sm-5">Document Delivery Date:</label>
                                                                <div class="col-sm-7">
                                                                    <input type="date" v-model="form9.document_delivery_date" id="document_delivery_date" name="document_delivery_date" class="form-control"  style="max-width: 95%;" required="">
                                                                    <input type="hidden" v-model="form9.id" >
                                                                </div>
                                                                <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                    <has-error style="color:red" :form="form9" field="document_delivery_date"></has-error>
                                                                    <span style="color: red">{{ errors.first('document_delivery_date') }}</span>
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
                                        <h3>Package Document Ready</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(pddin, index ) in payment_done_due_invoice_no">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{pddin.guestt.name}}</td>
                                                        <td class="center">{{pddin.guestt.phone_number}}</td>
                                                        <td class="center">{{pddin.country}}</td>
                                                        <td class="center">{{pddin.destination}}</td>
                                                        <td class="center">{{pddin.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link  v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-pddin/${pddin.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
                                                                <a href="#"  @click.prevent="openDocumentCollectionModal(pddin.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#document_collection_modal">
                                                                    Delivery
                                                                </a>
                                                                <a href="#" @click.prevent="downLoadInvoice(pddin.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
                                            <pagination v-if="pddin_pagination.last_page > 1"
                                                        :pagination="pddin_pagination"
                                                        :offset="5"
                                                        @paginate="getAllDocumentReady()"
                                            ></pagination>
                                        </div>
                                    </div>
                                    <div id="date_of_journey" class="tab-pane fade in" :class="p_state == 10 ? 'active' : ''">
                                        <h3>Package Document Delivered List</h3>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <table id="simple-table" class="table  table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th class="center">Sl.</th>
                                                        <th  class="center" >Guest Name</th>
                                                        <th  class="center" >Phone Number</th>
                                                        <th  class="center" >Country</th>
                                                        <th  class="center" >Destination</th>
                                                        <th  class="center" >Duration</th>
                                                        <th  class="center" >Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(doj, index) in date_of_journey">
                                                        <td class="center">{{index+1}}</td>
                                                        <td class="center">{{doj.guestt.name}}</td>
                                                        <td class="center">{{doj.guestt.phone_number}}</td>
                                                        <td class="center">{{doj.country}}</td>
                                                        <td class="center">{{doj.destination}}</td>
                                                        <td class="center">{{doj.duration}}</td>
                                                        <td class="center">
                                                            <div class="btn-group center">
<!--                                                                <a href="http://demo.iglweb.com/ta/user/visa-register/show/41" class="btn btn-xs btn-success">-->
<!--                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                                </a>-->
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/view-package/${doj.id}`" class="btn btn-xs btn-success">
                                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                                </router-link>
                                                                <router-link v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'"  :to="`/edit-date-of-journey/${doj.id}`" class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </router-link>
<!--                                                                <a href="#"  @click.prevent="openPackageQueryModal(doj.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#package_query_modal">-->
<!--                                                                    Follow Up-->
<!--                                                                </a>-->
                                                                <a href="#" @click.prevent="downLoadInvoice(doj.id)" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#visa_invoice_modal">
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
                                            <pagination v-if="doj_pagination.last_page > 1"
                                                        :pagination="doj_pagination"
                                                        :offset="5"
                                                        @paginate="getAllDateOfJourney ()"
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
        name: "ListPackageComponent",
        components: {
            Loading
        },
        mounted() {
            this.$store.dispatch("allVisaStaff")
            this.getPackageQuery();
            // this.getAllDocumentCollectionByGuest();
            this.packageSessionStart();
            this.packageSession(this.p_state);

        },
        computed: {
            getAllVisaStaff(){
                return this.$store.getters.get_visa_staff
            }
        },
        data(){
            return {
                user_type:'',
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                p_state: 1,

                pq_pagination:{
                    current_page: 1,
                },
                pf_pagination:{
                    current_page: 1,
                },
                icsd_pagination:{
                    current_page: 1,
                },
                gr_pagination:{
                    current_page: 1,
                },
                gcd_pagination:{
                    current_page: 1,
                },
                vu_pagination:{
                    current_page: 1,
                },
                dp_pagination:{
                    current_page: 1,
                },
                net_pagination:{
                    current_page: 1,
                },
                pddin_pagination:{
                    current_page: 1,
                },
                dcbg_pagination:{
                    current_page: 1,
                },
                doj_pagination:{
                    current_page: 1,
                },
                ins_pagination:{
                    current_page: 1,
                },
                package_query: '',
                package_follow_up: '',
                itinerary_cost_submit_date: '',
                guest_reaction: '',
                guest_confirm_date: '',
                package_visa_update: '',
                pacakge_ticket: '',
                net_prices: '',
                payment_done_due_invoice_no: '',
                date_of_journey: '',
                invoice: '',

                form: new Form({
                    id:'',
                    flw_up_to_suplier:'0',
                    flw_up_to_suplier_date:'',
                    note:'',
                }),
                form2: new Form({
                    id:'',
                    iti_submit_to_guest_date:'',
                }),
                form3: new Form({
                    id:'',
                    flw_up_to_guest_date:'',
                    guest_reaction:'',
                    note:'',
                    ftg_confimation:'0',
                }),
                form6: new Form({
                    id:'',
                    openDRFDPModal:'',
                    visa_update_note:'',
                }),
                form7: new Form({
                    id:'',
                    ticket_date:'',
                    ticket_type:'',
                }),
                form8: new Form({
                    id:'',
                    document_ready_date:'',
                }),
                form9: new Form({
                    id:'',
                    document_delivery_date:'',

                }),

            }
        },
        methods: {
            packageSession(state){
               this.isLoading = true
                this.p_state = state
                if(this.search_text == ''){
                    if(state == 1){
                        this.getPackageQuery();
                    }
                    if(state == 2){
                        this.getAllPackageFollowUp();
                    }
                    if(state == 3){
                        this.itineraryCostSubmitDate();
                    }
                    if(state == 4){
                        this.getAllGuestReactionPackage();
                    }
                    if(state == 5){
                        this.getAllGuestConfirmDate();
                    }
                    if(state == 6){
                        this.getAllPackageVisaUpdate();
                    }
                    if(state == 7){
                        this.getAllTicket();
                    }
                    if(state == 8){
                        this.getAllPackageNetPrice();
                    }if(state == 9){
                        this.getAllDocumentReady();
                    }if(state == 10){
                        this.getAllDateOfJourney();
                    }
                }
                this.doAjax()
            },

            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllSearchPackage(this.search_text)
                }else{
                    this.packageSession(this.p_state);
                }
            },1000),
            getAllSearchPackage(search_text){
                axios.get('/api/get-all-package-search/'+search_text)
                    .then(response => {
                        console.log(response.data.package_count)
                        if(response.data.package_count == 0){
                            if(response.data.package != null){
                                this.p_state = response.data.package[0].state
                                if(this.p_state == 1){
                                    this.package_query = response.data.package
                                }
                                if(this.p_state == 2){
                                    this.package_follow_up = response.data.package
                                }
                                if(this.p_state == 3){
                                    this.itinerary_cost_submit_date = response.data.package
                                }
                                if(this.p_state == 4){
                                    this.guest_reaction = response.data.package
                                }
                                if(this.p_state == 5){
                                    this.guest_confirm_date = response.data.package
                                }
                                if(this.p_state == 6){
                                    this.package_visa_update = response.data.package
                                }
                                if(this.p_state == 7){
                                    this.pacakge_ticket = response.data.package
                                }
                                if(this.p_state == 8){
                                    this.net_prices = response.data.package
                                }
                                if(this.p_state == 9){
                                    this.payment_done_due_invoice_no = response.data.package
                                }
                                if(this.p_state == 10){
                                    this.date_of_journey = response.data.package
                                }
                            }
                        }else{
                            console.log('else')
                            this.package_query = response.data.package_query.data
                            this.pq_pagination = response.data.package_query

                            this.package_follow_up = response.data.package_follow_up.data
                            this.pf_pagination = response.data.package_follow_up

                            this.itinerary_cost_submit_date = response.data.itinerary_cost_submit_date.data
                            this.icsd_pagination = response.data.itinerary_cost_submit_date

                            this.guest_reaction = response.data.guest_reaction.data
                            this.gr_pagination = response.data.guest_reaction

                            this.guest_confirm_date = response.data.guest_confirm_date.data
                            this.gcd_pagination = response.data.guest_confirm_date

                            this.package_visa_update = response.data.package_visa_update.data
                            this.vu_pagination = response.data.package_visa_update

                            this.pacakge_ticket = response.data.pacakge_ticket.data
                            this.dp_pagination = response.data.pacakge_ticket

                            this.net_prices = response.data.net_prices.data
                            this.net_pagination = response.data.net_prices

                            this.payment_done_due_invoice_no = response.data.drfdp.data
                            this.pddin_pagination = response.data.drfdp

                            this.date_of_journey = response.data.date_of_journey.data
                            this.doj_pagination = response.data.date_of_journey


                        }

                        this.isLoading = false
                    })

            },

            packageSessionStart(){
                if(this.$session.exists()){
                    this.p_state = this.$session.get('p_state')
                    this.$session.destroy()
                }
            },

            //All Get Data Start
            getPackageQuery(){
                axios.get('/api/get-all-package-query?page='+this.pq_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.package_query = response.data.package_query.data
                        this.pq_pagination = response.data.package_query
                    })
            },
            getAllPackageFollowUp(){
                axios.get('/api/get-all-package-follow-up?page='+this.pf_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.package_follow_up = response.data.package_follow_up.data
                        this.pf_pagination = response.data.package_follow_up
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            itineraryCostSubmitDate(){
                axios.get('/api/get-all-itinerary-cost-submit-date?page='+this.icsd_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.itinerary_cost_submit_date = response.data.itinerary_cost_submit_date.data
                        this.icsd_pagination = response.data.itinerary_cost_submit_date
                    })

            },
            getAllGuestReactionPackage(){
                axios.get('/api/get-all-package-guest-reaction?page='+this.gr_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.guest_reaction = response.data.guest_reaction.data
                        this.gr_pagination = response.data.guest_reaction

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllGuestConfirmDate(){
                axios.get('/api/get-all-package-confirm-date?page='+this.gcd_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.guest_confirm_date = response.data.guest_confirm_date.data
                        this.gcd_pagination = response.data.guest_confirm_date

                    })
            },
            getAllPackageVisaUpdate(){
                axios.get('/api/get-all-package-visa-update?page='+this.vu_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.package_visa_update = response.data.package_visa_update.data
                        this.vu_pagination = response.data.package_visa_update

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllTicket(){
                axios.get('/api/get-all-package-ticket?page='+this.dp_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.pacakge_ticket = response.data.pacakge_ticket.data
                        this.dp_pagination = response.data.pacakge_ticket


                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllPackageNetPrice(){
                axios.get('/api/get-all-package-net-price?page='+this.pddin_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.net_prices = response.data.net_prices.data
                        this.net_pagination = response.data.net_prices

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllDocumentReady(){
                axios.get('/api/get-all-document-ready?page='+this.pddin_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.payment_done_due_invoice_no = response.data.drfdp.data
                        this.pddin_pagination = response.data.drfdp

                    })
                    .catch(e => {
                        console.log(e)
                    })
            },
            getAllDateOfJourney(){
                axios.get('/api/get-all-date-of-journey?page='+this.doj_pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.date_of_journey = response.data.date_of_journey.data
                        this.doj_pagination = response.data.date_of_journey

                    })

            },
            // All Get Data End

            // All Modal Start
            openPackageQueryModal(id){
                this.form.id = id
            },
            openPackageFollowUpModal(id){
                this.form2.id = id
            },
            icsd_modal(id){
                this.form3.id = id
            },
            openCmtsModal(id){
                this.form5.id = id
            },
            openVisaUpdateModal(id){
                this.form6.id = id
            },
            openDRFDPModal(id){
                this.form7.id = id
            },
            openDocumentReadyModal(id){
                this.form8.id = id
            },
            openDocumentCollectionModal(id){
                this.form9.id = id
            },
            openDateOfJourneyModal(id){
                this.form10.id = id
            },


            // All Modal End

            // All Post Form Start
            addPackageFollowUp(){
                this.form.post('/api/add-package-follow-up')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',1)
                        this.form.reset()
                        this.packageSession(1)
                        // this.getPackageQuery()
                        // this.getAllPackageFollowUp();
                        $('#package_query_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Package Follow Up To Suplier Added'
                        })
                    })
            },
            addItineryCostSubmitDate(){
                this.form2.post('/api/add-itinery-cost-submit-date')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',2)
                        this.form2.reset()
                        this.packageSession(2)
                        // this.getAllPackageFollowUp();
                        // this.itineraryCostSubmitDate();
                        $('#package_follow_up_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Tour Plan Submit To Guest Successfully'
                        })
                    })
            },
            addGuestReaction(){
                this.form3.post('/api/add-guest-reaction')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',3)
                        this.form3.reset()
                        this.packageSession(3)
                        // this.itineraryCostSubmitDate();
                        // this.getAllGuestReactionPackage();
                        $('#package_icsd_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Guest Follow up Added Successfully'
                        })
                    })
            },
            addGuestConfirmDate(){
                this.form4.post('/api/add-guest-confirm-date')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',4)
                        this.form4.reset()
                        this.packageSession(4)
                        // this.getAllGuestReactionPackage();
                        // this.getAllGuestConfirmDate()
                        $('#guest_reaction_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Guest Confirmation Date Added Successfully'
                        })
                    })
            },
            addConfirmMailToSuplier(){
                this.form5.post('/api/add-confirm_mail_to_suplier')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',5)
                        this.form5.reset()
                        this.packageSession(5)
                        // this.getAllConfirmMailToSuplier()
                        // this.getAllGuestConfirmDate()
                        $('#cmts_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Guest Confirmation Date Added Successfully'
                        })
                    })
            },
            addVisaUpdate(){
                this.form6.post('/api/add-visa-update-date')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',6)
                        this.form6.reset()
                        this.packageSession(6)
                        // this.getAllConfirmMailToSuplier()
                        // this.getAllPackageVisaUpdate()
                        $('#visa_update_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Visa Update Date Added Successfully'
                        })
                    })
            },
            addTicket(){
                this.form7.post('/api/add-package-ticket-date')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',6)
                        this.form6.reset()
                        this.packageSession(6)
                        // this.getAllTicket();
                        // this.getAllPackageVisaUpdate()
                        $('#DRFDP_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Package Ticket Date Added Successfully'
                        })
                    })
            },
            addDocumentReady(){
                this.form8.post('/api/add-document-ready')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',8)
                        this.form8.reset()
                        this.packageSession(8)
                        // this.getAllDocumentReady()
                        // this.getAllPackageNetPrice();
                        $('#document_ready_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Document Ready Date Added Successfully'
                        })
                    })
            },
            addDocumentDelivery(){
                this.form9.post('/api/add-document-delivery')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',9)
                        this.form9.reset()
                        this.packageSession(9)
                        // this.getAllDateOfJourney()
                        // this.getAllDocumentReady()
                        $('#document_collection_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Document Delivery Date Added Successfully'
                        })
                    })
            },
            addDateOfJourney(){
                this.form10.post('/api/add-date-of-journey')
                    .then((response) => {
                        this.form10.reset()
                        this.getAllDocumentCollectionByGuest()
                        this.getAllDateOfJourney();
                        $('#date_of_journey_modal').modal("hide");
                        $('.modal-backdrop').remove();
                        Toast.fire({
                            type: 'success',
                            title: 'Cofirm Date Of Journey Added Successfully'
                        })
                    })
            },
            downLoadInvoice(id){
                this.isLoading = true
                axios.get('/invoice-print-package-count/'+id)
                    .then(responese => {
                       this.downLoadInvoiceCount(id)
                    })
            },
            downLoadInvoiceCount(id){
                axios.get('/invoice-print-package/'+id)
                    .then(responese => {
                        this.doAjax()
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },


            // All Post Form End


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
