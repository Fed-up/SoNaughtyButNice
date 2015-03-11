@extends('tmpl.admin')

@section('title') {{ $title }} @stop

@section('_head')
	<script type="text/javascript" src="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="/packages/plupload-2.1.2/js/plupload.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/> 
    <script>
		$(function(){
			
			$( "._mySortable" ).sortable({
				axis: "y",
				opacity: 0.3,
				placeholder: "sortable-placeholder",
				//Cal back function	
				update:function( event, ui ){
					ui.item.css({'background':'#DBEEC9'})	
				},
			});
			$( "._mySortable" ).disableSelection();
			
			//Start Images
		$('#counterImages').val( $('#_ListImages li').length );
		//Delete extra
		$('.deleteImage').click(function(e) {
			e.preventDefault();
			
			var currentID = (this.id);
			
			//var currentID = 0;	
					
			var currentID = (this.id);
					
			if($("#ddp" + currentID).length == 0) {
				$('#_ListImages')
					
						.append( $('<input>',{
							'type':'hidden',
							'name':'ddp[]',
							'id':'ddp'+currentID, /*ddi = delete data ingredient*/
							'class':'form-control',
							'value':''+currentID,
						}) )
				;
				$(this).closest('li').hide().unbind('click');
				
			} else {
			//alert('this record already exists');
				$("#ddp" + currentID).closest('input').remove().unbind('click');
			}
			
			
			
		});
	 // Initialize the widget when the DOM is ready
	 var uploader = new plupload.Uploader({
			runtimes : 'html5,flash,silverlight,html4',
			browse_button : 'pickfiles', // you can pass in id...
			container: document.getElementById('container'), // ... or DOM Element itself
			url : '/admin/upload',
			flash_swf_url : '/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/Moxie.swf',
			silverlight_xap_url : '/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/Moxie.xap',
			
			filters : {
				max_file_size : '200mb',
				mime_types: [
					{title : "Image files", extensions : "jpg,jpeg"},
				]
			},
			//chunk_size: '200kb',
			resize: {
				width: 300,
				height: 300,
				quality: 90,
				crop: true,
			},
			multiple_queues: true,
			unique_names: true,
			
			init: {
				PostInit: function() {
					$('#console').hide();
					$('#filelist').html('');//Injecting an empty string
					$('#uploadfiles').click(function() {
						uploader.start();
						return false;
					});
				},
				FilesAdded: function(up, files) {
					var _files = '';
					plupload.each(files, function(file) {
						_files += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
					  });
					$('#filelist').html( _files );
				},
				UploadProgress: function(up, file) {
					$('#'+file.id+' b').html('<span>' + file.percent + '%</span>');
				},
				UploadComplete: function(up, files) {
					var upload_files = '';
					var fullLength = files.length;
					var setcount = 0;
					plupload.each(files, function(upload){
						var deleteButtonImages	= $('<a>',{
							'class':'glyphicon glyphicon-remove btn btn-danger'
						});
						deleteButtonImages.bind('click', function(e){
							e.preventDefault();
							alert('delete');
							$(this).closest('li').remove().unbind('click');
						});
					
						
						$('#_ListImages')
							.append ( $('<li>', {
								'class': 'row'								
								})
									.append( $('<img>', {
										'class':'col-sm-1',
										'src': '/uploads/' + upload.target_name 
									}))
									.append( $('<div>', {
										'class':'col-sm-8'
									})
										.append( $('<input>', {
											'class':'form-control',
											'type':'hidden',
											'name':'images[][x]',
											'value':'' + upload.target_name 
										}))
										.append( $('<input>', {
											'class':'form-control',
											'type':'text',
											'name':'img_des[][x]',
											'value':'',
										}))
										.append( '&nbsp;' )
		
										.append( deleteButtonImages )
										
										.append( '&nbsp;' )
										.append( $('<span>',{
											'class':'glyphicon glyphicon-sort btn btn-default disabled'
										}) )
									)
								)
							;
							
						
							
							
					});
					
					for(setcount=0; setcount<fullLength; setcount++){
						console.log(files);
						uploader.splice(setcount, 1);
						console.log(files);
					}
					
					
					//uploader.splice(); 
					
				},
				
			

				Error: function(up, err) {
					$('#console').html("Error #" + err.code + ": " + err.message+"\n").show();
				},
			}
		});
		uploader.init(
			
		);
	});
	
	</script>


@stop

@section('content')  
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    @if(isset($data->id))
    	{{ Form::open(array('action' => 'Admin_IngredientsController@postUpdateIngredients', 'class' => 'form-horizontal')) }} 
    @else
    	{{ Form::open(array('action' => 'Admin_IngredientsController@postAddIngredients', 'class' => 'form-horizontal')) }} 
    @endif
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
      <li><a href="#images" data-toggle="tab">Images</a></li>
      <li><a href="#metric" data-toggle="tab">Metric</a></li>
      <li><a href="#description" data-toggle="tab">Description</a></li>
    </ul>
    
    <div id="myTabContent" class="tab-content">
    
      	<div class="tab-pane fade in active" id="info">
	        <div class="form-group {{ ($errors->has('name')) ? ' has-error' : '' ; }}">
	            {{ Form::label('name', 'Name: ', array('class' => 'col-sm-2 control-label')) }}
	            <div class="col-sm-10">
	              {{ ($errors->has('name')) ? '<p>'. $errors->first('name') : '' .'</p>' }}
	              {{ Form::text('name', (isset($input['name'])? Input::old('name') : (isset($data->name)? $data->name : '' )), array('class' => 'form-control')) }}
	        	</div>
	        </div>
	        <div class="form-group {{ ($errors->has('summary')) ? ' has-error' : '' ; }}">
	            {{ Form::label('summary', 'Summary: ', array('class' => 'col-sm-2 control-label')) }}
	            <div class="col-sm-10">
	              {{ ($errors->has('summary')) ? '<p>'. $errors->first('summary') : '' .'</p>' }}
	              {{ Form::textarea('summary', (isset($input['summary'])? Input::old('summary') : (isset($data->summary)? $data->summary : '' )), array('class' => 'form-control', 'rows' => '2')) }}
	            </div>
	        </div>
	        <div class="form-group {{ ($errors->has('grams')) ? ' has-error' : '' ; }}">
	            {{ Form::label('grams', 'Grams: ', array('class' => 'col-sm-2 control-label')) }}
	            <div class="col-sm-2">
	              {{ ($errors->has('grams')) ? '<p>'. $errors->first('grams') : '' .'</p>' }}
	              {{ Form::text('grams', (isset($input['grams'])? Input::old('grams') : (isset($data->grams)? $data->grams : '' )), array('class' => 'form-control')) }}
	        	</div>
	        </div>
	        <div class="form-group {{ ($errors->has('grams')) ? ' has-error' : '' ; }}">
	            {{ Form::label('price', 'Price: ', array('class' => 'col-sm-2 control-label')) }}
	            <div class="col-sm-2">
	              {{ ($errors->has('price')) ? '<p>'. $errors->first('price') : '' .'</p>' }}
	              {{ Form::text('price', (isset($input['price'])? Input::old('price') : (isset($data->price)? $data->price : '' )), array('class' => 'form-control')) }}
	        	</div>
	        </div>
	        <div class="form-group">
	            {{ Form::label('active', 'Active: ', array('class' => 'col-sm-2 control-label')) }}
	            <div class="col-sm-10">
	              {{ Form::checkbox('active', 1, (isset($input['active']) ? Input::old('active') : (isset($data->active)? $data->active : '' )), array('class' => '')) }}
	            </div>
	        </div>
	        	{{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
	       	<div class="form-group">
	            <table class="table">
	                <thead>
	                    <tr>
	                    	<th>{{ Form::label('fruit', 'Fruit: ', array('class' => 'control-label')) }}</td>
	                        <th>{{ Form::label('lowgi', 'Low Gi: ', array('class' => 'control-label')) }}</td>
	                        <th>{{ Form::label('nut_seed', 'Nuts & Seeds: ', array('class' => 'control-label')) }}</td>
	                        <th>{{ Form::label('superfood', 'Superfood: ', array('class' => 'control-label')) }}</th>
	                        <th>{{ Form::label('sweetner', 'Natural Sweetner: ', array('class' => 'control-label')) }}</th>
	                        <th>{{ Form::label('vegetable', 'Vegetable: ', array('class' => 'control-label')) }}</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <td>{{ Form::checkbox('fruit', 1, (isset($input['fruit'])? Input::old('fruit') : (isset($data->fruit)? $data->fruit : '' )), array('class' => '')) }}</td>
	                    <td>{{ Form::checkbox('lowgi', 1, (isset($input['lowgi'])? Input::old('lowgi') : (isset($data->lowgi)? $data->lowgi : '' )), array('class' => '')) }}</td>
	                    <td>{{ Form::checkbox('nut_seed', 1, (isset($input['nut_seed'])? Input::old('nut_seed') : (isset($data->nut_seed)? $data->nut_seed : '' )), array('class' => '')) }}</td>
	                    <td>{{ Form::checkbox('superfood', 1, (isset($input['superfood'])? Input::old('superfood') : (isset($data->superfood)? $data->superfood : '' )), array('class' => '')) }}</td>
	                    <td>{{ Form::checkbox('sweetner', 1, (isset($input['sweetner'])? Input::old('sweetner') : (isset($data->sweetner)? $data->sweetner : '' )), array('class' => '')) }}</td>
	                    <td>{{ Form::checkbox('vegetable', 1, (isset($input['vegetable'])? Input::old('vegetable') : (isset($data->vegetable)? $data->vegetable : '' )), array('class' => '')) }}</td>                    
	                </tbody>
	            </table>
	      	</div>  
        </div>
      
        <div class="tab-pane fade in" id="images">
        	<br/>
            <div id="filelist">
            	Your browser doesn't have Flash, Silverlight or HTML5 support.
           		
            </div>
            <div id="container">
                <a id="pickfiles" href="javascript:;">[Select files]</a> 
                <a id="uploadfiles" href="javascript:;">[Upload files]</a>
            </div>
			<hr><br/>
            <div id="database_list">
				<ul id="_ListImages" class="_mySortable">
				<?php $x = 0; ?>
                @if(isset($i_images))                	
                	@foreach($i_images as $image)
						<li class="row">
                            <img class="col-sm-1" src="/uploads/{{ $image->name }}">
                            <div class="col-sm-8">
                                <input type="hidden" name="images[][{{ $image->id }}]" id="images_{{ $x }}" class="form-control" value="{{ $image->name }}" />
                                <input name="img_des[][{{ $image->id }}]" id="images_{{ $x }}" class="form-control" value="{{ $image->summary }}" />
                                <button id="{{ $image->id }}" class="deleteImage glyphicon glyphicon-remove btn btn-danger"></button>&nbsp;
                                <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                            </div>
                        </li>
                     <?php $x++; ?>                       
                   	@endforeach
                @endif
                </ul>
            </div>
            <br />
            <pre id="console"></pre>

        </div>
      
		
	    <div class="tab-pane fade in" id="metric">
			<div class="col-sm-1">
				{{ Form::submit('+ Calc', array('id' => 'btnActionCalculate','name' => 'calc','class' => 'btn btn-primary')) }}
			</div>
			<hr/>
			<?php  $x = 0; ?>
			@foreach($metrics as $metric)
				@foreach($imData as $im)
					@if($im->Metric()->exists())
						@foreach ($im->metric as $pivot_metric)	
							<div class="form-group">
					            <label for="{{$metric->name}}" class="col-sm-2 control-label">{{$metric->name}} :</label>
					            <div class="col-sm-3">
					            	<input type="text" class="form-control" id="{{$metric->name}}" name="@if($pivot_metric->id == $metric->id) metric_amount[][{{$metric->id}}] @else metric_amount[][x][{{$metric->id}}] @endif" value=" @if($pivot_metric->id == $metric->id) {{ $pivot_metric->pivot->metric_amount }} @endif " />
					            </div>

					            <label for="grams" class="col-sm-2 control-label">Grams :</label>
					            <div class="col-sm-3">
					               {{-- Form::text('$metric->name', (isset($input['ingredient_metric'])? Input::old('ingredient_metric') : (isset($sdata->sales_price)? $sdata->sales_price : '' )), array('class' => 'form-control')) --}}
					               <input type="text" class="form-control" id="grams" name="@if($pivot_metric->id == $metric->id) metric_grams[][{{$metric->id}}] @else metric_grams[][x][{{$metric->id}}] @endif" value=" @if($pivot_metric->id == $metric->id) {{ $pivot_metric->pivot->metric_grams }} @endif " />
					            </div>
					            <input type="hidden" name="@if($pivot_metric->id == $metric->id) imData_id[][{{$metric->id}}] @else imData_id[][x][{{$metric->id}}] @endif" value="@if($pivot_metric->id == $metric->id) {{ $pivot_metric->pivot->id }} @endif"/>
					        </div>
					        <?php // $x++; ?>
				        @endforeach
				    @else
				    	<div class="form-group">
				            <label for="{{$metric->name}}" class="col-sm-2 control-label">{{$metric->name}} :</label>
				            <div class="col-sm-3">
				            	<input type="text" class="form-control" id="{{$metric->name}}" name="metric_amount['x'][{{$metric->id}}]" value="" />
				            </div>

				            <label for="grams" class="col-sm-2 control-label">Grams :</label>
				            <div class="col-sm-3">
				               {{-- Form::text('$metric->name', (isset($input['ingredient_metric'])? Input::old('ingredient_metric') : (isset($sdata->sales_price)? $sdata->sales_price : '' )), array('class' => 'form-control')) --}}
				               <input type="text" class="form-control" id="grams" name="metric_grams['x'][{{$metric->id}}]" value="" />
				            </div>
				        </div>
				        <?php $x++; ?>
				    @endif
			    @endforeach
			@endforeach
		</div>	



        <div class="tab-pane fade in" id="description">
	        <div class="form-group {{ ($errors->has('description')) ? ' has-error' : '' ; }}">
	            {{ Form::label('description', 'Description: ', array('class' => 'col-sm-2 control-label')) }}
	            <div class="col-sm-10">
	              {{ ($errors->has('description')) ? '<p>'. $errors->first('description') : '' .'</p>' }}
	              {{ Form::textarea('description', (isset($input['description'])? Input::old('description') : (isset($data->description)? $data->description : '' )), array('class' => 'form-control')) }}
	            </div>
	        </div>
       	</div>
    </div>
    
    <hr/>        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
              {{ Form::submit('Save & Close', array('name' => 'sc','class' => 'btn btn-success')) }}
            <a href="/admin/menu/ingredients/">
            	{{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
           	</a>
            </div>
        </div> 
  	
    {{ Form::close() }}
    	        	
  </div>

@stop


@section('_tail')
    
@stop