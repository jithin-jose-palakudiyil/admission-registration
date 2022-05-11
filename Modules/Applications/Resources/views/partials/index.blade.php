@extends('applications::layouts.master')
 
@section('content')
<!-- Start Content-->
<div class="container"> 
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3 text-center">
                    <div style="font-weight: bold;margin-bottom: 10px;line-height: 25px;font-size: 18px">{!!$result->name!!}</div>
                    <div style="font-weight: 300;margin-bottom: 10px;font-size: 14px">
                        APPLICATION FOR ADMISSION TO {{strtoupper($result->form_name)}} COURSE 
                        {{date('Y')}} - {{date('Y')+1}}
                    </div>
                </h4>
                @include($include_form)
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
    <!-- end row -->    
</div> 
<!-- container -->

@endsection

