@extends('admin::layouts.master')

@section('content')

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
                    <h4 class="auth-title" style="margin-right: 5px; margin-left: 5px">If quiz is available ( Dashboard page ) </h4>
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="exist_image">Image <?php if(!$notification_exist_image):?> <span class="text-danger">*</span><?php endif;?></label>
                                <input type="file" name='notification_exist_image'  id="exist_image" class="form-control-file">
                                <?php if(!$notification_exist_image):?>
                                    <input type="hidden" name="notify"/>
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

                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="exist_note">Note </label>
                                <input value="{{$Settings!=null && $Settings['notification_exist_text']? $Settings['notification_exist_text']:old('notification_exist_text')}}" type="text" name="notification_exist_text" placeholder="Enter your note" id="exist_note" class="form-control">
                                 @if($errors->has('notification_exist_text'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('notification_exist_text') }}</div>
                                @endif
                            </div> 
                        </div> <!-- end col -->

                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="exist_button_note">Button text </label>
                                <input value="{{$Settings!=null && $Settings['notification_exist_button_text']? $Settings['notification_exist_button_text']:old('notification_exist_button_text')}}" type="text" name="notification_exist_button_text" placeholder="Enter button text" id="exist_button_note" class="form-control">
                                @if($errors->has('notification_exist_button_text'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('notification_exist_button_text') }}</div>
                                @endif
                            </div> 
                        </div> <!-- end col -->
                    </div>
                    <div class="col-md-12"> 
                        <button type="submit" class="btn btn-primary waves-effect waves-light " style="float: right">Submit</button>
                    </div> <!-- end col --> 
                    </form>
  
                    </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form  action="{{route('update-notification')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="auth-title" style="margin-right: 5px; margin-left: 5px; margin-top: 40px"> Notification ( Dashboard page )</h4>

                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="not_exist_image">Image <?php if(!$notification_not_exist_image):?> <span class="text-danger">*</span><?php endif;?></label>
                                <input type="file" name="notification_not_exist_image" id="not_exist_image" class="form-control-file">
                                <?php if(!$notification_not_exist_image):?>
                                    <input type="hidden" name="notify_not"/>
                                <?php endif;?>
                                @if($errors->has('notification_not_exist_image'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('notification_not_exist_image') }}</div>
                                @endif
                            </div> 
                            <?php 
                            if($Settings!=null):
                            $paths = 'public/uploads/settings_image/'.$Settings->notification_not_exist_image; 
                            if(File::exists($paths) && $notification_not_exist_image): 
                                $images = $paths;    
                            ?>
                                    <img  src="{{asset($images)}}"  style="background-color: #969696;width: 60px" class="rounded-circle">
                                <?php endif;endif;
                            ?>
                        </div> <!-- end col -->

                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="not_exist_note">Note</label>
                                <input value="{{$Settings!=null && $Settings['notification_not_exist_text']? $Settings['notification_not_exist_text']:old('notification_not_exist_text')}}" type="text" name="notification_not_exist_text"  placeholder="Enter your note" id="not_exist_note" class="form-control">
                                @if($errors->has('notification_not_exist_text'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('notification_not_exist_text') }}</div>
                                @endif
                            </div> 
                        </div> <!-- end col -->

                    </div>


                        
                    <div class="col-md-12"> 
                        <button type="submit" class="btn btn-primary waves-effect waves-light " style="float: right">Submit</button>
                    </div> <!-- end col -->   
                </form>
                <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->



    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form  action="{{route('update-quiz-settings')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="auth-title" style="margin-right: 5px; margin-left: 5px; margin-top: 40px"> IF quiz is not available ( Quiz Page ) </h4>

                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="quiz_not_exist_image">Image <?php if(!$quiz_not_exist_image):?> <span class="text-danger">*</span><?php endif;?></label>
                                <input type="file" name="quiz_not_exist_image" id="quiz_not_exist_image" class="form-control-file">
                                <?php if(!$quiz_not_exist_image):?>
                                    <input type="hidden" name="notify_not"/>
                                <?php endif;?>
                                @if($errors->has('quiz_not_exist_image'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('quiz_not_exist_image') }}</div>
                                @endif
                            </div> 
                            <?php 
                            if($Settings!=null):
                            $paths = 'public/uploads/settings_image/'.$Settings->quiz_not_exist_image; 
                            if(File::exists($paths) && $quiz_not_exist_image): 
                                $images = $paths;    
                            ?>
                                    <img  src="{{asset($images)}}"  style="background-color: #969696;width: 60px" class="rounded-circle">
                                <?php endif;endif;
                            ?>
                        </div> <!-- end col -->

                        <div class="col-md-4"> 
                            <div class="form-group mb-3">
                                <label for="quiz_not_exist_note">Note</label>
                                <input value="{{$Settings!=null && $Settings['quiz_not_exist_text']? $Settings['quiz_not_exist_text']:old('quiz_not_exist_text')}}" type="text" name="quiz_not_exist_text"  placeholder="Enter your note" id="quiz_not_exist_note" class="form-control">
                                @if($errors->has('quiz_not_exist_text'))
                                    <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('quiz_not_exist_text') }}</div>
                                @endif
                            </div> 
                        </div> <!-- end col -->

                    </div>


                        
                    <div class="col-md-12"> 
                        <button type="submit" class="btn btn-primary waves-effect waves-light " style="float: right">Submit</button>
                    </div> <!-- end col -->   
                </form>
                <!-- end row-->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div><!-- end col -->
</div>
@endsection
