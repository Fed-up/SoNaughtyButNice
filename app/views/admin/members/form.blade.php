@extends('tmpl.admin')

@section('title') {{$title}} @stop

@section('_head')
    
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css"/>
    
@stop

@section('content')

  
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    	@if(isset($data->id))
  			{{ Form::open(array('action' => 'Admin_UserController@postUpdateMembers', 'class' => 'form-horizontal')) }}
        @else
        	{{ Form::open(array('action' => 'Admin_UserController@postAddMembers', 'class' => 'form-horizontal')) }} 
        @endif
        
         <ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
          <li><a href="#address" data-toggle="tab">Address</a></li>
          <li><a href="#password" data-toggle="tab">Password</a></li>
        </ul>
        
        <div id="myTabContent" class="tab-content">
        
          <div class="tab-pane fade in active" id="info">
            <div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' ; }}">
            {{ Form::label('fname', 'First Name: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ ($errors->has('fname'))? '<p>'. $errors->first('fname') .'</p>' : '' }}
                    {{ Form::text('fname', (isset($input['fname'])? Input::old('fname') : (isset($data->fname)? $data->fname : '' )), array('class' => 'form-control')) }} 
                </div>
            </div>
            <div class="form-group {{ ($errors->has('lname')) ? 'has-error' : '' ; }}">
            {{ Form::label('lname', 'Last Name: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ ($errors->has('lname'))? '<p>'. $errors->first('lname') .'</p>' : '' }}
                    {{ Form::text('lname', (isset($input['lname'])? Input::old('lname') : (isset($data->lname)? $data->lname : '' )), array('class' => 'form-control')) }} 
                </div>
            </div>
            <div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' ; }}">
            {{ Form::label('username', 'Username: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ ($errors->has('username'))? '<p>'. $errors->first('username') .'</p>' : '' }}
                    {{ Form::text('username', (isset($input['username'])? Input::old('username') : (isset($data->username)? $data->username : '' )), array('class' => 'form-control')) }} 
                </div>
            </div>
            <div class="form-group }}">
            {{ Form::label('user_type', 'User Type: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-3">
                    {{ Form::select('user_type', 
                        array('GUEST' => 'Guest',
                            'REGISTERED' => 'Registered',
                            'B2B' => 'B2B',
                            'MANAGER' => 'Manager', 
                            'ADMIN' => 'Admin'), (isset($input['user_type'])? Input::old('user_type') : (isset($data->user_type)? $data->user_type : null )), array('class'=>'form-control')) }} 
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('active', 'Active: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                  {{ Form::checkbox('active', 1, (isset($input['active'])? Input::old('active') : (isset($data->active)? $data->active : '' )), array('class' => '')) }}
                </div>
            </div>
                {{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
           </div>
           <div class="tab-pane fade in " id="address">
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' ; }}">
            {{ Form::label('email', 'Email: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-10">
                    {{ ($errors->has('email'))? '<p>'. $errors->first('email') .'</p>' : '' }}
                    {{ Form::text('email', (isset($input['email'])? Input::old('email') : (isset($data->email)? $data->email : '' )), array('class' => 'form-control')) }} 
                </div>
            </div>
           </div>
           <div class="tab-pane fade in " id="password">
            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' ; }}">
            {{ Form::label('password', 'Password: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5">
                    {{ ($errors->has('password'))? '<p>'. $errors->first('password') .'</p>' : '' }}
                    {{ Form::password('password', array('class'=>'form-control' ) ) }}
                </div>
            </div>
            
            <div class="form-group {{ ($errors->has('password_match')) ? 'has-error' : '' ; }}">
            {{ Form::label('password_match', 'Password Match: ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5">
                    {{ ($errors->has('password_match'))? '<p>'. $errors->first('password_match') .'</p>' : '' }}
                    {{ Form::password('password_match', array('class'=>'form-control' ) ) }}
                </div>
            </div>
           </div>
          </div>
          <hr/> 
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
                <a href="/admin/user/members/">
                    {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
                </a>
                </div>
            </div>
    {{ Form::close() }}
    	        	
  </div>

@stop


@section('_tail')

    <script>
	
		$('#tom').bind('click', function(event){
			event.preventDefault();
			alert('YOLO');
		});
	
	</script>
    
@stop