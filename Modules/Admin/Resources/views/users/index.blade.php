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
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Colleges:</label>
                        <select name="college_id"  id="college_id"  class="form-control" data-toggle="select2" data-placeholder="document status">
                            <option value="" > All </option>
                            <?php $colleges = \Modules\Admin\Entities\Colleges::where('status',1)->get(); 
                            if($colleges->isNotEmpty()):
                                foreach ($colleges as $key => $value):
                                $selected=null;
                                if(isset($request->college_id) && $value->id == $request->college_id ): $selected ='selected=""'; endif; ?>
                            <option value="{{$value->id}}" {{$selected}} > {{$value->name}} </option>
                                <?php
                                endforeach;
                            endif;
                            ?>
                       </select>
                    </div>
                </div>
                
                <div  class="col-md-1">
                    <div class="form-group"> 
                        <button style="margin-top: 28px" type="submit" id="filter" class="btn btn-primary mr-1 waves-effect waves-light filter">Filter </button>
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
                                      
                                        <table id="users-datatable" class="table dt-responsive" data-college="<?php if(isset($request->college_id)): echo $request->college_id; else: echo null;; endif; ?>" data-url='{{route('users_list')}}'>
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th> 
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
