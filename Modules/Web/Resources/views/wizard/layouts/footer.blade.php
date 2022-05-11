    <footer class="footer footer-alt">
        <?php echo date('Y'); ?> &copy; Developed by <a href="http://inventivhub.com/">InventivHub</a> 
        </footer>

        <!-- Vendor js -->
        <script src="{{asset('public/assets/js/vendor.min.js')}}"></script>


        
        <!-- App js -->
        <script src="{{asset('public/assets/libs/validation/validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/assets/libs/jquery-ui/jquery-ui.min.js')}}"></script> 
        <script src="{{asset('public/assets/js/app.min.js')}}"></script>

    @yield('js') 
