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
                        <router-link to="/staff-designation-list">Staff Designation List</router-link>
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
                        Staff Designation List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-staff-designation" class="btn btn-success">Add New Staff Designation</router-link>
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
                                        <th class="center">Sl.</th>
                                        <th>Staff Designation</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(staff_designation, index) in  getAllStaffDesignation">
                                        <td class="center">{{index+1}}</td>



                                        <td>{{staff_designation.staff_designation}}</td>
                                        <td>{{staff_designation.updated_at | timeformate}}</td>

                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </button>
                                                <router-link :to="`/edit-staff-designation/${staff_designation.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

                                                <button @click.prevent="deleteStaffDesignation(staff_designation.id)" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>

                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																			<span class="blue">
																				<i class="ace-icon fa fa-search-plus bigger-120"></i>
																			</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																			<span class="green">
																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																			</span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" @click.prevent="deleteStaffDesignation(guest_title.id)" class="tooltip-error" data-rel="tooltip" title="Delete">
																			<span class="red">
																				<i class="ace-icon fa fa-trash-o bigger-120"></i>
																			</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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
        name: "ListStaffDesignaitonComponent",
        mounted() {
            this.$store.dispatch('allStaffDesignation')
        },
        computed:{
            getAllStaffDesignation(){
                return this.$store.getters.get_staff_designation_name
            }
        },
        methods:{
            deleteStaffDesignation(id){
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
                        axios.get('/api/delete-staff-designation/'+id)
                            .then((response) => {
                                Toast.fire({
                                    type: 'success',
                                    title: 'Staff Designation Deleted successfully'
                                })
                                this.$store.dispatch('allStaffDesignation')
                                console.log(response.data)
                            })

                    }
                })

            }
        }
    }
</script>

<style scoped>

</style>