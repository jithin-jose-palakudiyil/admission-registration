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

<style>
    .card-box{
        background: #f1f1f1!important;
    }

    .text-muted{
        color: #404040 !important;
        font-weight: 600 !important;
    }
</style>

<?php $TotalExams = Modules\Admin\Entities\UserExam::all();  ?>



<!-- Basic datatable -->
                    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div style="display: none" id="filter_error_container">
                                        <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                            <span id="filter_error" class="font-weight-semibold"></span>
                                        </div>
                                    </div>
                                    <form action="{{route('user_quiz.list-filtered')}}" method="post" id="filter_form"> 
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Filter by Scholarship Exam:</label>
                                                <select name="exam_id" id="exam_id" class="form-control" data-toggle="select2" data-placeholder="exam_id">
                                                    <option value="" > select </option> 
                                                    <?php 
                                                    $quizzes = \Modules\Web\Entities\Quiz::all();
                                                    if(isset($quizzes) && count($quizzes)>0):
                                                      foreach ($quizzes as $key => $value):  
                                                        if(isset($value->name)):
                                                        ?>
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    <?php endif; endforeach; endif;?>
                                                </select>
                                            </div>
                                        </div> 


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Filter by exam status:</label>
                                                <select name="exam_status" id="exam_status" class="form-control" data-toggle="select2" data-placeholder="Exam Status">
                                                    <option value="" > select </option> 
                                                    <option value="1">Completed</option>
                                                    <option value="0">In progress</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Filter by documents:</label>
                                                <select name="document"  id="document" class="form-control" data-toggle="select2" data-placeholder="document status">
                                                    <option value="" > select </option> 
                                                    <option value="1"  >Uploded</option>
                                                    <option value="0" >Not Uploded</option>
                                                </select>
                                            </div>
                                        </div>
                                            <div style="margin-bottom:25px" class="col-md-4">
                                                <div style="display: inline-block; margin-top: 25px" class="">
                                                    <!--<div>-->
                                                    <button type="submit" id="filter" class="btn btn-primary mr-1 waves-effect waves-light filter">Filter </button>
                                                    <!--</div>-->
                                                </div>

                                                <div style="display: inline-block; margin-top: 25px" class="">
                                                    <!--<div>-->
                                                    <button id="download_data" class="btn btn-success mr-1 waves-effect waves-light">Download</button>
                                                    <!--</div>-->
                                                </div>

                                                <div style="display: inline-block; margin-top: 25px" class="">
                                                    <!--<div>-->
                                                    <button id="reset" class="btn btn-danger mr-1 waves-effect waves-light">Refresh </button>
                                                    <!--</div>-->
                                                </div>

                                    
                                            </div>
                                        <div class="col-md-4 ">
                                        </div>
                                    </div>
                                    </form>

                                    <!-- count area -->

                                    <div class="row default-count-area">
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-sm bg-soft-success rounded">
                                                        <i class="fe-clipboard avatar-title font-22 text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                        <h3 class="text-dark my-1">{{$TotalExams->count()}}</h3>
                                                        <p class="text-muted mb-1 text-truncate">Total entries</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div> <!-- end card-box-->
                                    </div> <!-- end col -->

                                    <div class="col-md-6 col-xl-4">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-sm bg-soft-purple rounded">
                                                        <i class="fe-check-square avatar-title font-22 text-purple"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                        <?php
                                                            $filterCompleted =  $TotalExams->filter(function ($value, $key) {
                                                                return $value->quiz_status == 1;
                                                            });
                                                        ?>
                                                        <h3 class="text-dark my-1">{{$filterCompleted->count()}}</h3>
                                                        <p class="text-muted mb-1 text-truncate">Completed</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> <!-- end card-box-->
                                    </div> <!-- end col -->


                                    <div class="col-md-6 col-xl-4">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-sm bg-soft-purple rounded">
                                                        <i class="fe-x-square avatar-title font-22 text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                    <?php
                                                            $filterInProgress =  $TotalExams->filter(function ($value, $key) {
                                                                return $value->quiz_status != 1;
                                                            });
                                                        ?>
                                                        <h3 class="text-dark my-1">{{$filterInProgress->count()}}</h3>
                                                        <p class="text-muted mb-1 text-truncate">In progress</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> <!-- end card-box-->
                                    </div> <!-- end col -->
                                </div>


                                <div style="display: none" class="row filter-count-area">
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-sm bg-soft-success rounded">
                                                        <i class="fe-clipboard avatar-title font-22 text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                        <h3 class="text-dark my-1" id="filter_total_exam_count"></h3>
                                                        <p class="text-muted mb-1 text-truncate">Total entries</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div> <!-- end card-box-->
                                    </div> <!-- end col -->

                                    <div class="col-md-6 col-xl-4">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-sm bg-soft-purple rounded">
                                                        <i class="fe-check-square avatar-title font-22 text-purple"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                        <h3 class="text-dark my-1" id="filter_completed_exam_count"></h3>
                                                        <p class="text-muted mb-1 text-truncate">Completed</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> <!-- end card-box-->
                                    </div> <!-- end col -->


                                    <div class="col-md-6 col-xl-4">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="avatar-sm bg-soft-purple rounded">
                                                        <i class="fe-x-square avatar-title font-22 text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-right">
                                                        <h3 class="text-dark my-1" id="filter_incompleted_exam_count"></h3>
                                                        <p class="text-muted mb-1 text-truncate">In progress</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> <!-- end card-box-->
                                    </div> <!-- end col -->
                                </div>

                                        <!--End count area -->


                                        <table id="users-quiz-datatable" class="table dt-responsive" data-url='{{route('user_quiz.list')}}'>
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Scholarship exam name</th>
                                                    <th>Documents</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Actions</th>
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
     
@endsection

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
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/user_quiz.js')}}"></script>    
@stop
