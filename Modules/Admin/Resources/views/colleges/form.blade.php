<div class="card-box"> 
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" value="{{$college['name']? $college['name']:old('name')}}" >
                    @if($errors->has('name'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('name') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug"  placeholder="Enter Slug" value="{{$college['slug']? $college['slug']:old('slug')}}" >
                    @if($errors->has('slug'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('slug') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" data-toggle="select2" data-placeholder="status">
                     <option value="" > select </option> 
                        <option value="1"  @if(isset($college['status']) && $college['status']==1) selected @endif >Approved</option>
                        <option value="0" @if(isset($college['status']) && $college['status']==0) selected @endif>Unapproved</option> 
                    </select>
                    <div id="status_err">
                        @if($errors->has('status'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="username">Username  <span class="text-danger">*</span></label>
                    <input type="username" class="form-control" id="username" name="username"  placeholder="Enter username" value="{{$college['username']? $college['username']:old('username')}}" >
                    @if($errors->has('username'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('username') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="password">Password @if(!isset($edit))<span class="text-danger">*</span>@endif</label>
                    <input type="password" class="form-control" id="password" name="password"  placeholder="Enter password" value="" >
                    @if($errors->has('password'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('password') }}</div>
                    @endif
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="application_heading">Application Heading </label>
                    <textarea  class="form-control" style="resize: none;height: 200px" id="application_heading" name="application_heading"  placeholder="Enter application heading for online application form" >{{$college['application_heading']? $college['application_heading']:old('application_heading')}}</textarea>
                    @if($errors->has('application_heading'))
                        <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('application_heading') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="col-md-12 ">
                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
            </div>
        </div>
    </div>
</div> 
@section('js')
    <script src="{{asset('public/assets/libs/validation/validate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/college.js')}}"></script> 
@stop
