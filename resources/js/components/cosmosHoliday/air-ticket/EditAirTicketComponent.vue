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
                        <router-link to="/edit-visa">Edit Air Ticket</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="space-6"></div>
                            <div class="vspace-12-sm"></div>
                            <div class="">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h5 class="widget-title">Update Air-Ticket</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/air-ticket-list" class="btn btn-success">Air Ticket List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updateAirTicket()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="destination">
                                                                Destination <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.destination" :class="{ 'is-invalid': form.errors.has('destination') }"   class="col-xs-12 col-sm-12" id="destination" name="destination" placeholder="Enter Full Travel Destination" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="destination"></has-error>
                                                            <span style="color: red">{{ errors.first('destination') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-for="(employee, index) in form.empolyees" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteEmpolyee(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <h4 style="margin-left: 20px;"> Air Lines Information</h4>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="issue_date">
                                                                    Issue Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="employee.issue_date" :class="{ 'is-invalid': form.errors.has('issue_date') }"   class="col-xs-12 col-sm-12" id="issue_date" name="issue_date"  required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="issue_date"></has-error>
                                                                <span style="color: red">{{ errors.first('issue_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="departure_date">
                                                                    Departure Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="employee.departure_date" :class="{ 'is-invalid': form.errors.has('departure_date') }"   class="col-xs-12 col-sm-12" id="departure_date" name="departure_date" required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="departure_date"></has-error>
                                                                <span style="color: red">{{ errors.first('departure_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="return_date">
                                                                    Return Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="employee.return_date" :class="{ 'is-invalid': form.errors.has('return_date') }"   class="col-xs-12 col-sm-12" id="return_date" name="return_date"  required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="return_date"></has-error>
                                                                <span style="color: red">{{ errors.first('return_date') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="air_lines">
                                                                    Air Lines<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                               <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('air_lines') }" v-model="employee.air_lines" id="air_lines" name="air_lines" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Airline--</option>
                                                                    <option :value="al.id" v-for="al in getAllAirLine " >{{al.name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="air_lines"></has-error>
                                                                <span style="color: red">{{ errors.first('air_lines') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="pnr">
                                                                    PNR<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="employee.pnr" :class="{ 'is-invalid': form.errors.has('pnr') }"   class="col-xs-12 col-sm-12" id="pnr" name="pnr" placeholder="Enter PNR Number" required="" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="pnr"></has-error>
                                                                <span style="color: red">{{ errors.first('pnr') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="sector">
                                                                    Sector<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="employee.sector" :class="{ 'is-invalid': form.errors.has('sector') }"   class="col-xs-12 col-sm-12" id="sector" name="sector" placeholder="Enter Sector" required="" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="sector"></has-error>
                                                                <span style="color: red">{{ errors.first('sector') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="net_price">
                                                                    Net Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="sumNetPrice()" v-validate="'required'" v-model="employee.net_price" :class="{ 'is-invalid': form.errors.has('net_price') }"   class="col-xs-12 col-sm-12" id="net_price" name="net_price" placeholder="Enter Net Price" required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="net_price"></has-error>
                                                                <span style="color: red">{{ errors.first('net_price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="price">
                                                                    Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPrice()" v-validate="'required'" v-model="employee.price" :class="{ 'is-invalid': form.errors.has('price') }"   class="col-xs-12 col-sm-12" id="price" name="price" placeholder="Enter Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="price"></has-error>
                                                                <span style="color: red">{{ errors.first('price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="suplier">
                                                                    Suplier<span class="text-danger">*</span> :
                                                                </label>
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('suplier') }" v-model="employee.suplier" id="suplier" name="suplier" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Suplier--</option>
                                                                    <option :value="suplier.id" v-for="suplier in supliers " >{{suplier.name}}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                                <span style="color: red">{{ errors.first('suplier') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNew" @click.prevent="addNew()">add</button>
                                                    </div>
                                                </div>

                                                <div v-for="(pax, index) in form.paxs" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deletePax(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <h4 style="margin-left: 20px;"> Pax Information</h4>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="pax_title">
                                                                    Title<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                    <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('pax_title') }" v-model="pax.pax_title" id="pax_title" name="pax_title" class="col-xs-12 col-sm-12" >
                                                                        <option value="">--Select Title--</option>
                                                                        <option value="1">Mr.</option>
                                                                        <option value="2">Mrs.</option>
                                                                        <option value="3">Miss</option>
                                                                        <option value="4">Mstr</option>
                                                                        <option value="5">Ms</option>
                                                                    </select>
                                                                </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="pax_title"></has-error>
                                                                <span style="color: red">{{ errors.first('pax_title') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="name">
                                                                    Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="pax.name" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Enter pax name"   class="col-xs-12 col-sm-12" id="name" name="name" required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="name"></has-error>
                                                                <span style="color: red">{{ errors.first('name') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="date_of_birth">
                                                                    Date Of Birth<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="pax.date_of_birth" :class="{ 'is-invalid': form.errors.has('date_of_birth') }"   class="col-xs-12 col-sm-12" id="date_of_birth" name="date_of_birth" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="date_of_birth"></has-error>
                                                                <span style="color: red">{{ errors.first('date_of_birth') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="gender">
                                                                    Gender<span class="text-danger">*</span> :
                                                                </label>
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('gender') }" v-model="pax.gender" id="gender" name="gender" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Gender--</option>
                                                                    <option value="1">Male</option>
                                                                    <option value="2">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="gender"></has-error>
                                                                <span style="color: red">{{ errors.first('gender') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="phone_number">
                                                                    Phone Number<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-model="pax.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }" placeholder="Enter pax phone number"  class="col-xs-12 col-sm-12" id="phone_number" name="phone_number"  type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                                <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="passport_number">
                                                                    Passport Number<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="pax.passport_number" :class="{ 'is-invalid': form.errors.has('passport_number') }"  placeholder="Enter pax passport number"  class="col-xs-12 col-sm-12" id="passport_number" name="passport_number"  required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="passport_number"></has-error>
                                                                <span style="color: red">{{ errors.first('passport_number') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="pp_issue_date">
                                                                    Passport Issue Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="pax.pp_issue_date" :class="{ 'is-invalid': form.errors.has('pp_issue_date') }"   class="col-xs-12 col-sm-12" id="pp_issue_date" name="pp_issue_date" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="pp_issue_date"></has-error>
                                                                <span style="color: red">{{ errors.first('pp_issue_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="pp_expire_date">
                                                                    Passport Expire Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="pax.pp_expire_date" :class="{ 'is-invalid': form.errors.has('pp_expire_date') }"   class="col-xs-12 col-sm-12" id="pp_expire_date" name="pp_expire_date" required="" type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="pp_expire_date"></has-error>
                                                                <span style="color: red">{{ errors.first('pp_expire_date') }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNew" @click.prevent="addNewPax()">add</button>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Adult</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_qty">
                                                                Adult Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" @keyup="adultChange()" v-model="form.adult_qty" :class="{ 'is-invalid': form.errors.has('adult_qty') }"   class="col-xs-12 col-sm-12" id="adult_qty" name="adult_qty" placeholder="Qty" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_price">
                                                                Adult Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" @keyup="adultChange()" v-model="form.adult_price" :class="{ 'is-invalid': form.errors.has('adult_price') }"   class="col-xs-12 col-sm-12" id="adult_price" name="adult_price" placeholder="Adult Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_price"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_total_price">
                                                                Adult Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.adult_total_price" :class="{ 'is-invalid': form.errors.has('adult_total_price') }"   class="col-xs-12 col-sm-12" id="adult_total_price" name="adult_total_price" placeholder="Adult Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Child</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_qty">
                                                                Child Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="childChange()" v-model="form.child_qty"  :class="{ 'is-invalid': form.errors.has('child_qty') }"   class="col-xs-12 col-sm-12" id="child_qty" name="child_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('child_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_price">
                                                                Child Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="childChange()" v-model="form.child_price"  :class="{ 'is-invalid': form.errors.has('child_price') }"   class="col-xs-12 col-sm-12" id="child_price" name="child_price" placeholder="Child Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_price"></has-error>
                                                            <span style="color: red">{{ errors.first('child_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_total_price">
                                                                Child Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.child_total_price"  :class="{ 'is-invalid': form.errors.has('child_total_price') }"   class="col-xs-12 col-sm-12" id="child_total_price" name="child_total_price" placeholder="Child Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('child_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Infant</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="infantChange()" v-model="form.infant_qty"   :class="{ 'is-invalid': form.errors.has('infant_qty') }"   class="col-xs-12 col-sm-12" id="infant_qty" name="infant_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_price">
                                                                Infant Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="infantChange()" v-model="form.infant_price" :class="{ 'is-invalid': form.errors.has('infant_price') }"   class="col-xs-12 col-sm-12" id="infant_price" name="infant_price" placeholder="Infant Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_price"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_total_price">
                                                                Infant Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.infant_total_price"  :class="{ 'is-invalid': form.errors.has('infant_total_price') }"   class="col-xs-12 col-sm-12" id="infant_total_price" name="infant_total_price" placeholder="Child Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">S.S.R</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ssr_qty">
                                                                SSR Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="ssrChange()" v-model="form.ssr_qty"  :class="{ 'is-invalid': form.errors.has('ssr_qty') }"   class="col-xs-12 col-sm-12" id="ssr_qty" name="ssr_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ssr_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('ssr_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ssr_price">
                                                                SSR Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="ssrChange()"  v-model="form.ssr_price"  :class="{ 'is-invalid': form.errors.has('ssr_price') }"   class="col-xs-12 col-sm-12" id="ssr_price" name="ssr_price" placeholder="SSR Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ssr_price"></has-error>
                                                            <span style="color: red">{{ errors.first('ssr_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ssr_total_price">
                                                                SSR Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.ssr_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('ssr_total_price') }"   class="col-xs-12 col-sm-12" id="ssr_total_price" name="ssr_total_price" placeholder="SSR Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ssr_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('ssr_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Service</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="service_amount">
                                                                Service Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input   @keyup="serviceChange()" v-model="form.service_amount"  :class="{ 'is-invalid': form.errors.has('service_amount') }"   class="col-xs-12 col-sm-12" id="service_amount" name="service_amount" placeholder="Enter Service Amount" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="service_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('service_amount') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_amount">
                                                                Total Amount<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_amount" v-validate="'required | confirmed'"  :class="{ 'is-invalid': form.errors.has('total_amount') }"   class="col-xs-12 col-sm-12" id="total_amount" name="total_amount" placeholder="Total Amount" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_amount"></has-error>
                                                            <span style="color: red">{{ errors.first('total_amount') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group ">

                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_net_price">
                                                                Total Net Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.total_net_price" :class="{ 'is-invalid': form.errors.has('total_net_price') }"   class="col-xs-12 col-sm-12" id="total_net_price" name="total_net_price" placeholder="Enter Total Net Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_net_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_net_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required | target:total_amount'" v-model="form.total_price" :class="{ 'is-invalid': form.errors.has('total_price') }"   class="col-xs-12 col-sm-12" id="total_price" name="total_price" placeholder="Enter Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label>
                                                                Selling To<span class="text-danger">*</span> :
                                                                <router-link to="/new-guest">New Guest</router-link>
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                 <GuestAutoComplate :shouldReset="true" :title="this.name+' '+this.phone_number" @change="onchange"  :items="guests" filterby="phone_number" @Selected="customerSelected"/>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="selling_to"></has-error>
                                                            <span style="color: red">{{ errors.first('selling_to') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="note">
                                                                Note <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.note" :class="{ 'is-invalid': form.errors.has('note') }"   class="col-xs-12 col-sm-12" id="note" name="note" placeholder="Enter some note" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="note"></has-error>
                                                            <span style="color: red">{{ errors.first('note') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="journey_date">
                                                                Journey Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.journey_date" :class="{ 'is-invalid': form.errors.has('journey_date') }"   class="col-xs-12 col-sm-12" id="journey_date" name="journey_date"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="journey_date"></has-error>
                                                            <span style="color: red">{{ errors.first('journey_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="return_date1">
                                                                Return Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.return_date" :class="{ 'is-invalid': form.errors.has('return_date') }"   class="col-xs-12 col-sm-12" id="return_date1" name="return_date" placeholder="Enter Remark" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="return_date"></has-error>
                                                            <span style="color: red">{{ errors.first('return_date') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ticket_class">
                                                                Ticket Class :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.ticket_class" id="ticket_class" class="ace input-sm" checked name="ticket_class" type="radio" value="0">
                                                                        <span class="lbl"> Economy</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.ticket_class" class="ace input-sm" name="ticket_class" type="radio" value="1">
                                                                        <span class="lbl"> Business</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ticket_class"></has-error>
                                                            <span style="color: red">{{ errors.first('ticket_class') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="food_rules">
                                                                Food Rules :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.food_rules" id="food_rules" class="ace input-sm" checked name="food_rules" type="radio" value="0">
                                                                        <span class="lbl"> Yes</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.food_rules" class="ace input-sm" name="food_rules" type="radio" value="1">
                                                                        <span class="lbl"> No</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="food_rules"></has-error>
                                                            <span style="color: red">{{ errors.first('food_rules') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="date_change">
                                                                Date Change :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.date_change" id="date_change" class="ace input-sm" checked name="date_change" type="radio" value="0">
                                                                        <span class="lbl"> Available</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.date_change" class="ace input-sm" name="date_change" type="radio" value="1">
                                                                        <span class="lbl"> Not-Available</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="date_change"></has-error>
                                                            <span style="color: red">{{ errors.first('date_change') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="narration">
                                                                Narration <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.narration" :class="{ 'is-invalid': form.errors.has('narration') }"   class="col-xs-12 col-sm-12" id="narration" name="narration" placeholder="Enter Some Narration" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="narration"></has-error>
                                                            <span style="color: red">{{ errors.first('narration') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ticket_type">
                                                                Ticket Type<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.ticket_type" id="ticket_type" class="ace input-sm" checked name="ticket_type" type="radio" value="0">
                                                                        <span class="lbl"> Domestic</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.ticket_type" class="ace input-sm" name="ticket_type" type="radio" value="1">
                                                                        <span class="lbl"> International</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ticket_type"></has-error>
                                                            <span style="color: red">{{ errors.first('ticket_type') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ticket_rules">
                                                                Ticket Rules<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.ticket_rules" id="ticket_rules" class="ace input-sm" checked name="ticket_rules" type="radio" value="0">
                                                                        <span class="lbl"> Refundable</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.ticket_rules" class="ace input-sm" name="ticket_rules" type="radio" value="1">
                                                                        <span class="lbl"> Non-Refundable</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ticket_rules"></has-error>
                                                            <span style="color: red">{{ errors.first('ticket_rules') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="luggages_rules">
                                                                Luggages Rules  <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.luggages_rules" :class="{ 'is-invalid': form.errors.has('luggages_rules') }"   class="col-xs-12 col-sm-12" id="luggages_rules" name="luggages_rules" placeholder="KG" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="luggages_rules"></has-error>
                                                            <span style="color: red">{{ errors.first('luggages_rules') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="luggages_rules_description">
                                                                Luggages Rules Description <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.luggages_rules_description" :class="{ 'is-invalid': form.errors.has('luggages_rules_description') }"   class="col-xs-12 col-sm-12" id="luggages_rules_description" name="luggages_rules_description" placeholder="Description" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="luggages_rules_description"></has-error>
                                                            <span style="color: red">{{ errors.first('luggages_rules_description') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="hand_luggages_rules">
                                                                H.L Rules  <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.hand_luggages_rules" :class="{ 'is-invalid': form.errors.has('hand_luggages_rules') }"   class="col-xs-12 col-sm-12" id="hand_luggages_rules" name="hand_luggages_rules" placeholder="KG" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="hand_luggages_rules"></has-error>
                                                            <span style="color: red">{{ errors.first('hand_luggages_rules') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="hand_luggages_rules_description">
                                                                Hand Luggages Rules Description <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.hand_luggages_rules_description" :class="{ 'is-invalid': form.errors.has('hand_luggages_rules_description') }"   class="col-xs-12 col-sm-12" id="hand_luggages_rules_description" name="hand_luggages_rules_description" placeholder="Description"  type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="luggages_rules_description"></has-error>
                                                            <span style="color: red">{{ errors.first('luggages_rules_description') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions" v-if="user_type == 'super-admin' || user_type == 'admin'">
                                                    <div class="col-md-offset-4 col-md-8">
                                                        <button class="btn" type="reset">
                                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                                            Reset
                                                        </button>

                                                        &nbsp; &nbsp; &nbsp;

                                                        <button class="btn btn-info" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</template>

<script>
    import GuestAutoComplate from "../searchSelect/GuestAutoComplate";

    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";

    export default {
        name: "EditAirTicketComponent",
        components: {GuestAutoComplate, Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch("allAirLine")
            this.$store.dispatch("allAirTicketStaff")
            this.editAirTicet()
            this.getAllSuplier()


        },
        computed:{
            getAllAirLine(){
                return this.$store.getters.getAirLine
            },
            getAllStaff(){
                return this.$store.getters.get_air_ticket_staff
            }
        },
        data(){

            return {
                allReference: '',
                guests: '',
                supliers: '',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                name:'',
                phone_number:'',
                user_type:'',

                form: new Form({
                    empolyees: [
                        {
                            issue_date:'',
                            departure_date:'',
                            return_date:'',
                            air_lines:'',
                            pnr:'',
                            sector:'',
                            net_price:'',
                            price:'',
                            suplier:'',
                        }
                    ],
                    paxs: [
                        {
                            pax_title:'',
                            name:'',
                            date_of_birth:'',
                            gender:'',
                            passport_number:'',
                            pp_issue_date:'',
                            pp_expire_date:'',

                        }
                    ],
                    id:'',
                    destination:'',

                    adult_qty: '',
                    adult_price: '',
                    adult_total_price:0,

                    child_qty:'',
                    child_price:'',
                    child_total_price:0,

                    infant_qty:'',
                    infant_price:'',
                    infant_total_price:0,

                    ssr_qty:'',
                    ssr_price:'',
                    ssr_total_price:0,

                    service_amount:'',
                    total_amount:0,

                    total_price:0,
                    total_net_price:0,
                    selling_to:'',
                    note:'',
                    journey_date:'',
                    return_date:'',
                    ticket_class:0,
                    food_rules:'',
                    date_change:1,
                    ticket_type:'',
                    ticket_rules:'',
                    narration:'',
                    luggages_rules:'',
                    luggages_rules_description:'',
                    hand_luggages_rules:'',
                    hand_luggages_rules_description:'',


                })
            }
        },
        methods:{
            addNew(){
                if(this.form.empolyees.length <= 9){
                    this.form.empolyees.push({
                        issue_date:'',
                        departure_date:'',
                        return_date:'',
                        air_lines:'',
                        pnr:'',
                        sector:'',
                        net_price:'',
                        price:'',
                        suplier:'',
                    })
                }else{
                    // $('.btnAddNew').hide()
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>You are not allowed to add more than 10..</a>'
                    })
                }
            },
            addNewPax(){
                if(this.form.paxs.length <= 14){
                    this.form.paxs.push(
                        {
                            pax_title:'',
                            name:'',
                            date_of_birth:'',
                            phone_number:'',
                            passport_number:'',
                            pp_issue_date:'',
                            pp_expire_date:'',

                        }
                    )
                }else{
                    // $('.btnAddNew').hide()
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>You are not allowed to add more than 15..</a>'
                    })
                }
            },
            deleteEmpolyee(index){
                this.$delete(this.form.empolyees, index)
            },
            deletePax(index){
                this.$delete(this.form.paxs, index)
            },

            updateAirTicket(){
                this.isLoading = true
                this.form.post('/api/update-air-ticket')
                    .then((response) => {
                        console.log(response.data)
                        this.form.destination = ''

                        this.form.adult_qty = ''
                        this.form.adult_price = ''
                        this.form.adult_total_price = ''

                        this.form.child_qty = ''
                        this.form.child_price = ''
                        this.form.child_total_price = ''

                        this.form.infant_qty = ''
                        this.form.infant_price = ''
                        this.form.infant_total_price = ''

                        this.form.ssr_qty = ''
                        this.form.ssr_price = ''
                        this.form.ssr_total_price = ''

                        this.form.service_amount = ''
                        this.form.total_amount = ''

                        this.form.total_net_price = ''
                        this.form.total_price = ''
                        this.form.selling_to = ''
                        this.form.journey_date = ''
                        this.form.return_date = ''
                        this.form.ticket_class = ''
                        this.form.food_rules = ''
                        this.form.date_change = ''
                        this.form.narration = ''
                        this.form.ticket_type = ''
                        this.form.ticket_rules = ''

                        this.form.luggages_rules = ''
                        this.form.luggages_rules_description = ''

                        this.form.hand_luggages_rules = ''
                        this.form.hand_luggages_rules_description = ''

                        this.form.empolyees = [
                            {
                                issue_date:'',
                                departure_date:'',
                                return_date:'',
                                air_lines:'',
                                pnr:'',
                                sector:'',
                                net_price:'',
                                price:'',
                                suplier:'',
                            }
                        ],

                            this.form.paxs = [
                                {
                                    pax_title:'',
                                    name:'',
                                    date_of_birth:'',
                                    gender:'',
                                    passport_number:'',
                                    pp_issue_date:'',
                                    pp_expire_date:'',

                                }
                            ],
                        this.$router.push('/air-ticket-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'New Air Ticket Updated successfully'
                        })
                    })
                    .catch((response) => {
                        this.isLoading = false
                    })
            },

            editAirTicet(){
                axios.get(`/api/edit-air-ticket/${this.$route.params.id}`)
                    .then((respose) => {
                        this.form.fill(respose.data.air_ticket)
                        this.name = respose.data.air_ticket.guest.name;
                        this.phone_number = respose.data.air_ticket.guest.phone_number;
                        this.user_type = respose.data.user_type;
                        if(this.user_type == 'admin' || this.user_type == 'super-admin'){
                            this.buttonContent = true
                        }
                        this.doAjax()
                    })
            },
            sumPrice(){
                this.form.total_price = 0
                for(let i = 0; i < this.form.empolyees.length; i++){
                    if(this.form.empolyees[i].price != ''){
                        this.form.total_price += parseInt(this.form.empolyees[i].price)
                    }

                }
                if(this.form.service_amount > 0){
                    this.form.total_price +=parseInt(this.form.service_amount);
                }


            },
            sumNetPrice(){
                this.form.total_net_price = 0
                for(let i = 0; i < this.form.empolyees.length; i++){
                    if(this.form.empolyees[i].net_price != ''){
                        this.form.total_net_price += parseInt(this.form.empolyees[i].net_price)
                    }
                }
            },



            adultChange(){
                if(this.form.adult_qty != '' && this.form.adult_price){
                    this.form.adult_total_price = this.form.adult_qty*this.form.adult_price;
                }else{
                    this.form.adult_total_price = 0;

                }
                this.changeTotalAmount()
            },
            childChange(){
                if(this.form.child_qty != '' && this.form.child_price){
                    this.form.child_total_price = this.form.child_qty*this.form.child_price;

                }else{
                    this.form.child_total_price = 0;
                }
                this.changeTotalAmount()

            },
            infantChange(){
                if(this.form.infant_qty != '' && this.form.infant_price){
                    this.form.infant_total_price = this.form.infant_qty*this.form.infant_price;

                }else{
                    this.form.infant_total_price = 0;
                }
                this.changeTotalAmount()

            },
            ssrChange(){
                if(this.form.ssr_qty != '' && this.form.ssr_price){
                    this.form.ssr_total_price = this.form.ssr_qty*this.form.ssr_price;

                }else{
                    this.form.ssr_total_price = 0;
                }
                this.changeTotalAmount()

            },
            serviceChange(){
                this.sumPrice()
                this.changeTotalAmount()
            },
            changeTotalAmount(){
                this.form.total_amount = 0;
                if(this.form.adult_total_price > 0){
                    this.form.total_amount += parseInt(this.form.adult_total_price)
                }
                if(this.form.child_total_price > 0){
                    this.form.total_amount += parseInt(this.form.child_total_price)
                }
                if(this.form.infant_total_price > 0){
                    this.form.total_amount += parseInt(this.form.infant_total_price)
                }
                if(this.form.ssr_total_price > 0){
                    this.form.total_amount += parseInt(this.form.ssr_total_price)
                }
                if(this.form.service_amount > 0){
                    this.form.total_amount += parseInt(this.form.service_amount)
                }


            },


            getAllSuplier(){
                axios.get('/api/get-all-active-suplier')
                    .then(response => {
                        this.supliers = response.data.supliers
                    })
            },


            customerSelected(customer){
                this.form.selling_to = customer.id;

            },

            onchange:_.debounce(function (query) {
                if(query != ''){
                    this.allRefernceStaff(query)
                }
            }, 1000),
            allRefernceStaff(query){
                axios.get(`/api/get-all-guests/${query}`)
                    .then(response => {
                        this.guests = response.data.guests
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
            onCancel() {
                console.log('User cancelled the loader.')
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
    .chosen-single{
        backgrond:red!important;

    }
    .chosen-container-single{
        width:100%!important;
    }
</style>
