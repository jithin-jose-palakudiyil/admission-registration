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
 
 
<!-- Basic datatable -->
 <div class="row">
     <input type="hidden" value="{{$quiz->id}}" name="quiz_id" id="quiz_id"/>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <table id="quiz-questions-datatable" class="table dt-responsive" data-url='{{route('quiz_questions_list')}}'>
                                            <thead>
                                                <tr>
                                                    <th>SI No.</th>
                                                    <th>Youtube id</th>
                                                    <th>Question</th>
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
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/quiz_questions.js')}}"></script>    
@stop
