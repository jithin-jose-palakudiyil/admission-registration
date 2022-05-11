    <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li >
                                <a href="{{ route('admin_dashboard')}}" <?php if(isset($active) && $active == 'dashboard'): echo 'class="active"'; endif; ?>> 
                                    <i class="la la-dashboard"></i>
                                    <!--<span class="badge badge-info badge-pill float-right">2</span>-->
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            
                            <?php 
                                $education_active ='';
                                $education_qualification_active ='';
                                $education_courses_active =''; $education_blog_active ='';
                                if(isset($active) && ( $active == 'education-careers-blog' || $active == 'education-qualification' || $active == 'education-courses') ): 
                                    $education_active = 'class=active';
                                
                                    if($active == 'education-qualification'):
                                        $education_qualification_active = 'class=active';
                                    endif;
                                    
                                    if($active == 'education-courses'):
                                        $education_courses_active = 'class=active';
                                    endif;
                                    
                                    if($active == 'education-careers-blog'):
                                        $education_blog_active = 'class=active';
                                    endif;
                                endif;
                            ?>
                            <li  {{$education_active}}>
                                <a href="javascript: void(0);" {{$education_active}} >
                                    <i class=" la la-graduation-cap"></i>
                                    <span> Education </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level " aria-expanded="false">
                                    <li {{$education_qualification_active}} >
                                        <a href="{{route('education-qualification')}}"  > Qualification</a>
                                    </li>
                                     <li {{$education_courses_active}} >
                                        <a href="{{route('education-courses')}}"  > Courses</a>
                                    </li>
                                    
                                    <li {{$education_blog_active}} >
                                        <a href="{{route('careers-blog')}}"  > Blogs</a>
                                    </li>
                                    
                                </ul>
                            </li>

                            <li  >
                                <a href="javascript: void(0);"  >
                                    <i class="la la-cube"></i>
                                    <span> Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <?php 
                                    $pages = \Modules\Admin\Entities\Pages::where('status',1)->get();
                                    if($pages->isNotEmpty()):
                                        ?> 
                                        <ul class="nav-second-level " aria-expanded="false">
                                            <?php foreach ($pages as $key => $value) : ?>
                                           <li  >
                                               <a href="{{route('pages_index',$value->slug)}}"  > {{$value->name}}</a>
                                           </li> 
                                           <?php   endforeach; ?>
                                       </ul>
                                <?php endif; ?>
                               
                            </li>
                            
                            
                            
                             <li>
                                <a href="{{ route('blogs')}}" <?php if(isset($active) && $active == 'blogs'): echo 'class="active"'; endif; ?>> 
                                    <i class=" la la-file-text"></i> 
                                    <span> Blogs </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('career-buffets')}}" <?php if(isset($active) && $active == 'career-buffets'): echo 'class="active"'; endif; ?>> 
                                    <i class=" la la-university"></i> 
                                    <span> Career Buffets </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('videos')}}" <?php if(isset($active) && $active == 'videos'): echo 'class="active"'; endif; ?>> 
                                    <i class=" la la-film"></i> 
                                    <span> Videos </span>
                                </a>
                            </li>

             
 
                            
                            <?php 
                                $counseling_active ='';
                                $counseling_groups_active ='';
                                $counseling_members_active ='';
                                $counseling_plans_active = '';
                                if(isset($active) && ( $active == 'counseling-plans' ||$active == 'counseling-groups' || $active == 'counseling-members') ): 
                                    $counseling_active = 'class=active';
                                
                                    if($active == 'counseling-groups'):
                                        $counseling_groups_active = 'class=active';
                                    endif;
                                    
                                    if($active == 'counseling-members'):
                                        $counseling_members_active = 'class=active';
                                    endif;
                                    
                                    if($active == 'counseling-plans'):
                                        $counseling_plans_active = 'class=active';
                                    endif;
                                endif;
                            ?>
                            <li {{$counseling_active}} >
                                <a href="javascript: void(0);"  {{$counseling_active}} >
                                    <i class="la la-institution"></i>
                                    <span>Counseling
                                        <!--Counselors--> 
                                    </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                 
                                <ul class="nav-second-level " aria-expanded="false">

                                   <li {{$counseling_groups_active}} >
                                       <a href="{{ route('counseling-groups')}}"  >  Groups</a>
                                   </li> 
                                    <li   {{$counseling_members_active}} >
                                       <a href="{{ route('counseling-members')}}"  >Members</a>
                                   </li> 
                                    <li   {{$counseling_plans_active}} >
                                       <a href="{{ route('counseling-plans')}}"  >Plans</a>
                                   </li>
                               </ul>
                               
                            </li>
                            
                            
                            
                            
                            <li>
                                <a href="{{ route('faq')}}" <?php if(isset($active) && $active == 'faq'): echo 'class="active"'; endif; ?>> 
                                    <i class=" la la-question-circle"></i> 
                                    <span> Faq </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('queries')}}" <?php if(isset($active) && $active == 'queries'): echo 'class="active"'; endif; ?>> 
                                    <i class=" la la-question"></i> 
                                    <span> Queries </span>
                                </a>
                            </li>
                            

                            <li>
                                <a href="{{ route('contact_queries')}}" <?php if(isset($active) && $active == 'contact-queries'): echo 'class="active"'; endif; ?>> 
                                    <i class=" la la-phone"></i> 
                                    <span> Contact Queries </span>
                                </a>
                            </li>
                            
                            
                            <li>
                                <a href="{{ route('admin_settings')}}" <?php if(isset($active) && $active == 'settings'): echo 'class="active"'; endif; ?>> 
                                    <i class="la la-gear"></i> 
                                    <span> Settings </span>
                                </a>
                            </li>
                            
                            
                            
<!--                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-dashboard"></i>
                                    <span class="badge badge-info badge-pill float-right">2</span>
                                    <span> Dashboards </span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="index.html">Dashboard 1</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-2.html">Dashboard 2</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-cube"></i>
                                    <span> Apps </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="apps-calendar.html">Calendar</a>
                                    </li>
                                    <li>
                                        <a href="apps-contacts.html">Contacts</a>
                                    </li>
                                    <li>
                                        <a href="apps-tickets.html">Tickets</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-clone"></i>
                                    <span> Layouts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="layouts-sidebar-sm.html">Small Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="layouts-light-sidebar.html">Light Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="layouts-dark-topbar.html">Dark Topbar</a>
                                    </li>
                                    <li>
                                        <a href="layouts-preloader.html">Preloader</a>
                                    </li>
                                    <li>
                                        <a href="layouts-sidebar-collapsed.html">Sidebar Collapsed</a>
                                    </li>
                                    <li>
                                        <a href="layouts-boxed.html">Boxed</a>
                                    </li>
                                </ul>
                            </li>
                
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-envelope"></i>
                                    <span> Email </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="email-inbox.html">Inbox</a>
                                    </li>
                                    <li>
                                        <a href="email-read.html">Read Email</a>
                                    </li>
                                    <li>
                                        <a href="email-compose.html">Compose Email</a>
                                    </li>
                                    <li>
                                        <a href="email-templates.html">Email Templates</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-file-text-o"></i>
                                    <span> Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="pages-starter.html">Starter</a>
                                    </li>
                                    <li>
                                        <a href="pages-login.html">Log In</a>
                                    </li>
                                    <li>
                                        <a href="pages-register.html">Register</a>
                                    </li>
                                    <li>
                                        <a href="pages-recoverpw.html">Recover Password</a>
                                    </li>
                                    <li>
                                        <a href="pages-lock-screen.html">Lock Screen</a>
                                    </li>
                                    <li>
                                        <a href="pages-logout.html">Logout</a>
                                    </li>
                                    <li>
                                        <a href="pages-confirm-mail.html">Confirm Mail</a>
                                    </li>
                                    <li>
                                        <a href="pages-404.html">Error 404</a>
                                    </li>
                                    <li>
                                        <a href="pages-404-alt.html">Error 404-alt</a>
                                    </li>
                                    <li>
                                        <a href="pages-500.html">Error 500</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-diamond"></i>
                                    <span class="badge badge-danger float-right">New</span>
                                    <span> Extra Pages </span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="extras-profile.html">Profile</a>
                                    </li>
                                    <li>
                                        <a href="extras-timeline.html">Timeline</a>
                                    </li>
                                    <li>
                                        <a href="extras-invoice.html">Invoice</a>
                                    </li>
                                    <li>
                                        <a href="extras-faqs.html">FAQs</a>
                                    </li>
                                    <li>
                                        <a href="extras-pricing.html">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="extras-maintenance.html">Maintenance</a>
                                    </li>
                                    <li>
                                        <a href="extras-coming-soon.html">Coming Soon</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-title mt-2">Components</li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-briefcase"></i>
                                    <span> UI Elements </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="ui-buttons.html">Buttons</a>
                                    </li>
                                    <li>
                                        <a href="ui-cards.html">Cards</a>
                                    </li>
                                    <li>
                                        <a href="ui-tabs-accordions.html">Tabs & Accordions</a>
                                    </li>
                                    <li>
                                        <a href="ui-modals.html">Modals</a>
                                    </li>
                                    <li>
                                        <a href="ui-progress.html">Progress</a>
                                    </li>
                                    <li>
                                        <a href="ui-notifications.html">Notifications</a>
                                    </li>
                                    <li>
                                        <a href="ui-general.html">General UI</a>
                                    </li>
                                    <li>
                                        <a href="ui-typography.html">Typography</a>
                                    </li>
                                    <li>
                                        <a href="ui-grid.html">Grid</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="widgets.html">
                                    <i class="la la-coffee"></i>
                                    <span> Widgets </span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-bullhorn"></i>
                                    <span class="badge badge-info float-right">Hot</span>
                                    <span> Admin UI </span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="admin-sweet-alert.html">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="admin-nestable.html">Nestable List</a>
                                    </li>
                                    <li>
                                        <a href="admin-range-slider.html">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="admin-tour.html">Tour Page</a>
                                    </li>
                                    <li>
                                        <a href="admin-lightbox.html">Lightbox</a>
                                    </li>
                                    <li>
                                        <a href="admin-treeview.html">Treeview</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-bullseye"></i>
                                    <span> Icons </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="icons-feather.html">Feather Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-lineawesome.html">Line Awesome</a>
                                    </li>
                                    <li>
                                        <a href="icons-mdi.html">Material Design Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-font-awesome.html">Font Awesome</a>
                                    </li>
                                    <li>
                                        <a href="icons-simple-line.html">Simple Line</a>
                                    </li>
                                </ul>
                            </li>
                
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-wrench"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="forms-elements.html">General Elements</a>
                                    </li>
                                    <li>
                                        <a href="forms-advanced.html">Advanced</a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.html">Validation</a>
                                    </li>
                                    <li>
                                        <a href="forms-pickers.html">Pickers</a>
                                    </li>
                                    <li>
                                        <a href="forms-wizard.html">Wizard</a>
                                    </li>
                                    <li>
                                        <a href="forms-masks.html">Masks</a>
                                    </li>
                                    <li>
                                        <a href="forms-summernote.html">Summernote</a>
                                    </li>
                                    <li>
                                        <a href="forms-quilljs.html">Quilljs Editor</a>
                                    </li>
                                    <li>
                                        <a href="forms-file-uploads.html">File Uploads</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-table"></i>
                                    <span> Tables </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="tables-basic.html">Basic Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-datatables.html">Data Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-editable.html">Editable Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-responsive.html">Responsive Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-tablesaw.html">Tablesaw Tables</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-bar-chart"></i>
                                    <span> Charts </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="charts-apex.html">Apex Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-flot.html">Flot Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-morris.html">Morris Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartjs.html">Chartjs Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-bright.html">Bright Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartist.html">Chartist Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-peity.html">Peity Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-sparklines.html">Sparklines Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-knob.html">Jquery Knob Charts</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-map"></i>
                                    <span> Maps </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="maps-google.html">Google Maps</a>
                                    </li>
                                    <li>
                                        <a href="maps-vector.html">Vector Maps</a>
                                    </li>
                                    <li>
                                        <a href="maps-mapael.html">Mapael Maps</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="la la-plus-square-o"></i>
                                    <span> Multi Level </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);">Level 1.1</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Level 1.2
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li>
                                                <a href="javascript: void(0);">Level 2.1</a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);">Level 2.2</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
