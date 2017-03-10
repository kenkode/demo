@extends('layouts.css')
@section('content')
<br/>
<div class="row">     
	<div class="col-lg-6"> 
      @if(Session::has('none'))
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>{{{ Session::get('none') }}}</strong> 
        </div>      
       @endif   
  <h3>New Investment Project</h3>
<hr>
</div>	
</div>
<div class="row">
	<div class="col-lg-5">
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
      <form method="POST" action="{{{ URL::to('projects') }}}" accept-charset="UTF-8">
              <fieldset>
                  <div class="form-group">
                    <label for="username" id="amt">Project Name <span style="color:red">*</span></label>
                      <input class="form-control" placeholder="" type="text" name="name"
                       value="{{{ Input::old('name') }}}">
                  </div> 
                   <div class="form-group">
                      <label for="username">Investment Type<span style="color:red">*</span></label>
                      <select class="form-control" name="investment" >
                          <option value="">Select Investment Type</option>
                          <option value="">--------------------------</option>
                          @foreach($investment as $loanproduct)
                           <option value="{{$loanproduct->id}}">{{ $loanproduct->name }}</option>
                          @endforeach
                      </select>
                  </div>                  
                  <div class="form-group">
                      <label for="username" id="amt">Units (Total Number) <span style="color:red">*</span></label>
                      <input class="form-control" placeholder="" type="text" name="units" 
                       value="{{{ Input::old('units') }}}">
                  </div>                  
                  <div class="form-group">
                      <label for="username" id="amt">Price per Unit 
                        <span style="color:red">*</span>
                      </label>
                      <input class="form-control" placeholder="" type="text" name="unit_price"
                       value="{{{ Input::old('unit_price') }}}">
                  </div>
                  <div class="form-group">
                      <label for="username" id="amt">
                            Project Description
                            <span style="color:red">*</span>
                       </label>
                       <textarea name="desc" class="form-control">
                         {{{Input::old('desc')}}}
                       </textarea>
                  </div>                       
                                                                
                  <div class="form-actions form-group">
                    <button type="submit" class="btn btn-primary btn-sm">
                      Create Investment Project
                    </button> 
                  </div>
              </fieldset>
      </form>
  </div>
</div>
@stop