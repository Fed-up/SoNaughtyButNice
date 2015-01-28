@extends('tmpl.admin')

@section('title')yeah boi!@stop

@section('_head')
    
    <script type="text/javascript" src="/packages/jquery-1.11.1.min/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css"/>
    
@stop

@section('content')

  
  <div class="row">
  	<h1 class="page-header">Analytics</h1>
  	{{ Form::open(array('url' => 'login')) }}  
  	<table class="table">
    	<tr>
            <td width="200">{{ Form::label('category_name', 'Category Name: ', array('class' => 'admin_form_label')) }}</td>
            <td>{{ Form::text('category_name', '', array('class' => 'textbox')) }}</td>
        </tr>
        <tr>
            <td >{{ Form::label('category_summary', 'Category Summary: ', array('class' => 'admin_form_label')) }}</td>
            <td>{{ Form::textarea('category_summary', null, ['size' => '30x5', 'class' => 'textarea']) }}</td>
      	</tr>
        <tr>
            <td >{{ Form::label('category_visible', 'Visible: ', array('class' => 'admin_form_label')) }}</td>
            <td>{{ Form::checkbox('category_visible') }}</td>
       	</tr>
     	<tr>
            <td >{{ Form::label('add_recipe', 'Add Recipe: ', array('class' => 'admin_form_label')) }}</td>
            <td>{{ Form::text('add_recipe', '', array('class' => 'textbox')) }}</td>
       	</tr>
   	</table>    
        
        <div>
        	{{ Form::submit('Save', array('class' => 'btn btn-success')) }}
		   	{{ Form::submit('Cancel', array('class' => 'btn btn-danger')) }}
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