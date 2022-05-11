@extends('colleges::layouts.master')
@section('css') 
<link href="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('public/assets/libs/clockpicker/bootstrap-clockpicker.min.css')}}" rel="stylesheet" type="text/css" />
    
 <style>
            *,
            *:before,
            *:after {
            box-sizing: border-box;
            }
            body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 400;
            background: #E6E6E6;
            color: #333333;
            margin: 0;
            }
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            ul,
            li,
            a {
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            }
            a:hover {
            text-decoration: none;
            }
            /* header section end */
            .clg {
            padding: 20px 30px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, .2);
            }
            .clg table {
            width: 100%;
            border-collapse: collapse;
            }
            .clg table,
            .clg table tr,
            .clg table tr td {
            border: 1px solid #999;
            }
            .clggm-table table tr th {
            padding: 5px;
            }
            .clg table tr th p {
            font-weight: normal;
            }
            .clg table tr td {
            width: 50%;
            padding: 10px 10px;
            }
            .clg table tr td:first-child {
            font-weight: 700;
            }
            .table-header {
            display: flex;
            align-items: center;
            padding: 10px 0 0 20px;
            }
            .table-header .logo {
            max-width: 250px;
            }
            .table-header .logo img {
            max-width: 100px;
            }
            .table-header-content {
            margin-left: 10px;
            }
            .table-header-content h1 {
            font-size: 21px;
            color: #000000;
            font-weight: 700;
            text-transform: uppercase;
            }
            .table-header-content h4 {
            font-size: 16px;
            color: #4F4E4E;
            }
            .table-header-content h5 {
            font-size: 18px;
            color: #000000;
            font-weight: 400;
            margin: 10px 0
            }
            .table-header-content h5 span {
            text-transform: uppercase;
            }
            .clg table tr th h2 {
            font-size: 22px;
            color: #000000;
            font-weight: 700;
            text-align: center;
            padding: 20px;
            }
            .clg table tr th .application {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-top: 10px;
            }
            .clg table tr th .application span {
            font-size: 16px;
            font-weight: 700px;
            color: #000000;
            }
            .application img {
            max-width: 180px;    max-height: 180px;
            }
            .in-table tr td p {
            font-weight: normal;
            }
            .diclaration-area {
            padding-top: 30px;
            }
            .diclaration-area h3 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            }
            .all-text {
            padding: 0 20px;
            }
            .diclaration-form {
            display: flex;
            }
            .site {
            width: 50%;
            }
            .site p {
            font-weight: 700;
            margin: 20px 0;
            }
            .diclaration-area .dv {
            background: #000 !important;
            width: 100%;
            height: 1px;
            margin-top: 10px;
            }
            .diclaration-area h4 {
            border-bottom: 1px splod #999;
            text-align: center;
            text-decoration: underline;
            font-weight: 700;
            margin-bottom: 10px;
            }
            .table-header-content {
            text-align: left;
            margin-bottom: 0px;
            }
            .container {
            max-width: 950px;
            margin-left: auto;
            margin-right: auto;
            }
            [colspan="2"] {
            padding: 15px;
            }
            /*
            ====================================
            Xtra Small Screen - Small Mobile
            ====================================
            */
            @media screen and (max-width: 767px) {
            .clg {
            padding: 8px;
            background: #fff;
            }
            .table-header {
            padding: 10px 0;
            }
            .table-header-content h1 {
            font-size: 16px;
            color: #000000;
            font-weight: 700;
            text-transform: uppercase;
            }
            .table-header-content h5 {
            font-size: 16px;
            }
            .table-header-content h4 {
            margin: 10px 0;
            font-size: 16px;
            }
            .clg table tr th h2 {
            font-size: 17px;
            }
            .responise {
            font-size: 17px;
            }
            .clg table tr td {
            padding: 10px 5px;
            font-size: 15px;
            }
            .table-header .logo img {
            max-width: 130px;
            }
            }
        </style> 
@endsection
 
@section('content') 

<?php
//dd($application);
$plus_two_mark_list = $diploma_mark_list = $SSLC_mark_list = $btech_mark_list =false;
?> 
<?php  if(isset($application->hasForms->slug) && $application->hasForms->slug != null): ?>
    <div class="row"> 
        <div class="col-md-12"> 
            <!--onclick="printDiv('PrintApplication')"--> 
            <button data-toggle="modal" data-target="#myModal"  style=" margin-bottom: 15px; margin-top: -5px;float: right;" type="button" class="btn btn-primary waves-effect waves-light">
                <span class="btn-label"><i class=" la la-download"></i></span>Print Application
            </button>
         </div>
    </div>  
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form id="Date_Time_Form" action="{{route('clg_download_pdf', [$application->id])}}" method="get">
            <div class="modal-header" style="border: none !important">
                <h4>Crated Date</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="row">   
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Crated date</label>
                            <?php $created_at =  $application->created_at;
                            $created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->format('d-m-Y H:i:s');
                            ?>
                            <input type="text" disabled="" class="form-control" placeholder="" value="<?=$created_at?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="checkbox checkbox-primary mb-2">
                            <input name="change_created_at"  id="change_created_at" class="change_created_at" type="checkbox" value="1" >
                            <label for="change_created_at">
                                I need to change crated date in the print application
                            </label>
                        </div>
                   </div>
                </div>
                <div id="ShowDiv" style="display: none">  
                    <div class="row">
                       <div class="col-md-12">
                           <div class="form-group">
                               <label>New Crated Date</label> 
                               <input type="text" readonly="" name="new_created_date" class="form-control datepicker" placeholder="" >
                           </div>
                           <div id="new_created_date_err"></div>
                       </div>
                   </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>New Crated  Time</label>
                                <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                                    <input type="text" readonly="" class="form-control" name="new_created_time">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                    </div>
                                </div>
                                <div id="new_created_time_err"></div>
                            </div>
                        </div>
                    </div> 
                </div>
            
                <div class="row">  
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
                    </div>
                </div>
            </div>
         </form>
    </div>

  </div>
</div>
    <div class="row"> 
        <div class="col-md-12"> 
            <div class="card-box"> 
                <div id="PrintApplication">
                <?php if($application->hasForms->slug == 'btech-regular'): $plus_two_mark_list = true;   ?> 
                    @include('colleges::applications.print.btech-regular-print', [$application]) 
                <?php elseif($application->hasForms->slug == 'btech-lateral-entry'): $plus_two_mark_list = $diploma_mark_list = $SSLC_mark_list  = true;   ?> 
                    @include('colleges::applications.print.btech-lateral-entry-print', [$application]) 
                <?php elseif($application->hasForms->slug == 'polytechnic-diploma-regular'): $plus_two_mark_list =  $SSLC_mark_list  = true;   ?> 
                    @include('colleges::applications.print.polytechnic-diploma-regular-print', [$application]) 
                <?php elseif($application->hasForms->slug == 'polytechnic-diploma-lateral-entry'): $plus_two_mark_list = $SSLC_mark_list = true;   ?> 
                    @include('colleges::applications.print.polytechnic-diploma-lateral-entry-print', [$application]) 
                <?php elseif($application->hasForms->slug == 'm-tech'): $plus_two_mark_list = $SSLC_mark_list = $btech_mark_list = true;   ?> 
                    @include('colleges::applications.print.m-tech-print', [$application]) 
                <?php elseif($application->hasForms->slug == 'b-pharm-regular'): $plus_two_mark_list = true;   ?> 
                    @include('colleges::applications.print.b-pharm-regular-print', [$application]) 
                <?php elseif($application->hasForms->slug == 'd-pharm-regular'): $plus_two_mark_list = true;   ?> 
                    @include('colleges::applications.print.d-pharm-regular-print', [$application]) 
                <?php  endif; ?> 
                </div>
            </div>
        </div>
    </div> 
    <div class="row"> 
        <div class="col-md-12"> 
            <div class="card-box"> 
                <h4 class="header-title mb-0">Documents Upload</h4><br/> 
                <div class="row"> 
                     <?php if($SSLC_mark_list): ?>
                     <div class="col-md-4"> 
                        <div class="form-group mb-4">
                            <div class="site">
                                <p style="margin: 0px;margin-top: 10px;margin-bottom: 10px"> SSLC Mark List </p>
                            </div>
                            <?php if(isset($application->sslc_mark_list) && $application->sslc_mark_list !=null):?> 
                                <a href="{{asset('public'.$application->sslc_mark_list)}}" target="_blank">
                                    <i class="la la-clipboard" style="font-size: 30px"></i>
                                </a>
                            <?php else: ?>
                            <span style="color: #fb2b2b">Not Uploded</span>
                            <?php endif; ?>
                        </div>
                     </div>
                    <?php  endif; ?>
                    <?php if($plus_two_mark_list): ?>
                    <div class="col-md-4"> 
                        <div class="form-group mb-4">
                            <div class="site">
                                <p style="margin: 0px;margin-top: 10px;margin-bottom: 10px"> Plus two mark list</p>
                            </div>
                            <?php if(isset($application->plus_two_mark_list) && $application->plus_two_mark_list !=null):?> 
                                <a href="{{asset('public'.$application->plus_two_mark_list)}}" target="_blank">
                                    <i class="la la-clipboard" style="font-size: 30px"></i>
                                </a>
                            <?php else: ?>
                            <span style="color: #fb2b2b">Not Uploded</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php  endif; ?> 
                     <?php if($diploma_mark_list): ?>
                    <div class="col-md-4"> 
                        <div class="form-group mb-4">
                            <div class="site">
                                <p style="margin: 0px;margin-top: 10px;margin-bottom: 10px"> Diploma Mark List </p>
                            </div>
                            <?php if(isset($application->diploma_mark_list) && $application->diploma_mark_list !=null):?> 
                                <a href="{{asset('public'.$application->diploma_mark_list)}}" target="_blank">
                                    <i class="la la-clipboard" style="font-size: 30px"></i>
                                </a>
                            <?php else: ?>
                            <span style="color: #fb2b2b">Not Uploded</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php  endif; ?> 
                   <?php if($btech_mark_list): ?>
                    <div class="col-md-4"> 
                        <div class="form-group mb-4">
                            <div class="site">
                                <p style="margin: 0px;margin-top: 10px;margin-bottom: 10px"> B.Tech Mark List </p>
                            </div>
                            <?php if(isset($application->btech_mark_list) && $application->btech_mark_list !=null):?> 
                                <a href="{{asset('public'.$application->btech_mark_list)}}" target="_blank">
                                    <i class="la la-clipboard" style="font-size: 30px"></i>
                                </a>
                            <?php else: ?>
                            <span style="color: #fb2b2b">Not Uploded</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php  endif; ?> 
                </div>
            </div>
        </div>
    </div> 
<?php  endif; ?> 
@endsection
@section('js')

<script src="{{asset('public/assets/libs/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/assets/libs/validation/validate.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
    $(function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose:true
        });
        $(".clockpicker").clockpicker();
        
        $('input[name="change_created_at"]').click(function(){
            if($(this).prop("checked") == true){
                $('input[name="new_created_date"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } ); 
                $('input[name="new_created_time"]').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  } } ); 
                $("#ShowDiv").show();
            }
            else if($(this).prop("checked") == false){
                $('input[name="new_created_date"]').rules('remove', 'required');
                $('input[name="new_created_time"]').rules('remove', 'required');
                $("#ShowDiv").hide();
            }
        });
        
        
        $("#Date_Time_Form").validate
        ({ 
            ignore: [],
//            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'invalid-feedback',
            successClass: 'valid-feedback',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) { $(element).removeClass(errorClass); },
            unhighlight: function(element, errorClass) { $(element).removeClass(errorClass); }, 
            // Different components require proper error label placement
            errorPlacement: function(error, element)
            { 

                if (element.attr("name") == "new_created_date" ){  $("#new_created_date_err").html(error); }
                else if (element.attr("name") == "new_created_time" ){  $("#new_created_time_err").html(error); }
               else{  error.insertAfter(element);}      
            }, 
            rules: { 
//                        'new_created_date':{required:true, normalizer: function(value) { return $.trim(value);  } },
//                        'new_created_time':{required:true, normalizer: function(value) { return $.trim(value);  } },
                       
                 
                     } 
            });
            
            
            
    });

</script> 
@endsection