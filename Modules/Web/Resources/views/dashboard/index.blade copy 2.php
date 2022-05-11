@extends('web::dashboard.layouts.master')
@section('content')


            <style>

            .text-left{
                color: black;
                font-size: 16px;
                font-weight: 500;
            }

            .loader {
            border: 4px solid #f3f3f3;
                border-top: 4px solid #5089de;
                border-radius: 50%;
                width: 40px;
                position: absolute;
                top: 50%;
                left: 57%;
                height: 40px;
                animation: spin 2s linear infinite;
            }

            .loader-hide{
                border: 4px solid #f3f3f3; /* Light grey */
            border-top: 4px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 20px;
            display: none;
            margin: auto auto 10px auto;
            height: 20px;
            animation: spin 2s linear infinite;
            }

            @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
            }

            .timer{
            font-size: 25px;
            font-weight: 500;
            text-align: center;
            display: block;
            color: white;
            }

            .exam_starts_text{
            margin-bottom: 7px;
            font-size: 18px;
            font-weight: 600;
            display: block;
            color: white
            }

            .timer p{
            display: inline-block;
            font-weight: 600;
            letter-spacing: 3px;
            background: red;
            color: white;
            width: 80px!important;
            text-align: center;
            border-radius: 3px;
            }


            .emptyImage{
            display: block; margin: auto; max-width: 55%; max-height:85%; margin-bottom: 30px;
            }

            .emptyDescription{
            text-align: center;font-size: 18px;color: #615f5f;font-weight: 500;margin-top: 25px;color: white
            }


            .description{
            display: block; margin: 25%
            }

            .button-glow-container{
            align-items: flex-end;
            display: flex;
            justify-content: flex-end;
            }

            .button-glow{
            display: flex;
            width: 100%;
            align-items: flex-end
            }

            .goToQuizButton{
            display: flex;
            margin: 15px 13px 25px 13px!important;
            width: 282px;
            height: 59px;
            text-align: center;
            margin-bottom: 25px;
            background: #d6002a;
            font-size: 19px;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            }


            .goToQuizButton:hover{
            color: white;
            }


            .glow {
            /* font-size: 80px; */
            color: #fff;
            /* text-align: center; */
            -webkit-animation: glow 1s ease-in-out infinite alternate;
            -moz-animation: glow 1s ease-in-out infinite alternate;
            -ms-animation: glow 1s ease-in-out infinite alternate;
             -o-animation:glow 1s ease-in-out infinite alternate;
            animation: glow 1s ease-in-out infinite alternate;
            background: #d6002a;
            }


            @keyframes glow {
            from {
            background: #d6002a;

            }
            to {
                background: #000b3c;
            }
            }



            .description{
            display: block; margin: 25%
            }

            .card-box{
            margin-top: 25px!important;
            border: 1px solid rgba(127, 136, 151, 0.2);
            /* -webkit-box-shadow: 0px 0px 9px 2px rgb(0 0 0 / 10%);
            -moz-box-shadow: 0px 0px 9px 2px rgba(0,0,0,0.1);
            box-shadow: 0px 0px 9px 2px rgb(0 0 0 / 10%); */
            }


            @media only screen and (max-width: 1300px){
            .card-box{
                width: 100%!important
            }
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

            @media only screen and (max-width: 530px){
            .description{
                margin: auto
            }

            }


            </style>

            
                        <div class="timer" id="some_div"></div>
                        <div id="loader-spinner" class="loader"></div>
                        <div style="display: none" id="timer_disabled_area">
                        <?php if(isset($quiz_all) && count($quiz_all) > 0):  ?>
                            <?php foreach($quiz_all as $key => $value):
                                    $UserExam =null;
                                    $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $value->id)->first();
                                ?>


                   
                                        <?php if($UserExam!=null):?>
                                            <?php if($UserExam->quiz_status == 0 || $UserExam->quiz_status == 2): ?>
                                                <?php if($UserExam->react_route_name == 'intro'):?>
                                                    <div class="col-lg-12" style="margin-top: 5px;">
                                                    <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$value->name}} <small class="time_completed_badge badge badge-light-danger font-13">In progress</small></h3>
                                                    <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row button-glow-container">
                                                    <div className="button-glow">
                                                        <a href="{{route('quiz_get_web', ['encrypted_quiz_id' => \Crypt::encryptString($value->id)])}}" style="" class="btn btn-block goToQuizButton buttonEnabled glow" type="submit"> Attend exam now <i style="margin-left: 5px" class="las la-arrow-right"></i></a>
                                                    </div>
                                                    <div style="width: 100%; margin-right: 27px" class="time_complete_button"></div>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>

                                                    <?php else: ?>
                                                    <div class="col-lg-12" style="margin-top: 5px;">
                                                    <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$value->name}} <small class="time_completed_badge badge badge-light-danger font-13">In progress</small></h3>
                                                    <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row button-glow-container">
                                                    <div className="button-glow">
                                                        <a href="{{route('quiz_get_web_exam', ['encrypted_quiz_id' => \Crypt::encryptString($value->id)])}}" style="" class="btn btn-block goToQuizButton buttonEnabled glow" type="submit"> Attend exam now <i style="margin-left: 5px" class="las la-arrow-right"></i></a>
                                                    </div>
                                                        <div style="width: 100%; margin-right: 27px" class="time_complete_button"></div>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>
                                                    <?php endif; ?>
                                            <?php else:?>
                                                <?php if($UserExam->react_route_name == 'exam'):?>
                                                    <div class="col-lg-12" style="margin-top: 5px;">
                                                    <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$value->name}}</h3>
                                                    <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->exam_completed_image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->exam_completed_description}}</span></p>
                                                    <div class="row ">
                                                    <button id="complete_button" href="#" style="background: #51be78; border: none" disabled class="btn btn-danger btn-block goToQuizButton" type="button"> Completed </button>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>
                                                    <?php endif; ?>
                                            <?php endif;?>
                                        <?php else:?>
                                            <?php if($value->status == 1):?>
                                                <div class="col-lg-12" style="margin-top: 5px;">
                                                    <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$value->name}} <small class="time_completed_badge badge badge-light-success font-13">New</small></h3>
                                                    <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row button-glow-container">
                                                    <div className="button-glow">
                                                        <a href="{{route('quiz_get_web', ['encrypted_quiz_id' => \Crypt::encryptString($value->id)])}}" style="" class="btn btn-block goToQuizButton buttonEnabled glow" type="submit"> Attend exam now <i style="margin-left: 5px" class="las la-arrow-right"></i></a>
                                                    </div>
                                                    <div style="width: 100%; margin-right: 27px" class="time_complete_button"></div>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>
                                                <?php else:?>
                                                  <?php 
                                                    $UserExa = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->get();
                                                    if(isset($Settings) && isset($UserExa) && count($UserExa)<1 && $key==0):?>
                                                  <div style="display: block; margin: auto">
                                                  <?php 
                                                        $path = 'public/uploads/settings_image/'.$Settings->notification_exist_image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img class="emptyImage" src="{{asset($image)}}" alt="">
                                                      <?php endif;?>
                                                      <p class="emptyDescription">{{$Settings->notification_exist_text? $Settings->notification_exist_text: "No Scholarship exam at the moment !"}}</p>            
                                                  </div>
                                                  <?php endif;?>
                                                <?php endif;?>
                                        <?php endif;?>
                 

                            <?php endforeach;  ?>
                        <?php else: ?>
                          <?php if(isset($Settings)):?>
                            <div style="display: block; margin: auto">
                            <?php 
                                    $path = 'public/uploads/settings_image/'.$Settings->notification_exist_image; 
                                    if(File::exists($path)): 
                                        $image = $path;    
                                ?>
                                    <img class="emptyImage" src="{{asset($image)}}" alt="">
                                    <?php endif;?>
                                    <p class="emptyDescription">{{$Settings->notification_exist_text? $Settings->notification_exist_text: "No notifications at the moment"}}</p>
            
                                </div>
                            <?php endif; ?>
                      </div>  
                      <?php endif;?>
                    </div>


                    <?php if(isset($Settings)):?>
                            <div id="timer_active_area" style="display: none; margin: 40px auto auto auto">
                            <?php 
                                    $path = 'public/uploads/settings_image/'.$Settings->notification_exist_image; 
                                    if(File::exists($path)): 
                                        $image = $path;    
                                ?>
                                    <img class="emptyImage" src="{{asset($image)}}" alt="">
                                    <?php endif;?>
                                    <p class="emptyDescription">{{$Settings->notification_exist_text? $Settings->notification_exist_text: "No notifications at the moment"}}</p>
            
                            </div>
                    <?php endif; ?>



                    <div style="padding:56.25% 0 0 0;position:relative;">
                    <!-- <iframe src="https://player.vimeo.com/video/572750152?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="09.mov"></iframe></div> -->


@endsection


@section('js')
<script src="{{asset('Modules/Web/Resources/assets/js/dashboard.js')}}"></script>   
@endsection




