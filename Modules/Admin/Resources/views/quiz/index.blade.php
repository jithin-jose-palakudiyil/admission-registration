@extends('admin::layouts.master') 

@section('css')  
        <!-- third party css -->
        <link href="{{asset('public/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('public/assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/libs/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <!-- third party css end -->
@stop

@section('content') 
 
       <?php
session_start();
if( isset($_SESSION['flash-success-message']) && !empty($_SESSION['flash-success-message'])) 
{
    $success_message = $_SESSION['flash-success-message'];
    ?>
      <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Well done!</span> {!! $success_message !!}
        </div> 
         
    <?php
    unset($_SESSION['flash-success-message']); 
} 
   ?>
          
       
    
<?php 

if( isset($_SESSION['flash-error-message']) && !empty($_SESSION['flash-error-message'])) 
{
    $error_message = $_SESSION['flash-error-message'];
     ?> 
        <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <span class="font-weight-semibold">Oh snap!</span> {!! $error_message !!}.
        </div> 
     <?php
     unset($_SESSION['flash-error-message']); 
}
?>
<!-- Basic datatable -->
 <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <table id="quiz-datatable" class="table dt-responsive" data-url='{{route('quiz_list')}}'>
                                            <thead>
                                                <tr>
                                                    <th>Scholarship Exam</th>
                                                    <th>Open or Close</th> 
                                                    <th class="text-center">Actions</th>
                                                    <th>Status</th> 
                                                </tr>
                                            </thead> 
                                            <tbody>  </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->                               
<!-- Basic datatable -->                          
@stop

@section('js')  
<style>
    .btn-light {
    color: #000 !important;
    margin-right: 10px !important;
}
</style>
    <script src="{{asset('public/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('public/assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/quiz.js')}}"></script>    
@stop
