<?php if($UserExam!=null):?>
        <?php if($UserExam->quiz_status == 0 || $UserExam->quiz_status == 2): ?>
            <?php if($UserExam->react_route_name == 'intro'):?>
                <div class="col-lg-12" style="margin-top: 5px;">
                <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$quiz_active->name}} <small class="time_completed_badge badge badge-light-danger font-13">In progress</small></h3>
                <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                <?php 
                if($quiz_active->image!=null):
                    $path = 'public/uploads/quiz_image/'.$quiz_active->image; 
                    if(File::exists($path)): 
                        $image = $path;    
                ?>
                    <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                    <?php endif; endif;?>
                <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$quiz_active->description}}</span></p>
                <div class="row button-glow-container">
                <div className="button-glow">
                    <a href="{{route('quiz_get_web', ['encrypted_quiz_id' => \Crypt::encryptString($quiz_active->id)])}}" style="" class="btn btn-block goToQuizButton buttonEnabled glow" type="submit"> Attend exam now <i style="margin-left: 5px" class="las la-arrow-right"></i></a>
                </div>
                <div style="width: 100%; margin-right: 27px" class="time_complete_button"></div>
                </div>
                </div> <!-- end card-box-->
                </div>

                <?php else: ?>
                <div class="col-lg-12" style="margin-top: 5px;">
                <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$quiz_active->name}} <small class="time_completed_badge badge badge-light-danger font-13">In progress</small></h3>
                <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                <?php 
                if($quiz_active->image!=null):
                    $path = 'public/uploads/quiz_image/'.$quiz_active->image; 
                    if(File::exists($path)): 
                        $image = $path;    
                ?>
                    <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                    <?php endif; endif;?>
                <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$quiz_active->description}}</span></p>
                <div class="row button-glow-container">
                <div className="button-glow">
                    <a href="{{route('quiz_get_web_exam', ['encrypted_quiz_id' => \Crypt::encryptString($quiz_active->id)])}}" style="" class="btn btn-block goToQuizButton buttonEnabled glow" type="submit"> Attend exam now <i style="margin-left: 5px" class="las la-arrow-right"></i></a>
                </div>
                    <div style="width: 100%; margin-right: 27px" class="time_complete_button"></div>
                </div>
                </div> <!-- end card-box-->
                </div>
                <?php endif; ?>
        <?php else:?>
            <?php if($UserExam->react_route_name == 'exam'):?>
                <div class="col-lg-12" style="margin-top: 5px;">
                <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$quiz_active->name}}</h3>
                <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                <?php 
                if($quiz_active->image!=null):
                    $path = 'public/uploads/quiz_image/'.$quiz_active->exam_completed_image; 
                    if(File::exists($path)): 
                        $image = $path;    
                ?>
                    <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                    <?php endif; endif;?>
                <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$quiz_active->exam_completed_description}}</span></p>
                <div class="row ">
                <button id="complete_button" href="#" style="background: #51be78; border: none" disabled class="btn btn-danger btn-block goToQuizButton" type="button"> Completed </button>
                </div>
                </div> <!-- end card-box-->
                </div>
                <?php endif; ?>
        <?php endif;?>

    <?php else:?>
        <?php if($quiz_active->status == 1):?>
            <div class="col-lg-12" style="margin-top: 5px;">
                <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$quiz_active->name}} <small class="time_completed_badge badge badge-light-success font-13">New</small></h3>
                <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                <?php 
                if($quiz_active->image!=null):
                    $path = 'public/uploads/quiz_image/'.$quiz_active->image; 
                    if(File::exists($path)): 
                        $image = $path;    
                ?>
                    <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                    <?php endif; endif;?>
                <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$quiz_active->description}}</span></p>
                <div class="row button-glow-container">
                <div className="button-glow">
                    <a href="{{route('quiz_get_web', ['encrypted_quiz_id' => \Crypt::encryptString($quiz_active->id)])}}" style="" class="btn btn-block goToQuizButton buttonEnabled glow" type="submit"> Attend exam now <i style="margin-left: 5px" class="las la-arrow-right"></i></a>
                </div>
                <div style="width: 100%; margin-right: 27px" class="time_complete_button"></div>
                </div>
                </div> <!-- end card-box-->
                </div>
            <?php else:?>
                <?php 
                $UserExa = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->get();
                if(isset($Settings) && isset($UserExa) && count($UserExa)<1):?>
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
