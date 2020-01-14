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
                        <router-link to="/guest-query-list">Guest Query List</router-link>
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
                        Guest Title List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-guest-query" class="btn btn-success">Add Guest Query</router-link>
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
                                        <th>Subject</th>
                                        <th>Guest Name</th>
                                        <th>Staff Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(guest_query, index) in  getAllGuestQuery">
                                        <td class="center">{{index+1}}</td>



                                        <td>{{guest_query.subject}}</td>
                                        <td>{{guest_query.guest.name}}</td>
                                        <td>{{guest_query.staff.last_name}}</td>
                                        <td>{{guest_query.updated_at | timeformate}}</td>

                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

                                                <router-link :to="`/view-guest-query/${guest_query.id}`" class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                                </router-link>
                                                <router-link :to="`/edit-guest-query/${guest_query.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

                                                <button @click.prevent="deleteGuestQuery(guest_query.id)" class="btn btn-xs btn-danger">
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
                                                            <a href="#" @click.prevent="deleteGuestQuery(guest_title.id)" class="tooltip-error" data-rel="tooltip" title="Delete">
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


<!--    <div>-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-12 mt-2" >-->
<!--                <div class="card ">-->
<!--                    <div class="card-header">-->
<!--                        <h3 class="card-title">Guest Query List</h3>-->
<!--                        <div class="card-tools">-->
<!--                            <router-link to="/new-guest-query" class="btn btn-success">Add Guest Query</router-link>-->
<!--                        </div>-->
<!--                        <br/>-->
<!--                    </div>-->
<!--                    &lt;!&ndash; /.card-header &ndash;&gt;-->
<!--                    <div class="card-body table-responsive p-0">-->
<!--                        <table class="table table-hover table-bordered text-center">-->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <th>Sl</th>-->
<!--                                <th>Subject</th>-->
<!--                                <th>Guest Name</th>-->
<!--                                <th>Staff Name</th>-->
<!--                                <th>Date</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            <tr v-for="(guest_query, index) in getAllGuestDesignation">-->
<!--                                <td>{{index+1}}</td>-->
<!--                                <td>{{guest_query.subject}}</td>-->
<!--                                <td>{{guest_query.guest.name}}</td>-->
<!--                                <td>{{guest_query.staff.last_name}}</td>-->
<!--                                <td>{{guest_query.updated_at | timeformate }}</td>-->
<!--                                <td>-->
<!--                                    <router-link :to="`/edit-guest-query/${guest_query.id}`" class="mr-2" >-->
<!--                                        <i class="fa fa-edit fa-2x"></i>-->
<!--                                    </router-link>-->
<!--                                    <a class="" @click.prevent="deleteGuestQuery(guest_query.id)" >-->
<!--                                        <i class="fa fa-trash fa-2x"></i>-->
<!--                                    </a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                    &lt;!&ndash; /.card-body &ndash;&gt;-->
<!--                </div>-->
<!--                &lt;!&ndash; /.card &ndash;&gt;-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</template>

<script>
    export default {
        name: "ListGuestQueryComponent",

        mounted() {
            this.$store.dispatch('allGuestQuery')
        },
        computed:{
            getAllGuestQuery(){
                return  this.$store.getters.get_guest_query
            }
        },
        methods:{
            deleteGuestQuery(id){
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
                        axios.get('/api/delete-guest-query/'+id)
                            .then((response) =>{
                                Toast.fire({
                                    type: 'success',
                                    title: 'Guest Query Deleted successfully'
                                })
                                this.$store.dispatch("allGuestQuery")
                            })

                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>