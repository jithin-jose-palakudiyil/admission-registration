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
            var dashboard_url = "{{url('/dashboard')}}";
            var dashboard_quiz_url = "{{url('/dashboard/quiz')}}";
            var react_app_url = "{{url('/dashboard/start-quiz')}}";
            var encrypted_quiz_id = "{{$encrypted_quiz_id}}";
            var web_prefix = "{{web_prefix}}";
            var current_quiz = <?php echo $quiz; ?>;
            var start_exam_url = "{{url('/start-quiz')}}";
            var exam_api_url = "{{url('/get_quiz_question_answers')}}";
            var store_exam_data_url = "{{url('/store_exam_data')}}";
            var preview_quiz_url = "{{url('/preview_quiz')}}";
            var submit_mode_quiz_url = "{{url('/submit_mode_quiz')}}";
            var submit_quiz_url = "{{url('/submit_quiz')}}";
            var VideoLoadImageUrl = "{{asset('public/assets/images/video_load.png')}}";
            var VideoLoadErrorImageUrl = "{{asset('public/assets/images/video_error.png')}}";
            var ErrorImageUrl = "{{asset('public/assets/images/quiz_error.png')}}";
            var InfoImageUrl = "{{asset('public/assets/images/info2.jpg')}}";
        </script>

        <script type="text/javascript" >
        function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
            window.onunload=function(){null};
        </script>


    </head>

    
