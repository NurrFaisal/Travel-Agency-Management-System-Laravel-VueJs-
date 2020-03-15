<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
{{--    <script type="text/javascript">--}}
{{--        try{ace.settings.loadState('sidebar')}catch(e){}--}}
{{--    </script>--}}

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul id="myDiv" class="nav nav-list">
        <li class="btn_cos active">
            <router-link to="/dashboard">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </router-link>

            <b class="arrow"></b>
        </li>
        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || (Session::get('department') == 6 && Session::get('user_type') == 'operation'))
        <li class="btn_cos">
            <router-link to="/at-a-glance">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> At a Glance </span>
            </router-link>

            <b class="arrow"></b>
        </li>
        @endif
        <li class="btn_cos">
            <router-link to="/guest-list">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Guest </span>
            </router-link>

            <b class="arrow"></b>
        </li>
        <li class="btn_cos">
            <router-link to="/suplier-list">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Suplier </span>
            </router-link>

            <b class="arrow"></b>
        </li>
        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || Session::get('department') == 3)
            <li class="btn_cos">
            <router-link to="/air-ticket-list" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">
                    Air-Tickets (Invoice)
                </span>
            </router-link>
            </li>
            <li class="btn_cos">
                <router-link to="/air-line-list" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Air-Lines
                </span>
                </router-link>
            </li>
        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || Session::get('user_type') == 'operation')
            <li class="btn_cos">
                <router-link to="/ticket-list" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Ticket List
                </span>
                </router-link>
            </li>

            <li class="btn_cos">
                <router-link to="/air-ticket-refund-list" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Refund Received
                </span>
                </router-link>
            </li>
        @endif


        @endif

{{--        <li class="active open">--}}
        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || Session::get('department') == 4)
            <li class="btn_cos">
                <router-link to="/visa-updated-list" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    VISA (Invoice)
                </span>
                </router-link>
            </li>
            <li class="btn_cos">
                <router-link to="/visa-category-list" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Visa Categories
                </span>
                </router-link>
            </li>
        @endif

        <li class="btn_cos">
            <router-link to="/visa-country-list">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Country </span>
            </router-link>

            <b class="arrow"></b>
        </li>

        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || Session::get('department') == 5)
            <li class="btn_cos">
                <router-link to="/package-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Package </span>
                </router-link>

                <b class="arrow"></b>
            </li>
        @endif
        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || Session::get('department') == 7)
            <li class="btn_cos">
                <router-link to="/hotel-booking-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Hotel Booking </span>
                </router-link>

                <b class="arrow"></b>
            </li>
            <li class="btn_cos">
                <router-link to="/hotel-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Hotel List </span>
                </router-link>

                <b class="arrow"></b>
            </li>
        @endif
        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin')
        <li class="btn_cos">
            <router-link to="/staff-list">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">
                    Staff
                </span>
            </router-link>

            <b class="arrow"></b>
        </li>
        @endif

        @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || Session::get('department') == 6)
{{--            <li class="btn_cos">--}}
{{--                <router-link to="/due-guest">--}}
{{--                    <i class="menu-icon fa fa-tachometer"></i>--}}
{{--                    <span class="menu-text">--}}
{{--                   Due Guest--}}
{{--                </span>--}}
{{--                </router-link>--}}
{{--                <b class="arrow"></b>--}}
{{--            </li>--}}
            <li class="btn_cos">
                <router-link to="/received-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                   Money Reciept
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
            <li class="btn_cos">
                <router-link to="/payment-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                   Debit Vouchure
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
            <li class="btn_cos">
                <router-link to="/contra-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                   Contra Voucher
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
            @if(Session::get('user_type') == 'admin' || Session::get('user_type') == 'super-admin' || (Session::get('department') == 6 && Session::get('user_type') == 'operation'))
            <li class="btn_cos">
                <router-link to="/salary-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Salary
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
            <li class="btn_cos">
                <router-link to="/incentive-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Incentive
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
            @endif
            <li class="btn_cos">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">Expense </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="btn_cos">
                        <router-link to="/expence-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Expense List
                        </router-link>
                        <b class="arrow"></b>
                    </li>
                    <li class="btn_cos">
                        <router-link to="/expence-head-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Expense Head
                        </router-link>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            <li class="btn_cos">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">Books </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="btn_cos">
                        <router-link to="/cash-book-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Cash-Book
                        </router-link>
                        <b class="arrow"></b>
                    </li>
                    <li class="btn_cos">
                        <router-link to="/bank-book-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Bank-Book
                        </router-link>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            <li class="btn_cos">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">Cheque </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="btn_cos">
                        <router-link to="/cheque-book-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Unclear Cheque
                        </router-link>
                        <b class="arrow"></b>
                    </li>
                    <li class="btn_cos">
                        <router-link to="/clear-cheque-book-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Clear Cheque
                        </router-link>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            <li class="btn_cos">
                <router-link to="/others-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Other's
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
            <li class="btn_cos">
                <router-link to="/Bank-list">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text">
                    Bank
                </span>
                </router-link>
                <b class="arrow"></b>
            </li>
        <li class="btn_cos">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">Received Loan </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="btn_cos">
                    <router-link to="/received-loan-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Received Loan List
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="btn_cos">
                    <router-link to="/list-received-loan-installment">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Installment List
                    </router-link>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li class="btn_cos">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">Payment Loan </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="btn_cos">
                    <router-link to="/payment-loan-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Payment Loan List
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="btn_cos">
                    <router-link to="/payment-loan-installment-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Installment
                    </router-link>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        @endif

        <li class="btn_cos">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Setting </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="btn_cos">
                    <router-link to="/guest-title-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Guest Title
                    </router-link>

                    <b class="arrow"></b>
                </li>

                <li class="btn_cos">
                    <router-link to="/guest-designation-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Guest Designation
                    </router-link>

                    <b class="arrow"></b>
                </li>

                @if(Session::get('user_type') == 'super-admin')
                <li class="btn_cos">
                    <router-link to="/department-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Department
                    </router-link>

                    <b class="arrow"></b>
                </li>
                @endif
                @if(Session::get('user_type') == 'super-admin' || Session::get('user_type') == 'admin')
                    <li class="btn_cos">
                        <router-link to="/staff-designation-list">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Staff Desigantion
                        </router-link>

                        <b class="arrow"></b>
                    </li>
                    @endif
            </ul>
        </li>


    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
