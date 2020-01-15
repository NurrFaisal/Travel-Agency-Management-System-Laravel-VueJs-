<!--<template>-->
<!--    <div>-->
<!--        <div class="main-content-inner">-->
<!--            <div class="breadcrumbs ace-save-state" id="breadcrumbs">-->
<!--                <ul class="breadcrumb">-->
<!--                    <li>-->
<!--                        <i class="ace-icon fa fa-home home-icon"></i>-->
<!--                        <router-link to="/dashboard">Home</router-link>-->
<!--                    </li>-->

<!--                    <li>-->
<!--                        <router-link to="/suplier-list">Agency List</router-link>-->
<!--                    </li>-->
<!--                </ul>&lt;!&ndash; /.breadcrumb &ndash;&gt;-->

<!--                <div class="nav-search" id="nav-search">-->
<!--                    <form class="form-search">-->
<!--								<span class="input-icon">-->
<!--									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />-->
<!--									<i class="ace-icon fa fa-search nav-search-icon"></i>-->
<!--								</span>-->
<!--                    </form>-->
<!--                </div>&lt;!&ndash; /.nav-search &ndash;&gt;-->
<!--            </div>-->

<!--            <div class="page-content">-->

<!--                <div class="page-header">-->
<!--                    <h1>-->
<!--                        Suplier List-->
<!--                        <div class="card-tools" style="float:right">-->
<!--                            <router-link to="/new-suplier" class="btn btn-success">Add New Agency</router-link>-->
<!--                        </div>-->
<!--                        <br/>-->
<!--                    </h1>-->
<!--                </div>&lt;!&ndash; /.page-header &ndash;&gt;-->

<!--                <div class="row">-->
<!--                    <div class="col-xs-12">-->
<!--                        &lt;!&ndash; PAGE CONTENT BEGINS &ndash;&gt;-->
<!--                        <div class="row">-->
<!--                            <div class="col-xs-12">-->
<!--                                <table id="simple-table" class="table  table-bordered table-hover">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th class="center">Sl.</th>-->
<!--                                        <th>Company Name</th>-->
<!--                                        <th>Name</th>-->
<!--                                        <th class="hidden-480">Email Address</th>-->
<!--                                        <th class="hidden-480">Phone Number</th>-->
<!--                                        <th class="hidden-480">Department</th>-->
<!--                                        <th>Service</th>-->
<!--                                        <th>Recived</th>-->
<!--                                        <th>Due</th>-->
<!--                                        <th class="hidden-480">Status</th>-->

<!--                                        <th>Action</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->

<!--                                    <tbody>-->
<!--                                    <tr v-for="(agency, index) in  getAllAgency">-->
<!--                                        <td class="center">{{index+1}}</td>-->
<!--                                        <td>{{agency.company_name}}</td>-->
<!--                                        <td>{{agency.name}}</td>-->
<!--                                        <td class="hidden-480">{{agency.email_address}}</td>-->
<!--                                        <td>{{agency.phone_number}}</td>-->
<!--                                        <td>{{agency.department.department_name}}</td>-->
<!--                                        <td>Service</td>-->
<!--                                        <td>Recived</td>-->
<!--                                        <td>Due</td>-->

<!--                                        <td class="hidden-480">-->

<!--                                            <span v-if="agency.status == 1" class="label label-sm label-success">Active</span>-->
<!--                                            <span v-else class="label label-sm label-danger">Inactive</span>-->
<!--                                        </td>-->

<!--                                        <td class="center">-->
<!--                                            <div class="hidden-sm hidden-xs btn-group">-->

<!--                                                <router-link :to="`/view-suplier/${agency.id}`" class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </router-link>-->
<!--                                                <router-link :to="`/edit-suplier/${agency.id}`" class="btn btn-xs btn-info">-->
<!--                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>-->
<!--                                                </router-link>-->

<!--                                                <button @click.prevent="deleteAgency(agency.id)" class="btn btn-xs btn-danger">-->
<!--                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>-->
<!--                                                </button>-->

<!--                                            </div>-->

<!--                                            <div class="hidden-md hidden-lg">-->
<!--                                                <div class="inline pos-rel">-->
<!--                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">-->
<!--                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>-->
<!--                                                    </button>-->

<!--                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">-->
<!--                                                        <li>-->
<!--                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">-->
<!--																			<span class="blue">-->
<!--																				<i class="ace-icon fa fa-search-plus bigger-120"></i>-->
<!--																			</span>-->
<!--                                                            </a>-->
<!--                                                        </li>-->

<!--                                                        <li>-->
<!--                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">-->
<!--																			<span class="green">-->
<!--																				<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>-->
<!--																			</span>-->
<!--                                                            </a>-->
<!--                                                        </li>-->

<!--                                                        <li>-->
<!--                                                            <a href="#" @click.prevent="deleteGuest(guest.id)" class="tooltip-error" data-rel="tooltip" title="Delete">-->
<!--																			<span class="red">-->
<!--																				<i class="ace-icon fa fa-trash-o bigger-120"></i>-->
<!--																			</span>-->
<!--                                                            </a>-->
<!--                                                        </li>-->
<!--                                                    </ul>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </div>&lt;!&ndash; /.span &ndash;&gt;-->
<!--                        </div>&lt;!&ndash; /.row &ndash;&gt;-->

<!--                        <div class="hr hr-18 dotted hr-double"></div>-->

<!--                        &lt;!&ndash; PAGE CONTENT ENDS &ndash;&gt;-->
<!--                    </div>&lt;!&ndash; /.col &ndash;&gt;-->
<!--                </div>&lt;!&ndash; /.row &ndash;&gt;-->
<!--            </div>&lt;!&ndash; /.page-content &ndash;&gt;-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    export default {-->
<!--        name: "ListSuplierComponent",-->
<!--        mounted(){-->
<!--            this.$store.dispatch("allAgency")-->
<!--        },-->
<!--        computed:{-->
<!--            getAllAgency(){-->
<!--                return this.$store.getters.get_agency-->
<!--            }-->
<!--        },-->
<!--        methods:{-->
<!--            deleteAgency(id){-->
<!--                Swal.fire({-->
<!--                    title: 'Are you sure?',-->
<!--                    text: "You won't be able to revert this!",-->
<!--                    type: 'warning',-->
<!--                    showCancelButton: true,-->
<!--                    confirmButtonColor: '#3085d6',-->
<!--                    cancelButtonColor: '#d33',-->
<!--                    confirmButtonText: 'Yes, delete it!'-->
<!--                }).then((result) => {-->
<!--                    if (result.value) {-->
<!--                        axios.get('/api/delete-suplier/'+id)-->
<!--                            .then((response) =>{-->
<!--                                Toast.fire({-->
<!--                                    type: 'success',-->
<!--                                    title: 'Agency Deleted successfully'-->
<!--                                })-->
<!--                                this.$store.dispatch("allAgency")-->
<!--                            })-->

<!--                    }-->
<!--                })-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->
