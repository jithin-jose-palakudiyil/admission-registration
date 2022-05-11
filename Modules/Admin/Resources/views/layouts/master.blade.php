    @include('admin::layouts.header')
    <body class="left-side-menu-light">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('admin::partials.topbar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin::partials.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content"> 
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        @include('admin::partials.breadcrumb')   
                        <!-- end page title --> 
                        @include('admin::partials.flash-message')  
                        @yield('content')
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo date('Y'); ?> &copy; developed by <a href="https://inventivhub.com/" target="_blank">InventivHub</a>
                            </div> 
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
 
       @include('admin::layouts.footer')
    </body>
</html>
