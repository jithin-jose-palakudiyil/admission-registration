@extends('applications::layouts.master')
 
@section('content')

<style>
    .table-header .logo {
    max-width: 250px;
    }
    .table-header .logo img {
    max-width: 100px;
    }

    @media screen and (max-width: 767px) {
        .table-header .logo img {
        max-width: 130px;
        }
    }
</style>

@if(!Session::has('flash-success-message'))
<!-- Start Content-->
<div class="container"> 
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between" class="table-header">
                    <div class="logo">
                        <a href="#"><img src="{{asset('Modules/Colleges/Resources/assets/img/logo_mgm.png')}}" alt="" class="img-fluid"></a>
                    </div>
                    <div class="table-header-content">
                        <?php  if($result->id==9 && $result->form_slug=='d-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_D_pharm_regular_9.jpg" width="717">
                        <?php elseif($result->id==9 && $result->form_slug=='b-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_B_pharm_regular_9.jpg" width="717">
                        
                        <?php elseif($result->id==5 && $result->form_slug=='d-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_D_pharm_regular_5.jpg" width="717">
                        <?php elseif($result->id==5 && $result->form_slug=='b-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_B_pharm_regular_5.jpg" width="717">
                        
                        <?php elseif($result->id==7 && $result->form_slug=='d-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_D_pharm_regular_7.jpg" width="717">
                        <?php elseif($result->id==7 && $result->form_slug=='b-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_B_pharm_regular_7.jpg" width="717">
                        
                        <?php elseif($result->id==3 && $result->form_slug=='d-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_D_pharm_regular_3.jpg" width="717">
                        <?php elseif($result->id==3 && $result->form_slug=='b-pharm-regular'): ?>
                        <img src="/Logos/MgmLogo_B_pharm_regular_3.jpg" width="717">
                        
                        <?php else: ?> 
                        {!!$result->application_heading!!}
                        <?php endif; ?>
                    </div>
                    <div></div>
                </div>
                <div style="margin-top: 25px" class="head-right">
                <h4 class="header-title mb-3 text-center">
                    <div style="font-weight: 300;margin-bottom: 10px;font-size: 14px">
                        APPLICATION FOR ADMISSION TO {{strtoupper($result->form_name)}} COURSE 
                        {{date('Y')}} - {{date('Y')+1}}
                    </div>
                    @if(Session::has('flash-error-message')) 
                    <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Oh snap!</span> {!! Session::get('flash-error-message') !!}.
                    </div>
                    @endif
                </h4>
                </div>
                @include($include_form)
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
    <!-- end row -->    
</div> 
<!-- container -->
@else
<div class="row">
     <div class="col-12">
         <div class="text-center">
            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
            <h3 class="mt-0">Success !</h3> 
            <p class="w-75 mb-2 mx-auto">
                 {!! Session::get('flash-success-message') !!}
            </p> 
        </div>
    </div> <!-- end col -->
</div>
@endif
@endsection
@section('custom_js')
<?php if(isset($explode) && isset($explode[0])):  ?> 
<script> var college_id =<?=$explode[0]?> </script>
<?php endif; ?>
@endsection