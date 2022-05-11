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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <table id="college-category-datatable" class="table dt-responsive" data-url='{{route('college_category_list')}}'>
                                            <thead>
                                                <tr>
                                                    <th>Category</th> 
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
        <!--<script src="{{asset('public/assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>-->
        <script src="{{asset('public/assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
        
<!--    <script src="{{asset('public/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>   
    <script src="{{asset('public/global_assets/js/plugins/notifications/noty.min.js')}}"></script> -->
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/college_category.js')}}"></script>    
@stop
