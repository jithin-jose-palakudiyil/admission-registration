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
                <form action="{{route('assign_forms_store',$college->id)}}" method="post" autocomplete="off" id="assign_forms">
                    {{ csrf_field() }}
                    <h4 class="m-t-0 header-title mb-4">{{(isset($college->name)) ? $college->name : '' }}</h4>
                    <div class="row"> 
                        @if($errors->has('assign'))
                            <div class="invalid-feedback" style="display: block;padding: 10px">{{ $errors->first('assign') }}</div>
                        @endif
                        <div class="col-md-12 ">
                            <table width="100%" class="table_assign">
                                <?php if(isset($forms) && $forms->isNotEmpty()):
                                        foreach ($forms as $key => $value):
                                        $PivotFormsCollege = \Modules\Admin\Entities\PivotFormsCollege::where('college_id',$college->id)->
                                        where('form_id',$value->id)->first();
                                            ?>
                                                <tr style="border-bottom: 1px solid #ddd;">
                                                    <td width="80%">
                                                        <div class="checkbox checkbox-primary mb-2">
                                                            <input @if($PivotFormsCollege) checked="" @endif id="checkbox_{{$value->id}}" name="assign[]" type="checkbox" value="{{$value->id}}">
                                                            <label for="checkbox_{{$value->id}}">
                                                                {{$value->name}}
                                                            </label>
                                                        </div>                     
                                                    </td>
                                                    <td width="80%" style="padding-top: 15px;padding-bottom: 15px">
                                                    <?php
                                                    if($PivotFormsCollege):
                                                        $application_index=route('application_index',[ $college->slug,\Crypt::encryptString( $PivotFormsCollege->forms_college_id) ]);
//                                                         $application_index = url('/').'/'.application_prefix.'/'.$college->slug.'/'.\Crypt::encryptString( $PivotFormsCollege->forms_college_id);
                                                        ?>
                                                        <button data-url="{{$application_index}}" type="button" class="btn btn-purple waves-effec application_indext waves-light clipboard"><i class="mdi mdi-content-copy"></i></button>
                                                    <?php else: ?> &nbsp; <?php endif; ?>
                                                   </td>
                                                </tr>
                                            <?php
                                        endforeach;
                                endif;
                                ?>        


                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 15px;">  
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
                        </div>
                    </div>
                </form>
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
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/forms.js')}}"></script>    
@stop
