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
				width: 1500,
				height: 461,
				quality: 90,
				//crop: true
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
    	{{ Form::open(array('action' => 'Admin_HeaderController@postUpdateHeader', 'class' => 'form-horizontal')) }} 
    @else
    	{{ Form::open(array('action' => 'Admin_HeaderController@postAddHeader', 'class' => 'form-horizontal')) }} 
    @endif
    <ul id="myTab" class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
      <li><a href="#images" data-toggle="tab">Images</a></li>
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
        <div class="form-group {{ ($errors->has('link')) ? ' has-error' : '' ; }}">
            {{ Form::label('link', 'Link: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ ($errors->has('link')) ? '<p>'. $errors->first('link') : '' .'</p>' }}
              {{ Form::text('link', (isset($input['link'])? Input::old('link') : (isset($data->link)? $data->link : '' )), array('class' => 'form-control')) }}
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
      
	    <div class="tab-pane fade in" id="images">
        <br/>
          <div id="filelist">
          Your browser doesn't have Flash, Silverlight or HTML5 support.

          </div>
          <div id="container">
            <a id="pickfiles" href="javascript:;">[Select files]</a> 
            <a id="uploadfiles" href="javascript:;">[Upload files]</a>
          </div>
          <hr>
		  <p style="color:red">The image must be 1500px * 461px<p>
          
          <div id="database_list">
            <ul id="_ListImages" class="_mySortable">
            <?php $x = 0; ?>
              @if(isset($h_images))                 
                @foreach($h_images as $image)
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
	    
	    <hr/>        
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-success')) }}
            <a href="/admin/website/quotes/">
            	{{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
           	</a>
            </div>
        </div> 
  	
    {{ Form::close() }}
    	        	
  </div>

@stop


@section('_tail')
    
@stop