<div class="tab-pane active" id="basictab1"> 
                                               
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Name of the Candidate (In block letters) <span class="text-danger">*</span></label>
                <input type="text" name="name" class=" form-control" placeholder="Name of the Candidate (In block letters)">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>
                <input type="text" name="email" class=" form-control" placeholder="Email address ">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Mobile <span class="text-danger">*</span></label>
                <input type="text" name="mobile" id="mobile" class=" form-control" placeholder="">
                <div id="mobile_error"></div>
            </div>
           
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Photo <span class="text-danger">*</span></label>
                <input type="file" name="photo" class=" form-control" placeholder="photo">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label>Date of Birth <span class="text-danger">*</span></label>
                <input type="text" class="form-control" autocomplete="off" data-provide="datepicker"  data-date-autoclose="true" name="date_of_birth" id="date_of_birth">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Age <span class="text-danger">*</span></label>
                <input type="text" name="age" class=" form-control" placeholder="Age">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Gender <span class="text-danger">*</span></label> 
                <select name="gender" id="gender" class="form-control">
                    <option value=''>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select> 
                <div id="gender_error"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nationality <span class="text-danger">*</span></label>
                <input type="text" name="nationality" class=" form-control" placeholder="Nationality">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Religion <span class="text-danger">*</span></label>
                <input type="text" name="religion" class=" form-control" placeholder="Religion">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Community <span class="text-danger">*</span></label>
                <input type="text" name="community" class=" form-control" placeholder="Community">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            
            <div class="form-group">
                <label>Category <span class="text-danger">*</span></label> 
                <select class="form-control" name="category" id="category">
                    <option value="">Select</option>
                    <option value="General">General</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="OEC">OEC</option>
                    <option value="OBC">OBC</option>
                    <option value="Others">Others</option>
                </select> 
                <div id="category_error"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Blood Group <span class="text-danger">*</span></label>
                <input type="text" name="blood_group" class=" form-control" placeholder="Blood Group">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Aadhar Number <span class="text-danger">*</span></label>
                <input type="text" name="aadhar_number" class=" form-control" placeholder="Aadhar Number">
            </div>
        </div>
       <div class="col-md-6"> 
            <div class="checkbox checkbox-primary mb-2">
                <input name="p_address_for_communication"style="margin-top: 28px;" id="p_address_for_communication" type="checkbox" value="1" >
                <label for="p_address_for_communication">
                    Permanent address is same as address for communication
                </label>
            </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group textarea_info">
                <label>Permanent Address <span class="text-danger">*</span></label>
                <textarea name="permanent_address" id='permanent_address' class="form-control" style="resize: none;height:100px" placeholder="Permanent Address"></textarea>
                <div id="permanent_address_error"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group textarea_info">
                <label>Address For Communication</label>
                <textarea name="address_communication" id="address_communication" class="form-control" style="resize: none;height:100px" placeholder="Address For Communication"></textarea>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Signature of the Applicant <span class="text-danger">*</span></label>
                <input type="file" name="signature_applicant" class=" form-control" placeholder="signature">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Quota <span class="text-danger">*</span></label> 
                <select class="form-control" name="quota" id="quota">
                    <option value="">Select</option>
                    <option value="Management">Management</option> 
                    <option value="Government">Government</option>
                </select> 
                <div id="quota_error"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Place <span class="text-danger">*</span></label>
                <input type="text" name="place" class=" form-control" placeholder="place">
            </div>
        </div>
    </div>
        
      
</div>