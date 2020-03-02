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
                        <router-link to="/new-package">New Package</router-link>
                    </li>
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
                                        <h5 class="widget-title">Edit Package Ticket</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/package-list" class="btn btn-success">Package List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updatePackageTicket()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="guest">
                                                                Guest Name <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <GuestAutoComplate :shouldReset="true" @change="onchange" :title="this.name+' '+this.phone_number"  :items="guests" filterby="phone_number" @Selected="customerSelected"/>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="guest"></has-error>
                                                            <span style="color: red">{{ errors.first('guest') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="package_type">
                                                                Package Type <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('package_type') }" v-model="form.package_type" id="package_type" required name="package_type" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Package Type--</option>
                                                                    <option  value="1" >FIT</option>
                                                                    <option  value="2" >Customise</option>
                                                                    <option  value="3" >Regular</option>
                                                                    <option  value="4" >Cosmos Group Tour</option>
                                                                    <option  value="5" >Eid Group</option>
                                                                    <option  value="6" >Eid FIT</option>
                                                                    <option  value="7" >Student Group</option>
                                                                    <option  value="8" >Corporate Group</option>
                                                                    <option  value="9" >VIP Group</option>
                                                                    <option  value="10" >Others</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="package_type"></has-error>
                                                            <span style="color: red">{{ errors.first('package_type') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="country">
                                                                Country <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.country" :class="{ 'is-invalid': form.errors.has('country') }"   class="col-xs-12 col-sm-12" id="country" name="country" placeholder="Enter Country Name" required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="country"></has-error>
                                                            <span style="color: red">{{ errors.first('country') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="query_date">
                                                                Query Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.query_date" :class="{ 'is-invalid': form.errors.has('query_date') }"   class="col-xs-12 col-sm-12" id="query_date" name="query_date"  required type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="query_date"></has-error>
                                                            <span style="color: red">{{ errors.first('query_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="destination">
                                                                Destination <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.destination" :class="{ 'is-invalid': form.errors.has('destination') }"   class="col-xs-12 col-sm-12" id="destination" name="destination" placeholder="Enter Package Destination" required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="destination"></has-error>
                                                            <span style="color: red">{{ errors.first('destination') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="duration">
                                                                Duration <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.duration" :class="{ 'is-invalid': form.errors.has('duration') }"   class="col-xs-12 col-sm-12" id="duration" name="duration" placeholder="Enter Duration" required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="duration"></has-error>
                                                            <span style="color: red">{{ errors.first('duration') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_qty">
                                                                Adult <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPaxQty()" v-validate="'required'" v-model="form.adult_qty" :class="{ 'is-invalid': form.errors.has('adult_qty') }"   class="col-xs-12 col-sm-12" id="adult_qty" name="adult_qty" placeholder="Qty"  required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_qty">
                                                                Child <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPaxQty()" v-validate="'required'" v-model="form.child_qty" :class="{ 'is-invalid': form.errors.has('child_qty') }"   class="col-xs-12 col-sm-12" id="child_qty" name="child_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_qty"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('child_qty') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_qty">
                                                                Infant <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPaxQty()" v-validate="'required'" v-model="form.infant_qty" :class="{ 'is-invalid': form.errors.has('infant_qty') }"   class="col-xs-12 col-sm-12" id="infant_qty" name="infant_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_qty"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('infant_qty') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_qty">
                                                                Total <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.total_qty" :class="{ 'is-invalid': form.errors.has('total_qty') }"   class="col-xs-12 col-sm-12" id="total_qty" name="total_qty" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('total_qty') }}</span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="hotel_cat">
                                                                Hotel Category <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('hotel_cat') }" v-model="form.hotel_cat" id="hotel_cat" name="hotel_cat" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Hotel Category--</option>
                                                                    <option  value="1" >7 Star</option>
                                                                    <option  value="2" >5 Star</option>
                                                                    <option  value="3" >4 Star</option>
                                                                    <option  value="4" >3.5 Star</option>
                                                                    <option  value="5" >3 Star</option>
                                                                    <option  value="6" >2.5 Star</option>
                                                                    <option  value="7" >2 Star</option>
                                                                    <option  value="8" >Others</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="hotel_cat"></has-error>
                                                            <span style="color: red">{{ errors.first('hotel_cat') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="room_qty">
                                                                Room Qty <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.room_qty" :class="{ 'is-invalid': form.errors.has('room_qty') }"   class="col-xs-12 col-sm-12" id="room_qty" name="room_qty" placeholder="Enter Room Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="room_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('room_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="room_cat">
                                                                Room Category <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('room_cat') }" v-model="form.room_cat" id="room_cat" required name="room_cat" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Room Category--</option>
                                                                    <option  value="1" >Stander</option>
                                                                    <option  value="2" >Delux</option>
                                                                    <option  value="3" >Super Delux</option>
                                                                    <option  value="4" >Executive Suite</option>
                                                                    <option  value="5" >Mini Suite</option>
                                                                    <option  value="6" >President Suite</option>
                                                                    <option  value="7" >Adjoining rooms</option>
                                                                    <option  value="8" >Adjacent rooms</option>
                                                                    <option  value="9" >Villa</option>
                                                                    <option  value="10" >Floored Room</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="room_cat"></has-error>
                                                            <span style="color: red">{{ errors.first('room_cat') }}</span>
                                                        </div>
                                                    </div>

                                                </div>




                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="king_size">
                                                                King Size <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.king_size" :class="{ 'is-invalid': form.errors.has('king_size') }"   class="col-xs-12 col-sm-12" id="king_size" name="king_size" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="king_size"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('king_size') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="couple_size">
                                                                Couple <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.couple_size" :class="{ 'is-invalid': form.errors.has('couple_size') }"   class="col-xs-12 col-sm-12" id="couple_size" name="couple_size" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="couple_size"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('couple_size') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="twin_size">
                                                                Twin <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.twin_size" :class="{ 'is-invalid': form.errors.has('twin_size') }"   class="col-xs-12 col-sm-12" id="twin_size" name="twin_size" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="twin_size"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('twin_size') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="triple_size">
                                                                Triple <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.triple_size" :class="{ 'is-invalid': form.errors.has('triple_size') }"   class="col-xs-12 col-sm-12" id="triple_size" name="triple_size" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="triple_size"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('triple_size') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="quared_size">
                                                                Quared <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.quared_size" :class="{ 'is-invalid': form.errors.has('quared_size') }"   class="col-xs-12 col-sm-12" id="quared_size" name="quared_size" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="quared_size"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('quared_size') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_bed_qty">
                                                                Total Bed Qty <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.total_bed_qty" :class="{ 'is-invalid': form.errors.has('total_bed_qty') }"   class="col-xs-12 col-sm-12" id="total_bed_qty" name="total_bed_qty" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_bed_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('total_bed_qty') }}</span>
                                                        </div>
                                                    </div>

                                                </div>






                                                <div v-for="(package_day, index) in form.package_days" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteHotels(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="day">
                                                                    Day<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="package_day.day" :class="{ 'is-invalid': form.errors.has('day') }"   class="col-xs-12 col-sm-12" id="day" name="day"  required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="day"></has-error>
                                                                <span style="color: red">{{ errors.first('day') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="day_date">
                                                                    Date <span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="package_day.day_date" :class="{ 'is-invalid': form.errors.has('day_date') }"   class="col-xs-12 col-sm-12" id="day_date" name="day_date" required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="day_date"></has-error>
                                                                <span style="color: red">{{ errors.first('day_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="over_night">
                                                                    Over Night<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="package_day.over_night" :class="{ 'is-invalid': form.errors.has('over_night') }"   class="col-xs-12 col-sm-12" id="over_night" name="over_night" required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="over_night"></has-error>
                                                                <span style="color: red">{{ errors.first('over_night') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-12">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="tour_itinerary">
                                                                    Tour Itinerary <span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
<!--                                                                <input v-validate="'required'" v-model="employee.issue_date" :class="{ 'is-invalid': form.errors.has('issue_date') }"   class="col-xs-12 col-sm-12" id="issue_date" name="issue_date"  required type="text">-->
                                                                    <textarea v-validate="'required'" v-model="package_day.tour_itinerary" :class="{ 'is-invalid': form.errors.has('tour_itinerary') }"   class="col-xs-12 col-sm-12" id="tour_itinerary" name="tour_itinerary"  ></textarea>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="tour_itinerary"></has-error>
                                                                <span style="color: red">{{ errors.first('tour_itinerary') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Breakfast :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="package_day.breakfast"  class="ace input-sm" type="radio" value="1">
                                                                        <span class="lbl"> Yes</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="package_day.breakfast" class="ace input-sm" type="radio" value="0">
                                                                        <span class="lbl"> No</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="breakfast"></has-error>
                                                                <span style="color: red">{{ errors.first('breakfast') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Lunch :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="package_day.lunch" class="ace input-sm" checked type="radio" value="1">
                                                                        <span class="lbl"> Yes</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="package_day.lunch" class="ace input-sm"  type="radio" value="0">
                                                                        <span class="lbl"> No</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="lunch"></has-error>
                                                                <span style="color: red">{{ errors.first('lunch') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Dinner :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="package_day.dinner"  class="ace input-sm" checked  type="radio" value="1">
                                                                        <span class="lbl"> Yes</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="package_day.dinner" class="ace input-sm"  type="radio" value="0">
                                                                        <span class="lbl"> No</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="dinner"></has-error>
                                                                <span style="color: red">{{ errors.first('dinner') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br/>
                                                    <div style="float: right">
                                                        <button class="btnAddNew" @click.prevent="addNew()">add</button>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="narration">
                                                                Narration <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.narration" :class="{ 'is-invalid': form.errors.has('narration') }"   class="col-xs-12 col-sm-12" id="narration" name="narration" placeholder="Enter Some Narration" required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="narration"></has-error>
                                                            <span style="color: red">{{ errors.first('narration') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="iti_submit_to_guest_date">
                                                                Tour Plan Submit To Guest Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.iti_submit_to_guest_date" :class="{ 'is-invalid': form.errors.has('iti_submit_to_guest_date') }"   class="col-xs-12 col-sm-12" id="iti_submit_to_guest_date" name="iti_submit_to_guest_date"  required type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="iti_submit_to_guest_date"></has-error>
                                                            <span style="color: red">{{ errors.first('iti_submit_to_guest_date') }}</span>
                                                        </div>
                                                    </div>

                                                </div>


                                                <!--                                                this is add guest confirm data conponent-->
                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Adult</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="adultChange()" v-model="form.adult_qty" :class="{ 'is-invalid': form.errors.has('adult_qty') }"   class="col-xs-12 col-sm-12" id="adult_qty" name="adult_qty" placeholder="Qty" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_service">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input   v-model="form.adult_service" :class="{ 'is-invalid': form.errors.has('adult_service') }"   class="col-xs-12 col-sm-12" id="adult_service" name="adult_service" placeholder="Enter Some Notes..." required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_service"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_service') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="adultChange()"  v-model="form.adult_price" :class="{ 'is-invalid': form.errors.has('adult_price') }"   class="col-xs-12 col-sm-12" id="adult_price" name="adult_price" placeholder="Adult Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_price"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="adult_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.adult_total_price" :class="{ 'is-invalid': form.errors.has('adult_total_price') }"   class="col-xs-12 col-sm-12" id="adult_total_price" name="adult_total_price" placeholder="Adult Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Child</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="childChange()"  v-model="form.child_qty" :class="{ 'is-invalid': form.errors.has('child_qty') }"   class="col-xs-12 col-sm-12" id="child_qty" name="child_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_qty"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('child_qty') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_service">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input   v-model="form.child_service" :class="{ 'is-invalid': form.errors.has('child_service') }"   class="col-xs-12 col-sm-12" id="child_service" name="child_service" placeholder="Enter Some Notes..."  type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="adult_price"></has-error>
                                                            <span style="color: red">{{ errors.first('adult_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="childChange()"   v-model="form.child_price" :class="{ 'is-invalid': form.errors.has('child_price') }"   class="col-xs-12 col-sm-12" id="child_price" name="child_price" placeholder="Child Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_price"></has-error>
                                                            <span style="color: red">{{ errors.first('child_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="child_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.child_total_price" :class="{ 'is-invalid': form.errors.has('child_total_price') }"   class="col-xs-12 col-sm-12" id="child_total_price" name="child_total_price" placeholder="Child Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('child_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-2">
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
                                                                <input @keyup="infantChange()"   v-model="form.infant_qty" :class="{ 'is-invalid': form.errors.has('infant_qty') }"   class="col-xs-12 col-sm-12" id="infant_qty" name="infant_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_qty"></has-error>
                                                            <!--                                                            <span style="color: red">{{ errors.first('infant_qty') }}</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_service">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.infant_service" :class="{ 'is-invalid': form.errors.has('infant_service') }"   class="col-xs-12 col-sm-12" id="infant_service" name="infant_service" placeholder="Enter Some Notes"  type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_service"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_service') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="infantChange()"  v-model="form.infant_price" :class="{ 'is-invalid': form.errors.has('infant_price') }"   class="col-xs-12 col-sm-12" id="infant_price" name="infant_price" placeholder="Infant Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_price"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.infant_total_price" :class="{ 'is-invalid': form.errors.has('infant_total_price') }"   class="col-xs-12 col-sm-12" id="infant_total_price" name="infant_total_price" placeholder="infant Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Total</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.total_qty" :class="{ 'is-invalid': form.errors.has('total_qty') }"   class="col-xs-12 col-sm-12" id="total_qty" name="total_qty" placeholder="Qty" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('total_qty') }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.total_total_price" :class="{ 'is-invalid': form.errors.has('total_total_price') }"   class="col-xs-12 col-sm-12" id="total_total_price" name="total_total_price" placeholder="Total Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Extra Night</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_night_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="extraNightChange()" v-model="form.ex_night_qty" :class="{ 'is-invalid': form.errors.has('ex_night_qty') }"   class="col-xs-12 col-sm-12" id="ex_night_qty" name="ex_night_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_night_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_night_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_night_note">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-model="form.ex_night_note" :class="{ 'is-invalid': form.errors.has('ex_night_note') }"   class="col-xs-12 col-sm-12" id="ex_night_note" name="ex_night_note" placeholder="Enter Some Notes..."  type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_night_note"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_night_note') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_night_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="extraNightChange()" v-model="form.ex_night_price" :class="{ 'is-invalid': form.errors.has('ex_night_price') }"   class="col-xs-12 col-sm-12" id="ex_night_price" name="ex_night_price" placeholder="Ex. Night Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_night_price"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_night_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_night_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.ex_night_total_price" :class="{ 'is-invalid': form.errors.has('ex_night_total_price') }"   class="col-xs-12 col-sm-12" id="ex_night_total_price" name="ex_night_total_price" placeholder="Extra Total Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_night_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_night_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Ex. Site Seeing</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_site_seeing_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="extraSiteSeeingChange()"  v-model="form.ex_site_seeing_qty" :class="{ 'is-invalid': form.errors.has('ex_site_seeing_qty') }"   class="col-xs-12 col-sm-12" id="ex_site_seeing_qty" name="ex_site_seeing_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_site_seeing_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_site_seeing_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_site_seeing_note">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.ex_site_seeing_note" :class="{ 'is-invalid': form.errors.has('ex_site_seeing_note') }"   class="col-xs-12 col-sm-12" id="ex_site_seeing_note" name="ex_site_seeing_note" placeholder="Enter Some Notes..." type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_site_seeing_note"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_site_seeing_note') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_site_seeing_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="extraSiteSeeingChange()" v-model="form.ex_site_seeing_price" :class="{ 'is-invalid': form.errors.has('ex_site_seeing_price') }"   class="col-xs-12 col-sm-12" id="ex_site_seeing_price" name="ex_site_seeing_price" placeholder="Ex. Site Seeing Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_site_seeing_price"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_site_seeing_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ex_site_seeing_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.ex_site_seeing_total_price" :class="{ 'is-invalid': form.errors.has('ex_site_seeing_total_price') }"   class="col-xs-12 col-sm-12" id="ex_site_seeing_total_price" name="ex_site_seeing_total_price" placeholder="Ex. Site Seeing Total Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ex_site_seeing_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('ex_site_seeing_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Rec:&Drop</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="airport_rd_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="airportRD()" v-model="form.airport_rd_qty" :class="{ 'is-invalid': form.errors.has('airport_rd_qty') }"   class="col-xs-12 col-sm-12" id="airport_rd_qty" name="airport_rd_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="airport_rd_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('airport_rd_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="airport_rd_note">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.airport_rd_note" :class="{ 'is-invalid': form.errors.has('airport_rd_note') }"   class="col-xs-12 col-sm-12" id="airport_rd_note" name="airport_rd_note" placeholder="Enter Some Note..."  type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="airport_rd_note"></has-error>
                                                            <span style="color: red">{{ errors.first('airport_rd_note') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="airport_rd_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="airportRD()" v-model="form.airport_rd_price" :class="{ 'is-invalid': form.errors.has('airport_rd_price') }"   class="col-xs-12 col-sm-12" id="airport_rd_price" name="airport_rd_price" placeholder="Airport Rec:Drop Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="airport_rd_price"></has-error>
                                                            <span style="color: red">{{ errors.first('airport_rd_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="airport_rd_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.airport_rd_total_price" :class="{ 'is-invalid': form.errors.has('airport_rd_total_price') }"   class="col-xs-12 col-sm-12" id="airport_rd_total_price" name="airport_rd_total_price" placeholder="Airport Rec:Drop Total Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="airport_rd_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('airport_rd_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: center;">Other's</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="others_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="othersChange()" v-model="form.others_qty" :class="{ 'is-invalid': form.errors.has('others_qty') }"   class="col-xs-12 col-sm-12" id="others_qty" name="others_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="others_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('others_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="others_note">
                                                                Sevice<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.others_note" :class="{ 'is-invalid': form.errors.has('others_note') }"   class="col-xs-12 col-sm-12" id="others_note" name="others_note" placeholder="Enter Some Notes..." type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="others_note"></has-error>
                                                            <span style="color: red">{{ errors.first('others_note') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="others_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="othersChange()" v-model="form.others_price" :class="{ 'is-invalid': form.errors.has('others_price') }"   class="col-xs-12 col-sm-12" id="others_price" name="others_price" placeholder="Others Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="others_price"></has-error>
                                                            <span style="color: red">{{ errors.first('others_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="others_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.others_total_price" :class="{ 'is-invalid': form.errors.has('others_total_price') }"   class="col-xs-12 col-sm-12" id="others_total_price" name="others_total_price" placeholder="Others Total Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="others_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('others_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group ">
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="grand_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.grand_total_price" :class="{ 'is-invalid': form.errors.has('grand_total_price') }"   class="col-xs-12 col-sm-12" id="grand_total_price" name="grand_total_price" placeholder="Grand Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="grand_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('grand_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="confirm_date">
                                                                Confirm Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.confirm_date" :class="{ 'is-invalid': form.errors.has('confirm_date') }"   class="col-xs-12 col-sm-12" id="confirm_date" name="confirm_date"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="confirm_date"></has-error>
                                                            <span style="color: red">{{ errors.first('confirm_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="journey_date">
                                                                Journey Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.journey_date" :class="{ 'is-invalid': form.errors.has('journey_date') }"   class="col-xs-12 col-sm-12" id="journey_date" name="journey_date"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="journey_date"></has-error>
                                                            <span style="color: red">{{ errors.first('journey_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="return_date1">
                                                                Return Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.return_date" :class="{ 'is-invalid': form.errors.has('return_date') }"   class="col-xs-12 col-sm-12" id="return_date1" name="return_date" placeholder="Enter Remark" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="return_date"></has-error>
                                                            <span style="color: red">{{ errors.first('return_date') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="extra_note">
                                                                Extra Note<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
<!--                                                                <input disabled  v-model="form.grand_total_price" :class="{ 'is-invalid': form.errors.has('grand_total_price') }"   class="col-xs-12 col-sm-12" id="grand_total_price" name="grand_total_price" placeholder="Grand Total Price" required="" type="number">-->
                                                                <textarea  v-model="form.extra_note" :class="{ 'is-invalid': form.errors.has('extra_note') }"   class="col-xs-12 col-sm-12" id="extra_note" name="extra_note" placeholder="Enter Some Addtional Note...."></textarea>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="extra_note"></has-error>
                                                            <span style="color: red">{{ errors.first('extra_note') }}</span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_qty">
                                                                First Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="firstChange()"  v-model="form.first_qty" :class="{ 'is-invalid': form.errors.has('first_qty') }"   class="col-xs-12 col-sm-12" id="first_qty" name="first_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('first_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_price">
                                                                First Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="firstChange()" v-model="form.first_price" :class="{ 'is-invalid': form.errors.has('first_price') }"   class="col-xs-12 col-sm-12" id="first_price" name="first_price"   type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('first_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_total_price">
                                                                First Total Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.first_total_price" :class="{ 'is-invalid': form.errors.has('first_total_price') }"   class="col-xs-12 col-sm-12" id="first_total_price" name="first_total_price" placeholder="Total Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('first_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="second_qty">
                                                                Second Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="secondChange()"  v-model="form.second_qty" :class="{ 'is-invalid': form.errors.has('second_qty') }"   class="col-xs-12 col-sm-12" id="second_qty" name="second_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('second_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="second_price">
                                                                Second Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="secondChange()"  v-model="form.second_price" :class="{ 'is-invalid': form.errors.has('second_price') }"   class="col-xs-12 col-sm-12" id="second_price" name="second_price"   type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('second_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="second_total_price">
                                                                Second Total Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.second_total_price" :class="{ 'is-invalid': form.errors.has('second_total_price') }"   class="col-xs-12 col-sm-12" id="second_total_price" name="second_total_price" placeholder="Total Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('second_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="third_qty">
                                                                Third Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="thirdChange()"  v-model="form.third_qty" :class="{ 'is-invalid': form.errors.has('third_qty') }"   class="col-xs-12 col-sm-12" id="third_qty" name="third_qty" placeholder="Qty"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('third_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="third_price">
                                                                Third Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="thirdChange()"  v-model="form.third_price" :class="{ 'is-invalid': form.errors.has('third_price') }"   class="col-xs-12 col-sm-12" id="third_price" name="third_price"   type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('third_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="third_total_price">
                                                                Third Total Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled  v-model="form.third_total_price" :class="{ 'is-invalid': form.errors.has('third_total_price') }"   class="col-xs-12 col-sm-12" id="third_total_price" name="third_total_price" placeholder="Total Price"  type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <span style="color: red">{{ errors.first('third_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>












                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="visa_submit_to_us">
                                                                Visa Submit To Us <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.visa_submit_to_us" :class="{ 'is-invalid': form.errors.has('visa_submit_to_us') }"   class="col-xs-12 col-sm-12" id="visa_submit_to_us" name="visa_submit_to_us"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="visa_submit_to_us"></has-error>
                                                            <span style="color: red">{{ errors.first('visa_submit_to_us') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="visa_submit_to_em">
                                                                Visa Submit To Embassy <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.visa_submit_to_em" :class="{ 'is-invalid': form.errors.has('visa_submit_to_em') }"   class="col-xs-12 col-sm-12" id="visa_submit_to_em" name="visa_submit_to_em"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="visa_submit_to_em"></has-error>
                                                            <span style="color: red">{{ errors.first('visa_submit_to_em') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="visa_done_date">
                                                                Visa Done Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.visa_done_date" :class="{ 'is-invalid': form.errors.has('visa_done_date') }"   class="col-xs-12 col-sm-12" id="visa_done_date" name="visa_done_date"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="visa_done_date"></has-error>
                                                            <span style="color: red">{{ errors.first('visa_done_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="visa_delivery_to_guest">
                                                                Visa Delivery To Guest <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.visa_delivery_to_guest" :class="{ 'is-invalid': form.errors.has('visa_delivery_to_guest') }"   class="col-xs-12 col-sm-12" id="visa_delivery_to_guest" name="visa_delivery_to_guest"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="visa_delivery_to_guest"></has-error>
                                                            <span style="color: red">{{ errors.first('visa_delivery_to_guest') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ticket_date">
                                                                Ticket Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.ticket_date" :class="{ 'is-invalid': form.errors.has('ticket_date') }"   class="col-xs-12 col-sm-12" id="ticket_date" name="ticket_date"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ticket_date"></has-error>
                                                            <span style="color: red">{{ errors.first('ticket_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="ticket_type">
                                                                Ticket Type <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  v-model="form.ticket_type" :class="{ 'is-invalid': form.errors.has('ticket_type') }"   class="col-xs-12 col-sm-12" id="ticket_type" name="ticket_type"  required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="ticket_type"></has-error>
                                                            <span style="color: red">{{ errors.first('ticket_type') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions" v-if="user_type == 'super-admin' || user_type == 'admin' || user_type == 'operation'">
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
    import GuestAutoComplate from "../../searchSelect/GuestAutoComplate";
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "EditDrfdp",
        components: {GuestAutoComplate, Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch("allAirTicketStaff")
            axios.get(`/api/edit-package-ticket/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.package_ticket)
                    this.name = respose.data.package_ticket.guestt.name;
                    this.phone_number = respose.data.package_ticket.guestt.phone_number;
                    this.user_type = respose.data.user_type;
                    this.isLoading = false
                })

        },
        computed:{
            get_all_staffs(){
                return this.$store.getters.get_staffs
            },
        },
        data(){
            return {
                name:'',
                phone_number:'',
                user_type:'',

                allReference: '',
                guests:'',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    id:'',
                    guest:'',
                    package_type:'',
                    country:'',
                    query_date:'',
                    destination:'',
                    duration:'',
                    adult_qty:'',
                    child_qty:'',
                    infant_qty:'',
                    total_qty:0,
                    hotel_cat:'',
                    room_qty:'',
                    room_cat:'',
                    king_size:'',
                    couple_size:'',
                    twin_size:'',
                    triple_size:'',
                    quared_size:'',
                    total_bed_qty:0,

                    package_days: [
                        {
                            day: 'Day-1',
                            day_date:'',
                            over_night:'',
                            tour_itinerary:'',
                            breakfast:'',
                            lunch:'',
                            dinnner:'',
                        }
                    ],

                    narration: '',
                    iti_submit_to_guest_date: '',
                    visa_submit_to_us: '',
                    visa_submit_to_em: '',
                    visa_done_date: '',
                    visa_delivery_to_guest: '',
                    ticket_date: '',
                    ticket_type: '',

                    // this is add Guest Confirm date data

                    adult_qty: '',
                    adult_service: '',
                    adult_price: '',
                    adult_total_price:0,

                    child_qty:'',
                    child_service:'',
                    child_price:'',
                    child_total_price:0,

                    infant_qty:'',
                    infant_service:'',
                    infant_price:'',
                    infant_total_price:0,

                    total_qty:'',
                    total_total_price:0,

                    ex_night_qty:'',
                    ex_night_note:'',
                    ex_night_price:'',
                    ex_night_total_price:0,

                    ex_site_seeing_qty:'',
                    ex_site_seeing_note:'',
                    ex_site_seeing_price:'',
                    ex_site_seeing_total_price:0,

                    airport_rd_qty:'',
                    airport_rd_note:'',
                    airport_rd_price:'',
                    airport_rd_total_price:0,

                    others_qty:'',
                    others_note:'',
                    others_price:'',
                    others_total_price:0,

                    grand_total_price:0,

                    confirm_date:'',
                    journey_date:'',
                    return_date:'',


                    extra_note:'',

                    first_qty:'',
                    first_price:'',
                    first_total_price:'',

                    second_qty:'',
                    second_price:'',
                    second_total_price:'',

                    third_qty:'',
                    third_price:'',
                    third_total_price:'',
                })
            }
        },
        methods:{
            updatePackageTicket(){
                this.form.post('/api/update-package-ticket')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',7)
                        this.form.id = ''
                        this.form.guest = ''
                        this.form.package_type = ''
                        this.form.country = ''
                        this.form.query_date = ''
                        this.form.destination = ''
                        this.form.duration = ''
                        this.form.adult_qty = ''
                        this.form.child_qty = ''
                        this.form.infant_qty = ''
                        this.form.total_qty = ''
                        this.form.hotel_cat = ''
                        this.form.room_qty = ''
                        this.form.room_cat = ''
                        this.form.king_size = ''
                        this.form.couple_size = ''
                        this.form.twin_size = ''
                        this.form.triple_size = ''
                        this.form.quared_size = ''
                        this.form.total_bed_qty = ''
                        this.form.hotels = [
                            {
                                day:'',
                                day_date:'',
                                over_night:'',
                                tour_itinerary:'',
                                breakfast:'',
                                lunch:'',
                                dinnner:'',
                            }
                        ]

                        this.form.narration = ''
                        this.form.iti_submit_to_guest_date = ''
                        this.form.visa_submit_to_us = ''
                        this.form.visa_submit_to_em = ''
                        this.form.visa_done_date = ''
                        this.form.visa_delivery_date = ''

                        // this is add Guest Confirmation
                        this.form.adult_service = ''
                        this.form.adult_price = ''
                        this.form.adult_total_price = ''
                        this.form.child_service = ''
                        this.form.child_price = ''
                        this.form.child_total_price = ''
                        this.form.infant_service = ''
                        this.form.infant_price = ''
                        this.form.infant_total_price = ''
                        this.form.total_total_price = ''
                        this.form.ex_night_qty = ''
                        this.form.ex_night_note = ''
                        this.form.ex_night_price = ''
                        this.form.ex_night_total_price = ''
                        this.form.ex_site_seeing_qty = ''
                        this.form.ex_site_seeing_note = ''
                        this.form.ex_site_seeing_price = ''
                        this.form.ex_site_seeing_total_price = ''
                        this.form.airport_rd_qty = ''
                        this.form.airport_rd_note = ''
                        this.form.airport_rd_price = ''
                        this.form.airport_rd_total_price = ''
                        this.form.others_qty = ''
                        this.form.others_note = ''
                        this.form.others_price = ''
                        this.form.others_total_price = ''
                        this.form.grand_total_price = ''
                        this.form.confirm_date = ''
                        this.form.journey_date = ''
                        this.form.return_date = ''


                        this.form.extra_note = ''

                        this.form.first_qty = ''
                        this.form.first_price = ''
                        this.form.first_total_price = ''

                        this.form.second_qty = ''
                        this.form.second_price = ''
                        this.form.second_total_price = ''

                        this.form.third_qty = ''
                        this.form.third_price = ''
                        this.form.third_total_price = ''

                        this.$router.push('/package-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'Package VISA Updated successfully'
                        })

                    })
                    .catch((response) => {
                        this.isLoading = false
                    })

            },
            addNew(){
                if(this.form.package_days.length <= 14){
                    this.form.package_days.push({
                        day:'Day-'+parseInt(1+this.form.package_days.length),
                        day_date:'',
                        over_night:'',
                        tour_itinerary:'',
                        breakfast:'',
                        lunch:'',
                        dinnner:'',
                    })
                }else{
                    // $('.btnAddNew').hide()
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>You are not allowed to add more than 5..</a>'
                    })
                }
            },
            deleteHotels(index){
                this.$delete(this.form.package_days, index)
            },
            customerSelected(customer){
                this.form.guest = customer.id;

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
                },1000)
            },

            sumPaxQty(){
                this.form.total_qty = 0;
                if(this.form.adult_qty > 0){
                    this.form.total_qty += parseInt(this.form.adult_qty);
                }
                if(this.form.child_qty > 0){
                    this.form.total_qty += parseInt(this.form.child_qty);
                }
                if(this.form.infant_qty > 0){
                    this.form.total_qty += parseInt(this.form.infant_qty);
                }
            },
            sumBedQty(){
                this.form.total_bed_qty = 0;
                if(this.form.king_size > 0){
                    this.form.total_bed_qty += parseInt(this.form.king_size);
                }
                if(this.form.couple_size > 0){
                    this.form.total_bed_qty += parseInt(this.form.couple_size);
                }
                if(this.form.twin_size > 0){
                    this.form.total_bed_qty += parseInt(this.form.twin_size);
                }
                if(this.form.triple_size > 0){
                    this.form.total_bed_qty += parseInt(this.form.triple_size);
                }
                if(this.form.quared_size > 0){
                    this.form.total_bed_qty += parseInt(this.form.quared_size);
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

            changeTotalAmount(){
                this.form.total_total_price =0;
                if(this.form.adult_total_price > 0){
                    this.form.total_total_price += this.form.adult_total_price;
                }
                if(this.form.child_total_price > 0){
                    this.form.total_total_price += this.form.child_total_price;
                }
                if(this.form.infant_total_price > 0){
                    this.form.total_total_price += this.form.infant_total_price;
                }
                this.totalQty();
                this.changeGrandAmount()

            },
            totalQty(){
                this.form.total_qty =0;
                if(this.form.adult_qty > 0){
                    this.form.total_qty += parseInt(this.form.adult_qty);
                }
                if(this.form.child_qty > 0){
                    this.form.total_qty += parseInt(this.form.child_qty);
                }
                if(this.form.infant_qty > 0){
                    this.form.total_qty += parseInt(this.form.infant_qty);
                }
            },
            extraNightChange(){
                if(this.form.ex_night_qty != '' && this.form.ex_night_price){
                    this.form.ex_night_total_price = this.form.ex_night_qty*this.form.ex_night_price;

                }else{
                    this.form.ex_night_total_price = 0;
                }
                this.changeGrandAmount()
            },
            extraSiteSeeingChange(){
                if(this.form.ex_site_seeing_qty != '' && this.form.ex_site_seeing_price){
                    this.form.ex_site_seeing_total_price = this.form.ex_site_seeing_qty*this.form.ex_site_seeing_price;

                }else{
                    this.form.ex_site_seeing_total_price = 0;
                }
                this.changeGrandAmount()
            },
            airportRD(){
                if(this.form.airport_rd_qty != '' && this.form.airport_rd_price){
                    this.form.airport_rd_total_price = this.form.airport_rd_qty*this.form.airport_rd_price;

                }else{
                    this.form.airport_rd_total_price = 0;
                }
                this.changeGrandAmount()
            },
            othersChange(){
                if(this.form.others_qty != '' && this.form.others_price){
                    this.form.others_total_price = this.form.others_qty*this.form.others_price;

                }else{
                    this.form.others_total_price = 0;
                }
                this.changeGrandAmount()
            },

            firstChange(){
                if(this.form.first_qty != '' && this.form.first_price){
                    this.form.first_total_price = this.form.first_qty*this.form.first_price;

                }else{
                    this.form.first_total_price = 0;
                }
                this.changeGrandAmount()
            },
            secondChange(){
                if(this.form.second_qty != '' && this.form.second_price){
                    this.form.second_total_price = this.form.second_qty*this.form.second_price;

                }else{
                    this.form.second_total_price = 0;
                }
                this.changeGrandAmount()
            },

            thirdChange(){
                if(this.form.third_qty != '' && this.form.third_price){
                    this.form.third_total_price = this.form.third_qty*this.form.third_price;

                }else{
                    this.form.third_total_price = 0;
                }
                this.changeGrandAmount()
            },


            changeGrandAmount(){
                this.form.grand_total_price =0;
                if(this.form.total_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.total_total_price);
                }
                if(this.form.ex_night_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.ex_night_total_price);
                }
                if(this.form.ex_site_seeing_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.ex_site_seeing_total_price);
                }
                if(this.form.airport_rd_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.airport_rd_total_price);
                }
                if(this.form.others_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.others_total_price);
                }
                if(this.form.first_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.first_total_price);
                }
                if(this.form.second_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.second_total_price);
                }
                if(this.form.third_total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.third_total_price);
                }
            },
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
