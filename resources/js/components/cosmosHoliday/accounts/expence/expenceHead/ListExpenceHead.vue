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
                        <router-link to="/expence-head-list">Expence Head List</router-link>
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
                        Expence Head List
                        <div class="card-tools" style="float:right">
                            <router-link to="/new-expence-head" class="btn btn-success">Add New Expence Head</router-link>
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
                                        <th  class="center" >Name</th>
                                        <th  class="center" >Date</th>
                                        <th  class="center" >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(expence_head, index) in expence_heads">
                                        <td class="center">{{index+1}}</td>
                                        <td class="center">{{expence_head.name}}</td>
                                        <td class="center">{{expence_head.created_at | timeformate}}</td>
                                        <td class="center">
                                            <div class="hidden-sm hidden-xs btn-group">

<!--                                                <button class="btn btn-xs btn-success">-->
<!--                                                    <i class="ace-icon fa fa-eye bigger-120"></i>-->
<!--                                                </button>-->
                                                <router-link :to="`/edit-expence-head/${expence_head.id}`" class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </router-link>

<!--                                                <button @click.prevent="deleteDepartment(expence_head.id)" class="btn btn-xs btn-danger">-->
<!--                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>-->
<!--                                                </button>-->

                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                            <div class="justify-content-center">
                                <pagination v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="getExpenceHead()"
                                ></pagination>
                            </div>
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
        name: "ListExpenceHead",
        mounted() {
            this.getExpenceHead()
        },
        data(){
            return {
                pagination:{
                    current_page: 1,
                },
                expence_heads: '',
            }
        },
        methods:{
            getExpenceHead(){
                axios.get('/api/get-all-expence-head?page='+this.pagination.current_page)
                    .then(response => {
                        this.expence_heads = response.data.expence_heads.data
                        this.pagination = response.data.expence_heads
                    })
            },
        }
    }
</script>

<style scoped>

</style>