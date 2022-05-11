@extends('web::dashboard.layouts.master')
@section('content')

                         
                        
 <div class="card ">
      <div class="card-body ">
<form action="{{route('document_update')}}" method="post" id="documents_form" enctype="multipart/form-data"> 
                                    @csrf
                                    <?php if ((isset($web_user->tenth_mark_list) && $web_user->tenth_mark_list !=null) || (isset($web_user->plus_one_mark_list) && $web_user->plus_one_mark_list !=null) ):?>
                                    <input type="hidden" name="HdnEdit" value="1"/>
                                    <?php endif; ?>
                                            
                                    
                                                                
<div class="row">
    <div class="col-lg-3">
        <div class="form-group mb-3">
            <label for="tenth_mark">10th Marksheet  {!!(isset($web_user->tenth_mark_list) && $web_user->tenth_mark_list !=null) ?   '<code id="tenth_mark_list_rem">uploded</code>' : ''!!}
                <?php if(isset($web_user->tenth_mark_list) && $web_user->tenth_mark_list !=null):?> <a href="{{asset('public/'.$web_user->tenth_mark_list)}}" target="_blank"><i class="las la-clipboard-list"></i></a> <?php endif; ?>
            </label>
            <input  class="form-control" type="file" id="tenth_mark_list" name="tenth_mark_list" ></input>
            @error('tenth_mark_list')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-lg-12">
    <b>Choose whichever is applicable from (a,b,c). Leave the options blank if NOT Applicable.</b>
    <br/><br/>
    </div> 
</div>
<div class="row">   
    <div class="col-lg-3">
        <div class="form-group mb-3">
            <label for="plus_two_board"> <b>a)</b> Plus Two Board:</label>
            <select class="form-control" id="plus_two_board" name="plus_two_board">
                <option value="">select</option>
                <?php

                    $Boardsp = \Modules\Web\Entities\Board::where('board_type',2)->get(); 
                    foreach ($Boardsp as $BoardspKey => $BoardspValue):
                    ?>
                        <option  @if(isset($web_user->plus_two_board) && $web_user->plus_two_board == $BoardspValue->id) selected @endif  value="{{$BoardspValue->id}}">{{$BoardspValue->name}}</option>
                    <?php endforeach;?>
            </select>
            @error('plus_two_board')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group mb-3">
           
            <label for="plus_two_stream"> <b>b)</b> Plus Two Stream:</label>
            <select class="form-control" id="plus_two_stream" name="plus_two_stream">
                <option value="">select</option>
                <option  @if(isset($web_user->plus_two_stream) && $web_user->plus_two_stream == 'science_with_mathematics') selected @endif  value="science_with_mathematics">Science with Mathematics</option>
                <option  @if(isset($web_user->plus_two_stream) && $web_user->plus_two_stream == 'science_without_mathematics') selected @endif  value="science_without_mathematics">Science without Mathematics</option>
                <option  @if(isset($web_user->plus_two_stream) && $web_user->plus_two_stream == 'commerce') selected @endif  value="commerce">Commerce</option>
                <option  @if(isset($web_user->plus_two_stream) && $web_user->plus_two_stream == 'humanities') selected @endif  value="humanities">Humanities</option>
                <option  @if(isset($web_user->plus_two_stream) && $web_user->plus_two_stream == 'VHSE_with_Additional_Mathematics') selected @endif  value="VHSE_with_Additional_Mathematics">VHSE with Additional Mathematics</option>
                <option  @if(isset($web_user->plus_two_stream) && $web_user->plus_two_stream == 'others') selected @endif  value="others">Others</option>     
            </select>
            @error('plus_two_stream')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-3">
       <div class="form-group mb-3">
           <label for="technical_courses"> <b>c)</b>Technical Courses:</label>
           <select class="form-control" id="technical_courses" name="technical_courses">
               <option value="">select</option>
               <option  @if(isset($web_user->technical_courses) && $web_user->technical_courses == 'ITI') selected @endif  value="ITI">ITI</option>
               <option  @if(isset($web_user->technical_courses) && $web_user->technical_courses == 'Diploma') selected @endif  value="Diploma">Diploma</option>
           </select>
           @error('technical_courses')
               <span class="invalid-feedback" style="display: block;" role="alert">
                   <strong>{{ $message }}</strong>
               </span>
           @enderror
       </div>
   </div>
</div>                                   
<hr/>
<div class="row">
    <div class="col-lg-3" style='display:none'>
        <div class="form-group mb-3">
            <label for="plus_one_mark_list">+1 Marksheet  {!!(isset($web_user->plus_one_mark_list) && $web_user->plus_one_mark_list !=null) ? '<code id="plus_one_mark_list_rem">uploded</code>' : ''!!}
                <?php if(isset($web_user->plus_one_mark_list) && $web_user->plus_one_mark_list !=null):?> <a href="{{asset('public/'.$web_user->plus_one_mark_list)}}" target="_blank"><i class="las la-clipboard-list"></i></a> <?php endif; ?>
            </label>
            <input  class="form-control" type="file" id="plus_one_mark_list" name="plus_one_mark_list" ></input>
            @error('plus_one_mark_list')
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="plus_two_mark_list">Upload Plus two mark list - HSE (State) /VHSE /CBSE/ICSE/Others (Certificates to be uploaded as soon as the results are published.)  {!!(isset($web_user->plus_two_mark_list) && $web_user->plus_two_mark_list !=null) ? '<code id="plus_one_mark_list_rem">uploded</code>' : ''!!}
                <?php if(isset($web_user->plus_two_mark_list) && $web_user->plus_two_mark_list !=null):?> <a href="{{asset('public/'.$web_user->plus_two_mark_list)}}" target="_blank"><i class="las la-clipboard-list"></i></a> <?php endif; ?>
            </label>
            <input  class="form-control" type="file" id="plus_two_mark_list" name="plus_two_mark_list" ></input>
            @error('plus_two_mark_list')
            <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group mb-3">
            <label for="iti_diploma_mark_list">ITI or Diploma Certificate: (Certificates to be uploaded as soon as the results are published.)  {!!(isset($web_user->iti_diploma_mark_list) && $web_user->iti_diploma_mark_list !=null) ?   '<code id="iti_diploma_mark_list_rem">uploded</code>' : ''!!}
                <?php if(isset($web_user->iti_diploma_mark_list) && $web_user->iti_diploma_mark_list !=null):?> <a href="{{asset('public/'.$web_user->iti_diploma_mark_list)}}" target="_blank"><i class="las la-clipboard-list"></i></a> <?php endif; ?>
            </label>
            <input  class="form-control" type="file" id="iti_diploma_mark_list" name="iti_diploma_mark_list" ></input>
            @error('iti_diploma_mark_list')
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>  
</div>
<div class="col-lg-12"><b>Note: For those applying for B. Tech Lateral entry, upload Diploma Certificate<b><div>
<hr/>                                                         
<div class="col-lg-12">  
    <div class="form-group mb-0 text-center ">
        <button style="max-width: 100px; margin-bottom: 10px" class="btn btn-danger btn-block pull-right" type="submit"> Submit </button>
    </div> 
</div> 









                                    
                                    <!--                                     <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="plus_one_maximum_mark">+1 Maximum Marks <span class="text-danger">*</span> </label>
                                            <input value="{{isset($web_user->plus_one_maximum_mark) ? $web_user->plus_one_maximum_mark : old('plus_one_maximum_mark')}}" class="form-control" type="text" id="plus_one_maximum_mark" name="plus_one_maximum_mark" row="5" placeholder="plus one maximum mark "></input>
                                                @error('plus_one_maximum_mark')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="plus_one_mark">+1 Secured Marks  <span class="text-danger">*</span> </label>
                                            <input value="{{isset($web_user->plus_one_mark) ? $web_user->plus_one_mark : old('plus_one_mark')}}" class="form-control" type="text" id="plus_one_mark" name="plus_one_mark" row="5" placeholder="plus one secured mark "></input>
                                                @error('plus_one_mark')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                     <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="plus_one_board">+1 Board of examination<span class="text-danger">*</span> </label>
                                            <select class="form-control" id="plus_one_board" name="plus_one_board">
                                                <option value="">select</option>
                                                <?php
                                                   
                                                    $Boardsp = \Modules\Web\Entities\Board::where('board_type',2)->get();
                                                    
                                                    foreach ($Boardsp as $BoardspKey => $BoardspValue):
                                                    ?>
                                                        <option  @if(isset($web_user) && $web_user->plus_one_board == $BoardspValue->id) selected @endif  value="{{$BoardspValue->id}}">{{$BoardspValue->name}}</option>
                                                    <?php endforeach;?>
                                            </select>
                                                @error('plus_one_board')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>-->
                                <!--                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="tenth_maximum_mark">10th Maximum Marks<span class="text-danger">*</span>  </label>
                                            <input value="{{isset($web_user->tenth_maximum_mark) ? $web_user->tenth_maximum_mark : old('tenth_maximum_mark')}}" class="form-control" type="text" id="tenth_maximum_mark" name="tenth_maximum_mark" row="5" placeholder="Tenth maximum mark"></input>
                                                @error('tenth_maximum_mark')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="tenth_mark">10th Secured Marks  <span class="text-danger">*</span>  </label>
                                            <input value="{{isset($web_user->tenth_mark) ? $web_user->tenth_mark : old('tenth_mark')}}" class="form-control" type="text" id="tenth_mark" name="tenth_mark" row="5" placeholder="Tenth secured mark"></input>
                                                @error('tenth_mark')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="tenth_board">10th Board of examination <span class="text-danger">*</span> </label>
                                            <select class="form-control" id="tenth_board" name="tenth_board">
                                                <option value="">select</option>
                                                <?php
                                                    $Boards = \Modules\Web\Entities\Board::where('board_type',1)->get();
                                                     
                                                    foreach ($Boards as $BoardsKey => $BoardsValue):
                                                    ?>
                                                        <option  @if(isset($web_user) && $web_user->tenth_board == $BoardsValue->id) selected @endif  value="{{$BoardsValue->id}}">{{$BoardsValue->name}}</option>
                                                    <?php endforeach;?>
                                            </select>
                                                @error('board')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>-->    
                                    
<!--                                 <div class="row">
                                    
                                     <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="plus_two_maximum_mark">Plus two Maximum Marks <span class="text-danger">*</span> </label>
                                            <input value="{{isset($web_user->plus_two_maximum_mark) ? $web_user->plus_two_maximum_mark : old('plus_two_maximum_mark')}}" class="form-control" type="text" id="plus_two_maximum_mark" name="plus_two_maximum_mark" row="5" placeholder="plus two maximum mark"></input>
                                                @error('plus_two_maximum_mark')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                     
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="plus_two_mark">Plus two Marks Secured <span class="text-danger">*</span> </label>
                                            <input value="{{isset($web_user->plus_two_mark) ? $web_user->plus_two_mark : old('plus_two_mark')}}" class="form-control" type="text" id="plus_two_mark" name="plus_two_mark" row="5" placeholder="Enter your plus two mark"></input>
                                                @error('plus_two_mark')
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>    -->

                                                 
                 
</form>
     </div>
      </div>

<?php 
$Settings = \Modules\Admin\Entities\Settings::find(1);
if($Settings && $Settings->documents_image !=null):
    ?>
<div class="row">
    <div class="col-md-12" align="center">
<!--<img src="{{asset('public'.$Settings->documents_image)}}" alt="" />-->
    </div>
    </div>
  <?php
endif;

?>
@endsection


@section('js')
<style>
    .error {
    color: red;
    margin-top: 3px;
}
</style>
<script src="{{asset('Modules/Web/Resources/assets/js/dashboard.js')}}"></script> 
<script src="{{asset('public/assets/libs/validation/validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/libs/validation/jquery.validate.file.js')}}" type="text/javascript"></script>
<script src="{{asset('Modules/Web/Resources/assets/js/documents.js')}}" type="text/javascript"></script>

@endsection




