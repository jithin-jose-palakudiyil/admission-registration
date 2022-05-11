@include('web::dashboard.layouts.head')
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('web::dashboard.layouts.topbar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('web::dashboard.layouts.sidebar')

            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div style="bbackground: #f1f2f5;" class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
            @include('web::dashboard.layouts.breadcrumb')
                        
                        <!-- start page title -->
                        <!-- end page title --> 
                        @if(Session::has('flash-success-message'))
                        <div style="text-align: center" class="alert bg-success text-white alert-styled-left alert-dismissible font-weight-semibold" style="background-color: #009688 !important;">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                             {!! Session::get('flash-success-message')!!}
                        </div> 
                        @endif

                        @if(Session::has('flash-error-message')) 
                        <div style="text-align: center" class="alert bg-danger text-white alert-styled-left alert-dismissible font-weight-semibold">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                             {!! Session::get('flash-error-message') !!}
                        </div>
                        @endif
                        
                        <!-- page content -->
                         @yield('content')
                        <!-- end page content --> 
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
               @include('web::dashboard.layouts.footer')
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

        @include('web::dashboard.layouts.footer-script')
      
