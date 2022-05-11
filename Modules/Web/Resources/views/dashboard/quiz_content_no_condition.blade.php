                                           <!-- //condition not statisfy -->
                                           <?php if(isset($previous_exam) && isset($previous_quiz)):?>
                                                            <?php if($previous_quiz->quiz_status == 1):?>
                                                                <div class="col-lg-12" style="margin-top: 5px;">
                                                                <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$previous_quiz->name}}</h3>
                                                                <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                                                                <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                                <?php 
                                                                if($previous_quiz->image!=null):
                                                                    $path = 'public/uploads/quiz_image/'.$previous_quiz->exam_completed_image; 
                                                                    if(File::exists($path)): 
                                                                        $image = $path;    
                                                                ?>
                                                                    <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                                    <?php endif; endif;?>
                                                                <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$previous_quiz->exam_completed_description}}</span></p>
                                                                <div class="row ">
                                                                <button id="complete_button" href="#" style="background: #51be78; border: none" disabled class="btn btn-danger btn-block goToQuizButton" type="button"> Completed </button>
                                                                </div>
                                                                </div> <!-- end card-box-->
                                                                </div>
                                                            <?php else:?>
                                                                <div class="col-lg-12" style="margin-top: 5px;">
                                                                <h3 style="text-align: center;margin-left: 0px;margin-top: 15px!important; color: white" class="mt-0 font-50">{{$previous_quiz->name}}</h3>
                                                                <div style="padding: 1px 27px; width: 65%; margin: auto; display: block" class="card-box">
                                                                <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                                <?php 
                                                                if($previous_quiz->image!=null):
                                                                    $path = 'public/uploads/quiz_image/'.$previous_quiz->exam_completed_image; 
                                                                    if(File::exists($path)): 
                                                                        $image = $path;    
                                                                ?>
                                                                    <img style="width: 100%;max-height: 30%; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                                    <?php endif; endif;?>
                                                                <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$previous_quiz->exam_completed_description}}</span></p>
                                                                <div class="row ">
                                                                <button id="complete_button" href="#" style="background: #ca0e0e; border: none" disabled class="btn btn-danger btn-block goToQuizButton" type="button"> Exam is over </button>
                                                                </div>
                                                                </div> <!-- end card-box-->
                                                                </div>
                                                            <?php endif;?>
                                                        <?php else:?>
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
                                                        <?php endif; ?>
