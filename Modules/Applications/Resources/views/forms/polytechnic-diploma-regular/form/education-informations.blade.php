
 <div class="tab-pane" id="basictab3">
      
    <div class="row"> 
        <div class="col-md-6">
            <div class="form-group">
                <label>Name of the Institution last studied <span class="text-danger">*</span></label>
                <input type="text" name="last_institution" class="form-control" placeholder="Name of the Institution last studied">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Board of Study ( HSC / CBSE /VHSE /ICSE  / if others specify )<span class="text-danger">*</span></label>
                <input type="text" name="last_board_study" class="form-control" placeholder="Board of Study">
            </div>
        </div>
    </div>
    
     
      <hr style="margin: 10px 0 10px 0"/>
     <div class="row">
        <div class="col-md-12">
            <b>Details of Marks secured in the SSLC examination</b>
        </div>
    </div>
    <hr style="margin: 10px 0 10px 0"/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Register No <span class="text-danger">*</span></label>
                <input type="text" name="sslc_register_no" id="sslc_register_no" class=" form-control" placeholder="Register No ">                                                                                 
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label> Month & Year of passing <span class="text-danger">*</span></label>
                <input type="text" name="sslc_month_year_passing" class="form-control" placeholder=" Month & Year of passing">
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>SSLC Mark List <span class="text-danger">*</span></label>
                <input type="file" name="sslc_mark_list" class=" form-control" placeholder="Mark List">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Total Percentage : <span class="text-danger">*</span></label>
                <input type="text" name="sslc_total_percentage" class="form-control" placeholder="Total Percentage">
            </div>
        </div>
    </div>
    <div style="background: #fff !important;padding: 10px">
        <code style="font-size: 16px;font-weight: bold">Note: Enter the grade of any subject as per the order given in the marklist</code>
        
        <div class="row">
            <div class="col-md-12">
                <div class="sslc_add_btn" style="background: #409fff;border-radius:3px;font-size: 15px;border: none;color: #fff;text-align: center;float: right;padding: 10px">Add Subject</div>
            </div>
        </div>
        <div class="sslc_table_main">
            <div class="sslc_table_row" id="sslc_table_row_1">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label> Subject <span class="text-danger">*</span></label>
                            <input type="text" name="sslc_subject[1]" class="form-control sslc_subject" placeholder="Subject">
                        </div>
                    </div>
                    
              
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Grade <span class="text-danger">*</span></label>
                            <input type="text" name="sslc_grade[1]" class="form-control sslc_grade" placeholder="Grade">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div  class="sslc_remove_btn" data-row="1" style="display: none;background: #ff1414;border: none;color: #fff;text-align: center;padding: 10px;margin-top: 25px"><i class=" la la-close"></i></div>
                    </div>
                </div>
                <hr style="margin: 10px 0 10px 0"/> 
            </div> 
        </div>
    </div>
    
   
    <div class="row">
        
        
<!--        <div class="col-md-6">
            <div class="form-group">
                <label>PCM(physics+Chemistry+Mathematics) Percentage : <span class="text-danger">*</span></label>
                <input type="text" name="sslc_pcm_percentage" class="form-control" placeholder="PCM Percentage">
            </div>
        </div>-->
    </div>
     
     
     
     
     
     
     
     
    <div class="row">
        <div class="col-md-12">
            <b>Details of Marks secured in the plus two examination</b>
        </div>
    </div>
    <hr style="margin: 10px 0 10px 0"/>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Register No </label>
                <input type="text" name="register_no" id="register_no" class=" form-control" placeholder="Register No ">                                                                                 
            </div> 
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label> Month & Year of passing </label>
                <input type="text" name="month_year_passing" class="form-control" placeholder=" Month & Year of passing">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Plus 2 Mark List </label>
                <input type="file" name="plus_two_mark_list" class=" form-control" placeholder="Mark List">
            </div>
        </div>
    </div>
<!--    <div style="background: #fff !important;padding: 10px">
        <div class="row">
            <div class="col-md-12">
                <div class="add_btn" style="background: #409fff;border-radius:3px;font-size: 15px;border: none;color: #fff;text-align: center;float: right;padding: 10px">Add more</div>
            </div>
        </div>
        <div class="table_main">
            <div class="table_row" id="table_row_1">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label> Subject </label>
                            <input type="text" name="subject[1]" class="form-control subject" placeholder="Subject">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label> Mark Obtained </label>
                            <input type="text" name="mark_obtained[1]" class="form-control mark_obtained" placeholder="Mark Obtained">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Maximum Marks</label>
                            <input type="text" name="maximum_marks[1]" class="form-control maximum_marks" placeholder="Maximum Marks">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Grade</label>
                            <input type="text" name="grade[1]" class="form-control grade" placeholder="Grade">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div  class="remove_btn" data-row="1" style="display: none;background: #ff1414;border: none;color: #fff;text-align: center;padding: 10px;margin-top: 25px"><i class=" la la-close"></i></div>
                    </div>
                </div>
                <hr style="margin: 10px 0 10px 0"/> 
            </div> 
        </div>
    </div>-->
    <!--<hr style="margin: 10px 0 10px 0"/>-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Grand Total : </label>
                <input type="text" name="grand_total" class="form-control" placeholder="Grand Total">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Total Percentage : </label>
                <input type="text" name="total_percentage" class="form-control" placeholder="Total Percentage">
            </div>
        </div>
    </div>
<!--     <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Total PCM(physics+Chemistry+Mathematics)  : </label>
                <input type="text" name="pcm_total" class="form-control" placeholder="Total PCM ">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>PCM(physics+Chemistry+Mathematics) Percentage : </label>
                <input type="text" name="pcm_percentage" class="form-control" placeholder="PCM Percentage">
            </div>
        </div>
    </div>-->
</div>