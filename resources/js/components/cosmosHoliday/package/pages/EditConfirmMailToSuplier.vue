<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Tables</a>
                    </li>
                    <li class="active">Edit Guest Reaction</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
                        <span class="input-icon">
                            <input autocomplete="off" class="nav-search-input" id="nav-search-input" placeholder="Search ..." type="text"/>
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                        </span>
                    </form>
                </div><!-- /.nav-search -->
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
                                        <h5 class="widget-title">Edit Guest Reaction</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/package-list" class="btn btn-success">Package List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <form @submit.prevent="updateConfirmMailToSuplier()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="guest_id">Guest Name :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('guest_id') }" class="col-xs-12 col-sm-8" id="guest_id"
                                                                    name="guest" required
                                                                    v-model="form.guest_id"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Guest Name--</option>
                                                                <option :value="guest.id" v-for="guest in getAllReference">{{guest.name}}</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_id"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_id') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="staff_id">Staff Name :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('staff_id') }" class="col-xs-12 col-sm-8" id="staff_id"
                                                                    name="guest" required
                                                                    v-model="form.staff_id"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Staff Name--</option>
                                                                <option :value="staff.id" v-for="staff in get_all_staffs">{{staff.first_name+' '+ staff.last_name}}</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="staff_id"></has-error>
                                                        <span style="color: red">{{ errors.first('staff_id') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="country">
                                                        Country <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="hidden" v-validate="'required'" v-model="form.id" placeholder="Enter Country Name" :class="{ 'is-invalid': form.errors.has('country') }" >
                                                        <input type="text" v-validate="'required'" v-model="form.country" placeholder="Enter Country Name" :class="{ 'is-invalid': form.errors.has('country') }"   class="col-xs-12 col-sm-8" id="country" name="country"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="country"></has-error>
                                                        <span style="color: red">{{ errors.first('country') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="destination">
                                                        Destination <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="text" v-validate="'required'" v-model="form.destination" placeholder="Enter Destination Name" :class="{ 'is-invalid': form.errors.has('destination') }"   class="col-xs-12 col-sm-8" id="destination" name="destination"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="destination"></has-error>
                                                        <span style="color: red">{{ errors.first('destination') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="duration">
                                                        Duration <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="text" v-validate="'required'" v-model="form.duration" placeholder="Enter Tour duration" :class="{ 'is-invalid': form.errors.has('duration') }"   class="col-xs-12 col-sm-8" id="duration" name="duration"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="duration"></has-error>
                                                        <span style="color: red">{{ errors.first('duration') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="query_date">
                                                        Query Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.query_date" :class="{ 'is-invalid': form.errors.has('query_date') }"   class="col-xs-12 col-sm-8" id="query_date" name="query_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="query_date"></has-error>
                                                        <span style="color: red">{{ errors.first('query_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="journey_date">
                                                        Journey Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.journey_date" :class="{ 'is-invalid': form.errors.has('journey_date') }"   class="col-xs-12 col-sm-8" id="journey_date" name="journey_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="journery_date"></has-error>
                                                        <span style="color: red">{{ errors.first('journery_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="return_date">
                                                        Return Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.return_date" :class="{ 'is-invalid': form.errors.has('return_date') }"   class="col-xs-12 col-sm-8" id="return_date" name="return_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="return_date"></has-error>
                                                        <span style="color: red">{{ errors.first('return_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="pax">
                                                        Pax <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="number" v-validate="'required'" v-model="form.pax" placeholder="Enter Total Pax" :class="{ 'is-invalid': form.errors.has('pax') }"   class="col-xs-12 col-sm-8" id="pax" name="pax"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="pax"></has-error>
                                                        <span style="color: red">{{ errors.first('pax') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="adult">
                                                        Adult <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="number" v-validate="'required'" v-model="form.adult" placeholder="Enter Number Of Adult" :class="{ 'is-invalid': form.errors.has('adult') }"   class="col-xs-12 col-sm-8" id="adult" name="adult"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="adult"></has-error>
                                                        <span style="color: red">{{ errors.first('adult') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="child">
                                                        Child <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="number" v-validate="'required'" v-model="form.child" placeholder="Enter Number Of Child" :class="{ 'is-invalid': form.errors.has('child') }"   class="col-xs-12 col-sm-8" id="child" name="child"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="child"></has-error>
                                                        <span style="color: red">{{ errors.first('child') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="infant">
                                                        Infant <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="number" v-validate="'required'" v-model="form.infant" placeholder="Enter Number Of Infant" :class="{ 'is-invalid': form.errors.has('infant') }"   class="col-xs-12 col-sm-8" id="infant" name="infant"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="infant"></has-error>
                                                        <span style="color: red">{{ errors.first('infant') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="hotel_type">Hotel Type :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('hotel_type') }" class="col-xs-12 col-sm-8" id="hotel_type"
                                                                    name="hotel_type" required
                                                                    v-model="form.hotel_type"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Hotel Type--</option>
                                                                <option value="2.5">2.5 Star</option>
                                                                <option value="3">3 Star</option>
                                                                <option value="4">4 Star</option>
                                                                <option value="5">5 Star</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="hotel_type"></has-error>
                                                        <span style="color: red">{{ errors.first('hotel_type') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="room_type">Room Type :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('room_type') }" class="col-xs-12 col-sm-8" id="room_type"
                                                                    name="hotel_type" required
                                                                    v-model="form.room_type"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Room Type--</option>
                                                                <option value="1">Couple Bed</option>
                                                                <option value="2">Twin Sharing Bed</option>
                                                                <option value="3">Triple Sharing Bed</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="room_type"></has-error>
                                                        <span style="color: red">{{ errors.first('room_type') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="tour_by">Tour By :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('tour_by') }" class="col-xs-12 col-sm-8" id="tour_by"
                                                                    name="hotel_type" required
                                                                    v-model="form.tour_by"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Tour By--</option>
                                                                <option value="1">Road</option>
                                                                <option value="2">Air</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="tour_by"></has-error>
                                                        <span style="color: red">{{ errors.first('tour_by') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="query_note">
                                                        Query Note <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
<!--                                                        <input type="number" v-validate="'required'" v-model="form.note" placeholder="Enter Number Of Infant" :class="{ 'is-invalid': form.errors.has('note') }"   class="col-xs-12 col-sm-8" id="infant" name="infant"  required="">-->
                                                            <textarea  v-validate="'required'" v-model="form.query_note" placeholder="Enter Some Imformative Note" :class="{ 'is-invalid': form.errors.has('query_note') }"   class="col-xs-12 col-sm-8" id="query_note" name="query_note"  required=""> </textarea>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="query_note"></has-error>
                                                        <span style="color: red">{{ errors.first('query_note') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right">
                                                        <label class="control-label"> Follow Up</label>
                                                        <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <div class="row">
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input checked class="ace input-sm" name="follow_up_for_price_to_suplier" type="radio" v-model="form.follow_up_for_price_to_suplier" value="0">
                                                                        <span class="lbl"> Not Confirm</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input class="ace input-sm" name="follow_up_for_price_to_suplier" type="radio" v-model="form.follow_up_for_price_to_suplier" value="1">
                                                                        <span class="lbl"> Confirm</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="follow_up_for_price_to_suplier"></has-error>
                                                        <span style="color: red">{{ errors.first('follow_up_for_price_to_suplier') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right">
                                                        <label class="control-label"> ICSD Confirmation</label>
                                                        <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <div class="row">
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input checked class="ace input-sm" name="itinerary_cost_submit_date" type="radio" v-model="form.itinerary_cost_submit_date" value="0">
                                                                        <span class="lbl"> Not Confirm</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-4">
                                                                    <label>
                                                                        <input class="ace input-sm" name="itinerary_cost_submit_date" type="radio" v-model="form.itinerary_cost_submit_date" value="1">
                                                                        <span class="lbl"> Confirm</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="follow_up_for_price_to_suplier"></has-error>
                                                        <span style="color: red">{{ errors.first('follow_up_for_price_to_suplier') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="query_date">
                                                        Guest Reaction Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.guest_reaction_date" :class="{ 'is-invalid': form.errors.has('guest_reaction_date') }"   class="col-xs-12 col-sm-8" id="guest_reaction_date" name="guest_reaction_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_reaction_date"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_reaction_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right" for="guest_reaction">Guest Reaction :</label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                            <select :class="{ 'is-invalid': form.errors.has('guest_reaction') }" class="col-xs-12 col-sm-8" id="guest_reaction"
                                                                    name="hotel_type" required
                                                                    v-model="form.guest_reaction"
                                                                    v-validate="'required'">
                                                                <option value="">--Select Guest Reaciton--</option>
                                                                <option value="1">Excellent</option>
                                                                <option value="2">Good</option>
                                                                <option value="3">Medium</option>
                                                                <option value="4">Poor</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_reaction"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_reaction') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="guest_confirm_date">
                                                        Guest Confirmation Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.guest_confirm_date" :class="{ 'is-invalid': form.errors.has('guest_confirm_date') }"   class="col-xs-12 col-sm-8" id="guest_confirm_date" name="guest_confirm_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_confirm_date"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_confirm_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="guest_confirm_note">
                                                        Guest Confirmation Note <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="text" v-validate="'required'" v-model="form.guest_confirm_note" :class="{ 'is-invalid': form.errors.has('guest_confirm_note') }"   class="col-xs-12 col-sm-8" id="guest_confirm_note" name="guest_confirm_note"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_confirm_note"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_confirm_note') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="guest_confirm_date">
                                                        Guest Confirmation Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.guest_confirm_date" :class="{ 'is-invalid': form.errors.has('guest_confirm_date') }"   class="col-xs-12 col-sm-8" id="guest_confirm_date" name="guest_confirm_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_confirm_date"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_confirm_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="guest_confirm_note">
                                                        Guest Confirmation Note <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="text" v-validate="'required'" v-model="form.guest_confirm_note" :class="{ 'is-invalid': form.errors.has('guest_confirm_note') }"   class="col-xs-12 col-sm-8" id="guest_confirm_note" name="guest_confirm_note"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="guest_confirm_note"></has-error>
                                                        <span style="color: red">{{ errors.first('guest_confirm_note') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="confirm_mail_to_suplier_date">
                                                        Confirm Mail To Suplier Date<span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="date" v-validate="'required'" v-model="form.confirm_mail_to_suplier_date" :class="{ 'is-invalid': form.errors.has('confirm_mail_to_suplier_date') }"   class="col-xs-12 col-sm-8" id="confirm_mail_to_suplier_date" name="confirm_mail_to_suplier_date"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="confirm_mail_to_suplier_date"></has-error>
                                                        <span style="color: red">{{ errors.first('confirm_mail_to_suplier_date') }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-xs-12 col-sm-2 col-md-2 control-label no-padding-right"
                                                           for="confirm_mail_to_suplier_note">
                                                        Confirm Mail To Suplier Note <span class="text-danger">*</span> :
                                                    </label>
                                                    <div class="col-xs-12 col-sm-7">
                                                        <span class="block input-icon input-icon-right">
                                                        <input type="text" v-validate="'required'" v-model="form.confirm_mail_to_suplier_note" :class="{ 'is-invalid': form.errors.has('confirm_mail_to_suplier_note') }"   class="col-xs-12 col-sm-8" id="confirm_mail_to_suplier_note" name="confirm_mail_to_suplier_note"  required="">
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                        <has-error style="color:red" :form="form" field="confirm_mail_to_suplier_note"></has-error>
                                                        <span style="color: red">{{ errors.first('confirm_mail_to_suplier_note') }}</span>
                                                    </div>
                                                </div>


                                                <div class="clearfix form-actions">
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
    export default {
        name: "EditConfirmMailToSuplier",
        mounted(){
            axios.get(`/api/edit-confirm-mail-to-suplier/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.cmts)
                })
            this.$store.dispatch("allVisaCountry")
            this.$store.dispatch("allReference")
            this.$store.dispatch('allStaffs')

        },
        computed:{
            getAllVisaCountry(){
                return this.$store.getters.get_visa_country
            },
            getAllReference(){
                return this.$store.getters.get_reference
            },
            get_all_staffs(){
                return this.$store.getters.get_staffs
            },
        },
        data(){
            return {
                allReference: '',
                form: new Form({
                    id: '',
                    guest_id: '',
                    staff_id: '',
                    country: '',
                    destination: '',
                    duration: '',
                    query_date: '',
                    journey_date: '',
                    return_date: '',
                    pax: '',
                    adult: '',
                    child: '',
                    infant: '',
                    hotel_type: '',
                    room_type: '',
                    tour_by: '',
                    query_note: '',
                    follow_up_for_price_to_suplier: '',
                    itinerary_cost_submit_date: '',
                    guest_reaction_date: '',
                    guest_reaction: '',
                    guest_confirm_date: '',
                    guest_confirm_note: '',
                    confirm_mail_to_suplier_date: '',
                    confirm_mail_to_suplier_note: '',
                })
            }
        },
        methods:{
            updateConfirmMailToSuplier(){
                this.form.post('/api/update-confirm-mail-to-suplier')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',6)
                        this.form.id = ''
                        this.form.guest_id = ''
                        this.form.staff_id = ''
                        this.form.country = ''
                        this.form.destination = ''
                        this.form.duration = ''
                        this.form.query_date = ''
                        this.form.journey_date = ''
                        this.form.return_date = ''
                        this.form.pax = ''
                        this.form.adult = ''
                        this.form.child = ''
                        this.form.infant = ''
                        this.form.hotel_type = ''
                        this.form.room_type = ''
                        this.form.tour_by = ''
                        this.form.query_note = ''
                        this.form.follow_up_for_price_to_suplier = ''
                        this.form.itinerary_cost_submit_date = ''
                        this.form.guest_reaction_date = ''
                        this.form.guest_reaction = ''
                        this.form.guest_confirm_date = ''
                        this.form.guest_confirm_note = ''
                        this.form.confirm_mail_to_suplier_date = ''
                        this.form.confirm_mail_to_suplier_note = ''
                        this.$router.push('/package-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Guest Confirmation Date Updated Successfully'
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