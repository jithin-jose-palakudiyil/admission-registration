<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter Name" value="{{$board['name']? $board['name']:old('name')}}" >
                    @if($errors->has('name'))
                        <div class="validation-error-label" style="display: inline-block;">{{ $errors->first('name') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  id="slug" name="slug"  placeholder="Enter Slug" value="{{$board['slug']? $board['slug']:old('slug')}}" >
                    @if($errors->has('slug'))
                        <div class="validation-error-label" style="display: inline-block;">{{ $errors->first('slug') }}</div>
                    @endif
                </div> 
            </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Board Type: <span class="text-danger">*</span></label>
                    <select name="board_type" class="form-control" data-toggle="select2" data-placeholder="Board Type">
                     <option value="" > select </option> 
                        <option value="1"  @if(isset($board['board_type']) && $board['board_type']==1) selected @endif >10th board</option>
                        <option value="2" @if(isset($board['board_type']) && $board['board_type']==2) selected @endif>12th board</option> 
                        <option value="3" @if(isset($board['board_type']) && $board['board_type']==3) selected @endif>Polytechnic board</option> 
                    </select>
                    <div id="board_type_err">
                        @if($errors->has('board_type_err'))
                            <div class="invalid-feedback" style="display: inline-block;">{{ $errors->first('board_type') }}</div>
                        @endif
                    </div>
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
    <script src="{{asset('Modules/Admin/Resources/assets/page_js/board.js')}}"></script> 
@stop
