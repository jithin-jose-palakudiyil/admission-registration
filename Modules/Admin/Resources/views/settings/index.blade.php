@extends('admin::layouts.master')

@section('css')
<link href="{{asset('public/assets/libs/boostsrap-datetimepicker/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<style>
    .datepicker-dropdown {
        top: 298px!important
    }

    @media only screen and (max-width: 1091px){
        .datepicker-dropdown {
        top: 470px!important
    }
    }
</style>

<?php 
    $Settings = null;
    $Settings = \Modules\Admin\Entities\Settings::find(1);
    $notification_exist_image = false;
    if(isset($Settings) && $Settings->notification_exist_image):
        $notification_exist_image = true;
    endif;
    $notification_not_exist_image = false;
    if(isset($Settings) && $Settings->notification_not_exist_image):
        $notification_not_exist_image = true;
    endif;
    $quiz_not_exist_image = false;
    if(isset($Settings) && $Settings->quiz_not_exist_image):
        $quiz_not_exist_image = true;
    endif;
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form  action="{{route('update-quiz-notification')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="auth-title" style="margin-right: 5px; margin-left: 5px">Dashboard Notification </h4>
                    <div class="row">
                        <div class="col-md-3"> 
                            <div class="form-group mb-3">
                                <label for="exist_image">Image <?php if(!$notification_exist_image):?> <span class="text-danger">*</span><?php endif;?></label>
                                <input type="file" name='notification_exist_image'  id="exist_image" class="form-control-file">
                                <?php if(!$notification_exist_image):?>
                                <input type="hidden" value="1" name="notify"/>
                                <?php endif;?>
                                 @if($errors->has('notification_exist_image'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('notification_exist_image') }}</div>
                                @endif
                            </div> 
                            <?php 
                            
                            if($Settings!=null):
                            $path = 'public/uploads/settings_image/'.$Settings->notification_exist_image; 
                            if(File::exists($path)  && $notification_exist_image): 
                                $image = $path;    
                            ?>
                            <img  src="{{asset($image)}}" alt="user-image" style="background-color: #969696;width: 60px" class="rounded-circle">
                                <?php endif;endif;
                            ?>
                        </div> <!-- end col --> 
                    </div>
                    <div class="col-md-12"> 
                        <button type="submit" class="btn btn-primary waves-effect waves-light " style="float: right">Submit</button>
                    </div> <!-- end col --> 
                    </form>
  
                    </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div>
@endsection


@section('js')
<script src="{{asset('public/assets/libs/moment/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/libs/boostsrap-datetimepicker/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<!-- <script type="text/javascript">
    $(function () {
        $('.datepicker').datetimepicker({
            format: 'MM d, yyyy hh:mm:ss',
        });  
    });

</script> -->

@endsection
