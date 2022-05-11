<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($page_title)) : echo $page_title; else: echo 'Application'; endif; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <!--<link rel="shortcut icon" href="assets/images/favicon.ico">-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- third party css -->
 
         <!-- App css -->
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

        @yield('css') 
        <!-- /custom stylesheets -->
        
        <!-- custom style -->
        @stack('style')
        @yield('custom_js')
        <!-- custom style -->
        <script> var base_url ='<?php echo URL('/'); ?>';  var application_prefix = "{{application_prefix}}";</script>
    
    </head>
    <body class="left-side-menu-light">