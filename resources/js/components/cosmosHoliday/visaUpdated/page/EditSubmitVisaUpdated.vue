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
                                        <h5 class="widget-title">Update Submited Visa Information</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/visa-updated-list" class="btn btn-success">Visa List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="updateVisaUpdated()" class="form-horizontal" method="post" role="form">
                                                <div v-for="(passport, index) in form.passports" style="background-color: #f6f6f6; padding: 15px; margin: 20px;padding-bottom: 55px; cursor: pointer;">
                                                    <div class="row">
                                                        <button v-if="index > 0"  @click.prevent="deleteHotels(index)" class="float-right" style="float: right;background: #dff0d8;margin-top: -14px">X</button>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="name">
                                                                    Name<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="passport.name" :class="{ 'is-invalid': form.errors.has('name') }"   class="col-xs-12 col-sm-12" id="name" name="name" placeholder="Enter Name"  required type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="name"></has-error>
                                                                <span style="color: red">{{ errors.first('name') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="passport_number">
                                                                    Passport Number<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="passport.passport_number" :class="{ 'is-invalid': form.errors.has('passport_number') }"   class="col-xs-12 col-sm-12" id="passport_number" name="passport_number" required placeholder="Enter Passport Number" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="passport_number"></has-error>
                                                                <span style="color: red">{{ errors.first('passport_number') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="no_of_books">
                                                                    No. Of Books<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="passport.no_of_books" :class="{ 'is-invalid': form.errors.has('no_of_books') }"   class="col-xs-12 col-sm-12" id="no_of_books" name="no_of_books" placeholder="Enter number of books" required type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="no_of_books"></has-error>
                                                                <span style="color: red">{{ errors.first('no_of_books') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="date_of_birth">
                                                                    Date Of Birth<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="passport.date_of_birth" :class="{ 'is-invalid': form.errors.has('date_of_birth') }"   class="col-xs-12 col-sm-12" id="date_of_birth" name="date_of_birth"  required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="date_of_birth"></has-error>
                                                                <span style="color: red">{{ errors.first('date_of_birth') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="expire_date">
                                                                    Expire Date<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="passport.expire_date" :class="{ 'is-invalid': form.errors.has('expire_date') }"   class="col-xs-12 col-sm-12" id="expire_date" name="expire_date" required type="date">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="expire_date"></has-error>
                                                                <span style="color: red">{{ errors.first('expire_date') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="type">
                                                                    Type <span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('type') }" v-model="passport.type" id="type" name="type" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Type--</option>
                                                                     <option :value="type.id" v-for="type in getAllVisaCategory" >{{type.name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="type"></has-error>
                                                                <span style="color: red">{{ errors.first('type') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="country">
                                                                    Country<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('country') }" v-model="passport.country" id="country" name="country" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Country--</option>
                                                                    <option :value="country.id" v-for="country in getAllVisaCountry " >{{country.name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="country"></has-error>
                                                                <span style="color: red">{{ errors.first('country') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="suplier">
                                                                    Suplier<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                               <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('suplier') }" v-model="passport.suplier" id="suplier" name="suplier" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Title--</option>
                                                                    <option  :value="suplier.id" v-for="suplier in supliers " >{{suplier.name}}</option>
                                                                </select>
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="suplier"></has-error>
                                                                <span style="color: red">{{ errors.first('suplier') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="net_price">
                                                                    Net Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
                                                                    <input @keyup="sumNetPrice()" v-validate="'required'" v-model="passport.net_price" :class="{ 'is-invalid': form.errors.has('net_price') }"   class="col-xs-12 col-sm-12" id="net_price" name="net_price" required placeholder="Enter Net Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="net_price"></has-error>
                                                                <span style="color: red">{{ errors.first('net_price') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="price">
                                                                    Price<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
<!--                                                                <input v-validate="'required'" v-model="employee.issue_date" :class="{ 'is-invalid': form.errors.has('issue_date') }"   class="col-xs-12 col-sm-12" id="issue_date" name="issue_date"  required type="text">-->
                                                                   <input @keyup="sumPrice()" v-validate="'required'" v-model="passport.price" :class="{ 'is-invalid': form.errors.has('price') }"   class="col-xs-12 col-sm-12" id="price" name="price" required placeholder="Enter Price" type="number">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="price"></has-error>
                                                                <span style="color: red">{{ errors.first('price') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="narration">
                                                                    Narration<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
<!--                                                                <input v-validate="'required'" v-model="employee.issue_date" :class="{ 'is-invalid': form.errors.has('issue_date') }"   class="col-xs-12 col-sm-12" id="issue_date" name="issue_date"  required type="text">-->
                                                                   <input v-validate="'required'" v-model="passport.narration" :class="{ 'is-invalid': form.errors.has('narration') }"   class="col-xs-12 col-sm-12" id="narration" name="narration" required placeholder="Enter Some Narration" type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="narration"></has-error>
                                                                <span style="color: red">{{ errors.first('narration') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="col-md-12">
                                                            <div class="col-xs-12 col-sm-12">
                                                                <label for="old_passport">
                                                                    Old Passport<span class="text-danger">*</span> :
                                                                </label>
                                                                <span class="block input-icon input-icon-right">
<!--                                                                <input v-validate="'required'" v-model="employee.issue_date" :class="{ 'is-invalid': form.errors.has('issue_date') }"   class="col-xs-12 col-sm-12" id="issue_date" name="issue_date"  required type="text">-->
                                                                   <input v-validate="'required'" v-model="passport.old_passport" :class="{ 'is-invalid': form.errors.has('old_passport') }"   class="col-xs-12 col-sm-12" id="old_passport" name="old_passport" required placeholder="Enter Old Passport Number Here..." type="text">
                                                            </span>
                                                            </div>
                                                            <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                                <has-error style="color:red" :form="form" field="old_passport"></has-error>
                                                                <span style="color: red">{{ errors.first('old_passport') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="float: right">
                                                        <button class="btnAddNew" @click.prevent="addNew()">add</button>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: right;">Urgent : </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="urgent_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="urgentChange()" v-model="form.urgent_qty"  :class="{ 'is-invalid': form.errors.has('urgent_qty') }"   class="col-xs-12 col-sm-12" id="urgent_qty" name="urgent_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="urgent_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('urgent_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="urgent_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="urgentChange()"  v-model="form.urgent_price"  :class="{ 'is-invalid': form.errors.has('urgent_price') }"   class="col-xs-12 col-sm-12" id="urgent_price" name="urgent_price" placeholder="Enter Urgent Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="urgent_price"></has-error>
                                                            <span style="color: red">{{ errors.first('urgent_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="urgent_total_price">
                                                                Urgent Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.urgent_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('urgent_total_price') }"   class="col-xs-12 col-sm-12" id="urgent_total_price" name="urgent_total_price" placeholder="Urgent Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="urgent_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('urgent_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: right;">Online Visa : </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="online_visa_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="onlineVisaChange()" v-model="form.online_visa_qty"  :class="{ 'is-invalid': form.errors.has('online_visa_qty') }"   class="col-xs-12 col-sm-12" id="online_visa_qty" name="online_visa_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="online_visa_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('online_visa_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="online_visa_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="onlineVisaChange()"  v-model="form.online_visa_price"  :class="{ 'is-invalid': form.errors.has('online_visa_price') }"   class="col-xs-12 col-sm-12" id="online_visa_price" name="online_visa_price" placeholder="Enter Online Visa Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="online_visa_price"></has-error>
                                                            <span style="color: red">{{ errors.first('online_visa_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="online_visa_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.online_visa_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('online_visa_total_price') }"   class="col-xs-12 col-sm-12" id="online_visa_total_price" name="online_visa_total_price" placeholder="Online Visa Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="online_visa_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('online_visa_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: right;">Notary : </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="notary_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="notaryChange()" v-model="form.notary_qty"  :class="{ 'is-invalid': form.errors.has('notary_qty') }"   class="col-xs-12 col-sm-12" id="notary_qty" name="notary_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="notary_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('notary_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="notary_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="notaryChange()"  v-model="form.notary_price"  :class="{ 'is-invalid': form.errors.has('notary_price') }"   class="col-xs-12 col-sm-12" id="notary_price" name="notary_price" placeholder="Enter notary price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="notary_price"></has-error>
                                                            <span style="color: red">{{ errors.first('notary_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="notary_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.notary_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('notary_total_price') }"   class="col-xs-12 col-sm-12" id="notary_total_price" name="notary_total_price" placeholder="Enter Notary Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="notary_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('notary_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: right;">Invitation Letter : </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="invitation_letter_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="invitationLetterChange()" v-model="form.invitation_letter_qty"  :class="{ 'is-invalid': form.errors.has('invitation_letter_qty') }"   class="col-xs-12 col-sm-12" id="invitation_letter_qty" name="invitation_letter_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="invitation_letter_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('invitation_letter_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="invitation_letter_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="invitationLetterChange()"  v-model="form.invitation_letter_price"  :class="{ 'is-invalid': form.errors.has('invitation_letter_price') }"   class="col-xs-12 col-sm-12" id="invitation_letter_price" name="invitation_letter_price" placeholder="Enter Invitation Letter Total Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="invitation_letter_price"></has-error>
                                                            <span style="color: red">{{ errors.first('invitation_letter_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="invitation_letter_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.invitation_letter_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('invitation_letter_total_price') }"   class="col-xs-12 col-sm-12" id="invitation_letter_total_price" name="invitation_letter_total_price" placeholder="Invitation Letter Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="invitation_letter_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('invitation_letter_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: right;">Land Valuation : </h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="land_valuation_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="landValuationChange()" v-model="form.land_valuation_qty"  :class="{ 'is-invalid': form.errors.has('land_valuation_qty') }"   class="col-xs-12 col-sm-12" id="land_valuation_qty" name="land_valuation_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="land_valuation_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('land_valuation_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="land_valuation_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="landValuationChange()"  v-model="form.land_valuation_price"  :class="{ 'is-invalid': form.errors.has('land_valuation_price') }"   class="col-xs-12 col-sm-12" id="land_valuation_price" name="land_valuation_price" placeholder="Enter Land Valuation Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="land_valuation_price"></has-error>
                                                            <span style="color: red">{{ errors.first('land_valuation_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="land_valuation_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.land_valuation_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('land_valuation_total_price') }"   class="col-xs-12 col-sm-12" id="land_valuation_total_price" name="land_valuation_total_price"  placeholder="Land Valuation Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="land_valuation_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('land_valuation_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <h4 style="text-align: right;">Lawyer Fees :</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="lawyer_fees_qty">
                                                                Qty<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="lawyerFeesChange()" v-model="form.lawyer_fees_qty"  :class="{ 'is-invalid': form.errors.has('lawyer_fees_qty') }"   class="col-xs-12 col-sm-12" id="lawyer_fees_qty" name="lawyer_fees_qty" placeholder="Qty" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="lawyer_fees_qty"></has-error>
                                                            <span style="color: red">{{ errors.first('lawyer_fees_qty') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="lawyer_fees_price">
                                                                Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input  @keyup="lawyerFeesChange()"  v-model="form.lawyer_fees_price"  :class="{ 'is-invalid': form.errors.has('lawyer_fees_price') }"   class="col-xs-12 col-sm-12" id="lawyer_fees_price" name="lawyer_fees_price" placeholder="Enter Lawyer Fees Price" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="lawyer_fees_price"></has-error>
                                                            <span style="color: red">{{ errors.first('lawyer_fees_price') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="lawyer_fees_total_price">
                                                                Total Price<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input disabled v-model="form.lawyer_fees_total_price" v-validate="'required'"  :class="{ 'is-invalid': form.errors.has('lawyer_fees_total_price') }"   class="col-xs-12 col-sm-12" id="lawyer_fees_total_price" name="lawyer_fees_total_price" placeholder="Lawyer Fees Total Price" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="lawyer_fees_total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('lawyer_fees_total_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/>
                                                <br/>

                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_net_price">
                                                                Total Net Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.total_net_price" :class="{ 'is-invalid': form.errors.has('total_net_price') }"   class="col-xs-12 col-sm-12" id="total_net_price" name="total_net_price" disabled placeholder="Enter Total Net Price" required="" type="number">
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
                                                                <input v-validate="'required'" v-model="form.total_price" :class="{ 'is-invalid': form.errors.has('total_price') }"   class="col-xs-12 col-sm-12" id="total_price" name="total_price" placeholder="Enter Total Price" disabled required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="total_others_price">
                                                                Total Others Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.total_others_price" :class="{ 'is-invalid': form.errors.has('total_others_price') }"   class="col-xs-12 col-sm-12" id="total_others_price" name="total_others_price" placeholder="Enter Total Net Price" disabled required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_net_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_net_price') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="grand_total_price">
                                                                Grand Total Price <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.grand_total_price" :class="{ 'is-invalid': form.errors.has('grand_total_price') }"   class="col-xs-12 col-sm-12" id="grand_total_price" name="grand_total_price"  disabled required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="total_net_price"></has-error>
                                                            <span style="color: red">{{ errors.first('total_net_price') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="received_date">
                                                                Received Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.received_date" :class="{ 'is-invalid': form.errors.has('received_date') }"   class="col-xs-12 col-sm-12" id="received_date" name="received_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="received_date"></has-error>
                                                            <span style="color: red">{{ errors.first('received_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="">
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
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="word">
                                                                Word <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.word" :class="{ 'is-invalid': form.errors.has('word') }"   class="col-xs-12 col-sm-12" id="word" name="word" placeholder="Enter amount in word" required type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="word"></has-error>
                                                            <span style="color: red">{{ errors.first('word') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="invoice_narration">
                                                                Invoice Narration <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.invoice_narration" :class="{ 'is-invalid': form.errors.has('invoice_narration') }"   class="col-xs-12 col-sm-12" id="invoice_narration" name="invoice_narration" required="" type="text" placeholder="Enter Invoice Narraion">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="invoice_narration"></has-error>
                                                            <span style="color: red">{{ errors.first('invoice_narration') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="special_note">
                                                                Special Note <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <textarea v-validate="'required'" v-model="form.special_note" :class="{ 'is-invalid': form.errors.has('special_note') }"   class="col-xs-12 col-sm-12" id="special_note" name="special_note" required="" type="text" placeholder="Enter Some Special Notes"></textarea>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="special_note"></has-error>
                                                            <span style="color: red">{{ errors.first('special_note') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="work_date">
                                                                Work Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.work_date" :class="{ 'is-invalid': form.errors.has('work_date') }"   class="col-xs-12 col-sm-12" id="work_date" name="work_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="work_date"></has-error>
                                                            <span style="color: red">{{ errors.first('work_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="work_by">
                                                                Work By <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('work_by') }" required v-model="form.work_by" id="work_by" name="work_by" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Work By--</option>
                                                                    <option  :value="staff.id" v-for="staff in getAllStaff " >{{staff.first_name+' '+ staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="work_by"></has-error>
                                                            <span style="color: red">{{ errors.first('work_by') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="notary_date">
                                                                Notary Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.notary_date" :class="{ 'is-invalid': form.errors.has('notary_date') }"   class="col-xs-12 col-sm-12" id="notary_date" name="notary_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="notary_date"></has-error>
                                                            <span style="color: red">{{ errors.first('notary_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="notary_by">
                                                                Notary By <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('notary_by') }" required v-model="form.notary_by" id="notary_by" name="notary_by" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Notary By--</option>
                                                                    <option  :value="staff.id" v-for="staff in getAllStaff " >{{staff.first_name+' '+ staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="notary_by"></has-error>
                                                            <span style="color: red">{{ errors.first('notary_by') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="checked_by_asst_date">
                                                                Checked By Asst Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.checked_by_asst_date" :class="{ 'is-invalid': form.errors.has('checked_by_asst_date') }"   class="col-xs-12 col-sm-12" id="checked_by_asst_date" name="checked_by_asst_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="checked_by_asst_date"></has-error>
                                                            <span style="color: red">{{ errors.first('checked_by_asst_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="checked_by_asst">
                                                                Checked By Asst <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('checked_by_asst') }" required v-model="form.checked_by_asst" id="checked_by_asst" name="checked_by_asst" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select By Asst--</option>
                                                                    <option  :value="staff.id" v-for="staff in getAllStaff " >{{staff.first_name+' '+ staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="checked_by_asst"></has-error>
                                                            <span style="color: red">{{ errors.first('checked_by_asst') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="checked_by_officer_date">
                                                                Checked By Officer Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.checked_by_officer_date" :class="{ 'is-invalid': form.errors.has('checked_by_officer_date') }"   class="col-xs-12 col-sm-12" id="checked_by_officer_date" name="checked_by_officer_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="checked_by_officer_date"></has-error>
                                                            <span style="color: red">{{ errors.first('checked_by_officer_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="checked_by_officer">
                                                                Checked By Officer <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('checked_by_officer') }" required v-model="form.checked_by_officer" id="checked_by_officer" name="checked_by_officer" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select By Officer--</option>
                                                                    <option  :value="staff.id" v-for="staff in getAllStaff " >{{staff.first_name+' '+ staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="checked_by_officer"></has-error>
                                                            <span style="color: red">{{ errors.first('checked_by_officer') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="submit_date">
                                                                Submit Date <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.submit_date" :class="{ 'is-invalid': form.errors.has('submit_date') }"   class="col-xs-12 col-sm-12" id="submit_date" name="submit_date" required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="submit_date"></has-error>
                                                            <span style="color: red">{{ errors.first('submit_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="submit_by">
                                                                Submit by <span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select v-validate="'required'" :class="{ 'is-invalid': form.errors.has('submit_by') }" required v-model="form.submit_by" id="submit_by" name="submit_by" class="col-xs-12 col-sm-12" >
                                                                    <option value="">--Select Submit By--</option>
                                                                    <option  :value="staff.id" v-for="staff in getAllStaff " >{{staff.first_name+' '+ staff.last_name}}</option>
                                                                </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="submit_by"></has-error>
                                                            <span style="color: red">{{ errors.first('submit_by') }}</span>
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
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    import GuestAutoComplate from "../../searchSelect/GuestAutoComplate";
    export default {
        name: "EditSubmitVisaUpdated",
        components: {GuestAutoComplate, Loading},
        mounted(){
            this.isLoading = true
            this.$store.dispatch("allVisaStaff")
            this.$store.dispatch("allVisaCategory")
            this.$store.dispatch("allVisaCountry")
            this.getAllSuplier()
            this.editVisaUpdate()
        },
        computed:{
            getAllStaff(){
                return this.$store.getters.get_visa_staff
            },
            getAllVisaCategory(){
                return this.$store.getters.get_visa_category
            },
            getAllVisaCountry(){
                return this.$store.getters.get_visa_country
            },
        },
        data(){

            return {
                guests: '',
                supliers: '',

                name:'',
                phone_number:'',
                user_type:'',

                width:128,
                height:128,
                isLoading: false,
                fullPage: false,

                form: new Form({
                    id:'',
                    passports: [
                        {
                            name:'',
                            passport_number:'',
                            no_of_books:'',
                            date_of_birth:'',
                            expire_date:'',
                            type:'',
                            country:'',
                            suplier:'',
                            net_price:'',
                            price:'',
                            old_passport:'',
                            narration:'',
                        }
                    ],
                    urgent_qty:'',
                    urgent_price:'',
                    urgent_total_price:'',
                    online_visa_qty:'',
                    online_visa_price:'',
                    online_visa_total_price:'',
                    notary_qty:'',
                    notary_price:'',
                    notary_total_price:'',
                    invitation_letter_qty:'',
                    invitation_letter_price:'',
                    invitation_letter_total_price:'',
                    land_valuation_qty:'',
                    land_valuation_price:'',
                    land_valuation_total_price:'',
                    lawyer_fees_qty:'',
                    lawyer_fees_price:'',
                    lawyer_fees_total_price:'',

                    total_net_price:0,
                    total_price:0,
                    total_others_price: 0,
                    grand_total_price:0,
                    received_date: '',
                    client: '',
                    invoice_narration: '',
                    word: '',
                    special_note:'',

                    work_date:'',
                    work_by:'',
                    notary_date:'',
                    notary_by:'',
                    checked_by_asst_date:'',
                    checked_by_asst:'',
                    checked_by_officer_date:'',
                    checked_by_officer:'',
                    submit_by:'',
                    submit_date:'',
                })
            }
        },
        methods:{
            addNew(){
                if(this.form.passports.length <= 9){
                    this.form.passports.push(
                        {
                            name:'',
                            passport_number:'',
                            no_of_books:'',
                            date_of_birth:'',
                            expire_date:'',
                            type:'',
                            country:'',
                            suplier:'',
                            net_price:'',
                            price:'',
                            old_passport:'',
                            narration:'',
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
                this.$delete(this.form.passports, index)
            },

            editVisaUpdate(){
                axios.get(`/api/edit-received-visa-updated/${this.$route.params.id}`)
                    .then((respose) => {
                        this.form.fill(respose.data.received_visa)
                        this.name = respose.data.received_visa.guest.name;
                        this.phone_number = respose.data.received_visa.guest.phone_number;
                        this.user_type = respose.data.user_type;
                        if(this.user_type == 'admin' || this.user_type == 'super-admin'){
                            this.buttonContent = true
                        }
                        this.isLoading = false
                    })
            },



            updateVisaUpdated(){
                this.isLoading = true
                this.form.post('/api/update-visa-updated-submit-by')
                    .then((response) => {
                        this.form.id=''
                        this.form.passports = [
                            {
                                name:'',
                                passport_number:'',
                                no_of_books:'',
                                date_of_birth:'',
                                expire_date:'',
                                type:'',
                                country:'',
                                suplier:'',
                                net_price:'',
                                price:'',
                                old_passport:'',
                                narration:'',
                            }
                        ]
                        this.form.urgent_qty = ''
                        this.form.urgent_price = ''
                        this.form.urgent_total_price = ''
                        this.form.online_visa_qty = ''
                        this.form.online_visa_price = ''
                        this.form.online_visa_total_price = ''
                        this.form.notary_qty = ''
                        this.form.notary_price = ''
                        this.form.notary_total_price = ''
                        this.form.invitation_letter_qty = ''
                        this.form.invitation_letter_price = ''
                        this.form.invitation_letter_total_price = ''
                        this.form.land_valuation_qty = ''
                        this.form.land_valuation_price = ''
                        this.form.land_valuation_total_price = ''
                        this.form.lawyer_fees_qty = ''
                        this.form.lawyer_fees_price = ''
                        this.form.lawyer_fees_total_price = ''

                        this.form.total_net_price = ''
                        this.form.total_price = ''
                        this.form.total_others_price = ''
                        this.form.grand_total_price = ''
                        this.form.client = ''
                        this.form.received_date = ''
                        this.form.invoice_narration = ''
                        this.form.word = ''
                        this.form.special_note = ''

                        this.form.work_date = ''
                        this.form.work_by = ''
                        this.form.notary_date = ''
                        this.form.notary_by = ''
                        this.form.checked_by_asst_date = ''
                        this.form.checked_by_asst = ''
                        this.form.checked_by_officer_date = ''
                        this.form.checked_by_officer = ''
                        this.form.submit_by = ''
                        this.form.submit_date = ''


                        this.$router.push('/visa-updated-list')
                        this.isLoading = false
                        Toast.fire({
                            type: 'success',
                            title: 'VISA info successfully updated'
                        })
                    })
                    .catch((response) => {
                        this.isLoading = true
                    })
            },
            sumPrice(){
                this.form.total_price = 0
                for(let i = 0; i < this.form.passports.length; i++){
                    if(this.form.passports[i].price != ''){
                        this.form.total_price += parseInt(this.form.passports[i].price)
                    }
                }
                this.grandTotalPrice()
            },
            sumNetPrice(){
                this.form.total_net_price = 0
                for(let i = 0; i < this.form.passports.length; i++){
                    if(this.form.passports[i].net_price != ''){
                        this.form.total_net_price += parseInt(this.form.passports[i].net_price)
                    }
                }
            },
            sumOthersPrice(){
                this.form.total_others_price = 0
                if(this.form.urgent_total_price > 0){
                    this.form.total_others_price +=parseInt(this.form.urgent_total_price);
                }
                if(this.form.online_visa_total_price > 0){
                    this.form.total_others_price +=parseInt(this.form.online_visa_total_price);
                }
                if(this.form.notary_total_price > 0){
                    this.form.total_others_price +=parseInt(this.form.notary_total_price);
                }
                if(this.form.invitation_letter_total_price > 0){
                    this.form.total_others_price +=parseInt(this.form.invitation_letter_total_price);
                }
                if(this.form.land_valuation_total_price > 0){
                    this.form.total_others_price +=parseInt(this.form.land_valuation_total_price);
                }
                if(this.form.lawyer_fees_total_price > 0){
                    this.form.total_others_price +=parseInt(this.form.lawyer_fees_total_price);
                }
                this.grandTotalPrice()


            },
            grandTotalPrice(){
                this.form.grand_total_price = 0
                if(this.form.total_price > 0){
                    this.form.grand_total_price += parseInt(this.form.total_price)
                }
                if(this.form.total_others_price > 0){
                    this.form.grand_total_price += parseInt(this.form.total_others_price)
                }
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
            urgentChange(){
                if(this.form.urgent_qty != '' && this.form.urgent_price){
                    this.form.urgent_total_price = this.form.urgent_qty*this.form.urgent_price;
                }else{
                    this.form.urgent_total_price = 0;

                }
                this.sumOthersPrice()
            },
            onlineVisaChange(){
                if(this.form.online_visa_qty != '' && this.form.online_visa_price){
                    this.form.online_visa_total_price = this.form.online_visa_qty*this.form.online_visa_price;
                }else{
                    this.form.online_visa_total_price = 0;

                }
                this.sumOthersPrice()
            },
            notaryChange(){
                if(this.form.notary_qty != '' && this.form.notary_price){
                    this.form.notary_total_price = this.form.notary_qty*this.form.notary_price;
                }else{
                    this.form.notary_total_price = 0;

                }
                this.sumOthersPrice()
            },
            invitationLetterChange(){

                if(this.form.invitation_letter_qty != '' && this.form.invitation_letter_price){
                    this.form.invitation_letter_total_price = this.form.invitation_letter_qty*this.form.invitation_letter_price;

                }else{
                    this.form.invitation_letter_total_price = 0;

                }
                this.sumOthersPrice()
            },
            landValuationChange(){

                if(this.form.land_valuation_qty != '' && this.form.land_valuation_price){
                    this.form.land_valuation_total_price = this.form.land_valuation_qty*this.form.land_valuation_price;

                }else{
                    this.form.land_valuation_total_price = 0;

                }
                this.sumOthersPrice()
            },
            lawyerFeesChange(){

                if(this.form.lawyer_fees_qty != '' && this.form.lawyer_fees_price){
                    this.form.lawyer_fees_total_price = this.form.lawyer_fees_qty*this.form.lawyer_fees_price;

                }else{
                    this.form.lawyer_fees_total_price = 0;

                }
                this.sumOthersPrice()
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