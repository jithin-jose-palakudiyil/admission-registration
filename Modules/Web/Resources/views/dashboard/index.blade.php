@extends('web::dashboard.layouts.master')
@section('content')
<div class="row">
    
    <div class="col-md-12">
    <?php
    $settings = \Modules\Web\Entities\Settings::find(1);
  
    if($settings && isset($settings->notification_exist_image) && $settings->notification_exist_image!=null):        
        $path = 'public/uploads/settings_image/'.$settings->notification_exist_image; 
        if(File::exists($path)): 
        $image = $path;    
        ?>
        <img  src="{{asset($image)}}" style="width: 100%" >
        <?php endif; ?>
    <?php  endif; ?>
    </div>
</div>
@endsection


@section('js')
  
@endsection




