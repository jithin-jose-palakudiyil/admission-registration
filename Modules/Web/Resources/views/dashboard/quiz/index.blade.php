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

  .goToQuizButton{
    display: inline-block; margin: 15px 25px; text-align: center; margin-bottom: 25px;
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


                        <div class="row">
                        <div class="col-lg-12">
                        <h5 style="font-weight: 700; text-align: center; text-transform: uppercase;  margin-bottom: 30px">Scholarship Exam</h5>


                        </div>
                    <?php if(isset($quiz_all) && count($quiz_all) > 0):  ?>
                            <?php foreach($quiz_all as $key => $value):
                                    $UserExam =null;
                                    $UserExam = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->where('quiz_id', $value->id)->first();
                                ?>


                   

                                        <?php if($UserExam!=null):?>
                                            <?php if($UserExam->quiz_status == 0 || $UserExam->quiz_status == 2): ?>
                                                <?php if($UserExam->react_route_name == 'intro'):?>
                                                    <div class="col-lg-4" style="margin-top: 5px;">
                                                    <div style="padding: 1px 27px" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 201px; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <h3 style="margin-left: 10px;margin-top: 15px!important" class="mt-0 font-20">{{$value->name}} <small class="badge badge-light-danger font-13">In progress</small></h3>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row ">
                                                    <a href="{{route('quiz_get_web', ['encrypted_quiz_id' => \Crypt::encryptString($value->id)])}}" style="" class="btn btn-danger btn-block goToQuizButton" type="submit"> Attend exam now <i class="las la-arrow-right"></i></a>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>

                                                    <?php else: ?>
                                                    <div class="col-lg-4" style="margin-top: 5px;">
                                                    <div style="padding: 1px 27px" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 201px; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <h3 style="margin-left: 10px;margin-top: 15px!important" class="mt-0 font-20">{{$value->name}} <small class="badge badge-light-danger font-13">In progress</small></h3>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row ">
                                                    <a href="{{route('quiz_get_web_exam', ['encrypted_quiz_id' => \Crypt::encryptString($value->id)])}}" style="" class="btn btn-danger btn-block goToQuizButton" type="submit"> Attend exam now <i class="las la-arrow-right"></i></a>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>
                                                    <?php endif; ?>
                                            <?php else:?>
                                                <?php if($UserExam->react_route_name == 'exam'):?>
                                                    <div class="col-lg-4" style="margin-top: 5px;">
                                                    <div style="padding: 1px 27px" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 201px; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <h3 style="margin-left: 10px;margin-top: 15px!important" class="mt-0 font-20">{{$value->name}}</h3>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row ">
                                                    <button id="complete_button" href="#" style="background: #51be78; border: none" disabled class="btn btn-danger btn-block goToQuizButton" type="submit"> Completed </button>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>
                                                    <?php endif; ?>
                                            <?php endif;?>
                                        <?php else:?>
                                            <?php if($value->status == 1):?>
                                                <div class="col-lg-4" style="margin-top: 5px;">
                                                    <div style="padding: 1px 27px" class="card-box">
                                                    <!-- <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i> -->
                                                    <?php 
                                                    if($value->image!=null):
                                                        $path = 'public/uploads/quiz_image/'.$value->image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img style="width: 100%;max-height: 201px; margin-top: 25px" src="{{asset($image)}}" alt="">
                                                      <?php endif; endif;?>
                                                    <h3 style="margin-left: 10px;margin-top: 15px!important" class="mt-0 font-20">{{$value->name}} <small class="badge badge-light-success font-13">New</small></h3>
                                                    <p style="margin-bottom: 10px; margin-top: 18px;" class="text-bold font-14 text-left"><span>{{$value->description}}</span></p>
                                                    <div class="row ">
                                                    <a href="{{route('quiz_get_web', ['encrypted_quiz_id' => \Crypt::encryptString($value->id)])}}" style="" class="btn btn-danger btn-block goToQuizButton" type="submit"> Attend exam now <i class="las la-arrow-right"></i></a>
                                                    </div>
                                                    </div> <!-- end card-box-->
                                                    </div>
                                                <?php else:?>
                                                  <?php 
                                                    $UserExa = \Modules\Web\Entities\UserExam::where('user_id', \Auth::guard(web_guard)->user()->id)->get();
                                                    if(isset($Settings) && isset($UserExa) && count($UserExa)<1 && $key==0):?>
                                                  <div style="display: block; margin: auto">
                                                  <?php 
                                                        $path = 'public/uploads/settings_image/'.$Settings->quiz_not_exist_image; 
                                                        if(File::exists($path)): 
                                                            $image = $path;    
                                                    ?>
                                                      <img class="emptyImage" src="{{asset($image)}}" alt="">
                                                      <?php endif;?>
                                                      <p class="emptyDescription">{{$Settings->quiz_not_exist_text? $Settings->quiz_not_exist_text: "No Scholarship exam at the moment !"}}</p>            
                                                  </div>
                                                  <?php endif;?>
                                                <?php endif;?>
                                        <?php endif;?>
                 

                            <?php endforeach;  ?>
                        <?php else: ?>
                          <?php if(isset($Settings)):?>
                            <div style="display: block; margin: auto">
                            <?php 
                                $path = 'public/uploads/settings_image/'.$Settings->quiz_not_exist_image; 
                                if(File::exists($path)): 
                                    $image = $path;    
                            ?>

                                <img class="emptyImage" src="{{asset($image)}}" alt="">
                                <?php endif;?>
                                <p class="emptyDescription">{{$Settings->quiz_not_exist_text? $Settings->quiz_not_exist_text: "No Scholarship exam at the moment !"}}</p>
                             </div>
                            <?php endif;?>
                      </div>  
                      <?php endif;?>

                @endsection


