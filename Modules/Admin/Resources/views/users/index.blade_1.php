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
<form action="" method="get">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filter by documents:</label>
                        <select name="document_status"  id="document_status" class="form-control" data-toggle="select2" data-placeholder="document status">
                            <option value="" > select </option> 
                            <option value="1"  <?php if(isset($request->document_status) && $request->document_status==1): echo 'selected=""'; endif; ?>>Uploded</option>
                            <option value="0" <?php if(isset($request->document_status) && $request->document_status==0): echo 'selected=""'; endif; ?>>Not Uploded</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" >
                <label>Filter by users who not attend any exams ?</label>
                    <div class="checkbox checkbox-success mb-2">
                        <input id="not_attend_any_exams" type="checkbox" value="1" name="not_attend_any_exams" <?php  if(isset($request->not_attend_any_exams) && $request->not_attend_any_exams ==1): echo ' checked=""'; endif; ?> >
                            <label for="not_attend_any_exams">
                                <b>Yes</b>
                        </label>
                    </div>
                </div> 
                <div  class="col-md-1">
                    <div class="form-group"> 
                        <button style="margin-top: 28px" type="submit" id="filter" class="btn btn-primary mr-1 waves-effect waves-light filter">Filter </button>
                    </div>
                </div>
                <div style="margin-bottom:25px" class="col-md-4"> 
                    <div style="display: inline-block; margin-top: 25px" class="">
                        <a href="{{route('download-all-not-attended')}}">
                            <button  type="button" class="btn btn-success mr-1 waves-effect waves-light">Download exam not attended user's</button>
                        </a>
                    </div> 
                </div>
            </div>
            
        </div>
    </div>
</form>
<!-- Basic datatable -->
 <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <table id="users-datatable" class="table dt-responsive" data-document="<?php if(isset($request->document_status)): echo $request->document_status; else: echo null;; endif; ?>" data-not_attend_any_exams="<?php if(isset($request->not_attend_any_exams)): echo $request->not_attend_any_exams; else: echo null;; endif; ?>" data-url='{{route('users_list')}}'>
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Documents</th>
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
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/user.js')}}"></script>    
@stop
