<footer class="footer" style="left: 0px !important"> 
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo date('Y'); ?>  &copy; Upvex theme by <a target="blank" href="https://inventivhub.com/">The Inventiv Hub</a> 
                            </div> 
                        </div>
                    </div>
                </footer>
    <!-- custom JS files -->
    @yield('js') 
    <!-- /custom JS files -->
         
    <!-- custom script -->
    @stack('scripts')
    
   
        
 </body>
</html>