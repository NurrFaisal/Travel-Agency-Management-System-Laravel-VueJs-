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
                            <router-link to="/due-guest">Due Guest List</router-link>
                        </li>
                    </ul><!-- /.breadcrumb -->

<!--                    <div class="nav-search" id="nav-search">-->
<!--                        <form class="form-search">-->
<!--								<span class="input-icon">-->
<!--									<input type="text" placeholder="Search ..." class="nav-search-input" @keyup="searchText()" id="nav-search-input" v-model="search_text" autocomplete="off" />-->
<!--									<i class="ace-icon fa fa-search nav-search-icon"></i>-->
<!--								</span>-->
<!--                        </form>-->
<!--                    </div>&lt;!&ndash; /.nav-search &ndash;&gt;-->
                </div>

                <div class="page-content">

                    <div class="page-header">
                        <h1>
                            Due Guest List
                            <div class="card-tools" style="float:right">
                                <router-link to="/new-guest" class="btn btn-success">Add New Guest</router-link>
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
                                            <th>Guest Name</th>
                                            <th>Phone Number</th>
                                            <th>Staff Name</th>
                                            <th class="hidden-480">Email</th>

                                            <th>Balance</th>
                                            <th class="hidden-480">Status</th>

                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr v-for="(guest, index) in  guests">
                                            <td class="center">{{index+1}}</td>
                                            <td>{{guest.name}}</td>
                                            <td>{{guest.phone_number}}</td>
                                            <td>{{guest.staff.first_name+' '+ guest.staff.last_name}}</td>
                                            <td class="hidden-480">{{guest.email_address}}</td>
                                            <td v-if="guest.transjactions == null" style="text-align: right" >-</td>
                                            <td v-else-if="guest.transjactions != null && guest.transjactions.guest_blance > 0" style="text-align: right; background-color:red; color:white" ><strong>{{guest.transjactions != null ? guest.transjactions.guest_blance: '-'}}</strong></td>
                                            <td v-else-if="guest.transjactions != null && guest.transjactions.guest_blance < 0" style="text-align: right; background-color:green; color:white" ><strong>{{guest.transjactions != null ? guest.transjactions.guest_blance: '-'}}</strong></td>
                                            <td v-else style="text-align: right;" ><strong>-</strong></td>

                                            <td class="hidden-480">

                                                <span v-if="guest.status == 1" class="label label-sm label-success">Active</span>
                                                <span v-else class="label label-sm label-danger">Inactive</span>
                                            </td>

                                            <td class="center">
                                                <div class="hidden-sm hidden-xs btn-group">

                                                    <router-link :to="`/view-guest/${guest.id}`" class="btn btn-xs btn-success">
                                                        <i class="ace-icon fa fa-eye bigger-120"></i>
                                                    </router-link>
                                                    <router-link :to="`/edit-guest/${guest.id}`" class="btn btn-xs btn-info">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </router-link>

                                                    <button v-if="user_type == 'super-admin'" @click.prevent="deleteGuest(guest.id)" class="btn btn-xs btn-danger">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center">
                                        <pagination v-if="pagination.last_page > 1"
                                                    :pagination="pagination"
                                                    :offset="5"
                                                    @paginate="getAllGuest()"
                                        ></pagination>
                                    </div>
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
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import _ from "lodash";
    export default {
        name: "ListDueGuest",
        mounted(){
            this.isLoading = true
            this.getAllGuest()
        },
        components: {
            Loading
        },
        computed:{

        },
        data(){
            return {
                search_text:'',
                width:128,
                height:128,
                isLoading: false,
                fullPage: false,
                user_type:'',
                pagination:{
                    current_page: 1,
                },
                guests: '',
            }
        },
        methods:{
            getAllGuest(){
                this.isLoading = true
                axios.get('/api/get-all-due-guest?page='+this.pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.guests = response.data.guests.data
                        this.pagination = response.data.guests
                        this.doAjax();

                    })
            },
            searchText:_.debounce(function () {
                this.isLoading = true
                if(this.search_text != ''){
                    this.getAllGuestSearch(this.search_text)
                }else{
                    this.getAllGuest();
                }
            },1000),
            getAllGuestSearch(search_text){
                axios.get(`/api/get-all-guest-search/`+search_text+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.user_type = response.data.user_type
                        this.guests = response.data.guests.data
                        this.pagination = response.data.guests
                        this.isLoading = false
                    })
            },
            doAjax() {
                setTimeout(() => {
                    this.isLoading = false
                },100)
            },

            deleteGuest(id){
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
                        axios.get('/api/delete-guest/'+id)
                            .then((response) =>{
                                if(response.data == "Deleted"){
                                    this.getAllGuest()
                                    Toast.fire({
                                        type: 'success',
                                        title: 'Guest Deleted successfully'
                                    })
                                }else {
                                    this.getAllGuest()
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                        footer: 'You Are Not Allowed To Delete This Guest'
                                    })
                                }

                                this.$store.dispatch("allGuest")
                            })

                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
