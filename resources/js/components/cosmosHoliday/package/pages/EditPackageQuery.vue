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
                                        <h5 class="widget-title">Edit Package Query</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/package-list" class="btn btn-success">Package List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updatePackageQuery()" class="form-horizontal" method="post" role="form">
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
                                                            <has-error style="color:red" :form="form" field="geust"></has-error>
                                                            <span style="color: red">{{ errors.first('geust') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="package_type">
                                                                Package Type <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('package_type') }" v-model="form.package_type" id="package_type" name="package_type" class="col-xs-12 col-sm-12" >
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
                                                                <input @keyup="sumPaxQty()" v-validate="'required'" v-model="form.child_qty" :class="{ 'is-invalid': form.errors.has('child_qty') }"   class="col-xs-12 col-sm-12" id="child_qty" name="child_qty" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="child_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('child_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="infant_qty">
                                                                Infant <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumPaxQty()" v-validate="'required'" v-model="form.infant_qty" :class="{ 'is-invalid': form.errors.has('infant_qty') }"   class="col-xs-12 col-sm-12" id="infant_qty" name="infant_qty" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="infant_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('infant_qty') }}</span>
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
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('room_cat') }" v-model="form.room_cat" id="room_cat" name="room_cat" class="col-xs-12 col-sm-12" >
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
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.king_size" :class="{ 'is-invalid': form.errors.has('king_size') }"   class="col-xs-12 col-sm-12" id="king_size" name="king_size" placeholder="Qty"  required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="king_size"></has-error>
                                                            <span style="color: red">{{ errors.first('king_size') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="couple_size">
                                                                Couple <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.couple_size" :class="{ 'is-invalid': form.errors.has('couple_size') }"   class="col-xs-12 col-sm-12" id="couple_size" name="couple_size" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="couple_size"></has-error>
                                                            <span style="color: red">{{ errors.first('couple_size') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="twin_size">
                                                                Twin <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.twin_size" :class="{ 'is-invalid': form.errors.has('twin_size') }"   class="col-xs-12 col-sm-12" id="twin_size" name="twin_size" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="twin_size"></has-error>
                                                            <span style="color: red">{{ errors.first('twin_size') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="triple_size">
                                                                Triple <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.triple_size" :class="{ 'is-invalid': form.errors.has('triple_size') }"   class="col-xs-12 col-sm-12" id="triple_size" name="triple_size" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="triple_size"></has-error>
                                                            <span style="color: red">{{ errors.first('triple_size') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="quared_size">
                                                                Quared <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumBedQty()" v-validate="'required'" v-model="form.quared_size" :class="{ 'is-invalid': form.errors.has('quared_size') }"   class="col-xs-12 col-sm-12" id="quared_size" name="quared_size" placeholder="Qty" required type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="quared_size"></has-error>
                                                            <span style="color: red">{{ errors.first('quared_size') }}</span>
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
    import GuestAutoComplate from "../../searchSelect/GuestAutoComplate";
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "EditPackageQuery",
        components: {GuestAutoComplate, Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch("allAirTicketStaff")
            axios.get(`/api/edit-package-query/${this.$route.params.id}`)
                .then((respose) => {
                    this.form.fill(respose.data.package_query)
                    this.name = respose.data.package_query.guestt.name;
                    this.phone_number = respose.data.package_query.guestt.phone_number;
                    this.user_type = respose.data.user_type;
                    if(this.user_type == 'admin' || this.user_type == 'super-admin'){
                        this.buttonContent = true
                    }
                })
            this.isLoading = false

        },
        computed:{
            getAllStaff(){
                return this.$store.getters.get_air_ticket_staff
            }
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
                })
            }
        },
        methods:{
            updatePackageQuery(){
                this.isLoading = true
                this.form.post('/api/update-package-query')
                    .then((response) => {
                        this.$session.start()
                        this.$session.set('p_state',1)
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

                        this.$router.push('/package-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'Package Query Updated successfully'
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
