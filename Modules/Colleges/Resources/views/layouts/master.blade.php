    @include('colleges::layouts.header')
    <body class="left-side-menu-light">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('colleges::partials.topbar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('colleges::partials.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content"> 
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        @include('colleges::partials.breadcrumb')   
                        <!-- end page title --> 
                        @include('colleges::partials.flash-message')  
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
 
       @include('colleges::layouts.footer')
    </body>
</html>
