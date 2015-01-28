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
  			{{ Form::open(array('action' => 'Admin_QuotesController@postUpdateQuotes', 'class' => 'form-horizontal')) }}
        @else
        	{{ Form::open(array('action' => 'Admin_QuotesController@postAddQuotes', 'class' => 'form-horizontal')) }} 
        @endif
        <div class="form-group {{ ($errors->has('quote')) ? 'has-error' : '' ; }}">
        {{ Form::label('quote', 'Promo Quote: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-8">
                {{($errors->has('quote')) ? '<p>'. $errors->first('quote'). '</p>' : '' }}
                {{ Form::text('quote', (isset($input['qoute'])? Input::old('quote') : (isset($data->quote)? $data->quote : '' )), array('class' => 'form-control')) }} 
            </div>
        </div>
         <div class="form-group">
            {{ Form::label('active', 'Active: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
               {{ Form::checkbox('active', 1, (isset($input['active']) ? Input::old('active') : (isset($data->active)? $data->active : '' )), array('class' => '')) }}
            </div>
        </div>
        {{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
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