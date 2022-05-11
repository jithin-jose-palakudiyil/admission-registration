@extends('web::dashboard.layouts.master')
@section('content')


                    <style>
                    .emptyImage{
                        display: block; margin: auto; max-width: 49%; max-height:85%; margin-bottom: 30px;
                    }
                    
                    .emptyDescription{
                        text-align: center;font-size: 18px;color: #615f5f;font-weight: 500;margin-top: 25px;
                    }

                    .description{
                        display: block; margin: 25%
                    }


                    @media only screen and (max-width: 767px){
                        .emptyImage{
                        max-height:100%;
                        max-width:100%
                    }
                    
                    .emptyDescription{
                    font-size: 17px;
                    }

                    }


                    </style>
                        
                        <?php if(isset($Settings)):?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                    <h3 class="mt-0">Notification</h3>
                                    <hr/>
                                    <?php 
                                        $UserExam = null;
                                        $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->first();
                                        if((isset($quiz_all) && count($quiz_all) > 0) || $UserExam!=null):
                                    ?>
                                           <div>
                                           <?php 
                                                $path = 'public/uploads/settings_image/'.$Settings->notification_exist_image; 
                                                if(File::exists($path)): 
                                                    $image = $path;    
                                            ?>
                                                <img class="emptyImage" src="{{asset($image)}}" alt="">
                                                <?php endif;?>
                                                   <p class="emptyDescription">{{$Settings->notification_exist_text? $Settings->notification_exist_text: ""}}</p>
                                                   <div style="" class="form-group mb-0 text-center ">
                                                         <a href="{{route('quiz_list_web')}}"><button style="max-width: 201px; margin-bottom: 10px; display: block; margin: auto" class="btn btn-danger btn-block" type="submit"> {{$Settings->notification_exist_button_text? $Settings->notification_exist_button_text: "Go to scholarship exam"}}</button></a>
                                                    </div>
                                            </div>
                                        <?php else: ?>
                                            <div>
                                            <?php 
                                                $path = 'public/uploads/settings_image/'.$Settings->notification_not_exist_image; 
                                                if(File::exists($path)): 
                                                    $image = $path;    
                                            ?>
                                                <img class="emptyImage" src="{{asset($image)}}" alt="">
                                                <?php endif;?>
                                                <p class="emptyDescription">{{$Settings->notification_not_exist_text? $Settings->notification_not_exist_text: "No notifications at the moment"}}</p>
                        
                                            </div>
                                        <?php endif; ?>
                                    </div> <!-- end card-box-->
                                </div>
                        </div> 
                        <?php endif; ?>     
@endsection




