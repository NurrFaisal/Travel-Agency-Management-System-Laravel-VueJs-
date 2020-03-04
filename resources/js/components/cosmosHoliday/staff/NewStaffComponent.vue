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
                        <router-link to="/new-staff">New Staff</router-link>
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
                                        <h5 class="widget-title">Create new Staff</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/staff-list" class="btn btn-success">Staff List</router-link>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin: 0px 100px;">
                                            <form @submit.prevent="addStaffInformation()" class="form-horizontal" method="post" role="form">
                                                <h3>Personal Information</h3>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_name">
                                                                First Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.first_name" :class="{ 'is-invalid': form.errors.has('first_name') }"   class="col-xs-12 col-sm-12" id="first_name" name="first_name" placeholder="Enter Staff First Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="first_name"></has-error>
                                                            <span style="color: red">{{ errors.first('first_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="last_name">
                                                                Last Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.last_name" :class="{ 'is-invalid': form.errors.has('last_name') }"   class="col-xs-12 col-sm-12" id="last_name" name="last_name" placeholder="Enter Staff Last Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="last_name"></has-error>
                                                            <span style="color: red">{{ errors.first('last_name') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="email_address">
                                                                Email<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.email_address" :class="{ 'is-invalid': form.errors.has('email_address') }"   class="col-xs-12 col-sm-12" id="email_address" name="email_address" placeholder="Enter Staff Email Address" required="" type="email">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="email_address"></has-error>
                                                            <span style="color: red">{{ errors.first('email_address') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="date_of_birth">
                                                                Date Of Birth<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.date_of_birth" :class="{ 'is-invalid': form.errors.has('date_of_birth') }"   class="col-xs-12 col-sm-12" id="date_of_birth" name="date_of_birth"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="date_of_birth"></has-error>
                                                            <span style="color: red">{{ errors.first('date_of_birth') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="phone_number">
                                                                Phone Number<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.phone_number" :class="{ 'is-invalid': form.errors.has('phone_number') }"   class="col-xs-12 col-sm-12" id="phone_number" name="phone_number" placeholder="Enter Staff Phone Number" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="alt_phone_number">
                                                                Alt. Phone Number<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.alt_phone_number" :class="{ 'is-invalid': form.errors.has('alt_phone_number') }"   class="col-xs-12 col-sm-12" id="alt_phone_number" name="alt_phone_number" placeholder="Enter Staff Alt Phone Number"  required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="alt_phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('alt_phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="passport">
                                                                Passport No.<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.passport" :class="{ 'is-invalid': form.errors.has('passport') }"   class="col-xs-12 col-sm-12" id="passport" name="passport" placeholder="Enter Staff Passport Number" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="passport"></has-error>
                                                            <span style="color: red">{{ errors.first('passport') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="nid">
                                                                NID<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.nid" :class="{ 'is-invalid': form.errors.has('nid') }"   class="col-xs-12 col-sm-12" id="nid" name="nid" placeholder="Enter Staff NID Number"  required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="alt_phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('alt_phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="address">
                                                                Address.<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <textarea v-validate="'required'" v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }"   class="col-xs-12 col-sm-12" id="address" name="address" placeholder="Enter Staff Full Address" ></textarea>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="address"></has-error>
                                                            <span style="color: red">{{ errors.first('address') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="image">
                                                                Image<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input style="background-color: white!important;" name="photo" required  v-validate="'image'" data-vv-as="image" @change = "changePhoto($event)" type="file" required id="photo">
                                                            </span>
                                                            <br/>
                                                            <span class="block input-icon input-icon-right">
                                                                <img id="image" width="120" height="100" style="border: 5px solid #939393; display:none" name="image" :src="form.image" alt="" />
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="image"></has-error>
                                                            <span style="color: red">{{ errors.first('image') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="blood_group">
                                                                Blood Group<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.blood_group" :class="{ 'is-invalid': form.errors.has('blood_group') }"   class="col-xs-12 col-sm-12" id="blood_group" name="blood_group" placeholder="Enter Staff Blood Group"  required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="blood_group"></has-error>
                                                            <span style="color: red">{{ errors.first('blood_group') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3>Job Information</h3>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="designation">
                                                                Designation<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select :class="{ 'is-invalid': form.errors.has('designation') }" class="col-xs-12 col-sm-12" id="designation"
                                                                       name="designation" required
                                                                       v-model="form.designation"
                                                                       v-validate="'required'">
                                                                <option value="">--Select Staff Designation--</option>
                                                                <option :value="staff.id" v-for="staff in StaffDesignation">{{staff.staff_designation}}</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="designation"></has-error>
                                                            <span style="color: red">{{ errors.first('designation') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="staff_id">
                                                                Staff ID<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.staff_id" :class="{ 'is-invalid': form.errors.has('staff_id') }"   class="col-xs-12 col-sm-12" id="staff_id" name="staff_id" placeholder="Enter Staff ID" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="staff_id"></has-error>
                                                            <span style="color: red">{{ errors.first('staff_id') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="department">
                                                                Department<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                               <select :class="{ 'is-invalid': form.errors.has('department') }" class="col-xs-12 col-sm-12" id="department"
                                                                       name="department" required
                                                                       v-model="form.department"
                                                                       v-validate="'required'">
                                                                <option value="">--Select Staff Department--</option>
                                                                <option :value="department.id" v-for="department in allDepartment">{{department.department_name}}</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="department"></has-error>
                                                            <span style="color: red">{{ errors.first('department') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="location">
                                                                Location<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('location') }" class="col-xs-12 col-sm-12" id="location"
                                                                        name="location" required
                                                                        v-model="form.location"
                                                                        v-validate="'required'">
                                                                <option value="">--Select Staff Service Location--</option>
                                                                <option value="1">Dhanmondi</option>
                                                                <option value="2">Banani</option>
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offst-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="location"></has-error>
                                                            <span style="color: red">{{ errors.first('location') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="start_date">
                                                                Start Date<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.start_date" :class="{ 'is-invalid': form.errors.has('start_date') }"   class="col-xs-12 col-sm-12" id="start_date" name="start_date"  required="" type="date">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="start_date"></has-error>
                                                            <span style="color: red">{{ errors.first('start_date') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="salary">
                                                                Salary<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.salary" :class="{ 'is-invalid': form.errors.has('salary') }"   class="col-xs-12 col-sm-12" id="salary" name="salary" placeholder="Enter Staff Salary" required="" type="number">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="salary"></has-error>
                                                            <span style="color: red">{{ errors.first('salary') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3>Emergency Contact information</h3>
                                                <h5>First Person</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_person_name">
                                                                Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.first_person_name" :class="{ 'is-invalid': form.errors.has('first_person_name') }"   class="col-xs-12 col-sm-12" id="first_person_name" name="first_person_name" placeholder="Enter Staff Contact Person Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="first_person_name"></has-error>
                                                            <span style="color: red">{{ errors.first('first_person_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_person_phone_number">
                                                                Phone Number<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.first_person_phone_number" :class="{ 'is-invalid': form.errors.has('first_person_phone_number') }"   class="col-xs-12 col-sm-12" id="first_person_phone_number" name="first_person_phone_number" placeholder="Enter Staff Contact Person Phone Number" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="first_person_phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('first_person_phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="first_person_relationship">
                                                                Reletionship<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.first_person_relationship" :class="{ 'is-invalid': form.errors.has('first_person_relationship') }"   class="col-xs-12 col-sm-12" id="first_person_relationship" name="person_reletionship_one" placeholder="Enter Staff Contact Person Reletionship" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="person_reletionship_one"></has-error>
                                                            <span style="color: red">{{ errors.first('person_reletionship_one') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5>Second Person</h5>
                                                <div class="form-group ">
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="second_person_name">
                                                                Name<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.second_person_name" :class="{ 'is-invalid': form.errors.has('second_person_name') }"   class="col-xs-12 col-sm-12" id="second_person_name" name="second_person_name" placeholder="Enter Staff Cotact Person Name" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="second_person_name"></has-error>
                                                            <span style="color: red">{{ errors.first('second_person_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="second_person_phone_number">
                                                                Phone Number<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.second_person_phone_number" :class="{ 'is-invalid': form.errors.has('second_person_phone_number') }"   class="col-xs-12 col-sm-12" id="second_person_phone_number" name="second_person_phone_number" placeholder="Enter Staff Contact Person Phone Number" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="second_person_phone_number"></has-error>
                                                            <span style="color: red">{{ errors.first('second_person_phone_number') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="second_person_relationship">
                                                                Reletionship<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required'" v-model="form.second_person_relationship" :class="{ 'is-invalid': form.errors.has('second_person_relationship') }"   class="col-xs-12 col-sm-12" id="second_person_relationship" name="second_person_relationship" placeholder="Enter Staff Contact Person Reletionship" required="" type="text">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="second_person_relationship"></has-error>
                                                            <span style="color: red">{{ errors.first('second_person_relationship') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3>Login Information</h3>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="email_address">
                                                                Email<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input readonly v-model="form.email_address"    class="col-xs-12 col-sm-12" id="email_address" name="email_address" placeholder="Enter Staff Email Address" required="" type="email">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="location">
                                                                User Type<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <select :class="{ 'is-invalid': form.errors.has('user_type') }"  class="col-xs-12 col-sm-12" id="user_type"
                                                                        name="location" required
                                                                        v-model="form.user_type"
                                                                        v-validate="'required'">
                                                                    <option value="">--Select User Type--</option>
                                                                    <option value="user">User</option>-->
                                                                    <option value="operation">Operation</option>
                                                                    <option value="admin">Admin</option>
<!--                                                                    <option value="super-admin">Super Admin</option>-->
                                                            </select>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="user_type"></has-error>
                                                            <span style="color: red">{{ errors.first('user_type') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="password">
                                                                Password<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required|min:6|max:35|confirmed:confirm_password'" ref="password"  v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }"   class="col-xs-12 col-sm-12" id="password" name="password" placeholder="Enter Password" required="" type="password">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="password"></has-error>
                                                            <span style="color: red">{{ errors.first('password') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="confirm_password">
                                                                Confirm Passwored<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <input v-validate="'required|confirmed:password'"  ref="confirm_password" v-model="form.confirm_password" :class="{ 'is-invalid': form.errors.has('confirm_password') }"   class="col-xs-12 col-sm-12" id="confirm_password" name="confirm_password" placeholder="Enter confirm Password" required="" type="password">
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="confirm_password"></has-error>
                                                            <span style="color: red">{{ errors.first('confirm_password') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <label for="status">
                                                                Status<span class="text-danger">*</span> :
                                                            </label>
                                                            <span class="block input-icon input-icon-right">
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input checked  v-model="form.status" class="ace input-sm" name="status" type="radio" value="1">
                                                                        <span class="lbl"> Active</span>
                                                                    </label>
                                                                </div>
                                                                <div class="radio col-md-6">
                                                                    <label>
                                                                        <input v-model="form.status" class="ace input-sm" name="status" type="radio" value="0">
                                                                        <span class="lbl"> Inactive</span>
                                                                    </label>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="col-xs-offset-2 col-xs-9 text-danger">
                                                            <has-error style="color:red" :form="form" field="status"></has-error>
                                                            <span style="color: red">{{ errors.first('status') }}</span>
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
                                                            Submit
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

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "NewStaffComponent",
        components: {
            Loading
        },
        data(){
          return {
              searchText:'',
              width:128,
              height:128,
              isLoading: false,
              fullPage: false,
              user_type:'',
              staff_count:'',

              form: new Form({
                  //Personal Information
                  first_name: '',
                  last_name: '',
                  email_address: '',
                  date_of_birth: '',
                  phone_number: '',
                  alt_phone_number: '',
                  address: '',
                  nid: '',
                  passport: '',
                  blood_group: '',
                  image: '',
                  //Job Information
                  designation: '',
                  staff_id: '',
                  department: '',
                  location: '',
                  start_date: '',
                  salary: '',
                  //Emergency Contact Information
                  first_person_name: '',
                  first_person_phone_number: '',
                  first_person_relationship: '',
                  second_person_name: '',
                  second_person_phone_number: '',
                  second_person_relationship: '',
                  //Login Information
                  user_type: '',
                  password: '',
                  confirm_password: '',

                  status: '1'

              })
          }
        },
        mounted() {
            this.isLoading = true
            this.$store.dispatch('allStaffDesignation')
            this.$store.dispatch('allDepartment')
            this.doAjax()
        },
        computed:{
            StaffDesignation(){
                return this.$store.getters.get_staff_designation_name;
            },
            allDepartment(){
                return this.$store.getters.get_department
            }
        },
        methods:{
            addStaffInformation(){
                this.isLoading = true
                if(this.form.password === this.form.confirm_password){
                    this.form.post('/api/add-staff-information')
                        .then((response) => {
                                this.form.first_name = ''
                                this.form.last_name = ''
                                this.form.email_address = ''
                                this.form.date_of_birth = ''
                                this.form.phone_number = ''
                                this.form.alt_phone_number = ''
                                this.form.address = ''
                                this.form.nid = ''
                                this.form.passport = ''
                                this.form.blood_group = ''
                                this.form.image = ''
                                //Job Information
                                this.form.designation = ''
                                this.form.staff_id = ''
                                this.form.department = ''
                                this.form.location = ''
                                this.form.start_date = ''
                                this.form.salary = ''
                                //Emergency Contact Information
                                this.form.first_person_name = ''
                                this.form.first_person_phone_number = ''
                                this.form.first_person_relationship = ''
                                this.form.second_person_name = ''
                                this.form.second_person_phone_number = ''
                                this.form.second_person_relationship = ''
                                //Login Information
                                this.form.user_type = ''
                                this.form.password = ''
                                this.form.confirm_password = ''

                                this.form.status = ''
                            this.$router.push('/staff-list')
                            Toast.fire({
                                type: 'success',
                                title: 'New Staff Added successfully'
                            })
                            this.doAjax()
                        })
                        .catch((response) => {
                            this.doAjax()
                        })
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Password and Confirm-password not match!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },
            changePhoto(event){
                $('#image').show()
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    // The file's text will be printed here
                   this.form.image = event.target.result
                };

                reader.readAsDataURL(file);
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
