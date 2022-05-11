
 <div class="tab-pane" id="basictab3">
      
    <div class="row"> 
        <div class="col-md-4">
            <div class="form-group">
                <label> Name of the Institution last studied <span class="text-danger">*</span></label>
                <input type="text" name="last_institution" class="form-control" placeholder="Name of the Institution last studied ">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Name of University <span class="text-danger">*</span></label>
                <input type="text" name="name_university" class="form-control" placeholder="Name of the University ">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label> Btech Stream <span class="text-danger">*</span></label>
                <input type="text" name="last_board_study" class="form-control" placeholder="Btech Stream">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Register No <span class="text-danger">*</span></label>
                <input type="text" name="btech_register_no" id="btech_register_no" class=" form-control" placeholder="Register No ">                                                                                 
            </div> 
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-4">
            <div class="form-group">
                <label> Month & Year of passing <span class="text-danger">*</span></label>
                <input type="text" name="btech_month_year_passing" class="form-control" placeholder=" Month & Year of passing">
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <label>Mark List <span class="text-danger">*</span></label>
                <input type="file" name="btech_mark_list" class=" form-control" placeholder="Mark List">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>CGPA : <span class="text-danger">*</span></label>
                <input type="text" name="cgpa" class="form-control" placeholder="CGPA">
            </div>
        </div>
    </div>
   
    <div class="row">
        
        <div class="col-md-4">
            <div class="form-group">
                <label> Plus 2 Percentage : <span class="text-danger">*</span></label>
                <input type="text" name="plus_two_percentage" class="form-control" placeholder="Plus 2 Percentage">
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <label>Plus 2  Mark List <span class="text-danger">*</span></label>
                <input type="file" name="plus_two_mark_list" class=" form-control" placeholder="Mark List">
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                <label>SSLC Percentage : <span class="text-danger">*</span></label>
                <input type="text" name="sslc_percentage" class="form-control" placeholder="SSLC Percentage">
            </div>
        </div>
    </div>
     <div class="row">
       <div class="col-md-4">
            <div class="form-group">
                <label>SSLC Mark List <span class="text-danger">*</span></label>
                <input type="file" name="sslc_mark_list" class=" form-control" placeholder="Mark List">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Gate Qualified</label> 
                <select name="gate_qualified" id="gate_qualified" class="form-control">
                    <option value=''>Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option> 
                </select> 
                <div id="gate_qualified_error"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Gate Rank: </label>
                <input type="text" name="gate_rank" class="form-control" placeholder="Rank">
            </div>
        </div>
    </div>
</div>