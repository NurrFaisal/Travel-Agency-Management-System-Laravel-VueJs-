
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
                        <router-link to="/edit-guest">Edit Guest</router-link>
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
                                        <h5 class="widget-title">{{guest_querys.subject}} By ( {{guest_querys.guest.name}} )</h5>
                                        <div class="card-tools" style="float:right">
                                            <router-link to="/guest-query-list" class="btn btn-success">Guest Query List</router-link>
                                        </div>
                                        <br/>
                                    </div>

                                    <div class="widget-body justify-content-center">
                                        <div class="widget-main justify-content-center" style="margin:0 auto;">
                                            <div>
                                                <h3>Guest Query</h3>
                                                <div style="text-align: justify">
                                                    {{guest_querys.guest_query}}
                                                </div>
                                            </div>
                                            <br/>
                                            <div>
                                                <h3>Follow Up</h3>
                                                <div style="text-align: justify">
                                                    {{guest_querys.follow_up}}
                                                </div>
                                            </div>

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
    export default {
        name: "ViewGuestQueryComponent",
        data(){
            return {
                form: new Form({
                    id: '',
                    guest_id: '',
                    subject: '',
                    guest_query: '',
                    follow_up: '',
                    status: '',
                }),
                guest_querys: []
            }
        },
        mounted() {
            this.$store.dispatch("allGuest")
            axios.get(`/api/edit-guest-query/${this.$route.params.id}`)
                .then((respose) => {
                    this.guest_querys = respose.data.guest_query
                    console.log(this.guest_querys.guest.name)
                    this.form.fill(respose.data.guest_query)
                })
        },
        computed:{
            getAllGuest(){
                return this.$store.getters.get_guest
            }
        },
        methods:{
            updateGuestQuery(){
                this.form.post('/api/update-guest-query')
                    .then((response) => {
                        console.log(response.data)
                        this.$router.push('/guest-query-list')
                        Toast.fire({
                            type: 'success',
                            title: ' Guest Query Updated successfully'
                        })
                    })
            }
        }

    }
</script>

<style scoped>

</style>