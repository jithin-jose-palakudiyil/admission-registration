@include('applications::layouts.header') 

   

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('applications::partials.navbar') 
            <!-- end Topbar -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content">
                 <div class="clearfix" style="margin-top: 120px"></div>
                @yield('content')
            </div> 
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            <!-- Footer Start -->
            @include('applications::layouts.footer') 
            <!-- end Footer -->

        </div>
        <!-- END wrapper -->

         

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

       
   