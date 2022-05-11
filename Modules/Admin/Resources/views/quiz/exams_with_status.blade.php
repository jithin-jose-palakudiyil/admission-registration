<?php if(isset($quiz) && $quiz->isNotEmpty()): 
    $SelectExams=[];
    if(isset($edit) && $edit !=null):
        if($edit->exams !=null):
             $SelectExams =json_decode($edit->exams);
        endif;
       
       
    endif;
    
    ?>

<div class="col-12">
    <br/> 
    <div class="row" >
        <div class="col-12">
            <h4 class="header-title">Select Exams <span class="text-danger">*</span></h4>
            <div id="exam_error"></div>
        </div> 
        <div style="border: 1px solid #ddd;padding: 10px;max-height:500px;width: 100%;overflow: scroll "> 
        <?php foreach ($quiz as $key => $value): ?>
        <div class="col-md-12" >
            <div class="checkbox checkbox-success mb-2">
                <?php 
//                dd($SelectExams);
                $checked = null;
                if (in_array($value->id, $SelectExams)):
                    $checked = ' checked=""';
                endif;
                ?>
                <input {{$checked}} id="checkbox_{{$value->id}}" type="checkbox" value="{{$value->id}}" name="exams[]">
                    <label for="checkbox_{{$value->id}}">
                   {{$value->name}}
                </label>
            </div>
        </div> 
         <?php endforeach; ?>
             </div>
    </div>  
</div> <!-- end col-->
<div class="clearfix">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<br/>
 
<div class="col-md-12"></div>

           <div class="col-md-4">
                <div class="form-group">
                    <label>Exam Status for re-apply: <span class="text-danger">*</span></label>
                    <select name="exams_status" id="exams_status" class="form-control" data-toggle="select2" data-placeholder="Exam Status for re-apply">
                     <option value="" > select </option> 
                     <option value="1"<?php  if(isset($edit->exams_status) && $edit->exams_status ==1): echo ' selected=""'; endif; ?> > Completed </option> 
                     <option value="2" <?php  if(isset($edit->exams_status) && $edit->exams_status ==2): echo ' selected=""'; endif; ?> > In Progress </option> 
                    </select> 
                    <div id="exams_status_error"></div>
                </div>
            </div> 



 <div class="col-md-4" >
        <label>Is need new users ?</label>
            <div class="checkbox checkbox-success mb-2">
                <input id="is_need_new_users" type="checkbox" value="1" name="is_need_new_users" <?php  if(isset($edit->is_need_new_users) && $edit->is_need_new_users ==1): echo ' checked=""'; endif; ?> >
                    <label for="is_need_new_users">
                        <b>Yes</b>
                </label>
            </div>
        </div> 

<div class="col-md-4" id="FromDateofJoiningDiv" <?php  if(isset($edit->is_need_new_users) && $edit->is_need_new_users ==1): echo 'style="display: block"'; else : echo 'style="display: none"'; endif; ?> >

                <div class="form-group">
                    <label>From Date of Joining <span class="text-danger">*</span></label>
                    <div class="input-group" data-placement="top" data-align="top" data-autoclose="true">
                        <input value="<?php  if(isset($edit->date_users_reg_re_exam)): echo $edit->date_users_reg_re_exam ;endif; ?>" type="text" name="date_users_reg_re_exam" class="form-control datepicker" >

                    </div>
                </div>
            </div> 

<?php endif; ?>
