@include('web::dashboard.quiz.layouts.head')
    <body  style="-moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select:none;
        user-select:none;
        -o-user-select:none;"
     
 unselectable="on"
 onselectstart="return false;" 
 onmousedown="return false;">

        <!-- Begin page -->
        <div id="wrapper">

            @include('web::dashboard.quiz.layouts.topbar')

            <div class="container">
                <div class="row">
                    <div style="margin-top: 137px" class="col-lg-12 col-md-12 col-sm-12">
                          

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



                    </div>
                </div>
                <div>
                    @include('web::dashboard.quiz.layouts.footer')
                </div>
            </div>

        </div>
        <!-- END wrapper -->

        @include('web::dashboard.quiz.layouts.footer-script')
     </body> 
