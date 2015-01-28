@extends('tmpl.admin')

@section('title'){{ $title }} @stop

@section('_head')
	<script type="text/javascript" src="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/> 
	
	<script>
        $(function() {
          
            $( "._mySortable" ).sortable({ 
                axis: "y", 
                opacity: 0.5,
                placeholder: "sortable-placeholder",
                // callback function
                update: function( event, ui ) {
                    ui.item.css({'background':'#DBEEC9'})
                },
            });
            $( "._mySortable" ).disableSelection();
        });
    </script>

@stop

@section('content')
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    
    @if(isset($data->id))
    	{{ Form::open(array('action' => 'Admin_CategoriesController@postUpdateCategories', 'class' => 'form-horizontal')) }} 
    @else
    	{{ Form::open(array('action' => 'Admin_CategoriesController@postAddCategories', 'class' => 'form-horizontal')) }} 
    @endif
    
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
      @if(isset($data->id))
      	<li><a href="#ordering" data-toggle="tab">Recipes</a></li>
      @endif

    </ul>
    
    <div id="myTabContent" class="tab-content">
    
      <div class="tab-pane fade in active" id="info">
        <div class="form-group {{ ($errors->has('name')) ? ' has-error' : '' ; }}">
              {{ Form::label('name', 'Name: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
               {{($errors->has('name')) ? '<p>'. $errors->first('name'). '</p>' : '' }}
               {{ Form::text('name', (isset($input['name'])? Input::old('name') : (isset($data->name)? $data->name : '' )), array('class' => 'form-control')) }}
               
            </div>
        </div>
        <div class="form-group {{ ($errors->has('summary')) ? ' has-error' : '' ; }}">
            {{ Form::label('summary', 'Summary: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
               {{($errors->has('summary')) ? '<p>'. $errors->first('summary'). '</p>' : '' }}
               {{ Form::textarea('summary', (isset($input['summary'])? Input::old('summary') : (isset($data->summary)? $data->summary : '' )), array('class' => 'form-control', 'rows' => '2')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('active', 'Active: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
               {{ Form::checkbox('active', 1, (isset($input['active']) ? Input::old('active') : (isset($data->active)? $data->active : '' )), array('class' => '')) }}
            </div>
        </div>
     </div>    
      @if(isset($data->id))
         <div class="tab-pane fade in" id="ordering">
          	<ul id="_ListRecipes" class="_mySortable">
                
            	<?php $x = 0; ?>
                @if(isset($recipes))
                	@foreach($recipes as $recipe)
                    	<li>
                            <input type="text" name="recipe[][{{ $recipe->id }}]" id="recipe_{{ $x }}" class="form-control" value="{{ $recipe->name }}">&nbsp;
                            <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                        </li>
                 	<?php $x++; ?>                    
                   	@endforeach
                @endif
         	</ul>
         </div>  
     @endif
   </div> 
     <hr>   	
           {{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            <a href="/admin/menu/categories/">
                {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
            </a>
            </div>
        </div>       	
  </div>

@stop

@section('_tail')
@stop