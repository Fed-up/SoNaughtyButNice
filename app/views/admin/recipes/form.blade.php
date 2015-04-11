@extends('tmpl.admin')

@section('title')
    {{ $title }}
@stop

@section('_head') 
	<script type="text/javascript" src="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="/packages/plupload-2.1.2/js/plupload.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/packages/jquery-1.11.1.min/vendor/jquery-ui-1.10.4.custom/css/no-theme/jquery-ui-1.10.4.custom.min.css"/> 
    
      <script>
      


	  $(function() {
		  
		$( "._mySortable" ).sortable({ 
			axis: "y", 
			opacity: 0.3,
			placeholder: "sortable-placeholder",
			// callback function
			update: function( event, ui ) {
				ui.item.css({'background':'#DBEEC9'})
			},
		});
		$( "._mySortable" ).disableSelection();
		
		
		
		//Start fact
		
		//Start Delete fact
		$('#counterFacts').val( $('#_ListFacts li').length );

		$('.deleteFact').click(function(e) {
			e.preventDefault();
			
			//var currentID = 0;	
					
			var currentID = (this.id);
			
			if($("#ddf" + currentID).length == 0) {
				$('#_ListFacts')
					
						.append( $('<input>',{
							'type':'hidden',
							'name':'ddf[]',
							'id':'ddf'+currentID, /*ddi = delete data ingredient*/
							'class':'form-control',
							'value':''+currentID,
						}) )
				;
				$(this).parent('li').hide().unbind('click');
				
			} else {
			//alert('this record already exists');
				$("#ddf" + currentID).closest('input').remove().unbind('click');
			}
			
			
			
		});
		
		//add fact
		$('#btnActionAddFact').click(function(e) {
			e.preventDefault();
						
			var currentID = $('#counterFacts').val();
			//console.log(currentID);
			
			var deleteButtonFacts	= $('<button>',{
										'class':'glyphicon glyphicon-remove btn btn-danger'
									});
									
			deleteButtonFacts.bind('click', function(e){
				e.preventDefault();
				$(this).parent('li').remove().unbind('click');
			});
			
			$('#_ListFacts')
				.append( $('<li>') 
				
					.append( $('<textarea>',{
						'name':'fact[][x]',
						'id':'fact_'+currentID,
						'class':'form-control',
					}) )
					.append( '&nbsp;' )

					.append( deleteButtonFacts )
					.append( '&nbsp;' )
					.append( $('<span>',{
						'class':'glyphicon glyphicon-sort btn btn-default disabled'
					}) )
					
				)
			;
			
			$('#counterFacts').val( parseInt(currentID, 10) + 1 );
			
		});
		
		//Start Delete Ingredient
		$('#counterIngredients').val( $('#_ListIngredients li').length );

		$('.deleteIngredient').click(function(e) {
			e.preventDefault();
			
			//var currentID = 0;	
					
			var currentID = (this.id);
			
			if($("#ddi" + currentID).length == 0) {
				$('#_ListIngredients')
					
						.append( $('<input>',{
							'type':'hidden',
							'name':'ddi[]',
							'id':'ddi'+currentID, /*ddi = delete data ingredient*/
							'class':'form-control',
							'value':''+currentID,
						}) )
				;
				$(this).parent('li').hide().unbind('click');
				
			} else {
			//alert('this record already exists');
				$("#ddi" + currentID).closest('input').remove().unbind('click');
			}
			
			
			
		});
		
		//Start Ingredients
		$('#counterIngredients').val( $('#_ListIngredients li').length );
		$('#btnActionAddIngredient').click(function(e) {
			e.preventDefault();
			
			var currentID = $('#counterIngredients').val();
			
			var ingredientsArray = [];
			<?php
			
			$ix = 0;
			foreach ($ingredients as $i=>$v) {
				echo 'ingredientsArray['.$ix.'] = ["'.$i.'","'.$v.'"]'."\n";
				$ix++;
			}; 

			?>
			
			var SelectList	= $('<select>',{
						'name':'ingredients[][x]',
						'id':'ingredients_'+currentID,
						'class':'form-control input--ingredient',
					});
			
			$.each(ingredientsArray, function(key,value) {
				SelectList
					.append($('<option></option>')
					.attr('value',value[0])
					.text(value[1])); 
			});
			
			var metricArray = [];
			<?php
			
			$ix = 0;
			foreach ($metric as $i=>$v) {
				echo 'metricArray['.$ix.'] = ["'.$i.'","'.$v.'"]'."\n";
				$ix++;
			}; 

			?>
			
			var SelectListM	= $('<select>',{
						'name':'metric[][x]',
						'id':'metric_'+currentID,
						'class':'form-control input--metric',
					});
			
			$.each(metricArray, function(key,value) {
				SelectListM
					.append($('<option></option>')
					.attr('value',value[0])//Returns first element in the array
					.text(value[1])); //Returns second element in the array
			});
			
			var deleteButton	= $('<button>',{
										'class':'glyphicon glyphicon-remove btn btn-danger'
									});
			deleteButton.bind('click', function(e){
				e.preventDefault();
				$(this).parent('li').remove().unbind('click');
			});
			
			$('#_ListIngredients')
				.append( $('<li>') 
				
					.append( SelectList )
					.append( '&nbsp;' )
					.append( $('<input>',{
						'name':'amount[][x]',
						'id':'amount_'+currentID,
						'class':'form-control input--amount',
						'placeholder':'amount',
					}) )
					.append( '&nbsp;' )
					.append( SelectListM )
					.append( '&nbsp;' )
					.append( $('<input>',{
						'name':'ri_sales_amount[][x]',
						'id':'ri_sales_amount_'+currentID,
						'class':'form-control input--amount',
						'placeholder':'0.00',
					}) )
					.append( '&nbsp;' )
					.append( $('<input>',{
						'name':'grams[][x]',
						'id':'grams_'+currentID,
						'class':'form-control input--grams',
						'placeholder':'grams',
					}) )
					.append( '&nbsp;' )

					.append( deleteButton )
					.append( '&nbsp;' )
					.append( $('<span>',{
						'class':'glyphicon glyphicon-sort btn btn-default disabled'
					}) )
					
				)
			;
			
			$('#counterIngredients').val( parseInt(currentID, 10) + 1 );
			
		});
		
		//Start Method
		$('#counterMethods').val( $('#_ListMethods li').length );
		//delete Method
		$('.deleteMethod').click(function(e) {
			e.preventDefault();
			
			//var currentID = 0;	
					
			var currentID = (this.id);
			
			if($("#ddm" + currentID).length == 0) {
				$('#_ListMethods')
					
						.append( $('<input>',{
							'type':'hidden',
							'name':'ddm[]',
							'id':'ddm'+currentID, /*ddi = delete data ingredient*/
							'class':'form-control',
							'value':''+currentID,
						}) )
				;
				$(this).parent('li').hide().unbind('click');
				
			} else {
			//alert('this record already exists');
				$("#ddm" + currentID).closest('input').remove().unbind('click');
			}
			
			
			
		});
		//Add method
		$('#btnActionAddMethod').click(function(e) {
			e.preventDefault();
			
			
			var currentID = $('#counterMethods').val();
			
			var deleteButtonMethods	= $('<button>',{
										'class':'glyphicon glyphicon-remove btn btn-danger'
									});
									
			deleteButtonMethods.bind('click', function(e){
				e.preventDefault();
				$(this).parent('li').remove().unbind('click');
			});
			
			$('#_ListMethods')
				.append( $('<li>') 
				
					.append( $('<textarea>',{
						'name':'method[][x]',
						'id':'method_'+currentID,
						'class':'form-control',						
					}) )
					.append( '&nbsp;' )

					.append( deleteButtonMethods )
					.append( '&nbsp;' )
					.append( $('<span>',{
						'class':'glyphicon glyphicon-sort btn btn-default disabled'
					}) )
					
				)
			;
			
			
			$('#counterMethods').val( parseInt(currentID, 10) + 1 );
			
		});
		
		//Start Extra
		$('#counterExtras').val( $('#_ListExtras li').length );
		//Delete extra
		$('.deleteExtra').click(function(e) {
			e.preventDefault();
			
			//var currentID = 0;	
					
			var currentID = (this.id);
			
			if($("#dde" + currentID).length == 0) {
				$('#_ListExtras')
					
						.append( $('<input>',{
							'type':'hidden',
							'name':'dde[]',
							'id':'dde'+currentID, /*ddi = delete data ingredient*/
							'class':'form-control',
							'value':''+currentID,
						}) )
				;
				$(this).parent('li').hide().unbind('click');
				
			} else {
			//alert('this record already exists');
				$("#dde" + currentID).closest('input').remove().unbind('click');
			}
			
			
			
		});
		
		//Add extra
		$('#btnActionAddExtra').click(function(e) {
			e.preventDefault();
			
			
			var currentID = $('#counterExtras').val();
			
			var deleteButtonExtras	= $('<button>',{
										'class':'glyphicon glyphicon-remove btn btn-danger'
									});
									
			deleteButtonExtras.bind('click', function(e){
				e.preventDefault();
				$(this).parent('li').remove().unbind('click');
			});
			
			$('#_ListExtras')
				.append( $('<li>') 
				
					.append( $('<textarea>',{
						'name':'extra[][x]',
						'id':'extra_'+currentID,
						'class':'form-control',
					}) )
					.append( '&nbsp;' )

					.append( deleteButtonExtras )
					.append( '&nbsp;' )
					.append( $('<span>',{
						'class':'glyphicon glyphicon-sort btn btn-default disabled'
					}) )
					
				)
			;
			
			
			$('#counterExtras').val( parseInt(currentID, 10) + 1 );
			
		});

	  
	  
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
					width: 500,
					height: 500,
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
			

			
		} ) ;

		// if(window.jQuery){
		// 	console.log("hi");
		// }
		// // $(".input--amount").on("blur", infunc);

		// $(".input--amount").blur(function(){
		// 	alert("Handled");
		// 	console.log("hi");
		// });

		// function infunc($event){

		// 	var input_ingredient = $(this).val()

			

		// 	$(this).attr("name")

		// 	$("#outputfiled").val(3847293478);

		// }

	  </script>
@stop

@section('content')

	<?php //echo '<pre>'; print_r($json_calc); echo '</pre>'; exit; ?>
  
  <div class="row">
  	<h1 class="page-header">@yield('title')</h1>
    @if(isset($data->id))
    	{{ Form::open(array('action' => 'Admin_RecipesController@postUpdateRecipes', 'class' => 'form-horizontal')) }} 
   	@else
  		{{ Form::open(array('action' => 'Admin_RecipesController@postAddRecipes', 'class' => 'form-horizontal')) }} 
    @endif
    
    <ul id="myTab" class="nav nav-tabs">
      <li class="@if($calculated != 1)active@endif"><a href="#info" data-toggle="tab">Info</a></li>
      <li><a href="#images" data-toggle="tab">Images</a></li>
      <li><a href="#facts" data-toggle="tab">Fresh Facts</a></li>
      <li><a href="#ingredients" data-toggle="tab">Ingredients</a></li>
      <li><a href="#method" data-toggle="tab">Method</a></li>
      <li><a href="#extras" data-toggle="tab">Little Extra</a></li>
      <li class="@if($calculated == 1)active@endif"><a href="#sales" data-toggle="tab">Sales Data</a></li>
    </ul>
    
    <div id="myTabContent" class="tab-content ">
      <div class="tab-pane fade in @if($calculated != 1)active@endif" id="info">
  		<div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
              {{ Form::label('title', 'Name: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
               {{($errors->has('title')) ? '<p>'. $errors->first('name'). '</p>' : '' }}
               {{ Form::text('title', (isset($input['name'])? Input::old('name') : (isset($data->name)? $data->name : '' )), array('class' => 'form-control')) }}
               
            </div>
        </div>
    	<div class="form-group {{ ($errors->has('summary')) ? 'has-error' : '' ; }}">
     		{{ Form::label('summary', 'Summary: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                {{ ($errors->has('summary'))? '<p>'. $errors->first('summary') .'</p>' : '' }}
                {{ Form::textarea('summary', (isset($input['summary'])? Input::old('summary') : (isset($data->summary)? $data->summary : '' )), array('class' => 'form-control', 'rows' => '2')) }} 
            </div>
		</div>
        
        
        
        
        <div class="form-group {{ ($errors->has('length')) ? 'has-error' : '' ; }}">
     		{{ Form::label('length', 'Cooking Time: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ ($errors->has('length'))? '<p>'. $errors->first('length') .'</p>' : '' }}
                {{ Form::text('length', (isset($input['length'])? Input::old('length') : (isset($data->length)? $data->length : '' )), array('class' => 'form-control')) }} 
            </div>
		</div>
        <div class="form-group }}">
        	{{ Form::label('difficulty', 'Difficulty: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-3">
                {{ Form::select('difficulty', 
                    array('Fun' => 'Fun',
                        'Easy' => 'Easy',
                        'Tricky' => 'Tricky'), (isset($input['difficulty'])? Input::old('difficulty') : (isset($data->difficulty)? $data->difficulty : null )), array('class'=>'form-control')) }} 
            </div>
        </div>
        <div class="form-group {{ ($errors->has('serve')) ? 'has-error' : '' ; }}">
     		{{ Form::label('serve', 'Serving Size: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ ($errors->has('serve'))? '<p>'. $errors->first('serve') .'</p>' : '' }}
                {{ Form::text('serve', (isset($input['serve'])? Input::old('serve') : (isset($data->serve)? $data->serve : '' )), array('class' => 'form-control')) }}
            </div>
		</div>
        
        
        
        
        
        <div class="form-group">
            {{ Form::label('active', 'Active: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('active', 1, (isset($input['active'])? Input::old('active') : (isset($data->active)? $data->active : '' )), array('class' => '')) }}
            </div>
        </div>  
        <div class="form-group">
            {{ Form::label('exclusive', 'Exclusive: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('exclusive', 1, (isset($input['exclusive'])? Input::old('exclusive') : (isset($data->exclusive)? $data->exclusive : '' )), array('class' => '')) }}
            </div>
        </div>        
        <div class="form-group {{ ($errors->has('categories')) ? 'has-error' : '' ; }}">
     	{{ Form::label('categories', 'Categories: ', array('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-3">
                {{ ($errors->has('categories'))? '<p>'. $errors->first('categories') .'</p>' : '' }}
                {{ Form::select('categories', $categories, (isset($input['categories'])? Input::old('categories') : (isset($data->menu_categories_id)? $data->menu_categories_id : 0 )), array('class'=>'form-control')) }} 
            </div>
		</div>
        <hr>
        <div class="form-group">
            <table class="table">
                <thead>
                    <tr>
                    	<th>{{ Form::label('DF', 'Dairy Free: ', array('class' => 'control-label')) }}</td>
                        <th>{{ Form::label('DS', 'Diabetic Safe: ', array('class' => 'control-label')) }}</td>
                        <th>{{ Form::label('EF', 'Egg Free: ', array('class' => 'control-label')) }}</td>
                        <th>{{ Form::label('FI', 'Fructose Intolerant: ', array('class' => 'control-label')) }}</th>
                        <th>{{ Form::label('GF', 'Glutean Free: ', array('class' => 'control-label')) }}</th>
                        <th>{{ Form::label('NF', 'Nut Free: ', array('class' => 'control-label')) }}</th>
                        <th>{{ Form::label('SF', 'Sugar Free: ', array('class' => 'control-label')) }}</th>
                        <th>{{ Form::label('VE', 'Vegan: ', array('class' => 'control-label')) }}</th>
                        <th>{{ Form::label('V', 'Vegetarian: ', array('class' => 'control-label')) }}</th>
                    </tr>
                </thead>
                <tbody>
                    <td>{{ Form::checkbox('DF', 1, (isset($input['DF'])? Input::old('DF') : (isset($data->df)? $data->df : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('DS', 1, (isset($input['DS'])? Input::old('DS') : (isset($data->ds)? $data->ds : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('EF', 1, (isset($input['EF'])? Input::old('EF') : (isset($data->ef)? $data->ef : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('FI', 1, (isset($input['FI'])? Input::old('FI') : (isset($data->fi)? $data->fi : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('GF', 1, (isset($input['GF'])? Input::old('GF') : (isset($data->gf)? $data->gf : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('NF', 1, (isset($input['NF'])? Input::old('NF') : (isset($data->nf)? $data->nf : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('SF', 1, (isset($input['SF'])? Input::old('SF') : (isset($data->sf)? $data->sf : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('VE', 1, (isset($input['VE'])? Input::old('VE') : (isset($data->ve)? $data->ve : '' )), array('class' => '')) }}</td>
                    <td>{{ Form::checkbox('V', 1, (isset($input['V'])? Input::old('V') : (isset($data->v)? $data->v : '' )), array('class' => '')) }}</td>
                    
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
                @if(isset($r_images))                	
                	@foreach($r_images as $image)
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
      
      
      
      
      
      <div class="tab-pane fade in" id="facts">
            <div class="col-sm-1">
            	{{-- Form::button('+ Add', array('id' => 'btnActionAddFact','class' => 'btn btn-primary')) --}}
                <a href="#" id="btnActionAddFact" class="btn btn-primary">+ Add</a>
                {{ Form::hidden('counterFacts',null,array('id'=>'counterFacts')) }}
            </div>
            <hr/>
           <div class="form-group {{ ($errors->has('fact')) ? 'has-error' : '' ; }}">
           	{{ ($errors->has('fact'))? '<p>'. $errors->first('fact') .'</p>' : '' }}
          	<ul id="_ListFacts" class="_mySortable">
				<?php $x = 0; ?>
                @if(isset($r_facts))                	
                	@foreach($r_facts as $fact)
						<li>
                            <textarea name="fact[][{{ $fact->id }}]" id="fact_{{ $x }}" class="form-control">{{ $fact->description }}</textarea>&nbsp;
                            <button id="{{ $fact->id }}" class="deleteFact glyphicon glyphicon-remove btn btn-danger"></button>&nbsp;
                            <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                        </li>
                     <?php $x++; ?>                       
                   	@endforeach
                @endif
            </ul>
          </div>
      </div>
      <div class="tab-pane fade in" id="ingredients">
        <div class="col-sm-1">
          	{{-- Form::button('+ Add', array('id' => 'btnActionAddIngredient','class' => 'btn btn-primary')) --}}
          	<a href="#" id="btnActionAddIngredient" class="btn btn-primary">+ Add</a>
          	{{ Form::hidden('counterIngredients',null,array('id'=>'counterIngredients')) }} 

        </div>
        <hr/>
        <div class="form-group {{ ($errors->has('ingredients')) ? 'has-error' : '' ; }}">
           	{{ ($errors->has('ingredients'))? '<p>'. $errors->first('ingredients') .'</p>' : '' }}
          	<ul id="_ListIngredients" class="_mySortable">
            	<?php $x = 0; ?>
                @if(isset($r_ingredients))
                	@foreach($r_ingredients as $r_ingredient)


	                	<?php // echo 'THis sarah'; ?>
	                	
	                	<!-- @foreach($json_array as $i => $in)
                        	@if($i == $r_ingredient->id)
	                        	<?php //echo '<pre>'; print_r($i); echo '</pre>';?>
	                        	<?php //echo '<pre>'; print_r($in); echo '</pre>';?>
                        	@endif
                        @endforeach
            			<?php //echo '<pre>'; print_r($json_array); echo '</pre>'; exit; ?> -->

	                    	<li>
	                            <select name="ingredients[][{{ $r_ingredient->id }}]" id="ingredients_{{ $x }}" class="form-control input--ingredient"/>
	                                @foreach($ingredients as $i=>$v)
	                                	<option value="{{ $i }}" @if ($r_ingredient->menu_ingredients_id == $i) selected="selected" @endif >{{ $v }}</option>
	                                @endforeach
	                            </select>
	                            <input name="amount[][{{ $r_ingredient->id }}]" id="ingredients_{{ $x }}" class="form-control input--amount " value="{{ $r_ingredient->amount }}" />
	                            <select name="metric[][{{ $r_ingredient->id }}]" id="ingredients_{{ $x }}" class="form-control input--metric"/>
	                                @foreach($metric as $in=>$val)
	                                	<option value="{{ $in }}" @if ($r_ingredient->metric_id == $in) selected="selected" @endif >{{ $val }}</option>
	                                @endforeach
	                            </select>
	                            <input name="ri_sales_amount[][{{ $r_ingredient->id }}]" id="ingredients_{{ $x }}" class="form-control input--amount " value="{{ $r_ingredient->ri_sales_amount }}" />
	                            <input name="grams[][{{ $r_ingredient->id }}]" id="ingredients_{{ $x }}" class="form-control input--grams " value="{{ $r_ingredient->grams }}" />

	                            @foreach($json_array as $i => $in)
	                            	@if($i == $r_ingredient->menu_ingredients_id)
	                            		<input type="hidden" name="i_grams[{{$i}}]" value="{{ $in['grams'] }}" />
	                            		<input type="hidden" name="i_price[{{$i}}]" value="{{ $in['price'] }}" />
			                        	<?php //echo '<pre>'; print_r($i); echo '</pre>';?>
			                        	<?php //echo '<pre>'; print_r($in); echo '</pre>';?>
		                        	@endif
		                        @endforeach

	                            <button id="{{ $r_ingredient->id }}" class="deleteIngredient glyphicon glyphicon-remove btn btn-danger"></button>
	                            <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
	                            
	                   		</li>
	                        

	                 	<?php $x++; ?>                    
                   	@endforeach
                @endif
         	</ul>
		</div>
      </div>
      <div class="tab-pane fade in" id="method">
            <div class="col-sm-1">
            	{{-- Form::button('+ Add', array('id' => 'btnActionAddMethod','class' => 'btn btn-primary')) --}}
                <a href="#" id="btnActionAddMethod" class="btn btn-primary">+ Add</a>
                {{ Form::hidden('counterMethods',null,array('id'=>'counterMethods')) }}
            </div>
           <hr/>
           <div class="form-group {{ ($errors->has('method')) ? 'has-error' : '' ; }}">
           	{{ ($errors->has('method'))? '<p>'. $errors->first('method') .'</p>' : '' }}
          	<ul id="_ListMethods" class="_mySortable">
            	<?php $x = 0; ?>
                @if(isset($r_methods))                	
                	@foreach($r_methods as $method)
						<li>
                            <textarea name="method[][{{ $method->id }}]" id="method_{{ $x }}" class="form-control">{{ $method->description }}</textarea>&nbsp;
                            <button id="{{ $method->id }}" class="deleteMethod glyphicon glyphicon-remove btn btn-danger"></button>&nbsp;
                            <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                        </li>
                     <?php $x++; ?>                       
                   	@endforeach
                @endif
            </ul>
          </div>
      </div>         
      <div class="tab-pane fade in" id="extras">
            <div class="col-sm-1">
            	{{-- Form::button('+ Add', array('id' => 'btnActionAddExtra','class' => 'btn btn-primary')) --}}
                <a href="#" id="btnActionAddExtra" class="btn btn-primary">+ Add</a>
                {{ Form::hidden('counterExtras',null,array('id'=>'counterExtras')) }}
            </div>
            <hr/>
           <div class="form-group {{ ($errors->has('extra')) ? 'has-error' : '' ; }}">
           	{{ ($errors->has('extra'))? '<p>'. $errors->first('extra') .'</p>' : '' }}
          	<ul id="_ListExtras" class="_mySortable">
				<?php $x = 0; ?>
                @if(isset($r_extras))                	
                	@foreach($r_extras as $extra)
						<li>
                            <textarea name="extra[][{{ $extra->id }}]" id="extra_{{ $x }}" class="form-control">{{ $extra->description }}</textarea>&nbsp;
                            <button id="{{ $extra->id }}" class="deleteExtra glyphicon glyphicon-remove btn btn-danger"></button>&nbsp;
                            <span class="glyphicon glyphicon-sort btn btn-default disabled"></span>
                        </li>
                     <?php $x++; ?>                       
                   	@endforeach
                @endif
            </ul>
          </div>
      </div>
      <div class="tab-pane fade in @if($calculated == 1)active@endif" id="sales">
            <div class="col-sm-1">
            	{{ Form::submit('+ Calc', array('id' => 'btnActionCalculate','name' => 'calc','class' => 'btn btn-primary')) }}
            </div>
            <hr/>
            @if(isset($data->id))                	
            	@foreach($r_sales as $sdata)
					{{ Form::hidden('sdata_id', $sdata->id) }}
		            <div class="row">
			            <div class="form-group">
				              {{ Form::label('staff_cost_per_hour', 'Staff cost per hour: ', array('class' => 'col-sm-2 control-label')) }}
				            <div class="col-sm-3">
				            {{ Form::text('staff_cost_per_hour', (isset($input['staff_cost_per_hour'])? Input::old('staff_cost_per_hour') : (isset($sdata->staff_cost_per_hour)? $sdata->staff_cost_per_hour : '' )), array('class' => 'form-control')) }}				            </div>

				            {{ Form::label('sales_price', 'Price: ', array('class' => 'col-sm-2 control-label')) }}
				            <div class="col-sm-3">
				               {{ Form::text('sales_price', (isset($input['sales_price'])? Input::old('sales_price') : (isset($sdata->sales_price)? $sdata->sales_price : '' )), array('class' => 'form-control')) }} 
				            </div>

				        </div>
				        <div class="form-group">
				        	<h5 class="col-sm-2 control-label sales-data__title">Staff cost to make recipe batch:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{(isset($sdata->staff_cost_to_make_recipe_batch)? $sdata->staff_cost_to_make_recipe_batch : '' )}}</p>
				            </div>

				            {{ Form::label('B2B_sales_price', 'B2B - Price: ', array('class' => 'col-sm-2 control-label')) }}
				            <div class="col-sm-3">
				               {{ Form::text('B2B_sales_price', (isset($input['B2B_sales_price'])? Input::old('B2B_sales_price') : (isset($sdata->B2B_sales_price)? $sdata->B2B_sales_price : '' )), array('class' => 'form-control')) }} 
				            </div>
				        </div>
				        <div class="form-group">
				        	<h5 class="col-sm-2 control-label sales-data__title">Staff cost per piece:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{(isset($sdata->staff_cost_per_piece)? $sdata->staff_cost_per_piece : '' )}}</p>
				            </div>

				            {{ Form::label('sales_amount', 'Amount: ', array('class' => 'col-sm-2 control-label')) }}
				            <div class="col-sm-3">
				               {{ Form::text('sales_amount', (isset($input['sales_amount'])? Input::old('sales_amount') : (isset($sdata->sales_amount)? $sdata->sales_amount : '' )), array('class' => 'form-control')) }}
				            </div>
				        </div>
				        <div class="form-group">
				        	<h5 class="col-sm-2 control-label sales-data__title">   </h5>
				            <div class="col-sm-3">
				               
				            </div>

				            {{ Form::label('sales_time', 'Time - minutes: ', array('class' => 'col-sm-2 control-label')) }}
				            <div class="col-sm-3">
				               {{ Form::text('sales_time', (isset($input['sales_time'])? Input::old('sales_time') : (isset($sdata->sales_time)? $sdata->sales_time : '' )), array('class' => 'form-control')) }}
				            </div>
				        </div>
				        <hr/>
				        <div class="form-group">
				        	 <h5 class="col-sm-2 control-label sales-data__title">B2C - Desired Sales Price:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{(isset($sdata->desired_sales_price)? $sdata->desired_sales_price : '' )}}</p>
				            </div>

				            {{ Form::label('desired_total_markup', 'Desired Total Markup - %: ', array('class' => 'col-sm-2 control-label')) }}
				            <div class="col-sm-2">
				               {{ Form::text('desired_total_markup', (isset($input['desired_total_markup'])? Input::old('desired_total_markup') : (isset($sdata->desired_total_markup)? $sdata->desired_total_markup : '' )), array('class' => 'form-control', 'placeholder' => '400')) }}
				            </div>
				            <!-- <div class="col-sm-1"></div> -->
				             
				        </div>
				        <div class="form-group">
				        	<h5 class="col-sm-2 control-label sales-data__title">B2B - Desired Sales Price:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->B2B_desired_sales_price}}</p>
				            </div>
				            <h5 class="col-sm-2 control-label sales-data__title">B2B Total markup - %:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->B2B_desired_total_markup}} %</p>
				            </div>  
				        </div>
						<hr/>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
			        	    <h5 class="col-sm-2 control-label sales-data__title">Total recipe cost:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_recipe_cost}}</p>
				            </div>
				            <h5 class="col-sm-2 control-label sales-data__title">B2C Total markup - %:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->total_markup_percentage}} %</p>
				            </div>           
						 </div>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
			        	    <h5 class="col-sm-2 control-label sales-data__title">Total ingredient cost:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_ingredient_cost}}</p>
				            </div>
				            <h5 class="col-sm-2 control-label sales-data__title">B2B Total Recipe Revenue:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->B2B_total_recipe_revenue}}</p>
				            </div>  
				        </div>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
			        	    <h5 class="col-sm-2 control-label sales-data__title">Total ingredient cost per piece:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_ingredient_cost_per_piece}}</p>
				            </div>

				            <h5 class="col-sm-2 control-label sales-data__title">Total recipe revenue:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_recipe_revenue}}</p>
				            </div>
				        </div>
				        <hr/>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
			        	    
				        	<h5 class="col-sm-2 control-label sales-data__title">Total cost percentage</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info"> {{$sdata->total_cost_percentage}} %</p>
				            </div>


				            <h5 class="col-sm-2 control-label sales-data__title">Total profit:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_profit}}</p>
				            </div>
				        </div>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
			        	    <h5 class="col-sm-2 control-label sales-data__title">Staff cost percentage:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->staff_cost_percentage}} %</p>
				            </div>

				            <h5 class="col-sm-2 control-label sales-data__title">Total profit per piece:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_profit_per_piece}}</p>
				            </div>
				        </div>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
			        	    <h5 class="col-sm-2 control-label sales-data__title">Ingredient cost percentage:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->ingredient_cost_percentage}} %</p>
				            </div>

				            <h5 class="col-sm-2 control-label sales-data__title">Total cost per piece:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">$ {{$sdata->total_cost_per_piece}}</p>
				            </div>
				        </div>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
				        	<h5 class="col-sm-2 control-label sales-data__title">Total margin percentage:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->total_margin_percentage}} %</p>
				            </div>

				            
				        </div>
				        <hr>
				        <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
				        	<h5 class="col-sm-2 control-label sales-data__title">Total recipe grams:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->total_recipe_grams}} g</p>
				            </div>

				            <h5 class="col-sm-2 control-label sales-data__title">Total grams per piece:</h5>
				            <div class="col-sm-3">
				               <p class="sales-data__info">{{$sdata->total_grams_per_piece}} g</p>
				            </div>

				        </div>
				        <hr/>
		        		<?php //echo '<pre>'; print_r($sdata->price); echo '</pre>'; exit; ?>
               	@endforeach
            @endif
	        <!-- <div class="form-group {{ ($errors->has('title')) ? ' has-error' : '' ; }}">
        	    <h5 class="col-sm-2 control-label sales-data__title">Ingredient cost percentage:</h5>
	            <div class="col-sm-3">
	               <p class="sales-data__info">$$$$ %%</p>
	            </div>

	            <h5 class="col-sm-2 control-label sales-data__title">Total markup percentage:</h5>
	            <div class="col-sm-3">
	               <p class="sales-data__info">$$$$ %%</p>
	            </div>
	        </div> -->
	        <div class="row">

	        	<div class="col-sm-offset-1 col-sm-10">
			       	<table class="table table-striped">
			            <thead>
			            	<tr>
			                    <th>Ingredient</td>
			                    <th>Ingredient Cost</th>
			                    <th>Packet Grams</th>
			                    <th>Packet Grams %</th>
			                    <th>Recipe Ingredient Cost</th>
			                    <th>Recipe Grams</th>
			                </tr>
			            </thead>
			            @if(isset($r_ingredients))

            			@foreach($r_ingredients as $r_ingredient)

	            			@foreach($s_ingredients as $ingredient)

		            			
		            				<?php //echo '<pre>'; print_r($sales_data_ingredients); echo '</pre>'; exit;?>
		            				
		            				<?php //echo '<pre>'; print_r($ingredient->id); echo '</pre>'; exit; ?>


		                            @if ($r_ingredient->menu_ingredients_id == $ingredient->id)    	
						            <tbody>
							            <tr>
							                <td> {{ $ingredient->name }} </td>
							                <td>$ {{ $ingredient->price }} </td>
							                <td> {{ $ingredient->grams }}g </td>
							                <td> {{ $r_ingredient->packet_grams_percentage }} % </td>
							                <td>$ {{ $r_ingredient->recipe_ingredient_cost }} </td>
							                <td> {{ $r_ingredient->sales_grams }}g </td>
							            </tr>
						            </tbody>
						            @endif 
					            
				            @endforeach
			            @endforeach
			            @endif
			            <tfoot>
			            	<tr>
			                	<td colspan="20">
			                    	
			                    </td>
			               	</tr>
			            </tfoot>
			       	</table>
		        </div>	
			</div>
	        </div>
      </div>
            
            <div class="form-group {{ ($errors->has('extra')) ? 'has-error' : '' ; }}">
	           	{{ ($errors->has('extra'))? '<p>'. $errors->first('extra') .'</p>' : '' }}
            </div>
      </div>
      
    </div>
        
        	{{ Form::hidden('id', (isset($input['id'])? Input::old('id') : (isset($data->id)? $data->id : '' ))) }}
        	{{-- Form::hidden('sc', ( '10' )) --}}
            
            <hr/>
            
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
              {{ Form::submit('Save & Close', array('name' => 'sc','class' => 'btn btn-success')) }}
              <!-- <input type="submit" name="sc" id="1" value="Save & Close" class="btn btn-success"> -->
            <a href="/admin/menu/recipes/">
                {{ Form::button('Cancel' ,array('class' => 'btn btn-danger')) }}
            </a>
            </div>
        </div>
    {{ Form::close() }}
    	        	
  </div>

@stop


@section('_tail')

@stop