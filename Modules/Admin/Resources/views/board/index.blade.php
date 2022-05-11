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
 


<div class="card"> 
     <div class="card-body">
    <table class="table datatable-basic" id="board-datatable" data-url='{{route('board_list')}}'>
        <thead>
            <tr>
                <th>Name</th> 
                <th>Board Type</th> 
                <th>Slug</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div></div>
                                                      
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
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/board.js')}}"></script>    
@stop
