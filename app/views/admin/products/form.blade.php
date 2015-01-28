@extends('tmpl.admin')

@section('title'){{ $title }} @stop

@section('_head')
@stop

@section('content')
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    @if(isset($data->id))
    	{{ Form::open(array('action' => 'Admin_ProductsController@postUpdateProducts', 'class' => 'form-horizontal')) }} 
    @else
    	{{ Form::open(array('action' => 'Admin_ProductsController@postAddProducts', 'class' => 'form-horizontal')) }} 
    @endif
    
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
      <li><a href="#product" data-toggle="tab">Product</a></li>
      <li><a href="#image" data-toggle="tab">Images</a></li>
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
        <div class="form-group {{ ($errors->has('price')) ? ' has-error' : '' ; }}">
            {{ Form::label('price', 'Price: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
               {{($errors->has('price')) ? '<p>'. $errors->first('price'). '</p>' : '' }}
               {{ Form::text('price', (isset($input['price'])? Input::old('price') : (isset($data->price)? $data->price : '' )), array('class' => 'form-control')) }}
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
         	{{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
       </div>
       <div class="tab-pane fade in" id="product">   
        <div class="form-group }}">
        	{{ Form::label('product_type', 'Product Type: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-3">

                {{ Form::select('package_type', 
                    array('BOOK' => 'Book',
                        'EBOOK' => 'eBook'), (isset($input['product_type'])? Input::old('product_type') : (isset($data->product_type)? $data->product_type : null )), array('class'=>'form-control')) }} 
            </div>
        </div>
        <div class="form-group {{ ($errors->has('description')) ? ' has-error' : '' ; }}">
            {{ Form::label('description', 'Description: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
           	   {{($errors->has('description')) ? '<p>'. $errors->first('description'). '</p>' : '' }}
               {{ Form::textarea('description', (isset($input['description'])? Input::old('description') : (isset($data->description)? $data->description : '' )), array('class' => 'form-control')) }}
            </div>
        </div>
       </div>
       <div class="tab-pane fade in" id="image">
        <div class="form-group {{ ($errors->has('pictures')) ? 'has-error' : '' ; }}">
     	{{ Form::label('images', 'Images: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-9">
                {{ Form::text('images', '', array('class' => 'form-control', 'placeholder' => 'Add as many images as you want,  by clicking add')) }} 
            </div>
            <div class="col-sm-1">
            	{{ Form::button('+ Add', array('class' => 'btn btn-primary')) }}
            </div>
		</div>
      </div>
      </div>
      <hr/>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            <a href="/admin/products/cart">
                {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
            </a>
            </div>
        </div>       	
  </div>

@stop

@section('_tail')
@stop