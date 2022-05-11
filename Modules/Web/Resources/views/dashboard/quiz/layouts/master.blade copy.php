@include('web::dashboard.quiz.layouts.head')
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('web::dashboard.quiz.layouts.topbar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container">
                        
                        <!-- start page title -->
                        <!-- end page title --> 
                        @if(Session::has('flash-success-message'))
                        <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Well done!</span> {!! Session::get('flash-success-message')!!}
                        </div> 
                        @endif

                        @if(Session::has('flash-error-message')) 
                        <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Oh snap!</span> {!! Session::get('flash-error-message') !!}.
                        </div>
                        @endif
                        
                        <!-- page content -->
                         @yield('content')
                        <!-- end page content --> 
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
               @include('web::dashboard.quiz.layouts.footer')
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

        @include('web::dashboard.quiz.layouts.footer-script')
     </body> 
