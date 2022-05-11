<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php  if (isset($page_title)){ echo $page_title; } ?></title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/favicon-16x16.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/favicon-32x32.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/apple-touch-icon.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/android-chrome-192x192.png')}}">
        <link rel="icon" sizes="16x16" href="{{asset('public/assets/images/android-chrome-512x512.png ')}}">
        <!-- third party css -->
        <link href="{{asset('public/assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

        <!-- App css -->
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
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
        <script type="application/javascript">
            var base_url = "{{url('/')}}";
            var admin_prefix = "{{admin_prefix}}";
        </script>
        
    </head>
