   
        <!-- Vendor js -->
        <script src="{{asset('public/assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('public/assets/js/pages/dashboard-1.init.js')}}"></script>


        
        <!-- custom JS files -->
        @yield('js') 
        <!-- /custom JS files -->
        <!-- custom script -->
        @stack('script')
        
        <!-- App js -->
        
        <script>
        $("body").on("contextmenu", function(e) {
            return false;
        });

    </script>
        <script src="{{asset('public/assets/js/app.min.js')}}"></script>  
        <script src="https://player.vimeo.com/api/player.js"></script>     
         <script src="{{asset('public/js/web.js')}}"></script> 

    </body>
</html>
