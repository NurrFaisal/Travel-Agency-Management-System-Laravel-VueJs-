<template>
    <div>
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>


                    <li class="active">User Profile</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        User Profile Page
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="">
                            <div id="user-profile-2" class="user-profile">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs padding-18">
                                        <li class="active">
                                            <a data-toggle="tab" href="#home" aria-expanded="true">
                                                <i class="green ace-icon fa fa-user bigger-120"></i>
                                                Profile
                                            </a>
                                        </li>

                                        <li class="">
                                            <a data-toggle="tab" href="#feed" aria-expanded="false">
                                                <i class="orange ace-icon fa fa-rss bigger-120"></i>
                                                Activity Feed
                                            </a>
                                        </li>

                                        <li class="">
                                            <a data-toggle="tab" href="#friends" aria-expanded="false">
                                                <i class="blue ace-icon fa fa-users bigger-120"></i>
                                                Friends
                                            </a>
                                        </li>

                                        <li class="">
                                            <a data-toggle="tab" href="#pictures" aria-expanded="false">
                                                <i class="pink ace-icon fa fa-picture-o bigger-120"></i>
                                                Pictures
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content no-border padding-24">
                                        <div id="home" class="tab-pane active">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">
																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" :src="staff.image">
															</span>

                                                    <div class="space space-4"></div>


                                                </div><!-- /.col -->

                                                <div class="col-xs-12 col-sm-9">
                                                    <h4 class="blue">
                                                        <span class="middle">{{staff.first_name+' '+staff.last_name}}</span>
                                                    </h4>

                                                    <div class="profile-user-info">
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Username </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.first_name+' '+staff.last_name}}</span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Location </div>

                                                            <div class="profile-info-value">
                                                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                <span>{{staff.address}}</span>
                                                            </div>
                                                        </div>

                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Date Of Birth </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.date_of_birth}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Phone Number </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.phone_number}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name">Alt Phone Number </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.alt_phone_number}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Email Address </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.email_address}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Passport Number </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.passport}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> NID </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.nid}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="profile-info-row">
                                                            <div class="profile-info-name"> Blood Group </div>

                                                            <div class="profile-info-value">
                                                                <span>{{staff.blood_group}}</span>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="hr hr-8 dotted"></div>


                                                </div><!-- /.col -->
                                            </div><!-- /.row -->

                                            <div class="space-20"></div>

                                                                                       <div class="row">
                                                                                           <div class="col-xs-12 col-sm-6">
                                                                                               <div class="widget-box transparent">
                                                                                                   <div class="widget-header widget-header-small">
                                                                                                       <h4 class="widget-title smaller">
                                                                                                           <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                                                                                                           Job Information
                                                                                                       </h4>
                                                                                                   </div>

                                                                                                   <div class="widget-body">
                                                                                                       <div class="row">
                                                                                                           <div class="col-xs-12 col-sm-12">
                                                                                                               <h4 class="blue">
                                                                                                                   <span class="middle"></span>
                                                                                                               </h4>

                                                                                                               <div class="profile-user-info">
                                                                                                                   <div class="profile-info-row">
                                                                                                                   </div>

                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Designation </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.designationt.staff_designation}}</span>
                                                                                                                       </div>
                                                                                                                   </div>

                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Staff ID </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.staff_id}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Department </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.departmentt}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name">Location </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.location == 1 ? 'Dhanmondi': 'Banani'}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Start Date </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.start_date}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Salary </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.passport}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> NID </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.nid}}</span>
                                                                                                                       </div>
                                                                                                                   </div>

                                                                                                               </div>

                                                                                                               <div class="hr hr-8 dotted"></div>


                                                                                                           </div><!-- /.col -->
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div>
                                                                                           </div>

                                                                                           <div class="col-xs-12 col-sm-6">
                                                                                               <div class="widget-box transparent">
                                                                                                   <div class="widget-header widget-header-small header-color-blue2">
                                                                                                       <h4 class="widget-title smaller">
                                                                                                           <i class="ace-icon fa fa-lightbulb-o bigger-120"></i>
                                                                                                           Emergency Contact information
                                                                                                       </h4>
                                                                                                   </div>

                                                                                                   <div class="widget-body">
                                                                                                       <div class="row">
                                                                                                           <div class="col-xs-12 col-sm-12">
                                                                                                               <h4 class="blue">
                                                                                                                   <span class="middle">First Person</span>
                                                                                                               </h4>

                                                                                                               <div class="profile-info-row">
                                                                                                                   <div class="profile-info-name"> Name </div>

                                                                                                                   <div class="profile-info-value">
                                                                                                                       <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                                                                       <span>{{staff.first_person_name}}</span>
                                                                                                                   </div>
                                                                                                               </div>

                                                                                                               <div class="profile-user-info">
                                                                                                                   <div class="profile-info-row">
                                                                                                                   </div>

                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Phone Number </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                                                                           <span>{{staff.first_person_phone_number}}</span>
                                                                                                                       </div>
                                                                                                                   </div>

                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Reletionship </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.first_person_relationship}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <h4 class="blue">
                                                                                                                       <span class="middle">Second Person</span>
                                                                                                                   </h4>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Name </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.second_person_name}}</span>
                                                                                                                       </div>
                                                                                                                   </div>
                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Phone Number </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.second_person_phone_number}}</span>
                                                                                                                       </div>
                                                                                                                   </div>

                                                                                                                   <div class="profile-info-row">
                                                                                                                       <div class="profile-info-name"> Reletionship </div>

                                                                                                                       <div class="profile-info-value">
                                                                                                                           <span>{{staff.second_person_relationship}}</span>
                                                                                                                       </div>
                                                                                                                   </div>


                                                                                                               </div>

                                                                                                               <div class="hr hr-8 dotted"></div>


                                                                                                           </div><!-- /.col -->
                                                                                                       </div>
                                                                                                   </div>
                                                                                               </div>
                                                                                           </div>
                                                                                       </div>
                                        </div><!-- /#home -->

                                        <div id="feed" class="tab-pane">
                                            <div class="profile-feed row">
                                                <div class="col-sm-6">
                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png">
                                                            <a class="user" href="#"> Alex Doe </a>
                                                            changed his profile photo.
                                                            <a href="#">Take a look</a>

                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                an hour ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <img class="pull-left" alt="Susan Smith's avatar" src="assets/images/avatars/avatar1.png">
                                                            <a class="user" href="#"> Susan Smith </a>

                                                            is now friends with Alex Doe.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                2 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
                                                            <a class="user" href="#"> Alex Doe </a>
                                                            joined
                                                            <a href="#">Country Music</a>

                                                            group.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                5 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
                                                            <a class="user" href="#"> Alex Doe </a>
                                                            uploaded a new photo.
                                                            <a href="#">Take a look</a>

                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                5 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <img class="pull-left" alt="David Palms's avatar" src="assets/images/avatars/avatar4.png">
                                                            <a class="user" href="#"> David Palms </a>

                                                            left a comment on Alex's wall.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                8 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.col -->

                                                <div class="col-sm-6">
                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
                                                            <a class="user" href="#"> Alex Doe </a>
                                                            published a new blog post.
                                                            <a href="#">Read now</a>

                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                11 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png">
                                                            <a class="user" href="#"> Alex Doe </a>

                                                            upgraded his skills.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                12 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
                                                            <a class="user" href="#"> Alex Doe </a>

                                                            logged in.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                12 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <i class="pull-left thumbicon fa fa-power-off btn-inverse no-hover"></i>
                                                            <a class="user" href="#"> Alex Doe </a>

                                                            logged out.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                16 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="profile-activity clearfix">
                                                        <div>
                                                            <i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
                                                            <a class="user" href="#"> Alex Doe </a>

                                                            logged in.
                                                            <div class="time">
                                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                                16 hours ago
                                                            </div>
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                            </a>

                                                            <a href="#" class="red">
                                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div><!-- /.col -->
                                            </div><!-- /.row -->

                                            <div class="space-12"></div>

                                            <div class="center">
                                                <button type="button" class="btn btn-sm btn-primary btn-white btn-round">
                                                    <i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
                                                    <span class="bigger-110">View more activities</span>

                                                    <i class="icon-on-right ace-icon fa fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div><!-- /#feed -->

                                        <div id="friends" class="tab-pane">
                                            <div class="profile-users clearfix">
                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar4.png" alt="Bob Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-online"></span>
                                                                    Bob Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">Content Editor</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                                    <span class="green"> 20 mins ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar1.png" alt="Rose Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-offline"></span>
                                                                    Rose Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">Graphic Designer</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
                                                                    <span class="grey"> 30 min ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar.png" alt="Jim Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-busy"></span>
                                                                    Jim Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">SEO &amp; Advertising</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 red"></i>
                                                                    <span class="grey"> 1 hour ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar5.png" alt="Alex Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-idle"></span>
                                                                    Alex Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">Marketing</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                                    <span class=""> 40 minutes idle </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar2.png" alt="Phil Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-online"></span>
                                                                    Phil Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">Public Relations</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                                    <span class="green"> 2 hours ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar3.png" alt="Susan Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-online"></span>
                                                                    Susan Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">HR Management</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
                                                                    <span class="green"> 20 mins ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar1.png" alt="Jennifer Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-offline"></span>
                                                                    Jennifer Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">Graphic Designer</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
                                                                    <span class="grey"> 2 hours ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="itemdiv memberdiv">
                                                    <div class="inline pos-rel">
                                                        <div class="user">
                                                            <a href="#">
                                                                <img src="assets/images/avatars/avatar3.png" alt="Alexa Doe's avatar">
                                                            </a>
                                                        </div>

                                                        <div class="body">
                                                            <div class="name">
                                                                <a href="#">
                                                                    <span class="user-status status-offline"></span>
                                                                    Alexa Doe
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="popover">
                                                            <div class="arrow"></div>

                                                            <div class="popover-content">
                                                                <div class="bolder">Accounting</div>

                                                                <div class="time">
                                                                    <i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
                                                                    <span class="grey"> 4 hours ago </span>
                                                                </div>

                                                                <div class="hr dotted hr-8"></div>

                                                                <div class="tools action-buttons">
                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                                                    </a>

                                                                    <a href="#">
                                                                        <i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="hr hr10 hr-double"></div>

                                            <ul class="pager pull-right">
                                                <li class="previous disabled">
                                                    <a href="#">← Prev</a>
                                                </li>

                                                <li class="next">
                                                    <a href="#">Next →</a>
                                                </li>
                                            </ul>
                                        </div><!-- /#friends -->

                                        <div id="pictures" class="tab-pane">
                                            <ul class="ace-thumbnails">
                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-1.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-2.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-3.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-4.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-5.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-6.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-1.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <a href="#" data-rel="colorbox">
                                                        <img alt="150x150" src="assets/images/gallery/thumb-2.jpg">
                                                        <div class="text">
                                                            <div class="inner">Sample Caption on Hover</div>
                                                        </div>
                                                    </a>

                                                    <div class="tools tools-bottom">
                                                        <a href="#">
                                                            <i class="ace-icon fa fa-link"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-paperclip"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-pencil"></i>
                                                        </a>

                                                        <a href="#">
                                                            <i class="ace-icon fa fa-times red"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div><!-- /#pictures -->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "demo",
        data(){
            return {
                staff:'',

            }
        },

        computed:{
            StaffDesignation(){
                return this.$store.getters.get_staff_designation_name;
            },
            allDepartment(){
                return this.$store.getters.get_department
            }
        },
        created() {
            axios.get(`/api/edit-staff/${this.$route.params.id}`)
                .then((response) => {
                    this.staff = response.data.staff
                })
        },
        methods:{

        }
    }
</script>

<style scoped>

</style>