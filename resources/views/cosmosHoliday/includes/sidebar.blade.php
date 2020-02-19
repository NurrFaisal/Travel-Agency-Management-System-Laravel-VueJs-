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

    <ul class="nav nav-list">
        <li class="">
            <router-link to="/dashboard">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </router-link>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
								Air-Tickets
							</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="">
                    <router-link to="/air-ticket-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Air Tickers List
                    </router-link>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/ticket-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Ticket List
                    </router-link>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/air-line-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Air Lines List
                    </router-link>

                    <b class="arrow"></b>
                </li>


            </ul>
        </li>

{{--        <li class="active open">--}}
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> VISA </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
{{--                <li class="active">--}}
{{--                <li class="">--}}
{{--                    <router-link to="/visa-list">--}}
{{--                        <i class="menu-icon fa fa-caret-right"></i>--}}
{{--                        Visa List--}}
{{--                    </router-link>--}}

{{--                    <b class="arrow"></b>--}}
{{--                </li>--}}
                <li class="">
                    <router-link to="/visa-updated-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Visa List
                    </router-link>

                    <b class="arrow"></b>
                </li>



{{--                <li class="">--}}
{{--                    <router-link to="/visa-agency-list">--}}
{{--                        <i class="menu-icon fa fa-caret-right"></i>--}}
{{--                        Visa Agency--}}
{{--                    </router-link>--}}

{{--                    <b class="arrow"></b>--}}
{{--                </li>--}}

                <li class="">
                    <router-link to="/visa-category-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Visa Categories
                    </router-link>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/visa-country-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Visa Country List
                    </router-link>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Package </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <router-link to="/package-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Package List
                    </router-link>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Hotel Booking </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <router-link to="/hotel-booking-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Hotel Booking List
                    </router-link>
                    <router-link to="/hotel-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Hotel List
                    </router-link>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <router-link to="/guest-list">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Guest </span>
            </router-link>

            <b class="arrow"></b>
        </li>
        <li class="">
            <router-link to="/suplier-list">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Suplier </span>
            </router-link>

            <b class="arrow"></b>
        </li>
{{--        <li class="">--}}
{{--            <router-link to="/guest-query-list">--}}
{{--                <i class="menu-icon fa fa-list-alt"></i>--}}
{{--                <span class="menu-text"> Guest Query</span>--}}
{{--            </router-link>--}}

{{--            <b class="arrow"></b>--}}
{{--        </li>--}}

        <li class="">
            <router-link to="/staff-list">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">
                    Staff
                </span>
            </router-link>

            <b class="arrow"></b>
        </li>

{{--        <li class="">--}}
{{--            <router-link to="/suplier-list">--}}
{{--                <i class="menu-icon fa fa-picture-o"></i>--}}
{{--                <span class="menu-text"> Agency </span>--}}
{{--            </router-link>--}}

{{--            <b class="arrow"></b>--}}
{{--        </li>--}}

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tag"></i>
                <span class="menu-text"> Accounts </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <router-link to="/received-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                      Money Reciept
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/payment-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Debit Vouchure
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/contra-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Contra Voucher
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/expence-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Expence
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/salary-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Salary
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/incentive-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Incentive
                    </router-link>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tag"></i>
                <span class="menu-text"> Books </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <router-link to="/cash-book-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Cash Book
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/bank-book-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Bank Book
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/cheque-book-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Cheque Book
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/clear-cheque-book-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Clear Cheque Book
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/others-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Others
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/bank-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Bank Info
                    </router-link>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tag"></i>
                <span class="menu-text">Received Loan </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <router-link to="/received-loan-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Received Loan List
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/list-received-loan-installment">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Installment List
                    </router-link>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tag"></i>
                <span class="menu-text">Payment Loan </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <router-link to="/payment-loan-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Payment Loan List
                    </router-link>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/payment-loan-installment-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Installment
                    </router-link>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tag"></i>
                <span class="menu-text"> Setting </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <router-link to="/guest-title-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Guest Title
                    </router-link>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <router-link to="/guest-designation-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Guest Designation
                    </router-link>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <router-link to="/staff-designation-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Staff Desigantion
                    </router-link>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <router-link to="/department-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Department
                    </router-link>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/bank-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Bank
                    </router-link>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <router-link to="/expence-head-list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Expence Head
                    </router-link>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
