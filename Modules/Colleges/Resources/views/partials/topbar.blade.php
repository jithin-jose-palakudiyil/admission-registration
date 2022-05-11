   <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
  
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                           <?php 
                            $profile_img = 'public/assets/images/user-default.png';  
                                if(Auth::guard(colleges_guard)->user()->image):
                                    $path = 'public/uploads/colleges_user/'.Auth::guard(colleges_guard)->user()->id.'/'.Auth::guard(colleges_guard)->user()->image; 
                                    if(File::exists($path)):  $profile_img = $path;  endif;     
                                endif;
                            ?>
                            <img src="{{asset($profile_img)}}" alt="{{Auth::guard(colleges_guard)->user()->name}}" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                {{Auth::guard(colleges_guard)->user()->name}} <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0 text-white">
                                    Welcome !
                                </h5>
                            </div>

                            <!-- item-->
<!--                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a>-->

                            <!-- item-->
<!--                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Settings</span>
                            </a>-->

                            <!-- item-->
<!--                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock"></i>
                                <span>Lock Screen</span>
                            </a>-->

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="{{route('colleges-logout')}}" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>
 

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{route('colleges_dashboard')}}" class="logo text-center">
                        <span class="logo-lg">
                        <img style="height: 40px" src="{{asset('public/assets/images/mgm_btech_white.png')}}" alt="" height="24">
                            <!-- <span class="logo-lg-text-light">Upvex</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">X</span> -->
                            <img style="height: 28px" src="{{asset('public/assets/images/mgm_logo.png')}}" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </li>
        
                 

                   
                </ul>
            </div>
