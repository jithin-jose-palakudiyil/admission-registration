 
        <!-- Vendor js -->
        <script src="{{asset('public/assets/js/vendor.min.js')}}"></script>
 
        <!-- App js -->
        <script src="{{asset('public/assets/js/app.min.js')}}"></script>
        
        <!-- custom JS files -->
        @yield('js') 
        <!-- /custom JS files -->

        <!-- custom script -->
        @stack('script')
