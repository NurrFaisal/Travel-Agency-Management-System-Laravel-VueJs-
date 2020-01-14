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
                        <router-link to="/new-hotel-booking">Edit Hotel Booking</router-link>
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
                                        <h5 class="widget-title">Edit Hotel Booking</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/hotel-booking-list" class="btn btn-success">Hotel Booking List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updateHotelBooking()" class="form-horizontal" method="post" role="form">
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="customer_name">
                                                                Customer Name <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.customer_name" :class="{ 'is-invalid': form.errors.has('customer_name') }"   class="col-xs-12 col-sm-12" id="customer_name" name="customer_name" placeholder="Enter Custormer Name" required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="customer_name"></has-error>
                                                            <span style="color: red">{{ errors.first('customer_name') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-for="(hotel, index) in form.hotels" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteHotels(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="hotel_name">
                                                                    Hotel Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="hotel.hotel_name" :class="{ 'is-invalid': form.errors.has('hotel_name') }"   class="col-xs-12 col-sm-12" id="hotel_name" name="hotel_name"  required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="hotel_name"></has-error>
                                                                <span style="color: red">{{ errors.first('hotel_name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="check_in">
                                                                    Check In<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="hotel.check_in" :class="{ 'is-invalid': form.errors.has('check_in') }"   class="col-xs-12 col-sm-12" id="check_in" name="check_in" required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="check_in"></has-error>
                                                                <span style="color: red">{{ errors.first('check_in') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="check_out">
                                                                    Check Out<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="hotel.check_out" :class="{ 'is-invalid': form.errors.has('check_out') }"   class="col-xs-12 col-sm-12" id="check_out" name="check_out" required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="check_out"></has-error>
                                                                <span style="color: red">{{ errors.first('check_out') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="number_of_persons">
                                                                    Number Of Persons<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="hotel.number_of_persons" :class="{ 'is-invalid': form.errors.has('number_of_persons') }"   class="col-xs-12 col-sm-12" id="number_of_persons" name="number_of_persons"  required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="number_of_persons"></has-error>
                                                                <span style="color: red">{{ errors.first('number_of_persons') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="number_of_room">
                                                                    Number Of Room<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="hotel.number_of_room" :class="{ 'is-invalid': form.errors.has('number_of_room') }"   class="col-xs-12 col-sm-12" id="number_of_room" name="number_of_room" required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="number_of_room"></has-error>
                                                                <span style="color: red">{{ errors.first('number_of_room') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="hotel_booking_ref">
                                                                    Hotel Booking Ref<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="hotel.hotel_booking_ref" :class="{ 'is-invalid': form.errors.has('hotel_booking_ref') }"   class="col-xs-12 col-sm-12" id="hotel_booking_ref" name="hotel_booking_ref" required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="hotel_booking_ref"></has-error>
                                                                <span style="color: red">{{ errors.first('hotel_booking_ref') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="net_price">
                                                                    Net Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="sumNetPrice()" v-validate="'required'" v-model="hotel.net_price" :class="{ 'is-invalid': form.errors.has('net_price') }"   class="col-xs-12 col-sm-12" id="net_price" name="net_price"  required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="net_price"></has-error>
                                                                <span style="color: red">{{ errors.first('net_price') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="suplier">
                                                                    Suplier<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                               <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('suplier') }" v-model="hotel.suplier" id="suplier" name="suplier" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Suplier--</option>
                                                                    <option  :value="suplier.id" v-for="suplier in supliers " >{{suplier.name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                                <span style="color: red">{{ errors.first('suplier') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="room_category">
                                                                    Room Cagtegory<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                               <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('room_category') }" v-model="hotel.room_category" id="room_category" name="room_category" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Room Category--</option>
                                                                    <option  value="Stander" >Stander</option>
                                                                    <option  value="Deuxe" >Deluxe</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="room_category"></has-error>
                                                                <span style="color: red">{{ errors.first('room_category') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="note">
                                                                    Note<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="" v-validate="'required'" v-model="hotel.note" :class="{ 'is-invalid': form.errors.has('note') }" id="note"  class="col-xs-12 col-sm-12" name="note"  required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="note"></has-error>
                                                                <span style="color: red">{{ errors.first('note') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-12">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="address">
                                                                    Address<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
<!--                                                                <input v-validate="'required'" v-model="employee.issue_date" :class="{ 'is-invalid': form.errors.has('issue_date') }"   class="col-xs-12 col-sm-12" id="issue_date" name="issue_date"  required type="text">-->
                                                                    <textarea v-validate="'required'" v-model="hotel.address" :class="{ 'is-invalid': form.errors.has('address') }"   class="col-xs-12 col-sm-12" id="address" name="address"  ></textarea>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="address"></has-error>
                                                                <span style="color: red">{{ errors.first('address') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <br/>
                                                    <div class="form-group ">
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Bed Category:</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    King Size<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)"  v-model="hotel.king_size" :class="{ 'is-invalid': form.errors.has('king_size') }"   class="col-xs-12 col-sm-12"  name="king_size" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="king_size"></has-error>
                                                                <span style="color: red">{{ errors.first('king_size') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Couple<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.couple" :class="{ 'is-invalid': form.errors.has('couple') }"   class="col-xs-12 col-sm-12" name="couple" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="couple"></has-error>
                                                                <span style="color: red">{{ errors.first('couple') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Twin<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.twin" :class="{ 'is-invalid': form.errors.has('twin') }"   class="col-xs-12 col-sm-12"  name="twin" placeholder="Qty" required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="twin"></has-error>
                                                                <span style="color: red">{{ errors.first('twin') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Triple<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.triple" :class="{ 'is-invalid': form.errors.has('triple') }"   class="col-xs-12 col-sm-12" name="triple" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="triple"></has-error>
                                                                <span style="color: red">{{ errors.first('triple') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Quared<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.quared" :class="{ 'is-invalid': form.errors.has('quared') }"   class="col-xs-12 col-sm-12"  name="quared" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="quared"></has-error>
                                                                <span style="color: red">{{ errors.first('quared') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Price:</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    King Size Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)"  v-model="hotel.king_size_price" :class="{ 'is-invalid': form.errors.has('king_size_price') }"   class="col-xs-12 col-sm-12"  name="king_size_price" placeholder="Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="king_size_price"></has-error>
                                                                <span style="color: red">{{ errors.first('king_size_price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Couple Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.couple_price" :class="{ 'is-invalid': form.errors.has('couple_price') }"   class="col-xs-12 col-sm-12" name="couple_price" placeholder="Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="couple_price"></has-error>
                                                                <span style="color: red">{{ errors.first('couple_price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Twin Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.twin_price" :class="{ 'is-invalid': form.errors.has('twin_price') }"   class="col-xs-12 col-sm-12"  name="twin_price" placeholder="Price" required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="twin_price"></has-error>
                                                                <span style="color: red">{{ errors.first('twin_price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Triple Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.triple_price" :class="{ 'is-invalid': form.errors.has('triple_price') }"   class="col-xs-12 col-sm-12" name="triple_price" placeholder="Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="triple_price"></has-error>
                                                                <span style="color: red">{{ errors.first('triple_price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label>
                                                                    Quared Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input @keyup="bedChangeQty(index)" v-model="hotel.quared_price" :class="{ 'is-invalid': form.errors.has('quared_price') }"   class="col-xs-12 col-sm-12"  name="quared_price" placeholder="Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="quared_price"></has-error>
                                                                <span style="color: red">{{ errors.first('quared_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Room :</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Qty<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  disabled v-model="hotel.room_qty"  :class="{ 'is-invalid': form.errors.has('room_qty') }"   class="col-xs-12 col-sm-12" name="room_qty" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="room_qty"></has-error>
                                                                <span style="color: red">{{ errors.first('room_qty') }}</span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Total Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="hotel.room_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('room_total_price') }"   class="col-xs-12 col-sm-12"  name="room_total_price" placeholder="Room Total Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="room_total_price"></has-error>
                                                                <span style="color: red">{{ errors.first('room_total_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Extra Bed :</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Qty<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="extraBedChange(index)" v-model="hotel.extra_bed_qty"  :class="{ 'is-invalid': form.errors.has('extra_bed_qty') }"   class="col-xs-12 col-sm-12"  name="extra_bed_qty" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="extra_bed_qty"></has-error>
                                                                <span style="color: red">{{ errors.first('extra_bed_qty') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="extraBedChange(index)"  v-model="hotel.extra_bed_price"  :class="{ 'is-invalid': form.errors.has('extra_bed_price') }"   class="col-xs-12 col-sm-12"  name="extra_bed_price" placeholder="Enter Extra Bed Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="extra_bed_price"></has-error>
                                                                <span style="color: red">{{ errors.first('extra_bed_price') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Total Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="hotel.extra_bed_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('extra_bed_total_price') }"   class="col-xs-12 col-sm-12"  name="extra_bed_total_price" placeholder="Extra Bed Total Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="extra_bed_total_price"></has-error>
                                                                <span style="color: red">{{ errors.first('extra_bed_total_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Breakfast :</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Qty<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="breakfastChange(index)" v-model="hotel.breakfast_qty"  :class="{ 'is-invalid': form.errors.has('breakfast_qty') }"   class="col-xs-12 col-sm-12"  name="breakfast_qty" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="breakfast_qty"></has-error>
                                                                <span style="color: red">{{ errors.first('breakfast_qty') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="breakfastChange(index)"  v-model="hotel.breakfast_price"  :class="{ 'is-invalid': form.errors.has('breakfast_price') }"   class="col-xs-12 col-sm-12" name="breakfast_price" placeholder="Enter Breakfast Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="breakfast_price"></has-error>
                                                                <span style="color: red">{{ errors.first('breakfast_price') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Total Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="hotel.breakfast_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('breakfast_total_price') }"   class="col-xs-12 col-sm-12"  name="breakfast_total_price" placeholder="Breakfast Total Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="breakfast_total_price"></has-error>
                                                                <span style="color: red">{{ errors.first('breakfast_total_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Early Check In :</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Qty<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="earlyCheckInChange(index)" v-model="hotel.early_check_in_qty"  :class="{ 'is-invalid': form.errors.has('early_check_in_qty') }"   class="col-xs-12 col-sm-12" id="early_check_in_qty" name="early_check_in_qty" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="early_check_in_qty"></has-error>
                                                                <span style="color: red">{{ errors.first('early_check_in_qty') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="earlyCheckInChange(index)"  v-model="hotel.early_check_in_price"  :class="{ 'is-invalid': form.errors.has('early_check_in_price') }"   class="col-xs-12 col-sm-12"  name="early_check_in_price" placeholder="Enter Early Check-In Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="early_check_in_price"></has-error>
                                                                <span style="color: red">{{ errors.first('early_check_in_price') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Total Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="hotel.early_check_in_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('early_check_in_total_price') }"   class="col-xs-12 col-sm-12"  name="early_check_in_total_price" placeholder="Early Check-In Total Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="early_check_in_total_price"></has-error>
                                                                <span style="color: red">{{ errors.first('early_check_in_total_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Late Check Out :</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Qty<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="lateCheckOutChange(index)" v-model="hotel.late_check_out_qty"  :class="{ 'is-invalid': form.errors.has('late_check_out_qty') }"   class="col-xs-12 col-sm-12" name="late_check_out_qty" placeholder="Qty" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="late_check_out_qty"></has-error>
                                                                <span style="color: red">{{ errors.first('late_check_out_qty') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input  @keyup="lateCheckOutChange(index)"  v-model="hotel.late_check_out_price"  :class="{ 'is-invalid': form.errors.has('late_check_out_price') }"   class="col-xs-12 col-sm-12" name="late_check_out_price" placeholder="Enter Late Check-Out Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="late_check_out_price"></has-error>
                                                                <span style="color: red">{{ errors.first('late_check_out_price') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Total Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="hotel.late_check_out_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('late_check_out_total_price') }"   class="col-xs-12 col-sm-12"  name="late_check_out_total_price" placeholder="Late Check Out Total Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="late_check_out_total_price"></has-error>
                                                                <span style="color: red">{{ errors.first('late_check_out_total_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <h4 style="text-align: right;">Total Hotel Price :</h4>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-8">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="">
                                                                    Total Hotel Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="hotel.total_hotel_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('total_hotel_price') }"   class="col-xs-12 col-sm-12"  name="total_hotel_price" placeholder="Total Hotel Price" required="" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="total_hotel_price"></has-error>
                                                                <span style="color: red">{{ errors.first('total_hotel_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div style="float: right">
                                                        <button class="btnAddNew" @click.prevent="addNew()">add</button>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_net_price">
                                                                Total Net Price <span class="text-danger">*</span> :
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
                                                                Total Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-validate="'required'" v-model="form.total_price" :class="{ 'is-invalid': form.errors.has('total_price') }"   class="col-xs-12 col-sm-12" id="total_price" name="total_price" placeholder="Enter Total Price" required="" type="number">
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
                                                                Client <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                 <GuestAutoComplate :shouldReset="true" :title="this.name+' '+this.phone_number" @change="onchange"  :items="guests" filterby="phone_number" @Selected="customerSelected"/>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="client"></has-error>
                                                            <span style="color: red">{{ errors.first('client') }}</span>
                                                        </div>
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
    import GuestAutoComplate from "../searchSelect/GuestAutoComplate";
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "EditHotelBookingComponent",
        components: {GuestAutoComplate, Loading},
        mounted(){
            this.isLoading = true
            this.getAllSuplier()
            this.$store.dispatch("allAirTicketStaff")
            this.editHotelBooking()
        },
        computed:{
            getAllStaff(){
                return this.$store.getters.get_air_ticket_staff
            }
        },
        data(){

            return {
                allReference: '',
                supliers:'',
                guests:'',
                name:'',
                phone_number:'',
                user_type:'',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    id:'',
                    customer_name:'',
                    hotels: [
                        {
                            hotel_name:'',
                            check_in:'',
                            check_out:'',
                            number_of_persons:'',
                            number_of_room:'',
                            hotel_booking_ref:'',
                            net_price:'',
                            suplier:'',
                            room_category:'',
                            note:'',
                            address:'',

                            king_size:'',
                            king_size_price:'',
                            couple:'',
                            couple_price:'',
                            twin:'',
                            twin_price:'',
                            triple:'',
                            triple_price:'',
                            quared:'',
                            quared_price:'',

                            room_qty:'',
                            room_total_price:'',
                            extra_bed_qty:'',
                            extra_bed_price:'',
                            extra_bed_total_price:'',
                            breakfast_qty:'',
                            breakfast_price:'',
                            breakfast_total_price:'',
                            early_check_in_qty:'',
                            early_check_in_price:'',
                            early_check_in_total_price:'',
                            late_check_out_qty:'',
                            late_check_out_price:'',
                            late_check_out_total_price:'',
                            total_hotel_price:'',
                        }
                    ],

                    total_net_price:0,
                    total_price:0,
                    client: '',
                    narration: '',
                })
            }
        },
        methods:{
            editHotelBooking(){
                axios.get(`/api/edit-hotel-booking/${this.$route.params.id}`)
                    .then((respose) => {
                        this.form.fill(respose.data.hotel_booking)
                        this.name = respose.data.hotel_booking.guest.name;
                        this.phone_number = respose.data.hotel_booking.guest.phone_number;
                        this.user_type = respose.data.user_type;
                        if(this.user_type == 'admin' || this.user_type == 'super-admin'){
                            this.buttonContent = true
                        }
                        this.doAjax()
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
            onCancel() {
                console.log('User cancelled the loader.')
            },

            updateHotelBooking(){
                this.isLoading = true
                this.form.post('/api/updated-hotel-booking')
                    .then((response) => {
                        this.form.id = ''
                        this.form.customer_name = ''
                        this.form.total_net_price = ''
                        this.form.total_price = ''
                        this.form.client = ''
                        this.form.sell_person = ''
                        this.form.narration = ''
                        this.form.hotels = [
                            {
                                hotel_name:'',
                                check_in:'',
                                check_out:'',
                                number_of_persons:'',
                                number_of_room:'',
                                hotel_booking_ref:'',
                                net_price:'',
                                suplier:'',
                                room_category:'',
                                note:'',
                                address:'',

                                king_size:'',
                                king_size_price:'',
                                couple:'',
                                couple_price:'',
                                twin:'',
                                twin_price:'',
                                triple:'',
                                triple_price:'',
                                quared:'',
                                quared_price:'',

                                room_qty:'',
                                room_total_price:'',
                                extra_bed_qty:'',
                                extra_bed_price:'',
                                extra_bed_total_price:'',
                                breakfast_qty:'',
                                breakfast_price:'',
                                breakfast_total_price:'',
                                early_check_in_qty:'',
                                early_check_in_price:'',
                                early_check_in_total_price:'',
                                late_check_out_qty:'',
                                late_check_out_price:'',
                                late_check_out_total_price:'',
                                total_hotel_price:'',
                            }
                        ]
                        this.$router.push('/hotel-booking-list')
                        this.isLoading =false
                        Toast.fire({
                            type: 'success',
                            title: 'Hotel Booking Updated successfully'
                        })
                    })
                    .catch((response) => {
                        this.isLoading =false
                    })
            },
            extraBedChange(index){
                if(this.form.hotels[index].extra_bed_qty != '' && this.form.hotels[index].extra_bed_price > 0){
                    this.form.hotels[index].extra_bed_total_price = this.form.hotels[index].extra_bed_qty*this.form.hotels[index].extra_bed_price

                }else {
                    this.form.hotels[index].extra_bed_total_price = 0
                }
                this.changeTotalHotelPrice(index)

            },
            breakfastChange(index){
                if(this.form.hotels[index].breakfast_qty != '' && this.form.hotels[index].breakfast_price > 0){
                    this.form.hotels[index].breakfast_total_price = this.form.hotels[index].breakfast_qty*this.form.hotels[index].breakfast_price

                }else {
                    this.form.hotels[index].breakfast_total_price = 0
                }
                this.changeTotalHotelPrice(index)

            },
            earlyCheckInChange(index){
                if(this.form.hotels[index].early_check_in_qty != '' && this.form.hotels[index].early_check_in_price > 0){
                    this.form.hotels[index].early_check_in_total_price = this.form.hotels[index].early_check_in_qty*this.form.hotels[index].early_check_in_price

                }else {
                    this.form.hotels[index].early_check_in_total_price = 0
                }
                this.changeTotalHotelPrice(index)

            },
            lateCheckOutChange(index){
                if(this.form.hotels[index].late_check_out_qty != '' && this.form.hotels[index].late_check_out_price > 0){
                    this.form.hotels[index].late_check_out_total_price = this.form.hotels[index].late_check_out_qty*this.form.hotels[index].late_check_out_price

                }else {
                    this.form.hotels[index].late_check_out_total_price = 0
                }
                this.changeTotalHotelPrice(index)

            },
            changeTotalHotelPrice(index){
                this.form.hotels[index].total_hotel_price = 0;
                if(this.form.hotels[index].room_total_price > 0){
                    this.form.hotels[index].total_hotel_price += parseInt(this.form.hotels[index].room_total_price)
                }
                if(this.form.hotels[index].extra_bed_total_price > 0){
                    this.form.hotels[index].total_hotel_price += parseInt(this.form.hotels[index].extra_bed_total_price)
                }
                if(this.form.hotels[index].breakfast_total_price > 0){
                    this.form.hotels[index].total_hotel_price += parseInt(this.form.hotels[index].breakfast_total_price)
                }
                if(this.form.hotels[index].early_check_in_total_price > 0){
                    this.form.hotels[index].total_hotel_price += parseInt(this.form.hotels[index].early_check_in_total_price)
                }
                if(this.form.hotels[index].late_check_out_total_price > 0){
                    this.form.hotels[index].total_hotel_price += parseInt(this.form.hotels[index].late_check_out_total_price)
                }
                this.sumPrice()
            },
            bedChangeQty(index){
                this.form.hotels[index].room_qty = 0;
                this.form.hotels[index].room_total_price = 0;
                if(this.form.hotels[index].king_size > 0){
                    this.form.hotels[index].room_qty += parseInt(this.form.hotels[index].king_size)
                    if(this.form.hotels[index].king_size_price > 0){
                        this.form.hotels[index].room_total_price += parseInt(this.form.hotels[index].king_size)*parseInt(this.form.hotels[index].king_size_price)
                    }
                }

                if(this.form.hotels[index].couple > 0){
                    this.form.hotels[index].room_qty += parseInt(this.form.hotels[index].couple)
                    if(this.form.hotels[index].couple_price > 0){
                        this.form.hotels[index].room_total_price += parseInt(this.form.hotels[index].couple)*parseInt(this.form.hotels[index].couple_price)
                    }
                }


                if(this.form.hotels[index].twin > 0){
                    this.form.hotels[index].room_qty += parseInt(this.form.hotels[index].twin)
                    if(this.form.hotels[index].twin_price > 0){
                        this.form.hotels[index].room_total_price += parseInt(this.form.hotels[index].twin)*parseInt(this.form.hotels[index].twin_price)
                    }
                }


                if(this.form.hotels[index].triple > 0){
                    this.form.hotels[index].room_qty += parseInt(this.form.hotels[index].triple)
                    if(this.form.hotels[index].triple_price > 0){
                        this.form.hotels[index].room_total_price += parseInt(this.form.hotels[index].triple)*parseInt(this.form.hotels[index].triple_price)
                    }
                }


                if(this.form.hotels[index].quared > 0){
                    this.form.hotels[index].room_qty += parseInt(this.form.hotels[index].quared)
                    if(this.form.hotels[index].quared_price > 0){
                        this.form.hotels[index].room_total_price += parseInt(this.form.hotels[index].quared)*parseInt(this.form.hotels[index].quared_price)
                    }
                }
                this.changeTotalHotelPrice(index)


            },

            addNew(){
                if(this.form.hotels.length <= 1){
                    this.form.hotels.push({
                        hotel_name:'',
                        check_in:'',
                        check_out:'',
                        number_of_persons:'',
                        number_of_room:'',
                        hotel_booking_ref:'',
                        net_price:'',
                        price:'',
                        suplier:'',
                        room_category:'',
                        note:'',
                        address:'',

                        king_size:'',
                        king_size_price:'',
                        couple:'',
                        couple_price:'',
                        twin:'',
                        twin_price:'',
                        triple:'',
                        triple_price:'',
                        quared:'',
                        quared_price:'',

                        room_qty:'',
                        room_price:'',
                        room_total_price:'',
                        extra_bed_qty:'',
                        extra_bed_price:'',
                        extra_bed_total_price:'',
                        breakfast_qty:'',
                        breakfast_price:'',
                        breakfast_total_price:'',
                        early_check_in_qty:'',
                        early_check_in_price:'',
                        early_check_in_total_price:'',
                        late_check_out_qty:'',
                        late_check_out_price:'',
                        late_check_out_total_price:'',
                        total_hotel_price:'',
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
                this.$delete(this.form.hotels, index)
                console.log(this.form.hotels)
            },




            customerSelected(customer){
                this.form.client = customer.id;

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
            getAllSuplier(){
                axios.get('/api/get-all-active-suplier')
                    .then(response => {
                        this.supliers = response.data.supliers
                    })
            },



            sumPrice(){
                this.form.total_price = 0
                for(let i = 0; i < this.form.hotels.length; i++){
                    if(this.form.hotels[i].total_hotel_price != ''){
                        this.form.total_price += parseInt(this.form.hotels[i].total_hotel_price)
                    }
                }
            },
            sumNetPrice(){
                this.form.total_net_price = 0
                for(let i = 0; i < this.form.hotels.length; i++){
                    if(this.form.hotels[i].net_price != ''){
                        this.form.total_net_price += parseInt(this.form.hotels[i].net_price)
                    }
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