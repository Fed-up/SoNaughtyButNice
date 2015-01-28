@extends('tmpl.admin')

@section('title'){{ $title }} @stop

@section('_head')
@stop

@section('content')
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    @if(isset($data->id))
    	{{ Form::open(array('action' => 'Admin_MetricController@postUpdateMetric', 'class' => 'form-horizontal')) }} 
    @else
    	{{ Form::open(array('action' => 'Admin_MetricController@postAddMetric', 'class' => 'form-horizontal')) }} 
    @endif
        <div class="form-group {{ ($errors->has('name')) ? ' has-error' : '' ; }}">
            {{ Form::label('name', 'Metric Name: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
               {{($errors->has('name')) ? '<p>'. $errors->first('name'). '</p>' : '' }}
               {{ Form::text('name', (isset($input['name'])? Input::old('name') : (isset($data->name)? $data->name : '' )), array('class' => 'form-control')) }}
        	   
            </div>
        </div>
           {{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            <a href="/admin/menu/metric">
                {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
            </a>
            </div>
        </div>       	
  </div>

@stop

@section('_tail')
@stop