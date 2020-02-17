<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container" style="width: 100%;">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="index.html" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    Cosmos Holiday..
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="grey dropdown-modal">
                    @if(Session::get('user_type') == 'super-admin' ) <h4 style="color: white;margin-right: 10px;">( Super Admin )</h4> @endif
                    @if(Session::get('user_type') == 'admin' ) <h4 style="color: white;margin-right: 10px;">( Admin )</h4> @endif
                    @if(Session::get('user_type') == 'operation' ) <h4 style="color: white;margin-right: 10px;">( Operation )</h4> @endif
                    @if(Session::get('user_type') == 'user' ) <h4 style="color: white;margin-right: 10px;">( user )</h4> @endif
                </li>


                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{asset(Session::get('image'))}}" alt="{{Session::get('staff_name')}}" />
                        <span class="user-info">
									<small>Welcome,</small>
									{{Session::get('staff_name')}}
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <router-link  to="/view-staff/{{Session::get('staff_id')}}">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </router-link>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="/api/logout"  onclick="return confirm('Are You Sure ??? You Want To Logout Form This Application')">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>
