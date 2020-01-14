<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <router-link to="/dashboard">Home</router-link>
                    </li>

                    <li>
                        <router-link to="/staff-list">Staff List</router-link>
                    </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="page-header">
                    <h1>
                        Staff List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-staff" class="btn btn-success">Add New Staff</router-link>
                        </div>
                        <br/>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Photo</th>
                                        <th>Staff Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Received</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(staff, index) in  get_all_staffs">
                                        <td>{{index+1}}</td>
                                        <td><img heigth="30" width="40" :src="staff.image"></td>
                                        <td>{{staff.first_name}} {{staff.last_name}}</td>
                                        <td>{{staff.phone_number}}</td>
                                        <td>{{staff.email_address}}</td>
                                        <td>Service</td>
                                        <td>Received</td>
                                        <td>Due</td>
                                        <td class="hidden-480">
                                            <span v-if="staff.status == 1" class="label label-sm label-success">Active</span>
                                            <span v-else class="label label-sm label-danger">Inactive</span>
                                        </td>

                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

<!--                                                <button  @click="printInvoice()" class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </button>-->
                                                <router-link :to="`/view-staff/${staff.id}`" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </router-link>
                                                <router-link :to="`/edit-staff/${staff.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

                                                <button @click.prevent="deleteStaff(staff.id)" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div><!-- /.row -->

                        <div class="hr hr-18 dotted hr-double"></div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "ListStaffComponent",

        mounted() {
            this.$store.dispatch('allStaffs')
        },
        computed:{
            get_all_staffs(){
                return this.$store.getters.get_staffs
            }
        },
        methods:{
            deleteStaff(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.get('/api/delete-staff/'+id)
                            .then((response) => {
                                Toast.fire({
                                    type: 'success',
                                    title: 'Staff Deleted successfully'
                                })
                                this.$store.dispatch('allStaffs')
                                console.log(response.data)
                            })
                    }
                })

            },
            printInvoice(){
                axios.get('/download-invoice')
                    .then((response) => {
                        Toast.fire({
                            type: 'success',
                            title: 'Invoice Print successfully'
                        })
                    })
            }
        }
    }
</script>

<style scoped>

</style>