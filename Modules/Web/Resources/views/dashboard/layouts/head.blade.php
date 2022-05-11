<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($page_title)): echo $page_title; else: echo 'MGM'; endif; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/favicon-16x16.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/favicon-32x32.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/apple-touch-icon.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/android-chrome-192x192.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/android-chrome-512x512.png ')}}">
        <link href="{{asset('public/css/custom.css')}}" rel="stylesheet" type="text/css" />

        <!-- custom stylesheets -->
        @yield('css') 
        <!-- /custom stylesheets -->
        
        <!-- custom style -->
        @stack('style')
        <!-- custom style -->
        
        <!-- custom js top -->
         @yield('jstop') 
        <!-- /custom js top -->
        
        
        <!-- App css -->
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/libs/fontawesome/css/all.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/libs/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css" />


        

        <script src="{{asset('public/assets/js/jquery-3.4.1.min.js')}}"></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-M7YGRQL4LC"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-M7YGRQL4LC');
        </script>
             
        <script type="application/javascript">
            var base_url = "{{url('/')}}";
            var web_prefix = "{{web_prefix}}";
        </script>
    </head>
